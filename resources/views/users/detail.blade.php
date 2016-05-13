@extends('layouts.master')

@section('title')
Karaoke Tracker - User Detail
@stop

@section('head')
<script src="/css/userDetail.js"></script>
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
@if (!is_null($user))
<div class="row">
        <div class="panel panel-default">
                <div class="panel-body">
                        <div class="row">
                                <div class="col-lg-2">
                                        <img src="/assets/uploads/users/{{ $user->id }}/display_image" alt="User image" />
                                </div>
                                <div class="col-lg-10">
                                        User name: {{ $user->user_name }} <br />
                                        Real name: {{ $user->first_name }} {{ $user->last_name }} <br />
                                        User type: {{ $user->roles()->first()->role }} <br />
                                        About me: {{ $user->about_me }}<br />
                                </div>
                        </div>
                </div>
        </div>
</div>
@if ($user->roles()->first()->role === 'KJ')
<div class="row">
        <div class="panel panel-default">
                <div class="panel-heading">Ratings for KJ {{ $user->user_name }}</div>
                <div class="panel-body">
<div class="row">
        <form name="kjRatingForm" id="kjRatingForm" onsubmit="createRating();
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
                                                                        <input name="kj_rating" id="kj_rating1" value="1" checked="" type="radio">
                                                                        1
                                                                </label>
                                                        </div>
                                                        <div class="radio">
                                                                <label>
                                                                        <input name="kj_rating" id="kj_rating2" value="2" type="radio">
                                                                        2
                                                                </label>
                                                        </div>
                                                        <div class="radio">
                                                                <label>
                                                                        <input name="kj_rating" id="kj_rating3" value="3" type="radio">
                                                                        3
                                                                </label>
                                                        </div>
                                                        <div class="radio">
                                                                <label>
                                                                        <input name="kj_rating" id="kj_rating4" value="4" type="radio">
                                                                        4
                                                                </label>
                                                        </div>
                                                        <div class="radio">
                                                                <label>
                                                                        <input name="kj_rating" id="kj_rating5" value="5" type="radio">
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
                                                <label for="kj_comment" class="col-lg-3 control-label">Rate and comment on this KJ:</label>
                                                <div class="col-lg-9">
                                                        <input class="form-control" name="kj_comment" id="kj_comment" placeholder="" type="text" value="">
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
                                                <input name="kj_id" id="kj_id" type="hidden" value="{{ $user->id }}">
                                                <div class="col-lg-1 col-lg-offset-2">
                                                        <button type="submit" class="btn btn-primary">Rate this KJ</button>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </fieldset>
        </form>
</div>
<div class="row">
        <div name="ratings" id="ratings">
                @foreach ($user->ratings as $rating)
                <div class="row">
                        <div class="col-lg-6">
                                <p>
                                        On {{ $rating->updated_at }} <a href="/users/{{ $rating->rater->id }}">{{ $rating->rater->user_name }}</a> gave {{ $user->user_name }} a rating of {{ $rating->rating }} and commented:
                                </p>
                        </div>
                        <div class="col-lg-6">
                                <p>
                @if ($rating->rater->image)
                <img src="/assets/uploads/users/{{ $rating->rater->id }}/thumbnail" alt="Rater thumbnail">
                @endif                        
                                        {{ $rating->comment }}
                </p>
                
        </div>
</div>
                @endforeach
        </div>
</div>
                </div>
</div>
@endif
@endif
@stop

@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
@stop