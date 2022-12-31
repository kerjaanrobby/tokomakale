<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
    }
    public function index()
	{
		$logged = $this->session->userdata("logged_in");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		$rol = $this->session->userdata("rol");
		if (($status!="")&&($logged == "yes")&&($rol=="Superadmin")) 
		{
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
			$this->load->view("content/admin", $data);
		} else {
			redirect('keluar');
		}
    }
    public function datalist()
    {
        $logged = $this->session->userdata("logged_in");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		$rol = $this->session->userdata("rol");
		if (($status!="")&&($logged == "yes")&&($rol=="Superadmin")) 
		{
			$list = $this->mod_admin->get_datatables();
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->username;
		      	$row[] = $l->email;
		      	$row[] = $l->level;
				$row[] = "<button class='btn btn-warning btn-sm' onclick='editData(".$l->idadmin.")'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm' onclick='hapusData(".$l->idadmin.")'><i class='fa fa-trash'></i> Hapus</button>";
		      	$data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_admin->count_all(),
		     "recordsFiltered" => $this->mod_admin->count_filtered(),
		     "data" => $data,
		    );
		    echo json_encode($output);
		}else{
			redirect('keluar');
		}
    }
    public function datasimpan()
    {
		$logged = $this->session->userdata("logged_in");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		$rol = $this->session->userdata("rol");
		if (($status!="")&&($logged == "yes")&&($rol=="Superadmin")) 
		{
			$this->db->trans_start();
			$idadmin = $this->input->post("id");
			$datains["username"]=$this->input->post("username");
			$datains["email"]=$this->input->post("email");
			$datains["level"]=$this->input->post("level");

			if(!empty($this->input->post("password")))
			{

				$password = $this->input->post("password");
				$passwordenc =  $this->encryption->encrypt($password);
				$datains["password"]=$passwordenc;
			}
				
			if($idadmin<>""){
				$where['idadmin']=$idadmin;
				if($this->mod_conf->UpdateData('admin',$datains,$where)){
					$output['hasil']=1;
					$output['pesan']='Data berhasil di update';  
				}else{
					$output['hasil']=0;
					$output['pesan']='Data gagal di update';  
				}
			}else{
				if($this->mod_conf->InsertData('admin', $datains))
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
		if($logged=="yes")
		{
			$id=$this->input->post('id');

			$wharr = array("idadmin"=>$id);
			$dtrol=$this->mod_admin->listing($wharr);
		    $X = array('hasildata'=>$dtrol);               
		    echo json_encode($X);  
		}else{
			redirect("keluar");
		}
    }
    public function datahapus()
	{
		$logged = $this->session->userdata("logged_in");
		if($logged=="yes")
		{
			$this->db->trans_start();
			$id=$this->input->post("id");
			$where['idadmin']=$id;

			$delrol = $this->mod_conf->DeleteData("admin",$where);
			if($delrol){
				$output['hasil']=1;
	            $output['pesan']='Data berhasil di hapus';
			}else{
				$output['hasil']=0;
	            $output['pesan']='Data gagal di hapus';
			}
			$this->db->trans_complete();
			echo json_encode($output);
		}else{
			redirect("keluar");
		}
	}
}