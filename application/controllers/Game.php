<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends CI_Controller {

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
                $this->load->view("content/game", $data);
            } else {
                redirect('keluar');
            }
        }else{
            redirect('keluar');
        }
		
    }
    public function datalist()
    {
        $logged = $this->session->userdata("logged_in");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
        if($status!="")
		{
            if($logged=="yes")
            {
                $list = $this->mod_game->get_datatables();
                $data = array();
                $no = $_POST['start'];
                foreach ($list as $l) {
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $l->kategori_harga;
                    $row[] = $l->nama;
                    $row[] = "<img src=".base_url()."assets/image/".$l->icon." width='100'>";
                    $row[] = "<img src=".base_url()."assets/image/".$l->gambar." width='100'>";
                    if(strlen($l->desk)>100){
                        $row[] = substr($l->desk,0,100)."...";
                    }else{
                        $row[] = $l->desk;
                    }
                
                    if($l->kategori=="Voucher"){
                        $row[] = "<button class='btn btn-warning btn-sm' onclick='editData(".$l->idgame.")'><i class='fa fa-edit'></i> Edit</button>
                            <a class='btn btn-primary btn-sm' href='".base_url()."voucher/home/".$l->idgame."'><i class='fas fa-shopping-cart'></i> Voucher</a>  
                            <button class='btn btn-danger btn-sm' onclick='hapusData(".$l->idgame.")'><i class='fa fa-trash'></i> Hapus</button>";
                    }else{
                        $row[] = "<button class='btn btn-warning btn-sm' onclick='editData(".$l->idgame.")'><i class='fa fa-edit'></i> Edit</button>
                            <a class='btn btn-primary btn-sm' href='".base_url()."product/home/".$l->idgame."'><i class='fas fa-shopping-cart'></i> Product</a>  
                            <button class='btn btn-danger btn-sm' onclick='hapusData(".$l->idgame.")'><i class='fa fa-trash'></i> Hapus</button>";
                    }
                    
                    $data[] = $row;
                }
                $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->mod_game->count_all(),
                "recordsFiltered" => $this->mod_game->count_filtered(),
                "data" => $data,
                );
                echo json_encode($output);
            }else{
                redirect('keluar');
            }
        }else{
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
            $idgame = $this->input->post("id");
            $namagame=$this->input->post("nama");
            $datains["nama"]=$this->input->post("nama");
            $datains["jenis"]=$this->input->post("jenis");
            $datains["desk"]=$this->input->post("desk");
            $datains["playstore"]=$this->input->post("playstore");
            $datains["appstore"]=$this->input->post("appstore");
            $datains["akunid_status"]=$this->input->post("akunid_status");
            $datains["akunid_label"]=$this->input->post("akunid_label");
            $datains["akunid_jenis"]=$this->input->post("akunid_jenis");
            $datains["zona_status"]=$this->input->post("zona_status");
            $datains["zona_label"]=$this->input->post("zona_label");
            $datains["zona_jenis"]=$this->input->post("zona_jenis");
            $datains["server_status"]=$this->input->post("server_status");
            $datains["server_label"]=$this->input->post("server_label");
            $datains["server_jenis"]=$this->input->post("server_jenis");
            $datains["kategori"]=$this->input->post("kategori");
            $datains["kategori_harga"]=$this->input->post("kategori_harga");
            $datains["status"]=$this->input->post("status");
            $datains["urut"]=$this->input->post("urut");


            $namastr = "Prestasi_".str_replace(' ', '_', trim($namagame));
            $unikimg= date('Ymdhis');
            if($_FILES['icon']['size'] != 0 ){
                $config['upload_path'] = './assets/image';
                $config['allowed_types'] = 'jpg|png|jpeg|pdf|JPG|PNG|JPEG|PDF';
                $config['file_name'] = "icon_".$namastr."_".$unikimg;
                $config['overwrite']     = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if(!$this->upload->do_upload('icon')){
                    $hasil="success";
                    echo json_encode($hasil);
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $eks = explode('.', $_FILES['icon']['name']);
                    $eks = $eks[count($eks)-1];
                    $datains["icon"]="icon_".$namastr."_".$unikimg.".".$eks;
                }
            }
            if($_FILES['gambar']['size'] != 0 ){
                $config['upload_path'] = './assets/image';
                $config['allowed_types'] = 'jpg|png|jpeg|pdf|JPG|PNG|JPEG|PDF';
                $config['file_name'] = "gambar_".$namastr."_".$unikimg;
                $config['overwrite']     = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if(!$this->upload->do_upload('gambar')){
                    $hasil="success";
                    echo json_encode($hasil);
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $eks = explode('.', $_FILES['gambar']['name']);
                    $eks = $eks[count($eks)-1];
                    $datains["gambar"]="gambar_".$namastr."_".$unikimg.".".$eks;
                }
            }
            if($idgame<>""){
                $where['idgame']=$idgame;
                if($this->mod_conf->UpdateData('game',$datains,$where)){
                    $output['hasil']=1;
                    $output['pesan']='Data berhasil di update';  
                }else{
                    $output['hasil']=0;
                    $output['pesan']='Data gagal di update';  
                }
            }else{
                if($this->mod_conf->InsertData('game', $datains))
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

			$wharr = array("idgame"=>$id);
			$dtrol=$this->mod_game->listing($wharr);
		    $X = array('hasildata'=>$dtrol);               
		    echo json_encode($X);  
		}else{
			redirect("keluar");
		}
    }
    public function datahapus()
	{
        $logged = $this->session->userdata("logged_in");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
        if(($status!="")&&($logged=="yes"))
		{
			$this->db->trans_start();
			$id=$this->input->post("id");
			$where['idgame']=$id;

			$delrol = $this->mod_conf->DeleteData("game",$where);
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