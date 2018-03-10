<?php

namespace App\Repositories;

use App\Models\User;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 * @package namespace App\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    public function datatable($role_id);

    public function store(array $attributes);

    public function update(array $attributes, $id);

    public function delete($id);

    public function resetLink($email);

    public function resetPassword($token);

    public function companies(User $user);

    public function updateProfile(array $input, User $user);

    // Lấy danh sách chat != user id
    public function listChat($auth_id, array $friend);

    // Lấy danh sách user chat room
    public function chatRoomUserByIds(array $ids);

    public function userByRoleIds($ids, $select = '*');

    public function userByRoleSlugs($slugs, $select = '*');
}
