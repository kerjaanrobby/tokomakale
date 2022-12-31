<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftarreseller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','download','file'));
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('form_validation');		
		$this->load->model("mod_app");
		$this->load->model("mod_admin");
		$this->load->model("mod_game");
		$this->load->model("mod_conf");
		$this->load->model("mod_daftarreseller");
    }
    public function index()
	{
		$logged = $this->session->userdata("logged_in");
		$rol = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		if (($status!="")&&($logged == "yes")&&($rol=="Superadmin")) {
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

			$data["head"] = $tmplt["header"];
			$data["menu"] = $tmplt["menu"];
			$data["foot"] = $tmplt["foot"];
			// $data["rightmenu"] = $tmplt["rightmenu"];
			$this->load->view("content/daftarreseller", $data);
		} else {
			redirect('keluar');
		}
    }
    
    public function datasimpan()
    {
		$logged = $this->session->userdata("logged_in");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		if(($status!="")&&($logged=="yes"))
		{
			$this->db->trans_start();
			$idsyaratreseller = $this->input->post("id");
			$datains["reseller"]=$this->input->post("reseller");
			$datains["resellervip"]=$this->input->post("resellervip");
	
			if($idsyaratreseller<>""){
				$where['idsyaratreseller']=$idsyaratreseller;
				if($this->mod_conf->UpdateData('syaratreseller',$datains,$where)){
					$output['hasil']=1;
					$output['pesan']='Data berhasil di update';  
				}else{
					$output['hasil']=0;
					$output['pesan']='Data gagal di update';  
				}
			}else{
				if($this->mod_conf->InsertData('syaratreseller', $datains))
				{
					$output['hasil']=1;
					$output['pesan']='Data berhasil di simpan';  
				}else{
					$output['hasil']=0;
					$output['pesan']='Data gagal di simpan';
				};
			}
			$this->db->trans_complete();
			echo json_encode($output);  
		}else{
			redirect('keluar');
		}
    }
    public function datadetail()
	{
		$logged = $this->session->userdata("logged_in");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		if(($status!="")&&($logged=="yes"))
		{
			$id=$this->input->post('id');

			// $wharr = array("idsyaratreseller"=>$id);
			$dtrol=$this->mod_daftarreseller->listing();
		    $X = array('hasildata'=>$dtrol);               
		    echo json_encode($X);  
		}else{
			redirect("keluar");
		}
    }
}