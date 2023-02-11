<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AlterCMS - Dashboard</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{!! asset('cms/plugins/fontawesome-free/css/all.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('cms/dist/css/adminlte.min.css') !!}">
</head>
<body class="hold-transition login-page">

@yield('content')

<script src="{!! asset('cms/plugins/jquery/jquery.min.js') !!}"></script>
<script src="{!! asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<script src="{!! asset('cms/dist/js/adminlte.min.js') !!}"></script>
</body>
</html>
