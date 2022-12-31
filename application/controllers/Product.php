<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

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
		$this->load->model("mod_product");
    }
    public function home($idgame)
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
			$data["idgame"] = $idgame;
			// $data["rightmenu"] = $tmplt["rightmenu"];
			$this->load->view("content/product", $data);
		} else {
			redirect('keluar');
		}
    }
    public function datalist()
    {
        $logged = $this->session->userdata("logged_in");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		if(($status!="")&&($logged=="yes"))
		{
            $idgame = $this->input->post("id");
			$list = $this->mod_product->get_datatables($idgame);
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->nourut;
		      	$row[] = $l->nama;
		      	$row[] = $l->berat;
		      	$row[] = "Rp ".number_format($l->harga_dasar);
		      	$row[] = "Rp ".number_format($l->harga_jual);
		      	$row[] = "Rp ".number_format($l->harga_reseller);
		      	$row[] = "Rp ".number_format($l->harga_vvip);
		      	$row[] = $l->status;
				$row[] = "<button class='btn btn-warning btn-sm' onclick='editData(".$l->idproduct.")'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm' onclick='hapusData(".$l->idproduct.")'><i class='fa fa-trash'></i> Hapus</button>";
		      	$data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_product->count_all($idgame),
		     "recordsFiltered" => $this->mod_product->count_filtered($idgame),
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
		if(($status!="")&&($logged=="yes"))
		{
			$this->db->trans_start();
			$idproduct = $this->input->post("id");
			$datains["idgame"]=$this->input->post("idgame");
			$datains["nourut"]=$this->input->post("nourut");
			$datains["nama"]=$this->input->post("nama");
			$datains["berat"]=$this->input->post("berat");
			$datains["harga_dasar"]=$this->input->post("harga_dasar");
			$datains["harga_jual"]=$this->input->post("harga_jual");
			$datains["harga_reseller"]=$this->input->post("harga_reseller");
			$datains["harga_vvip"]=$this->input->post("harga_vvip");
			$datains["status"]=$this->input->post("status");
	
			if($idproduct<>""){
				$where['idproduct']=$idproduct;
				if($this->mod_conf->UpdateData('productgame',$datains,$where)){
					$output['hasil']=1;
					$output['pesan']='Data berhasil di update';  
				}else{
					$output['hasil']=0;
					$output['pesan']='Data gagal di update';  
				}
			}else{
				if($this->mod_conf->InsertData('productgame', $datains))
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

			$wharr = array("idproduct"=>$id);
			$dtrol=$this->mod_product->listing($wharr);
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
			$where['idproduct']=$id;

			$delrol = $this->mod_conf->DeleteData("productgame",$where);
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