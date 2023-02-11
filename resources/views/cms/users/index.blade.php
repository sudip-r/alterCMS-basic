@extends('cms.layouts.master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Users</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Users</h3>

      <div class="card-tools">
        <a href="{!! route('cms::users.create') !!}" title="Add News" class="btn top-btn btn-primary">Add User</a>
      </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped table-hover alter-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Email Address</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>{!! $user->id !!}</td>
            <td>
              <div class="widget-user-image user-image-circle">
                <img class="img-circle user-img" src="{!! asset('uploads/users/'.$user->profile_image) !!}" alt="{!! $user->name !!}">
              </div><span class="media-heading user-title">{!! $user->name !!}</span>
            </td>
            <td>
              @if($user->isSuperuser())
              <span class="label label-success">Super Admin</span>
              @endif
              @foreach($user->roles as $role)
              <span class="label label-primary">{!! $role->name !!}</span>
              @endforeach
            </td>
            <td>{!! $user->email !!}</td>
            <td>
              @if($user->active)
              <span class="label label-success">Active</span>
              @else
              <span class="label label-danger">In-Active</span>
              @endif
              @if($user->verified)
              <span class="label label-success">Verified</span>
              @else
              <span class="label label-danger">Not Verified</span>
              @endif
            </td>
            <td>
              <a href="{!! route('cms::users.edit',['user' => $user->id]) !!}" class="btn btn-default" title="Edit">Edit</a>
            </td>

          </tr>
          @endforeach

          <tr>
            <td colspan="8">{!! $users->links() !!}</td>
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