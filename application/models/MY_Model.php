<?php

class MY_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /* ====================================
        General Function
    ==================================== */

    // Check User Exist
    function check_exist_user($username, $password){

        $this->db->select("*");
        $this->db->from("m_employee");
        $this->db->where("employee_username = '".$username."' AND employee_password = '".$password."' AND employee_status_aktif = 'y'");

        $query = $this->db->get();

        if($query->num_rows() > 0)
            return $query->row();
        else return false;
    }

    // Select data on table
    function select($select = NULL, $table = NULL, $join = NULL, $where = NULL, $where2 = NULL, $like = NULL, $order = NULL, $limit = NULL) {
        $this->db->select($select);
        $this->db->from($table);
        if ($join) {
            for ($i=0; $i<sizeof($join['data']) ; $i++) {
                $this->db->join($join['data'][$i]['table'],$join['data'][$i]['join'],$join['data'][$i]['type']);
            }
        }
        if ($where) {
            for ($i=0; $i<sizeof($where['data']) ; $i++) {
                $this->db->where($where['data'][$i]['column'],$where['data'][$i]['param']);
            }
        }
        if ($where2) {
            $this->db->where($where2);
        }
        if ($like) {
            for ($i=0; $i<sizeof($like['data']) ; $i++) {
                $this->db->like("CONCAT(' ', '".$like['data'][$i]['column']."')",$like['data'][$i]['param']);
            }
        }
        if ($limit) {
            $this->db->limit($limit['finish'],$limit['start']);
        }
        if ($order) {
            for ($i=0; $i<sizeof($order['data']) ; $i++) {
                $this->db->order_by($order['data'][$i]['column'], $order['data'][$i]['type']);
            }
        }

        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    // Insert data on table
    function insert_data_table($table, $where, $data){
        if ($where) {
            for ($i=0; $i<sizeof($where['data']) ; $i++) {
                $this->db->where($where['data'][$i]['column'],$where['data'][$i]['param']);
            }
        }
        $this->db->insert($table, $data);
        $error = $this->db->error();
        $result = new stdclass();
        if ($this->db->affected_rows() > 0 or $error['code']==0){
            $result->status = true;
            // $result->output = $current_id;
            $result->output = 1;
        }
        else{
            $result->status = false;
            // if($error['code'] <> 0)
            $result->output = $error['code'].': '.$error['message'];
        }

        return $result;
    }

    // Update data on table
    function update_data_table($table, $where, $data, $id = NULL){
        if ($where) {
            for ($i=0; $i<sizeof($where['data']) ; $i++) {
                $this->db->where($where['data'][$i]['column'],$where['data'][$i]['param']);
            }
        }
        $this->db->update($table, $data);
        $error = $this->db->error();
        $result = new stdclass();
        if ($this->db->affected_rows() > 0 or $error['code']==0){
            $result->status = true;
            $result->output = $id;
            $result->output = 1;
        }
        else{
            $result->status = false;
            $result->output = $error['code'].': '.$error['message'];
        }

        return $result;
    }

    // Delete data on table
    function delete_data_table($table, $where){
        if ($where) {
            for ($i=0; $i<sizeof($where['data']) ; $i++) {
                $this->db->where($where['data'][$i]['column'],$where['data'][$i]['param']);
            }
        }
        $this->db->delete($table);
        $error = $this->db->error();
        $result = new stdclass();
        if ($this->db->affected_rows() > 0 or $error['code']==0){
            $result->status = true;
            // $result->output = $this->db->insert_id();
        }
        else{
            $result->status = false;
            $result->output = $error['code'].': '.$error['message'];
        }

        return $result;
    }

    /* ====================================
        End General Function
    ==================================== */

    // CUSTOM QUERY
    // END CUSTOM QUERY

}
