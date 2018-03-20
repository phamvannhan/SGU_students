<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info" style="height: 100px;">
            <div class="info-container">
                <div class="image pull-left">
                    <img src="/assets/admin/images/user.png" width="48" height="48" alt="User"/>
                </div>
                <div class="name" data-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false">{{ Auth::user()->name }}</div>
                <div class="email">{{ Auth::user()->email }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        {{--<li><a href="javascript:void(0);"><i--}}
                                        {{--class="material-icons">person</i>{!! trans("admin_menu.profile") !!}</a></li>--}}
                        {{--<li role="seperator" class="divider"></li>--}}
                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="material-icons">input</i>{!! trans("admin_menu.sign_out") !!}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header"></li>
                <li class="{!! currentPageMenu(["*admin/dashboard"]) !!}">
                    <a href="/admin/dashboard">
                        <i class="material-icons">dashboard</i>
                        <span>{!! trans("admin_menu.dashboard") !!}</span>
                    </a>
                </li>
                @if(in_array('admin.classes.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/classes*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">account_box</i>
                            <span>{!! trans("admin_menu.classes") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/classes*"]) !!}">
                                <a href="{!! route("admin.classes.index") !!}">
                                    <span>{!! trans("admin_menu.list_classes") !!}</span>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                @endif

                @if(in_array('admin.students.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/students*"]) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">account_box</i>
                            <span>{!! trans("admin_menu.students") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/students*"]) !!}">
                                <a href="{!! route("admin.students.index") !!}">
                                    <span>{!! trans("admin_menu.list_students") !!}</span>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                @endif
               
                <li class="header"></li>

                @if(in_array('admin.user.index', $composer_auth_permissions))
                    <li class="{!! currentPageMenu(["*admin/users*", '*admin/roles*']) !!}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">account_box</i>
                            <span>{!! trans("admin_menu.users") !!}</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{!! currentPageMenu(["*admin/users*"]) !!}">
                                <a href="{!! route("admin.user.index") !!}">
                                    <span>{!! trans("admin_menu.list_users") !!}</span>
                                </a>
                            </li>
                            <li class="{!! currentPageMenu(["*admin/roles*"]) !!}">
                                <a href="{!! route("admin.role.index") !!}">
                                    <span>{!! trans("admin_menu.roles") !!}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy;{!! date("Y") !!} <strong>{{ preg_replace('#^https?://#', '', Request::root()) }}</strong>
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>