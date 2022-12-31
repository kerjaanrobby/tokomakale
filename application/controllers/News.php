<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','download','file'));
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('form_validation');		
		$this->load->model("mod_app");
		$this->load->model("mod_admin");
		$this->load->model("mod_news");
		$this->load->model("mod_conf");
    }
    public function index()
	{
		$logged = $this->session->userdata("logged_in");
		$rol = $this->session->userdata("rol");
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
			$this->load->view("content/news", $data);
		} else {
			redirect('keluar');
		}
    }
    public function datalist()
    {
        $logged = $this->session->userdata("logged_in");
		if($logged=="yes")
		{
			$list = $this->mod_news->get_datatables();
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->tanggalf;
                $row[] = $l->judul;
                if(strlen($l->isi)>50)
                {
                    $row[] = substr($l->isi,0,50)."...";
                }else{
                    $row[] = $l->isi;
                }
		      	$row[] = "<img src=".base_url()."assets/image/".$l->thumbnail." width='100'>";
				$row[] = "<button class='btn btn-warning btn-sm' onclick='editData(".$l->idnews.")'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm' onclick='hapusData(".$l->idnews.")'><i class='fa fa-trash'></i> Hapus</button>";
		      	$data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_news->count_all(),
		     "recordsFiltered" => $this->mod_news->count_filtered(),
		     "data" => $data,
		    );
		    echo json_encode($output);
		}else{
			redirect('keluar');
		}
    }
    public function datasimpan()
    {
        $this->db->trans_start();
        $idnews = $this->input->post("id");
        $namathumbnail=$this->input->post("nama");
        $tanggal=$this->input->post("tanggal");
        $datains["judul"]=$this->input->post("judul");
        $datains["isi"]=$this->input->post("isi");
        $datains["tanggal"]=$tanggal;

        $namastr = "thumbnail_".str_replace(' ', '_', $namathumbnail);
        $unikimg= date('Ymdhis');
        if($_FILES['thumbnail']['size'] != 0 ){
            $config['upload_path'] = './assets/image';
            $config['allowed_types'] = 'jpg|png|jpeg|pdf|JPG|PNG|JPEG|PDF';
            $config['file_name'] = $namastr."_".$unikimg;
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
                $datains["thumbnail"]=$namastr."_".$unikimg.".".$eks;
            }
        }
        if($idnews<>""){
            $where['idnews']=$idnews;
            if($this->mod_conf->UpdateData('news',$datains,$where)){
                $output['hasil']=1;
                $output['pesan']='Data berhasil di update';  
            }else{
                $output['hasil']=0;
                $output['pesan']='Data gagal di update';  
            }
        }else{
            if($this->mod_conf->InsertData('news', $datains))
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
    }
    public function datadetail()
	{
		$logged = $this->session->userdata("logged_in");
		if($logged=="yes")
		{
			$id=$this->input->post('id');

			$wharr = array("idnews"=>$id);
			$dtrol=$this->mod_news->listing($wharr);
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
			$where['idnews']=$id;

			$delrol = $this->mod_conf->DeleteData("news",$where);
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