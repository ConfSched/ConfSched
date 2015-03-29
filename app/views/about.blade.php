@extends('template')

@section('title')
  ConfSched | Conference Details
@endsection

@section('content')
  @include('partials._about', compact('name', 'about'))
@endsection
