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
                    <tr><td class="text-right">Owner Short Name:</td><td class="text-left">{{$profile->user->username}}</td></tr>
                    <tr><td class="text-right">Owner ID:</td><td class="text-left">{{$profile->user->id}}</td></tr>
                    <tr><td class="text-right">Local:</td><td class="text-left">{{$profile->local}}</td></tr>
                    <tr><td class="text-right">Bridge:</td><td class="text-left">{{$profile->bridge_number}}</td></tr>
                    <tr><td class="text-right">Home Number:</td><td class="text-left">{{$profile->home_number}}</td></tr>
                    <tr><td class="text-right">Origin:</td><td class="text-left">{{Origin::find($profile->origin_id)->country->short_name}}</td></tr>
                    <tr><td class="text-right">Remote:</td><td class="text-left">{{Bridge::find($profile->bridge_id)->country->short_name}}</td></tr>
                    <tr><td class="text-right">Status:</td><td class="text-left">{{$profile->status}}</td></tr>

                    <tr>
                        <td class="text-left">
                            {{--<a class="btn btn-small btn-danger" href="{{ URL::to('profile/' . $profile->id . '/delete') }}">Delete</a> --}}
                            {{ Form::open(array('url' => 'profile/' . $profile->id, 'class' => 'pull-left')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete this Profile', array('class' => 'btn btn-warning', 'data-confirm'=>"Are you sure you want to delete this profile?")) }}
                            {{ Form::close() }}

                        </td>
                        <td class="text-right">
                            @if ($profile->status == 'off')
                            <a class="btn btn-small btn-info" href="{{ URL::to('activate/'.$profile->id) }}">Activate</a> &nbsp;
                            @endif
                            <a class="btn btn-small btn-success" href="{{ URL::to('profile/' . $profile->id . '/edit') }}">Edit</a>
                        </td>
                    </tr>


                </table>
           </div>

        </div>


    </div>


</div>

@stop