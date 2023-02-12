<!-- jQuery -->
<script src="{!! asset('cms/plugins/jquery/jquery.min.js') !!}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{!! asset('cms/plugins/jquery-ui/jquery-ui.min.js') !!}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{!! asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- ChartJS -->
<script src="{!! asset('cms/plugins/chart.js/Chart.min.js') !!}"></script>
<!-- Sparkline -->
<script src="{!! asset('cms/plugins/sparklines/sparkline.js') !!}"></script>
<!-- JQVMap -->
<script src="{!! asset('cms/plugins/jqvmap/jquery.vmap.min.js') !!}"></script>
<script src="{!! asset('cms/plugins/jqvmap/maps/jquery.vmap.usa.js') !!}"></script>
<!-- jQuery Knob Chart -->
<script src="{!! asset('cms/plugins/jquery-knob/jquery.knob.min.js') !!}"></script>
<!-- daterangepicker -->
<script src="{!! asset('cms/plugins/moment/moment.min.js') !!}"></script>
<script src="{!! asset('cms/plugins/daterangepicker/daterangepicker.js') !!}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{!! asset('cms/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') !!}"></script>
<!-- Summernote -->
<script src="{!! asset('cms/plugins/summernote/summernote-bs4.min.js') !!}"></script>
<!-- overlayScrollbars -->
<script src="{!! asset('cms/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('cms/dist/js/adminlte.js') !!}"></script>

@yield('custom-scripts')

<script>

  $(document).ready(function(){
    var dark_mode = '{{$setting->dark_mode}}';
    if(dark_mode == '1')
    {
      turnOffTheLight();
    }else{
      turnOnTheLight();
    }
  });

  function turnOffTheLight()
  {
    $('body').addClass('dark-mode');
    $('.main-header').addClass('navbar-dark');
    $('.main-header').removeClass('navbar-white');
    $('.main-sidebar').removeClass('sidebar-light-info');
    $('.main-sidebar').addClass('sidebar-dark-info');
  }

  function turnOnTheLight()
  {
    $('body').removeClass('dark-mode');
    $('.main-header').addClass('navbar-white');
    $('.main-header').removeClass('navbar-dark');
    $('.main-sidebar').addClass('sidebar-light-info');
    $('.main-sidebar').removeClass('sidebar-dark-info');
  }

  function readURL(input, divId = "featured-img-tag") {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#' + divId).attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#featured-image").change(function() {
    readURL(this);
  });
  $("#icon-light").change(function() {
    readURL(this, "icon-light-img");
  });
  $("#icon-dark").change(function() {
    readURL(this, "icon-dark-img");
  });

  $(".__lights_toggle").click(function(){
    var dark_mode = 0;
    if($('body').hasClass('dark-mode'))
    {
      $('body').removeClass('dark-mode');
      $('.main-header').addClass('navbar-white');
      $('.main-header').removeClass('navbar-dark');
      $('.main-sidebar').addClass('sidebar-light-info');
      $('.main-sidebar').removeClass('sidebar-dark-info');
      dark_mode = 0;
    }else{
      $('body').addClass('dark-mode');
      $('.main-header').addClass('navbar-dark');
      $('.main-header').removeClass('navbar-white');
      $('.main-sidebar').removeClass('sidebar-light-info');
      $('.main-sidebar').addClass('sidebar-dark-info');
      dark_mode = 1;
    }

    $.ajax({
    type: 'POST',
    url: '{{route("cms::toggle.dark-mode")}}',
    data: { dark_mode: dark_mode, _token: '{{csrf_token()}}' },
    success: function(data) {
        console.log(data);
    }
});
  });
  
</script>
