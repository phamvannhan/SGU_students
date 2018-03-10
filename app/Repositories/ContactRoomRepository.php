<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ContactRoomRepository
 * @package namespace App\Repositories;
 */
interface ContactRoomRepository extends RepositoryInterface
{
    public function datatable();
}
