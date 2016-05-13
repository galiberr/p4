@extends('layouts.master')

@section('title')
KaraokeTracker - Event Detail
@stop

@section('head')
<script src="/css/eventDetail.js"></script>
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
@if (!is_null($event))
<div class="row">
        <div class="panel panel-default">
                <div class="panel-body">
                        <div class="row">
                                <div class="col-lg-2">
                                        <img src="/assets/uploads/events/{{ $event->id }}/display_image" alt="Event image" />
                                </div>
                                <div class="col-lg-10">
                                        {{ $event->title }} hosted by <a href="/users/{{ $event->kj->id }}">{{ $event->kj->first_name }} {{ $event->kj->last_name }}</a><br />
                                        {{ $event->description }}<br />
                                        Location: <a href="/locales/{{ $event->locale->id }}">{{ $event->locale->gm_name }}</a> at {{ $event->locale->gm_formatted_address }}<br />
                                        @if ($event->recurring)
                                        Takes place every {{ \App\Libraries\Event::dayOfWeek($event->day_of_week)}} - next date on {{ \App\Libraries\Event::nextDate($event->day_of_week)->toFormattedDateString() }}
                                        @else
                                        Date: {{ date('F j, Y', strtotime($event->next_date)) }}
                                        @endif
                                        <br />
                                        Starts: {{ date('h:i A', strtotime($event->start_time)) }} Ends: {{ date('h:i A', strtotime($event->end_time)) }}
                                </div>
                        </div>
                </div>
        </div>
</div>
<div class="row">
        <div class="panel panel-default">
                <div class="panel-heading">Posts for {{ $event->title }}</div>
                <div class="panel-body">
<div class="row">
        <form name="eventPostForm" id="eventPostForm" onsubmit="createPost();
return false;" class="form-horizontal">
                {!! csrf_field() !!}
                <fieldset>
                        <div class="row">
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-10">
                                        <div class="form-group">
                                                <label for="event_post" class="col-lg-3 control-label">Post a message to this event:</label>
                                                <div class="col-lg-9">
                                                        <input class="form-control" name="event_post" id="event_post" placeholder="" type="text" value="">
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-lg-2">
                                        <p class="text-danger">
                                        </p>
                                </div>
                                <div class="col-lg-10">
                                        <div class="form-group">
                                                <input name="event_id" id="event_id" type="hidden" value="{{ $event->id }}">
                                                <div class="col-lg-1 col-lg-offset-2">
                                                        <button type="submit" class="btn btn-primary">Post</button>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </fieldset>
        </form>
</div>
        <div name="posts" id="posts">
                @foreach ($event->posts as $post)
<div class="row">
                <div class="col-lg-4">
                        <p>On {{ $post->updated_at }} <a href="/users/{{ $post->poster->id }}">{{ $post->poster->user_name }}</a> posted:</p>
                </div>
                <div class="col-lg-8">
                <p>
                        @if ($post->poster->image)
                        <img src="/assets/uploads/users/{{ $post->poster->id }}/thumbnail" alt="Poster thumbnail">
                        @endif
                        {{ $post->post }}
                </p>
                </div>
        </div>
                
                @endforeach
</div>
                </div>
</div>

@endif
@stop

@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
@stop