<aside class="main-sidebar sidebar-light-info elevation-4">
  <!-- Brand Logo -->
  <a href="https://alterbasestudios.com" class="brand-link">
    <img src="{!! asset('cms/dist/img/AdminLTELogo.png') !!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">alterCMS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        @php 
          $profileImage = asset('uploads/users/'.auth()->user()->profile_image)
        @endphp

        @if(!file_exists(public_path('uploads/users/'.auth()->user()->profile_image)))
          @php 
            $profileImage = asset('cms/dist/img/user.png')
          @endphp
        @endif
        <img src="{!! $profileImage !!}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="javascript:void(0);" class="d-block">{!! auth()->user()->name !!}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{!! route('cms::dashboard') !!}" class="nav-link @if(strpos(Route::currentRouteName(), "cms::dashboard") !== false) active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @foreach($modules as $module)

        @php
        $current = '';
        $menu = '';
        if(strpos(Route::currentRouteName(), $module->slug) !== false){
        $current = 'active';
        $menu = 'menu-is-opening menu-open';
        }
        @endphp
        @if($module->slug == "cms::users")
        <li class="nav-header">{{$module->description}}</li>
        @endif

        @if($module->slug == "cms::settings")
        <li class="nav-header">{{$module->description}}</li>
        @endif
        
        <li class="nav-item {{ $menu }}">
          <a href="javascript:void(0);" class="nav-link {{ $current }}">
            <i class="nav-icon fas {!! $module->icon_class !!}"></i>
            <p>{!! $module->name !!} <i class="right fas fa-angle-right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            @foreach($module->menus as $menu)
            @php
              $subCurrent = '';
              if(strpos(Route::currentRouteName(), $menu->slug) !== false){
                $subCurrent = 'active';
              }
            @endphp
            <li class="nav-item">
              <a class="nav-link {{ $subCurrent }}" href="{!! route($menu->slug) !!}">
                <i class="far fa-circle nav-icon"></i> <p>{!! $menu->menu_name !!}</p>
              </a>
            </li>
            @endforeach

          </ul>
        </li>
        @endforeach
        <li class="nav-item">
          <a href="{!! route('cms::logout') !!}" class="nav-link">
            <i class="nav-icon fas fa-power-off"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->


  </div>
  <!-- /.sidebar -->
</aside>