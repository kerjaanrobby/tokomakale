<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Point extends CI_Controller {

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
		$this->load->model("mod_point");
    }
    public function index()
	{
		$logged = $this->session->userdata("logged_in");
        $rol = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
        if($status!="")
		{
            if (($logged == "yes")&&($rol=="Superadmin")) {
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
                $this->load->view("content/point", $data);
            } else {
                redirect('keluar');
            }
        }else{
            redirect('keluar');
        }
		
    }
    public function datadetail()
	{
		$logged = $this->session->userdata("logged_in");
		if($logged=="yes")
		{
			$wharr = array("idapp"=>"13","item"=>"point");
			$dt=$this->mod_app->listing($wharr);
		    $X = array('hasildata'=>$dt);               
		    echo json_encode($X);  
		}else{
			redirect("keluar");
		}
    }
    public function datasimpan()
    {
        $logged = $this->session->userdata("logged_in");
		if($logged=="yes")
		{
			$where["idapp"]=$this->input->post("id");
            $datains["val"]=$this->input->post("point");
            if($this->mod_conf->UpdateData('app',$datains,$where))
            {
				$output['hasil']=1;
				$output['pesan']='Data berhasil di simpan';  
			}else{
				$output['hasil']=0;
				$output['pesan']='Data gagal di simpan';
            };
            echo json_encode($output);  
		}else{
			redirect("keluar");
		}
    }

    public function datapointuser()
    {
        $iduser = $this->input->post("iduser");
        $wharr = array("iduser"=>$iduser);
		$dt=$this->mod_point->listing($wharr);
		$X = array('hasildata'=>$dt);               
		echo json_encode($X);  
    }
}