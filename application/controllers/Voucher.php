<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher extends CI_Controller {

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
		$this->load->model("mod_voucher");
		$this->load->model("mod_voucherstok");
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
                $this->load->view("content/master_voucher", $data);
            } else {
                redirect('keluar');
            }
        }else{
            redirect('keluar');
        }
		
	}
	public function kode_history($idvoucher,$idgame)
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

			$data["head"] = $tmplt["header"];
			$data["menu"] = $tmplt["menu"];
			$data["foot"] = $tmplt["foot"];
			$data["idvoucher"] = $idvoucher;
			$data["idgame"] = $idgame;
			// $data["rightmenu"] = $tmplt["rightmenu"];
			$this->load->view("content/kode_history", $data);
		} else {
			redirect('keluar');
		}
	}
    public function home($idgame)
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

			$data["head"] = $tmplt["header"];
			$data["menu"] = $tmplt["menu"];
			$data["foot"] = $tmplt["foot"];
			$data["idgame"] = $idgame;
			// $data["rightmenu"] = $tmplt["rightmenu"];
			$this->load->view("content/voucher", $data);
		} else {
			redirect('keluar');
		}
	}
	public function historyvoucher()
	{
		$logged = $this->session->userdata("logged_in");
		if($logged=="yes")
		{
            $idvoucher = $this->input->post("id");
			$list = $this->mod_voucherstok->get_datatables_history($idvoucher);
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->tanggal;
		      	$row[] = $l->kode;
				$row[] = $l->status;
				if($l->status=="Pesan"){
					$row[] = "<button class='btn btn-success btn-sm' onclick='Aktifkan(".$l->idvoucherstok.")'><i class='fa fa-check'></i> Aktifkan</button>";
				}else{
					$row[] = "<button class='btn btn-danger btn-sm' onclick='hapusData(".$l->idvoucherstok.")'><i class='fa fa-trash'></i> Hapus</button>";
				} 
				
		      	$data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_voucherstok->count_all_history($idvoucher),
		     "recordsFiltered" => $this->mod_voucherstok->count_filtered_history($idvoucher),
		     "data" => $data,
		    );
		    echo json_encode($output);
		}else{
			redirect('keluar');
		}
	}
    public function datalist()
    {
        $logged = $this->session->userdata("logged_in");
		if($logged=="yes")
		{
            $idgame = $this->input->post("id");
			$list = $this->mod_voucher->get_datatables($idgame);
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->nama;
		      	$row[] = "Rp ".number_format($l->harga_dasar);
		      	$row[] = "Rp ".number_format($l->harga_jual);
		      	$row[] = "Rp ".number_format($l->harga_reseller);
		      	$row[] = $this->mod_voucher->getStok($l->idvoucher);
				$row[] = "<button class='btn btn-warning btn-sm' onclick='editData(".$l->idvoucher.")'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm' onclick='hapusData(".$l->idvoucher.")'><i class='fa fa-trash'></i> Hapus</button>
                        <a class='btn btn-info btn-sm' href='".base_url()."voucher/inputstok/".$l->idvoucher."/".$l->idgame."'><i class='fa fa-ticket-alt'></i> Input Stok</a>";
		      	$data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_voucher->count_all($idgame),
		     "recordsFiltered" => $this->mod_voucher->count_filtered($idgame),
		     "data" => $data,
		    );
		    echo json_encode($output);
		}else{
			redirect('keluar');
		}
    }
	public function datalistvoucher()
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
                    $row[] = $l->kategori;
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
        $this->db->trans_start();
        $idvoucher = $this->input->post("id");
        $datains["idgame"]=$this->input->post("idgame");
        $datains["nama"]=$this->input->post("nama");
        $datains["harga_dasar"]=$this->input->post("harga_dasar");
        $datains["harga_jual"]=$this->input->post("harga_jual");
        $datains["harga_reseller"]=$this->input->post("harga_reseller");

        if($idvoucher<>""){
            $where['idvoucher']=$idvoucher;
            if($this->mod_conf->UpdateData('voucher',$datains,$where)){
                $output['hasil']=1;
                $output['pesan']='Data berhasil di update';  
            }else{
                $output['hasil']=0;
                $output['pesan']='Data gagal di update';  
            }
        }else{
            if($this->mod_conf->InsertData('voucher', $datains))
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
		
			$id=$this->input->post('id');

			$wharr = array("idvoucher"=>$id);
			$dtrol=$this->mod_voucher->listing($wharr);
		    $X = array('hasildata'=>$dtrol);               
		    echo json_encode($X);  
		
    }
    public function datahapus()
	{
		$logged = $this->session->userdata("logged_in");
		if($logged=="yes")
		{
			$this->db->trans_start();
			$id=$this->input->post("id");
			$where['idvoucher']=$id;

			$delvoucher = $this->mod_conf->DeleteData("voucher",$where);
			$delstok = $this->mod_conf->DeleteData("voucher_stok",$where);
			if(($delvoucher)&&($delstok)){
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
    
    public function inputstok($idvoucher,$idgame)
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

			$data["head"] = $tmplt["header"];
			$data["menu"] = $tmplt["menu"];
			$data["foot"] = $tmplt["foot"];
			$data["idvoucher"] = $idvoucher;
			$data["idgame"] = $idgame;
			// $data["rightmenu"] = $tmplt["rightmenu"];
			$this->load->view("content/voucher_kode", $data);
		} else {
			redirect('keluar');
		}
    }
    public function datalistkode()
    {
        $logged = $this->session->userdata("logged_in");
		if($logged=="yes")
		{
            $idvoucher = $this->input->post("id");
			$list = $this->mod_voucherstok->get_datatables($idvoucher);
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->kode;
				$row[] = "<button class='btn btn-warning btn-sm' onclick='editData(".$l->idvoucherstok.")'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm' onclick='hapusData(".$l->idvoucherstok.")'><i class='fa fa-trash'></i> Hapus</button>";
		      	$data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_voucherstok->count_all($idvoucher),
		     "recordsFiltered" => $this->mod_voucherstok->count_filtered($idvoucher),
		     "data" => $data,
		    );
		    echo json_encode($output);
		}else{
			redirect('keluar');
		}
    }
    public function datasimpankode()
    {
		$this->db->trans_start();
		$kode = $this->input->post("kode");
		$idvoucherstok = $this->input->post("id");
		$idvoucher=$this->input->post("idvoucher");
        $datains["idvoucher"]=$this->input->post("idvoucher");
        $datains["kode"]=$kode;
        $datains["status"]="Aktif";

		
		$statkode = $this->mod_voucherstok->getKodeVoucher($kode);
		if($statkode=="")
		{
			if($idvoucherstok<>""){
				$where['idvoucherstok']=$idvoucherstok;
				if($this->mod_conf->UpdateData('voucher_stok',$datains,$where)){
					$output['hasil']=1;
					$output['pesan']='Data berhasil di update';  
				}else{
					$output['hasil']=0;
					$output['pesan']='Data gagal di update';  
				}
			}else{
				$jumlahstok = $this->mod_voucher->getstokvoucher(array("idvoucher"=>$idvoucher));
				$dataupdate["stok"]=$jumlahstok+1;
				$whereupdate["idvoucher"]=$idvoucher;
				$this->mod_conf->UpdateData("voucher",$dataupdate,$whereupdate);
				if($this->mod_conf->InsertData('voucher_stok', $datains))
				{
					$output['hasil']=1;
					$output['pesan']='Data berhasil di simpan';  
				}else{
					$output['hasil']=0;
					$output['pesan']='Data gagal di simpan';
				};
			}
		}else{
			$output['hasil']=0;
			$output['pesan']='Maaf kode voucher sudah pernah di input';
		}

        
        $this->db->trans_complete();
        echo json_encode($output);  
    }
    public function datadetailkode()
	{
		$logged = $this->session->userdata("logged_in");
		if($logged=="yes")
		{
			$id=$this->input->post('id');

			$wharr = array("idvoucherstok"=>$id);
			$dtrol=$this->mod_voucherstok->listing($wharr);
		    $X = array('hasildata'=>$dtrol);               
		    echo json_encode($X);  
		}else{
			redirect("keluar");
		}
    }
    public function datahapuskode()
	{
		$logged = $this->session->userdata("logged_in");
		if($logged=="yes")
		{
			$this->db->trans_start();
			$id=$this->input->post("id");
			$where['idvoucherstok']=$id;
			$dtvoucher=$this->mod_voucherstok->listing(array("idvoucherstok"=>$id));
			foreach($dtvoucher as $dv){
				$idvoucher = $dv->idvoucher;
			}

			$delrol = $this->mod_conf->DeleteData("voucher_stok",$where);
			if($delrol){
				$jumlahstok = $this->mod_voucher->getstokvoucher(array("idvoucher"=>$idvoucher));
				$dataupdate["stok"]=$jumlahstok-1;
				$whereupdate["idvoucher"]=$idvoucher;
				$this->mod_conf->UpdateData("voucher",$dataupdate,$whereupdate);
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
	
	public function dataaktifkankode()
	{
		$logged = $this->session->userdata("logged_in");
		if($logged=="yes")
		{
			$this->db->trans_start();
			$id=$this->input->post("id");
			$where['idvoucherstok']=$id;
			$dataup['status']="Aktif";
			$dtvoucher=$this->mod_voucherstok->listing(array("idvoucherstok"=>$id));
			foreach($dtvoucher as $dv){
				$idvoucher = $dv->idvoucher;
			}

			$delrol = $this->mod_conf->UpdateData("voucher_stok",$dataup,$where);
			if($delrol){
				$jumlahstok = $this->mod_voucher->getstokvoucher(array("idvoucher"=>$idvoucher));
				$dataupdate["stok"]=$jumlahstok+1;
				$whereupdate["idvoucher"]=$idvoucher;
				$this->mod_conf->UpdateData("voucher",$dataupdate,$whereupdate);
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