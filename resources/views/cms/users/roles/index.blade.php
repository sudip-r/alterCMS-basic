@extends('cms.layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Roles</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
          <li class="breadcrumb-item active">Roles</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Roles</h3>

      <div class="card-tools">
        <a href="{!! route('cms::users.roles.create') !!}" title="Add Role" class="btn top-btn btn-primary">Add Role</a>
      </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped table-hover alter-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($roles as $role)
          <tr>
            <td>{!! $role->id !!}</td>
            <td><span class="label label-primary">{!! $role->name !!}</span></td>
            <td>
              <a href="{!! route('cms::users.roles.permissions',['role'=>$role->id]) !!}" class="btn btn-default permission-btn" title="Permission">Permission</a>
              <a href="{!! route('cms::users.roles.edit',['role' => $role->id]) !!}" class="btn btn-primary" title="Edit">Edit</a>
            </td>
          </tr>
          @endforeach
          <tr>
            <td colspan="4">{!! $roles->links() !!}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->

@endsection