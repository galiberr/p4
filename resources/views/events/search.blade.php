@extends('layouts.googleMapsPage')

@section('title')
KaraokeTracker - Search events
@stop

@section('googleMapsPageHead')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
@stop

@section('navbar')
@if (strcmp(\Auth::user()->roles()->first()->role, 'KJ') == 0)
        <li><a href="/events/create">Create a new event</a></li>
        <li><a href="/events/myEvents">See my events</a></li>
        <li><a href="/users/editMyProfile">Edit my profile</a></li>
        <li class="active"><a href="#">Search events<span class="sr-only">(current)</span></a></li>
        <li><a href="http://www.lyricsworld.com/" target="_blank">Look up lyrics</a></li>
        <li><a href="http://www.soundhound.com/" target="_blank">Find song by singing</a></li>
@else
        <li class="active"><a href="#">Search events<span class="sr-only">(current)</span></a></li>
        <li><a href="/users/editMyProfile">Edit my profile</a></li>
        <li><a href="http://www.lyricsworld.com/" target="_blank">Look up lyrics</a></li>
        <li><a href="http://www.soundhound.com/" target="_blank">Find song by singing</a></li>
@endif
@stop

@section('googleMapsPageContent')
Find events in your area within the specified radius. You can also use the Google Map at the right
to change your search center.
<div class="row">
<form name="eventSearchForm" id="eventSearchForm" method="POST" action="/events/search">
                {{ csrf_field() }}
        <div class="form-group">
                <label class="col-lg-2 control-label">Radius</label>
                <div class="col-lg-10">
                        <div class="radio">
                                <label>
                                        <input name="radius" id="radius5" value="5" checked="" type="radio">
                                        5
                                </label>
                        </div>
                        <div class="radio">
                                <label>
                                        <input name="radius" id="radius10" value="10" type="radio">
                                        10
                                </label>
                        </div>
                        <div class="radio">
                                <label>
                                        <input name="radius" id="radius25" value="25" type="radio">
                                        25
                                </label>
                        </div>
                        <div class="radio">
                                <label>
                                        <input name="radius" id="radius50" value="50" type="radio">
                                        50
                                </label>
                        </div>
                        <div class="radio">
                                <label>
                                        <input name="radius" id="radius100" value="100" type="radio">
                                        100
                                </label>
                        </div>
                </div>
                <input type="hidden" name="gm_lat" id="gm_lat" value="" />
                <input type="hidden" name="gm_lng" id="gm_lng" value="" />
        </div>
</form>
</div>

<div id='results'></div>
@stop

@section('googleMapsPageBody')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/css/searchEvent.js"></script>
@stop