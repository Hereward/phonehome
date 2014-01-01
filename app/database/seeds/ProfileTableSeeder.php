<?php

class ProfileTableSeeder extends Seeder {

    public function run()
    {
        DB::table('profiles')->delete();
        DB::table('origins')->delete();
        DB::table('bridges')->delete();
        DB::table('countries')->delete();




        DB::table('countries')->insert(
            array(
                array('code' => '61', 'short_name' => 'AU', 'name' => 'Australia','created_at' => new DateTime,
                    'updated_at' => new DateTime),
                array('code' => '66', 'short_name' => 'TH', 'name' => 'Thailand','created_at' => new DateTime,
                    'updated_at' => new DateTime),
                array('code' => '84', 'short_name' => 'VN', 'name' => 'Vietnam','created_at' => new DateTime,
                    'updated_at' => new DateTime),
                array('code' => '64', 'short_name' => 'NZ', 'name' => 'New Zealand','created_at' => new DateTime,
                    'updated_at' => new DateTime),
            ));


        //$country = DB::table('countries')->where('code', '61')->first();

        //$country->where('code', '61')->first();

       // $country = Country::where('code', '=', 61)->firstOrFail();


        $country = Country::where('code', '=', 64)->first();
        $user = User::find(2);
        $origin = new Origin;
        $origin->name = 'NZ';
        $origin->number = '0286689234';
        $origin->user()->associate($user);
        $origin->country()->associate($country);
        $origin->save();


        $country = Country::where('code', '=', 61)->first();
        $user = User::find(1);
        $origin = new Origin;
        $origin->name = 'Home';
        $origin->number = '0286689234';
        $origin->user()->associate($user);
        $origin->country()->associate($country);
        $origin->save();


        $country = Country::where('code', '=', 66)->first();

        $bridge = new Bridge;
        $bridge->number = '0600035178';
        $bridge->country()->associate($country);
        $bridge->save();

        $bridge = new Bridge;
        $bridge->number = '0600035179';
        $bridge->country()->associate($country);
        $bridge->save();


        $user = User::find(1);
        //die("USER ID = $user->id");

        $profile = new Profile;
        $profile->name = 'Example';
        $profile->user()->associate($user);
        $profile->origin()->associate($origin);
        $profile->local = '0917070883';
        $profile->bridge()->associate($bridge);
        //$profile->country_id = $country->id;
        $profile->save();

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
