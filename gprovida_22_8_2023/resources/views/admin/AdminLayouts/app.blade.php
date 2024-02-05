<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('pageTitle') - GProvider </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Greatprovider">
    <meta name="author" content="GPS">



    <!-- <link href="assets/less/styles.less" rel="stylesheet/less" media="all">  -->
    <link rel="stylesheet" href="{{ asset('/adminTemplate/css/styles.css?=121') }}" >
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>

    <link href="{{ asset('/adminTemplate/demo/variations/default.css') }}"  rel='stylesheet' type='text/css' media='all' id='styleswitcher'>
    <link href="{{ asset('/adminTemplate/demo/variations/default.css') }}"  rel='stylesheet' type='text/css' media='all' id='headerswitcher'>

    <link href="{{ asset('/adminTemplate/plugins/form-daterangepicker/daterangepicker-bs3.css') }}"  rel='stylesheet' type='text/css'/>
    <link href="{{ asset('/adminTemplate/plugins/fullcalendar/fullcalendar.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('/adminTemplate/plugins/form-markdown/css/bootstrap-markdown.min.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('/adminTemplate/plugins/codeprettifier/prettify.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('/adminTemplate/plugins/form-toggle/toggles.css') }}" rel='stylesheet' type='text/css'/>


    @yield('styles')

    <head>
        @if(Session::has('download.in.the.next.request'))
            <meta http-equiv="refresh" content="5;url={{ Session::get('download.in.the.next.request') }}">
        @endif
    <head>


</head>

<body
 class="<?php
            if (isset($_COOKIE["admin_leftbar_collapse"])) echo ($_COOKIE['admin_leftbar_collapse'] . " "); // check collapse state with php
            if (isset($_COOKIE["admin_rightbar_show"])) echo $_COOKIE['admin_rightbar_show'];
            if (isset($_COOKIE["fixed-header"])) echo ' static-header';
         ?>">

  @include('admin.AdminLayouts.headerbar')
  @include('admin.AdminLayouts.topnavbar')
  @include('admin.AdminLayouts.sideBarMenu')
  @include('admin.AdminLayouts.rightBarMenu')



 @yield('content')






   <footer role="contentinfo">
        <div class="clearfix">
            <ul class="list-unstyled list-inline pull-left">
                <li>GProvider &copy; {{ date('Y')}}</li>
            </ul>
            <button class="pull-right btn btn-inverse-alt btn-xs hidden-print" id="back-to-top">
                <i class="fa fa-arrow-up"></i>
            </button>
        </div>
    </footer>

</div> <!-- page-container -->


<script type='text/javascript' src="{{ asset('/adminTemplate/js/jquery-1.10.2.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('/adminTemplate/js/jqueryui-1.10.3.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('/adminTemplate/js/bootstrap.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('/adminTemplate/js/enquire.js') }}"></script>
<script type='text/javascript' src="{{ asset('/adminTemplate/js/jquery.cookie.js') }}"></script>
<script type='text/javascript' src="{{ asset('/adminTemplate/js/jquery.nicescroll.min.js') }}"></script>

<script type='text/javascript' src="{{ asset('/adminTemplate/plugins/codeprettifier/prettify.js') }}"></script>
<script type='text/javascript' src="{{ asset('/adminTemplate/plugins/easypiechart/jquery.easypiechart.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('/adminTemplate/plugins/sparklines/jquery.sparklines.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('/adminTemplate/plugins/form-toggle/toggle.min.js') }}"></script>



<script type='text/javascript' src="{{ asset('/adminTemplate/js/placeholdr.js') }}"></script>
<script type='text/javascript' src="{{ asset('/adminTemplate/js/application.js') }}"></script>


<script>
    $('.toggle').toggles({on:true});
</script>


@yield('scripts')




    </body>
</html>
