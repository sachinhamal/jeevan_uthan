<?php

namespace App\Http\Controllers;

use App\BaseDir\Services\UserService;
use Illuminate\Http\Request;
use App\BaseDir\Entities\User;
use Auth;
use Session;
class UserController extends Controller
{

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

   public function index(){
   	return view('user.dashboard.index');
   }

   public function view_profile(){
   	return view('user.dashboard.profile');
   }

   public function update(Request $request){
     // return $request;
     $user=User::find(Auth::user()->id);
     $user->update($request->all());
     Session::flash('message','User profile updated successfully!');
     return redirect()->back();
   }
}
