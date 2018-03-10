<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SystemRepository
 * @package namespace App\Repositories;
 */
interface SystemRepository extends RepositoryInterface
{
    public function update(array $input, $id);
}
