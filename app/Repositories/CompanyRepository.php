<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface NewsCategoryRepository
 *
 * @package namespace App\Repositories;
 */
interface CompanyRepository extends RepositoryInterface
{
    public function datatable();

    public function companyShare(array $input);
}
