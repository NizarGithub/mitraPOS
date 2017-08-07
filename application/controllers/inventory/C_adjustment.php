<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_adjustment extends MY_Controller {
	private $any_error = array();
	public $tbl 		= 't_adjustment';
	public $title_page 	= 'Adjustment';
	public $menu_page 	= 'Inventory';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){

		$this->check_session();
		$priv = $this->cekUser(11);

		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> $this->title_page,
			'menu_page' 	=> $this->menu_page,
			'priv_add'		=> $priv['privilege_create']
		);

		$this->open_page(1, 'inventory/adjustment/V_adjustment', $data, 8);

	}

	public function loadData(){
		$priv = $this->cekUser(11);
		$select = 'a.*, b.*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		// JOIN
		$join['data'][] = array(
			'table' => 'm_outlet b',
			'join'	=> 'b.outlet_id = a.outlet_id',
			'type'	=> 'left'
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'a.adjustment_date, b.outlet_nama, a.adjustment_keterangan',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select,'t_adjustment a', $join);
		$query_filter = $this->mod->select($select, 't_adjustment a', $join, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 't_adjustment a', $join, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';

				if($priv['privilege_update'] == 'y')
				{
					$button = $button.'
						<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->adjustment_id.')" title="Lihat">
							<i class="icon-eye text-center"></i>
						</button>';
				}

				$response['data'][] = array(
					$no,
					$val->adjustment_date,
					$val->outlet_nama,
					$val->adjustment_keterangan,
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
			'column' => 'adjustment_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {

				// CARI DETAIL
				$response['val2'] = array();
				$item_id = json_decode($val->item_id);
				for ($i = 0; $i < sizeof($item_id); $i++) {

					if (@$where_detail) {
						unset($where_detail);
					}
					$where_detail['data'][] = array(
						'column' => 'item_id',
						'param'	 => $item_id[$i]
					);
					$query_detail = $this->mod->select('*','m_item', NULL, $where_detail);
					if ($query_detail) {
						foreach ($query_detail->result() as $val2) {

							// DETAIL ITEM
							if (@$join_detail2) {
								unset($join_detail2);
							}
							if (@$where_detail2) {
								unset($where_detail2);
							}
							$join_detail2['data'][] = array(
								'table' => 't_adjustmentdet b',
								'join'	=> 'b.itemdet_id = a.itemdet_id',
								'type'	=> 'left'
							);
							$where_detail2['data'][] = array(
								'column' => 'a.item_id',
								'param'	 => $item_id[$i]
							);
							$where_detail2['data'][] = array(
								'column' => 'b.adjustment_id',
								'param'	 => $val->adjustment_id
							);
							$query_detail2 = $this->mod->select('a.itemdet_nama, b.*','m_itemdet a', $join_detail2, $where_detail2);
							$hasil['val3'] = array();
							if ($query_detail2) {
								foreach ($query_detail2->result() as $val3) {
									$hasil['val3'][] = array(
										'itemdet_nama' 					=> $val3->itemdet_nama,
										'adjustmentdet_stok_awal' 		=> $this->generateFormatNumber($val3->adjustmentdet_stok_awal),
										'adjustmentdet_stok_koreksi'	=> $this->generateFormatNumber($val3->adjustmentdet_stok_koreksi),
									);
								}
							}
							// END DETAIL ITEM

							$response['val2'][] = array(
								'item_nama' 	=> $val2->item_nama,
								'item_detail' 	=> $hasil,
							);

						}
					}
				}

				$response['val'][] = array(
					'kode' 						=> $val->adjustment_id,
					'adjustment_date' 			=> $this->generateFormatDate($val->adjustment_date),
					'adjustment_time' 			=> $val->adjustment_time,
					'outlet_id'					=> $val->outlet_id,
					'adjustment_keterangan' 	=> $val->adjustment_keterangan,
				);
			}

			echo json_encode($response);
		}
	}

	// Function Insert & Update
	public function postData(){
		$id = $this->input->post('kode');

		if (strlen($id)>0) {
		} else {
			//INSERT
			$data = $this->general_post_data(1);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$response['status'] = '200';
	            $order['data'][] = array(
	                'column' => 'adjustment_id',
	                'type'   => 'DESC'
	            );
	            $limit = array(
	                'start'  => 0,
	                'finish' => 1
	            );
	            $query_sequence = $this->mod->select('adjustment_id AS id', $this->tbl, NULL, NULL, NULL, NULL, $order, $limit);
	            if ($query_sequence) {
	                foreach ($query_sequence->result() as $value) {
	                    $id_hdr = $value->id;
	                }
	            }
				// INSERT DETAIL
				for ($i = 0; $i < sizeof($this->input->post('itemdet_id', TRUE)); $i++) { 
					$data_detail = $this->general_post_data2(1, $id_hdr, $i);
					$insert_detail = $this->mod->insert_data_table('t_adjustmentdet', NULL, $data_detail);
					if($insert_detail->status) {
						$response['status'] = '200';

						// CHECK STOK
						if (@$where_stok) {
							unset($where_stok);
						}
						$where_stok['data'][] = array(
							'column' => 'outlet_id',
							'param'	 => $data['outlet_id']
						);
						$where_stok['data'][] = array(
							'column' => 'itemdet_id',
							'param'	 => $data_detail['itemdet_id']
						);
						$query_stok = $this->mod->select('*', 's_stok', NULL, $where_stok);
						if ($query_stok) {
							foreach ($query_stok->result() as $val) {
								$data_stok = array(
									'stok_jumlah' 		=> $data_detail['adjustmentdet_stok_koreksi'],
									'stok_updated_date' => date('Y-m-d'),
									'stok_updated_time' => date('H:i:s'),
									'stok_updated_by' 	=> $this->session->userdata('employee_username'),
									'stok_revised' 		=> $val->stok_revised + 1,
								);
								$update_stok = $this->mod->insert_data_table('s_stok', $where_stok, $data_stok);
							}
						} else {
							$data_stok = array(
								'outlet_id' 		=> $data['outlet_id'],
								'itemdet_id' 		=> $data_detail['itemdet_id'],
								'stok_jumlah' 		=> $data_detail['adjustmentdet_stok_koreksi'],
								'stok_created_date' => date('Y-m-d'),
								'stok_created_time' => date('H:i:s'),
								'stok_created_by' 	=> $this->session->userdata('employee_username'),
								'stok_updated_date' => date('Y-m-d'),
								'stok_updated_time' => date('H:i:s'),
								'stok_updated_by' 	=> $this->session->userdata('employee_username'),
								'stok_revised' 		=> 0,
							);
							$insert_stok = $this->mod->insert_data_table('s_stok', NULL, $data_stok);
						}
						// END CHECK STOK

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

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif, 4 Aktif
		$where['data'][] = array(
			'column' => 'adjustment_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('adjustment_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['adjustment_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'adjustment_date' 			=> date('Y-m-d'),
				'adjustment_time' 			=> date('H:i:s'),
				'outlet_id' 				=> $this->input->post('outlet_id', TRUE),
				'item_id' 					=> json_encode($this->input->post('item_id', TRUE)),
				'adjustment_keterangan' 	=> $this->input->post('adjustment_keterangan', TRUE),
				'adjustment_created_date' 	=> date('Y-m-d'),
				'adjustment_created_time' 	=> date('H:i:s'),
				'adjustment_created_by'		=> $this->session->userdata('employee_username'),
				'adjustment_updated_by'		=> $this->session->userdata('employee_username'),
				'adjustment_updated_date' 	=> date('Y-m-d'),
				'adjustment_updated_time' 	=> date('H:i:s'),
				'adjustment_revised' 		=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'outlet_id' 				=> $this->input->post('outlet_id', TRUE),
				'adjustment_keterangan' 	=> $this->input->post('adjustment_keterangan', TRUE),
				'adjustment_updated_date' 	=> date('Y-m-d'),
				'adjustment_updated_time' 	=> date('H:i:s'),
				'adjustment_updated_by'		=> $this->session->userdata('employee_username'),
				'adjustment_revised' 		=> $rev,
			);
		}

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert
		$where['data'][] = array(
			'column' => 'adjustmentdet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('adjustmentdet_revised', 't_adjustmentdet', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['adjustmentdet_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'adjustment_id' 				=> $idHdr,
				'itemdet_id'					=> $this->input->post('itemdet_id', TRUE)[$seq],
				'adjustmentdet_stok_awal' 		=> $this->input->post('adjustmentdet_stok_awal', TRUE)[$seq],
				'adjustmentdet_stok_koreksi'	=> $this->input->post('adjustmentdet_stok_koreksi', TRUE)[$seq],
				'adjustmentdet_created_date' 	=> date('Y-m-d'),
				'adjustmentdet_created_time' 	=> date('H:i:s'),
				'adjustmentdet_created_by'		=> $this->session->userdata('employee_username'),
				'adjustmentdet_updated_by'		=> $this->session->userdata('employee_username'),
				'adjustmentdet_updated_date' 	=> date('Y-m-d'),
				'adjustmentdet_updated_time' 	=> date('H:i:s'),
				'adjustmentdet_revised' 		=> 0,
			);
		}

		return $data;
	}
	/* end Function */

}
