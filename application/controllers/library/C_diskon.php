<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_diskon extends MY_Controller {
	private $any_error = array();
	public $tbl 		= 'm_diskon';
	public $title_page 	= 'Diskon';
	public $menu_page 	= 'Library';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){

		$this->check_session();
		$priv = $this->cekUser(4);

		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> $this->title_page,
			'menu_page' 	=> $this->menu_page,
			'priv_add'		=> $priv['privilege_create']
		);

		$this->open_page(1, 'library/diskon/V_diskon', $data, 1);

	}

	public function loadData(){
		$priv = $this->cekUser(4);
		$select = 'a.*, b.*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		// JOIN
		$join['data'][] = array(
			'table' => 'm_outlet b',
			'join'	=> 'b.outlet_id = a.diskon_outlet',
			'type'	=> 'left'
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'a.diskon_nama, b.outlet_nama, a.diskon_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select,'m_diskon a', $join);
		$query_filter = $this->mod->select($select, 'm_diskon a', $join, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'm_diskon a', $join, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->diskon_status_aktif == 'y') {

					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['privilege_update'] == 'y')
					{
						$button = $button.'
							<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->diskon_id.')" title="Edit">
								<i class="icon-pencil text-center"></i>
							</button>';
					}

					if($priv['privilege_delete'] == 'y')
					{
						$button = $button.'
							<button class="btn red-thunderbird" type="button" onclick="setNonaktif('.$val->diskon_id.')" title="Non Aktifkan">
								<i class="icon-power text-center"></i>
							</button>';
					}
					
				} else {
					
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['privilege_update'] == 'y')
					{
						$button = $button.'
							<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->diskon_id.')" title="Edit" disabled>
								<i class="icon-pencil text-center"></i>
							</button>';
					}

					if($priv['privilege_delete'] == 'y')
					{
						$button = $button.'
							<button class="btn green-jungle" type="button" onclick="setAktif('.$val->diskon_id.')" title="Aktifkan">
								<i class="icon-power text-center"></i>
							</button>';
					}
					
				}

				if ($val->diskon_outlet <> 0) {
					$outlet_nama = $val->outlet_nama;
				} else {
					$outlet_nama = 'Semua Outlet';
				}

				$response['data'][] = array(
					$no,
					$val->diskon_nama,
					$outlet_nama,
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
			'column' => 'diskon_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				$response['val'][] = array(
					'kode' 					=> $val->diskon_id,
					'diskon_nama' 			=> $val->diskon_nama,
					'diskon_type' 			=> $val->diskon_type,
					'diskon_target'			=> $val->diskon_target,
					'diskon_satuan'			=> $val->diskon_satuan,
					'diskon_value' 			=> $val->diskon_value,
					'diskon_outlet' 		=> $val->diskon_outlet,
					'diskon_keterangan' 	=> $val->diskon_keterangan,
					'diskon_status_aktif'	=> $val->diskon_status_aktif,
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
				'column' => 'diskon_status_aktif',
				'param'	 => 'y'
			);
			$where_like['data'][] = array(
				'column' => 'diskon_nama',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'diskon_nama',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->diskon_id,
						'text'	=> $val->diskon_nama
					);
				}
				$response['status'] = '200';
			}

		} else if ($tipe == 2) {

			$select = '*';
			$where['data'][] = array(
				'column' => 'diskon_status_aktif',
				'param'	 => 'y'
			);
			$order['data'][] = array(
				'column' => 'diskon_nama',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->diskon_id,
						'text'	=> $val->diskon_nama
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
				'column' => 'diskon_id',
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
			'column' => 'diskon_id',
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
			'column' => 'diskon_id',
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
			'column' => 'diskon_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('diskon_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['diskon_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'diskon_nama' 			=> $this->input->post('diskon_nama', TRUE),
				'diskon_type' 			=> $this->input->post('diskon_type', TRUE),
				'diskon_target'			=> $this->input->post('diskon_target', TRUE),
				'diskon_satuan'			=> $this->input->post('diskon_satuan', TRUE),
				'diskon_value' 			=> $this->input->post('diskon_value', TRUE),
				'diskon_outlet' 		=> $this->input->post('diskon_outlet', TRUE),
				'diskon_keterangan' 	=> $this->input->post('diskon_keterangan', TRUE),
				'diskon_status_aktif' 	=> $this->input->post('diskon_status_aktif', TRUE),
				'diskon_created_date' 	=> date('Y-m-d'),
				'diskon_created_time' 	=> date('H:i:s'),
				'diskon_created_by'		=> $this->session->userdata('employee_username'),
				'diskon_updated_by'		=> $this->session->userdata('employee_username'),
				'diskon_updated_date' 	=> date('Y-m-d'),
				'diskon_updated_time' 	=> date('H:i:s'),
				'diskon_revised' 		=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'diskon_nama' 			=> $this->input->post('diskon_nama', TRUE),
				'diskon_type' 			=> $this->input->post('diskon_type', TRUE),
				'diskon_target'			=> $this->input->post('diskon_target', TRUE),
				'diskon_satuan'			=> $this->input->post('diskon_satuan', TRUE),
				'diskon_value' 			=> $this->input->post('diskon_value', TRUE),
				'diskon_outlet' 		=> $this->input->post('diskon_outlet', TRUE),
				'diskon_keterangan' 	=> $this->input->post('diskon_keterangan', TRUE),
				'diskon_status_aktif' 	=> $this->input->post('diskon_status_aktif', TRUE),
				'diskon_updated_date' 	=> date('Y-m-d'),
				'diskon_updated_time' 	=> date('H:i:s'),
				'diskon_updated_by'		=> $this->session->userdata('employee_username'),
				'diskon_revised' 			=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'diskon_status_aktif' 	=> 'n',
				'diskon_updated_date' 	=> date('Y-m-d'),
				'diskon_updated_time' 	=> date('H:i:s'),
				'diskon_updated_by'		=> $this->session->userdata('employee_username'),
				'diskon_revised' 		=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'diskon_status_aktif' 	=> 'y',
				'diskon_updated_date' 	=> date('Y-m-d'),
				'diskon_updated_time' 	=> date('H:i:s'),
				'diskon_updated_by'		=> $this->session->userdata('employee_username'),
				'diskon_revised' 		=> $rev,
			);
		}

		return $data;
	}
	/* end Function */

}
