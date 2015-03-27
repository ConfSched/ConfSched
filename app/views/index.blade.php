@extends('template')

@section('title')
	ConfSched | Home
@endsection

@section('content')
	{{-- <h1>Conf Sched</h1>
	<hr> --}}

     {{--  <h1>CJD Conference 2015 </h1>
      <p>January 11 - 14<br>
      Roanoke College</p>
      <hr> --}}

      @if (Auth::guest())
        @include('partials._about')
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
@endsection
