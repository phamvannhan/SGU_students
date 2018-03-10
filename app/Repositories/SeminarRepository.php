<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SeminarRepository
 * @package namespace App\Repositories;
 */
interface SeminarRepository extends RepositoryInterface
{
    public function datatable();

    public function search(array $input);

    public function getList($limit);
}
