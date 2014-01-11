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
                <th>Status</th>
                <th>Name</th>
                @if (Auth::user()->hasRole('admin'))
                  <th>Owner</th>
                @endif

                <th>Origin</th>
                <th>Remote</th>
                <th>Local</th>
                <th>Bridge</th>
                <th>Home</th>


            </tr>
            </thead>
            <tbody>
            @foreach ($profiles as $profile)

            <tr>
                <td><button title="{{$profile->status}}" type="button" class="btn btn-@if ($profile->status == 'active'){{'success'}}
                @elseif ($profile->status == 'off'){{'danger'}}
                @else{{'warning'}}@endif">&nbsp;&nbsp;</button></td>
                <td>{{$profile->name}}</td>
                @if (Auth::user()->hasRole('admin'))
                  <td>{{$profile->user->username}}</td>
                @endif
                <td>{{Origin::find($profile->origin_id)->country->short_name}}</td>
                <td>{{Bridge::find($profile->bridge_id)->country->short_name}}</td>
                <td>{{$profile->local}}</td>
                <td>{{$profile->bridge_number}}</td>
                <td>{{$profile->home_number}}</td>


                <td><a href="{{ URL::to('profile/' . $profile->id) }}">Details</a></td>

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
            <li>
            @if (Auth::user()->hasRole('admin'))
               <a href="{{{ URL::to('profile/create') }}}">Add New Profile</a>
            @else
                <a href="{{{ URL::to('profile/create') }}}">Request New Profile</a>
            @endif
            </li>
            <li><a href="#">Request Number</a></li>
        </ul>
    </div>


</div>

@stop