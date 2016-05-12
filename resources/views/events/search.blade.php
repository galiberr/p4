@extends('layouts.googleMapsPage')

@section('title')
KaraokeTracker - Search for events
@stop

@section('googleMapsPageHead')

@stop

@section('googleMapsPageContent')
        <input type="hidden" name="placeResult" id="placeResult" value="" />
        <div id='results'></div>
@stop

@section('googleMapsPageBody')
        <script>var callAjax = true;</script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
@stop