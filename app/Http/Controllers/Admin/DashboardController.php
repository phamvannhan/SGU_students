<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Breadcrumb;
use App\Models\Classes;
use App\Models\Students;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        Breadcrumb::title(trans('admin_dashboard.dashboard'));

       
        $count_students = Students::count();
        $count_classes = Classes::count();
        return view('admin.dashboard.index', compact(
            'count_students', 'count_classes'
        ));
    }
}
