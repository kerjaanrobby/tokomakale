<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','download','file'));
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('form_validation');		
		$this->load->model("mod_app");
		$this->load->model("mod_admin");
		$this->load->model("mod_conf");
		$this->load->model("mod_user");
		$this->load->model("mod_topup");
		$this->load->model("mod_tarik");
    }
    public function index()
    {
        $logged = $this->session->userdata("logged_in");
		$rol = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		if (($status!="")&&($logged == "yes")&&(($rol=="Superadmin")||($rol=="Admin Web"))) {
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
			if($rol=="Admin Web"){
                $tmplt["menu"] = $this->load->view("template/menuadmin", $dtapp, TRUE);
            }else{
                $tmplt["menu"] = $this->load->view("template/menu", $dtapp, TRUE);
            }
			$tmplt["foot"] = $this->load->view("template/foot", $dtapp, TRUE);
			// $tmplt["rightmenu"] = $this->load->view("template/right", $dtapp, TRUE);

			$data["head"] = $tmplt["header"];
			$data["menu"] = $tmplt["menu"];
			$data["foot"] = $tmplt["foot"];
			// $data["rightmenu"] = $tmplt["rightmenu"];
			$this->load->view("content/withdraw", $data);
		} else {
			redirect('keluar');
		}
    }
    public function updatetarik()
    {
        $ditarik = $this->input->post("id");

        $dtuser = $this->mod_tarik->listing(array("idtarik"=>$ditarik));
        foreach($dtuser as $du){
            $iduser = $du->iduser;
            $nominal = $du->nominal;
        }
        $saldo = $this->mod_user->getSaldo($iduser);
        $saldoupdate=$saldo-$nominal;

        $namastr = "BB_";
        $unikimg= date('Ymdhis');
        if($_FILES['file']['size'] != 0 ){
            $config['upload_path'] = './assets/image/transfer';
            $config['allowed_types'] = 'jpg|png|jpeg|pdf|JPG|PNG|JPEG|PDF';
            $config['file_name'] = "file_".$namastr."_".$unikimg;
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('file')){
                $hasil="success";
                echo json_encode($hasil);
            } else {
                $data = array('upload_data' => $this->upload->data());
                $eks = explode('.', $_FILES['file']['name']);
                $eks = $eks[count($eks)-1];
                $datains["file"]="file_".$namastr."_".$unikimg.".".$eks;
            }
        }  
        $whereup["iduser"]=$iduser;
        $datauser["saldo"]=$saldoupdate;
        $this->mod_conf->UpdateData('user',$datauser,$whereup);

        $datains["status"]="Sudah Bayar";
        if($ditarik<>""){
            $where['idtarik']=$ditarik;
            if($this->mod_conf->UpdateData('tarik',$datains,$where)){
                $output['hasil']=1;
                $output['pesan']='Data berhasil di update';  
            }else{
                $output['hasil']=0;
                $output['pesan']='Data gagal di update';  
            }
        }
        $this->db->trans_complete();
        echo json_encode($output);  
    }
}