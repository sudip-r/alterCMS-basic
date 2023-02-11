@extends('cms.layouts.master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Update Role</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{!! route('cms::users.roles.index') !!}">Roles</a></li>
          <li class="breadcrumb-item active">Update Role</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-9 col-sm-8 col-xs-12">
      <div class="card card-primary">
        {!! Form::model($role,['route' => ['cms::users.roles.update',$role->id],'method'=> 'PATCH']) !!}
        @include('cms.users.roles.form',['button' => 'Update'])
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section>
@endsection