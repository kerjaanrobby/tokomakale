<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_dashboard extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    var $tab1 = 'admin';
    var $col_order = array(null,'username', 'email','password','level');
    var $col_search = array('username', 'email','password','level');

    public function getUangMasuk($start,$end)
    {
        $data = $this->db->query("SELECT SUM(harga) as uangmasuk FROM `transaksi_detail`
        WHERE tanggal between '".$start." 00:00:00' and '".$end." 23:59:59' ");
        foreach($data->result() as $res){
			$result = $res->uangmasuk;
		}
		return $result;
    }   
    public function getModal($start,$end)
    {
        $data = $this->db->query("SELECT SUM(modal) as modal FROM `transaksi_detail`
        WHERE tanggal between '".$start." 00:00:00' and '".$end." 23:59:59' ");
        foreach($data->result() as $res){
			$result = $res->modal;
		}
		return $result;
    } 
    public function getUntung($start,$end)
    {
        $data = $this->db->query("SELECT SUM(untung) as untung FROM `transaksi_detail`
        WHERE tanggal between '".$start." 00:00:00' and '".$end." 23:59:59' ");
        foreach($data->result() as $res){
			$result = $res->untung;
		}
		return $result;
    }
    public function getTransaksiList($start,$end)
    {
        $data = $this->db->query("SELECT date_format(tanggal, '%d-%m-%Y') as tanggal, SUM(harga) as uangmasuk, SUM(untung) as untung  FROM `transaksi_detail`
        WHERE tanggal between '".$start." 00:00:00' and '".$end." 23:59:59' GROUP BY year(tanggal), month(tanggal), day(tanggal)");
		return $data->result();
    }
    public function getTransPayment($start,$end)
    {
        $data = $this->db->query("SELECT via, SUM(harga) as uangmasuk  FROM `transaksi_detail`
        WHERE tanggal between '".$start." 00:00:00' and '".$end." 23:59:59' GROUP BY via ");
		return $data->result();
    }
    public function getPublik($start,$end)
    {
        $data = $this->db->query("SELECT SUM(harga) as harga FROM `transaksi_detail`
        WHERE jenis='Publik' AND tanggal between '".$start." 00:00:00' and '".$end." 23:59:59' ");
        foreach($data->result() as $res){
			$result = $res->harga;
		}
		return $result;
    }
    public function getReseller($start,$end)
    {
        $data = $this->db->query("SELECT SUM(harga) as harga FROM `transaksi_detail`
        WHERE jenis='Reseller' AND tanggal between '".$start." 00:00:00' and '".$end." 23:59:59' ");
        foreach($data->result() as $res){
			$result = $res->harga;
		}
		return $result;
    }
}
