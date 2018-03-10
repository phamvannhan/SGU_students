<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GroupPhoneRepository;
use App\Models\GroupPhone;
use App\Validators\PhoneGroupValidator;

/**
 * Class PhoneGroupRepositoryEloquent
 * @package namespace App\Repositories;
 */
class GroupPhoneRepositoryEloquent extends BaseRepository implements GroupPhoneRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GroupPhone::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PhoneGroupValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function datatable()
    {
        return $this->model->select('*')->withCount(['users']);
    }

    public function create(array $input)
    {
        $model = $this->model->create($input);

        if (!empty($input['users'])) {
            $model->users()->attach($input['users']);
        }

        return $model;
    }

    public function update(array $input, $id)
    {
        $model = $this->model->findOrfail($id);

        $model->update($input);

        if (!empty($input['users'])) {
            $model->users()->sync($input['users']);
        }

        return $model;
    }
}
