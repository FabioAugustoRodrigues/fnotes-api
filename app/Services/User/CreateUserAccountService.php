<?php

namespace App\Services\User;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class CreateUserAccountService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);

        return $user;
    }
}