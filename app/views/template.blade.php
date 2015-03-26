<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title')</title>
	<!-- CSS -->
	<!-- Bootstrap -->
	{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> --}}
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"> -->
	{{-- HTML::style('assets/css/custom.css') --}}
      {{ HTML::style('assets/stylesheets/application.css') }}
	{{ HTML::style('assets/css/datepicker.css') }}

	<!-- <link rel="stylesheet" href="//cs-sr.academic.roanoke.edu/temp/public/assets/css/custom.css"> -->
	<!-- Font Awesome -->
	{{-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> --}}

	<!-- jQuery -->
	{{-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> --}}
	<!-- AngularJS -->
	<!-- <script src="http://code.angularjs.org/1.2.5/angular.min.js"></script> -->
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.4/angular.min.js"></script>
    <!-- <script src="http://code.angularjs.org/1.2.5/angular-animate.min.js"></script> -->
	<!-- Bootstrap JS -->
	{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> --}}
	{{-- HTML::script('assets/js/bootstrap-datepicker.js') --}}
      {{ HTML::script('assets/javascripts/application.js') }}
</head>
<body>
	@include('partials._navigation')
      <div class="main-wrapper">
      	<div class="container main-content">
      		<div class="container-fluid main-content-wrapper">
      			@yield('content')
      		</div>
      	</div>
      </div>
    {{-- <hr> --}}
    <footer class="container-fluid">
      <p>&copy; ConfSched {{ date('Y') }}</p>
    </footer>
</body>
</html>
