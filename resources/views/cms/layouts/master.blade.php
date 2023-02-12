<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>alterCMS v1 | Dashboard</title>

  @include('cms.layouts.partials._links')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="fa-spin" src="{!! asset('cms/dist/img/AdminLTELogo.png') !!}" alt="AdminLTELogo" height="60" width="60">
  </div>

  @include('cms.layouts.partials._header')

  @include('cms.layouts.partials._sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  @include('cms.layouts.partials._messages')


    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  @include('cms.layouts.partials._footer')

</div>
<!-- ./wrapper -->
@include('cms.layouts.partials._scripts')
</body>
</html>
