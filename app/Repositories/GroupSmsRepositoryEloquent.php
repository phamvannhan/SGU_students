<?php

namespace App\Repositories;

use App\Jobs\GroupSmsJob;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GroupSmsRepository;
use App\Models\GroupSms;
use App\Validators\SmsGroupValidator;

/**
 * Class SmsGroupRepositoryEloquent
 * @package namespace App\Repositories;
 */
class GroupSmsRepositoryEloquent extends BaseRepository implements GroupSmsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GroupSms::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return SmsGroupValidator::class;
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
        // Sent email, phone
        if ($input['status'] === GroupSms::STATUS_SENT) {
            GroupSmsJob::dispatch($model)->onQueue('default');
        }

        return $model;
    }

    public function update(array $input, $id)
    {
        $model = $this->model->findOrfail($id);

        $status = $model->status;

        if ($status === GroupSms::STATUS_SENT) {
            return $model;
        }

        $model->update($input);

        if ($status == GroupSms::STATUS_DRAFT) {
            if (!empty($input['users'])) {
                $model->users()->sync($input['users']);
            }
            // Sent email
            if ($input['status'] === GroupSms::STATUS_SENT) {
                GroupSmsJob::dispatch($model)->onQueue('default');
            }
        }

        return $model;
    }
}
