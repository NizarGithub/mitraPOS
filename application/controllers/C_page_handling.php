<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_page_handling extends MY_Controller {
	private $any_error = array();

	public function __construct() {
        parent::__construct();
	}

	/*
		PAGE LOGIN FUNCTION
	*/

	// Page Login
	public function PageLogin(){

	   	if($this->logged_in)
			redirect('Dashboard');
		
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Page Login',
		);
		$this->load->view('gate/V_login', $data);

	}

	public function doLogin(){

		$user = $this->input->post('username', TRUE);
		$pass = md5(base64_decode($this->input->post('password', TRUE)));

		$user_data = $this->mod->check_exist_user($user, $pass);

		if(!$user_data){
			
			$response['status'] = '204'; 

		} else {		

			$this->session->set_userdata('logged', 'in');
			$this->session->set_userdata('employee_tipe', $user_data->employee_type_id);
			$this->session->set_userdata('employee_id', $user_data->employee_id);
			$this->session->set_userdata('employee_nama', $user_data->employee_nama);
			$this->session->set_userdata('employee_username', $user_data->employee_username);
			$this->session->set_userdata('employee_image', 'default.jpg');

			// // INSERT LOG USER
			// $data_log = array(
			// 	'user_log_aktivitas' => 'Login',
			// );
			// $this->insertUserLog($data_log);
			// // END INSERT LOG USER

			$response['status'] = '200';

		}
			
		echo json_encode($response);

	}

	public function doLogout(){
		
		// // INSERT LOG USER
		// $data_log = array(
		// 	'user_log_aktivitas' => 'Logout',
		// );
		// $this->insertUserLog($data_log);
		// // END INSERT 

		$this->session->sess_destroy();
		$response['status'] = '200';
		echo json_encode($response);

	}

	/*
		END PAGE LOGIN FUNCTION
	*/

	// Page 404
	public function Page404(){

		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Page 404',
			'title' 		=> '',
		);
		$this->load->view('gate/V_404', $data);

	}

}
