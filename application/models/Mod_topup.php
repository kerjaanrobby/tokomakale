<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_topup extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    var $tab1 = 'topup';
    var $col_order = array(null,'tanggal', 'payment','topup','status');
    var $col_search = array('tanggal', 'payment','topup','status');

    public function getIdByTrx($trx_id)
    {
        $result="";
        $this->db->where(array('trx_id'=>$trx_id,'status'=>'Belum Bayar','payment!='=>'BRI'));
		$db = $this->db->get("topup");
		foreach($db->result() as $res){
			$result = $res->idtopup;
        }
        
        if($result!="")
        {
            return $result;
        }else{
            return $result;
        }
    }
    public function listing($where="")
    {

        $this->db->select("idtopup, tanggal, fee, kode, iduser, topup, payment, email, url, trx_id, status, date_format(tanggal, '%d-%m-%Y') as tanggalf");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get($this->tab1);
        return $data->result();
    }
    public function listing_join($where)
    {
        $this->db->select("topup.idtopup, user.nama, topup.tanggal, topup.kode,topup.ket, topup.iduser, topup.topup, topup.payment, topup.email, topup.url, topup.trx_id, topup.status, topup.fee,date_format(topup.tanggal, '%d-%m-%Y') as tanggalf, topup.qrstring, topup.qrimage, topup.linkpayment, topup.channel, topup.channel, topup.paymentname, topup.total, topup.expired, topup.qrtemplate");
        $this->db->from($this->tab1);
        $this->db->join("user", "user.iduser=topup.iduser");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get();
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
        
        $this->db->select("*, (SELECT email FROM user WHERE iduser=topup.iduser) as email, date_format(tanggal, '%d-%m-%Y %H:%i') as tanggalf");
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
    public function getTopupId($nominal)
    {
        $result="";
        $this->db->where(array('topup'=>$nominal,'status'=>'Belum Bayar','payment'=>'BCA'));
		$db = $this->db->get("topup");
		foreach($db->result() as $res){
			$result = $res->idtopup;
        }
        
        if($result!="")
        {
            return $result;
        }else{
            return $result;
        }
    }
    public function getTRX($nominal)
    {
        $result="";
        $this->db->where(array('topup'=>$nominal,'status'=>'Belum Bayar','payment'=>'BCA'));
		$db = $this->db->get("topup");
		foreach($db->result() as $res){
			$result = $res->trx_id;
        }
        
        if($result!="")
        {
            return $result;
        }else{
            return $result;
        }
    }
    public function getUserId($idtopup)
    {
        $result="";
        $this->db->where(array('idtopup'=>$idtopup));
		$db = $this->db->get("topup");
		foreach($db->result() as $res){
			$result = $res->iduser;
        }
        
        if($result!="")
        {
            return $result;
        }else{
            return $result;
        }
    }public function getBallance($iduser)
    {
        $result="";
        $this->db->where(array('iduser'=>$iduser));
		$db = $this->db->get("user");
		foreach($db->result() as $res){
			$result = $res->saldo;
        }
        
        if($result!="")
        {
            return $result;
        }else{
            return $result;
        }
    }
    public function getTopUp($iduser)
    {
        $data = $this->db->query("SELECT * FROM `topup`
        WHERE tanggal > DATE_ADD(NOW(), INTERVAL 7 HOUR) - interval 1 hour AND iduser='".$iduser."' AND status='Belum Bayar'");
        $status = $data->num_rows();
        if($status>0)
        {
            return true;
        }else{
            return false;
        }
    }
}
