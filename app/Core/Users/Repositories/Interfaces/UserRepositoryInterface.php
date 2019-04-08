<?php

namespace App\Core\Users\Repositories\Interfaces;

use App\Core\Base\Interfaces\BaseRepositoryInterface;
use App\Core\Users\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function listUsers() : Collection;

    public function createUser(array $data) : User;

    public function updateUser(array $params, int $id) : bool;

    public function deleteUser(int $id):bool;

    public function showUser(int $id):Collection;
}
