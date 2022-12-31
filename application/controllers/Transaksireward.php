<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksireward extends CI_Controller {

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
		$this->load->model("mod_product");
		$this->load->model("mod_transaksi");
		$this->load->model("mod_transaksihistory");
		$this->load->model("mod_transaksipayment");
		$this->load->model("mod_transaksireward");
		$this->load->model("mod_user");
		$this->load->model("mod_topup");
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
			$this->load->view("content/transaksireward", $data);
		} else {
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
                $list = $this->mod_transaksireward->get_datatables();
                $data = array();
                $no = $_POST['start'];
                foreach ($list as $l) {
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $l->tanggalformat;
                    $row[] = $l->namaitem;
                    $row[] = $l->nilai;
                    $row[] = $l->namauser;
                    if($l->status == "Belum diberi")
                    {
                        $row[] = "<span class='label label-warning'>Belum Diberi</span>";
                        $row[] = "<button class='btn btn-sm btn-success' onclick='berireward(".$l->idtransaksireward.")' >Beri Reward</button>";
                    }else if($l->status == "Sudah diberi")
                    {
                        $row[] = "<span class='label label-success'>Sudah Diberi</span>";
                        $row[] = "<button class='btn btn-sm btn-danger' onclick='hapusData(".$l->idtransaksireward.")' >Hapus Reward</button>";
                    }else{
                        $row[] = "<span class='label label-danger'>Error</span>";
                    }
                    
                    
                    $data[] = $row;
                }
                $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->mod_transaksireward->count_all(),
                "recordsFiltered" => $this->mod_transaksireward->count_filtered(),
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
    public function datalistuser()
    {
        $logged = $this->session->userdata("logged_in");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
        if($status!="")
		{
            if($logged=="yes")
            {
                $list = $this->mod_transaksireward->get_datatables_user($idakun);
                $data = array();
                $no = $_POST['start'];
                foreach ($list as $l) {
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $l->tanggalformat;
                    $row[] = $l->namaitem;
                    $row[] = $l->nilai;
                    if($l->status == "Belum diberi")
                    {
                        $row[] = "<span class='label label-warning'>Belum Diberi</span>";
                    }else if($l->status == "Sudah diberi")
                    {
                        $row[] = "<span class='label label-success'>Sudah Diberi</span>";
                    }else{
                        $row[] = "<span class='label label-danger'>Error</span>";
                    }
                    $data[] = $row;
                }
                $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->mod_transaksireward->count_all_user($idakun),
                "recordsFiltered" => $this->mod_transaksireward->count_filtered_user($idakun),
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
    public function berireward()
    {
        $logged = $this->session->userdata("logged_in");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
        if(($status!="")&&($logged=="yes"))
		{
			$this->db->trans_start();
            $id=$this->input->post("id");
            $dataup["status"]="Sudah diberi";
			$where['idtransaksireward']=$id;

			$delrol = $this->mod_conf->UpdateData("transaksireward",$dataup,$where);
			if($delrol){
				$output['hasil']=1;
	            $output['pesan']='Data berhasil di update';
			}else{
				$output['hasil']=0;
	            $output['pesan']='Data gagal di update';
			}
			$this->db->trans_complete();
			echo json_encode($output);
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
			$where['idtransaksireward']=$id;

			$delrol = $this->mod_conf->DeleteData("transaksireward",$where);
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