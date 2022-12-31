<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_voucherstok extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $tab1 = 'voucher_stok';
    var $col_order = array(null,'kode','status');
    var $col_search = array('kode','status');

    // MENAMPILKAN DATA TABLE JURSAN
    public function listingvoucher($where,$limit)
    {
        $this->db->select("*");
        if($where!=""){
            $this->db->where($where);
        }
        $this->db->limit($limit);
        $data = $this->db->get($this->tab1);
        return $data->result();
    }
    public function getstokvoucher($where)
    {
        $this->db->select("*");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get($this->tab1);
        return $data->num_rows();
    }

    // MENAMPILKAN DATA TABLE JURSAN
    public function listing($where="")
    {
        $this->db->select("*");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get($this->tab1);
        return $data->result();
    }
    // DATATABLE
    // FUNC QUERY DATA TABLE JURSAN
    public function _get_datatables_query($where)
    {
        if($where!=""){
            $this->db->where(array("idvoucher"=>$where,"status"=>"Aktif"));
        }
        $this->db->select("*");
        $this->db->from($this->tab1);
        $i=0;
        foreach($this->col_search as $item) {
            if($_POST['search']['value'])
    		{
    			if($i===0)
    			{
    				$this->db->group_start();
    				$this->db->like($item, $_POST['search']['value']);
    			}else{
    				$this->db->or_like($item, $_POST['search']['value']);
    			}

    			if(count($this->col_search) -1 == $i)
    				$this->db->group_end();
    		}
    		$i++;
        }
        if(isset($_POST['order']))
    	{
    		$this->db->order_by($this->col_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order)){
        	$order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }
    // DATATABLE
    // MENAMPILKAN DATA TABLE JURSAN
    function get_datatables($where)
    {
        $this->_get_datatables_query($where);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    // DATATABLE
    // FILTER TABLE JURSAN
    function count_filtered($where)
    {
        $this->_get_datatables_query($where);
        $query = $this->db->get();
        return $query->num_rows();
    }
    // DATATABLE
    // MENGHITUNG JUMLAH ROW TABLE JURSAN  
    public function count_all($where)
    {
        if($where!=""){
            $this->db->where(array("idvoucher"=>$where,"status"=>"Aktif"));
        }
        $this->db->from($this->tab1);
        return $this->db->count_all_results();
    }

    // DATATABLE
    // FUNC QUERY DATA TABLE JURSAN
    public function _get_datatables_query_history($where)
    {
        if($where!=""){
            $this->db->where(array("idvoucher"=>$where,"status!="=>"Aktif"));
        }
        $this->db->select("*");
        $this->db->from($this->tab1);
        $i=0;
        foreach($this->col_search as $item) {
            if($_POST['search']['value'])
    		{
    			if($i===0)
    			{
    				$this->db->group_start();
    				$this->db->like($item, $_POST['search']['value']);
    			}else{
    				$this->db->or_like($item, $_POST['search']['value']);
    			}

    			if(count($this->col_search) -1 == $i)
    				$this->db->group_end();
    		}
    		$i++;
        }
        if(isset($_POST['order']))
    	{
    		$this->db->order_by($this->col_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order)){
        	$order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }
    // DATATABLE
    // MENAMPILKAN DATA TABLE JURSAN
    function get_datatables_history($where)
    {
        $this->_get_datatables_query_history($where);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    // DATATABLE
    // FILTER TABLE JURSAN
    function count_filtered_history($where)
    {
        $this->_get_datatables_query_history($where);
        $query = $this->db->get();
        return $query->num_rows();
    }
    // DATATABLE
    // MENGHITUNG JUMLAH ROW TABLE JURSAN  
    public function count_all_history($where)
    {
        if($where!=""){
            $this->db->where(array("idvoucher"=>$where,"status!="=>"Aktif"));
        }
        $this->db->from($this->tab1);
        return $this->db->count_all_results();
    }

    public function getKodeVoucher($kode)
    {
        $result="";
        $data = $this->db->query("SELECT kode FROM voucher_stok WHERE kode='$kode'");
        foreach($data->result() as $d)
        {
            $result = $d->kode;
        }
        return $result;
    }
}