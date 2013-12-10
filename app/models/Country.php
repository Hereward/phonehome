<?php

class Country extends Eloquent
{
    // Artist __has_many__ Album
    public function profiles()
    {
        return $this->hasMany('Profile');
    }

    public function origins()
    {
        return $this->hasMany('Origin');
    }
}