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



                    <div><strong>Owner Short Name:</strong> {{$profile->user->username}}</div>



            <div><strong>Owner ID:</strong> {{$profile->user->id}}</div>
            <div><strong>Local:</strong> {{$profile->local}}</div>
            <div><strong>Bridge:</strong> {{$profile->bridge_number}}</div>
            <div><strong>Home Number:</strong> {{$profile->home_number}}</div>
            <div><strong>Origin:</strong> {{Origin::find($profile->origin_id)->country->short_name}}</div>
            <div><strong>Remote:</strong> {{Bridge::find($profile->bridge_id)->country->short_name}}</div>
            <div><strong>Status:</strong> {{$profile->status}}</div>


        </div>

        <div style="margin-top:10px;">
            <div class="pull-left">
                {{--<a class="btn btn-small btn-danger" href="{{ URL::to('profile/' . $profile->id . '/delete') }}">Delete</a> --}}
                {{ Form::open(array('url' => 'profile/' . $profile->id, 'class' => 'pull-left')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete this Profile', array('class' => 'btn btn-warning', 'data-confirm'=>"Are you sure you want to delete this profile?")) }}
                {{ Form::close() }}

            </div>
            <div class="pull-right">
                @if ($profile->status == 'off')
                <a class="btn btn-small btn-info" href="{{ URL::to('activate/'.$profile->id) }}">Activate</a> &nbsp;
                @endif
                <a class="btn btn-small btn-success" href="{{ URL::to('profile/' . $profile->id . '/edit') }}">Edit</a>
            </div>
        </div>

    </div>


</div>

@stop