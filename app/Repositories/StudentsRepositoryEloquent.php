<?php

namespace App\Repositories;

use App\Traits\UploadPhotoTrait;
use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StudentsRepository;
use App\Models\Students;
use App\Models\Classes;

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
        $model = $this->model->select('id', 'name', 'email', 'start_doanvien')->get();
        
        return $model;
    }

    public function store(array $input)
    {
        $input["password"] = \Hash::make($input["password"]);

        $input["active"] = !empty($input["active"]) ? 1 : 0;

        $input["active_code"] = uniqid("", true);

        if (!empty($input["birthday"])) {
            $input["birthday"] = cvDbTime($input["birthday"], PHP_DATE, DB_DATE);
        }

        if (!empty($input["id_number_date"])) {
            $input["id_number_date"] = cvDbTime($input["id_number_date"], PHP_DATE, DB_DATE);
        }

        // cmnd
        if (!empty($input['user_front_id'])) {

            $config = config('files.user_cmnd');

            $info = $this->storePhoto($input['user_front_id'], $config);

            $input['front_id'] = $info['full_path'];
        }

        if (!empty($input['user_backside_id'])) {
            $config = config('files.user_cmnd');

            $info = $this->storePhoto($input['user_backside_id'], $config);

            $input['backside_id'] = $info['full_path'];
        }

        if (!empty($input['user_avatar'])) {
            $config = config('files.user_avatar_admin');

            $info = $this->storePhoto($input['user_avatar'], $config);

            $input['avatar'] = $info['full_path'];
        }


        $user = $this->model->create($input);


        return $user;
    }

    public function update(array $input, $id)
    {
        
    }

    public function delete($id)
    {
        
    }

   
}
