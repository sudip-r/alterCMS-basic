<div class="col-md-9 col-sm-8 col-xs-12">
    <div class="card card-primary">
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('name','Full Name') !!}
                {!! Form::text('name',null,['class' => 'form-control', 'id' => 'news-title', 'placeholder' => "Enter Full name" ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email','Email Address') !!}
                {!! Form::text('email',null,['class' => 'form-control', 'id' => 'email-id', 'placeholder' => "Enter email address" ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password','Password') !!}
                {!! Form::password('password',['class' => 'form-control', 'id' => 'password', 'placeholder' => "Enter Password" ]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password_confirmation','Confirm Password') !!}
                {!! Form::password('password_confirmation',['class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => "Confirm Password" ]) !!}
            </div>

        </div>

        <div class="card-footer">
            {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!}

            <a href="{!! route('cms::users.index') !!}" title="Cancel" class="btn btn-danger cancel-btn">Cancel</a>
        </div>

    </div>
</div>
<!--</add news>-->

<!--<right side bar>-->
<div class="col-md-3 col-sm-4 col-xs-12 right-side-bar">


    <!-- Categories -->
    <div class="card card-default categories-box">
        <div class="card-header">
            <h3 class="card-title">Roles</h3>
            <div class="card-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

            </div>
        </div>
        <div class="card-body">
            <!-- Minimal style -->

            <!-- radio -->
            <div class="form-group">
                @foreach($roles as $role)
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('roles[]',$role->id,in_array($role->id,$assignedRoles)) !!}
                            <span class="checkbox-material">
                                <span class="check"></span>
                            </span>
                            {!! $role->name !!}
                        </label>
                    </div>
                @endforeach
            </div>


        </div>
        <!-- /.box-body -->

    </div>


    <!-- Categories -->
    <div class="card card-default categories-box">
        <div class="card-header">
            <h3 class="card-title">Status</h3>
            <div class="card-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

            </div>
        </div>
        <div class="card-body">
            <!-- Minimal style -->

            <div class="form-group">
                <div class="switch-box">
                  <span class="switch-label">Active</span>
          
                      <label class="switch">
                          {{ Form::hidden('active', false) }}
          
                          @if(isset($user) && $user->active == '1' || old('active'))
                              <input type="checkbox" name="active" checked>
                          @else
                              <input type="checkbox" name="active">
                          @endif
                          <span class="slider round"></span>
                      </label>
                  </div>
            </div>


        </div>
        <!-- /.box-body -->

    </div>


    <!-- Post Options -->
    <div class="card card-default categories-box">
        <div class="card-header">
            <h3 class="card-title">Profile Image</h3>
            <div class="card-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

            </div>
        </div>
        <div class="card-body img-body">
            <!-- Minimal style -->
            @if(isset($user) && $user->profile_image && $user->profile_image != "user.png")
                <div class="widget-user-image">
                    <img id="featured-img-tag" class="featured-img-tag img-circle-form" src="{!! asset('uploads/users/'.$user->profile_image) !!}" alt="{!! $user->name !!}">
                </div>
            @else 
            <div class="widget-user-image">
              <img id="featured-img-tag" class="img-circle-form" src="{!! asset('cms/dist/img/user.png') !!}">
            </div>
            @endif
            <div class="form-group">
                <div class="custom-file">
                  {!! Form::file('profile_image',['id' => 'featured-image', 'class' => 'custom-file-input']) !!}
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>


            </div>

        </div>
        <!-- /.box-body -->

    </div>


</div>
<!--</right side bar>-->