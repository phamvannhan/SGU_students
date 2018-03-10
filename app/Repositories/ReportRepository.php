<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ReportRepository
 * @package namespace App\Repositories;
 */
interface ReportRepository extends RepositoryInterface
{
    public function reportByType($type);

    public function emailReport($id);

    public function datatable();

    public function store(array $input);

    public function update(array $input, $id);

    public function destroy($id);
}
