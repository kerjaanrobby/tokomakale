<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_conf extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function UpdateData($tableName,$data,$where){
		$res = $this->db->update($tableName,$data,$where);
		return $res;
	}
	public function DeleteData($tableName,$where){
		$res = $this->db->delete($tableName,$where);
		return $res;
	}
	public function InsertData($tableName, $data)
	{
		$res = $this->db->insert($tableName, $data);
		return $res;
	}
}