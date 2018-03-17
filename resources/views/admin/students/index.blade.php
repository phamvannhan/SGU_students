@extends("admin.layouts.master")

@section("meta")
    <meta name="linkDatatable" content="{{ route('admin.students.datatable') }}"/>
@endsection

@section("style")
    <!--dataTables plugin-->
    <link rel="stylesheet" href="/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"/>
@endsection

@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a href="{!! route("admin.students.create") !!}" class="btn btn-info waves-effect pull-right">
                        <i class="material-icons">add</i>
                        <span>{!! trans("button.create") !!}</span>
                    </a>
                    <h2>
                        {!! trans("admin_students.list") !!}
                    </h2>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-sm-6 col-md-5">
                            <label for="slrole">Chọn Lớp để hiển thị sinh viên</label>
                            <select id="slrole" class="form-control">
                                <option value="">Tất cả các lớp</option>
                                
                            </select>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="body table-responsive">

                    @include("admin.layouts.partials.message")
                    <div>
                        <table id="datatable" class="table table-bordered table-striped table-hover dataTable"
                               style="width: 100%">
                            <thead>
                            <tr>
                                <th width="40">{!! trans("admin_students.table.id") !!}</th>
                                <th>{!! trans("admin_students.table.name") !!}</th>
                                <th>{!! trans("admin_students.table.email") !!}</th>
                                <th>{!! trans("admin_students.table.start_doanvien") !!}</th>
                                <th width="150">{!! trans("admin_students.table.action") !!}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    @include("admin.layouts.partials.modal-delete")

    <!--dataTables plugin-->
    <script src="/assets/plugins/jquery-datatable/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"
            type="text/javascript"></script>

    <script type="text/javascript" src="/assets/admin/js/pages/students.index.js?v=1.1"></script>
@endsection