<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_transaksireward extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $tab1 = 'transaksireward';
    var $col_order = array(null,'nilai','idreward', 'nilai','iduser','tanggal');
    var $col_search = array('nilai','idreward', 'nilai','iduser','tanggal');

    public function listing($where="")
    {
        $this->db->select("*, (SELECT nama FROM user WHERE user.iduser=transaksireward.iduser) as namauser, (SELECT nama FROM rewardpoint WHERE rewardpoint.idrewardpoint=transaksireward.idreward) as namaitem");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get($this->tab1);
        return $data->result();
    }
    public function _get_datatables_query()
    {
        $this->db->select("*, date_format(tanggal, '%d/%m/%Y %H:%i') as tanggalformat, (SELECT nama FROM user WHERE user.iduser=transaksireward.iduser) as namauser, (SELECT nama FROM rewardpoint WHERE rewardpoint.idrewardpoint=transaksireward.idreward) as namaitem");
        $this->db->from($this->tab1);
        $this->db->order_by('tanggal', 'DESC');
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
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    } 
    public function count_all()
    {
        $this->db->from($this->tab1);
        return $this->db->count_all_results();
    }

    public function _get_datatables_query_user($iduser)
    {
        $this->db->select("*, date_format(tanggal, '%d/%m/%Y %H:%i') as tanggalformat, (SELECT nama FROM user WHERE user.iduser=transaksireward.iduser) as namauser, (SELECT nama FROM rewardpoint WHERE rewardpoint.idrewardpoint=transaksireward.idreward) as namaitem");
        $this->db->from($this->tab1);
        $this->db->where("iduser",$iduser);
        $this->db->order_by('tanggal', 'DESC');
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
    function get_datatables_user($iduser)
    {
        $this->_get_datatables_query_user($iduser);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_user($iduser)
    {
        $this->_get_datatables_query_user($iduser);
        $query = $this->db->get();
        return $query->num_rows();
    } 
    public function count_all_user($iduser)
    {
        $this->db->from($this->tab1);
        $this->db->where("iduser",$iduser);
        return $this->db->count_all_results();
    }


}