@extends('business.layouts.master')

@section('meta-tags')
<title>{!! $user->name !!} Profile</title>
@endsection

@section('addon-links')
<link rel="stylesheet" href="{!! asset('cms/plugins/select2/css/select2.min.css') !!}">
<link rel="stylesheet" href="{!! asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
@endsection

@section('addon-js')
<script src="{!! asset('cms/plugins/select2/js/select2.full.min.js') !!}"></script>
<script>
  $(function() {
    $('.select2').select2()

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    $('.editor-box').summernote({
      height: 350,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']]
      ]
    });
  });
</script>
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Profile</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="cover-image" src="{!! asset('images/business/cover/'.$profile->cover_image) !!}" alt="User profile picture">
            </div>
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle profile-image-abs" src="{!! asset('images/business/'.$user->profile_image) !!}" alt="User profile picture">
            </div>

            <h3 class="profile-username text-right">{!! $profile->business_name !!}</h3>

            <p class="text-muted text-right">{!! $user->email !!}</p>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">

          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

            <p class="text-muted">
              {!! $profile->business_address !!}
            </p>

            <hr>

            <strong><i class="fas fa-phone mr-1"></i> Contact Number</strong>

            <p class="text-muted">{!! $profile->contact !!} / {!! $profile->mobile !!}</p>

            <hr>

            <strong><i class="fas fa-pencil-alt mr-1"></i> Summary</strong>
            <p class="text-muted">{!! $profile->summary !!}</p>

            <hr>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Update Profile</h3>
          </div>
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#information" data-toggle="tab">Information</a></li>
              <li class="nav-item"><a class="nav-link" href="#images" data-toggle="tab">Images</a></li>
              <li class="nav-item"><a class="nav-link" href="#description" data-toggle="tab">Profile Description</a></li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active" id="information">
                <form method="post" action="{{route('business::profile.information')}}" class="form-horizontal">
                  {{csrf_field()}}
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Business Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="business_name" value="{!! $profile->business_name !!}" placeholder="Business Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputAddress" class="col-sm-2 col-form-label">Business Address</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="business_address" id="inputAddress" value="{!! $profile->business_address !!}" placeholder="Business Address">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputContact" class="col-sm-2 col-form-label">Contact Number</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="contact" id="inputContact" value="{!! $profile->contact !!}" placeholder="Contact Number">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputMobile" class="col-sm-2 col-form-label">Mobile Number</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="mobile" id="inputMobile" value="{!! $profile->mobile !!}" placeholder="Contact Mobile">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputMobile" class="col-sm-2 col-form-label">Your Location <br>(Google map embed code)</label>
                    <div class="col-sm-10">
                      <textarea name="map" class="form-control">{!! $profile->map !!}</textarea>
                    </div>

                  </div>

                  <div class="form-group row">
                    <label for="selectCategories" class="col-sm-2 col-form-label">Categories</label>
                    <div class="col-sm-10 select2-purple">
                      <select class="select2 form-control" name="categories[]" multiple="multiple">
                        @foreach($categories as $index => $category)
                        <option @if($profile->categories != null && in_array($index, json_decode($profile->categories))) selected="selected" @endif value="{{$index}}">{{$category}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>


                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Update</button>
                    </div>
                  </div>
                </form>
              </div>

              <div class="tab-pane" id="images">
                <form method="post" action="{{route('business::profile.images')}}" class="form-horizontal" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Profile Image <em>[Recommended Size: 240x240]</em></h3>
                    </div>
                    <div class="card-body img-body">
                      <!-- Minimal style -->
                      @if(isset($user) && $user->profile_image)
                      <div class="widget-user-image">
                        <img id="user-profile-img" class="featured-img-tag profile-img" src="{!! asset('images/business/'.$user->profile_image) !!}" alt="{!! $user->name !!}">
                      </div>
                      @else
                      <img id="user-profile-img" class="featured-img-tag profile-img" src="{!! asset('images/business/default.png') !!}">
                      @endif
                      <div class="form-group">
                        <div class="custom-file">
                          {!! Form::file('profile_image',['id' => 'featured-image', 'class' => 'custom-file-input']) !!}
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                      </div>

                    </div>

                    <div class="card-header">
                      <h3 class="card-title">Cover Image <em>[Recommended Size: 1200x400]</em></h3>
                    </div>
                    <div class="card-body img-body">
                      <!-- Minimal style -->
                      @if(isset($profile) && $profile->cover_image)
                      <div class="widget-user-image">
                        <img id="user-cover-img" class="cover-image" src="{!! asset('images/business/cover/'.$profile->cover_image) !!}" alt="User cover picture">
                      </div>
                      @else
                      <img id="user-cover-img" class="cover-image" src="{!! asset('images/business/cover/default.jpg') !!}">
                      @endif
                      <div class="form-group">
                        <div class="custom-file">
                          {!! Form::file('cover_image',['id' => 'cover-image', 'class' => 'custom-file-input']) !!}
                          <label class="custom-file-label" for="exampleInputFile2">Choose file</label>
                        </div>
                      </div>

                    </div>


                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-success">Update</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane" id="description">
                <form class="form-horizontal" action="{{route('business::profile.description')}}" method="post">
                  {{csrf_field()}}
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <em>[Write short description (summary) and complete description about your business]</em>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Summary</label>
                    <div class="col-sm-10">
                      <textarea name="summary" class="form-control editor-box" id="editor1">{!! $profile->summary !!}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputAddress" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea name="description" class="form-control editor-box" id="editor2">{!! $profile->description !!}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Update</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
          @if($profile->map != null || $profile->map != "")
          <hr>
          <div class="card-body">
            <div class="form-group row">
              <div class="col-sm-2">
                <strong>Location Map</strong>
              </div>
              <div class="col-sm-10">
                <p class="text-muted">{!! $profile->map !!}</p>
              </div>
            </div>
          </div>
          @endif
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection