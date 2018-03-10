<?php

namespace App\Repositories;

use App\Mail\ReportAttachFile;
use App\Traits\HandleFIleTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ReportRepository;
use App\Models\Report;
use App\Validators\ReportValidator;

/**
 * Class ReportRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ReportRepositoryEloquent extends BaseRepository implements ReportRepository
{
    use HandleFIleTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Report::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return ReportValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function reportByType($type)
    {
        return $this->model->where('type', $type)->orderBy('report_date', 'asc')->paginate(10);
    }

    public function emailReport($id)
    {
        $auth = \Auth::user();

        $model = $this->model->findOrFail($id);

        \Mail::to($auth->email)->send(new ReportAttachFile($model));
    }

    public function datatable()
    {
        return $this->model->select('*');
    }

    public function store(array $input)
    {
        $this->uploadFile($input);

        if (!empty($input["report_date"])) {
            $input["report_date"] = cvDbTime($input["report_date"], PHP_DATE, DB_DATE);
        }

        return $this->model->create($input);
    }

    public function update(array $input, $id)
    {
        $model = $this->model->findOrFail($id);

        if (!empty($input["report_date"])) {
            $input["report_date"] = cvDbTime($input["report_date"], PHP_DATE, DB_DATE);
        }

        $this->uploadFile($input, $model->path);

        $model->update($input);

        return $model;
    }

    public function uploadFile(&$input, $old_file = null)
    {
        // Save icon
        if (!empty($input['file'])) {
            $config = config('files.report');
            $arr = $this->storeFile($input['file'], $config, $old_file);
            $input['path'] = $arr['path'];
            $input['ext'] = $arr['ext'];
            $input['size'] = $arr['size'];
        }
        return $input;
    }

    public function destroy($id)
    {
        $model = $this->model->findOrFail($id);

        if (!empty($model->path)) {
            \Storage::delete($model->path);
        }
        return $model->delete();
    }
}
