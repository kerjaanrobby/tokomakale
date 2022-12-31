<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_point extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    // MENAMPILKAN DATA TABLE APP
    public function listing($where = '')
    {
        $this->db->select("idpoint, idtransaksi, iduser, point, tanggal, date_format(tanggal, 'd%/%m/%Y') as tanggal_format ");
        $this->db->where($where);
        $data = $this->db->get("point");
        return $data->result();
    }
    public function getJumlahPoint($where = '')
    {
        $point="0";
        $this->db->select(" SUM(point) as jumlahpoint");
        $this->db->where($where);
        $data = $this->db->get("point");
        foreach($data->result() as $rs){
            $point = $rs->jumlahpoint;
        }
        return $point;
    }
    public function getJumlahPointKeluar($where = '')
    {
        $point="0";
        $this->db->select(" SUM(point) as jumlahpoint");
        $this->db->where($where);
        $data = $this->db->get("point");
        foreach($data->result() as $rs){
            $point = $rs->jumlahpoint;
        }
        return $point;
    }
}