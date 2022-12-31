<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_tarik extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    var $tab1 = 'tarik';
    var $col_order = array(null,'tanggal', 'nominal','norek','atasnama','status');
    var $col_search = array('tanggal', 'nominal','norek','atasnama','status');

    public function listing($where="")
    {

        $this->db->select("idtarik, tanggal, nominal, iduser, bank, atasnama, norek, status, file, date_format(tanggal, '%d-%m-%Y') as tanggalf");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get($this->tab1);
        return $data->result();
    }
    public function _get_datatables_query($iduser)
    {
        
        $this->db->select("*, date_format(tanggal, '%d-%m-%Y %H:%i') as tanggalf");
        $this->db->from($this->tab1);
        if($iduser!="")
        {
            $this->db->where("iduser",$iduser);
        }
        $this->db->order_by("tanggal","desc");
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
    function get_datatables($iduser)
    {
        $this->_get_datatables_query($iduser);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered($iduser)
    {
        $this->_get_datatables_query($iduser);
        $query = $this->db->get();
        return $query->num_rows();
    } 
    public function count_all($iduser)
    {
        if($iduser=="")
        {
            $this->db->where("iduser",$iduser);
        }
        $this->db->from($this->tab1);
        return $this->db->count_all_results();
    } 


    public function _get_datatables_query_user()
    {
        
        $this->db->select("*,(SELECT email FROM user WHERE iduser=tarik.iduser)as email, date_format(tanggal, '%d-%m-%Y %H:%i') as tanggalf");
        $this->db->from($this->tab1);
        $this->db->order_by("tanggal","desc");
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
    function get_datatables_user()
    {
        $this->_get_datatables_query_user();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_user()
    {
        $this->_get_datatables_query_user();
        $query = $this->db->get();
        return $query->num_rows();
    } 
    public function count_all_user()
    {
        $this->db->from($this->tab1);
        return $this->db->count_all_results();
    } 
}
