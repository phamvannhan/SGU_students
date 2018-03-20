@extends("admin.layouts.master")

@section("meta")

@endsection

@section("style")
    <style>
        a.info-box {
            cursor: pointer;
        }

        a.info-box:hover, a.info-box:focus {
            text-decoration: none !important;
            outline: none;
        !important;
        }
    </style>
@endsection

@section("content")
    <div class="row clearfix">
        

        @if(in_array('admin.students.index', $composer_auth_permissions))
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <a href="{!! route("admin.students.index") !!}" class="info-box  hover-expand-effect">
                    <div class="icon bg-light-blue">
                        <i class="material-icons">account_box</i>
                    </div>
                    <div class="content">
                        <div class="text">{!! trans("admin_menu.students") !!}</div>
                        <div class="number count-to" data-from="0" data-to="243" data-speed="1000"
                             data-fresh-interval="20">{{ $count_students }}</div>
                    </div>
                </a>
            </div>
        @endif

        @if(in_array('admin.classes.edit', $composer_auth_permissions))
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <a href="{!! route("admin.classes.index") !!}" class="info-box hover-expand-effect">
                    <div class="icon bg-orange ">
                        <i class="material-icons">classes</i>
                    </div>
                    <div class="content">
                        <div class="text">{!! trans("admin_menu.classes") !!}</div>
                        <div class="number count-to" data-from="0" data-to="243" data-speed="1000"
                             data-fresh-interval="20">{{ $count_classes }}</div>
                    </div>
                </a>
            </div>
        @endif
    </div>
@endsection

@section("script")
@endsection