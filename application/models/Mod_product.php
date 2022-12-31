<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_product extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $tab1 = 'productgame';
    var $tab2 = 'game';
    var $col_order = array(null,'nama','harga_dasar', 'harga_jual','harga_reseller','harga_vvip','status');
    var $col_search = array('nama','harga_dasar', 'harga_jual','harga_reseller','harga_vvip','status');

    // MENAMPILKAN DATA TABLE JURSAN
    public function listing($where="")
    {
        $this->db->select("*");
        if($where!=""){
            $this->db->where($where);
        }
        $this->db->order_by("nourut","ASC");
        $data = $this->db->get($this->tab1);
        return $data->result();
    }
    public function getName($idproduct)
    {
        $jenis="";
        $this->db->where("idproduct",$idproduct);
        $query = $this->db->get('productgame');
		foreach($query->result() as $row)
        {
            $nama = $row->nama;
        }
        return $nama;
    }
    public function getGame($idproduct)
    {
        $this->db->select("idgame");
        $this->db->where(array("idproduct"=>$idproduct));
        $data = $this->db->get($this->tab1);
        foreach($data->result() as $data)
        {
            $idgame =$data->idgame;
            $this->db->select("idgame, nama, kategori, kategori_harga, icon, gambar, jenis");
            $this->db->where(array("idgame"=>$idgame));
            $datagame = $this->db->get($this->tab2);
            foreach($datagame->result() as $dg)
            {
                $nama_game = $dg->nama;
            }
        }
        return $nama_game;
    }
    // DATATABLE
    // FUNC QUERY DATA TABLE JURSAN
    public function _get_datatables_query($where)
    {
        if($where!=""){
            $this->db->where(array("idgame"=>$where));
        }
        $this->db->order_by("nourut","ASC");
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
            $this->db->where(array("idgame"=>$where));
        }
        $this->db->from($this->tab1);
        return $this->db->count_all_results();
    }
    
    
    public function getModal($idproduk)
    {
        $data = $this->db->query("SELECT harga_dasar FROM productgame WHERE idproduct='$idproduk'");
        foreach($data->result() as $d)
        {
            $result = $d->harga_dasar;
        }
        return $result;
    }
    public function getJual($idproduk)
    {
        $data = $this->db->query("SELECT harga_jual FROM productgame WHERE idproduct='$idproduk'");
        foreach($data->result() as $d)
        {
            $result = $d->harga_jual;
        }
        return $result;
    }

}