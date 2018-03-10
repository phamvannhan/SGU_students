<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PayInterestRepository;
use App\Models\PayInterest;
use App\Validators\PayInterestValidator;

/**
 * Class PayInterestRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PayInterestRepositoryEloquent extends BaseRepository implements PayInterestRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PayInterest::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return PayInterestValidator::class;
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
            ->with(['company', 'user.city']);
        if (!empty($input['company'])) {
            $model->where('company_id', $input['company']);
        }
        if (!empty($input['date_pay'])) {
            $date_from = cvDbTime($input['date_pay'], 'm-Y', 'Y-m-01'); // Đầu tháng
            $date_to = cvDbTime($input['date_pay'], 'm-Y', 'Y-m-t') ; // Cuối tháng
            $model->where('date_pay', '>=', $date_from)
                ->where('date_pay', '<=', $date_to);
        }

        return $model->orderBy('id', 'asc');
    }

    public function history($company_id, $user_id)
    {
        $pay_interest = $this->model->select('date_pay', 'real_interest')
            ->where('company_id', $company_id)
            ->where('user_id', $user_id)
            ->where('status', 'done')
            ->get();
        return $pay_interest;

    }

    public function update(array $input, $id)
    {
        stringToNumberArray($input, 'real_interest');

        $model = $this->model->find($id);
        $company = $model->company;
        $user = $model->user;
        $monthly_interest = ($model->amount_of_investment && $company->fixed_money) ? $model->amount_of_investment * $company->fixed_money / 100 / 12 : null;

        $model->monthly_interest = $monthly_interest;
        $model->fixed_money = $company->fixed_money;
        $model->real_interest = $input['real_interest'];
        $model->date_pay = cvDbTime($input['date_pay'], PHP_DATE, DB_DATE);
        $model->bank_number = $user->bank_number;
        $model->bank_name = $user->bank_name;
        $model->bank_branch = $user->bank_branch;
        $model->status = 'done';
        $model->save();
    }
}
