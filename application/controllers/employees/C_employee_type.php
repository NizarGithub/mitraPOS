<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_employee_type extends MY_Controller {
	private $any_error = array();
	public $tbl 		= 'm_employee_type';
	public $title_page 	= 'Employee Type';
	public $menu_page 	= 'Employees';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){

		$this->check_session();
		$priv = $this->cekUser(18);

		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> $this->title_page,
			'menu_page' 	=> $this->menu_page,
			'priv_add'		=> $priv['privilege_create']
		);

		$this->open_page(1, 'employees/employee_type/V_employee_type', $data, 14);

	}

	public function loadData(){
		$priv = $this->cekUser(18);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'employee_type_nama, employee_type_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select,$this->tbl, NULL);
		$query_filter = $this->mod->select($select, $this->tbl, NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, $this->tbl, NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->employee_type_status_aktif == 'y') {

					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['privilege_update'] == 'y')
					{
						$button = $button.'
							<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->employee_type_id.')" title="Edit">
								<i class="icon-pencil text-center"></i>
							</button>';
					}

					if($priv['privilege_delete'] == 'y')
					{
						$button = $button.'
							<button class="btn red-thunderbird" type="button" onclick="setNonaktif('.$val->employee_type_id.')" title="Non Aktifkan">
								<i class="icon-power text-center"></i>
							</button>';
					}
					
				} else {
					
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['privilege_update'] == 'y')
					{
						$button = $button.'
							<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->employee_type_id.')" title="Edit" disabled>
								<i class="icon-pencil text-center"></i>
							</button>';
					}

					if($priv['privilege_delete'] == 'y')
					{
						$button = $button.'
							<button class="btn green-jungle" type="button" onclick="setAktif('.$val->employee_type_id.')" title="Aktifkan">
								<i class="icon-power text-center"></i>
							</button>';
					}
					
				}

				$response['data'][] = array(
					$no,
					$val->employee_type_nama,
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
			'column' => 'employee_type_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				$response['val'][] = array(
					'kode' 							=> $val->employee_type_id,
					'employee_type_nama' 			=> $val->employee_type_nama,
					'employee_type_keterangan' 		=> $val->employee_type_keterangan,
					'employee_type_status_aktif' 	=> $val->employee_type_status_aktif,
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
				'column' => 'employee_type_status_aktif',
				'param'	 => 'y'
			);
			$where_like['data'][] = array(
				'column' => 'employee_type_nama',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'employee_type_nama',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->employee_type_id,
						'text'	=> $val->employee_type_nama
					);
				}
				$response['status'] = '200';
			}

		} else if ($tipe == 2) {

			$select = '*';
			$where['data'][] = array(
				'column' => 'employee_type_status_aktif',
				'param'	 => 'y'
			);
			$order['data'][] = array(
				'column' => 'employee_type_nama',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->employee_type_id,
						'text'	=> $val->employee_type_nama
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
				'column' => 'employee_type_id',
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
			'column' => 'employee_type_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table($this->tbl, $where, $data, $id);
		if($update->status) {
			$response['status'] = '200';
			$this->nonaktif_atribut($id);
		} else {
			$response['status'] = '204';
		}

		echo json_encode($response);
	}

	public function aktifData(){
		$id = $this->input->post('id');
		$data = $this->general_post_data(4, $id);
		$where['data'][] = array(
			'column' => 'employee_type_id',
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
		$where['data'][] = array(
			'column' => 'employee_type_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('employee_type_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['employee_type_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'employee_type_nama' 			=> $this->input->post('employee_type_nama', TRUE),
				'employee_type_keterangan' 		=> $this->input->post('employee_type_keterangan', TRUE),
				'employee_type_status_aktif' 	=> $this->input->post('employee_type_status_aktif', TRUE),
				'employee_type_created_date' 	=> date('Y-m-d'),
				'employee_type_created_time' 	=> date('H:i:s'),
				'employee_type_created_by'		=> $this->session->userdata('employee_username'),
				'employee_type_updated_by'		=> $this->session->userdata('employee_username'),
				'employee_type_updated_date' 	=> date('Y-m-d'),
				'employee_type_updated_time' 	=> date('H:i:s'),
				'employee_type_revised' 		=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'employee_type_nama' 			=> $this->input->post('employee_type_nama', TRUE),
				'employee_type_keterangan' 		=> $this->input->post('employee_type_keterangan', TRUE),
				'employee_type_status_aktif' 	=> $this->input->post('employee_type_status_aktif', TRUE),
				'employee_type_updated_date' 	=> date('Y-m-d'),
				'employee_type_updated_time' 	=> date('H:i:s'),
				'employee_type_updated_by'		=> $this->session->userdata('employee_username'),
				'employee_type_revised' 		=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'employee_type_status_aktif' 	=> 'n',
				'employee_type_updated_date' 	=> date('Y-m-d'),
				'employee_type_updated_time' 	=> date('H:i:s'),
				'employee_type_updated_by'		=> $this->session->userdata('employee_username'),
				'employee_type_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'employee_type_status_aktif' 	=> 'y',
				'employee_type_updated_date' 	=> date('Y-m-d'),
				'employee_type_updated_time' 	=> date('H:i:s'),
				'employee_type_updated_by'		=> $this->session->userdata('employee_username'),
				'employee_type_revised' 			=> $rev,
			);
		}

		return $data;
	}
	/* end Function */

	function nonaktif_atribut($id){

		// ITEM
		$where_employee['data'][] = array(
			'column' => 'employee_type_id',
			'param'	 => $id,
		);
		$select_employee = $this->mod->select('*', 'm_employee', NULL, $where_employee);
		if ($select_employee) {
			foreach ($select_employee->result() as $row) {
				$data_employee = array(
					'employee_status_aktif' 	=> 'n',
					'employee_updated_date' 	=> date('Y-m-d'),
					'employee_updated_time' 	=> date('H:i:s'),
					'employee_updated_by'		=> $this->session->userdata('employee_username'),
					'employee_revised' 			=> $row->employee_revised + 1,
				);
				if (@$where_employee_id) {
					unset($where_employee_id);
				}
				$where_employee_id['data'][] = array(
					'column' => 'employee_id',
					'param'	 => $row->employee_id,
				);
				$update_employee = $this->mod->update_data_table('m_employee', $where_employee_id, $data_employee);
			}
		}

	}

}
