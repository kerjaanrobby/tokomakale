<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','download','file'));
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('form_validation');		
		$this->load->model("mod_app");
		$this->load->model("mod_admin");
		$this->load->model("mod_banner");
		$this->load->model("mod_conf");
		$this->load->model("mod_dashboard");
    }
    public function index()
	{
		$idakun = $this->session->userdata("id");
		$status = $this->mod_admin->getAkun($idakun);
		$logged = $this->session->userdata("logged_in");
		if($status!="")
		{
			if ($logged == "yes") {
				$idakun = $this->session->userdata("id");
	
				$nameapp = $this->mod_app->getNamaApps();
				$instansi = $this->mod_app->getInstansi();
				$logo = $this->mod_app->getLogo();
				$favicon = $this->mod_app->getFavicon();
	
				$dtakun = $this->mod_admin->listing(array("idadmin"=>$idakun));
	
				$dtapp["nameapp"] = $nameapp;
				$dtapp["instansi"] = $instansi;
				$dtapp["logo"] = $logo;
				$dtapp["favicon"] = $favicon;
				$dtapp["akun"] = $dtakun;
	
	
				$tmplt["header"] = $this->load->view("template/head", $dtapp, TRUE);
				$tmplt["menu"] = $this->load->view("template/menu", $dtapp, TRUE);
				$tmplt["foot"] = $this->load->view("template/foot", $dtapp, TRUE);
				// $tmplt["rightmenu"] = $this->load->view("template/right", $dtapp, TRUE);
	
				$data["head"] = $tmplt["header"];
				$data["menu"] = $tmplt["menu"];
				$data["foot"] = $tmplt["foot"];
				// $data["rightmenu"] = $tmplt["rightmenu"];
				$this->load->view("content/dashboard", $data);
			} else {
				redirect('keluar');
			}
		}else{
			redirect('keluar');
		}
		
	}
	
	public function dashboard_data()
	{
		$idakun = $this->session->userdata("id");
		$status = $this->mod_admin->getAkun($idakun);
		$logged = $this->session->userdata("logged_in");
		if($status!="")
		{
			$start = $this->input->post("start");
			$end = $this->input->post("end");
			$startformat = substr($start, 6,4)."-".substr($start, 3,2)."-".substr($start, 0,2);
			$endformat = substr($end, 6,4)."-".substr($end, 3,2)."-".substr($end, 0,2);

			$uangmasuk = $this->mod_dashboard->getUangMasuk($startformat,$endformat );
			$modal = $this->mod_dashboard->getModal($startformat,$endformat );
			$untung = $this->mod_dashboard->getUntung($startformat,$endformat );
			$publik = $this->mod_dashboard->getPublik($startformat,$endformat );
			$reseller = $this->mod_dashboard->getReseller($startformat,$endformat );

			$transaksilist = $this->mod_dashboard->getTransaksiList($startformat,$endformat);
			$transaksipayment = $this->mod_dashboard->getTransPayment($startformat,$endformat);
			$X = array('uangmasuk'=>$uangmasuk,
						'modal'=>$modal,
						'untung'=>$untung,
						'transaksilist'=>$transaksilist,
						'paymentlist'=>$transaksipayment,
						'publik'=>$publik,
						'reseller'=>$reseller);               
			echo json_encode($X);  
		}else{
			redirect('keluar');
		}
	}
}