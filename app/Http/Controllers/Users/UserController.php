<?php

namespace App\Http\Controllers;

use App\Core\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\HttpResponse;
use App\Core\Users\Requests\CreateUserRequest;
use App\Core\Users\Requests\UpdateUserRequest;
use App\Core\Users\Requests\ShowUserRequest;
use App\Core\Users\Requests\DeleteUserRequest;
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $perPage = $request->get('perPage', 10);
        $users = $this->UserRepo->listUsers($perPage);
        return HttpResponse::success(array($users), 'List users successfully!');
    }

    /**
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateUserRequest $request)
    {
        $user = $this->UserRepo->createUser($request->all());
        return HttpResponse::success(array($user), 'Create user successfully!');
    }

    /**
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request)
    {
        $status = $this->UserRepo->updateUser($request->all(),$request->user_id);
        $data = [
            'user_id' => $request->user_id,
            'status' => $status
        ];
        return HttpResponse::success($data, 'Update user successfully!');
    }

    /**
     * @param DeleteUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(DeleteUserRequest $request)
    {
        $status = $this->UserRepo->deleteUser($request->user_ids);
        $data = [
            'user_id' => $request->user_ids,
            'status' => $status
        ];
        return HttpResponse::success($data, 'Delete user successfully!');
    }

    /**
     * @param ShowUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ShowUserRequest $request)
    {
        $user = $this->UserRepo->showUser($request->user_id);
        return HttpResponse::success(array($user), 'Show user successfully!');
    }
}
