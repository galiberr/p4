@extends('layouts.master')

@section('title')
Karaoke Tracker User Detail
@stop

@section('head')

@stop

@section('content')
<div class="panel panel-primary">
        <div class="panel-heading">
                <h3 class="panel-title">User Profile</h3>
        </div>
        <div class="panel-body">
                {{-- Photo --}}
                <div class="col-lg-3">
                        <img src="/assets/uploads/sample/elton_john2.jpg" alt="Elton John">
                </div>
                {{-- Description --}}
                <div class="col-lg-9">
                        <table class="table table-striped table-hover ">
                                <tbody>
                                        <tr>
                                                <td>User ID</td>
                                                <td>captainfantastic</td>
                                        </tr>
                                        <tr>
                                                <td>Name</td>
                                                <td>Reggie Dwight</td>
                                        </tr>
                                        <tr>
                                                <td>Singer/KJ</td>
                                                <td>Singer</td>
                                        </tr>
                                        <tr>
                                                <td>About me</td>
                                                <td>Enjoy doing karaoke, the larger the crowd the better.</td>
                                        </tr>
                                        <tr>
                                                <td>Email</td>
                                                <td>rdwight@gmail</td>
                                        </tr>
                                </tbody>
                        </table> 

                </div>
        </div>
</div>
@stop

@section('body')

@stop