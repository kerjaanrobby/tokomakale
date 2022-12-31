<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_notifikasi extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    var $tab1 = 'notifikasi';

    public function listing($where="")
    {
        $this->db->select("*");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get($this->tab1);
        return $data->result();
    }

}