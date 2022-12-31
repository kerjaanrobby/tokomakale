<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_banner extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $tab1 = 'banner';
    var $col_order = array(null,'nama','tglmulaif', 'tglselesaif','alwayson','url','banner');
    var $col_search = array('nama','tglmulaif', 'tglselesaif','alwayson','url','banner');

    public function listing($where="")
    {
        $this->db->select("*,  date_format(tglmulai, '%d-%m-%Y') as tglmulaif, date_format(tglselesai, '%d-%m-%Y') as tglselesaif");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get($this->tab1);
        return $data->result();
    }
    public function _get_datatables_query()
    {
        $this->db->select("*, date_format(tglmulai, '%d-%m-%Y') as tglmulaif, date_format(tglselesai, '%d-%m-%Y') as tglselesaif");
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