@extends('cms.layouts.master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit User</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{!! route('cms::users.index') !!}">Users</a></li>
          <li class="breadcrumb-item active">Edit User</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  {!! Form::model($user,['route' => ['cms::users.update', $user->id], 'method' => 'patch','files'=>true]) !!}
  <div class="row">
    @include('cms.users.form')
  </div>
  {!! Form::close() !!}
  <!-- /.row -->
</section>
<!-- /.content -->


@endsection