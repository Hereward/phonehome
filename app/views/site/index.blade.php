@extends('site.layouts.default')

@section('content')



<div class="row">

    <div class="col-lg-6">
        <h2>What's Special About PhoneHome?</h2>
        <p>
            Whether you travel overseas for work or pleasure, it's always important to be reachable by phone. For a fraction of the cost of typical overseas roaming rates,
            PhoneHome.Asia will allow you to make and receive calls back home while you're travelling. Your associates back home will be able to call you using a local
            number, and when you make calls home your caller id will display your local number. You can use this service with any SIM card in any of our listed countries.
        </p>
    </div>

    <div class="col-lg-6">
                <a class="btn btn-success btn-lg btn-block button_container" href="{{{ URL::to('user/login') }}}" role="button">Sign-In</a>
                <a class="btn btn-danger btn-lg btn-block button_container" href="{{{ URL::to('user/create') }}}" role="button">New Account</a>
    </div>


</div>
{{--
<div class="row">

    <div class="col-lg-6">
        <a class="btn btn-primary btn-lg btn-block button_container" href="#" role="button">Take the Tour</a>
    </div>

    <div class="col-lg-6">
        <a class="btn btn-primary btn-lg btn-block button_container" href="#" role="button">Get the Smartphone App</a>
    </div>

</div>
--}}
@stop