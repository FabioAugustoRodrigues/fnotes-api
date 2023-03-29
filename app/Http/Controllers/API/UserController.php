<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\User\CreateUserRequest;
use App\Services\User\CreateUserAccountService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $createUserAccountService;

    public function __construct(CreateUserAccountService $createUserAccountService)
    {
        $this->createUserAccountService = $createUserAccountService;
    }

    public function store(CreateUserRequest $request)
    {
        $userAccount = $this->createUserAccountService->execute($request->validated());

        return $this->sendResponse(['user_account' => $userAccount], "", 201);
    }
}
