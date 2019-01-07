<?php

namespace App\Http\Controllers\Auth;

use App\BaseDir\Entities\User;
use App\BaseDir\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /**
     * @var UserService
     */
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('guest');
        $this->userService = $userService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_type' => 'member',
            'token' => str_random(32),
        ]);
        $user_array = $user->toArray();
        Mail::send('mails.confirmation', $user_array, function ($message) use ($user_array) {
            $message->to($user_array['email'], $user_array['name']);
            $message->subject('Confirm your email');
        });
        if ($user == true)
        {
            return redirect()->route('login')->with('success','You are successfully registerd. Please verify your account through email we send');
        }
        else
            return back()->with('error','You are not registered. Please try again.');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $user;
    }

    public function confirmation($token)
    {
        $user = User::where('token', decrypt($token))->first();
        if (!is_null($user)) {
                if ($user->verified != 1) {
                    $user->verified = 1;
                    $user->token = null;
                    $user->save();
                    $user = $user->toArray();

                    Mail::send('mails.confirmed', $user, function ($message) use ($user) {
                        $message->to($user['email'], $user['first_name']);
                        $message->subject('Account Confirmation');
                    });
                    return redirect('/')->with('success', "Your registration is complete. Please login.");
                } elseif ($user->verified == 1)
                    return redirect('/')->with('success', "You are already registered. Please login.");
        }else {
            return redirect('/')->with('success', "Either you are already registered or the token is invalid.");
        }
    }

    /**
     * send email to reset password
     * @param Request $request
     * @return string
     */
    public function passwordEmail(Request $request)
    {
        $email = $request->email;
        $user = $this->userService->getUser('email',$email);
        if ($user == null) {
            return back()->with('warning',"Account not found.");
        } else {
            $user->token = str_random(32);
            $user->update();
            $user = $user->toArray();
            if ($user['verified'] != 0)
            {
                Mail::send('mails.password_reset', $user, function ($message) use ($user) {
                    $message->to($user['email'], $user['name']);
                    $message->subject('Reset Your Password');
                });
                return redirect('/')->with('success',"Password reset link send to email address");
            }
            else
                return back()->with('warning',"Account is not verified. Please verify account.");
        }
    }

    /**
     * view after the link in the email for password reset
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function resetpassword($token)
    {
        $user = $this->userService->getUser('token',decrypt($token));
        if (!is_null($user)) {
            return view('auth.reset_password', compact('token'));
        }
        return redirect('/')->with('error', 'The password reset link has already been used.');
    }

    public function resetPasswordChange(Request $request)
    {
        $user = User::where('token', decrypt($request->token))->first();
        if ($user == null)
        {
            return redirect('/')->with('warning', 'The link has already been used.');
        }else {
            $reset = $this->userService->passwordReset($request, $user->id);
            if ($reset == true)
                return redirect('/')->with('success', 'Password changed successfully. Please login');
            else
                return back()->with('error', "Password couldnot be changed. Please try again.");
        }

    }


    /**
     * change the password from inside web after login
     * @param Request $request
     * @param $id
     * @return array
     */
    public function changePassword(Request $request, $id)
    {
        if ($user = $this->userService->changePassword($request, $id)) {
            $response = [
                "code" => 200,
                "message" => "Password changed successfully."
            ];
        }else
            $response = [
                "code" => 500,
                "message" => "Password changing couldn\'t be completed"
            ];
        return $response;
    }
}
