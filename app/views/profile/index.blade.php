@extends('site.layouts.default_lite')

@section('content')



<div class="row">

    <div class="col-lg-12">
        <h2>Phone Routing Profiles</h2>

    </div>
</div>

@if (Session::has('message'))
<div class="row">
    <div class="col-lg-12">
       <div class="alert alert-info">{{ Session::get('message') }}</div>
    </div>
</div>
@endif

<div class="row">

    <div class="col-lg-8">

        <div class="table-responsive">

        <table class="table profiles">
            <thead>
            <tr>
                <th>Name</th>
                <th>Origin</th>
                <th>Remote</th>
                <th>Local</th>
                <th>Bridge</th>
                <th>Home</th>

                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($profiles as $profile)

            <tr>

                <td>{{$profile->name}}</td>
                <td>{{Origin::find($profile->origin_id)->country->short_name}}</td>
                <td>{{Bridge::find($profile->bridge_id)->country->short_name}}</td>
                <td>{{$profile->local}}</td>
                <td>{{$profile->bridge_number}}</td>
                <td>{{$profile->home_number}}</td>

                <td>{{$profile->status}}</td>
                <td><a class="btn btn-small btn-success" href="{{ URL::to('profile/' . $profile->id) }}">Details</a></td>

            </tr>
            @endforeach


            </tbody>
        </table>
        </div>
{{--{{$profile->country_short_name}}--}}
{{-- {{Origin::find($profile->origin_id)->country->short_name}} --}}

    </div>

    <div class="col-lg-4">
        <ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
            <li class="active"><a href="{{{ URL::to('profile') }}}">Current Profiles</a></li>
            @if (Auth::user()->hasRole('admin'))
               <li><a href="{{{ URL::to('profile/create') }}}">Add New Profile</a></li>
            @endif
            <li><a href="#">Request Number</a></li>
        </ul>
    </div>


</div>

@stop