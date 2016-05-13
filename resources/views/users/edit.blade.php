@extends('layouts.master')

@section('title')
KTracker - Update User Profile
@stop

@section('head')
@stop

@section('content')
<form name="editForm" id="editForm" method='POST' action='/users/{{ $user->id }}/edit' class="form-horizontal" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <fieldset>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label class="col-lg-2 control-label">I am a:</label>
                                        <div class="col-lg-10">
                                                <div class="radio">
                                                        <label>
                                                                <input name="inputUserType" id="inputUserType1" value="0" <?php if (strcmp($user->roles()->first()->role, "KJ") == 0) echo "checked" ?> type="radio">
                                                                KJ
                                                        </label>
                                                </div>
                                                <div class="radio">
                                                        <label>
                                                                <input name="inputUserType" id="inputUserType2" value="1" <?php if (strcmp($user->roles()->first()->role, "Singer") == 0) echo "checked" ?> type="radio">
                                                                Singer
                                                        </label>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('user_id') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="user_name" class="col-lg-2 control-label">User ID</label>
                                        <div class="col-lg-3">
                                                <input class="form-control" name="user_name" id="user_name" placeholder="User name" type="text" value="{{ $user->user_name }}" readonly>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('password') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="password" class="col-lg-2 control-label">Password</label>
                                        <div class="col-lg-3">
                                                <input class="form-control" name="password" id="password" placeholder="Password" type="password">
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
                                        <label for="password_confirmation" class="col-lg-2 control-label">Confirm password</label>
                                        <div class="col-lg-3">
                                                <input class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" type="password">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('email') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="email" class="col-lg-2 control-label">Email address</label>
                                        <div class="col-lg-3">
                                                <input class="form-control" name="email" id="email" placeholder="Your email address" type="text" value="{{ $user->email }}">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('first_name') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="first_name" class="col-lg-2 control-label">First name</label>
                                        <div class="col-lg-3">
                                                <input class="form-control" name="first_name" id="first_name" placeholder="Your first name" type="text" value="{{ $user->first_name }}">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('last_name') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="last_name" class="col-lg-2 control-label">Last name</label>
                                        <div class="col-lg-3">
                                                <input class="form-control" name="last_name" id="last_name" placeholder="Your last name" type="text" value="{{ $user->last_name }}">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('street_addr1') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="street_addr1" class="col-lg-2 control-label">Address 1</label>
                                        <div class="col-lg-3">
                                                <input class="form-control" name="street_addr1" id="street_addr1" placeholder="Address line 1" type="text" value="{{ $user->street_addr1 }}">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('street_addr2') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="street_addr2" class="col-lg-2 control-label">Address 2</label>
                                        <div class="col-lg-3">
                                                <input class="form-control" name="street_addr2" id="street_addr2" placeholder="Address line 2" type="text" value="{{ $user->street_addr2 }}">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('city') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="city" class="col-lg-2 control-label">City</label>
                                        <div class="col-lg-3">
                                                <input class="form-control" name="city" id="city" placeholder="City" type="text" value="{{ $user->city }}">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('state') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="state" class="col-lg-2 control-label">State</label>
                                        <div class="col-lg-4">
                                                <input class="form-control" name="state" id="state" placeholder="State" type="text" value="{{ $user->state }}">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('zip') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="zip" class="col-lg-2 control-label">Zip</label>
                                        <div class="col-lg-4">
                                                <input class="form-control" name="zip" id="zip" placeholder="Zip code" type="text" value="{{ $user->zip }}">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('about_me') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="textArea" class="col-lg-2 control-label">About me</label>
                                        <div class="col-lg-10">
                                                <textarea class="form-control" rows="3" name="about_me" id="about_me">{{ $user->about_me }}</textarea>
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
                                        <label for="image" class="col-lg-2 control-label">Upload your picture</label>
                                        <div class="col-lg-3">
                                                <input type="file" name="image" id="image">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('credit_card') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="credit_card" class="col-lg-2 control-label">Credit card (KJs only)</label>
                                        <div class="col-lg-4">
                                                <input class="form-control" name="credit_card" id="credit_card" placeholder="Credit card number" type="text">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('cc_exp_month') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="cc_exp_month" class="col-lg-2 control-label">Expiration month</label>
                                        <div class="col-lg-4">
                                                <input class="form-control" name="cc_exp_month" id="cc_exp_month" placeholder="Credit card month of expiration" type="text">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('cc_exp_year') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="cc_exp_year" class="col-lg-2 control-label">Expiration year</label>
                                        <div class="col-lg-4">
                                                <input class="form-control" name="cc_exp_year" id="cc_exp_year" placeholder="Credit card year of expiration" type="text">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->get('xkcd_min_length') as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                </p>
                        </div>
                        <div class="col-lg-10">
                                <div class="form-group">
                                        <label for="cc_csv" class="col-lg-2 control-label">CSV</label>
                                        <div class="col-lg-4">
                                                <input class="form-control" name="cc_csv" id="cc_csv" placeholder="Credit card CSV" type="text">
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-2">
                                <p class="text-danger">
                                        @foreach ($errors->all() as $error)
                                        {{ $error }}<br/>
                                        @endforeach
                                        @if(count($errors) > 0)
                                                Please correct the errors above and try again.
                                        @endif
                                </p>
                        </div>
                        <div class="col-lg-2">
                                <div class="form-group">
                                        <div class="col-lg-1 col-lg-offset-2">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                </div>
                        </div>
                        <div class="col-lg-6">
                                <div class="form-group">
                                        <a href="/users/confirm-delete/{{ $user->id }}">Delete this user profile</a>
                                        </div>
                        </div>
                </div>
        </fieldset>
</form>
@stop

@section('body')
@stop