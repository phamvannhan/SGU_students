<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ContactRoomRepository;
use App\Models\ContactRoom;
use App\Validators\ContactRoomValidator;

/**
 * Class ContactRoomRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ContactRoomRepositoryEloquent extends BaseRepository implements ContactRoomRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ContactRoom::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ContactRoomValidator::class;
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
        return $this->model->select('*');
    }
}
