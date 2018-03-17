@extends("admin.layouts.master")

@section("meta")
@endsection

@section("style")
    <link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css"/>
@endsection


@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">

                    @include("admin.layouts.partials.message")

                    @if(empty($classes))
                        <form id="form-form" method="post" action="{!! route("admin.classes.store") !!}"
                              enctype="multipart/form-data">
                    @else
                    <form id="form-form" method="post"
                          action="{!! route("admin.classes.update", $classes->id) !!}"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                    @endif

                        {{ csrf_field() }}
                        
                        <div class="row">
                            <div class="col-md-5">
                                    <div>{!! trans("admin_classes.form.classes_name") !!}</div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="class_name"
                                                   value="{!! !empty($classes) ? $classes->class_name : old("class_name") !!}" placeholder="Điền đầy đủ thông tin">
                                        </div>
                                    </div>
                            </div>
                            <div class="col-md-5">
                                <div>{!! trans("admin_classes.form.major") !!}</div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control" name="major_id" id="major">
                                            <option value="">---</option>
                                            <option>Khoa Môi Trường (mặc định)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--Buttons--}}
                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => route("admin.classes.index")
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")

    <script type="text/javascript" src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="/assets/plugins/jquery-validation/jquery.validate.js"></script>

    <script src="/assets/plugins/jquery-validation/localization/messages_vi.js"></script>

    <script type="text/javascript" src="/assets/plugins/ckeditor/ckeditor.js?v=1.0"></script>

    <script type="text/javascript" src="/assets/admin/js/pages/classes.create.js?v=1.0"></script>
    <script src="/assets/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
@endsection