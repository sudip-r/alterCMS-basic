<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{!! asset('cms/dist/img/AdminLTELogo.png') !!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{!! asset('cms/dist/img/user2-160x160.jpg') !!}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{!! auth()->user()->name !!}</a>
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
          <a href="" class="nav-link">
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
        <li class="nav-item {{ $menu }}">
          <a href="#" class="nav-link {{ $current }}">
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
            <li class="nav-item"><a class="nav-link {{ $subCurrent }}" href="{!! route($menu->slug) !!}"><i class="far fa-circle nav-icon"></i> {!! $menu->menu_name !!}</a></li>
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