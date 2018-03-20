@extends("admin.layouts.master")

@section("meta")

@endsection

@section("style")
    <!--select 2 plugin-->
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css"/>

    <link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
@endsection

@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">

                    @include("admin.layouts.partials.message")
                    @if(!empty($students))
                        <form id="form-form" method="post" action="{!! route("admin.students.update", $students->id) !!}"
                              enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                    @else

                    <form id="form-form" method="post" action="{!! route("admin.students.store") !!}"
                          enctype="multipart/form-data">
                    @endif

                    {{ csrf_field() }}
                    
                        @include('admin.students.partials.information')
                        
                        {{--Buttons--}}
                        @include("admin.layouts.partials.form_buttons", [
                            "cancel" => route("admin.students.index")
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        @if(!empty($students))
            var is_edit_page = true;
        @endif
    </script>

    <script type="text/javascript" src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!--select 2 plugin-->
    <script src="/assets/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="/assets/plugins/jquery-validation/jquery.validate.js"></script>
    <script src="/assets/plugins/jquery-validation/localization/messages_vi.js"></script>

    <script type="text/javascript" src="/assets/admin/js/pages/students.create.js?v=1.1"></script>
@endsection