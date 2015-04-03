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
      {{ HTML::style('assets/stylesheets/application.css') }}
	{{ HTML::style('assets/css/datepicker.css') }}

	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.4/angular.min.js"></script>
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
      <p>&copy; {{ Config::get('site.conference_name') }}</p>
    </footer>
</body>
</html>
