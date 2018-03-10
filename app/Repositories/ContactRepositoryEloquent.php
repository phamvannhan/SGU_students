<?php

namespace App\Repositories;

use App\Mail\SendContactEmail;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ContactRepository;
use App\Models\Contact;
use App\Validators\ContactValidator;

/**
 * Class ContactRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ContactRepositoryEloquent extends BaseRepository implements ContactRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Contact::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return ContactValidator::class;
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
        return $this->model->select('*')->with(['user', 'room'])->orderBy('id', 'desc');
    }

    public function create(array $input)
    {
        $user = \Auth::user();
        $input['user_id'] = $user->id;
        $model = $this->model->create($input);
        $input['from_name'] = $user->name;
        \Mail::to($input['to_email'])->send(new SendContactEmail($input));
        return $model;
    }
}
