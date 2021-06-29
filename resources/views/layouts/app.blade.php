<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('The Exchange') }}</title>
    <!-- rating system css link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet" />
    <!-- Dropzone CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/basic.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-171593178-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-171593178-1');
    </script>

    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.page_templates.auth')
        @endauth
        @guest()
            @include('layouts.page_templates.guest')
        @endguest
        
        <!--   Core JS Files   -->
        <script src="{{ asset('material') }}/js/core/jquery.min.js"></script>
        <script src="{{ asset('material') }}/js/core/popper.min.js"></script>
        <script src="{{ asset('material') }}/js/core/bootstrap-material-design.min.js"></script>
        <script src="{{ asset('material') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!-- Plugin for the momentJs  -->
        <script src="{{ asset('material') }}/js/plugins/moment.min.js"></script>
        <!--  Plugin for Sweet Alert -->
        <script src="{{ asset('material') }}/js/plugins/sweetalert2.js"></script>
        <!-- Forms Validations Plugin -->
        <script src="{{ asset('material') }}/js/plugins/jquery.validate.min.js"></script>
        <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        <script src="{{ asset('material') }}/js/plugins/jquery.bootstrap-wizard.js"></script>
        <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="{{ asset('material') }}/js/plugins/bootstrap-selectpicker.js"></script>
        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="{{ asset('material') }}/js/plugins/bootstrap-datetimepicker.min.js"></script>
        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
        <script src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>
        <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
        <script src="{{ asset('material') }}/js/plugins/bootstrap-tagsinput.js"></script>
        <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
        <script src="{{ asset('material') }}/js/plugins/jasny-bootstrap.min.js"></script>
        <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
        <script src="{{ asset('material') }}/js/plugins/fullcalendar.min.js"></script>
        <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
        <script src="{{ asset('material') }}/js/plugins/jquery-jvectormap.js"></script>
        <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="{{ asset('material') }}/js/plugins/nouislider.min.js"></script>
        <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
        <!-- Library for adding dinamically elements -->
        <script src="{{ asset('material') }}/js/plugins/arrive.min.js"></script>
        <!--  Google Maps Plugin    -->
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE'"></script>
        <!-- Chartist JS -->
        <script src="{{ asset('material') }}/js/plugins/chartist.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="{{ asset('material') }}/js/plugins/bootstrap-notify.js"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{ asset('material') }}/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
        <!-- Material Dashboard DEMO methods, don't include it in your project! -->
        <script src="{{ asset('material') }}/demo/demo.js"></script>
        <script src="{{ asset('material') }}/js/settings.js"></script>
        <!-- rating system script-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.js"></script>
        <script>
          Dropzone.options.awesomeDropzone = {
                url: '/fileupload',
                method: 'POST',
                uploadMultiple: true,
                maxFilesize: 1,
                maxFiles: 6,
                parallelUploads: 1,
                acceptedFiles: ".jpg, .jpeg, .png, .doc, .docx,.pdf, .ppt,.xls,.xlsx, .csv, .pptx,.pptm,.txt,.zip,.mp3,.mp4,.wma,.mpg,.flv",
                addRemoveLinks: true,
                
                init: function() {

                  this.on("sending", function(file, xhr, formData) {
                      formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                      if ($('[name="fileUuid"]').val()) {
                        formData.append("fileUuid", $('[name="fileUuid"]').val());
                      }
                      else {
                        formData.append("order_id", $('[name="order_id"]').val());
                      }
                  });

                  this.on("success", function(file, response) {
                    var mockFile = { name: response.filename, size: response.filesize};

                    this.emit('addedfile', mockFile);

                    $('[name="fileUuid"]').val(response.fileUuid);
                  });

                  this.on("complete", function(file) {
                    file.previewElement.remove();
                  });

                  this.on("error", function (file, error, xhr) {

                      if (error.errors) {
                        $('.dz-error-message').text(error.errors.file);
                      } else if (error.error) {
                        $('.dz-error-message').text(error.error);
                      }
                      else {
                        $('.dz-error-message').text(error.message);
                      }
                  });

                }, 
                
                removedfile: function(file) {
                  var name = file.name;        
                  $.ajax({
                      type: 'POST',
                      url: '/fileupload/'+name,
                      data: {id: name, "_token": $('meta[name="csrf-token"]').attr('content')}
                    })
                    .done(function(data) {
                      $('.dz-message').text(data.success);

                      file.previewElement.remove();

                    })
                    .fail(function(xhr) {
                      if (xhr.responseJSON.errors) {
                        alert(xhr.responseJSON.errors);
                        $('.dz-error-message').text(error.errors.file);
                      }
                      else {
                        $('.dz-error-message').text(error.message);
                      }
                    });
                }
          }
        </script>
        @stack('js') 
        @if (session('success'))
        <script>
          md.showNotification('top','center','success', '{{ session('success') }}')
        </script>          
        @elseif (session('info'))
        <script>
          md.showNotification('top','center','info', '{{ session('info') }}')
        </script>     
        @endif
        <script>
          //redirect to specific tab
          $(document).ready(function () {
              $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')
          });
        </script>

        <script>
      /* Start estimated delivery time */
        $('#deadline').change(function() {
            let now = moment();
            fullDeadline = $('#deadline').val();
            addFigure = parseInt(fullDeadline.substr(5,6));
            addUnit = fullDeadline.substr(7).trim();
            estimatedTime = moment().add(addFigure, addUnit).format("dddd, MMMM Do YYYY, h:mm a");

            $(".estimatedTime").html("Estimated delivery time is: " + estimatedTime);
        });
      /* End estimated delivery time */
        </script>

      </body>
</html>