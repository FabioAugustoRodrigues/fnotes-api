<?php

namespace App\Services\User;

use App\Exceptions\DomainException;
use App\Repositories\UserRepository;

class LoginUserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(string $email, string $password)
    {
        $existingUser = $this->userRepository->findByEmail($email);
        if (!$existingUser) {
            throw new DomainException(["Invalid Credentials"], 401);
        }

        if (!password_verify($password, $existingUser->password)) {
            throw new DomainException(["Invalid Credentials"], 401);
        }

        return $existingUser->createToken('auth_token')->plainTextToken;
    }
}
