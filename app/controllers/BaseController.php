<?php

class BaseController extends Controller {

    //public $cu, $xuser, $user_id;

    /**
     * Initializer.
     *
     * @access   public
     * @return \BaseController
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->user = new User;
        $this->current_user = $this->user->currentUser();

       // $this->user_id = $this->cu->id;


    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}