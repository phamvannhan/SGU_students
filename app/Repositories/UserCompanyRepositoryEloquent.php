<?php

namespace App\Repositories;

use App\Jobs\UserInChatRoomFirebase;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserCompanyRepository;
use App\Models\UserCompany;
use App\Validators\UserCompanyValidator;

/**
 * Class UserCompanyRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserCompanyRepositoryEloquent extends BaseRepository implements UserCompanyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserCompany::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return UserCompanyValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function datatable(array $input)
    {
        $model = $this->model->select('*')
            ->with(['user', 'company']);
        if (!empty($input['company'])) {
            $model->where('company_id', $input['company']);
        }
        return $model->orderBy('date_of_investment');
    }

    public function companyUser($company_id)
    {
        $model = $this->model->select('*')
            ->with(['user'])
            ->where('company_id', $company_id)
            ->get();
        return $model;
    }

    public function store(array $input)
    {
        stringToNumberArray($input, ['number_of_share', 'amount_of_investment']);
        if (!empty($input["date_of_investment"])) {
            $input["date_of_investment"] = cvDbTime($input["date_of_investment"], PHP_DATE, DB_DATE);
        }

        $this->model->create($input);

        // Add user to room
        dispatch(new UserInChatRoomFirebase("company_{$input['company_id']}", $input['user_id'], true));
    }

    public function update(array $input, $id)
    {
        $model = $this->model->findOrFail($id);

        stringToNumberArray($input, ['number_of_share', 'amount_of_investment']);

        if (!empty($input["date_of_investment"])) {
            $input["date_of_investment"] = cvDbTime($input["date_of_investment"], PHP_DATE, DB_DATE);
        }


        // Update user in room
        if ($input['company_id'] != $model->company_id) {
            // Xóa user in room cũ
            dispatch(new UserInChatRoomFirebase("company_{$model->company_id}", $model->user_id, null));

            // Add user new room
            dispatch(new UserInChatRoomFirebase("company_{$input['company_id']}", $input['user_id'], true));
        } else {
            // update user in room
            if ($input['user_id'] != $model->user_id) {
                // Xóa user in room cũ
                dispatch(new UserInChatRoomFirebase("company_{$model->company_id}", $model->user_id, null));

                dispatch(new UserInChatRoomFirebase("company_{$model->company_id}", $input['user_id'], true));
            }
        }

        $model->update($input);
    }

    public function delete($id)
    {
        $model = $this->model->findOrFail($id);

        // xóa user chat trong room
        dispatch(new UserInChatRoomFirebase("company_{$model->company_id}", $model->user_id, null));

        $model->delete();
    }
}
