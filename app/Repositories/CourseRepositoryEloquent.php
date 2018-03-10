<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CourseRepository;
use App\Models\Course;
use App\Validators\CourseValidator;
use App\Traits\UploadPhotoTrait; //su dung upload anh

/**
 * Class CourseRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CourseRepositoryEloquent extends BaseRepository implements CourseRepository
{
    use UploadPhotoTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Course::class;
    }


    public function validator()
    {

        return CourseValidator::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function datatable()
    {
        return $this->model->select('*')->with('city')->withCount('users');
    }

    public function create(array $input)
    {
        $this->savePhotos($input);

        $input['start_date'] = !empty($input['start_date']) ? cvDbTime($input['start_date'], PHP_DATE, DB_DATE) : null;

        $model =  $this->model->create($input);

        if(!empty($input['users'])){
            $model->users()->sync($input['users']);
        }
        return $model;
    }

    private function savePhotos(&$input)
    {
        if (!empty($input['delete_image_pro1'])) {
            $this->destroySinglePhoto($input['delete_image_pro1']);
            $input['image_pro1'] = null;
        }

        if (!empty($input['delete_image_pro2'])) {
            $this->destroySinglePhoto($input['delete_image_pro2']);
            $input['image_pro2'] = null;
        }
        if (!empty($input['delete_image_pro3'])) {
            $this->destroySinglePhoto($input['delete_image_pro3']);
            $input['image_pro3'] = null;
        }
        if (!empty($input['delete_image_process1'])) {
            $this->destroySinglePhoto($input['delete_image_process1']);
            $input['image_process1'] = null;
        }

        if (!empty($input['delete_image_process2'])) {
            $this->destroySinglePhoto($input['delete_image_process2']);
            $input['image_process2'] = null;
        }

        if (!empty($input['delete_image_graduate'])) {
            $this->destroySinglePhoto($input['delete_image_graduate']);
            $input['image_graduate'] = null;
        }

        // Save photo pro 1,2,3
        if (!empty($input['course_image_pro1'])) {
            $config = config('files.course_image');
            $info = $this->storePhoto($input['course_image_pro1'], $config);
            $input['image_pro1'] = $info['full_path'];
            unset($input['course_image_pro1']);
        }

        if (!empty($input['course_image_pro2'])) {
            $config = config('files.course_image');
            $info = $this->storePhoto($input['course_image_pro2'], $config);
            $input['image_pro2'] = $info['full_path'];
            unset($input['course_image_pro2']);
        }
        if (!empty($input['course_image_pro3'])) {
            $config = config('files.course_image');
            $info = $this->storePhoto($input['course_image_pro3'], $config);
            $input['image_pro3'] = $info['full_path'];
            unset($input['course_image_pro3']);
        }
        // Save photo process 1,2

        if (!empty($input['course_image_process1'])) {
            $config = config('files.course_image');
            $info = $this->storePhoto($input['course_image_process1'], $config);
            $input['image_process1'] = $info['full_path'];
            unset($input['course_image_process1']);
        }

        if (!empty($input['course_image_process2'])) {
            $config = config('files.course_image');
            $info = $this->storePhoto($input['course_image_process2'], $config);
            $input['image_process2'] = $info['full_path'];
            unset($input['course_image_process2']);
        }
        // Save photo graduate
        if (!empty($input['course_image_graduate'])) {
            $config = config('files.course_image');
            $info = $this->storePhoto($input['course_image_graduate'], $config);
            $input['image_graduate'] = $info['full_path'];
            unset($input['course_image_graduate']);
        }
    }

    public function update(array $input, $id)
    {
        $model = $this->model->findOrFail($id);

        $this->savePhotos($input);

        $input['start_date'] = !empty($input['start_date']) ? cvDbTime($input['start_date'], PHP_DATE, DB_DATE) : null;

        $model->update($input);

        if(!empty($input['users'])){
            $model->users()->sync($input['users']);
        }
        else{
            $model->users()->detach();
        }
        return $model;

    }

    public function delete($id)
    {
        $model = $this->model->findOrFail($id);

        $this->destroySinglePhoto($model->image_pro1);
        $this->destroySinglePhoto($model->image_pro2);
        $this->destroySinglePhoto($model->image_pro3);
        $this->destroySinglePhoto($model->image_process1);
        $this->destroySinglePhoto($model->image_process2);
        $this->destroySinglePhoto($model->image_graduate);

        return $model->delete();
    }

    public function addUsersToCource(array $input)
    {
        $course = $this->model->findOrFail($input['course']);

        $course->users()->sync($input['users']);
    }
}
