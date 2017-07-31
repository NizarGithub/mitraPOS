<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $admin_granted = false;
	public $logged_in = false;
	public $app_name = 'POS';

	public function __construct() {
		parent::__construct();
		$this->is_logged_in();
		$this->user_has_access();
		
	}	
	
	/* ====================================
		General Function
	==================================== */

	// Check Session Active
	function is_logged_in() {
	   	$user = $this->session->userdata('logged');
	   	if($user=="")
	   		$this->logged_in = false;
	   	else
	   		$this->logged_in = true;
	}

	function check_session(){
		if(!$this->logged_in)
			redirect('Login');
	}

	// Check if user has level
	function user_has_access(){
		$user_level = $this->session->userdata('level');
		if($user_level!=0)
			$this->admin_granted = true;
		else if($user_level==0)
			$this->admin_granted = false;
	}

	// Check Authorized User
	function cekUser($idmenu){
		$select = '*';
		$tbl = 's_privilege';
		$where['data'][] = array(
			'column' => 'employee_type_id',
			'param'	 => $this->session->userdata('employee_tipe')
		);
		$where['data'][] = array(
			'column' => 'menu_id',
			'param'	 => $idmenu
		);
		$priv = $this->mod->select($select, $tbl, NULL, $where)->row_array();
		return $priv;
	}

	// User Log
	function insertUserLog($data = NULL){
		if ($data) {
			$data_log = array(
				'm_tipe_user_id'		=> $this->session->userdata('user_tipe'),
				'user_log_refrensi_id'	=> $this->session->userdata('user_id'),
				'user_log_aktivitas'	=> $data['user_log_aktivitas'],
				'user_log_ip'			=> $_SERVER['REMOTE_ADDR'],
				'user_log_created_date'	=> date('Y-m-d H:i:s'),
				'user_log_created_by'	=> $this->session->userdata('user_login'),
			);
			$insert = $this->mod->insert_data_table('t_user_log', NULL, $data_log);
		}
	}

	// Merge content to header and footer
	function open_page($type = 0, $file_name, $data = NULL, $id_menu = NULL){
		
		if ($type == 0) {

			$select = "a.*,b.*";
			$tbl = "s_menu a";
			//JOIN
			$join['data'][] = array(
				'table' => "s_privilege b",
				'join'	=> "b.menu_id = a.menu_id",
				'type'	=> "inner"
			);
			//WHERE
			$where['data'][] = array(
				'column' => "b.employee_type_id",
				'param'	 => $this->session->userdata('employee_tipe')
			);
			$where['data'][] = array(
				'column' => "a.menu_type",
				'param'	 => '0'
			);
			$where['data'][] = array(
				'column' => "b.privilege_read",
				'param'	 => 'y'
			);
			$where['data'][] = array(
				'column' => "a.menu_status_aktif",
				'param'	 => 'y'
			);
			//ORDER
			$order['data'][] = array(
				'column' => "a.menu_index",
				'type'	 => 'ASC'
			);
			$data['mainmenu'] = $this->mod->select($select, $tbl, $join, $where, NULL, NULL, $order, NULL);

			$this->load->view('layout/V_header_dashboard', $data);
			$this->load->view($file_name);

		} else if ($type == 1) {

			$select = "a.*,b.*";
			$tbl = "s_menu a";
			//JOIN
			$join['data'][] = array(
				'table' => "s_privilege b",
				'join'	=> "b.menu_id = a.menu_id",
				'type'	=> "inner"
			);
			//WHERE
			$where['data'][] = array(
				'column' => "b.employee_type_id",
				'param'	 => $this->session->userdata('employee_tipe')
			);
			$where['data'][] = array(
				'column' => "a.menu_type",
				'param'	 => '1'
			);
			$where['data'][] = array(
				'column' => "a.menu_parent",
				'param'	 => $id_menu
			);
			$where['data'][] = array(
				'column' => "b.privilege_read",
				'param'	 => 'y'
			);
			$where['data'][] = array(
				'column' => "a.menu_status_aktif",
				'param'	 => 'y'
			);
			//ORDER
			$order['data'][] = array(
				'column' => "a.menu_index",
				'type'	 => 'ASC'
			);
			$data['mainmenu'] = $this->mod->select($select, $tbl, $join, $where, NULL, NULL, $order, NULL);

			$this->load->view('layout/V_header', $data);
			$this->load->view($file_name);

		}


	}

	// Notification
	function insertNotification($data = NULL){
		if ($data) {
			$data_notifikasi = array(
				'notifikasi_tipe_user_asal'		=> $data['notifikasi_tipe_user_asal'],
				'notifikasi_tipe_user_tujuan'	=> $data['notifikasi_tipe_user_tujuan'],
				'notifikasi_user_id_asal'		=> $data['notifikasi_user_id_asal'],
				'notifikasi_user_id_tujuan'		=> $data['notifikasi_user_id_tujuan'],
				'notifikasi_link'				=> $data['notifikasi_link'],
				'notifikasi_keterangan'			=> $data['notifikasi_keterangan'],
				'notifikasi_created_date'		=> date('Y-m-d H:i:s'),
				'notifikasi_created_by'			=> $data['notifikasi_created_by'],
			);
			$insert = $this->mod->insert_data_table('t_notifikasi', NULL, $data_notifikasi);
		}
	}

	function notificationTime($date_param){
		$awal  = date_create($date_param);
	    $akhir = date_create(); // waktu sekarang
	    $diff  = date_diff( $awal, $akhir );

	    if ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h == 0 && $diff->i == 0) {
	    	$time = $diff->s . ' detik yang lalu';
	    } else if ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h == 0) {
	    	$time = $diff->i . ' menit yang lalu';
	    } else if ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h > 0) {
	    	$time = $diff->h . ' jam yang lalu';
	    } else {
	    	$time = date('d F Y H:i', strtotime($date_param));
	    }

	    return $time;
	}

	// Format indonesian money
	function format_money_id($value){
		$format = "RP ".number_format($value,0,',','.');
		return $format;
	}

	// Format indonesian month
	function format_month_id($bln){
		$Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$result = $Bulan[(int)$bln-1];		
		return($result);
	}

	// Format Transaction Code
	function format_kode_transaksi($type, $query, $bln = NULL, $thn = NULL){
		if ($bln) {
			$bln = $bln;
		} else {
			$bln = date('m');
		}
		$thn = date('Y');
		if ($query<>false) {
			foreach ($query->result() as $row) {
				$urut = intval($row->id) + 1;
				$seq = sprintf("%05d",$urut);
			}
		} else {
			$seq = sprintf("%05d",1);
		}
		$kode_baru = $type.$thn.$bln.$seq;
		return $kode_baru;
	}

	function insert_kartu_stok($table, $data){
		$insert = $this->mod->insert_data_table($table, NULL, $data);
		if($insert->status) {
			$status = '200';
		} else {
			$status = '204';
		}
		return $status;
	}

	function replaceFormatNumber($value){
		$number = str_replace(',', '', $value);
		return $number;
	}	

	function generateFormatNumber($value){
		$number = number_format($value, 2, ".", ",");
		return $number;
	}

	function generateFormatDate($value){
		$string = date("d/m/Y", strtotime($value));
		return $string;
	}

	function format_terbilang_indo($x)
    {
		$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		if ($x < 12)
		return " " . $abil[$x];
		elseif ($x < 20)
		return $this->format_terbilang_indo($x - 10) . "belas";
		elseif ($x < 100)
		return $this->format_terbilang_indo($x / 10) . " puluh" . $this->format_terbilang_indo($x % 10);
		elseif ($x < 200)
		return " seratus" . $this->format_terbilang_indo($x - 100);
		elseif ($x < 1000)
		return $this->format_terbilang_indo($x / 100) . " ratus" . $this->format_terbilang_indo($x % 100);
		elseif ($x < 2000)
		return " seribu" . $this->format_terbilang_indo($x - 1000);
		elseif ($x < 1000000)
		return $this->format_terbilang_indo($x / 1000) . " ribu" . $this->format_terbilang_indo($x % 1000);
		elseif ($x < 1000000000)
		return $this->format_terbilang_indo($x / 1000000) . " juta" . $this->format_terbilang_indo($x % 1000000);
    }	
	
	/* ====================================
		End General Function
	==================================== */
	
	/* ====================================
		Custom Function
	==================================== */

	/* ====================================
		End Custom Function
	==================================== */
}

/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */
