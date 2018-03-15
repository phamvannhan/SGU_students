<?php

namespace App\Repositories;

use App\Traits\UploadPhotoTrait;
use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StudentsRepository;
use App\Models\Students;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class StudentsRepositoryEloquent extends BaseRepository implements StudentsRepository
{
    use UploadPhotoTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Students::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
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
        $model = $this->model->select('id', 'name', 'email', 'start_doanvien');
        
        return $model;
    }

    public function store(array $input)
    {
        
    }

    public function update(array $input, $id)
    {
        
    }

    public function delete($id)
    {
        
    }

   
}
