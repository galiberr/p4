@extends('layouts.master')

@section('title')
KaraokeTracker - Confirm User Deletion
@stop

@section('head')
@stop

@section('content')
<p>Are you sure you want to your KaraokeTracker user profile completely? You will no longer have access to KaraokeTracker.<br />
        <a href="/users/delete/{{ $user->id }}">Delete</a> <a href="/">Cancel</a></p>
<div class="row">
</div>
@stop

@section('body')
@stop