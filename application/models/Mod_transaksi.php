<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_transaksi extends CI_Model{

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
    public function listing_voucher($where)
    {
        $this->db->select("transaksi.iduser,
                            transaksi.jumlah, 
                            transaksi.idproduk, 
                            transaksi.idtransaksi, 
                            transaksi.kode, 
                            transaksi.jenis, 
                            transaksi.kategori, 
                            admin.username as namaadmin, 
                            transaksi.email,
                            transaksi.trx_id,
                            transaksi.tanggal, 
                            transaksi.harga,
                            transaksi.payment, 
                            date_format(transaksi.tanggal,'%d-%m-%Y %H:%i') as tanggalf, 
                            game.nama as gamename, 
                            voucher.nama as vouchername, 
                            voucher.harga_jual as voucherharga, 
                            voucher.harga_reseller as voucherharga_reseller, 
                            transaksi.akun, 
                            transaksi.zone, 
                            transaksi.server, 
                            transaksi.status, 
                            transaksi.fee, 
                            transaksi.ket");
        $this->db->from("transaksi");
        $this->db->join("game", "game.idgame=transaksi.idgame");
        $this->db->join("voucher", "voucher.idvoucher=transaksi.idproduk");
        $this->db->join("admin", "admin.idadmin=transaksi.idadmin","left");
        if($where!=""){
            $this->db->where($where);
        }
        $data = $this->db->get();
        return $data->result();
    }
    public function listing_join($where)
    {
        $this->db->select("transaksi.iduser, transaksi.payment, transaksi.kategori, transaksi.jumlah, transaksi.idproduk, transaksi.idtransaksi, transaksi.kode, admin.username as namaadmin, transaksi.email,transaksi.trx_id,transaksi.tanggal, transaksi.harga,transaksi.payment, date_format(transaksi.tanggal,'%d-%m-%Y %H:%i') as tanggalf, game.nama as gamename, productgame.nama as productname, transaksi.akun, transaksi.zone, transaksi.server, transaksi.status, transaksi.fee, transaksi.ket, transaksi.kurir, transaksi.resi, transaksi.jenis, transaksi.linkpayment");
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
    public function _get_datatables_query()
    {
        
        $this->db->select("transaksi.iduser, transaksi.kategori, game.kategori as katgame, transaksi.idtransaksi, transaksi.jenis, user.nama as namauser, transaksi.payment, transaksi.harga, transaksi.tanggal, transaksi.trx_id, date_format(transaksi.tanggal,'%d-%m-%Y %H:%i') as tanggalf,
         game.nama as gamename, productgame.nama as productname, transaksi.akun, transaksi.zone, transaksi.server, transaksi.status");
        $this->db->where("'Selesai' != transaksi.status");
        $this->db->where(array("transaksi.kategori"=>"Top Up"));
        $this->db->from($this->tab1);
        $this->db->join($this->tab2, "$this->param1=$this->param2");
        $this->db->join($this->tab3, "$this->param3=$this->param4");
        $this->db->join("user", "user.iduser=transaksi.iduser","left");
        $this->db->order_by('transaksi.status', 'DESC');
        $this->db->order_by('transaksi.idtransaksi', 'ASC');

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
       
        $this->db->select("transaksi.idtransaksi,transaksi.tanggal, date_format(transaksi.tanggal,'%d-%m-%Y %H:%i') as tanggalf, game.nama as gamename, productgame.nama as productname, transaksi.akun, transaksi.zone, transaksi.server, transaksi.status");
        $this->db->where("'Selesai' != transaksi.status");
        $this->db->where(array("transaksi.kategori"=>"Top Up"));
        $this->db->from($this->tab1);
        $this->db->join($this->tab2, "$this->param1=$this->param2");
        $this->db->join($this->tab3, "$this->param3=$this->param4");
        return $this->db->count_all_results();
    }

    public function _get_datatables_query_voucher()
    {
        $this->db->select("transaksi.iduser,
                            transaksi.kategori,
                            transaksi.idtransaksi,
                            transaksi.jenis,
                            user.nama as namauser,
                            transaksi.payment,
                            transaksi.harga,
                            transaksi.tanggal,
                            transaksi.trx_id,
                            date_format(transaksi.tanggal,'%d-%m-%Y %H:%i') as tanggalf,
                            game.nama as gamename,
                            voucher.nama as productname,
                            transaksi.akun,
                            transaksi.zone,
                            transaksi.server,
                            transaksi.status");
        $this->db->where("'Selesai' != transaksi.status");
        $this->db->where(array("transaksi.kategori"=>"Voucher"));
        $this->db->from($this->tab1);
        $this->db->join($this->tab2, "$this->param1=$this->param2");
        $this->db->join("voucher", "voucher.idvoucher=$this->param4");
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
    function get_datatables_voucher()
    {
        $this->_get_datatables_query_voucher();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_voucher()
    {
        $this->_get_datatables_query_voucher();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_voucher()
    {
       
        $this->db->select("transaksi.iduser,
                            transaksi.kategori,
                            transaksi.idtransaksi,
                            transaksi.jenis,
                            user.nama as namauser,
                            transaksi.payment,
                            transaksi.harga,
                            transaksi.tanggal,
                            transaksi.trx_id,
                            date_format(transaksi.tanggal,'%d-%m-%Y %H:%i') as tanggalf,
                            game.nama as gamename,
                            voucher.nama as productname,
                            transaksi.akun,
                            transaksi.zone,
                            transaksi.server,
                            transaksi.status");
        $this->db->where("'Selesai' != transaksi.status");
        $this->db->where(array("transaksi.kategori"=>"Voucher"));
        $this->db->from($this->tab1);
        $this->db->join($this->tab2, "$this->param1=$this->param2");
        $this->db->join("voucher", "voucher.idvoucher=$this->param4");
        $this->db->join("user", "user.iduser=transaksi.iduser","left");
        return $this->db->count_all_results();
    }


    public function getKodeStatus($uniqkode)
    {
        $result="";
        $this->db->where(array('kode'=>$uniqkode,'status'=>"0"));
		$db = $this->db->get("kodeunik");
		foreach($db->result() as $res){
			$result = $res->kode;
        }
        if($result=="")
        {
            return false;
        }else{
            return true;
        }
		
    }
    public function getNominalTrans($nominal)
    {
        $result="";
        $this->db->where(array('harga'=>$nominal,'status'=>'Belum Bayar'));
		$db = $this->db->get("transaksi");
		foreach($db->result() as $res){
			$result = $res->idtransaksi;
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
        $this->db->where(array('harga'=>$nominal,'status'=>'Belum Bayar'));
		$db = $this->db->get("transaksi");
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
    public function getIdByTrx($trx_id)
    {
        $result="";
        $this->db->where(array('trx_id'=>$trx_id,'status'=>'Belum Bayar','payment!='=>'BRI'));
		$db = $this->db->get("transaksi");
		foreach($db->result() as $res){
			$result = $res->idtransaksi;
        }
        
        if($result!="")
        {
            return $result;
        }else{
            return $result;
        }
    }
    public function getIdProduk($idtransaksi)
    {
        $result="";
        $this->db->where(array('idtransaksi'=>$idtransaksi));
		$db = $this->db->get("transaksi");
		foreach($db->result() as $res){
			$result = $res->idproduk;
        }
        
        if($result!="")
        {
            return $result;
        }else{
            return $result;
        }
    }
    public function getJenis($idtransaksi)
    {
        $result="";
        $this->db->where(array('idtransaksi'=>$idtransaksi));
		$db = $this->db->get("transaksi");
		foreach($db->result() as $res){
			$result = $res->jenis;
        }
        
        if($result!="")
        {
            return $result;
        }else{
            return $result;
        }
    }
    public function getKategori($idtransaksi)
    {
        $result="";
        $this->db->where(array('idtransaksi'=>$idtransaksi));
		$db = $this->db->get("transaksi");
		foreach($db->result() as $res){
			$result = $res->kategori;
        }
        
        if($result!="")
        {
            return $result;
        }else{
            return $result;
        }
    }
    public function getKode($idtransaksi)
    {
        $result="";
        $this->db->where(array('idtransaksi'=>$idtransaksi));
		$db = $this->db->get("transaksi");
		foreach($db->result() as $res){
			$result = $res->kode;
        }
        
        if($result!="")
        {
            return $result;
        }else{
            return $result;
        }
    }
    public function getIdTrans($kode)
    {
        $result="";
        $this->db->where(array('kode'=>$kode));
		$db = $this->db->get("transaksi");
		foreach($db->result() as $res){
			$result = $res->idtransaksi;
        }
        
        if($result!="")
        {
            return $result;
        }else{
            return $result;
        }
    }
    public function getVia($idtransaksi)
    {
        $result="";
        $this->db->where(array('idtransaksi'=>$idtransaksi));
		$db = $this->db->get("transaksi");
		foreach($db->result() as $res){
			$result = $res->payment;
        }
        
        if($result!="")
        {
            return $result;
        }else{
            return $result;
        }
    }
    public function getJenisKodeUnik($idtransaksi,$kode)
    {
        $result="";
        $this->db->where(array('idtransaksi'=>$idtransaksi,'kode'=>$kode,'status'=>'0'));
		$db = $this->db->get("kodeunik");
		foreach($db->result() as $res){
			$result = $res->transaksi;
        }
        
        if($result!="")
        {
            return $result;
        }else{
            return $result;
        }
    }

}