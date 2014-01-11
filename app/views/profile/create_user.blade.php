@extends('site.layouts.default_lite')


@section('content')



<div class="row">

    <div class="col-lg-12">
        <h2>Request Route Profile</h2>

    </div>
</div>

<div class="row">

    <div class="col-lg-12">

        {{ HTML::ul($errors->all()) }}

        {{ Form::open(array('url' => 'profile')) }}

        {{ Form::hidden('user_id', $user_id) }}

        {{ Form::hidden('bridge_id', $bridge_id) }}

        {{ Form::hidden('origin_id', $origin_id) }}

        {{ Form::hidden('status', 'pending') }}

        <div class="form-group">
            {{ Form::label('name', 'Profile Name') }}
            {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
        </div>


        <div class="form-group">
            {{ Form::label('local', 'Local') }}
            {{ Form::text('local', Input::old('local'), array('class' => 'form-control')) }}
        </div>

       {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}



    </div>


</div>

@stop