<?php

class Origin extends Eloquent
{
    // Artist __has_many__ Album
    public function profiles()
    {
        return $this->hasMany('Profile');
    }

    public function country()
    {
        return $this->belongsTo('Country');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }
}