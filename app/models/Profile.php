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

/*
    public function get_relations($rec_id) {
        return $this
            ->join('origins', 'profiles.origin_id', '=', 'origins.id')
            ->join('bridges', 'profiles.bridge_id', '=', 'bridges.id')
            ->select('profiles.id', 'profiles.user_id', 'profiles.name', 'profiles.local', 'profiles.status','origins.id as origin_id',
                'origins.number as home_number','bridges.id as bridge_id', 'bridges.number as bridge_number')
            ->where('profiles.id', '=', $rec_id)
            ->first();
    }
*/
    public function get_relations($rec_id) {
        return $this
            ->join('origins', 'profiles.origin_id', '=', 'origins.id')
            ->join('bridges', 'profiles.bridge_id', '=', 'bridges.id')
            ->select('profiles.id', 'profiles.user_id', 'profiles.name', 'profiles.local', 'profiles.status','profiles.origin_id',
                'profiles.bridge_id', 'origins.number as home_number', 'bridges.number as bridge_number')
            ->where('profiles.id', '=', $rec_id)
            ->first();
    }





}