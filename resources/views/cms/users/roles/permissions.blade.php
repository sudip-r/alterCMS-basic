@extends('cms.layouts.master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Permissions</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{!! route('cms::users.roles.index') !!}">Roles</a></li>
          <li class="breadcrumb-item active">Permissions</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <a href="javascript:void(0);" id="checkAll" title="Check All" class="btn top-btn btn-primary">Check All</a>
            <a href="javascript:void(0)" id="uncheckAll" title="Un-Check All" class="btn top-btn btn-primary">Un-Check
              All</a>
          </h3>

        </div>
        <div class="card-body">
          {!! Form::open(['route' => ['cms::users.roles.permissions.update','role' => $role->id]]) !!}
          <table class="table table-hover table-striped">
            <tbody>

              <tr>
                <th>Modules</th>
                <th>Permissions/Actions</th>
              </tr>
              @foreach($modules as $module)
              <tr>
                <td>
                  <div class="checkbox">
                    <label>
                      {!! Form::checkbox('modules[]', $module->id,null,array('id'=>$module->id,'class'=>'module permissions')) !!}
                      <span class="checkbox-material">
                        <span class="check"></span>
                      </span>
                      <span class="maintitle">{!! $module->name !!}</span>
                    </label>
                  </div>
                </td>

                <td>
                  @foreach($module->permissions as $permission)
                  <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="checkbox">
                      <label>
                        {!! Form::checkbox($permission->id,null,$role->hasPermission($permission), array('class'=>'permissions permission-'.$module->id,'data-module'=> $module->id)) !!}
                        <span class="checkbox-material">
                          <span class="check"></span>
                        </span>
                        {!! $permission->name !!}
                      </label>
                    </div>
                  </div>
                  @endforeach
                </td>

              </tr>
              @endforeach

            </tbody>
          </table>

          <div class="card-footer">
            {!! Form::submit("Submit",['class' => 'btn btn-primary']) !!}
            <a href="{!! route('cms::users.roles.index') !!}" title="Cancel" class="btn btn-danger cancel-btn">Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('custom-scripts')
<script>
  $('.module').click(function() {
    var checked = $(this).prop('checked');
    var id = $(this).prop('id');

    $('.permission-' + id).each(function() {
      $(this).prop('checked', checked);
    })
  });
  $('#checkAll').click(function() {
    $('.permissions').each(function() {
      $(this).prop('checked', true);
    })
  });

  $('#uncheckAll').click(function() {
    $('.permissions').each(function() {
      $(this).prop('checked', false);
    })
  });

  $('.permissions').on('change', function() {
    var module = $(this).data('module'),
      moduleId = "#" + module,
      indeterminate = false,
      checked = true;

    $('.permission-' + module).each(function() {
      var status = $(this).prop('checked') === true;
      if (status) {
        indeterminate = true;
      }
      if (!status) {
        checked = false;
      }
    });
    $(moduleId).prop('indeterminate', false);
    if (checked) {
      $(moduleId).prop('checked', true);
    } else if (indeterminate) {
      $(moduleId).prop('checked', true);
      //                $(moduleId).prop('indeterminate', true);
    } else {
      $(moduleId).prop('checked', false);
    }
  });

  $(document).ready(function() {
    $('.permissions').trigger('change');
  });
</script>
@endsection