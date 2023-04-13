<div class="card-body">
  <div class="form-group">
    {!! Form::label('name','Name') !!}
    {!! Form::text('name',null,['class' => 'form-control','id' => 'role-title', 'placeholder' => "Title of role"]) !!}
  </div>
  <div class="form-group">
    {!! Form::label('description','Description') !!}
    {!! Form::textarea('description',null,['class' => 'form-control']) !!}
  </div>

</div>
<!-- /.card-body -->

<div class="card-footer">
  {!! Form::submit($button,['class' => 'btn btn-primary']) !!}

  <a href="{!! route('cms::users.roles.index') !!}" title="Cancel" class="btn btn-danger cancel-btn">Cancel</a>
</div>