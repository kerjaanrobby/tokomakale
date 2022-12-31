<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fitur extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','download','file'));
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('form_validation');		
		$this->load->model("mod_app");
		$this->load->model("mod_admin");
		$this->load->model("mod_fitur");
		$this->load->model("mod_conf");
    }
    public function index()
	{
		$logged = $this->session->userdata("logged_in");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		$rol = $this->session->userdata("rol");
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
			// $tmplt["rightmenu"] = $this->load->view("template/right", $dtapp, TRUE);

			$data["head"] = $tmplt["header"];
			$data["menu"] = $tmplt["menu"];
			$data["foot"] = $tmplt["foot"];
			// $data["rightmenu"] = $tmplt["rightmenu"];
			$this->load->view("content/fitur", $data);
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
		if (($status!="")&&($logged == "yes")&&($rol=="Superadmin")) {
		
			$list = $this->mod_fitur->get_datatables();
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
                $row[] = $l->judul;
                if(strlen($l->detail)>50)
                {
                    $row[] = substr($l->detail,0,50)."...";
                }else{
                    $row[] = $l->detail;
                }
                $row[] = "<img src=".base_url()."assets/image/".$l->thumbnail." width='100'>";
				$row[] = "<button class='btn btn-warning btn-sm' onclick='editData(".$l->idfitur.")'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm' onclick='hapusData(".$l->idfitur.")'><i class='fa fa-trash'></i> Hapus</button>";
		      	$data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_fitur->count_all(),
		     "recordsFiltered" => $this->mod_fitur->count_filtered(),
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
		if (($status!="")&&($logged == "yes")&&($rol=="Superadmin")) {
			$this->db->trans_start();
			$idfitur = $this->input->post("id");
			$judul=$this->input->post("judul");
			$datains["judul"]=$this->input->post("judul");
			$datains["detail"]=$this->input->post("detail");

			$namastr = str_replace(' ', '_', $judul);
			$unikimg= date('Ymdhis');
			if($_FILES['thumbnail']['size'] != 0 ){
				$config['upload_path'] = './assets/image';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf|JPG|PNG|JPEG|PDF';
				$config['file_name'] = "fitur_".$namastr."_".$unikimg;
				$config['overwrite']     = TRUE;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if(!$this->upload->do_upload('thumbnail')){
					$hasil="success";
					echo json_encode($hasil);
				} else {
					$data = array('upload_data' => $this->upload->data());
					$eks = explode('.', $_FILES['thumbnail']['name']);
					$eks = $eks[count($eks)-1];
					$datains["thumbnail"]="fitur_".$namastr."_".$unikimg.".".$eks;
				}
			}
			if($idfitur<>""){
				$where['idfitur']=$idfitur;
				if($this->mod_conf->UpdateData('fitur',$datains,$where)){
					$output['hasil']=1;
					$output['pesan']='Data berhasil di update';  
				}else{
					$output['hasil']=0;
					$output['pesan']='Data gagal di update';  
				}
			}else{
				if($this->mod_conf->InsertData('fitur', $datains))
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

			$wharr = array("idfitur"=>$id);
			$dtrol=$this->mod_fitur->listing($wharr);
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
			$where['idfitur']=$id;

			$delrol = $this->mod_conf->DeleteData("fitur",$where);
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