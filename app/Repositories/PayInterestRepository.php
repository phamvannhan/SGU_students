<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PayInterestRepository
 * @package namespace App\Repositories;
 */
interface PayInterestRepository extends RepositoryInterface
{
    public function datatable(array $input);

    public function history($company_id, $user_id);

    public function update(array $input, $id);
}
