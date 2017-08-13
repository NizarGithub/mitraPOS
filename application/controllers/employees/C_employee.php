<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_employee extends MY_Controller {
	private $any_error = array();
	public $tbl 		= 'm_employee';
	public $title_page 	= 'Employees';
	public $menu_page 	= 'Employees';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){

		$this->check_session();
		$priv = $this->cekUser(15);

		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> $this->title_page,
			'menu_page' 	=> $this->menu_page,
			'priv_add'		=> $priv['privilege_create']
		);

		$this->open_page(1, 'employees/employee/V_employee', $data, 14);

	}

	public function loadData(){
		$priv = $this->cekUser(15);
		$select = 'a.*, b.*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		// JOIN
		$join['data'][] = array(
			'table' => 'm_employee_type b',
			'join'	=> 'b.employee_type_id = a.employee_type_id',
			'type'	=> 'left'
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'a.employee_nama, b.employee_type_nama, a.employee_email, a.employee_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'm_employee a', $join, NULL, NULL, NULL, NULL, NULL);
		$query_filter = $this->mod->select($select, 'm_employee a', $join, NULL, NULL, $where_like, $order, NULL);
		$query = $this->mod->select($select, 'm_employee a', $join, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->employee_status_aktif == 'y') {

					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['privilege_update'] == 'y')
					{
						$button = $button.'
							<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->employee_id.')" title="Edit">
								<i class="icon-pencil text-center"></i>
							</button>';
					}

					if($priv['privilege_delete'] == 'y')
					{
						$button = $button.'
							<button class="btn red-thunderbird" type="button" onclick="setNonaktif('.$val->employee_id.')" title="Non Aktifkan">
								<i class="icon-power text-center"></i>
							</button>';
					}
					
				} else {
					
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['privilege_update'] == 'y')
					{
						$button = $button.'
							<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->employee_id.')" title="Edit" disabled>
								<i class="icon-pencil text-center"></i>
							</button>';
					}

					if($priv['privilege_delete'] == 'y')
					{
						$button = $button.'
							<button class="btn green-jungle" type="button" onclick="setAktif('.$val->employee_id.')" title="Aktifkan">
								<i class="icon-power text-center"></i>
							</button>';
					}
					
				}

				$response['data'][] = array(
					$no,
					$val->employee_nama,
					$val->employee_type_nama,
					$val->employee_email,
					$status,
					$button
				);
				$no++;
			}
		}

		$response['recordsTotal'] = 0;
		if ($query_total<>false) {
			$response['recordsTotal'] = $query_total->num_rows();
		}
		$response['recordsFiltered'] = 0;
		if ($query_filter<>false) {
			$response['recordsFiltered'] = $query_filter->num_rows();
		}

		echo json_encode($response);
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'employee_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				$response['val'][] = array(
					'kode' 					=> $val->employee_id,
					'employee_type_id'		=> $val->employee_type_id,
					'employee_nama' 		=> $val->employee_nama,
					'employee_telepon' 		=> $val->employee_telepon,
					'employee_email' 		=> $val->employee_email,
					'employee_birthday' 	=> $this->generateFormatDate($val->employee_birthday),
					'employee_alamat' 		=> $val->employee_alamat,
					'employee_kota' 		=> $val->employee_kota,
					'employee_provinsi'		=> $val->employee_provinsi,
					'employee_kodepos' 		=> $val->employee_kodepos,
					'employee_username'		=> $val->employee_username,
					'employee_status_aktif' => $val->employee_status_aktif,
				);
			}

			echo json_encode($response);
		}
	}

	public function loadDataSelect($tipe){
		if ($tipe == 1) {

			$param = $this->input->get('q');
			if ($param!=NULL) {
				$param = $this->input->get('q');
			} else {
				$param = "";
			}
			$select = '*';
			$where['data'][] = array(
				'column' => 'employee_status_aktif',
				'param'	 => 'y'
			);
			$where_like['data'][] = array(
				'column' => 'employee_nama',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'employee_nama',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->employee_id,
						'text'	=> $val->employee_nama
					);
				}
				$response['status'] = '200';
			}

		} else if ($tipe == 2) {

			$select = '*';
			$where['data'][] = array(
				'column' => 'employee_status_aktif',
				'param'	 => 'y'
			);
			$order['data'][] = array(
				'column' => 'employee_nama',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->employee_id,
						'text'	=> $val->employee_nama
					);
				}
				$response['status'] = '200';
			}
			
		}

		echo json_encode($response);
	}

	// Function Insert & Update
	public function postData(){
		$id = $this->input->post('kode');
		if (strlen($id)>0) {
			//UPDATE
			$data = $this->general_post_data(2, $id);
			$where['data'][] = array(
				'column' => 'employee_id',
				'param'	 => $id
			);
			$update = $this->mod->update_data_table($this->tbl, $where, $data, $id);
			if($update->status) {
				$response['status'] = '200';
			} else {
				$response['status'] = '204';
			}
		} else {
			//INSERT
			$data = $this->general_post_data(1);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$response['status'] = '200';
			} else {
				$response['status'] = '204';
			}
		}
		
		echo json_encode($response);
	}

	public function nonaktifData(){
		$id = $this->input->post('id');
		$data = $this->general_post_data(3, $id);
		$where['data'][] = array(
			'column' => 'employee_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table($this->tbl, $where, $data, $id);
		if($update->status) {
			$response['status'] = '200';
		} else {
			$response['status'] = '204';
		}
		
		echo json_encode($response);
	}

	public function aktifData(){
		$id = $this->input->post('id');
		$data = $this->general_post_data(4, $id);
		$where['data'][] = array(
			'column' => 'employee_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table($this->tbl, $where, $data, $id);
		if($update->status) {
			$response['status'] = '200';
		} else {
			$response['status'] = '204';
		}

		echo json_encode($response);
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif, 4 Aktif
		$arrDate = explode('/', $this->input->post('employee_birthday', TRUE));
		$where['data'][] = array(
			'column' => 'employee_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('employee_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['employee_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'employee_nama' 			=> $this->input->post('employee_nama', TRUE),
				'employee_telepon' 			=> $this->input->post('employee_telepon', TRUE),
				'employee_email' 			=> $this->input->post('employee_email', TRUE),
				'employee_birthday'			=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'employee_alamat' 			=> $this->input->post('employee_alamat', TRUE),
				'employee_kota' 			=> $this->input->post('employee_kota', TRUE),
				'employee_provinsi'			=> $this->input->post('employee_provinsi', TRUE),
				'employee_kodepos'			=> $this->input->post('employee_kodepos', TRUE),
				'employee_username'			=> $this->input->post('employee_username', TRUE),
				'employee_password'			=> md5(base64_decode($this->input->post('employee_password', TRUE))),
				'employee_status_aktif' 	=> $this->input->post('employee_status_aktif', TRUE),
				'employee_created_date' 	=> date('Y-m-d'),
				'employee_created_time' 	=> date('H:i:s'),
				'employee_created_by'		=> $this->session->userdata('employee_username'),
				'employee_updated_by'		=> $this->session->userdata('employee_username'),
				'employee_updated_date' 	=> date('Y-m-d'),
				'employee_updated_time' 	=> date('H:i:s'),
				'employee_revised' 			=> 0,
			);
		} else if ($type == 2) {
			if (strlen($this->input->post('employee_password', TRUE)) > 0) {
				$data = array(
					'employee_nama' 			=> $this->input->post('employee_nama', TRUE),
					'employee_telepon' 			=> $this->input->post('employee_telepon', TRUE),
					'employee_email' 			=> $this->input->post('employee_email', TRUE),
					'employee_birthday'			=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
					'employee_alamat' 			=> $this->input->post('employee_alamat', TRUE),
					'employee_kota' 			=> $this->input->post('employee_kota', TRUE),
					'employee_provinsi'			=> $this->input->post('employee_provinsi', TRUE),
					'employee_kodepos'			=> $this->input->post('employee_kodepos', TRUE),
					'employee_username'			=> $this->input->post('employee_username', TRUE),
					'employee_password'			=> md5(base64_decode($this->input->post('employee_password', TRUE))),
					'employee_status_aktif' 	=> $this->input->post('employee_status_aktif', TRUE),
					'employee_updated_date' 	=> date('Y-m-d'),
					'employee_updated_time' 	=> date('H:i:s'),
					'employee_updated_by'		=> $this->session->userdata('employee_username'),
					'employee_revised' 			=> $rev,
				);
			} else {
				$data = array(
					'employee_nama' 			=> $this->input->post('employee_nama', TRUE),
					'employee_telepon' 			=> $this->input->post('employee_telepon', TRUE),
					'employee_email' 			=> $this->input->post('employee_email', TRUE),
					'employee_birthday'			=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
					'employee_alamat' 			=> $this->input->post('employee_alamat', TRUE),
					'employee_kota' 			=> $this->input->post('employee_kota', TRUE),
					'employee_provinsi'			=> $this->input->post('employee_provinsi', TRUE),
					'employee_kodepos'			=> $this->input->post('employee_kodepos', TRUE),
					'employee_username'			=> $this->input->post('employee_username', TRUE),
					'employee_status_aktif' 	=> $this->input->post('employee_status_aktif', TRUE),
					'employee_updated_date' 	=> date('Y-m-d'),
					'employee_updated_time' 	=> date('H:i:s'),
					'employee_updated_by'		=> $this->session->userdata('employee_username'),
					'employee_revised' 			=> $rev,
				);
			}
		} else if ($type == 3) {
			$data = array(
				'employee_status_aktif' 	=> 'n',
				'employee_updated_date' 	=> date('Y-m-d'),
				'employee_updated_time' 	=> date('H:i:s'),
				'employee_updated_by'		=> $this->session->userdata('employee_username'),
				'employee_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'employee_status_aktif' 	=> 'y',
				'employee_updated_date' 	=> date('Y-m-d'),
				'employee_updated_time' 	=> date('H:i:s'),
				'employee_updated_by'		=> $this->session->userdata('employee_username'),
				'employee_revised' 			=> $rev,
			);
		}

		return $data;
	}
	/* end Function */

}
