<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_item extends MY_Controller {
	private $any_error = array();
	public $tbl 		= 'm_item';
	public $title_page 	= 'Item';
	public $menu_page 	= 'Library';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){

		$this->check_session();
		$priv = $this->cekUser(7);

		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> $this->title_page,
			'menu_page' 	=> $this->menu_page,
			'priv_add'		=> $priv['privilege_create']
		);

		$this->open_page(1, 'library/item/V_item', $data, 1);

	}

	public function loadData(){
		$priv = $this->cekUser(7);
		$select = 'a.*, b.*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		// JOIN
		$join['data'][] = array(
			'table' => 'm_kategori b',
			'join'	=> 'b.kategori_id = a.kategori_id',
			'type'	=> 'left'
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'a.item_nama, b.kategori_nama, a.item_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select,'m_item a', $join);
		$query_filter = $this->mod->select($select, 'm_item a', $join, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'm_item a', $join, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->item_status_aktif == 'y') {

					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['privilege_update'] == 'y')
					{
						$button = $button.'
							<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->item_id.')" title="Edit">
								<i class="icon-pencil text-center"></i>
							</button>';
					}

					if($priv['privilege_delete'] == 'y')
					{
						$button = $button.'
							<button class="btn red-thunderbird" type="button" onclick="setNonaktif('.$val->item_id.')" title="Non Aktifkan">
								<i class="icon-power text-center"></i>
							</button>';
					}
					
				} else {
					
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['privilege_update'] == 'y')
					{
						$button = $button.'
							<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->item_id.')" title="Edit" disabled>
								<i class="icon-pencil text-center"></i>
							</button>';
					}

					if($priv['privilege_delete'] == 'y')
					{
						$button = $button.'
							<button class="btn green-jungle" type="button" onclick="setAktif('.$val->item_id.')" title="Aktifkan">
								<i class="icon-power text-center"></i>
							</button>';
					}
					
				}

				if ($val->kategori_id <> 0) {
					$kategori_nama = $val->kategori_nama;
				} else {
					$kategori_nama = 'Tidak Dikategorikan';
				}

				$response['data'][] = array(
					$no,
					$val->item_nama,
					$kategori_nama,
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
			'column' => 'item_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {

				// CARI DETAIL
				$where_detail['data'][] = array(
					'column' => 'item_id',
					'param'	 => $val->item_id
				);
				$query_detail = $this->mod->select('*','m_itemdet', NULL, $where_detail);
				$response['val2'] = array();
				if ($query_detail) {
					foreach ($query_detail->result() as $val2) {

						$response['val2'][] = array(
							'itemdet_id'			=> $val2->itemdet_id,
							'itemdet_nama' 			=> $val2->itemdet_nama,
							'itemdet_harga'			=> $val2->itemdet_harga,
							'itemdet_sku' 			=> $val2->itemdet_sku,
							'itemdet_istrack_stock' => $val2->itemdet_istrack_stock,
							'itemdet_islimit_alert' => $val2->itemdet_islimit_alert,
							'itemdet_limit' 		=> $val2->itemdet_limit,
						);

					}
				}

				$response['val'][] = array(
					'kode' 				=> $val->item_id,
					'item_outlet' 		=> $val->item_outlet,
					'item_nama' 		=> $val->item_nama,
					'kategori_id' 		=> $val->kategori_id,
					'item_keterangan' 	=> $val->item_keterangan,
					'item_status_aktif' => $val->item_status_aktif,
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
				'column' => 'item_status_aktif',
				'param'	 => 'y'
			);
			$where_like['data'][] = array(
				'column' => 'item_nama',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'item_nama',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->item_id,
						'text'	=> $val->item_nama
					);
				}
				$response['status'] = '200';
			}

		} else if ($tipe == 2) {

			$select = '*';
			$where['data'][] = array(
				'column' => 'item_status_aktif',
				'param'	 => 'y'
			);
			$order['data'][] = array(
				'column' => 'item_nama',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->item_id,
						'text'	=> $val->item_nama
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
				'column' => 'item_id',
				'param'	 => $id
			);
			$update = $this->mod->update_data_table($this->tbl, $where, $data);
			if($update->status) {
				$response['status'] = '200';
				$id_hdr = $id;
				$delete = $this->mod->delete_data_table('m_itemdet', $where);
				// INSERT DETAIL
				for ($i = 0; $i < sizeof($this->input->post('itemdet_harga', TRUE)); $i++) { 
					$data_detail = $this->general_post_data2(1, $id_hdr, $i);
					$insert_detail = $this->mod->insert_data_table('m_itemdet', NULL, $data_detail);
					if($insert_detail->status) {
						$response['status'] = '200';
					} else {
						$response['status'] = '204';
					}
				}
			} else {
				$response['status'] = '204';
			}
		} else {
			//INSERT
			$data = $this->general_post_data(1);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$response['status'] = '200';
	            $order['data'][] = array(
	                'column' => 'item_id',
	                'type'   => 'DESC'
	            );
	            $limit = array(
	                'start'  => 0,
	                'finish' => 1
	            );
	            $query_sequence = $this->mod->select('item_id AS id', $this->tbl, NULL, NULL, NULL, NULL, $order, $limit);
	            if ($query_sequence) {
	                foreach ($query_sequence->result() as $value) {
	                    $id_hdr = $value->id;
	                }
	            }
				// INSERT DETAIL
				for ($i = 0; $i < sizeof($this->input->post('itemdet_harga', TRUE)); $i++) { 
					$data_detail = $this->general_post_data2(1, $id_hdr, $i);
					$insert_detail = $this->mod->insert_data_table('m_itemdet', NULL, $data_detail);
					if($insert_detail->status) {
						$response['status'] = '200';
					} else {
						$response['status'] = '204';
					}
				}
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
			'column' => 'item_id',
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
			'column' => 'item_id',
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
			'column' => 'item_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('item_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['item_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'item_nama' 			=> $this->input->post('item_nama', TRUE),
				'kategori_id' 			=> $this->input->post('kategori_id', TRUE),
				'item_outlet' 			=> $this->input->post('item_outlet', TRUE),
				'item_keterangan' 		=> $this->input->post('item_keterangan', TRUE),
				'item_status_aktif' 	=> $this->input->post('item_status_aktif', TRUE),
				'item_created_date' 	=> date('Y-m-d'),
				'item_created_time' 	=> date('H:i:s'),
				'item_created_by'		=> $this->session->userdata('employee_username'),
				'item_updated_by'		=> $this->session->userdata('employee_username'),
				'item_updated_date' 	=> date('Y-m-d'),
				'item_updated_time' 	=> date('H:i:s'),
				'item_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'item_nama' 			=> $this->input->post('item_nama', TRUE),
				'kategori_id' 			=> $this->input->post('kategori_id', TRUE),
				'item_outlet' 			=> $this->input->post('item_outlet', TRUE),
				'item_keterangan' 		=> $this->input->post('item_keterangan', TRUE),
				'item_status_aktif' 	=> $this->input->post('item_status_aktif', TRUE),
				'item_updated_date' 	=> date('Y-m-d'),
				'item_updated_time' 	=> date('H:i:s'),
				'item_updated_by'		=> $this->session->userdata('employee_username'),
				'item_revised' 			=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'item_status_aktif' 	=> 'n',
				'item_updated_date' 	=> date('Y-m-d'),
				'item_updated_time' 	=> date('H:i:s'),
				'item_updated_by'		=> $this->session->userdata('employee_username'),
				'item_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'item_status_aktif' 	=> 'y',
				'item_updated_date' 	=> date('Y-m-d'),
				'item_updated_time' 	=> date('H:i:s'),
				'item_updated_by'		=> $this->session->userdata('employee_username'),
				'item_revised' 			=> $rev,
			);
		}

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert
		$where['data'][] = array(
			'column' => 'itemdet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('itemdet_revised', 'm_itemdet', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['itemdet_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'item_id' 				=> $idHdr,
				'itemdet_nama' 			=> $this->input->post('itemdet_nama', TRUE)[$seq],
				'itemdet_harga'			=> $this->input->post('itemdet_harga', TRUE)[$seq],
				'itemdet_sku' 			=> $this->input->post('itemdet_sku', TRUE)[$seq],
				'itemdet_istrack_stock'	=> $this->input->post('itemdet_istrack_stock', TRUE)[$seq],
				'itemdet_islimit_alert'	=> $this->input->post('itemdet_islimit_alert', TRUE)[$seq],
				'itemdet_limit' 		=> $this->input->post('itemdet_limit', TRUE)[$seq],
				'itemdet_created_date' 	=> date('Y-m-d'),
				'itemdet_created_time' 	=> date('H:i:s'),
				'itemdet_created_by'	=> $this->session->userdata('employee_username'),
				'itemdet_updated_by'	=> $this->session->userdata('employee_username'),
				'itemdet_updated_date' 	=> date('Y-m-d'),
				'itemdet_updated_time' 	=> date('H:i:s'),
				'itemdet_revised' 		=> 0,
			);
		}

		return $data;
	}
	/* end Function */

	function nonaktif_atribut($id){
		// DISKON
		$where_diskon['data'][] = array(
			'column' => 'diskon_type',
			'param'	 => '3',
		);
		$where_diskon['data'][] = array(
			'column' => 'diskon_target',
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
					'diskon_revised' 			=> $row->diskon_revised + 1,
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

	}

}
