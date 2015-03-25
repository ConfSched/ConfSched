@extends('template')

@section('title')
	ConfSched | Home
@endsection

@section('navigation')
	@include('navigation')
@endsection

@section('content')
	{{-- <h1>Conf Sched</h1>
	<hr> --}}

      @if(! Auth::guest())
        <h2>Hello {{ Auth::user()->name }},</h2>

        @include('partials.dashboards._admin')
      @else

	<h2>Hello World</h2>
	<p> look at that, it's exactly three seconds before i honk your nose and pull your underwear over your head. kinda hot in these rhinos. kinda hot in these rhinos. brain freeze. look ma i'm road kill excuse me, i'd like to ass you a few questions. good morning, oh in case i don't see you, good afternoon, good evening and goodnight. hey, maybe i will give you a call sometime. your number still 911? excuse me, i'd like to ass you a few questions. here she comes to wreck the day. look ma i'm road kill alrighty then ,</p>
	<p> your entrance was good, his was better. hey, maybe i will give you a call sometime. your number still 911? brain freeze. we're going for a ride on the information super highway. here she comes to wreck the day. your entrance was good, his was better. your entrance was good, his was better. alrighty then look ma i'm road kill look at that, it's exactly three seconds before i honk your nose and pull your underwear over your head. i just heard about evans new position,good luck to you evan backstabber, bastard, i mean baxter. i just heard about evans new position,good luck to you evan backstabber, bastard, i mean baxter. ,</p>
	<p> hey, maybe i will give you a call sometime. your number still 911? good morning, oh in case i don't see you, good afternoon, good evening and goodnight. excuse me, i'd like to ass you a few questions. it's because i'm green isn't it! we're going for a ride on the information super highway. i just heard about evans new position,good luck to you evan backstabber, bastard, i mean baxter. brain freeze. we got no food we got no money and our pets heads are falling off! haaaaaaarry. here she comes to wreck the day. alrighty then good morning, oh in case i don't see you, good afternoon, good evening and goodnight. we got no food we got no money and our pets heads are falling off! haaaaaaarry. ,</p>
	<p> we got no food we got no money and our pets heads are falling off! haaaaaaarry. kinda hot in these rhinos. we're going for a ride on the information super highway. it's because i'm green isn't it! look at that, it's exactly three seconds before i honk your nose and pull your underwear over your head. it's because i'm green isn't it! </p>

    @endif
@endsection
