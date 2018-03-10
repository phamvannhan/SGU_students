@extends("admin.layouts.master")

@section("meta")
    <meta name="linkDatatable" content="{{ route('admin.group_phone.datatbase_show', $group_phone->id) }}"/>
@endsection

@section("style")
    <link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
    <!--dataTables plugin-->
    <link rel="stylesheet" href="/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"/>
@endsection


@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a href="{!! route("admin.group_phone.index") !!}" class="btn btn-info waves-effect pull-right">
                        <i class="material-icons">keyboard_backspace</i>
                        <span>{!! trans("button.back") !!}</span>
                    </a>
                    <h2>
                        {!! trans("admin_group_phone.list") !!}
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="body table-responsive">

                    @include("admin.layouts.partials.message")
                    <div>
                        <table id="datatable" class="table table-bordered table-striped table-hover dataTable"
                           style="width: 100%">
                        <thead>
                        <tr>
                            <th width="40">{!! trans("admin_group_phone.table.id") !!}</th>
                            <th>{!! trans("admin_group_phone.table.name") !!}</th>
                            <th>{!! trans("admin_group_phone.table.phone") !!}</th>
                            <th>{!! trans("admin_group_phone.table.note") !!}</th>
                            <th>{!! trans("admin_group_phone.table.called_at") !!}</th>
                            <th>{!! trans("admin_group_phone.table.status") !!}</th>
                            <th width="150">{!! trans("admin_group_phone.table.action") !!}</th>
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
    @include("admin.group_phone.partials.modal_user_note")

    <script type="text/javascript" src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!--dataTables plugin-->
    <script src="/assets/plugins/jquery-datatable/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"
            type="text/javascript"></script>
    <script type="text/javascript" src="/assets/admin/js/pages/group_phone.show.js?v=1.0"></script>
@endsection