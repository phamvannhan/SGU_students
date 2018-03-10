<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Breadcrumb;
//use App\Models\News;
use App\Models\User;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        Breadcrumb::title(trans('admin_dashboard.dashboard'));

       
        $count_user = User::count();

        return view('admin.dashboard.index', compact(
            'count_user'
        ));
    }
}
