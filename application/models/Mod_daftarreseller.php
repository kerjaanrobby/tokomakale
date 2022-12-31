<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_daftarreseller extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $tab1 = 'syaratreseller';
    var $col_order = array(null,'idsyaratreseller','reseller', 'resellervip');
    var $col_search = array('idsyaratreseller','reseller', 'resellervip');

    public function listing($where="")
    {
        $this->db->select("idsyaratreseller, reseller, resellervip");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get($this->tab1);
        return $data->result();
    }
}