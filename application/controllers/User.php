<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->model("mod_history");
    }
    public function index()
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
			// $tmplt["rightmenu"] = $this->load->view("template/right", $dtapp, TRUE);

			$data["head"] = $tmplt["header"];
			$data["menu"] = $tmplt["menu"];
			$data["foot"] = $tmplt["foot"];
			// $data["rightmenu"] = $tmplt["rightmenu"];
			$this->load->view("content/user", $data);
		} else {
			redirect('keluar');
		}
    }
    public function datalist()
    {
        $logged = $this->session->userdata("logged_in");
		if($logged=="yes")
		{
			$list = $this->mod_user->get_datatables();
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->nama;
		      	$row[] = $l->email;
		      	$row[] = $l->saldo;
		      	$row[] = $l->level;
		      	$row[] = $l->nowa;
                $row[] = $l->createdatef;
                if($l->level=="User"){
					$row[] = "<button class='btn btn-warning btn-sm' onclick='tambahsaldo(".$l->iduser.")'> Tambah Saldo</button>
					<button class='btn btn-success btn-sm' onclick='makereseller(".$l->iduser.")'><i class='fa fa-store'></i> Jadikan Reseller</button>
					<button class='btn btn-secondary btn-sm' onclick='makevvip(".$l->iduser.")'><i class='fa fa-user-tie'></i> Jadikan VVIP</button>
					<button class='btn btn-danger btn-sm' onclick='hapusData(".$l->iduser.")'><i class='fa fa-trash'></i> Hapus</button>";
                }else if($l->level=="Reseller") 
                {

					$row[] = "<button class='btn btn-warning btn-sm' onclick='tambahsaldo(".$l->iduser.")'> Tambah Saldo</button>
							<button class='btn btn-info btn-sm' onclick='makeuser(".$l->iduser.")'><i class='fa fa-users'></i> Jadikan User</button>
							<button class='btn btn-secondary btn-sm' onclick='makevvip(".$l->iduser.")'><i class='fa fa-user-tie'></i> Jadikan VVIP</button>
							<button class='btn btn-danger btn-sm' onclick='hapusData(".$l->iduser.")'><i class='fa fa-trash'></i> Hapus</button>";
				}else if($l->level=="VVIP")
				{
					$row[] = "<button class='btn btn-warning btn-sm' onclick='tambahsaldo(".$l->iduser.")'> Tambah Saldo</button>
							<button class='btn btn-info btn-sm' onclick='makeuser(".$l->iduser.")'><i class='fa fa-users'></i> Jadikan User</button>
							<button class='btn btn-success btn-sm' onclick='makereseller(".$l->iduser.")'><i class='fa fa-store'></i> Jadikan Reseller</button>
							<button class='btn btn-danger btn-sm' onclick='hapusData(".$l->iduser.")'><i class='fa fa-trash'></i> Hapus</button>";
				}
				
		      	$data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_user->count_all(),
		     "recordsFiltered" => $this->mod_user->count_filtered(),
		     "data" => $data,
		    );
		    echo json_encode($output);
		}else{
			redirect('keluar');
		}
    }
    public function ubahlevel()
    {
        $iduser = $this->input->post("id");
        $level = $this->input->post("level");
        $dataup["level"]=$level;
        $where['iduser']=$iduser;
        if($this->mod_conf->UpdateData('user',$dataup,$where)){
            $output['hasil']=1;
            $output['pesan']='Data berhasil di update';  
        }else{
            $output['hasil']=0;
            $output['pesan']='Data gagal di update';  
        }
        echo json_encode($output);  
    }
    public function makeuser()
    {
        $iduser = $this->input->post("id");
        $dataup["level"]="User";
        $where['iduser']=$iduser;
        if($this->mod_conf->UpdateData('user',$dataup,$where)){
            $output['hasil']=1;
            $output['pesan']='Data berhasil di update';  
        }else{
            $output['hasil']=0;
            $output['pesan']='Data gagal di update';  
        }
        echo json_encode($output);  
	}
	public function ubahsaldo()
	{
		$iduser = $this->input->post("idusers");
		$saldo = $this->input->post("saldo");
		$balance = $this->mod_user->getSaldo($iduser);
		$balup = $saldo +$balance;
        $dataup["saldo"]=$balup;
		$where['iduser']=$iduser;
		
        $datains['iduser']=$iduser;
        $datains['email']="-";
        $datains['kode']=date('Ymdhis');
        $datains['tanggal']=date('Y-m-d H:i:s');
		$datains['topup']=$saldo;
		$datains['payment']="Top Up Admin";
		$datains['status']="Sudah Bayar";
		
        if($this->mod_conf->UpdateData('user',$dataup,$where)){
			$this->mod_conf->InsertData('topup',$datains);
            $output['hasil']=1;
            $output['pesan']='Data berhasil di update';  
        }else{
            $output['hasil']=0;
            $output['pesan']='Data gagal di update';  
        }
        echo json_encode($output);  
	}
	public function statustopup()
	{
		$iduser = $this->input->post("iduser");
		$status = $this->mod_topup->getTopUp($iduser);
		if($status){
            $output['hasil']=1;
            $output['pesan']='Mohon maaf kamu masih mempunyai Top Up yang belum dibayar';  
        }else{
            $output['hasil']=1;
            $output['pesan']='Data gagal di update';  
        }
        echo json_encode($output);  
	}
	public function topupqris()
	{
		$iduser =$this->input->post("iduser");
		$name=$this->input->post("name");
        $phone=$this->input->post("phone");
        $email=$this->input->post("email");
		$amount=$this->input->post("nominal");
		$fee=$this->input->post("fee");
		
        if($fee==""){
            $fee="0";
        }
    
		$payment="QRIS";
		
		
        $notifyUrl=base_url()."user/unotify";
        $referenceId=date('YmdHis');
        $apikey = $this->mod_app->getAPIIPAYMU();
		$apiurl = $this->mod_app->getURLQRISIPAYMU();
		
		$curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'key' => $apikey,
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'amount' => $amount,
                'notifyUrl' => $notifyUrl,
                'referenceId' => $referenceId,
                'zipCode' => '-',
                'city' => '-'),
        ));

        $response = curl_exec($curl);
		
        curl_close($curl);
       
        $arr = json_decode($response);
        $status =$arr->Status;
        $message =$arr->Message;
        $ReferenceId =$arr->Data->ReferenceId;
        $QrImage =$arr->Data->QrImage;
        $QrTemplate =$arr->Data->QrTemplate;
        $trx_id =$arr->Data->TransactionId;
        $total =$arr->Data->Total;
        $Expired =$arr->Data->Expired;
        $Via =$arr->Data->Via;
        $Total =$arr->Data->Total;
        
        $datares[] = array(
            "status"=>$status,
            "pesan"=>$message,
            "ReferenceId"=>$ReferenceId,
            "QrImage"=>$QrImage,
            "QrTemplate"=>$QrTemplate,
            "trx_id"=>$trx_id,
            "total"=>$total,
            "Expired"=>$Expired,
            "Via"=>$Via,
            "Total"=>$Total,
        );
        $datains["tanggal"]= date('Y-m-d H:i:s');
        $datains["kode"]=$referenceId;
		$datains["iduser"]=$iduser;
		
        $datains["topup"]=$amount;
        $datains["payment"]=$payment;
        $datains["email"]=$email;
        $datains["url"]=$QrTemplate;
        $datains["fee"]=$fee;
        $datains["trx_id"]=$trx_id;
		$datains["status"]="Belum Bayar";
		
        $this->mod_conf->InsertData("topup",$datains);

        echo json_encode($datares);
	}
	public function topupstore()
	{
		$payment=$this->input->post("payment");
        $name=$this->input->post("name");
        $phone=$this->input->post("phone");
        $email=$this->input->post("email");
        $amount=$this->input->post("amount");
        $fee=$this->input->post("fee");
        if($fee==""){
            $fee="0";
        }
        $referenceId=date('YmdHis');
        $notifyUrl=$this->input->post("notifyUrl");
        $apikey = $this->mod_app->getAPIIPAYMU();
        $apiurl = $this->mod_app->getURLCSTOREIPAYMU();
        $iduser=$this->input->post("iduser");
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'key' => $apikey,
                'channel' => $payment,
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'amount' => $amount,
                'reference_id' => $referenceId,
                'unotify' => $notifyUrl,
                'active' => '24',
                'expired_type' => 'hours'),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
       
        $arr = json_decode($response);
        
        $ket = $arr->keterangan;

        $this->db->trans_start();
        $datains["tanggal"]= date('Y-m-d H:i:s');
        $datains["kode"]=$referenceId;
        $datains["iduser"]=$iduser;
        $datains["topup"]=$amount;
        $datains["fee"]=$fee;
        $datains["payment"]=$payment;
        $datains["email"]=$email;
        $datains["url"]="-";
        $datains["trx_id"]=$arr->trx_id;
        $datains["ket"]=$ket;
        $datains["status"]="Belum Bayar";
        $this->db->insert('topup', $datains);
        $insert_id = $this->db->insert_id();
        $datastat["tanggal"]=date('Y-m-d H:i:s');
        $datastat["trx_id"]=$arr->trx_id;
        $datastat["status"]="pending";
        $datastat["idtopup"]=$insert_id;
        $this->mod_conf->InsertData("topup_status",$datastat);
        $this->db->trans_complete();
        $hargaproduk = $amount-$fee;
        $datares[] = array(
            "keterangan"=>$ket,
            "harga"=>$amount,
            "hargaproduk"=>$hargaproduk,
            "fee"=>$fee,
            "referenceid"=>$referenceId
        );
        echo json_encode($datares);
	}
	public function unotifycstore()
    {
        $trx_id =$this->input->post("trx_id");
		
		$iduser = $this->mod_user->getUser($trx_id);
		$balance = $this->mod_user->getBalance($iduser);
		$nominal = $this->mod_user->getNominal($trx_id);
		$fee = $this->mod_user->getFee($trx_id);
		if($fee==""){
            $fee="0";
        }
        $idtopup = $this->mod_topup->getIdByTrx($trx_id);
		$datains["tanggal"] = date('Y-m-d H:i:s');
        $datains["trx_id"] = $this->input->post("trx_id");
		$datains["sid"] = $this->input->post("sid");
        $datains["status"] = $this->input->post("status");
        $datains["idtopup"]=$idtopup;
        $this->mod_conf->InsertData("topup_status",$datains);
        $status=$this->input->post("status");
        if($status=="berhasil"){
            
            $this->db->trans_start();
            $where["idtopup"]=$idtopup;
            $dataups["status"] = "Sudah Bayar";
			$this->mod_conf->UpdateData("topup",$dataups,$where);
			
			$whereup["iduser"]=$iduser;
			$dataupdate["saldo"]=$balance+($nominal-$fee);
			$this->mod_conf->UpdateData("user",$dataupdate,$whereup);
            $this->db->trans_complete();
        }
    }
	public function unotify()
    {
        $trx_id =$this->input->post("trx_id");
        $idtopup = $this->mod_user->getIdByTrx($trx_id);
		$nominal = $this->mod_user->getNominal($trx_id);
		$fee = $this->mod_user->getFee($trx_id);		

		if($fee==""){
            $fee="0";
		}
		$iduser = $this->mod_user->getUser($trx_id);
		$balance = $this->mod_user->getBalance($iduser);
		$saldo = $balance+($nominal-$fee);
		
		$datains["tanggal"] = date('Y-m-d H:i:s');
        $datains["trx_id"] =  $trx_id;
		$datains["sid"] = $this->input->post("sid");
        $datains["status"] = $this->input->post("status");
        $datains["idtopup"]=$idtopup;
        $this->mod_conf->InsertData("topup_status",$datains);
        $status=$this->input->post("status");
        if($status=="berhasil"){
            $where["idtopup"]=$idtopup;
            $dataups["status"] = "Sudah Bayar";
			$this->mod_conf->UpdateData("topup",$dataups,$where);
			$whereup["iduser"]=$iduser;
			$dataupdate["saldo"]=$saldo;
			$this->mod_conf->UpdateData("user",$dataupdate,$whereup);
        }
	}
	public function datatopup()
	{
		$iduser = $this->input->post("iduser");
		$list = $this->mod_topup->get_datatables($iduser);
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->tanggalf;
		      	$row[] = number_format($l->topup);
				$row[] = $l->payment;
				if($l->status=="Sudah Bayar"){
					$row[] = "<label class='label label-success'>Sudah Bayar</label>";
				}else{
					$row[] = "<label class='label label-warning'>Belum Bayar</label>";
				}
		      	$data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_topup->count_all($iduser),
		     "recordsFiltered" => $this->mod_topup->count_filtered($iduser),
		     "data" => $data,
		    );
		    echo json_encode($output);
	}
	public function tarikproses()
	{
		$data['iduser']=$this->input->post("iduser");
		$data['nominal']=$this->input->post("nominaltarik");
		$data['tanggal']=date('Y-m-d h:i:s');
		$data['norek']=$this->input->post("norek");
		$data['bank']=$this->input->post("bank");
		$data['atasnama']=$this->input->post("atasnama");
		$data['status']="Pending";
		if($this->mod_conf->InsertData("tarik",$data)){
			$output['hasil'] = "1";
			$output['pesan'] = 'Transaksi sedang di proses oleh admin';
		}else{
			$output['hasil'] = "0";
			$output['pesan'] = 'Gagal';
		}
		echo json_encode($output);
	}
	public function datatarik()
	{
		$iduser = $this->input->post("iduser");
		$list = $this->mod_tarik->get_datatables($iduser);
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->tanggalf;
		      	$row[] = $l->bank;
		      	$row[] = $l->norek."/".$l->atasnama;
		      	$row[] = number_format($l->nominal);
				if($l->status=="Sudah Bayar"){
					$row[] = "<label class='label label-success'>Sudah Bayar</label>";
				}else{
					$row[] = "<label class='label label-warning'>Pending</label>";
				}
				$row[] = "<a href='".base_url()."/assets/image/transfer/".$l->file."' target='_blank' class='btn btn-success btn-sm'>File Transfer</a>";
		      	$data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_tarik->count_all($iduser),
		     "recordsFiltered" => $this->mod_tarik->count_filtered($iduser),
		     "data" => $data,
		    );
		    echo json_encode($output);
	}
	public function datahistory()
	{
		$iduser = $this->input->post("iduser");
		$list = $this->mod_history->get_datatables($iduser);
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->tanggalf;
		      	$row[] = $l->gamename;
		      	$row[] = $l->productname;
		      	$row[] = $l->payment;
                $row[] = number_format($l->harga);
				  if($l->status=="Belum Bayar"){
                    $row[] = "<label class='label label-warning'>Belum Bayar</label>";
                }else if($l->status=="Sudah Bayar")
                {	
                    $row[] = "<label class='label label-success'>Sudah Bayar</label>";
                }else if($l->status=="Selesai"){
                    $row[] = "<label class='label label-success'>Selesai</label>";
                }else{
                    $row[] = "<label class='label label-danger'>Error/Testing</label>";
                }
                $row[] = "<a href='".base_url()."home/history_detail/".$l->kode."' class='btn btn-success btn-sm'>Detail Transaksi</a>";
		      	$data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_history->count_all($iduser),
		     "recordsFiltered" => $this->mod_history->count_filtered($iduser),
		     "data" => $data,
		    );
		    echo json_encode($output);
	}
	public function updateakun()
	{
		$data["nama"]=$this->input->post("nama");
		$data["email"]=$this->input->post("email");
		$data["nowa"]=$this->input->post("nowa");
		$where["iduser"]=$this->input->post("iduser");
		$password = $this->input->post("password");
		if(!empty($password))
		{
			$passwordenc =  $this->encryption->encrypt($password);
			$data["password"]=$passwordenc;
		}
		if($this->mod_conf->UpdateData("user",$data,$where)){
			$output['hasil'] = "1";
			$output['pesan'] = 'Data akun berhasil di update';
		}else{
			$output['hasil'] = "0";
			$output['pesan'] = 'Gagal';
		}
		echo json_encode($output);
	}
	public function datalisttopup()
	{
		$list = $this->mod_topup->get_datatables_user();
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->tanggalf;
		      	$row[] = $l->kode;
		      	$row[] = number_format($l->topup);
		      	$row[] = $l->payment;
		      	$row[] = $l->email;
				$row[] = $l->trx_id;
				if($l->status=="Sudah Bayar"){
					$row[] = "<label class='label label-success'>Sudah Bayar</label>";
				}else{
					$row[] = "<label class='label label-warning'>Belum Bayar</label>";
				}
				$row[] = "<button onclick='konfirmasimanual($l->kode)' class='btn btn-success btn-sm'>Konfirmasi Manual</button>
							<button onclick='hapustransaksi($l->idtopup)' class='btn btn-danger btn-sm'>Hapus</button>";
		      	$data[] = $row;
		    }
		$output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_topup->count_all_user(),
		     "recordsFiltered" => $this->mod_topup->count_filtered_user(),
		     "data" => $data,
		);
		echo json_encode($output);
	}
	public function datalisttarik()
	{
		$list = $this->mod_tarik->get_datatables_user();
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->tanggalf;
		      	$row[] = number_format($l->nominal);
		      	$row[] = $l->bank;
		      	$row[] = $l->norek."/".$l->atasnama;
		      	$row[] = $l->email;
				if($l->status=="Sudah Bayar"){
					$row[] = "<label class='label label-success'>Sudah Bayar</label>";
				}else{
					$row[] = "<label class='label label-warning'>Pending</label>";
				}
				$row[] = "<button onclick='modalBukti(".$l->idtarik.")' class='btn btn-success btn-sm'>Upload Bukti Transfer</button>";
				$row[] ="";  
				$data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_tarik->count_all_user(),
		     "recordsFiltered" => $this->mod_tarik->count_filtered_user(),
		     "data" => $data,
		    );
		    echo json_encode($output);
	}
	public function hapustopup()
	{
		$logged = $this->session->userdata("logged_in");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		if(($status!="")&&($logged=="yes"))
		{
			$this->db->trans_start();
			$id=$this->input->post("id");
			$where['idtopup']=$id;
			$where2['idtransaksi']=$id;

			$delrol1 = $this->mod_conf->DeleteData("topup",$where);
			$delrol2 = $this->mod_conf->DeleteData("topup_status",$where);
			$delrol3 = $this->mod_conf->DeleteData("kodeunik",$where2);
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
	public function datahapus()
	{
		$logged = $this->session->userdata("logged_in");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		if(($status!="")&&($logged=="yes"))
		{
			$this->db->trans_start();
			$id=$this->input->post("id");
			$where['iduser']=$id;

			$delrol = $this->mod_conf->DeleteData("user",$where);
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