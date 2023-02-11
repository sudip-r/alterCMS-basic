@extends('cms.layouts.master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Add Role</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{!! route('cms::users.roles.index') !!}">Roles</a></li>
          <li class="breadcrumb-item active">Add Role</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!--<add news>-->
    <div class="col-md-9 col-sm-8 col-xs-12">
      <div class="card card-primary">

        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(['route' => 'cms::users.roles.store','method'=> 'POST']) !!}

        @include('cms.users.roles.form',['button' => 'Submit'])

        {!! Form::close() !!}
      </div>
      <!-- /.box -->
    </div>
    <!--</add news>-->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@endsection