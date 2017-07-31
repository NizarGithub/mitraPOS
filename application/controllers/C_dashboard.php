<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends MY_Controller {
	private $any_error = array();

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();

		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Dashboard',
		);

		$this->open_page(0, 'dashboard/V_dashboard', $data);
	}

}
