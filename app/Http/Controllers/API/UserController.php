<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Services\User\CreateUserAccountService;
use App\Services\User\GetUserByIdService;
use App\Services\User\GetUsersService;
use App\Services\User\LoginUserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $createUserAccountService;
    protected $getUserByIdService;
    protected $getUsersService;
    protected $loginUserService;

    public function __construct(
        CreateUserAccountService $createUserAccountService,
        GetUserByIdService $getUserByIdService,
        GetUsersService $getUsersService,
        LoginUserService $loginUserService
    ) {
        $this->createUserAccountService = $createUserAccountService;
        $this->getUserByIdService = $getUserByIdService;
        $this->getUsersService = $getUsersService;
        $this->loginUserService = $loginUserService;
    }

    public function store(CreateUserRequest $request)
    {
        $userAccount = $this->createUserAccountService->execute($request->validated());

        return $this->sendResponse(new UserResource($userAccount), "", 201);
    }

    public function show($id)
    {
        return $this->sendResponse(new UserResource($this->getUserByIdService->execute($id)), "", 200);
    }

    public function index()
    {
        return $this->sendResponse(new UserCollection($this->getUsersService->execute()), "", 200);
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        return $this->sendResponse($this->loginUserService->execute($email, $password), "", 200);
    }
}
