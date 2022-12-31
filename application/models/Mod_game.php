<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_game extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $tab1 = 'game';
    var $col_order = array(null,'nama','icon', 'gambar','desk');
    var $col_search = array('nama','icon', 'gambar','desk');

    // MENAMPILKAN DATA TABLE JURSAN
    public function listingorder($where="")
    {
        $this->db->select("*");
        if($where!=""){
            $this->db->where($where);
        }
        $this->db->order_by("urut","ASC");
        $this->db->limit("12");
        $data = $this->db->get($this->tab1);
        return $data->result();
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
    public function listingauto($where="")
    {
        $this->db->select("idgame, nama");
        // if($where!=""){
        //     $this->db->where($where);
        // }
        $this->db->like('nama',$where);
        $data = $this->db->get($this->tab1);
        return $data->result();
    }
    public function getJenis($idgame)
    {
        $jenis="";
        $this->db->where("idgame",$idgame);
        $query = $this->db->get('game');
		foreach($query->result() as $row)
        {
            $jenis = $row->jenis;
        }
        return $jenis;
    }
    public function getName($idgame)
    {
        $jenis="";
        $this->db->where("idgame",$idgame);
        $query = $this->db->get('game');
		foreach($query->result() as $row)
        {
            $nama = $row->nama;
        }
        return $nama;
    }
    public function fetch_data($query)
    {
        $this->db->like('nama', $query);
        $this->db->where('status', "Aktif");
		$query = $this->db->get('game');
		if($query->num_rows() > 0)
		{
            foreach($query->result_array() as $row)
            {
                $output[] = array(
                'nama'  => $row["nama"],
                'icon'  => $row["icon"],
                'idgame'  => $row["idgame"]
                );
            }
            echo json_encode($output);
		}
    }
    public function GetStatus($idgame)
    {
        $status="";
        $this->db->select("status");
        $this->db->where("idgame",$idgame);
        $data = $this->db->get($this->tab1);
        foreach($data->result() as $d)
        {
            $status = $d->status;
        }

        return $status;
    }
    // DATATABLE
    // FUNC QUERY DATA TABLE JURSAN
    public function _get_datatables_query()
    {
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
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    // DATATABLE
    // FILTER TABLE JURSAN
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    // DATATABLE
    // MENGHITUNG JUMLAH ROW TABLE JURSAN  
    public function count_all()
    {
        $this->db->from($this->tab1);
        return $this->db->count_all_results();
    } 

}