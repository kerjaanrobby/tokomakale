<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mod_app extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    // MENAMPILKAN DATA TABLE APP
    public function listing($where = '')
    {
        $this->db->select("idapp, item, val ");
        $this->db->where($where);
        $data = $this->db->get("app");
        return $data->result();
    }
    // GET NAMA APPS
    function getNamaApps(){
		$this->db->where("item","nama_app");
		$db = $this->db->get("app");
		foreach($db->result() as $res){
			$result = $res->val;
		}
		return $result;
	}
    // GET INSTANSI
    function getInstansi(){
		$this->db->where("item","instansi");
		$db = $this->db->get("app");
		foreach($db->result() as $res){
			$result = $res->val;
		}
		return $result;
	}
    // GET LOGO
    function getLogo(){
		$this->db->where("item","logo_app");
		$db = $this->db->get("app");
		foreach($db->result() as $res){
			$result = $res->val;
		}
		return $result;
	}
    // GET FAVICON
    function getFavicon(){
		$this->db->where("item","fav_app");
		$db = $this->db->get("app");
		foreach($db->result() as $res){
			$result = $res->val;
		}
		return $result;
	}
	// GET VA IPAYMU
	function getVAIPAYMU(){
		$this->db->where("item","ipaymuva");
		$db = $this->db->get("app");
		foreach($db->result() as $res){
			$result = $res->val;
		}
		return $result;
	}
    // GET API IPAYMU
    function getAPIIPAYMU(){
		$this->db->where("item","ipaymu");
		$db = $this->db->get("app");
		foreach($db->result() as $res){
			$result = $res->val;
		}
		return $result;
	}
	// GET URL QRIS IPAYMU
	function getURLQRISIPAYMU()
	{
		$this->db->where("item","ipaymuurlqris");
		$db = $this->db->get("app");
		foreach($db->result() as $res){
			$result = $res->val;
		}
		return $result;
	}
	// GET URL Transfer Ipaymu
	function getURLTransferIpaymu()
	{
		$this->db->where("item","ipaymuurltransfer");
		$db = $this->db->get("app");
		foreach($db->result() as $res){
			$result = $res->val;
		}
		return $result;
	}
	// GET URL BCA IPAYMU
	function getURLBCAIPAYMU()
	{
		$this->db->where("item","ipaymuurlbca");
		$db = $this->db->get("app");
		foreach($db->result() as $res){
			$result = $res->val;
		}
		return $result;
	}
	// GET URL CSTORE IPAYMU
	function getURLCSTOREIPAYMU()
	{
		$this->db->where("item","ipaymuurlcstore");
		$db = $this->db->get("app");
		foreach($db->result() as $res){
			$result = $res->val;
		}
		return $result;
	}
	// GET URL NOTIFYURL_QRIS
	function getURLNotifyUrlQris()
	{
		$this->db->where("item","notifyurl_qris");
		$db = $this->db->get("app");
		foreach($db->result() as $res){
			$result = $res->val;
		}
		return $result;
	}

	// GET Email
	function getEmail()
	{
		$this->db->where("item","email");
		$db = $this->db->get("app");
		foreach($db->result() as $res){
			$result = $res->val;
		}
		return $result;
	}
	// GET Password
	function getPassword()
	{
		$this->db->where("item","email_password");
		$db = $this->db->get("app");
		foreach($db->result() as $res){
			$result = $res->val;
		}
		return $result;
	}
	// GET SMTP
	function getSMTPSERVER()
	{
		$this->db->where("item","email_server");
		$db = $this->db->get("app");
		foreach($db->result() as $res){
			$result = $res->val;
		}
		return $result;
	}
	// GET PORT
	function getSMTPPORT()
	{
		$this->db->where("item","email_port");
		$db = $this->db->get("app");
		foreach($db->result() as $res){
			$result = $res->val;
		}
		return $result;
	}
	// FUNCTION AUTHENTICATION
    public function getLogin($e,$p)
	{
		$email = $e;
		$pass = md5($p);

		$this->db->where('email', $email);
		$this->db->where('password', $pass);
		$query = $this->db->get('admin');

		if($query->num_rows()>0)
		{
			$query2 = $this->db->query("SELECT idadmin, username, email, password, level FROM admin
                                        WHERE email='".$email."' AND password='".$pass."' ");
			foreach ($query2->result() as $data) {
				$sess_data['id'] = $data->idadmin;
				$sess_data['rol'] = $data->level;
				$sess_data['logged_in'] = "yes";
				$this->session->set_userdata($sess_data);
				return true;
			}
		}else{
			return false;
		}
	}
	public function getLoginUser($e,$p){
		$query = $this->db->query("SELECT iduser , email, nowa, level, nama,password FROM user WHERE email='".$e."'  ");
		foreach($query->result() as $data)
		{
			$pass = $data->password;
			$passwordenc =  $this->encryption->decrypt($pass);
			if($passwordenc==$p)
			{
				$sess_data['id'] = $data->iduser;
				$sess_data['rol'] = $data->level;
				$sess_data['logged_in'] = "yes";
				$this->session->set_userdata($sess_data);
				return true;
			}else{
				return false;
			}
		}
	}
	public function getLoginAdmin($e,$p){
		$query = $this->db->query("SELECT idadmin , email, level, username,password FROM admin WHERE email='".$e."'  ");
		foreach($query->result() as $data)
		{
			$pass = $data->password;
			$passwordenc =  $this->encryption->decrypt($pass);
			if($passwordenc==$p)
			{
				$sess_data['id'] = $data->idadmin;
				$sess_data['rol'] = $data->level;
				$sess_data['logged_in'] = "yes";
				$this->session->set_userdata($sess_data);
				return true;
			}else{
				return false;
			}
		}
	}
	public function getEmailAdmin($iduser)
    {
        $emails="";
        $this->db->select("email");
        $this->db->where("email",$iduser);
        $data = $this->db->get("admin");
        foreach($data->result() as $d)
        {
            $emails = $d->email;
        }

        return $emails;
    }
}