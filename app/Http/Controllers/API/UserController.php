<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\User\CreateUserRequest;
use App\Services\User\CreateUserAccountService;
use App\Services\User\GetUserByIdService;
use App\Services\User\GetUsersService;

class UserController extends BaseController
{
    protected $createUserAccountService;
    protected $getUserByIdService;
    protected $getUsersService;

    public function __construct(
        CreateUserAccountService $createUserAccountService,
        GetUserByIdService $getUserByIdService,
        GetUsersService $getUsersService
    ) {
        $this->createUserAccountService = $createUserAccountService;
        $this->getUserByIdService = $getUserByIdService;
        $this->getUsersService = $getUsersService;
    }

    public function store(CreateUserRequest $request)
    {
        $userAccount = $this->createUserAccountService->execute($request->validated());

        return $this->sendResponse(['user_account' => $userAccount], "", 201);
    }

    public function show($id)
    {
        return $this->sendResponse($this->getUserByIdService->execute($id), "", 200);
    }

    public function index()
    {
        return $this->sendResponse($this->getUsersService->execute(), "", 200);
    }
}
