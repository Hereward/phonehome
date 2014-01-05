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

        <div class="form-group">
            {{ Form::label('name', 'Profile Name') }}
            {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
        </div>
{{--
        <div class="form-group">
            {{ Form::label('user_id', 'User') }}
            <select name="user_id" class="form-control" placeholder="User">
                <option value="">-- choose one --</option>
                @foreach ($users as $user)
                    <option @if(Input::old('user_id') == $user->id)selected@endif value="{{$user->id}}">{{"$user->username"}}</option>
                @endforeach
            </select>
        </div>
--}}


        <div class="form-group">
            {{ Form::label('local', 'Local') }}
            {{ Form::text('local', Input::old('local'), array('class' => 'form-control')) }}
        </div>


        <div class="form-group">
            {{ Form::label('bridge_id', 'Bridge') }}
            <select name="bridge_id" class="form-control" placeholder="Bridge">
                <option value="">-- choose one --</option>
                @foreach ($bridges as $bridge)
                <option @if(Input::old('bridge_id') == $bridge->id)selected@endif value="{{$bridge->id}}">{{$bridge->country->short_name}} - {{$bridge->number}}</option>

                @endforeach
            </select>

        </div>


        <div class="form-group">
            {{ Form::label('origin_id', 'Origin') }}
            <select name="origin_id" class="form-control" placeholder="Origin">
                <option value="">-- choose one --</option>
                @foreach ($origins as $origin)
                  <option @if(Input::old('origin_id') == $origin->id)selected@endif value="{{$origin->id}}">{{$origin->country->short_name}} - {{$origin->number}}</option>

                @endforeach
            </select>

        </div>
{{--
        <div class="form-group">
            {{ Form::label('country_id', 'Target Country') }}
            <select name="country_id" class="form-control" placeholder="Origin">
                <option value="">-- choose one --</option>
                @foreach ($countries as $country)
                <option @if(Input::old('country_id') == $country->id)selected@endif value="{{$country->id}}">{{"$country->code - {$country->name}"}}</option>

                @endforeach
            </select>

        </div>
--}

{{--
        <div class="form-group">
            {{ Form::label('nerd_level', 'Nerd Level') }}
            {{ Form::select('nerd_level', array('0' => 'Select a Level', '1' => 'Sees Sunlight', '2' => 'Foosball Fanatic', '3' => 'Basement Dweller'), Input::old('nerd_level'), array('class' => 'form-control')) }}
        </div>
--}}
       {{ Form::submit('Create Profile', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}



    </div>


</div>

@stop