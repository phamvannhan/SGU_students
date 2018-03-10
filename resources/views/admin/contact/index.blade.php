@extends("admin.layouts.master")

@section("meta")
    <meta name="linkDatatable" content="{{ route('admin.contact.datatable') }}"/>
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
                    <h2>
                        {!! trans("admin_contact.list") !!}
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="body">
                    <table id="datatable" class="table table-bordered table-striped table-hover dataTable"
                           style="width: 100%">
                        <thead>
                        <tr>
                            <th width="40">{!! trans("admin_contact.table.id") !!}</th>
                            <th>{!! trans("admin_contact.table.name") !!}</th>
                            <th>{!! trans("admin_contact.table.title") !!}</th>
                            <th>{!! trans("admin_contact.table.room") !!}</th>
                            <th>{!! trans("admin_contact.table.created_at") !!}</th>
                            <th width="150">{!! trans("admin_contact.table.action") !!}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    @include("admin.layouts.partials.modal-delete")

    <custtom id="details-template" class="hidden">
        <p><strong>{!! trans("admin_contact.table.content") !!}:</strong></p>
        <p>CONTACT_CONTENT </p>
    </custtom>

    <!--dataTables plugin-->
    <script src="/assets/plugins/jquery-datatable/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"
            type="text/javascript"></script>

    <script type="text/javascript" src="/assets/admin/js/pages/contact.index.js?v=1.0"></script>
@endsection