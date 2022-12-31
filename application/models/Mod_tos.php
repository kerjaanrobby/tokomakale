<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_tos extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $tab1 = 'tos';

    public function listing($where="")
    {
        $this->db->select("idtos, text, lastupdate, date_format(lastupdate, '%d/%m/%Y') as lastupdate_format");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get($this->tab1);
        return $data->result();
    }
}