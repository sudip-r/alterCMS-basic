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
<!-- SweetAlert2 -->
<script src="{!! asset('cms/plugins/sweetalert2/sweetalert2.min.js') !!}"></script>
<!-- Toastr -->
<script src="{!! asset('cms/plugins/toastr/toastr.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('cms/dist/js/adminlte.js') !!}"></script>
@yield('addon-js')

<script>
  function readURL(input, divId = "user-profile-img") {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#' + divId).attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#cover-image").change(function() {
    readURL(this, "user-cover-img");
  });

  $("#featured-image").change(function() {
    readURL(this);
  });

  
</script>

<script>
$(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    @if(Session::has('error'))
    Toast.fire({
        icon: 'error',
        title: '{!! Session::get('error') !!}'
      })
    @endif

    @if(Session::has('success'))
    Toast.fire({
        icon: 'success',
        title: '{!! Session::get('success') !!}'
      })
    @endif
});
</script>