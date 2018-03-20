<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Breadcrumb;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Models\City;
use App\Repositories\StudentsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\ClassesRepository;

class StudentsController extends Controller
{
    protected $students;

    public function __construct(StudentsRepository $students, ClassesRepository $classes)
    {
        $this->students = $students;
        $this->classes = $classes;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_students.title'));

        return view('admin.students.index');
      
    }

    public function datatable(Request $request)
    {
        
        $data = $this->students->datatable();

        return DataTables::of($data)
            ->addColumn(
                'action',
                function ($data) {
                    return view('admin.layouts.partials.table_button')->with(
                        [
                            'link_edit' => route('admin.students.edit', $data->id),
                            'link_delete' => $data->id > 1 ? route('admin.students.destroy', $data->id) : null,
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
        Breadcrumb::title(trans('admin_students.create'));

        $classes = $this->classes->all();

        return view('admin.students.create_edit', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $input = $request->all();

       $this->students->store($input);

       session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_students.students')]));

        return redirect()->route('admin.students.index');
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
