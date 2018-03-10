<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Admin | SGU-STUDENTS</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield("meta")

    <!-- Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon.ico">
       
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="/assets/admin/css/app.css" rel="stylesheet" />

    

    @yield("style")
    <style>
        .form-group .form-line .datepicker-dropdown{
            top: 40px !important;
        }
    </style>
</head>

<body class="theme-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Vui lòng đợi...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="/admin">ADMIN - SGU - STUDENTS</a>
            </div>
        </div>
    </nav>

    @include("admin.layouts.partials.menu")

    <section class="content">
        <div class="container-fluid">
            {!! Breadcrumb::out() !!}

            @yield("content")

        </div>
    </section>

    <style>
        #cssload-pgloading:after{content:"";z-index:-1;position:absolute;top:0;right:0;bottom:0;left:0}#cssload-pgloading .cssload-loadingwrap{position:absolute;top:45%;bottom:45%;left:25%;right:25%}#cssload-pgloading .cssload-bokeh{font-size:97px;width:1em;height:1em;position:relative;margin:0 auto;list-style:none;padding:0;border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%}#cssload-pgloading .cssload-bokeh li{position:absolute;width:.2em;height:.2em;border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%}#cssload-pgloading .cssload-bokeh li:nth-child(1){left:50%;top:0;margin:0 0 0 -.1em;background:#00c176;transform-origin:50% 250%;-o-transform-origin:50% 250%;-ms-transform-origin:50% 250%;-webkit-transform-origin:50% 250%;-moz-transform-origin:50% 250%;animation:cssload-rota 1.3s linear infinite,cssload-opa 4.22s ease-in-out infinite alternate;-o-animation:cssload-rota 1.3s linear infinite,cssload-opa 4.22s ease-in-out infinite alternate;-ms-animation:cssload-rota 1.3s linear infinite,cssload-opa 4.22s ease-in-out infinite alternate;-webkit-animation:cssload-rota 1.3s linear infinite,cssload-opa 4.22s ease-in-out infinite alternate;-moz-animation:cssload-rota 1.3s linear infinite,cssload-opa 4.22s ease-in-out infinite alternate}#cssload-pgloading .cssload-bokeh li:nth-child(2){top:50%;right:0;margin:-.1em 0 0;background:#ff003c;transform-origin:-150% 50%;-o-transform-origin:-150% 50%;-ms-transform-origin:-150% 50%;-webkit-transform-origin:-150% 50%;-moz-transform-origin:-150% 50%;animation:cssload-rota 2.14s linear infinite,cssload-opa 4.93s ease-in-out infinite alternate;-o-animation:cssload-rota 2.14s linear infinite,cssload-opa 4.93s ease-in-out infinite alternate;-ms-animation:cssload-rota 2.14s linear infinite,cssload-opa 4.93s ease-in-out infinite alternate;-webkit-animation:cssload-rota 2.14s linear infinite,cssload-opa 4.93s ease-in-out infinite alternate;-moz-animation:cssload-rota 2.14s linear infinite,cssload-opa 4.93s ease-in-out infinite alternate}#cssload-pgloading .cssload-bokeh li:nth-child(3){left:50%;bottom:0;margin:0 0 0 -.1em;background:#fabe28;transform-origin:50% -150%;-o-transform-origin:50% -150%;-ms-transform-origin:50% -150%;-webkit-transform-origin:50% -150%;-moz-transform-origin:50% -150%;animation:cssload-rota 1.67s linear infinite,cssload-opa 5.89s ease-in-out infinite alternate;-o-animation:cssload-rota 1.67s linear infinite,cssload-opa 5.89s ease-in-out infinite alternate;-ms-animation:cssload-rota 1.67s linear infinite,cssload-opa 5.89s ease-in-out infinite alternate;-webkit-animation:cssload-rota 1.67s linear infinite,cssload-opa 5.89s ease-in-out infinite alternate;-moz-animation:cssload-rota 1.67s linear infinite,cssload-opa 5.89s ease-in-out infinite alternate}#cssload-pgloading .cssload-bokeh li:nth-child(4){top:50%;left:0;margin:-.1em 0 0;background:#88c100;transform-origin:250% 50%;-o-transform-origin:250% 50%;-ms-transform-origin:250% 50%;-webkit-transform-origin:250% 50%;-moz-transform-origin:250% 50%;animation:cssload-rota 1.98s linear infinite,cssload-opa 6.04s ease-in-out infinite alternate;-o-animation:cssload-rota 1.98s linear infinite,cssload-opa 6.04s ease-in-out infinite alternate;-ms-animation:cssload-rota 1.98s linear infinite,cssload-opa 6.04s ease-in-out infinite alternate;-webkit-animation:cssload-rota 1.98s linear infinite,cssload-opa 6.04s ease-in-out infinite alternate;-moz-animation:cssload-rota 1.98s linear infinite,cssload-opa 6.04s ease-in-out infinite alternate}@keyframes cssload-rota{to{transform:rotate(360deg)}}@-o-keyframes cssload-rota{to{-o-transform:rotate(360deg)}}@-ms-keyframes cssload-rota{to{-ms-transform:rotate(360deg)}}@-webkit-keyframes cssload-rota{to{-webkit-transform:rotate(360deg)}}@-moz-keyframes cssload-rota{to{-moz-transform:rotate(360deg)}}@keyframes cssload-opa{12.0%{opacity:.8}19.5%{opacity:.88}37.2%{opacity:.64}40.5%{opacity:.52}52.7%{opacity:.69}60.2%{opacity:.6}66.6%{opacity:.52}70.0%{opacity:.63}79.9%{opacity:.6}84.2%{opacity:.75}91.0%{opacity:.87}}@-o-keyframes cssload-opa{12.0%{opacity:.8}19.5%{opacity:.88}37.2%{opacity:.64}40.5%{opacity:.52}52.7%{opacity:.69}60.2%{opacity:.6}66.6%{opacity:.52}70.0%{opacity:.63}79.9%{opacity:.6}84.2%{opacity:.75}91.0%{opacity:.87}}@-ms-keyframes cssload-opa{12.0%{opacity:.8}19.5%{opacity:.88}37.2%{opacity:.64}40.5%{opacity:.52}52.7%{opacity:.69}60.2%{opacity:.6}66.6%{opacity:.52}70.0%{opacity:.63}79.9%{opacity:.6}84.2%{opacity:.75}91.0%{opacity:.87}}@-webkit-keyframes cssload-opa{12.0%{opacity:.8}19.5%{opacity:.88}37.2%{opacity:.64}40.5%{opacity:.52}52.7%{opacity:.69}60.2%{opacity:.6}66.6%{opacity:.52}70.0%{opacity:.63}79.9%{opacity:.6}84.2%{opacity:.75}91.0%{opacity:.87}}@-moz-keyframes cssload-opa{12.0%{opacity:.8}19.5%{opacity:.88}37.2%{opacity:.64}40.5%{opacity:.52}52.7%{opacity:.69}60.2%{opacity:.6}66.6%{opacity:.52}70.0%{opacity:.63}79.9%{opacity:.6}84.2%{opacity:.75}91.0%{opacity:.87}}#load__page{display:none;background-color:rgba(91,91,91,.7);position:fixed;top:0;left:0;height:100%;width:100%;z-index:9999}
    </style>

    <div id="load__page">
        <div id="cssload-pgloading"> <div class="cssload-loadingwrap"> <ul class="cssload-bokeh"> <li></li> <li></li> <li></li> <li></li> </ul> </div> </div>
    </div>

    <script src="/assets/plugins/cleave/cleave.min.js"></script>
    <script src="/assets/admin/js/app.js?v=1.0"></script>

    @yield("script")

	<script>
        jQuery(function ($) {
            // set data-after-submit-value on input:submit to disable button after submit
            $(document).on('submit', 'form', function() {
                var $form = $(this),
                    $button,
                    label;
                $form.find(':submit').each(function() {
                    $button = $(this);
                    $button.prop('disabled', true);
                });
            });
        });
    </script>
</body>

</html>