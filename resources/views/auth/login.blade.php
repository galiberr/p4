@extends('layouts.master')

@section('title')
KTracker - Login
@stop

@section('head')
@stop

@section('navbar')
<li class="active"><a href="#">Login<span class="sr-only">(current)</span></a></li>
<li><a href="/events/register">Register with KaraokeTracker</a></li>
<li><a href="/events/search">Search for an event</a></li>
<li><a href="http://www.lyricsworld.com/" target="_blank">Look up lyrics</a></li>
<li><a href="http://www.soundhound.com/" target="_blank">Find song by singing</a></li>
@stop

@section('content')
@if(count($errors) > 0)
<ul class='errors'>
        @foreach ($errors->all() as $error)
        <li><span class='fa fa-exclamation-circle'></span> {{ $error }}</li>
        @endforeach
</ul>
@endif

<form method='POST' action='/login' class="form-horizontal">
        {!! csrf_field() !!}
        <fieldset>
                <div class="form-group">
                        <label for="user_name" class="col-lg-2 control-label">User ID</label>
                        <div class="col-lg-4">
                                <input class="form-control" name="user_name" id="user_name" placeholder="User name" type="text">
                        </div>
                </div>
                <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-4">
                                <input class="form-control" name="password" id="password" placeholder="Password" type="password">
                        </div>
                </div>
                <div class="form-group">
                        <div class="checkbox">
                                <label>
                                        <input type="checkbox" name="remember" id="remember"> Remember me
                                </label>
                        </div>
                </div>
                        <div class="col-lg-1 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </div>
        </fieldset>
</form>
@stop

@section('body')
@stop