<?php

namespace App\Core\Users\Repositories\Interfaces;

use App\Core\Users\User;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Core\Base\Interfaces\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function listUsers(int $perPage = 10):LengthAwarePaginator;

    public function createUser(array $data) : User;

    public function updateUser(array $params, int $id) : bool;

    public function deleteUser(int $id):bool;

    public function showUser(int $id):Collection;
}
