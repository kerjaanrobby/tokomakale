<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rewardpoint extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','download','file'));
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('form_validation');		
		$this->load->model("mod_app");
		$this->load->model("mod_admin");
		$this->load->model("mod_rewardpoint");
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
                $this->load->view("content/rewardpoint", $data);
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
                $list = $this->mod_rewardpoint->get_datatables();
                $data = array();
                $no = $_POST['start'];
                foreach ($list as $l) {
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $l->nama;
                    $row[] = $l->nilai;
                    $row[] = $l->status;
                    $row[] = "<button class='btn btn-warning btn-sm' onclick='editData(".$l->idrewardpoint.")'><i class='fa fa-edit'></i> Edit</button> 
                    <button class='btn btn-danger btn-sm' onclick='hapusData(".$l->idrewardpoint.")'><i class='fa fa-trash'></i> Hapus</button>";
                    $data[] = $row;
                }
                $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->mod_rewardpoint->count_all(),
                "recordsFiltered" => $this->mod_rewardpoint->count_filtered(),
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
            $idrewardpoint = $this->input->post("id");
            $datains["nama"]=$this->input->post("nama");
            $datains["nilai"]=$this->input->post("nilai");
            $datains["status"]=$this->input->post("status");

            if($idrewardpoint<>""){
                $where['idrewardpoint']=$idrewardpoint;
                if($this->mod_conf->UpdateData('rewardpoint',$datains,$where)){
                    $output['hasil']=1;
                    $output['pesan']='Data berhasil di update';  
                }else{
                    $output['hasil']=0;
                    $output['pesan']='Data gagal di update';  
                }
            }else{
                if($this->mod_conf->InsertData('rewardpoint', $datains))
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

			$wharr = array("idrewardpoint"=>$id);
			$dtrol=$this->mod_rewardpoint->listing($wharr);
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
			$where['idrewardpoint']=$id;

			$delrol = $this->mod_conf->DeleteData("rewardpoint",$where);
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
    public function datareward()
    {
        $logged = $this->session->userdata("logged_in");
        if($logged=="yes")
            {
                $list = $this->mod_rewardpoint->get_datatables_user();
                $data = array();
                $no = $_POST['start'];
                foreach ($list as $l) {
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $l->nama;
                    $row[] = $l->nilai;
                    $row[] = "<button class='btn btn-success btn-sm' onclick='pilireward(".$l->idrewardpoint.",".$l->nilai.")'><i class='fa fa-check'></i> PiliReward</button>";
                    $data[] = $row;
                }
                $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->mod_rewardpoint->count_all_user(),
                "recordsFiltered" => $this->mod_rewardpoint->count_filtered_user(),
                "data" => $data,
                );
                echo json_encode($output);
            }else{
                redirect('keluar');
            }
    }
    public function tukarreward()
    {
        $tanggal = date('Y-m-d h:i:s');
        $this->db->trans_start();
        $datains["iduser"] = $this->input->post("iduser");
        $datains["idreward"] = $this->input->post("idreward");
        $datains["nilai"] = $this->input->post("nilai");
        $datains["tanggal"] = $tanggal;
        $datains["status"] = "Belum diberi";


        $datainsre["iduser"] = $this->input->post("iduser");
        $datainsre["idtransaksi"] = "0";
        $datainsre["point"] = $this->input->post("nilai");
        $datainsre["jenis"] = "Kredit";
        $datainsre["tanggal"] = $tanggal;
        if(($this->mod_conf->InsertData('transaksireward', $datains))&&($this->mod_conf->InsertData('point', $datainsre)))
        {
            $output['hasil']=1;
            $output['pesan']='Data berhasil di simpan';  
        }else{
            $output['hasil']=0;
            $output['pesan']='Data gagal di simpan';
        };

        $this->db->trans_complete();
        echo json_encode($output);  
    }
}