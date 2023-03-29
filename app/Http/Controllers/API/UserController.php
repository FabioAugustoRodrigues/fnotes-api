<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\User\CreateUserRequest;
use App\Services\User\CreateUserAccountService;
use App\Services\User\GetUserByIdService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $createUserAccountService;
    protected $getUserByIdService;

    public function __construct(
        CreateUserAccountService $createUserAccountService,
        GetUserByIdService $getUserByIdService
    ) {
        $this->createUserAccountService = $createUserAccountService;
        $this->getUserByIdService = $getUserByIdService;
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
}
