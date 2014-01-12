<?php

class ProfileController extends \BaseController {

    public $origins, $bridges, $countries, $users, $profile_obj;

    public function __construct() {
        parent::__construct();

        $this->origins = Origin::all();
        $this->bridges = Bridge::all();
        $this->countries = Country::all();
        $this->users = User::all();
        $this->profile_obj = new Profile;
        $this->get_dummy_values();

    }

    public function get_dummy_values() {
        $this->dummy_origin = Origin::where('number', '=', '00000000')->first();
        $this->dummy_bridge = Bridge::where('number', '=', '00000000')->first();
    }


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $data = array();
        //$user = new User;
        $p = new Profile;

        //$countries = Country::all();
        // $origins = Origin::all();

        //die($origins_dropdown);
        //$origins->toArray();
        //die(var_dump($origins->toArray()));
        $user_id = $this->current_user->id;
        $profiles = $p
            ->join('origins', 'profiles.origin_id', '=', 'origins.id')
            ->join('bridges', 'profiles.bridge_id', '=', 'bridges.id')
            ->select('profiles.id', 'profiles.user_id', 'profiles.name', 'profiles.local', 'profiles.status','origins.id as origin_id',
                'origins.number as home_number','bridges.id as bridge_id', 'bridges.number as bridge_number');
           // ->where('user_id', $user_id)->get();

        if (Auth::user()->hasRole('admin')) {
            $profiles = $profiles->get();
        } else {
            $profiles = $profiles->where('profiles.user_id', $user_id)->get();
        }

        $data['profiles'] = $profiles;
        // $data['countries'] = $countries;

        // $data['boojam'] = 'wee';

