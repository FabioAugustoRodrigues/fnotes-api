<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Services\User\CreateUserAccountService;
use App\Services\User\GetUserByIdService;
use App\Services\User\GetUsersService;
use App\Services\User\LoginUserService;
use App\Services\User\UpdateUserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $createUserAccountService;
    protected $getUserByIdService;
    protected $getUsersService;
    protected $loginUserService;
    protected $updateUserService;

    public function __construct(
        CreateUserAccountService $createUserAccountService,
        GetUserByIdService $getUserByIdService,
        GetUsersService $getUsersService,
        LoginUserService $loginUserService,
        UpdateUserService $updateUserService
    ) {
        $this->createUserAccountService = $createUserAccountService;
        $this->getUserByIdService = $getUserByIdService;
        $this->getUsersService = $getUsersService;
        $this->loginUserService = $loginUserService;
        $this->updateUserService = $updateUserService;
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

    public function me(Request $request)
    {
        return $this->sendResponse($request->user(), "", 200);
    }

    public function update(UpdateUserRequest $request)
    {
        return $this->sendResponse(new UserResource($this->updateUserService->execute($request->user()->id, $request->validated())), "", 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->sendResponse(null, "Logout efetuado com sucesso", 200);
    }
}
