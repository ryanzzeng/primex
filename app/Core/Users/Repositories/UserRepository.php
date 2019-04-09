<?php

namespace App\Core\Users\Repositories;

use Exception;
use App\Core\Users\User;
use App\Core\Base\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Core\Users\Repositories\Interfaces\UserRepositoryInterface;
use App\Core\Users\Exceptions\UserInvalidArgumentException;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->model = $user;
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function listUsers(int $perPage = 10):LengthAwarePaginator
    {
        $list = User::with(['role:id,name'])->paginate($perPage);
        return $list;
    }

    /**
     * @param array $params
     * @return User
     */
    public function createUser(array $params):User
    {
        try{
            $params['password'] = Hash::make($params['password']);
            $user = new User($params);
            $user->save();
            return $user;
        }catch(QueryException $e)
        {
            throw new UserInvalidArgumentException($e->getMessage());
        }
    }

    /**
     * @param array $params
     * @param int $id
     * @return bool
     */
    public function updateUser(array $params, int $id) : bool
    {
        try{
            if(isset($params['password']))
                $params['password'] = Hash::make($params['password']);

            $this->update($params,$id);
        }catch (QueryException $e) {
            throw new UserInvalidArgumentException($e->getMessage());
        }
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteUser(array $ids):bool
    {
        try{
            User::whereIn('id',$ids)->delete();
        }catch (QueryException $e) {
            throw new UserInvalidArgumentException($e->getMessage());
        }
        return true;
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function showUser(int $id):Collection
    {
        return User::with(['role:id,name'])->whereId($id)->get();
    }
}
