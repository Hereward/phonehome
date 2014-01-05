@extends('site.layouts.default_lite')


@section('content')



<div class="row">

    <div class="col-lg-12">
        <h2>Edit Route Profile</h2>

    </div>
</div>

<div class="row">



    <div class="col-lg-12">

        {{ HTML::ul($errors->all()) }}

        {{ Form::model($profile, array('route' => array('profile.update', $profile->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('name', 'Profile Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('user_id', 'User') }}
            <select name="user_id" class="form-control" placeholder="User">
                <option value="">-- choose one --</option>
                @foreach ($users as $user)
                <option @if($profile['user_id'] == $user->id)selected@endif value="{{$user->id}}">{{"$user->username"}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{ Form::label('local', 'Local') }}
            {{ Form::text('local', null, array('class' => 'form-control')) }}
        </div>


        <div class="form-group">
            {{ Form::label('bridge_id', 'Bridge') }}
            <select name="bridge_id" class="form-control" placeholder="Bridge">
                <option value="">-- choose one --</option>
                @foreach ($bridges as $bridge)
                <option @if($profile['bridge_id'] == $bridge->id)selected@endif value="{{$bridge->id}}">{{$bridge->country->short_name}} - {{$bridge->number}}</option>

                @endforeach
            </select>

        </div>


        <div class="form-group">
            {{ Form::label('origin_id', 'Origin') }}
            <select name="origin_id" class="form-control" placeholder="Origin">
                <option value="">-- choose one --</option>
                @foreach ($origins as $origin)
                <option @if($profile['origin_id'] == $origin->id)selected@endif value="{{$origin->id}}">{{$origin->country->short_name}}
                - {{$origin->number}}
                - {{$origin->user->username}}</option>

                @endforeach
            </select>

        </div>



        {{ Form::submit('Save Changes', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}




    </div>


</div>

@stop