@extends("admin.layouts.master")

@section("meta")
    <meta name="linkDatatable" content="{{ route('admin.group_sms.users') }}"/>
@endsection

@section("style")
    <!--dataTables plugin-->
    <link rel="stylesheet" href="/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"/>
    <!--select 2 plugin-->
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css"/>
@endsection


@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">

                    @include("admin.layouts.partials.message")

                    @if(!empty($group_sms))
                        <form id="form-form" method="post"
                              action="{!! route("admin.group_sms.update", $group_sms->id) !!}"
                              enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                    @else
                        <form id="form-form" method="post" action="{!! route("admin.group_sms.store") !!}"  enctype="multipart/form-data">
                    @endif
                    {{ csrf_field() }}

                    @include("admin.group_sms.partials.tab")

                    <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="information">
                                <p> </p>
                                @include("admin.group_sms.partials.information")
                            </div>

                            <div role="tabpanel" class="tab-pane fade " id="tab-user">
                                @include("admin.group_sms.partials.user")
                            </div>
                        </div>

                        <hr>
                        <h5> Trạng thái</h5>

                        <div class="row">
                            <div class="col-md-4 col-lg-3">
                                <div class="form-group">
                                    <input id="status-draft" name="status" value="draft" type="radio" {{ (!empty($group_sms) && $group_sms->status === 'draft') || empty($group_sms)  ? 'checked' : null }}>
                                    <label for="status-draft">Lưu với bản nháp</label>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-3">
                                <div class="form-group">
                                    <input id="status-sent" name="status" value="sent" type="radio" {{ !empty($group_sms) && $group_sms->status === 'sent' ? 'checked' : null }}>
                                    <label for="status-sent">Lưu và gửi SMS</label>
                                </div>
                            </div>
                        </div>

                        {{--Buttons--}}
                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => route("admin.group_sms.index")
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        @if(!empty($users))
            var DATA_USERS =  {!! json_encode($users) !!};
        @else
            var DATA_USERS = {};
        @endif
    </script>
    @include('admin.group_sms.partials.modal_company_user')
    @include('admin.group_sms.partials.modal_list_user')

    <script src="/assets/admin/js/vue.min.js"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="/assets/plugins/jquery-validation/jquery.validate.js"></script>
    <script src="/assets/plugins/jquery-validation/localization/messages_vi.js"></script>
    <script src="/assets/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

    <!--dataTables plugin-->
    <script src="/assets/plugins/jquery-datatable/jquery.dataTables.js" type="text/javascript"></script>

    <script src="/assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"
            type="text/javascript"></script>

    <script type="text/javascript" src="/assets/admin/js/pages/group_sms.create.js?v=1.0"></script>
@endsection