@extends('template')

@section('title')
	ConfSched | Home
@endsection

@section('content')

      @if (Config::get('site.installation') === true)
        <h1>Installation</h1>
        <hr>

        <script>
          $(function() {
             $('form').on('submit', function(e) {
              e.preventDefault();

              var password = $("#password").val();
              var password2 = $("#password2").val();

              if (password == '') {
                alert("Password cannot be empty!");
                return false;
              }

              if (password != password2) {
                alert("Passwords don't match!");
              }
              else {
                $(this).unbind('submit').submit();
              }
            })
          });
        </script>

        <form method="POST" action="{{ action('ConferenceController@processInstall') }}" class="form">
          <div class="form-group">
            <label for="username">Admin Username</label>
            <input type="text" name="username" class="form-control">
          </div>
          <div class="form-group">
            <label for="password">Admin Password</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>
          <div class="form-group">
            <label for="password">Repeat Admin Password</label>
            <input type="password" name="password_repeat" id="password2" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Admin Email</label>
            <input type="email" name="email" id="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="first_name">Admin First Name</label>
            <input type="text" name="first_name" class="form-control">
          </div>
          <div class="form-group">
            <label for="last_name">Admin Last Name</label>
            <input type="text" name="last_name" class="form-control">
          </div>
          <div class="form-group">
            <label for="conference_name">Conference Name</label>
            <input type="text" name="conference_name" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-lg btn-block btn-primary" value="Finish Installation">
          </div>
        </form>
      @else

        @if (Auth::guest())
          @include('partials._about', compact('name', 'about'))
        @else
          <h1>Dashboard</h1>
          <hr>

          <h4>Hello {{ Auth::user()->name }},</h4>

          @if(Auth::user()->admin)
            @include('partials.dashboards._admin')
          @endif

          @if(Auth::user()->author)
            @include('partials.dashboards._author')
          @endif

          @if(Auth::user()->committee)
            @include('partials.dashboards._committee')
          @endif

        @endif
      @endif
@endsection
