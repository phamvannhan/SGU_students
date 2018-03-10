<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserCompanyRepository
 * @package namespace App\Repositories;
 */
interface UserCompanyRepository extends RepositoryInterface
{
    public function datatable(array $input);

    public function companyUser($company_id);

    public function store(array $input);

    public function update(array $input, $id);

    public function delete($id);
}
