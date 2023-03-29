<?php

namespace App\Services\User;

use App\Exceptions\DomainException;
use App\Models\User;
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
        $existingUser = $this->userRepository->findByEmail($data['email']);
        
        if ($existingUser) {
            throw new DomainException(['E-mail is alrady in use.'], 409);
        }

        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);

        return $user;
    }
}