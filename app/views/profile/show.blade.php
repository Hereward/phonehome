@extends('site.layouts.default_lite')


@section('content')



<div class="row">

    <div class="col-lg-12">
        <h2>Showing Profile: {{ $profile->name }}</h2>

    </div>
</div>

<div class="row">

    <div class="col-lg-12">

        <div class="jumbotron text-center">

            <div class="table-responsive">
                <table class="table profiles">
                    <tr><td class="text-right">Local:</td><td class="text-left">{{$profile->local}}</td></tr>
                    <tr><td class="text-right">Bridge:</td><td class="text-left">{{$profile->bridge_number}}</td></tr>
                    <tr class="text-right"><td>Home Number:</td><td class="text-left">{{$profile->home_number}}</td></tr>
                    <tr class="text-right"><td>Origin:</td><td class="text-left">{{Origin::find($profile->origin_id)->country->short_name}}</td></tr>
                    <tr class="text-right"><td>Remote:</td><td class="text-left">{{Bridge::find($profile->bridge_id)->country->short_name}}</td></tr>

                    <tr class="text-right"><td colspan="2"><a class="btn btn-small btn-success" href="{{ URL::to('profile/' . $profile->id . '/edit') }}">Edit</a></td></tr>
                </table>
           </div>

        </div>


    </div>


</div>

@stop