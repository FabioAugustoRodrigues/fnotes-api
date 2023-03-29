<?php

namespace App\Services\User;

use App\Exceptions\DomainException;
use App\Repositories\UserRepository;

class GetUserByIdService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $id)
    {
        $existingUser = $this->userRepository->getById($id);
        if (!$existingUser) {
            throw new DomainException(['User not found'], 404);
        }

        return $existingUser;
    }
}
