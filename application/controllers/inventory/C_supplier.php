<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_supplier extends MY_Controller {
	private $any_error = array();
	public $tbl 		= 'm_supplier';
	public $title_page 	= 'Supplier';
	public $menu_page 	= 'Inventory';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){

		$this->check_session();
		$priv = $this->cekUser(9);

		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> $this->title_page,
			'menu_page' 	=> $this->menu_page,
			'priv_add'		=> $priv['privilege_create']
		);

		$this->open_page(1, 'inventory/supplier/V_supplier', $data, 8);

	}

	public function loadData(){
		$priv = $this->cekUser(9);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'supplier_nama, supplier_alamat, supplier_telepon, supplier_email, supplier_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select,$this->tbl);
		$query_filter = $this->mod->select($select, $this->tbl, NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, $this->tbl, NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->supplier_status_aktif == 'y') {

					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['privilege_update'] == 'y')
					{
						$button = $button.'
							<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->supplier_id.')" title="Edit">
								<i class="icon-pencil text-center"></i>
							</button>';
					}

					if($priv['privilege_delete'] == 'y')
					{
						$button = $button.'
							<button class="btn red-thunderbird" type="button" onclick="setNonaktif('.$val->supplier_id.')" title="Non Aktifkan">
								<i class="icon-power text-center"></i>
							</button>';
					}
					
				} else {
					
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['privilege_update'] == 'y')
					{
						$button = $button.'
							<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->supplier_id.')" title="Edit" disabled>
								<i class="icon-pencil text-center"></i>
							</button>';
					}

					if($priv['privilege_delete'] == 'y')
					{
						$button = $button.'
							<button class="btn green-jungle" type="button" onclick="setAktif('.$val->supplier_id.')" title="Aktifkan">
								<i class="icon-power text-center"></i>
							</button>';
					}
					
				}

				$response['data'][] = array(
					$no,
					$val->supplier_nama,
					$val->supplier_alamat,
					$val->supplier_telepon,
					$val->supplier_email,
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
			'column' => 'supplier_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				$response['val'][] = array(
					'kode' 					=> $val->supplier_id,
					'supplier_nama' 		=> $val->supplier_nama,
					'supplier_telepon' 		=> $val->supplier_telepon,
					'supplier_email' 		=> $val->supplier_email,
					'supplier_alamat' 		=> $val->supplier_alamat,
					'supplier_kota' 		=> $val->supplier_kota,
					'supplier_provinsi'		=> $val->supplier_provinsi,
					'supplier_kodepos' 		=> $val->supplier_kodepos,
					'supplier_status_aktif' => $val->supplier_status_aktif,
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
				'column' => 'supplier_status_aktif',
				'param'	 => 'y'
			);
			$where_like['data'][] = array(
				'column' => 'supplier_nama',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'supplier_nama',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->supplier_id,
						'text'	=> $val->supplier_nama
					);
				}
				$response['status'] = '200';
			}

		} else if ($tipe == 2) {

			$select = '*';
			$where['data'][] = array(
				'column' => 'supplier_status_aktif',
				'param'	 => 'y'
			);
			$order['data'][] = array(
				'column' => 'supplier_nama',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->supplier_id,
						'text'	=> $val->supplier_nama
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
				'column' => 'supplier_id',
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
			'column' => 'supplier_id',
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
			'column' => 'supplier_id',
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
			'column' => 'supplier_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('supplier_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['supplier_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'supplier_nama' 			=> $this->input->post('supplier_nama', TRUE),
				'supplier_telepon' 			=> $this->input->post('supplier_telepon', TRUE),
				'supplier_email' 			=> $this->input->post('supplier_email', TRUE),
				'supplier_alamat' 			=> $this->input->post('supplier_alamat', TRUE),
				'supplier_kota' 			=> $this->input->post('supplier_kota', TRUE),
				'supplier_provinsi'			=> $this->input->post('supplier_provinsi', TRUE),
				'supplier_kodepos'			=> $this->input->post('supplier_kodepos', TRUE),
				'supplier_status_aktif' 	=> $this->input->post('supplier_status_aktif', TRUE),
				'supplier_created_date' 	=> date('Y-m-d'),
				'supplier_created_time' 	=> date('H:i:s'),
				'supplier_created_by'		=> $this->session->userdata('employee_username'),
				'supplier_updated_by'		=> $this->session->userdata('employee_username'),
				'supplier_updated_date' 	=> date('Y-m-d'),
				'supplier_updated_time' 	=> date('H:i:s'),
				'supplier_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'supplier_nama' 			=> $this->input->post('supplier_nama', TRUE),
				'supplier_telepon' 			=> $this->input->post('supplier_telepon', TRUE),
				'supplier_email' 			=> $this->input->post('supplier_email', TRUE),
				'supplier_alamat' 			=> $this->input->post('supplier_alamat', TRUE),
				'supplier_kota' 			=> $this->input->post('supplier_kota', TRUE),
				'supplier_provinsi'			=> $this->input->post('supplier_provinsi', TRUE),
				'supplier_kodepos'			=> $this->input->post('supplier_kodepos', TRUE),
				'supplier_status_aktif' 	=> $this->input->post('supplier_status_aktif', TRUE),
				'supplier_updated_date' 	=> date('Y-m-d'),
				'supplier_updated_time' 	=> date('H:i:s'),
				'supplier_updated_by'		=> $this->session->userdata('employee_username'),
				'supplier_revised' 			=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'supplier_status_aktif' 	=> 'n',
				'supplier_updated_date' 	=> date('Y-m-d'),
				'supplier_updated_time' 	=> date('H:i:s'),
				'supplier_updated_by'		=> $this->session->userdata('employee_username'),
				'supplier_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'supplier_status_aktif' 	=> 'y',
				'supplier_updated_date' 	=> date('Y-m-d'),
				'supplier_updated_time' 	=> date('H:i:s'),
				'supplier_updated_by'		=> $this->session->userdata('employee_username'),
				'supplier_revised' 			=> $rev,
			);
		}

		return $data;
	}
	/* end Function */

}
