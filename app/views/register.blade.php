@extends('template')

@section('title')
    ConfSched | Home
@endsection

@section('content')
    <style>
        .main-content-wrapper {
            width: 50%;
        }
    </style>

    <h1>Register</h1>
    <hr>

    <div class="errors">
        @foreach($errors->all('<li>:message</li>') as $error)
            {{ $error }}
        @endforeach
    </div>

    {{ Form::open(array('class' => 'form', 'method' => 'POST')) }}
        @if(Input::has('committeeid'))
            {{ Form::hidden('commiteeid', Input::get('committeeid')) }}
        @endif

        @if(Input::has('authorid'))
            {{ Form::hidden('authorid', Input::get('authorid')) }}
        @endif

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <div class="form-group">
                    {{ Form::text('username', Input::old('username', ''), array('placeholder' => 'Username', 'class' => 'form-control'))}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <div class="form-group">
                    {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control'))}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <div class="form-group">
                    {{ Form::password('password_confirm', array('placeholder' => 'Confirm Password', 'class' => 'form-control'))}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <div class="form-group">
                    {{ Form::email('email', Input::old('email', $email), array('placeholder' => 'Email Address', 'class' => 'form-control'))}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <div class="form-group">
                    {{ Form::text('first_name', Input::old('first_name', $first_name), array('placeholder' => 'First Name', 'class' => 'form-control'))}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <div class="form-group">
                    {{ Form::text('last_name', Input::old('last_name', $last_name), array('placeholder' => 'Last Name', 'class' => 'form-control'))}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <div class="form-group">
                    @if(is_null($author) && is_nuLL($member))
                      Account Type: Admin
                    @else
                      @if (is_null($author))
                          Account Type: Committee Member
                      @elseif (is_null($member))
                          Account Type: Author
                      @else
                          Account Type: Author & Committee Member
                      @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <div class="form-group">
                    {{ Form::submit('Register', array('class' => 'btn btn-lg btn-block btn-primary'))}}
                </div>
            </div>
        </div>
    {{ Form::close() }}
@endsection
