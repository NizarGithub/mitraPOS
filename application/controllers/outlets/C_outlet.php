<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_outlet extends MY_Controller {
	private $any_error = array();
	public $tbl 		= 'm_outlet';
	public $title_page 	= 'Outlets';
	public $menu_page 	= 'Outlets';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){

		$this->check_session();
		$priv = $this->cekUser(17);

		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> $this->title_page,
			'menu_page' 	=> $this->menu_page,
			'priv_add'		=> $priv['privilege_create']
		);

		$this->open_page(1, 'outlets/outlet/V_outlet', $data, 16);

	}

	public function loadData(){
		$priv = $this->cekUser(17);
		$select = 'a.*, SUM(b.penjualan_total) AS total1, SUM(c.penjualan_total) AS total2, SUM(d.penjualan_total) AS total3';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		// JOIN
		$join['data'][] = array(
			'table' => 't_penjualan b',
			'join'	=> 'b.outlet_id = a.outlet_id AND EXTRACT(DAY FROM b.penjualan_tanggal) = '.date('d'),
			'type'	=> 'left'
		);
		// JOIN
		$join['data'][] = array(
			'table' => 't_penjualan c',
			'join'	=> 'c.outlet_id = a.outlet_id AND EXTRACT(YEAR FROM c.penjualan_tanggal) = '.date('Y'),
			'type'	=> 'left'
		);
		// JOIN
		$join['data'][] = array(
			'table' => 't_penjualan d',
			'join'	=> 'd.outlet_id = a.outlet_id',
			'type'	=> 'left'
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'outlet_nama, outlet_alamat, SUM(b.penjualan_total), SUM(c.penjualan_total), SUM(d.penjualan_total), outlet_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);
		$group_by = 'a.outlet_id';

		$query_total = $this->mod->select($select, 'm_outlet a', $join, NULL, NULL, NULL, NULL, NULL, $group_by);
		$query_filter = $this->mod->select($select, 'm_outlet a', $join, NULL, NULL, $where_like, $order, NULL, $group_by);
		$query = $this->mod->select($select, 'm_outlet a', $join, NULL, NULL, $where_like, $order, $limit, $group_by);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->outlet_status_aktif == 'y') {

					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['privilege_update'] == 'y')
					{
						$button = $button.'
							<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->outlet_id.')" title="Edit">
								<i class="icon-pencil text-center"></i>
							</button>';
					}

					if($priv['privilege_delete'] == 'y')
					{
						$button = $button.'
							<button class="btn red-thunderbird" type="button" onclick="setNonaktif('.$val->outlet_id.')" title="Non Aktifkan">
								<i class="icon-power text-center"></i>
							</button>';
					}
					
				} else {
					
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['privilege_update'] == 'y')
					{
						$button = $button.'
							<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->outlet_id.')" title="Edit" disabled>
								<i class="icon-pencil text-center"></i>
							</button>';
					}

					if($priv['privilege_delete'] == 'y')
					{
						$button = $button.'
							<button class="btn green-jungle" type="button" onclick="setAktif('.$val->outlet_id.')" title="Aktifkan">
								<i class="icon-power text-center"></i>
							</button>';
					}
					
				}

				$response['data'][] = array(
					$no,
					$val->outlet_nama,
					$val->outlet_alamat,
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
			'column' => 'outlet_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				$response['val'][] = array(
					'kode' 					=> $val->outlet_id,
					'outlet_nama' 			=> $val->outlet_nama,
					'outlet_alamat' 		=> $val->outlet_alamat,
					'outlet_telepon' 		=> $val->outlet_telepon,
					'outlet_kota' 			=> $val->outlet_kota,
					'outlet_keterangan' 	=> $val->outlet_keterangan,
					'outlet_status_aktif' 	=> $val->outlet_status_aktif,
				);
			}

			echo json_encode($response);
		}
	}

	public function loadDataSelect($tipe){
		$outletId_param = @$this->input->get('outletId');

		if ($tipe == 1) {

			$param = $this->input->get('q');
			if ($param!=NULL) {
				$param = $this->input->get('q');
			} else {
				$param = "";
			}
			$select = '*';
			$where['data'][] = array(
				'column' => 'outlet_status_aktif',
				'param'	 => 'y'
			);
			$where_like['data'][] = array(
				'column' => 'outlet_nama',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'outlet_nama',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					if (strlen($outletId_param) > 0) {
						if ($val->outlet_id != $outletId_param) {
							$response['items'][] = array(
								'id'	=> $val->outlet_id,
								'text'	=> $val->outlet_nama
							);
						}
					} else {
						$response['items'][] = array(
							'id'	=> $val->outlet_id,
							'text'	=> $val->outlet_nama
						);
					}
				}
				$response['status'] = '200';
			}

		} else if ($tipe == 2) {

			$select = '*';
			$where['data'][] = array(
				'column' => 'outlet_status_aktif',
				'param'	 => 'y'
			);
			$order['data'][] = array(
				'column' => 'outlet_nama',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					if (strlen($outletId_param) > 0) {
						if ($val->outlet_id != $outletId_param) {
							$response['items'][] = array(
								'id'	=> $val->outlet_id,
								'text'	=> $val->outlet_nama
							);
						}
					} else {
						$response['items'][] = array(
							'id'	=> $val->outlet_id,
							'text'	=> $val->outlet_nama
						);
					}
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
				'column' => 'outlet_id',
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
			'column' => 'outlet_id',
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
			'column' => 'outlet_id',
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
			'column' => 'outlet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('outlet_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['outlet_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'outlet_nama' 				=> $this->input->post('outlet_nama', TRUE),
				'outlet_alamat' 			=> $this->input->post('outlet_alamat', TRUE),
				'outlet_telepon' 			=> $this->input->post('outlet_telepon', TRUE),
				'outlet_kota' 				=> $this->input->post('outlet_kota', TRUE),
				'outlet_keterangan' 		=> $this->input->post('outlet_keterangan', TRUE),
				'outlet_status_aktif' 		=> $this->input->post('outlet_status_aktif', TRUE),
				'outlet_created_date' 		=> date('Y-m-d'),
				'outlet_created_time' 		=> date('H:i:s'),
				'outlet_created_by'			=> $this->session->userdata('employee_username'),
				'outlet_updated_by'			=> $this->session->userdata('employee_username'),
				'outlet_updated_date' 		=> date('Y-m-d'),
				'outlet_updated_time' 		=> date('H:i:s'),
				'outlet_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'outlet_nama' 				=> $this->input->post('outlet_nama', TRUE),
				'outlet_alamat' 			=> $this->input->post('outlet_alamat', TRUE),
				'outlet_telepon' 			=> $this->input->post('outlet_telepon', TRUE),
				'outlet_kota' 				=> $this->input->post('outlet_kota', TRUE),
				'outlet_keterangan' 		=> $this->input->post('outlet_keterangan', TRUE),
				'outlet_status_aktif' 		=> $this->input->post('outlet_status_aktif', TRUE),
				'outlet_updated_date' 		=> date('Y-m-d'),
				'outlet_updated_time' 		=> date('H:i:s'),
				'outlet_updated_by'			=> $this->session->userdata('employee_username'),
				'outlet_revised' 			=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'outlet_status_aktif' 		=> 'n',
				'outlet_updated_date' 		=> date('Y-m-d'),
				'outlet_updated_time' 		=> date('H:i:s'),
				'outlet_updated_by'			=> $this->session->userdata('employee_username'),
				'outlet_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'outlet_status_aktif' 		=> 'y',
				'outlet_updated_date' 		=> date('Y-m-d'),
				'outlet_updated_time' 		=> date('H:i:s'),
				'outlet_updated_by'			=> $this->session->userdata('employee_username'),
				'outlet_revised' 			=> $rev,
			);
		}

		return $data;
	}
	/* end Function */

	function nonaktif_atribut($id){

		// KATEGORI
		$where_kategori['data'][] = array(
			'column' => 'kategori_outlet',
			'param'	 => $id,
		);
		$select_kategori = $this->mod->select('*', 'm_kategori', NULL, $where_kategori);
		if ($select_kategori) {
			foreach ($select_kategori->result() as $row) {
				$data_kategori = array(
					'kategori_status_aktif' 	=> 'n',
					'kategori_updated_date' 	=> date('Y-m-d'),
					'kategori_updated_time' 	=> date('H:i:s'),
					'kategori_updated_by'		=> $this->session->userdata('employee_username'),
					'kategori_revised' 			=> $row->kategori_revised + 1,
				);
				if (@$where_kategori_id) {
					unset($where_kategori_id);
				}
				$where_kategori_id['data'][] = array(
					'column' => 'kategori_id',
					'param'	 => $id,
				);
				$update_kategori = $this->mod->update_data_table('m_kategori', $where_kategori_id, $data_kategori);

				// DISKON KATEGORI
				if (@$where_diskon_kategori) {
					unset($where_diskon_kategori);
				}
				$where_diskon_kategori['data'][] = array(
					'column' => 'diskon_type',
					'param'	 => '2',
				);
				$where_diskon_kategori['data'][] = array(
					'column' => 'diskon_target',
					'param'	 => $row->kategori_id,
				);
				$select_diskon_kategori = $this->mod->select('*', 'm_diskon', NULL, $where_diskon_kategori);
				if ($select_diskon_kategori) {
					foreach ($select_diskon_kategori->result() as $row2) {
						$data_kategori_diskon = array(
							'diskon_status_aktif' 	=> 'n',
							'diskon_updated_date' 	=> date('Y-m-d'),
							'diskon_updated_time' 	=> date('H:i:s'),
							'diskon_updated_by'		=> $this->session->userdata('employee_username'),
							'diskon_revised' 		=> $row2->diskon_revised + 1,
						);
						if (@$where_diskon_kategori_id) {
							unset($where_diskon_kategori_id);
						}
						$where_diskon_kategori_id['data'][] = array(
							'column' => 'diskon_id',
							'param'	 => $row2->diskon_id,
						);
						$update_diskon_kategori = $this->mod->update_data_table('m_diskon', $where_diskon_kategori_id, $data_diskon_kategori);
					}
				}

				// ITEM KATEGORI
				if (@$where_item_kategori) {
					unset($where_item_kategori);
				}
				$where_item_kategori['data'][] = array(
					'column' => 'kategori_id',
					'param'	 => $row->kategori_id,
				);
				$select_item_kategori = $this->mod->select('*', 'm_item', NULL, $where_item_kategori);
				if ($select_item_kategori) {
					foreach ($select_item_kategori->result() as $row2) {
						$data_kategori_item = array(
							'item_status_aktif' 	=> 'n',
							'item_updated_date' 	=> date('Y-m-d'),
							'item_updated_time' 	=> date('H:i:s'),
							'item_updated_by'		=> $this->session->userdata('employee_username'),
							'item_revised' 		=> $row2->item_revised + 1,
						);
						if (@$where_item_kategori_id) {
							unset($where_item_kategori_id);
						}
						$where_item_kategori_id['data'][] = array(
							'column' => 'item_id',
							'param'	 => $row2->item_id,
						);
						$update_item_kategori = $this->mod->update_data_table('m_item', $where_item_kategori_id, $data_item_kategori);
					}
				}
			}
		}

		// ITEM
		$where_item['data'][] = array(
			'column' => 'item_outlet',
			'param'	 => $id,
		);
		$select_item = $this->mod->select('*', 'm_item', NULL, $where_item);
		if ($select_item) {
			foreach ($select_item->result() as $row) {
				$data_item = array(
					'item_status_aktif' 	=> 'n',
					'item_updated_date' 	=> date('Y-m-d'),
					'item_updated_time' 	=> date('H:i:s'),
					'item_updated_by'		=> $this->session->userdata('employee_username'),
					'item_revised' 		=> $row->item_revised + 1,
				);
				if (@$where_item_id) {
					unset($where_item_id);
				}
				$where_item_id['data'][] = array(
					'column' => 'item_id',
					'param'	 => $row->item_id,
				);
				$update_item = $this->mod->update_data_table('m_item', $where_item_id, $data_item);
			}
		}

		// DISKON
		$where_diskon['data'][] = array(
			'column' => 'diskon_outlet',
			'param'	 => $id,
		);
		$select_diskon = $this->mod->select('*', 'm_diskon', NULL, $where_diskon);
		if ($select_diskon) {
			foreach ($select_diskon->result() as $row) {
				$data_diskon = array(
					'diskon_status_aktif' 	=> 'n',
					'diskon_updated_date' 	=> date('Y-m-d'),
					'diskon_updated_time' 	=> date('H:i:s'),
					'diskon_updated_by'		=> $this->session->userdata('employee_username'),
					'diskon_revised' 		=> $row->diskon_revised + 1,
				);
				if (@$where_diskon_id) {
					unset($where_diskon_id);
				}
				$where_diskon_id['data'][] = array(
					'column' => 'diskon_id',
					'param'	 => $row->diskon_id,
				);
				$update_diskon = $this->mod->update_data_table('m_diskon', $where_diskon_id, $data_diskon);
			}
		}

		// PAJAK
		$where_pajak['data'][] = array(
			'column' => 'pajak_outlet',
			'param'	 => $id,
		);
		$select_pajak = $this->mod->select('*', 'm_pajak', NULL, $where_pajak);
		if ($select_pajak) {
			foreach ($select_pajak->result() as $row) {
				$data_pajak = array(
					'pajak_status_aktif' 	=> 'n',
					'pajak_updated_date' 	=> date('Y-m-d'),
					'pajak_updated_time' 	=> date('H:i:s'),
					'pajak_updated_by'		=> $this->session->userdata('employee_username'),
					'pajak_revised' 			=> $row->pajak_revised + 1,
				);
				if (@$where_pajak_id) {
					unset($where_pajak_id);
				}
				$where_pajak_id['data'][] = array(
					'column' => 'pajak_id',
					'param'	 => $row->pajak_id,
				);
				$update_pajak = $this->mod->update_data_table('m_pajak', $where_pajak_id, $data_pajak);
			}
		}

		// GRATUITY
		$where_gratuity['data'][] = array(
			'column' => 'gratuity_outlet',
			'param'	 => $id,
		);
		$select_gratuity = $this->mod->select('*', 'm_gratuity', NULL, $where_gratuity);
		if ($select_gratuity) {
			foreach ($select_gratuity->result() as $row) {
				$data_gratuity = array(
					'gratuity_status_aktif' 	=> 'n',
					'gratuity_updated_date' 	=> date('Y-m-d'),
					'gratuity_updated_time' 	=> date('H:i:s'),
					'gratuity_updated_by'		=> $this->session->userdata('employee_username'),
					'gratuity_revised' 			=> $row->gratuity_revised + 1,
				);
				if (@$where_gratuity_id) {
					unset($where_gratuity_id);
				}
				$where_gratuity_id['data'][] = array(
					'column' => 'gratuity_id',
					'param'	 => $row->gratuity_id,
				);
				$update_gratuity = $this->mod->update_data_table('m_gratuity', $where_gratuity_id, $data_gratuity);
			}
		}

	}

}
