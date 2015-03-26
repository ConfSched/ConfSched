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

      @if(! Auth::guest() && Auth::user()->admin)
        <h1>Dashboard</h1>
        <hr>

        <h4>Hello {{ Auth::user()->name }},</h4>

        @include('partials.dashboards._admin')
      @elseif(! Auth::guest() && Auth::user()->author)
        <h1>Dashboard</h1>
        <hr>

        <h4>Hello {{ Auth::user()->name }},</h4>
      @elseif(! Auth::guest() && Auth::user()->committee)
        <h1>Dashboard</h1>
        <hr>

        <h4>Hello {{ Auth::user()->name }},</h4>
      @else
	   @include('partials._about')
    @endif
@endsection
