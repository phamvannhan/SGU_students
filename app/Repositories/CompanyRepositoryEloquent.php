<?php

namespace App\Repositories;

use App\Jobs\ChatRoomFirebase;
use App\Jobs\CompanyShareCreate;
use App\Models\Company;
use App\Traits\UploadPhotoTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class NewsCategoryRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class CompanyRepositoryEloquent extends BaseRepository implements CompanyRepository
{
    use UploadPhotoTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Company::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        //
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
        return $this->model->select('*')->withCount('users');
    }

    public function create(array $input)
    {
        stringToNumberArray($input, ['total_share', 'price_of_share', 'charter_capital']);

        if (!empty($input["deputy_birthday"])) {
            $input["deputy_birthday"] = cvDbTime($input["deputy_birthday"], PHP_DATE, DB_DATE);
        }

        if (!empty($input["deputy_id_date"])) {
            $input["deputy_id_date"] = cvDbTime($input["deputy_id_date"], PHP_DATE, DB_DATE);
        }

        // Save icon
        if (!empty($input['company_logo'])) {
            $config = config('files.company_logo');

            $info = $this->storePhoto($input['company_logo'], $config);

            $input['logo'] = $info['full_path'];

            unset($input['company_logo']);
        }

        if (!empty($input['company_license_license_front'])) {
            $config = config('files.company_license_license_front');

            $info = $this->storePhoto($input['company_license_license_front'], $config);

            $input['license_license_front'] = $info['full_path'];
        }

        if (!empty($input['company_license_license_backside'])) {
            $config = config('files.company_license_license_backside');

            $info = $this->storePhoto($input['company_license_license_backside'], $config);

            $input['license_license_backside'] = $info['full_path'];
        }

        $model = $this->model->create($input);

        // Create firebase
        dispatch(new ChatRoomFirebase(
            "company_{$model->id}",
            [
                'name' => $model->name,
                'avatar' => $model->logo ? assetStorage($model->logo) : asset(NO_LOGO)
            ],
            'create'
        ));

        return $model;
    }

    public function update(array $input, $id)
    {
        $model = $this->model->findOrFail($id);

        stringToNumberArray($input, ['total_share', 'price_of_share', 'charter_capital']);

        if (!empty($input['delete_logo'])) {
            $this->destroySinglePhoto($input['delete_logo']);
            $input['logo'] = null;
        }

        if (!empty($input['delete_license_license_front'])) {
            $this->destroySinglePhoto($input['delete_license_license_front']);
            $input['license_license_front'] = null;
        }

        if (!empty($input['delete_license_license_backside'])) {
            $this->destroySinglePhoto($input['delete_license_license_backside']);
            $input['license_license_backside'] = null;
        }

        if (!empty($input["deputy_birthday"])) {
            $input["deputy_birthday"] = cvDbTime($input["deputy_birthday"], PHP_DATE, DB_DATE);
        }

        if (!empty($input["deputy_id_date"])) {
            $input["deputy_id_date"] = cvDbTime($input["deputy_id_date"], PHP_DATE, DB_DATE);
        }

        // Save icon
        if (!empty($input['company_logo'])) {
            $config = config('files.company_logo');

            $info = $this->storePhoto($input['company_logo'], $config);

            $input['logo'] = $info['full_path'];
        }

        if (!empty($input['company_license_license_front'])) {
            $config = config('files.company_license_license_front');

            $info = $this->storePhoto($input['company_license_license_front'], $config);

            $input['license_license_front'] = $info['full_path'];
        }

        if (!empty($input['company_license_license_backside'])) {
            $config = config('files.company_license_license_backside');

            $info = $this->storePhoto($input['company_license_license_backside'], $config);

            $input['license_license_backside'] = $info['full_path'];
        }

        $model->update($input);

        dispatch(new ChatRoomFirebase(
            "company_{$model->id}",
            [
                'name' => $model->name,
                'avatar' => $model->logo ? assetStorage($model->logo) : asset(NO_LOGO),
            ],
            'update'
        ));

        return $model;
    }

    public function delete($id)
    {
        $model = $this->model->findOrFail($id);

        $this->destroySinglePhoto($model->logo);

        // Delete firebase
        dispatch(new ChatRoomFirebase("company_{$model->id}", [], 'delete'));

        return $model->delete();
    }

    public function companyShare(array $input)
    {
        $company = $this->model->findOrFail($input['company_id']);
        $percent = $input['percent'];
        $price = $input['price'];

        $charter_capital = $company->charter_capital;

        $price_of_share = $company->price_of_share;

        $total_share = $company->total_share;

        $new_charter_capital = $price / $percent * 100;

        $new_total_share = $new_charter_capital / $price_of_share;

        $excess_share = $new_total_share - $total_share - ($percent / 100 * $new_total_share); // thặng dư cổ phần

        CompanyShareCreate::dispatch($company, [
            'total_share' => $total_share,
            'percent' => $percent,
            'excess_share' => $excess_share
        ])->onQueue('high');

        $company->charter_capital = $new_charter_capital;
        $company->total_share = $new_total_share;
        $company->save();

        $company->companyShareHistory()->create([
            'total_share' => $total_share,
            'price_of_share' => $price_of_share,
            'charter_capital' => $charter_capital,
            'new_total_share' => $new_total_share,
            'new_charter_capital' => $new_charter_capital,
            'percent' => $percent,
            'price' => $price,
        ]);
    }
}
