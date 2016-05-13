@extends('layouts.master')

@section('title')
KaraokeTracker - Confirm Event Deletion
@stop

@section('head')
@stop

@section('content')
<p>Are you sure you want to delete the event below?<a href="/events/delete/{{ $event->id }}">Delete</a> <a href="/">Cancel</a></p>
<div class="row">
        <div class="col-lg-2">
                @if ($event->image)
                <img src="/assets/uploads/events/{{ $event->id }}/display_image" alt="Event image">
                @endif
        </div>
        <div class="col-lg-10">
                <table class="table table-hover ">
                        <tbody>
                                <tr>
                                        <td>Locale name</td>
                                        <td>{{ $event->locale->gm_name }}</td>
                                </tr>
                                <tr>
                                        <td>Locale address</td>
                                        <td>{{ $event->locale->gm_formatted_address }}</td>
                                </tr>
                                <tr>
                                        <td>Event title</td>
                                        <td>{{ $event->title }}</td>
                                </tr>
                                <tr>
                                        <td>Event description</td>
                                        <td>{{ $event->description }}</td>
                                </tr>
                        </tbody>
                </table>
        </div>
</div>
@stop

@section('body')
@stop