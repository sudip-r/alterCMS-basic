<!DOCTYPE html>
<html lang="en">
<head>
  @include('business.layouts.partials._meta')

  @include('business.layouts.partials._links')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('business.layouts.partials._header')

  @include('business.layouts.partials._sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  @include('business.layouts.partials._messages')


    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  @include('business.layouts.partials._footer')

</div>
<!-- ./wrapper -->
@include('business.layouts.partials._scripts')
</body>
</html>
