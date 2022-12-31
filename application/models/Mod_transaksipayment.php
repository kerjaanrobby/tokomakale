<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_transaksipayment extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $tab1 = 'transaksi_status';
    var $col_order = array(null,'tanggalf','status');
    var $col_search = array('tanggalf','status');

    public function listing($where="")
    {
        $this->db->select("*");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get($this->tab1);
        return $data->result();
    }
    public function _get_datatables_query($trx_id )
    {
        
        $this->db->where("idtransaksi",$trx_id);
        $this->db->select("transaksi_statusid, date_format(tanggal,'%d-%m-%Y %h:%i') as tanggalf, trx_id, sid, status");
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
    function get_datatables($trx_id)
    {
        $this->_get_datatables_query($trx_id);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered($trx_id)
    {
        $this->_get_datatables_query($trx_id);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all($trx_id)
    {

        $this->db->where("idtransaksi",$trx_id);
        $this->db->select("transaksi_statusid, date_format(tanggal,'%d-%m-%Y %h:%i') as tanggalf, trx_id, sid, status");
        $this->db->from($this->tab1);
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->count_all_results();
    } 

}