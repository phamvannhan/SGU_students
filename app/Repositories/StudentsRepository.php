<?php

namespace App\Repositories;

use App\Models\Students;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 * @package namespace App\Repositories;
 */
interface StudentsRepository extends RepositoryInterface
{
    public function datatable();

    public function store(array $attributes);

    public function update(array $attributes, $id);

    public function delete($id);

    
}
