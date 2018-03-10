<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SystemRepository;
use App\Models\System;
use App\Validators\SystemValidator;

/**
 * Class SystemRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SystemRepositoryEloquent extends BaseRepository implements SystemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return System::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return SystemValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function update(array $input, $id)
    {
        $system_key = $this->model->system_key;

        if(!empty($input['role_access_app'])){
            $input['role_access_app'] = implode(',', $input['role_access_app']);
        }
        else {
            $input['role_access_app'] = null;
        }

        foreach ($system_key as $key) {
            $this->model->updateOrCreate(
                ["key" => $key],
                ["content" => !empty($input[$key]) ? $input[$key] : null ]
            );
        }
    }
}
