<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Breadcrumb;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Models\City;
use App\Models\Permission;
use App\Models\Role;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    protected $user;
    protected $role;

    public function __construct(UserRepository $user, RoleRepository $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_user.title'));

        $roles = Role::all(['id', 'name']);

        return view('admin.user.index', compact('roles'));
    }

    public function datatable(Request $request)
    {
        $role = $request->input('role');
        $data = $this->user->datatable($role);

        return DataTables::of($data)
            ->addColumn('roles_name', function ($data){
                return $data->roles->map(function ($role){
                    return $role->name;
                })->implode(', ');
            })
            ->addColumn(
                'action',
                function ($data) {
                    return view('admin.layouts.partials.table_button')->with(
                        [
                            'link_edit' => route('admin.user.edit', $data->id),
                            'link_delete' => $data->id > 1 ? route('admin.user.destroy', $data->id) : null,
                            'id_delete' => $data->id
                        ]
                    )->render();
                }
            )
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumb::title(trans('admin_user.create'));

        $roles = $this->role->all();

        $config_permissions = config("permission");

        $permissions = Permission::get()->keyBy("slug")->toArray();

        $cities = City::get();

        return view('admin.user.create_edit', compact(
            'roles',
            'config_permissions',
            'permissions',
            'cities'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $input = $request->all();

        $this->user->store($input);

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_user.user')]));

        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Breadcrumb::title(trans('admin_user.edit'));

        $user = $this->user->find($id);

        $roles = $this->role->all();

        $config_permissions = config("permission");

        $permissions = Permission::get()->keyBy("slug")->toArray();

        $user_role = $user->roles()->get()->pluck("id")->toArray();

        $user_permission = $user->userPermissions->keyBy("slug")->toArray();

        $cities = City::get();

        return view(
            'admin.user.create_edit',
            compact(
                'user',
                'roles',
                'config_permissions',
                'user_role',
                'permissions',
                'user_permission',
                'cities'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $this->user->update($input, $id);

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_user.user')]));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_user.user')]));

        return redirect()->back();
    }
}
