<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_history extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $tab1 = 'transaksi';
    var $tab2 = 'game';
    var $tab3 = 'productgame';
    var $param1 = 'game.idgame';
    var $param2 = 'transaksi.idgame';
    var $param3 = 'productgame.idproduct';
    var $param4 = 'transaksi.idproduk';
    var $col_order = array(null,'transaksi.tanggal','game.nama','productgame.nama', 'akun','zone','server','transaksi.payment','transaksi.jenis','transaksi.harga','user.nama','transaksi.status');
    var $col_search = array('transaksi.tanggal','game.nama','productgame.nama', 'akun','zone','server','transaksi.payment','transaksi.jenis','transaksi.harga','user.nama','transaksi.status');

    public function listing($where="")
    {
        $this->db->select("*");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get($this->tab1);
        return $data->result();
    }
    public function listing_join($where)
    {
        $this->db->select("transaksi.idtransaksi, transaksi.kode, admin.username as namaadmin, transaksi.email,transaksi.trx_id,transaksi.tanggal, transaksi.harga,transaksi.payment, date_format(transaksi.tanggal,'%d-%m-%Y %H:%i') as tanggalf, game.nama as gamename, productgame.nama as productname, transaksi.akun, transaksi.zone, transaksi.server, transaksi.status");
        $this->db->from($this->tab1);
        $this->db->join($this->tab2, "$this->param1=$this->param2");
        $this->db->join($this->tab3, "$this->param3=$this->param4");
        $this->db->join("admin", "admin.idadmin=transaksi.idadmin","left");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get();
        return $data->result();
    }
    public function _get_datatables_query($iduser)
    {
        
        $this->db->select("transaksi.kode,transaksi.idtransaksi, transaksi.jenis, user.nama as namauser, transaksi.payment, transaksi.harga, transaksi.tanggal, transaksi.trx_id, date_format(transaksi.tanggal,'%d-%m-%Y %H:%i') as tanggalf,
         game.nama as gamename, productgame.nama as productname, transaksi.akun, transaksi.zone, transaksi.server, transaksi.status");
        $this->db->where("transaksi.iduser",$iduser);
        $this->db->from($this->tab1);
        $this->db->join($this->tab2, "$this->param1=$this->param2");
        $this->db->join($this->tab3, "$this->param3=$this->param4");
        $this->db->join("user", "user.iduser=transaksi.iduser","left");

        // $this->db->order_by('idtransaksi', 'DESC');
       
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
       
        $this->db->select("transaksi.idtransaksi,transaksi.tanggal, date_format(transaksi.tanggal,'%d-%m-%Y %H:%i') as tanggalf, game.nama as gamename, productgame.nama as productname, transaksi.akun, transaksi.zone, transaksi.server, transaksi.status");
        $this->db->where("transaksi.iduser",$iduser);
        $this->db->from($this->tab1);
        $this->db->join($this->tab2, "$this->param1=$this->param2");
        $this->db->join($this->tab3, "$this->param3=$this->param4");
        return $this->db->count_all_results();
    }

}