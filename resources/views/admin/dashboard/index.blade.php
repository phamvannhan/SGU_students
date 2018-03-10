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
        

        @if(in_array('admin.user.index', $composer_auth_permissions))
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <a href="{!! route("admin.user.index") !!}" class="info-box  hover-expand-effect">
                    <div class="icon bg-light-blue">
                        <i class="material-icons">account_box</i>
                    </div>
                    <div class="content">
                        <div class="text">{!! trans("admin_menu.users") !!}</div>
                        <div class="number count-to" data-from="0" data-to="243" data-speed="1000"
                             data-fresh-interval="20">{{ $count_user }}</div>
                    </div>
                </a>
            </div>
        @endif

        @if(in_array('admin.system.edit', $composer_auth_permissions))
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <a href="{!! route("admin.system.edit", 'dalathasfarm') !!}" class="info-box hover-expand-effect">
                    <div class="icon bg-orange ">
                        <i class="material-icons">settings</i>
                    </div>
                    <div class="content">
                        <div class="text">{!! trans("admin_menu.system") !!}</div>
                    </div>
                </a>
            </div>
        @endif
    </div>
@endsection

@section("script")
@endsection