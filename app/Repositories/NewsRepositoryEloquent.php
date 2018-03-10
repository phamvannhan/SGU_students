<?php

namespace App\Repositories;

use App\Traits\UploadPhotoTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\NewsRepository;
use App\Models\News;
use App\Validators\NewsValidator;

/**
 * Class NewsRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class NewsRepositoryEloquent extends BaseRepository implements NewsRepository
{
    use UploadPhotoTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return News::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return NewsValidator::class;
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
        return $this->model->select('*')->with(['category']);
    }

    public function store(array $input)
    {
        $input['active'] = !empty($input['active']) ? 1 : 0;

        // Save photo
        if (!empty($input['news_image'])) {

            $config = config('files.news_image');

            $info = $this->storePhoto($input['news_image'], $config);

            $input['image'] = $info['full_path'];
        }

        $news = $this->model->create($input);

        return $news;
    }

    public function update(array $input, $id)
    {
        $news = $this->model->findOrFail($id);

        $input['active'] = !empty($input['active']) ? 1 : 0;

        if (!empty($input['delete_image'])) {

            $this->destroySinglePhoto($input['delete_image'], true);

            $input['image'] = null;

        }

        // Save photo
        if (!empty($input['news_image'])) {

            $config = config('files.news_image');

            $info = $this->storePhoto($input['news_image'], $config);

            $input['image'] = $info['full_path'];
        }

        $news->update($input);

        return $news;
    }

    public function destroy($id)
    {
        $news = $this->model->findOrFail($id);

        $this->destroySinglePhoto($news->image, true);

        $news->delete();

        return true;
    }

    public function search(array $input)
    {
        $model = $this->model->active()->with(['category']);

        $limit = 10;

        if (!empty($input['limit'])) {

            $limit = $input['limit'];
            
        }

        $model->orderBy('id', 'asc');

        return $model->paginate($limit);
    }

    public function getList($limit)
    {
        $model = $this->model->active()
            ->orderBy('id', 'asc')
            ->limit($limit)
            ->get();
        return $model;
    }

    public function other($id)
    {
        return $this->model->active()
            ->where('id', '!=', $id)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();
    }
}
