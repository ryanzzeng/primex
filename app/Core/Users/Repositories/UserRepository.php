<?php

namespace App\Core\Users\Repositories;

use Exception;
use App\Core\Users\User;
use App\Core\Base\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Core\Users\Repositories\Interfaces\UserRepositoryInterface;
use App\Core\Users\Exceptions\UserInvalidArgumentException;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->model = $user;
    }

    public function listUsers():Collection
    {
        return User::all();
    }

    public function createUser(array $params):User
    {
        try{
            $user = new User($params);
            $user->save();
            return $user;
        }catch(QueryException $e)
        {
            throw new UserInvalidArgumentException($e->getMessage());
        }
    }

    public function updateUser(array $params, int $id) : bool
    {
        try{
            $this->update($params,$id);
        }catch (QueryException $e) {
            throw new UserInvalidArgumentException($e->getMessage());
        }
        return true;
    }

    public function deleteUser(int $id):bool
    {
        try{
            $this->delete($id);
        }catch (QueryException $e) {
            throw new UserInvalidArgumentException($e->getMessage());
        }
        return true;
    }

    public function showUser(int $id):Collection
    {
        return $this->findBy(['id' => $id]);
    }
}