<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accounting Software</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/adminlte.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/responsive.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/common.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">     
    <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.css">    
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  
</head>
<body class="sidebar-mini layout-fixed sidebar-collapse">
    <div class="wrapper">
        @include('admin.layouts.head') 
        @include('admin.layouts.sidebar')
        
        @yield('content')
        @include('admin.layouts.footer')
        @include('admin.layouts.message')
  <script>
           /* $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });*/
               // var URL  = "{{ url('/') }}/admin";
            </script>
            <script src="{{URL::asset('public/assets/accounts/js/jquery-ui.min.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/jquery.min.js')}}"></script>
        
         
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <script src="{{URL::asset('public/assets/accounts/js/jquery.dataTables.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/dataTables.bootstrap4.js')}}"></script>
        <!--<script src="{{URL::asset('public/assets/accounts/js/dataTables.responsive.js')}}"></script>-->
        <script src="{{URL::asset('public/assets/accounts/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/Chart.min.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/sparkline.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/jquery.vmap.min.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/jquery.vmap.usa.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/jquery.knob.min.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/moment.min.js')}}"></script>
<!--        <script src="{{URL::asset('public/assets/accounts/js/daterangepicker.js')}}"></script>-->
         <script src="{{URL::asset('public/assets/accounts/js/tempusdominus-bootstrap-4.min.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/summernote-bs4.min.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/jquery.overlayScrollbars.min.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/pdfmake.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/demo.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/dashboard.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/bootstrap5.js')}}"></script>   
        
       
        <script src="{{URL::asset('public/assets/accounts/js/responsive.bootstrap4.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/dataTables.buttons.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/buttons.bootstrap4.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/buttons.html5.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/buttons.print.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/buttons.colVis.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/jquery.validate.js')}}"></script>
        <script src="{{URL::asset('public/assets/accounts/js/additional-methods.js')}}"></script>
       <script src="{{URL::asset('public/assets/accounts/js/adminlte.js')}}"></script>
       <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
       <script src="{{URL::asset('public/assets/accounts/js/select2.js')}}"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
     <script src="http://school.rusoft.in/public/assets/school/js/vfs_fonts.js"></script>
       

         <script>
         $(function () {
    //Initialize Select2 Elements
    $('.teg').select2()
    });
    //Initialize Select2 Elements
    $('.teg').select2({
      theme: 'bootstrap4'
    })
          $(function () {
            $("#example1").DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false,
              "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
            });
          });
          
           
    
    
        </script>
        
        
        <script>
    $("#select_all").change(function () {  
        $(".checkbox").prop('checked', $(this).prop("checked")); 
    });
    
    function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

   function sendMail($tmplale,$data) {

                Mail::send($tmplale, $data, function($message) use ($data) {
                    $message->from(getenv('MAIL_FROM_ADDRESS'));
                 $message->to($data['email']);
                 $message->subject($data['subject']);
                 
                 
               });
               
    }


</script>

<script>

     function caFunction() {
            var ca_share_pass= $('#ca_share_pass').val();
            var ca_pass_type = $('#ca_password').val();
            
              if (ca_share_pass== ca_pass_type) {
                toastr.success('Password Confirm Successfully');
                window.location.href = "ca_permission";
                
            } else{
              // $('#ca_share_close_btn').click();
                toastr.info('Password incorrect');
            }

        }

</script>
<style>
     a.disabled {
  pointer-events: none;
  cursor: default;
}
</style>
</body>
</html>