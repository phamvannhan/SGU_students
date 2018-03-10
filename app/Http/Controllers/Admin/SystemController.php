<?php

namespace App\Http\Controllers\Admin;

use App\Models\System;
use App\Repositories\SystemRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Breadcrumb;
use App\Repositories\RoleRepository;

class SystemController extends Controller
{
    protected $system;

    public function __construct(SystemRepository $system, RoleRepository $role)
    {
        $this->system = $system;
        $this->role = $role;
    }

    public function edit($id)
    {
        Breadcrumb::title(trans('admin_system.title'));
        $roles = $this->role->all();

        $system = $this->system->all()->keyBy('key')->toArray();

        return view("admin.system.edit", compact("system","roles"));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $this->system->update($input, $id);

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_system.system')]));

        return redirect()->route('admin.system.edit', 'dalathasfarm');
    }
}
