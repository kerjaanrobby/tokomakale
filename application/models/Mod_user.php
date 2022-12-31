<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_user extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    var $tab1 = 'user';
    var $col_order = array(null,'email', 'nowa','level','nama','createdate');
    var $col_search = array('email', 'nowa','level','nama','createdate');

    public function listing($where="")
    {

        $this->db->select("iduser, email, nowa, level, nama, createdate, date_format(createdate, '%d-%m-%Y') as createdatef, saldo");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get($this->tab1);
        return $data->result();
    }
    public function getSaldo($iduser)
    {
        $this->db->select("saldo");
        $this->db->where("iduser",$iduser);
        $data = $this->db->get($this->tab1);
        foreach($data->result() as $d)
        {
            $saldos = $d->saldo;
        }

        return $saldos;
    }
    public function getEmail($iduser)
    {
        $emails="";
        $this->db->select("email");
        $this->db->where("email",$iduser);
        $data = $this->db->get($this->tab1);
        foreach($data->result() as $d)
        {
            $emails = $d->email;
        }

        return $emails;
    }
    public function getStatusAktif($iduser)
    {
        $status="";
        $this->db->select("status");
        $this->db->where("email",$iduser);
        $data = $this->db->get($this->tab1);
        foreach($data->result() as $d)
        {
            $status = $d->status;
        }

        return $status;
    }
    public function getLevel($iduser)
    {
        $level="";
        $this->db->select("level");
        $this->db->where("iduser",$iduser);
        $data = $this->db->get($this->tab1);
        foreach($data->result() as $d)
        {
            $level = $d->level;
        }

        return $level;
    }
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
    public function getNominal($trx_id)
    {
        $result="";
        $this->db->where(array('trx_id'=>$trx_id,'status'=>'Belum Bayar','payment!='=>'BRI'));
		$db = $this->db->get("topup");
		foreach($db->result() as $res){
			$result = $res->topup;
        }
        
        if($result!="")
        {
            return $result;
        }else{
            return $result;
        }
    }public function getFee($trx_id)
    {
        $result="";
        $this->db->where(array('trx_id'=>$trx_id,'status'=>'Belum Bayar','payment!='=>'BRI'));
		$db = $this->db->get("topup");
		foreach($db->result() as $res){
			$result = $res->fee;
        }
        
        if($result!="")
        {
            return $result;
        }else{
            return $result;
        }
    }
    public function getUser($trx_id)
    {
        $result="";
        $this->db->where(array('trx_id'=>$trx_id,'status'=>'Belum Bayar','payment!='=>'BRI'));
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
    }
    public function getBalance($iduser)
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
    public function _get_datatables_query()
    {
        $this->db->select("*, date_format(createdate, '%d-%m-%Y') as createdatef");
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
}
