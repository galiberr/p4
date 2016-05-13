@extends('layouts.master')

@section('title')
KaraokeTracker - Show my events
@stop

@section('head')
@stop

@section('navbar')
<li><a href="/events/create">Create a new event</a></li>
<li class="active"><a href="#">See my events<span class="sr-only">(current)</span></a></li>
<li><a href="/users/editMyProfile">Edit my profile</a></li>
<li><a href="/events/search">Search events</a></li>
<li><a href="http://www.lyricsworld.com/" target="_blank">Look up lyrics</a></li>
<li><a href="http://www.soundhound.com/" target="_blank">Find song by singing</a></li>
@stop

@section('content')
<div>
        @if (is_null($events))
        You currently have no events set up (<a href="events/create">create one here</a>)
        @else
        You currently have {{ count($events) }} karaoke events set up:
        @foreach ($events as $event)
        <div class="row">
                <div class="panel panel-default">
                        <div class="panel-body">
                                <div class="col-lg-2">
                                        <img src="/assets/uploads/events/{{ $event->id }}/thumbnail" alt="Event thumbnail" /><br \>
                                        <a href="/events/{{ $event->id }}/edit">Edit this event</a>
                                </div>
                                <div class="col-lg-10">
                                        <a href="/events/{{ $event->id }}">{{ $event->title }}</a> hosted by <a href="/users/{{ $event->kj->id }}">{{ $event->kj->first_name }} {{ $event->kj->last_name }}</a><br />
                                        {{ $event->description }}<br />
                                        Location: {{ $event->locale->gm_name }} at {{ $event->locale->gm_formatted_address }}<br />
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
        @endforeach
        @endif
</div>

<div id='results'></div>
@stop

@section('body')
@stop