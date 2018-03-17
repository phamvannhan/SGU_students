<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ClassesRepository;
use App\Models\Classes;
use App\Models\Major;
//use App\Validators\ClassValidator;

/**
 * Class NewsRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class ClassesRepositoryEloquent extends BaseRepository implements ClassesRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Classes::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
   /* public function validator()
    {
        return ClassValidator::class;
    }*/


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function datatable()
    {
        return $this->model->select('*');
    }

    public function store(array $input)
    {
        $input['major_id'] = 1;
        $classes = $this->model->create($input);

        return $classes;
    }

    public function update(array $input, $id)
    {
        $classes = $this->model->findOrFail($id);

        $classes->update($input);

        return $classes;
    }

    public function destroy($id)
    {
        $classes = $this->model->findOrFail($id);

        $classes->delete();

        return true;
    }
}
