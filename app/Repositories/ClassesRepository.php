<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface NewsRepository
 *
 * @package namespace App\Repositories;
 */
interface ClassesRepository extends RepositoryInterface
{
    public function datatable();

    public function store(array $input);

    public function update(array $input, $id);

    public function destroy($id);
}
