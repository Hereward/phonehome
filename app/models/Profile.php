<?php

class Profile extends Eloquent
{
    // Artist __has_many__ Album
    public function country()
    {
        return $this->belongsTo('Country');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function origin()
    {
        return $this->belongsTo('Origin');
    }

    public function bridge()
    {
        return $this->belongsTo('Bridge');
    }

}