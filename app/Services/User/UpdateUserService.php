<?php

namespace App\Services\User;

use App\Exceptions\DomainException;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UpdateUserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $id, array $data)
    {
        $existingUser = $this->userRepository->getById($id);
        if (!$existingUser) {
            throw new DomainException(['User not found'], 404);
        }

        $existingUserByEmail = $this->userRepository->findByEmail($data['email']);
        if ($existingUserByEmail && $existingUserByEmail->id != $id) {
            throw new DomainException(['E-mail is alrady in use.'], 409);
        }

        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->update($id, $data);
    }
}
