@extends('layouts.master')

@section('title')
KaraokeTracker - Confirm User Deletion
@stop

@section('head')
@stop

@section('navbar')
@if (strcmp(\Auth::user()->roles()->first()->role, 'KJ') == 0)
        <li><a href="/events/create">Create a new event</a></li>
        <li><a href="/events/myEvents">See my events</a></li>
        <li><a href="/users/editMyProfile">Edit my profile</a></li>
        <li><a href="/events/search">Search events</a></li>
        <li><a href="http://www.lyricsworld.com/" target="_blank">Look up lyrics</a></li>
        <li><a href="http://www.soundhound.com/" target="_blank">Find song by singing</a></li>
@else
        <li><a href="/events/search">Search events</a></li>
        <li><a href="/users/editMyProfile">Edit my profile</a></li>
        <li><a href="http://www.lyricsworld.com/" target="_blank">Look up lyrics</a></li>
        <li><a href="http://www.soundhound.com/" target="_blank">Find song by singing</a></li>
@endif
@stop

@section('content')
<p>Are you sure you want to your KaraokeTracker user profile completely? You will no longer have access to KaraokeTracker.<br />
        <a href="/users/delete/{{ $user->id }}">Delete</a> <a href="/">Cancel</a></p>
<div class="row">
</div>
@stop

@section('body')
@stop