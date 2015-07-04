@extends('master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Change your password</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form action="{{ url('user/save-new-password') }}" method="POST">

            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div class="form-group">
                <input type="password" name="current_password"
                       id="current_password" placeholder="Enter current password"
                       class="form-control"/>
            </div>

            <div class="form-group">
                <input type="password" name="new_password"
                       id="new_password" placeholder="Enter your new password"
                       class="form-control"/>
            </div>

            <div class="form-group">
                <input type="password" name="confirm_new_password"
                       id="confirm_new_password" placeholder="Confirm your new password"
                       class="form-control"/>
            </div>

            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
