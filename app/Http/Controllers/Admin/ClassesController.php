<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Breadcrumb;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\ClassesRepository;

class classesController extends Controller
{
    
    protected $classes;

    public function __construct(ClassesRepository $classes)
    {
        $this->classes = $classes;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_classes.title'));
        return view('admin.classes.index');
    }


    public function datatable()
    {
        $data = $this->classes->datatable();
        return DataTables::of($data)
            
            ->addColumn(
                'action',
                function ($data) {
                    return view('admin.layouts.partials.table_button')->with(
                        [
                            'link_edit' => route('admin.classes.edit', $data->id),
                            'link_delete' => route('admin.classes.destroy', $data->id),
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
        Breadcrumb::title(trans('admin_classes.create'));
        return view('admin.classes.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $this->classes->store($input);

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_classes.classes')]));

        return redirect()->route('admin.classes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Breadcrumb::title(trans('admin_classes.edit'));

        $classes = $this->classes->find($id);

        $categories = $this->category->all();

        $metadata = $news->meta;

        return view('admin.news.create_edit', compact('news', 'categories', 'metadata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
