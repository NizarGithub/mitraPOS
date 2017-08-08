<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_transfer extends MY_Controller {
	private $any_error = array();
	public $tbl 		= 't_transfer';
	public $title_page 	= 'Transfer';
	public $menu_page 	= 'Inventory';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){

		$this->check_session();
		$priv = $this->cekUser(10);

		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> $this->title_page,
			'menu_page' 	=> $this->menu_page,
			'priv_add'		=> $priv['privilege_create']
		);

		$this->open_page(1, 'inventory/transfer/V_transfer', $data, 8);

	}

	public function loadData(){
		$priv = $this->cekUser(10);
		$select = 'a.*, b.outlet_nama as outlet_pengirim_nama, c.outlet_nama as outlet_penerima_nama';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		// JOIN
		$join['data'][] = array(
			'table' => 'm_outlet b',
			'join'	=> 'b.outlet_id = a.outlet_pengirim_id',
			'type'	=> 'left'
		);
		$join['data'][] = array(
			'table' => 'm_outlet c',
			'join'	=> 'c.outlet_id = a.outlet_penerima_id',
			'type'	=> 'left'
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'a.transfer_tanggal, b.outlet_nama as outlet_pengirim_nama, c.outlet_nama as outlet_penerima_nama, a.transfer_keterangan',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select,'t_transfer a', $join);
		$query_filter = $this->mod->select($select, 't_transfer a', $join, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 't_transfer a', $join, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';

				if($priv['privilege_update'] == 'y')
				{
					$button = $button.'
						<button class="btn blue-ebonyclay" type="button" onclick="showForm('.$val->transfer_id.')" title="Lihat">
							<i class="icon-eye text-center"></i>
						</button>';
				}

				$response['data'][] = array(
					$no,
					$val->transfer_tanggal,
					$val->outlet_pengirim_nama,
					$val->outlet_penerima_nama,
					$val->transfer_keterangan,
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
			'column' => 'transfer_id',
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
								'table' => 't_transferdet b',
								'join'	=> 'b.itemdet_id = a.itemdet_id',
								'type'	=> 'left'
							);
							$where_detail2['data'][] = array(
								'column' => 'a.item_id',
								'param'	 => $item_id[$i]
							);
							$where_detail2['data'][] = array(
								'column' => 'b.transfer_id',
								'param'	 => $val->transfer_id
							);
							$query_detail2 = $this->mod->select('a.itemdet_nama, b.*','m_itemdet a', $join_detail2, $where_detail2);
							$hasil['val3'] = array();
							if ($query_detail2) {
								foreach ($query_detail2->result() as $val3) {
									$flag = 0;
									if (strlen($val3->itemdet_nama) > 0) {
										$flag = 1;
									}
									$hasil['val3'][] = array(
										'itemdet_nama' 					=> $val3->itemdet_nama,
										'transferdet_stokawal_pengirim' => $this->generateFormatNumber($val3->transferdet_stokawal_pengirim),
										'transferdet_stokawal_penerima' => $this->generateFormatNumber($val3->transferdet_stokawal_penerima),
										'transferdet_quantity'			=> $this->generateFormatNumber($val3->transferdet_quantity),
										'flag'							=> $flag,
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
					'kode' 					=> $val->transfer_id,
					'transfer_tanggal' 		=> $this->generateFormatDate($val->transfer_tanggal),
					'transfer_jam' 			=> $val->transfer_jam,
					'outlet_pengirim_id'	=> $val->outlet_pengirim_id,
					'outlet_penerima_id'	=> $val->outlet_penerima_id,
					'transfer_keterangan' 	=> $val->transfer_keterangan,
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
	                'column' => 'transfer_id',
	                'type'   => 'DESC'
	            );
	            $limit = array(
	                'start'  => 0,
	                'finish' => 1
	            );
	            $query_sequence = $this->mod->select('transfer_id AS id', $this->tbl, NULL, NULL, NULL, NULL, $order, $limit);
	            if ($query_sequence) {
	                foreach ($query_sequence->result() as $value) {
	                    $id_hdr = $value->id;
	                }
	            }
				// INSERT DETAIL
				for ($i = 0; $i < sizeof($this->input->post('itemdet_id', TRUE)); $i++) { 
					if ($this->input->post('transferdet_quantity', TRUE)[$i] > 0) {
						$data_detail = $this->general_post_data2(1, $id_hdr, $i);
						$insert_detail = $this->mod->insert_data_table('t_transferdet', NULL, $data_detail);
						if($insert_detail->status) {
							$response['status'] = '200';

							if (@$order_detail) {
								unset($order_detail);
							}
							if (@$limit_detail) {
								unset($limit_detail);
							}
				            $order_detail['data'][] = array(
				                'column' => 'transferdet_id',
				                'type'   => 'DESC'
				            );
				            $limit_detail = array(
				                'start'  => 0,
				                'finish' => 1
				            );
				            $query_sequence_detail = $this->mod->select('transfer_id AS id', 't_transferdet', NULL, NULL, NULL, NULL, $order_detail, $limit_detail);
				            if ($query_sequence_detail) {
				                foreach ($query_sequence_detail->result() as $value) {
				                    $id_dtl = $value->id;
				                }
				            }

							// CHECK STOK
							if (@$where_stok) {
								unset($where_stok);
							}
							$where_stok['data'][] = array(
								'column' => 'outlet_id',
								'param'	 => $data['outlet_penerima_id']
							);
							$where_stok['data'][] = array(
								'column' => 'itemdet_id',
								'param'	 => $data_detail['itemdet_id']
							);
							$query_stok = $this->mod->select('*', 's_stok', NULL, $where_stok);
							if ($query_stok) {
								foreach ($query_stok->result() as $val) {
									$data_stok = array(
										'stok_jumlah' 		=> $val->stok_jumlah + $data_detail['transferdet_quantity'],
										'stok_updated_date' => date('Y-m-d'),
										'stok_updated_time' => date('H:i:s'),
										'stok_updated_by' 	=> $this->session->userdata('employee_username'),
										'stok_revised' 		=> $val->stok_revised + 1,
									);
									$update_stok = $this->mod->update_data_table('s_stok', $where_stok, $data_stok);
									
									$data_detail_update = $this->general_post_data2(2, $id_hdr, $i, $id_dtl, $val->stok_jumlah);
									if (@$where_detail_update) {
										unset($where_detail_update);
									}
									$where_detail_update['data'][] = array(
										'column' => 'transferdet_id',
										'param'	 => $id_dtl
									);
									$update_detail = $this->mod->update_data_table('t_transferdet', $where_detail_update, $data_detail_update);
								}
							} else {
								$data_stok = array(
									'outlet_id' 		=> $data['outlet_penerima_id'],
									'itemdet_id' 		=> $data_detail['itemdet_id'],
									'stok_jumlah' 		=> $data_detail['transferdet_quantity'],
									'stok_created_date' => date('Y-m-d'),
									'stok_created_time' => date('H:i:s'),
									'stok_created_by' 	=> $this->session->userdata('employee_username'),
									'stok_updated_date' => date('Y-m-d'),
									'stok_updated_time' => date('H:i:s'),
									'stok_updated_by' 	=> $this->session->userdata('employee_username'),
									'stok_revised' 		=> 0,
								);
								$insert_stok = $this->mod->insert_data_table('s_stok', NULL, $data_stok);
									
								$data_detail_update = $this->general_post_data2(2, $id_hdr, $i, $id_dtl, 0);
								if (@$where_detail_update) {
									unset($where_detail_update);
								}
								$where_detail_update['data'][] = array(
									'column' => 'transferdet_id',
									'param'	 => $id_dtl
								);
								$update_detail = $this->mod->update_data_table('t_transferdet', $where_detail_update, $data_detail_update);
							}
							// END CHECK STOK

							// PENGURANGAN STOK
							if (@$where_stok2) {
								unset($where_stok2);
							}
							$where_stok2['data'][] = array(
								'column' => 'outlet_id',
								'param'	 => $data['outlet_pengirim_id']
							);
							$where_stok2['data'][] = array(
								'column' => 'itemdet_id',
								'param'	 => $data_detail['itemdet_id']
							);
							$query_stok2 = $this->mod->select('*', 's_stok', NULL, $where_stok2);
							if ($query_stok2) {
								foreach ($query_stok2->result() as $val) {
									$data_stok = array(
										'stok_jumlah' 		=> $val->stok_jumlah - $data_detail['transferdet_quantity'],
										'stok_updated_date' => date('Y-m-d'),
										'stok_updated_time' => date('H:i:s'),
										'stok_updated_by' 	=> $this->session->userdata('employee_username'),
										'stok_revised' 		=> $val->stok_revised + 1,
									);
									$update_stok = $this->mod->update_data_table('s_stok', $where_stok2, $data_stok);
								}
							}
							// END PENGURANGAN STOK

						} else {
							$response['status'] = '204';
						}
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
			'column' => 'transfer_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('transfer_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['transfer_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'transfer_tanggal' 			=> date('Y-m-d'),
				'transfer_jam' 				=> date('H:i:s'),
				'outlet_pengirim_id'		=> $this->input->post('outlet_pengirim_id', TRUE),
				'outlet_penerima_id'		=> $this->input->post('outlet_penerima_id', TRUE),
				'item_id' 					=> json_encode($this->input->post('item_id', TRUE)),
				'transfer_keterangan' 		=> $this->input->post('transfer_keterangan', TRUE),
				'transfer_created_date' 	=> date('Y-m-d'),
				'transfer_created_time' 	=> date('H:i:s'),
				'transfer_created_by'		=> $this->session->userdata('employee_username'),
				'transfer_updated_by'		=> $this->session->userdata('employee_username'),
				'transfer_updated_date' 	=> date('Y-m-d'),
				'transfer_updated_time' 	=> date('H:i:s'),
				'transfer_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'transfer_keterangan' 		=> $this->input->post('transfer_keterangan', TRUE),
				'transfer_updated_date' 	=> date('Y-m-d'),
				'transfer_updated_time' 	=> date('H:i:s'),
				'transfer_updated_by'		=> $this->session->userdata('employee_username'),
				'transfer_revised' 			=> $rev,
			);
		}

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null, $stok = null){
		// 1 Insert
		$where['data'][] = array(
			'column' => 'transferdet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('transferdet_revised', 't_transferdet', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['transferdet_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'transfer_id' 					=> $idHdr,
				'itemdet_id'					=> $this->input->post('itemdet_id', TRUE)[$seq],
				'transferdet_stokawal_pengirim' => $this->input->post('transferdet_stokawal_pengirim', TRUE)[$seq],
				'transferdet_quantity'			=> $this->input->post('transferdet_quantity', TRUE)[$seq],
				'transferdet_created_date' 		=> date('Y-m-d'),
				'transferdet_created_time' 		=> date('H:i:s'),
				'transferdet_created_by'		=> $this->session->userdata('employee_username'),
				'transferdet_updated_by'		=> $this->session->userdata('employee_username'),
				'transferdet_updated_date' 		=> date('Y-m-d'),
				'transferdet_updated_time' 		=> date('H:i:s'),
				'transferdet_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'transferdet_stokawal_penerima' => $stok,
				'transferdet_updated_by'		=> $this->session->userdata('employee_username'),
				'transferdet_updated_date' 		=> date('Y-m-d'),
				'transferdet_updated_time' 		=> date('H:i:s'),
				'transferdet_revised' 			=> $rev,
			);

		}

		return $data;
	}
	/* end Function */

}
