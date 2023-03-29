<?php

namespace App\Services\User;

use App\Repositories\UserRepository;

class GetUsersService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute()
    {
        return $this->userRepository->getAll();
    }
}
