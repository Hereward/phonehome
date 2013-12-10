<?php

class ProfileController extends \BaseController {

    public $cu, $user;

    public function __construct() {
        $this->user = new User;
        $this->cu = $this->user->currentUser();
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
        //$cu = $user->currentUser();
        //$countries = Country::all();
        // $origins = Origin::all();

        //die($origins_dropdown);
        //$origins->toArray();
        //die(var_dump($origins->toArray()));
        $user_id = $this->cu->id;
        $profiles = $p
            ->join('origins', 'profiles.origin_id', '=', 'origins.id')
            ->join('bridges', 'profiles.bridge_id', '=', 'bridges.id')
            ->select('profiles.id', 'profiles.name', 'profiles.local', 'profiles.status','origins.id as origin_id',
                'origins.number as home_number','bridges.id as bridge_id', 'bridges.number as bridge_number');
           // ->where('user_id', $user_id)->get();

        if (Auth::user()->hasRole('admin')) {
            $profiles = $profiles->get();
        } else {
            $profiles = $profiles->where('user_id', $user_id)->get();
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
        $origins = Origin::all();
        $bridges = Bridge::all();
        $countries = Country::all();
        $users = User::all();
        $data = array();
        //$data['origins_dropdown'] = $this->getOriginDropDown();
        $data['origins'] = $origins;
        $data['bridges'] = $bridges;
        $data['countries'] = $countries;
        $data['users'] = $users;
        return View::make('profile/create',$data);
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
           // $profile->country_id = Input::get('country_id');


            //$profile->user_id = $this->user->currentUser()->id;
            $profile->save();

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
        //$profile = Profile::find($id);
       // die("HELLLOOOO ". $this->cu->id);

        $data = array();
        $user_id = $this->cu->id;
        $p = new Profile;
        $profile = $p
            ->join('origins', 'profiles.origin_id', '=', 'origins.id')
            ->join('bridges', 'profiles.bridge_id', '=', 'bridges.id')
            ->select('profiles.id', 'profiles.name', 'profiles.local', 'profiles.status','origins.id as origin_id',
                'origins.number as home_number','bridges.id as bridge_id', 'bridges.number as bridge_number')
            ->where('profiles.id', '=', $rec_id)
            ->first();

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
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}