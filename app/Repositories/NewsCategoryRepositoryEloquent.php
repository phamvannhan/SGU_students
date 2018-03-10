<?php

namespace App\Repositories;

use App\Traits\UploadPhotoTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\NewsCategoryRepository;
use App\Models\NewsCategory;
use App\Validators\NewsCategoryValidator;

/**
 * Class NewsCategoryRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class NewsCategoryRepositoryEloquent extends BaseRepository implements NewsCategoryRepository
{
    use UploadPhotoTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return NewsCategory::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return NewsCategoryValidator::class;
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

    public function store(array $input)
    {
        // Save icon
        if (!empty($input['category_icon'])) {
            $config = config('files.news_category_icon');

            $info = $this->storePhoto($input['category_icon'], $config);

            $input['icon'] = $info['full_path'];
        }

        return $this->model->create($input);
    }

    public function update(array $input, $id)
    {
        $category = $this->model->findOrFail($id);

        if (!empty($input['delete_icon'])) {
            $this->destroySinglePhoto($input['delete_icon']);
            $input['icon'] = null;
        }

        // Save icon
        if (!empty($input['category_icon'])) {
            $config = config('photos.news_category_icon');

            $info = $this->storePhoto($input['category_icon'], $config);

            $input['icon'] = $info['full_path'];
        }

        $category = $category->update($input);

        return $category;
    }

    public function destroy($id)
    {
        $category = $this->model->findOrFail($id);

        if (!empty($category->icon)) {
            $this->destroySinglePhoto($category->icon);
        }
        return $category->delete();
    }
}
