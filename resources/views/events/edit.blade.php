@extends('layouts.googleMapsPage')

@section('title')
KaraokeTracker - Edit Event
@stop

@section('navbar')
<li><a href="/events/create">Create a new event</a></li>
<li><a href="/events/myEvents">See my events</a></li>
<li><a href="/users/editMyProfile">Edit my profile</a></li>
<li><a href="/events/search">Search events</a></li>
<li><a href="http://www.lyricsworld.com/" target="_blank">Look up lyrics</a></li>
<li><a href="http://www.soundhound.com/" target="_blank">Find song by singing</a></li>
@stop

@section('googleMapsPageHead')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
@stop

@section('googleMapsPageContent')
If you need to change the locale for your event, use the Google Maps to the right...
    @if(count($errors) > 0)
        <ul class='errors'>
            @foreach ($errors->all() as $error)
                <li><span class='fa fa-exclamation-circle'></span> {{ $error }}</li>
            @endforeach
        </ul>
    @endif
<form name="createEventForm" id="createEventForm" method='POST' action='/events/{{ $event->id }}/edit' class="form-horizontal" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <fieldset>
                {{-- Fields filled in by Google Maps --}}
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="gm_name" class="col-lg-2 control-label">Locale name</label>
                                        <div class="col-lg-10">
                                                <input class="form-control" name="gm_name" id="gm_name" type="text" value="{{ $event->locale->gm_name }}" readonly>
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
                                        <label for="gm_formatted_address" class="col-lg-2 control-label">Locale address</label>
                                        <div class="col-lg-10">
                                                <input class="form-control" name="gm_formatted_address" id="gm_formatted_address" type="text" value="{{ $event->locale->gm_formatted_address }}" readonly>
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
                                        <div class="col-lg-3">
                                                <input class="form-control" name="gm_place_id" id="gm_place_id" value="{{ $event->locale->gm_place_id }}" type="hidden">
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
                                        <div class="col-lg-3">
                                                <input class="form-control" name="gm_lat" id="gm_lat" value="{{ $event->locale->gm_lat }}" type="hidden">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                ...then make any necessary updates to your event information.
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <div class="col-lg-3">
                                                <input class="form-control" name="gm_lng" id="gm_lng" value="{{ $event->locale->gm_lng }}" type="hidden">
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
                                        <div class="col-lg-3">
                                                <input class="form-control" name="event_id" id="event_id" value="{{ $event->id }}" type="hidden">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('title') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="title" class="col-lg-2 control-label">Title</label>
                                        <div class="col-lg-10">
                                                <input class="form-control" name="title" id="title" placeholder="Event title" type="text" value="{{ $event->title }}">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('description') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="description" class="col-lg-2 control-label">Description</label>
                                        <div class="col-lg-10">
                                                <input class="form-control" name="description" id="description" placeholder="Event description" type="text" value="{{ $event->description }}">
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
                                        <label class="col-lg-2 control-label">Event type</label>
                                        <div class="col-lg-10">
                                                <div class="radio">
                                                        <label>
                                                                <input name="eventType" id="eventType1" value="0" <?php if ($event->recurring) echo "checked"?> type="radio">
                                                                Recurring
                                                        </label>
                                                </div>
                                                <div class="radio">
                                                        <label>
                                                                <input name="eventType" id="eventType2" value="1" <?php if (!$event->recurring) echo "checked"?> type="radio">
                                                                One-time
                                                        </label>
                                                </div>
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
                                        <label for="select" class="col-lg-2 control-label">Day of week</label>
                                        <div class="col-lg-4">
                                                <select class="form-control" name="day_of_week" id="day_of_week">
                                                        <option value="0">Sunday</option>
                                                        <option value="1">Monday</option>
                                                        <option value="2">Tuesday</option>
                                                        <option value="3">Wednesday</option>
                                                        <option value="4">Thursday</option>
                                                        <option value="5">Friday</option>
                                                        <option value="6">Saturday</option>
                                                </select>
                                        </div>
                                </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('next_date') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="next_date" class="col-lg-2 control-label">Event date</label>
                                        <div class="col-lg-10">
                                                <input name="next_date" id="datepicker" type="text">
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
                                        <label for="start_time" class="col-lg-2 control-label">Start time</label>
                                        <div class="col-lg-4">
                                                <select class="form-control" name="start_time" id="start_time">
                                                        <option value="0000">00:00</option>
                                                        <option value="0030">00:30</option>
                                                        <option value="0100">01:00</option>
                                                        <option value="0130">01:30</option>
                                                        <option value="0200">02:00</option>
                                                        <option value="0230">02:30</option>
                                                        <option value="0300">03:00</option>
                                                        <option value="0330">03:30</option>
                                                        <option value="0400">04:00</option>
                                                        <option value="0430">04:30</option>
                                                        <option value="0500">05:00</option>
                                                        <option value="0530">05:30</option>
                                                        <option value="0600">06:00</option>
                                                        <option value="0630">06:30</option>
                                                        <option value="0700">07:00</option>
                                                        <option value="0730">07:30</option>
                                                        <option value="0800">08:00</option>
                                                        <option value="0830">08:30</option>
                                                        <option value="0900">09:00</option>
                                                        <option value="0930">09:30</option>
                                                        <option value="1000">10:00</option>
                                                        <option value="1030">10:30</option>
                                                        <option value="1100">11:00</option>
                                                        <option value="1130">11:30</option>
                                                </select>
                                        </div>
                                        <label class="col-lg-2 control-label">AM/PM</label>
                                        <div class="col-lg-4">
                                                <div class="radio">
                                                        <label>
                                                                <input name="start_time_AMPM" id="start_time_AM" value="0" type="radio">
                                                                AM
                                                        </label>
                                                </div>
                                                <div class="radio">
                                                        <label>
                                                                <input name="start_time_AMPM" id="start_time_PM" value="1" checked="" type="radio">
                                                                PM
                                                        </label>
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
                                        <label for="end_time" class="col-lg-2 control-label">End time</label>
                                        <div class="col-lg-4">
                                                <select class="form-control" name="end_time" id="end_time">
                                                        <option value="0000">00:00</option>
                                                        <option value="0030">00:30</option>
                                                        <option value="0100">01:00</option>
                                                        <option value="0130">01:30</option>
                                                        <option value="0200">02:00</option>
                                                        <option value="0230">02:30</option>
                                                        <option value="0300">03:00</option>
                                                        <option value="0330">03:30</option>
                                                        <option value="0400">04:00</option>
                                                        <option value="0430">04:30</option>
                                                        <option value="0500">05:00</option>
                                                        <option value="0530">05:30</option>
                                                        <option value="0600">06:00</option>
                                                        <option value="0630">06:30</option>
                                                        <option value="0700">07:00</option>
                                                        <option value="0730">07:30</option>
                                                        <option value="0800">08:00</option>
                                                        <option value="0830">08:30</option>
                                                        <option value="0900">09:00</option>
                                                        <option value="0930">09:30</option>
                                                        <option value="1000">10:00</option>
                                                        <option value="1030">10:30</option>
                                                        <option value="1100">11:00</option>
                                                        <option value="1130">11:30</option>
                                                </select>
                                        </div>
                                        <label class="col-lg-2 control-label">AM/PM</label>
                                        <div class="col-lg-4">
                                                <div class="radio">
                                                        <label>
                                                                <input name="end_time_AMPM" id="end_time_AM" value="0" type="radio">
                                                                AM
                                                        </label>
                                                </div>
                                                <div class="radio">
                                                        <label>
                                                                <input name="end_time_AMPM" id="end_time_PM" value="1" checked="" type="radio">
                                                                PM
                                                        </label>
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
                                        <label for="image" class="col-lg-2 control-label">Upload a photo</label>
                                        <div class="col-lg-6">
                                                <input type="file" name="image" id="image">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @if(count($errors) > 0)
                                                Please correct the errors above and try again.
                                        @endif
                                </p>
                        </div>
                        <div class="col-lg-2">
                                <div class="form-group">
                                        <div class="col-lg-1 col-lg-offset-2">
                                                <button type="submit" class="btn btn-primary">Save event</button>
                                        </div>
                                </div>
                        </div>
                        <div class="col-lg-6">
                                <div class="form-group">
                                        <a href="/events/confirm-delete/{{ $event->id }}">Delete this event</a>
                                        </div>
                        </div>
                </div>
        </fieldset>
</form>
@stop

@section('googleMapsPageBody')
<script src="/css/createEvent.js"></script>
@stop