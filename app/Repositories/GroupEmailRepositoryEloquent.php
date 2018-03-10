<?php

namespace App\Repositories;

use App\Jobs\GroupEmailJob;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GroupEmailRepository;
use App\Models\GroupEmail;
use App\Validators\EmailGroupValidator;

/**
 * Class EmailGroupRepositoryEloquent
 * @package namespace App\Repositories;
 */
class GroupEmailRepositoryEloquent extends BaseRepository implements GroupEmailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GroupEmail::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return EmailGroupValidator::class;
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
        return $this->model->select('*')->withCount(['users']);
    }

    public function create(array $input)
    {
        $model = $this->model->create($input);

        if (!empty($input['users'])) {
            $model->users()->attach($input['users']);
        }
        // Sent email
        if ($input['status'] === GroupEmail::STATUS_SENT) {
            GroupEmailJob::dispatch($model)->onQueue('default');
        }

        return $model;
    }

    public function update(array $input, $id)
    {
        $model = $this->model->findOrfail($id);

        $status = $model->status;

        if ($status === GroupEmail::STATUS_SENT) {
            return $model;
        }

        $model->update($input);

        if ($status == GroupEmail::STATUS_DRAFT) {
            if (!empty($input['users'])) {
                $model->users()->sync($input['users']);
            }
            // Sent email
            if ($input['status'] === GroupEmail::STATUS_SENT) {
                GroupEmailJob::dispatch($model)->onQueue('default');
            }
        }

        return $model;
    }
}
