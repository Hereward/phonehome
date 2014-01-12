<?php

class ProfileTableSeeder extends Seeder {

    public function run()
    {
        DB::table('profiles')->delete();
        DB::table('origins')->delete();
        DB::table('bridges')->delete();
        DB::table('profile_create_requests')->delete();
        DB::table('profile_update_requests')->delete();
        DB::table('countries')->delete();




        DB::table('countries')->insert(
            array(
                array('code' => '0', 'short_name' => '--', 'name' => 'Empty','created_at' => new DateTime,
                    'updated_at' => new DateTime),
                array('code' => '61', 'short_name' => 'AU', 'name' => 'Australia','created_at' => new DateTime,
                    'updated_at' => new DateTime),
                array('code' => '66', 'short_name' => 'TH', 'name' => 'Thailand','created_at' => new DateTime,
                    'updated_at' => new DateTime),
                array('code' => '84', 'short_name' => 'VN', 'name' => 'Vietnam','created_at' => new DateTime,
                    'updated_at' => new DateTime),
                array('code' => '64', 'short_name' => 'NZ', 'name' => 'New Zealand','created_at' => new DateTime,
                    'updated_at' => new DateTime),
            ));

        $user = User::find(2);

        // Setup Thailand bridge
        $country = Country::where('code', '=', 66)->first();
        $thailand_bridge = new Bridge;
        $thailand_bridge->number = '+66298763456';
        $thailand_bridge->country()->associate($country);
        $thailand_bridge->save();

        // Setup Vietnam bridge
        $country = Country::where('code', '=', 84)->first();
        $vietnam_bridge = new Bridge;
        $vietnam_bridge->number = '+84260003517';
        $vietnam_bridge->country()->associate($country);
        $vietnam_bridge->save();

        // Setup Main Origin
        $country = Country::where('code', '=', 61)->first();
        $origin = new Origin;
        $origin->name = 'Home';
        $origin->number = '+61286689235';
        $origin->user()->associate($user);
        $origin->country()->associate($country);
        $origin->save();

        // PROFILE 1 (Thailand)
        $profile = new Profile;
        $profile->name = 'Thailand';
        $profile->user()->associate($user);
        $profile->origin()->associate($origin);
        $profile->local = '+66917070884';
        $profile->status = 'active';
        $profile->bridge()->associate($thailand_bridge);
        $profile->save();

        // PROFILE 2 (Vietnam)
        $profile = new Profile;
        $profile->name = 'Vietnam';
        $profile->user()->associate($user);
        $profile->origin()->associate($origin);
        $profile->local = '+84917070883';
        $profile->status = 'off';
        $profile->bridge()->associate($vietnam_bridge);
        $profile->save();

/*
        $origin = new Origin;
        $origin->name = 'NZ';
        $origin->number = '0286689234';
        $origin->user()->associate($user);
        $origin->country()->associate($country);
        $origin->save();
*/


        // DUMMY VALUES
        $country = Country::where('code', '=', 0)->first();

        $user = User::find(1);
        $origin = new Origin;
        $origin->name = 'Empty';
        $origin->number = '00000000';
        $origin->user()->associate($user);
        $origin->country()->associate($country);
        $origin->save();

        $bridge = new Bridge;
        $bridge->number = '00000000';
        $bridge->country()->associate($country);
        $bridge->save();

/*

        $profile = array(
            array(

                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(

                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
        );

        DB::table('profile')->insert( $profile );
*/
    }

}
