<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
			<li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="nav-item {{ set_active('dashboard.index') }}">
                <a href="{{ route('dashboard.index') }}" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            @can('Can Access Settings')
            <li class="nav-item {{ set_active(['warehouse.index','location.index','uker.index']) }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Configuration</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ set_active(['location.index']) }}">
                        <a href="{{ route('location.index') }}" class="nav-link">
                            <span class="title">Location</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['uker.index']) }}">
                        <a href="{{ route('uker.index') }}" class="nav-link">
                            <span class="title">Department</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['warehouse.index']) }}">
                        <a href="{{ route('warehouse.index') }}" class="nav-link">
                            <span class="title">Branch</span>
                        </a>
                    </li>                                
                </ul>
            </li>
            @endcan
            @can('Can Access Users')
            <li class="nav-item {{ set_active(['user.index','user.profile','role.index','user.log','role.create','role.edit']) }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">Users</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ set_active(['user.index','user.profile']) }}">
                        <a href="{{ route('user.index') }}" class="nav-link ">
                            <span class="title">User Manager</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['role.index','role.create','role.edit']) }}">
                        <a href="{{ route('role.index') }}" class="nav-link ">
                            <span class="title">Access Roles</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['user.log']) }}">
                        <a href="{{ route('user.log') }}" class="nav-link ">
                            <span class="title">Activity Log</span>
                        </a>
                    </li>                                    
                </ul>
            </li>
            @endcan
            @can('Can Access Products')
            <li class="nav-item {{ set_active(['product-cat.index','product.index','product.create','product.edit','movement.index','product.show']) }}">
            	<a href="javascript:;" class="nav-link nav-toggle">
            		<i class="icon-social-dropbox"></i>
            		<span class="title">Assets</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                	<li class="nav-item {{ set_active(['product.index','product.create','product.edit','product.show']) }}">
                		<a href="{{ route('product.index') }}" class="nav-link ">
                            <span class="title">Asset Data</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['product-cat.index']) }}">
                		<a href="{{ route('product-cat.index') }}" class="nav-link ">
                            <span class="title">Asset Category</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['movement.index']) }}">
                		<a href="{{ route('movement.index') }}" class="nav-link ">
                            <span class="title">Asset Movement</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                		<a href="" class="nav-link ">
                            <span class="title">Asset Maintenance</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
        </ul>
    </div>
</div>