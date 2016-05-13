@extends('layouts.master')

@section('title')
Karaoke Tracker - Locale Detail
@stop

@section('head')
<script src="/css/localeDetail.js"></script>
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
@if (!is_null($locale))
<div class="row">
        <div class="panel panel-default">
                <div class="panel-body">
                        <div class="row">
                                <div class="col-lg-2">
                                        
                                </div>
                                <div class="col-lg-10">
                                        Locale name: {{ $locale->gm_name }} <br />
                                        Locale address: {{ $locale->gm_formatted_address }} <br />
                                </div>
                        </div>
                </div>
        </div>
</div>
<div class="row">
        <div class="panel panel-default">
                <div class="panel-heading">Ratings for {{ $locale->gm_name }}</div>
                <div class="panel-body">
<div class="row">
        <form name="localeRatingForm" id="localeRatingForm" onsubmit="createRating();
return false;" class="form-horizontal">
                {!! csrf_field() !!}
                <fieldset>
                        <div class="row">
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-10">
                                        <div class="form-group">
                                                <label class="col-lg-2 control-label">Rating</label>
                                                <div class="col-lg-10">
                                                        <div class="radio">
                                                                <label>
                                                                        <input name="locale_rating" id="locale_rating1" value="1" checked="" type="radio">
                                                                        1
                                                                </label>
                                                        </div>
                                                        <div class="radio">
                                                                <label>
                                                                        <input name="locale_rating" id="locale_rating2" value="2" type="radio">
                                                                        2
                                                                </label>
                                                        </div>
                                                        <div class="radio">
                                                                <label>
                                                                        <input name="locale_rating" id="locale_rating3" value="3" type="radio">
                                                                        3
                                                                </label>
                                                        </div>
                                                        <div class="radio">
                                                                <label>
                                                                        <input name="locale_rating" id="locale_rating4" value="4" type="radio">
                                                                        4
                                                                </label>
                                                        </div>
                                                        <div class="radio">
                                                                <label>
                                                                        <input name="locale_rating" id="locale_rating5" value="5" type="radio">
                                                                        5
                                                                </label>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-10">
                                        <div class="form-group">
                                                <label for="locale_comment" class="col-lg-3 control-label">Rate and comment on this locale:</label>
                                                <div class="col-lg-9">
                                                        <input class="form-control" name="locale_comment" id="locale_comment" placeholder="" type="text" value="">
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
                                                <input name="locale_id" id="locale_id" type="hidden" value="{{ $locale->id }}">
                                                <div class="col-lg-1 col-lg-offset-2">
                                                        <button type="submit" class="btn btn-primary">Rate this locale</button>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </fieldset>
        </form>
</div>
<div class="row">
        <div name="ratings" id="ratings">
                @foreach ($locale->ratings as $rating)
                <p>
                        On {{ $rating->updated_at }} <a href="/users/{{ $rating->rater->id }}">{{ $rating->rater->user_name }}</a> gave {{ $locale->gm_name }} a rating of {{ $rating->rating }} and commented: {{ $rating->comment }}
                </p>
                @endforeach
        </div>
</div>
                </div>
</div>
@endif
@stop

@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
@stop