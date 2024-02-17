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
                    <li class="nav-item {{ set_active(['warehouse.index']) }}">
                        <a href="{{ route('warehouse.index') }}" class="nav-link">
                            <span class="title">Branch</span>
                        </a>
                    </li>                                
                </ul>
            </li>
            @endcan
            @can('Can Access Users')
            <li class="nav-item {{ set_active(['user.index','role.index','user.log','role.create','role.edit']) }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">Users</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ set_active(['user.index']) }}">
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
            @can('Can Access Asset')
            <li class="nav-item {{ set_active(['product-cat.index','asset.index','asset.create','asset.edit','asset.page','asset.show']) }}">
            	<a href="javascript:;" class="nav-link nav-toggle">
            		<i class="icon-social-dropbox"></i>
            		<span class="title">Assets</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                	<li class="nav-item {{ set_active(['asset.index','asset.create','asset.edit','asset.show','asset.page']) }}">
                		<a href="{{ route('asset.index') }}" class="nav-link ">
                            <span class="title">Asset Data</span>
                        </a>
                    </li>
                    <li class="nav-item {{ set_active(['product-cat.index']) }}">
                		<a href="{{ route('product-cat.index') }}" class="nav-link ">
                            <span class="title">Asset Category</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            <li class="nav-item {{ set_active(['movement.index','movement.item','audit.index','audit.process']) }}">
            	<a href="javascript:;" class="nav-link nav-toggle">
            		<i class="icon-bar-chart"></i>
            		<span class="title">Reports</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                	<li class="nav-item {{ set_active(['movement.index','movement.item']) }}">
                		<a href="{{ route('movement.index') }}" class="nav-link ">
                            <span class="title">Asset Movement</span>
                        </a>
                    </li>
                    @can('Can Run Audit')
                    <li class="nav-item {{ set_active(['audit.index','audit.process']) }}">
                		<a href="{{ route('audit.index') }}" class="nav-link ">
                            <span class="title">Asset Audit</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
        </ul>
    </div>
</div>