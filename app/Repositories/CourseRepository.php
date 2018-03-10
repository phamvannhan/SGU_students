<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CourseRepository
 * @package namespace App\Repositories;
 */
interface CourseRepository extends RepositoryInterface
{
    public function datatable();

    public function addUsersToCource(array $input);
}
