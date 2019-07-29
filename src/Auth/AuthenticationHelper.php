<?php
/**
 * Created by PhpStorm.
 * User: lekha
 * Date: 29.07.2019
 * Time: 11:04
 */

namespace App\Auth;

use App\Exceptions\AuthException;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UsersRepository;

class AuthenticationHelper
{
    public function __construct(UsersRepository $usersRepository, Request $request)
    {
        $this->usersRepository = $usersRepository;
        $this->request = $request;
    }

    public function authenticate($credentials)
    {
        $authResult = $this->checkCredentials($credentials);

        return $authResult;
    }

    private function checkCredentials($credentials)
    {
        $user = $this->usersRepository->findOneBy(['login' => $credentials['login']]);
        if($user) {
            $result = $this->checkHash($credentials['password'], $user->getPassword());
            return $result;
        }

        return false;
    }

    private function checkHash($password, $hash)
    {
        if(hash('sha256', $password) == $hash) {
            return true;
        }

        return false;
    }

}
