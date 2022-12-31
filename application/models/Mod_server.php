<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_server extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $tab1 = 'servergame';
    var $tab2 = 'game';
    var $param1 = 'game.idgame';
    var $param2 = 'servergame.idgame';
    var $col_order = array(null,'nama','namagame');
    var $col_search = array('nama','namagame');

    public function listing($where="")
    {

        $this->db->select("id, nama, idgame, idform");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get($this->tab1);
        return $data->result();
    }

    public function listing_join($where="")
    {

        $this->db->select("id, servergame.nama as namaserver, servergame.idgame, servergame.idform, game.nama as namagame");
        if($where!=""){
            $this->db->where($where);
        }
        $this->db->from($this->tab1);
        $this->db->join($this->tab2,"$this->param1=$this->param2");
        $data = $this->db->get($this->tab1);
        return $data->result();
    }

    public function _get_datatables_query()
    {
        $this->db->select("id, servergame.nama as namaserver, servergame.idgame, servergame.idform, game.nama as namagame");
        $this->db->from($this->tab1);
        $this->db->join($this->tab2,"$this->param1=$this->param2");
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
        $this->db->join($this->tab2,"$this->param1=$this->param2");
        return $this->db->count_all_results();
    } 

}