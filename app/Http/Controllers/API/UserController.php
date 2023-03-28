<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Services\User\CreateUserAccountService;

class UserController extends BaseController
{
    protected $createUserAccountService;

    public function __construct(CreateUserAccountService $createUserAccountService)
    {
        $this->createUserAccountService = $createUserAccountService;
    }

    public function store(Request $request)
    {
        try {
            $userAccount = $this->createUserAccountService->execute($request->all());

            return $this->sendResponse(['user_account' => $userAccount], "", 201);
        } catch (\Exception $e) {
            return $this->sendResponse(['error' => $e->getMessage()], "", 500);
        }
    }
}
