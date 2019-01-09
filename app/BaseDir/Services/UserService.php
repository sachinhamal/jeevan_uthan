<?php
/**
 * User: prakash
 * Date: 1/6/19
 * Time: 10:15 PM
 */

namespace App\BaseDir\Services;


use App\BaseDir\Repositories\UserRepository;

class UserService
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function passwordReset($request, $id)
    {
       return $this->userRepository->passwordResetRepo($request, $id);
    }

    public function getUser($param,$value)
    {
        return $this->userRepository->getBy($param,$value)->first();
    }
}