@extends("admin.layouts.master")

@section("meta")
@endsection

@section("style")
    <!--select 2 plugin-->
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css"/>
    <!--dataTables plugin-->
    <link rel="stylesheet" href="/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"/>
@endsection


@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {!! trans("admin_system.list") !!}
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="body">

                    @include("admin.layouts.partials.message")

                    <form id="form-form" method="post"
                          action="{!! route("admin.system.update", 'dalathasfarm') !!}"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <p>{!! trans('admin_system.form.contact_email') !!}</p>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="contact_email"  class="form-control" value="{{ !empty($system['contact_email']) ?  $system['contact_email']['content'] : null }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <p>{!! trans('admin_system.form.hotline') !!}</p>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="hotline"  class="form-control" value="{{ !empty($system['hotline']) ?  $system['hotline']['content'] : null }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <p>{!! trans("admin_system.form.access_login_on_app") !!}</p>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="role_access_app[]" id="role" multiple>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->slug }}"  {!! !empty($system['role_access_app']['content']) && in_array("$role->slug",explode(',',$system['role_access_app']['content'])) ? "selected" : null !!} >{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{--Buttons--}}
                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => ''
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")

 <!--select 2 plugin-->
    <script src="/assets/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <!-- Jquery Validation Plugin Css -->
    <script src="/assets/plugins/jquery-validation/jquery.validate.js"></script>

    <script type="text/javascript" src="/assets/admin/js/pages/system.edit.js"></script>


@endsection