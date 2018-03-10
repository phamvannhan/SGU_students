<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProjectRepository
 * @package namespace App\Repositories;
 */
interface ProjectRepository extends RepositoryInterface
{
	public function datatable();

    public function search(array $input);

    public function getList($limit);
}
