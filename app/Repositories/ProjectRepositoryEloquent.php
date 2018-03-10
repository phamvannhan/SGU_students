<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProjectRepository;
use App\Models\Project;
use App\Validators\ProjectValidator;
use App\Traits\UploadPhotoTrait;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    use UploadPhotoTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return ProjectValidator::class;
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

    public function search(array $input)
    {
        $model = $this->model->select('*')->active();

        $model->orderBy('id', 'desc');

        return $model->paginate(10);
    }

    public function getList($limit)
    {
        return $this->model->select('*')->active()
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->get();
    }

    public function create(array $input)
    {
        $input['active'] = !empty($input['active']) ? 1 : 0;

        $this->savePhotos($input);

        $model = $this->model->create($input);

        $this->saveGallery($model, $input);

    }

    public function update(array $input, $id)
    {
        $input['active'] = !empty($input['active']) ? 1 : 0;

        $model = $this->model->findOrFail($id);

        $this->savePhotos($input);

        $model->update($input);

        $this->saveGallery($model, $input);

        return $model;

    }

    public function delete($id)
    {
        $model = $this->model->findOrFail($id);

        $this->destroySinglePhoto($model->image, true);
        $this->destroySinglePhoto($model->ground_plan);
        $this->destroySinglePhoto($model->progress);

        foreach ($model->images as $rs) {
            $this->destroySinglePhoto($rs->path);
        }

        return $model->delete();
    }

    private function savePhotos(&$input)
    {
        if (!empty($input['delete_image'])) {
            $this->destroySinglePhoto($input['delete_image'], true);
            $input['image'] = null;
        }

        if (!empty($input['delete_ground_plan'])) {
            $this->destroySinglePhoto($input['delete_ground_plan']);
            $input['ground_plan'] = null;
        }

        if (!empty($input['delete_progress'])) {
            $this->destroySinglePhoto($input['delete_progress']);
            $input['progress'] = null;
        }

        // Save photo
        if (!empty($input['project_image'])) {
            $config = config('files.project_image');
            $info = $this->storePhoto($input['project_image'], $config);
            $input['image'] = $info['full_path'];
            unset($input['project_image']);
        }

        if (!empty($input['project_ground_plan'])) {
            $config = config('files.project_ground_plan');
            $info = $this->storePhoto($input['project_ground_plan'], $config);
            $input['ground_plan'] = $info['full_path'];
            unset($input['project_ground_plan']);
        }

        if (!empty($input['project_progress'])) {
            $config = config('files.project_progress');
            $info = $this->storePhoto($input['project_progress'], $config);
            $input['progress'] = $info['full_path'];
            unset($input['project_progress']);
        }
    }

    public function saveGallery($model, array $input)
    {
        if (!empty($input['delete_photos'])) {
            $galleries = $model->images()->whereIn('id', $input['delete_photos'])->get();
            foreach ($galleries as $rs) {
                $this->destroySinglePhoto($rs->path); // remove image
                $rs->delete(); // remove data
            }
        }

        $model->youtubes()->delete();

        if (!empty($input['photos'])) {
            foreach ($input['photos'] as $value) {
                $config = config('files.project_gallery_image');
                $info = $this->storePhoto($value, $config);
                $arr = [
                    'path' => $info['full_path'],
                    'type' => 'image',
                ];
                $model->galleries()->create($arr);
            }
        }

        if (!empty($input['youtube'])) {
            $arr = explode(',', $input['youtube']);
            foreach ($arr as $value) {
                $arrYoutube = [
                    'path' => $value,
                    'type' => 'youtube',
                ];
                $model->galleries()->create($arrYoutube);
            }
        }
    }
}