        return View::make('profile/index',$data);

	}



    private function getOriginDropDown() {
        $dd_obj = Origin::all()->lists('origin','id');
        //$dd_obj[0] = 'Origin';
        //array_unshift($dd_obj,'Origin');

        //die(var_dump($dd_obj));
        $origins_dropdown = Form::select('origin',$dd_obj,Input::old('origin'), array(
            "placeholder" => "Origin",
            'class' => 'form-control'
        ));

        return $origins_dropdown;
   }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

        /*
        $origins = Origin::all();
        $bridges = Bridge::all();
        $countries = Country::all();
        $users = User::all();
        */

        $user_id = $this->current_user->id;

        $data = array();
        //$data['origins_dropdown'] = $this->getOriginDropDown();
        $data['origins'] = $this->origins;
        $data['bridges'] = $this->bridges;
        $data['countries'] = $this->countries;
        $data['users'] = $this->users;
        $data['user_id'] = $this->current_user->id;

        if (Auth::user()->hasRole('admin')) {
            return View::make('profile/create_admin',$data);
        }
        else {
            $data['bridge_id'] = $this->dummy_bridge->id;
            $data['origin_id'] = $this->dummy_origin->id;
            return View::make('profile/create_user',$data);
        }

	}



	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation

        $rules = '';

        if (Auth::user()->hasRole('admin')) {
            $rules = array(
                'name'          => 'required',
                'user_id'       => 'required',
                'local'       => 'required',
                'bridge_id'       => 'required',
                'origin_id'       => 'required',
            );
        }
        else {
            $rules = array(
                'name'          => 'required',
                'user_id'       => 'required',
                'local'       => 'required'
            );
        }




        /*
         *  'email'      => 'required|email',
            'nerd_level' => 'required|numeric'
         */

        $validator = Validator::make(Input::all(), $rules);


       // die("Current User = [ ".$user->currentUser()->id. " ]");

        // process the login
        if ($validator->fails()) {
            return Redirect::to('profile/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            //$user = new User;
            $profile = new Profile;
            $profile->name        = Input::get('name');
            $profile->user_id     = Input::get('user_id');
            $profile->local       = Input::get('local');
            $profile->bridge_id      = Input::get('bridge_id');
            $profile->origin_id = Input::get('origin_id');
            $profile->status = Input::get('status');
           // $profile->country_id = Input::get('country_id');


            //$profile->user_id = $this->user->currentUser()->id;
            $profile->save();

            $profile_id = $profile->id;
           // $origin = Country::find($id);
            //$timestamp = new DateTime;
            $timestamp = date('Y-m-d H:i:s');

            DB::table('profile_create_requests')->insert(
                array(
                    array('profile_id' => $profile_id,
                        'name' => $profile->name,
                        'local' => $profile->local,
                        'user_id' => $profile->user_id,
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp)
                ));

            // redirect
            Session::flash('message', 'Successfully created Profile!');
            return Redirect::to('profile');
        }
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($rec_id)
	{

        //die("hello");
        //$profile = Profile::find($id);
       // die("HELLLOOOO ". $this->cu->id);

        $data = array();
        $user_id = $this->current_user->id;
        //$p = new Profile;
        $profile = $this->profile_obj->get_relations($rec_id);

        /*
        $profile = $p
            ->join('origins', 'profiles.origin_id', '=', 'origins.id')
            ->join('bridges', 'profiles.bridge_id', '=', 'bridges.id')
            ->select('profiles.id', 'profiles.user_id', 'profiles.name', 'profiles.local', 'profiles.status','origins.id as origin_id',
                'origins.number as home_number','bridges.id as bridge_id', 'bridges.number as bridge_number')
            ->where('profiles.id', '=', $rec_id)
            ->first();
        */
        //->where('user_id', '=', $user_id)

        //die("NAME = ".$profile->name);

        $data['profile'] = $profile;
        // $data['countries'] = $countries;

        // $data['boojam'] = 'wee';

        return View::make('profile.show',$data);

        //$data['profile'] = $profile;

        // show the view and pass the nerd to it
        //return View::make('profile.show')
           // ->with('profile', $p);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($rec_id)
	{
        //$profile = Profile::find($id);
        //die("HELLLOOOO ". $rec_id);

        $data = array();
/*
        $origins = Origin::all();
        $bridges = Bridge::all();
        $countries = Country::all();
        $users = User::all();
*/
        //$data['origins_dropdown'] = $this->getOriginDropDown();
        $data['origins'] = $this->origins;
        $data['bridges'] = $this->bridges;
        $data['countries'] = $this->countries;
        $data['users'] = $this->users;
        $data['user_id'] = $this->current_user->id;

        //$data = array();
        $user_id = $this->current_user->id;

        $profile = $this->profile_obj->get_relations($rec_id);

        //$p = new Profile;
        //$profile = $p->relations();
        /*
        $profile = $p
            ->join('origins', 'profiles.origin_id', '=', 'origins.id')
            ->join('bridges', 'profiles.bridge_id', '=', 'bridges.id')
            ->select('profiles.id', 'profiles.user_id', 'profiles.name', 'profiles.local', 'profiles.status','origins.id as origin_id',
                'origins.number as home_number','bridges.id as bridge_id', 'bridges.number as bridge_number')
            ->where('profiles.id', '=', $rec_id)
            ->first();
        */
        //->where('user_id', '=', $user_id)

        //die("NAME = ".$profile->name);

        $data['profile'] = $profile;
        // $data['countries'] = $countries;

        // $data['boojam'] = 'wee';

        if (Auth::user()->hasRole('admin')) {
            return View::make('profile/edit_admin',$data);
        }
        else {
            return View::make('profile/edit_user',$data);
        }

        //return View::make('profile.edit',$data);
	}



	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'user_id'       => 'required',
            'local'       => 'required',
            'bridge_id'       => 'required',
            'origin_id'       => 'required',
        );

        /*
         *  'email'      => 'required|email',
            'nerd_level' => 'required|numeric'
         */

        $validator = Validator::make(Input::all(), $rules);


        // die("Current User = [ ".$user->currentUser()->id. " ]");

        // process the login
        if ($validator->fails()) {
            return Redirect::to('profile/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            //$user = new User;
            $profile = Profile::find($id);
            //$profile = new Profile;
            $profile->name        = Input::get('name');
            $profile->user_id     = Input::get('user_id');
            $profile->local       = Input::get('local');
            $profile->bridge_id      = Input::get('bridge_id');
            $profile->origin_id = Input::get('origin_id');
            // $profile->country_id = Input::get('country_id');


            //$profile->user_id = $this->user->currentUser()->id;
            $profile->save();

            $profile_id = $profile->id;
            // $origin = Country::find($id);
            //$timestamp = new DateTime;
            $timestamp = date('Y-m-d H:i:s');

            DB::table('profile_update_requests')->insert(
                array(
                    array('profile_id' => $profile_id,
                        'name' => $profile->name,
                        'local' => $profile->local,
                        'user_id' => $profile->user_id,
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp)
                ));

            // redirect
            Session::flash('message', 'Successfully edited Profile! Your changes should be active within 1 hour.');
            return Redirect::to('profile');
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $profile = Profile::find($id);
        $profile->delete();
        Session::flash('message', 'Successfully deleted the profile!');
        return Redirect::to('profile');
	}

    public function activate($id='') {
        //die("ID = [$id]");
        $profile = Profile::find($id);
        Session::flash('message', "A request to activate the profile named <strong>$profile->name</strong> has been sent. This profile should be active within 1 hour");
        return $this->index();
    }



}