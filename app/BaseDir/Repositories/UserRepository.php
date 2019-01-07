<?php
/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 12/2/18
 * Time: 4:00 PM
 */

namespace App\BaseDir\Repositories;


use App\BaseDir\Entities\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository
{

    function getModel()
    {
        return User::class;
    }

    public function passwordResetRepo($request, $id)
    {
        try {
            $user = $this->model->find($id);
            $user->password = bcrypt($request->password);
            $user->token = null;
            $user->update();
            return $user;
        } catch (QueryException $e) {
            return false;
        }
    }





}