<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_customer extends MY_Controller {
	private $any_error = array();
	public $tbl 		= 'm_customer';
	public $title_page 	= 'Customers';
	public $menu_page 	= 'Customers';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){

		$this->check_session();
		$priv = $this->cekUser(13);

		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> $this->title_page,
			'menu_page' 	=> $this->menu_page,
			'priv_add'		=> $priv['privilege_create']
		);

		$this->open_page(1, 'customers/customer/V_customer', $data, 12);

	}

	public function loadData(){
		$priv = $this->cekUser(13);
		$select = 'a.*, SUM(b.penjualan_total) AS total1, SUM(c.penjualan_total) AS total2, SUM(d.penjualan_total) AS total3';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		// JOIN
		$join['data'][] = array(
			'table' => 't_penjualan b',
			'join'	=> 'b.customer_id = a.customer_id AND EXTRACT(DAY FROM b.penjualan_tanggal) = '.date('d'),
			'type'	=> 'left'
		);
		// JOIN
		$join['data'][] = array(
			'table' => 't_penjualan c',
			'join'	=> 'c.customer_id = a.customer_id AND EXTRACT(YEAR FROM c.penjualan_tanggal) = '.date('Y'),
			'type'	=> 'left'
		);
		// JOIN
		$join['data'][] = array(
			'table' => 't_penjualan d',
			'join'	=> 'd.customer_id = a.customer_id',
			'type'	=> 'left'
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'a.customer_nama, a.customer_created_date, SUM(b.penjualan_total), SUM(c.penjualan_total), SUM(d.penjualan_total), a.customer_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);
		$group_by = 'a.customer_id';

		$query_total = $this->mod->select($select, 'm_customer a', $join, NULL, NULL, NULL, NULL, NULL, $group_by);
		$query_filter = $this->mod->select($select, 'm_customer a', $join, NULL, NULL, $where_like, $order, NULL, $group_by);
		$query = $this->mod->select($select, 'm_customer a', $join, NULL, NULL, $where_like, $order, $limit, $group_by);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->customer_status_aktif == 'y') {

					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['privilege_update'] == 'y')
					{
						$button = $button.'
							<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->customer_id.')" title="Edit">
								<i class="icon-pencil text-center"></i>
							</button>';
					}

					if($priv['privilege_delete'] == 'y')
					{
						$button = $button.'
							<button class="btn red-thunderbird" type="button" onclick="setNonaktif('.$val->customer_id.')" title="Non Aktifkan">
								<i class="icon-power text-center"></i>
							</button>';
					}
					
				} else {
					
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['privilege_update'] == 'y')
					{
						$button = $button.'
							<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->customer_id.')" title="Edit" disabled>
								<i class="icon-pencil text-center"></i>
							</button>';
					}

					if($priv['privilege_delete'] == 'y')
					{
						$button = $button.'
							<button class="btn green-jungle" type="button" onclick="setAktif('.$val->customer_id.')" title="Aktifkan">
								<i class="icon-power text-center"></i>
							</button>';
					}
					
				}

				$response['data'][] = array(
					$no,
					$val->customer_nama,
					$this->generateFormatDate($val->customer_created_date),
					"Rp ".$this->generateFormatNumber($val->total1),
					"Rp ".$this->generateFormatNumber($val->total2),
					"Rp ".$this->generateFormatNumber($val->total3),
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
			'column' => 'customer_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				$response['val'][] = array(
					'kode' 					=> $val->customer_id,
					'customer_nama' 		=> $val->customer_nama,
					'customer_telepon' 		=> $val->customer_telepon,
					'customer_email' 		=> $val->customer_email,
					'customer_birthday' 	=> $this->generateFormatDate($val->customer_birthday),
					'customer_alamat' 		=> $val->customer_alamat,
					'customer_kota' 		=> $val->customer_kota,
					'customer_provinsi'		=> $val->customer_provinsi,
					'customer_kodepos' 		=> $val->customer_kodepos,
					'customer_status_aktif' => $val->customer_status_aktif,
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
				'column' => 'customer_status_aktif',
				'param'	 => 'y'
			);
			$where_like['data'][] = array(
				'column' => 'customer_nama',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'customer_nama',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->customer_id,
						'text'	=> $val->customer_nama
					);
				}
				$response['status'] = '200';
			}

		} else if ($tipe == 2) {

			$select = '*';
			$where['data'][] = array(
				'column' => 'customer_status_aktif',
				'param'	 => 'y'
			);
			$order['data'][] = array(
				'column' => 'customer_nama',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->customer_id,
						'text'	=> $val->customer_nama
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
				'column' => 'customer_id',
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
			'column' => 'customer_id',
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
			'column' => 'customer_id',
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
		$arrDate = explode('/', $this->input->post('customer_birthday', TRUE));
		$where['data'][] = array(
			'column' => 'customer_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('customer_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['customer_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'customer_nama' 			=> $this->input->post('customer_nama', TRUE),
				'customer_telepon' 			=> $this->input->post('customer_telepon', TRUE),
				'customer_email' 			=> $this->input->post('customer_email', TRUE),
				'customer_birthday'			=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'customer_alamat' 			=> $this->input->post('customer_alamat', TRUE),
				'customer_kota' 			=> $this->input->post('customer_kota', TRUE),
				'customer_provinsi'			=> $this->input->post('customer_provinsi', TRUE),
				'customer_kodepos'			=> $this->input->post('customer_kodepos', TRUE),
				'customer_status_aktif' 	=> $this->input->post('customer_status_aktif', TRUE),
				'customer_created_date' 	=> date('Y-m-d'),
				'customer_created_time' 	=> date('H:i:s'),
				'customer_created_by'		=> $this->session->userdata('employee_username'),
				'customer_updated_by'		=> $this->session->userdata('employee_username'),
				'customer_updated_date' 	=> date('Y-m-d'),
				'customer_updated_time' 	=> date('H:i:s'),
				'customer_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'customer_nama' 			=> $this->input->post('customer_nama', TRUE),
				'customer_telepon' 			=> $this->input->post('customer_telepon', TRUE),
				'customer_email' 			=> $this->input->post('customer_email', TRUE),
				'customer_birthday'			=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'customer_alamat' 			=> $this->input->post('customer_alamat', TRUE),
				'customer_kota' 			=> $this->input->post('customer_kota', TRUE),
				'customer_provinsi'			=> $this->input->post('customer_provinsi', TRUE),
				'customer_kodepos'			=> $this->input->post('customer_kodepos', TRUE),
				'customer_status_aktif' 	=> $this->input->post('customer_status_aktif', TRUE),
				'customer_updated_date' 	=> date('Y-m-d'),
				'customer_updated_time' 	=> date('H:i:s'),
				'customer_updated_by'		=> $this->session->userdata('employee_username'),
				'customer_revised' 			=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'customer_status_aktif' 	=> 'n',
				'customer_updated_date' 	=> date('Y-m-d'),
				'customer_updated_time' 	=> date('H:i:s'),
				'customer_updated_by'		=> $this->session->userdata('employee_username'),
				'customer_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'customer_status_aktif' 	=> 'y',
				'customer_updated_date' 	=> date('Y-m-d'),
				'customer_updated_time' 	=> date('H:i:s'),
				'customer_updated_by'		=> $this->session->userdata('employee_username'),
				'customer_revised' 			=> $rev,
			);
		}

		return $data;
	}
	/* end Function */

}
