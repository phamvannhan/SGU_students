<?php

namespace App\Repositories;

use App\Traits\UploadPhotoTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SeminarRepository;
use App\Models\Seminar;
use App\Validators\SeminarValidator;

/**
 * Class SeminarRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SeminarRepositoryEloquent extends BaseRepository implements SeminarRepository
{
    use UploadPhotoTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Seminar::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return SeminarValidator::class;
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
        return $this->model->select('*')->orderBy('id', 'desc');
    }

    public function search(array $input)
    {
        $model = $this->model->select('*')->active();

        if (!empty($input['type'])) {
            $model->where('type', $input['type']);
        }

        $model->orderBy('start_time', 'desc');

        return $model->paginate(10);
    }

    public function getList($limit)
    {
        return $this->model->select('*')->active()
            ->orderBy('start_time', 'desc')
            ->limit($limit)
            ->get();
    }

    public function create(array $input)
    {
        $input['active'] = !empty($input['active']) ? 1 : 0;

        $input['start_time'] = cvDbTime($input['start_time'], PHP_DATE_TIME, DB_TIME);

        // Save photo
        if (!empty($input['seminar_image'])) {
            $config = config('files.seminar_image');

            $info = $this->storePhoto($input['seminar_image'], $config);

            $input['image'] = $info['full_path'];
        }
        return $this->model->create($input);
    }

    public function update(array $input, $id)
    {
        $model = $this->model->findOrFail($id);

        $input['active'] = !empty($input['active']) ? 1 : 0;

        $input['start_time'] = cvDbTime($input['start_time'], PHP_DATE_TIME, DB_TIME);

        if (!empty($input['delete_image'])) {
            $this->destroySinglePhoto($input['delete_image'], true);
            $input['image'] = null;
        }

        // Save photo
        if (!empty($input['seminar_image'])) {
            $config = config('files.seminar_image');

            $info = $this->storePhoto($input['seminar_image'], $config);

            $input['image'] = $info['full_path'];
        }

        $model->update($input);

        return $model;
    }

    public function delete($id)
    {
        $model = $this->model->findOrFail($id);

        $this->destroySinglePhoto($model->image, true);

        $model->delete();

        return true;
    }
}
