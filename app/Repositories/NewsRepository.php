<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface NewsRepository
 *
 * @package namespace App\Repositories;
 */
interface NewsRepository extends RepositoryInterface
{
    public function datatable();

    public function store(array $input);

    public function update(array $input, $id);

    public function destroy($id);

    public function search(array $input);

    public function other($id);

    public function getList($limit);
}
