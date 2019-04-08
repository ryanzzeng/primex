<?php

namespace App\Http\Controllers;

use App\Core\Users\User;
use App\Http\Controllers\Controller;
use App\Http\Responses\HttpResponse;
use App\Core\Users\Requests\CreateUserRequest;
use App\Core\Users\Requests\UpdateUserRequest;
use App\Core\Users\Requests\GeneralUserRequest;
use App\Core\Users\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private $UserRepo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $UserRepository)
    {
        $this->UserRepo = $UserRepository;
    }

    public function list()
    {
        $users = $this->UserRepo->listUsers();
        return HttpResponse::success(array($users), 'List users successfully!');
    }

    public function create(CreateUserRequest $request)
    {
        $user = $this->UserRepo->createUser($request->all());
        return HttpResponse::success(array($user), 'Create user successfully!');
    }

    public function update(UpdateUserRequest $request)
    {
        $status = $this->UserRepo->updateUser($request->all(),$request->user_id);
        $data = [
            'user_id' => $request->user_id,
            'status' => $status
        ];
        return HttpResponse::success($data, 'Update user successfully!');
    }

    public function delete(GeneralUserRequest $request)
    {
        $status = $this->UserRepo->deleteUser($request->user_id);
        $data = [
            'user_id' => $request->user_id,
            'status' => $status
        ];
        return HttpResponse::success($data, 'Delete user successfully!');
    }

    public function show(GeneralUserRequest $request)
    {
        $user = $this->UserRepo->showUser($request->user_id);
        return HttpResponse::success(array($user), 'Show user successfully!');
    }
}