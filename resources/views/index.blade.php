@extends('layouts.master')

@section('title')
KaraokeTracker
@stop

@section('head')
@stop

@section('navbar')
@if (is_null(\Auth::user()))
<li><a href="/events/search">Search events</a></li>
<li><a href="http://www.lyricsworld.com/" target="_blank">Look up lyrics</a></li>
<li><a href="http://www.soundhound.com/" target="_blank">Find song by singing</a></li>
@elseif (strcmp(\Auth::user()->roles()->first()->role, 'KJ') == 0)
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
<h2>Welcome to KaraokeTracker!</h2>
<p class="lead">
KaraokeTracker is a new tool designed for people who love to sing, watch and host karaoke. Looking
for something to do this weekend? Just go to the <a href="/register">event search</a> page to find karaoke that's going on
in your area. Even better, increase your fun by becoming a <a href="/register">registered KaraokeTracker user</a>.
You'll receive access to increased functionality like event postings and rating KJs and
karaoke locations.
</p>
<p class="lead">
KaraokeTracker is great for KJs, too! Join KaraokeTracker as a KJ user and you'll quickly
benefit from increased exposure to your events.
</p>
@stop

@section('body')
@stop