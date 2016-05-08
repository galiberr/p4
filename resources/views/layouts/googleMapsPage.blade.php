@extends('layouts.master')

@section('content')
<div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-8">
                {{-- Google Maps page content --}}
                @yield('googleMapsPageContent')
        </div>
</div>
@stop

@section('body')

@stop