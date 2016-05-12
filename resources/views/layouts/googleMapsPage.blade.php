@extends('layouts.master')

@section('head')
@yield('googleMapsPageHead')
<link href='/css/googleMaps.css' rel='stylesheet'>
@stop

@section('content')
<div class="row">
        <div class="col-lg-8">
                {{-- Google Maps page content --}}
                @yield('googleMapsPageContent')
        </div>
        <div class="col-lg-4">
                <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                <div id="map"></div>
        </div>
</div>
@stop

@section('body')
@yield('googleMapsPageBody')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0dqL134UviB9iw-Eqaj2aKjUCBLCsezM&libraries=places&callback=initAutocomplete"
async defer></script>
@stop