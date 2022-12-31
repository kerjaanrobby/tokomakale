<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','download','file'));
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('form_validation');		
		$this->load->model("mod_app");
		$this->load->model("mod_admin");
		$this->load->model("mod_payment");
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
			$dtchannelpayment = $this->mod_payment->listingpaymentchannel();

			$dtapp["nameapp"] = $nameapp;
			$dtapp["instansi"] = $instansi;
			$dtapp["logo"] = $logo;
			$dtapp["favicon"] = $favicon;
			$dtapp["akun"] = $dtakun;
			$dtapp["paymentchannel"]= $dtchannelpayment;


			$tmplt["header"] = $this->load->view("template/head", $dtapp, TRUE);
			$tmplt["menu"] = $this->load->view("template/menu", $dtapp, TRUE);
			$tmplt["foot"] = $this->load->view("template/foot", $dtapp, TRUE);

			$data["head"] = $tmplt["header"];
			$data["menu"] = $tmplt["menu"];
            $data["foot"] = $tmplt["foot"];
            
			$this->load->view("content/payment", $data);
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
			$list = $this->mod_payment->get_datatables();
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->nama;
		      	$row[] = $l->via;
		      	$row[] = $l->paymentchannel;
				$row[] = $l->fee;
				if($l->status=="0")
				{
					$row[] = "Aktif";
				}else{
					$row[] = "Non Aktif";
				}
		      	$row[] = "<img src=".base_url()."assets/image/payment/".$l->logo." width='100'>";
				$row[] = "<button class='btn btn-warning btn-sm' onclick='editData(".$l->idpayment.")'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm' onclick='hapusData(".$l->idpayment.")'><i class='fa fa-trash'></i> Hapus</button>";
		      	$data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_payment->count_all(),
		     "recordsFiltered" => $this->mod_payment->count_filtered(),
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
			$idpayment = $this->input->post("id");
			$nama=$this->input->post("nama");
			$datains["nama"]=$this->input->post("nama");
			$datains["via"]=$this->input->post("via");
			$datains["kode"]=$this->input->post("kode");
			$datains["fee"]=$this->input->post("fee");
			$datains["paymentchannel"]=$this->input->post("paymentchannel");
			$datains["status"]=$this->input->post("status");

			$namastr = "logo_".str_replace(' ', '_', $nama);
			$unikimg= date('Ymdhis');
			if($_FILES['logo']['size'] != 0 ){
				$config['upload_path'] = './assets/image/payment';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf|JPG|PNG|JPEG|PDF';
				$config['file_name'] = $namastr."_".$unikimg;
				$config['overwrite']     = TRUE;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if(!$this->upload->do_upload('logo')){
					$hasil="success";
					echo json_encode($hasil);
				} else {
					$data = array('upload_data' => $this->upload->data());
					$eks = explode('.', $_FILES['logo']['name']);
					$eks = $eks[count($eks)-1];
					$datains["logo"]=$namastr."_".$unikimg.".".$eks;
				}
			}
			if($idpayment<>""){
				$where['idpayment']=$idpayment;
				if($this->mod_conf->UpdateData('payment',$datains,$where)){
					$output['hasil']=1;
					$output['pesan']='Data berhasil di update';  
				}else{
					$output['hasil']=0;
					$output['pesan']='Data gagal di update';  
				}
			}else{
				if($this->mod_conf->InsertData('payment', $datains))
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

			$wharr = array("idpayment"=>$id);
			$dtrol=$this->mod_payment->listing($wharr);
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
			$where['idpayment']=$id;

			$delrol = $this->mod_conf->DeleteData("payment",$where);
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