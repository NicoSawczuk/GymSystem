
<!-- jQuery -->
<script src="{{ asset("assets/admin-lte/plugins/jquery/jquery.min.js") }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset("assets/admin-lte/plugins/jquery-ui/jquery-ui.min.js") }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset("assets/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- ChartJS -->
<script src="{{ asset("assets/admin-lte/plugins/chart.js/Chart.min.js") }}"></script>
<!-- Sparkline -->
<script src="{{ asset("assets/admin-lte/plugins/sparklines/sparkline.js") }}"></script>
{{-- <!-- JQVMap -->
<script src="{{ asset("assets/admin-lte/plugins/jqvmap/jquery.vmap.min.js") }}"></script>
<script src="{{ asset("assets/admin-lte/plugins/jqvmap/maps/jquery.vmap.usa.js") }}"></script> --}}
<!-- jQuery Knob Chart -->
<script src="{{ asset("assets/admin-lte/plugins/jquery-knob/jquery.knob.min.js") }}"></script>
<!-- daterangepicker -->
<script src="{{ asset("assets/admin-lte/plugins/moment/moment.min.js") }}"></script>
<script src="{{ asset("assets/admin-lte/plugins/daterangepicker/daterangepicker.js") }}"></script>
{{-- <!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset("assets/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js") }}"></script> --}}
<!-- Summernote -->
<script src="{{ asset("assets/admin-lte/plugins/summernote/summernote-bs4.min.js") }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset("assets/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("assets/admin-lte/dist/js/adminlte.js") }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset("assets/admin-lte/dist/js/pages/dashboard.js") }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset("assets/admin-lte/dist/js/demo.js") }}"></script>
<!-- DataTables -->
<script src="{{ asset("assets/admin-lte/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("assets/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
<script src="{{ asset("assets/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
<script src="{{ asset("assets/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
{{-- <!-- Selectpicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/js/bootstrap-select.min.js"></script> --}}

<!-- InputMask -->
<script src="{{ asset("assets/admin-lte/plugins/moment/moment.min.js") }}"></script>
<script src="{{ asset("assets/admin-lte/plugins/inputmask/min/jquery.inputmask.bundle.min.js") }}"></script>

<!-- PhoneMask -->
<script src="{{ asset("assets/mask/jquery.mask.js") }}"></script>

<!-- Select2 -->
<script src="{{ asset("assets/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("assets/admin-lte/plugins/select2/js/select2.full.min.js") }}"></script>



<!-- Notiflix -->
<script src="{{ asset("assets/notiflix/Minified/notiflix-2.1.2.min.js") }}"></script>
<script>
   Notiflix.Notify.Init({ 
     closeButton:true,
     distance:"15px",
     fontSize:"14px",
     useFontAwesome:true,
     fontAwesomeIconStyle:"fal",
     cssAnimation:true,
     cssAnimationStyle:"from-top",
     timeout:300,
     messageMaxLength:1000,
     width:'300px',
     success: {background:"rgba(50,198,130,0.959)", }, 
     failure: {background:"rgba(255,85,73,0.947)",}, 
     warning: {background:"rgba(238,191,49,0.953)",}, 
     info: {background:"rgba(38,192,211,0.947)",}, }); 
</script>
<script>
   Notiflix.Confirm.Init({ 
     width:"400px",
     position:"center-top",
     titleFontSize:"20px",
     distance:"20px",
     messageFontSize:"16px",
     useGoogleFont:false,
     cancelButtonBackground:"#c7c7c7",
     titleColor:"#e70505",
     okButtonBackground:"#ec4d4d", }); 
</script>


<!-- bs-custom-file-input -->
<script src="{{ asset("assets/admin-lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js") }}"></script>

<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
  });
  </script>

<!-- Sweetalert2 -->
<script src="{{ asset("assets/sweetalert2/sweetalert2@9.js") }}"></script>

<!-- fullCalendar 2.2.5 -->
<script src="{{ asset("assets/admin-lte/plugins/moment/moment.min.js") }}"></script>
<script src="{{ asset("assets/admin-lte/plugins/moment/locale/es.js") }}"></script>
<script src="{{ asset("assets/admin-lte/plugins/fullcalendar/main.min.js") }}"></script>
<script src="{{ asset("assets/admin-lte/plugins/fullcalendar-daygrid/main.min.js") }}"></script>
<script src="{{ asset("assets/admin-lte/plugins/fullcalendar-timegrid/main.min.js") }}"></script>
<script src="{{ asset("assets/admin-lte/plugins/fullcalendar-interaction/main.min.js") }}"></script>
<script src="{{ asset("assets/admin-lte/plugins/fullcalendar-bootstrap/main.min.js") }}"></script>


