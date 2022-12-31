<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

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
        $this->load->model("mod_voucher");
        $this->load->model("mod_voucherstok");
		$this->load->model("mod_transaksi");
		$this->load->model("mod_transaksihistory");
		$this->load->model("mod_transaksipayment");
		$this->load->model("mod_user");
		$this->load->model("mod_topup");
		$this->load->model("mod_game");
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
			$this->load->view("content/transaksi", $data);
		} else {
			redirect('keluar');
		}
    }
    public function dev()
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
			$this->load->view("content/transaksi_dev", $data);
		} else {
			redirect('keluar');
		}
    }
    public function voucher()
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
			$this->load->view("content/transaksivoucher", $data);
		} else {
			redirect('keluar');
		}
    }
    public function history()
    {
        $logged = $this->session->userdata("logged_in");
		$rol = $this->session->userdata("rol");
		if (($logged == "yes")&&(($rol=="Superadmin")||($rol=="Admin Web"))) {
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
			$this->load->view("content/history", $data);
		} else {
			redirect('keluar');
		}
    }
    public function datalist()
    {
        $logged = $this->session->userdata("logged_in");
		$rol = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		if (($status!="")&&($logged == "yes")&&(($rol=="Superadmin")||($rol=="Admin Web"))) 
		{
			$list = $this->mod_transaksi->get_datatables();
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->idtransaksi;
		      	$row[] = $l->tanggalf;
		      	$row[] = $l->gamename;
		      	$row[] = $l->productname;
                $row[] = $l->akun;
                if(!empty($l->server))
                {
                    $row[] = $l->zone."/".$l->server;
                }else{
                    $row[] = $l->zone." ".$l->server;
                }
		      	
		      	$row[] = $l->payment;
		      	$row[] = $l->jenis;
                $row[] = number_format($l->harga);
                
                if($l->jenis=="Publik")
                {
                    $row[] = "Publik";
                }else{
                    $row[] = $l->namauser;
                }
		      	
                if($l->status=="Belum Bayar"){
                    $row[] = "<label class='label label-warning'>Belum Bayar</label>";
                }else if($l->status=="Sudah Bayar")
                {
                    $row[] = "<label class='label label-success'>Sudah Bayar</label>";
                }else if($l->status=="Selesai"){
                    $row[] = "<label class='label label-success'>Selesai</label>";
                }else if($l->status=="Error"){
                    $row[] = "<label class='label label-danger'>Error</label>";
                }else{
                    $row[] = "<label class='label label-danger'>Error/Testing</label>";
                }

                if($l->kategori=="Voucher"){
                    $row[] = "<button class='btn btn-success btn-sm' onclick=selesaiTransVoucher('".$l->idtransaksi."')>Selesai & Kirim Voucher</button>
                    <button class='btn btn-danger btn-sm' onclick=hapusData('".$l->idtransaksi."')>Hapus</button>";
                }else{
                  	if($l->katgame=="Fisik")
                    {
                        $row[] = "<button class='btn btn-success btn-sm' onclick=(selesaiTrans)Kategori('".$l->idtransaksi."')>Selesai & Kirim</button>
                        	    <button class='btn btn-danger btn-sm' onclick=hapusData('".$l->idtransaksi."')>Hapus</button>";
                    }else{
                        if($l->status=="Error")
                        {
                            $row[] = "<button class='btn btn-success btn-sm' onclick=selesaiTrans('".$l->idtransaksi."')>Selesai</button>
                            <button class='btn btn-danger btn-sm' onclick=hapusData('".$l->idtransaksi."')>Hapus</button>";
                        }else{
                            $row[] = "
                                <button class='btn btn-success btn-sm' onclick=selesaiTrans('".$l->idtransaksi."')>Selesai</button>
                                <button class='btn btn-danger btn-sm' onclick=hapusData('".$l->idtransaksi."')>Hapus</button>
                                <button class='btn btn-dark btn-sm' onclick=errorTrans('".$l->idtransaksi."')>Error</button>";
                        }
                       
                    }
                }

                  
		      	$data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_transaksi->count_all(),
		     "recordsFiltered" => $this->mod_transaksi->count_filtered(),
		     "data" => $data,
		    );
		    echo json_encode($output);
		}else{
			redirect('keluar');
		}
    }
    public function datalist_voucher()
    {
        $logged = $this->session->userdata("logged_in");
		$rol = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		if (($status!="")&&($logged == "yes")&&(($rol=="Superadmin")||($rol=="Admin Web"))) 
		{
			$list = $this->mod_transaksi->get_datatables_voucher();
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
		      	$row[] = $l->jenis;
                $row[] = number_format($l->harga);
                
                if($l->jenis=="Publik")
                {
                    $row[] = "Publik";
                }else{
                    $row[] = $l->namauser;
                }
		      	
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

                if($l->kategori=="Voucher"){
                    $row[] = "<button class='btn btn-success btn-sm' onclick=selesaiTransVoucher('".$l->idtransaksi."')>Selesai & Kirim Voucher</button>
                    <button class='btn btn-danger btn-sm' onclick=hapusData('".$l->idtransaksi."')>Hapus</button>";
                }else{
                    $row[] = "<button class='btn btn-success btn-sm' onclick=selesaiTrans('".$l->idtransaksi."')>Selesai</button>
                            <button class='btn btn-danger btn-sm' onclick=hapusData('".$l->idtransaksi."')>Hapus</button>";
                }

                  
		      	$data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_transaksi->count_all_voucher(),
		     "recordsFiltered" => $this->mod_transaksi->count_filtered_voucher(),
		     "data" => $data,
		    );
		    echo json_encode($output);
		}else{
			redirect('keluar');
		}
    }
    public function datalisthistory()
    {
        $logged = $this->session->userdata("logged_in");
		$rol = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		if (($status!="")&&($logged == "yes")&&(($rol=="Superadmin")||($rol=="Admin Web"))) 
		{
			$list = $this->mod_transaksihistory->get_datatables();
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->tanggalf;
		      	$row[] = $l->gamename;
		      	$row[] = $l->productname;
		      	$row[] = $l->akun;
		      	$row[] = $l->zone." ".$l->server;
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
                $row[] = "<a href='".base_url()."transaksi/detailtransaksi/".$l->idtransaksi."' class='btn btn-success btn-sm'>Detail Transaksi</a>
                <button class='btn btn-danger btn-sm' onclick='hapusData(".$l->idtransaksi.")'><i class='fa fa-trash'></i> Hapus</button>";
                $data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_transaksihistory->count_all(),
		     "recordsFiltered" => $this->mod_transaksihistory->count_filtered(),
		     "data" => $data,
		    );
		    echo json_encode($output);
		}else{
			redirect('keluar');
		}
    }
    public function datalistpayment()
    {
        $logged = $this->session->userdata("logged_in");
		$rol = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		if (($status!="")&&($logged == "yes")&&(($rol=="Superadmin")||($rol=="Admin Web"))) 
		{
            $idtransaksi = $this->input->post("id");
            // $dttrans = $this->mod_transaksi->listing_join(array('transaksi.idtransaksi'=>$idtransaksi));
            // foreach($dttrans as $t){
            //     $trx_id = $t->trx_id;
            // }
			$list = $this->mod_transaksipayment->get_datatables($idtransaksi);
		    $data = array();
		    $no = $_POST['start'];
		    foreach ($list as $l) {
			  	$no++;
		      	$row = array();
		      	$row[] = $no;
		      	$row[] = $l->tanggalf;
                if($l->status=="pending"){
                    $row[] = "<label class='label label-warning'>Belum Bayar</label>";
                }else if($l->status=="berhasil")
                {
                    $row[] = "<label class='label label-success'>Sudah Bayar</label>";
                }else if($l->status=="Selesai"){
                    $row[] = "<label class='label label-info'>Selesai</label>";
                }else{
                    $row[] = "<label class='label label-danger'>Error/Testing</label>";
                }
                $data[] = $row;
		    }
		    $output = array(
		     "draw" => $_POST['draw'],
		     "recordsTotal" => $this->mod_transaksipayment->count_all($idtransaksi ),
		     "recordsFiltered" => $this->mod_transaksipayment->count_filtered($idtransaksi ),
		     "data" => $data,
		    );
		    echo json_encode($output);
		}else{
			redirect('keluar');
		}
        
    }
    public function errortrans()
    {
        $idadmin = $this->session->userdata("id");
        $idtransaksi = $this->input->post("id");
        $dttrans = $this->mod_transaksi->listing_join(array('transaksi.idtransaksi'=>$idtransaksi));
        foreach($dttrans as $t){
            $trx_id = $t->trx_id;
        }
        $datains["trx_id"]=$trx_id;
        $datains["tanggal"]=date('Y-m-d H:i:s');
        $datains["status"]="Error";
        $datains["idtransaksi"]=$idtransaksi;
        if($this->mod_conf->InsertData("transaksi_status",$datains))
        {
            $where["idtransaksi"]=$idtransaksi;
            $dataup["status"]="Error";
            $dataup["idadmin"]=$idadmin;
            if($this->mod_conf->UpdateData("transaksi",$dataup,$where)){
                $output["hasil"]=1;
            }
        }else{
            $output["hasil"]=0;
        }
        echo json_encode($output);
    }
    public function selesaitrans()
    {
        $iduser="";
        $idadmin = $this->session->userdata("id");
        $idtransaksi = $this->input->post("id");
        $dttrans = $this->mod_transaksi->listing_join(array('transaksi.idtransaksi'=>$idtransaksi));
        foreach($dttrans as $t){
            $email = $t->email;
            $idproduk = $t->idproduk;
            $iduser = $t->iduser;
            $gamename = $t->gamename;
            $productname = $t->productname;
            $payment=$t->payment;
            $jumlah=$t->jumlah;
            $trx_id = $t->trx_id;
            $akun = $t->akun;
            $zona = $t->zone;
            $harga = $t->harga;
            $message = "<p>Pembelian anda telah diproses dengan detail sebagai berikut:<br>Game : ".$gamename."<br> Nominal Top Up : ".$productname."<br> Akun : ".$akun."<br> Zona :".$zona."</p>";
        }
        if($payment=="BCA")
        {

            $this->db->trans_start();
            $wherekode["kode"]=$trx_id;
            $wherekode["transaksi"]="Produk";
            $dataupdatekode["status"]="1";
            $this->mod_conf->UpdateData("kodeunik",$dataupdatekode,$wherekode);
            
            $kode=$this->mod_transaksi->getKode($idtransaksi);
            $via=$this->mod_transaksi->getVia($idtransaksi);
            $idproduk=$this->mod_transaksi->getIdProduk($idtransaksi);
            $jenis=$this->mod_transaksi->getJenis($idtransaksi);

            $dataproduct = $this->mod_product->listing(array("idproduct"=>$idproduk));
            foreach($dataproduct as $dp)
            {
                $modal = $dp->harga_dasar;
                $jual = $dp->harga_jual;
                $reseller = $dp->harga_reseller;
            }
            $datadet["kode"]=$kode;
            $datadet["via"]="BCA";
            if($jenis=="Reseller")
            {
                $datadet["harga"]=$reseller;
                $untung=$reseller-$modal;
            }else{
                $datadet["harga"]=$jual;
                $untung=$jual-$modal;
            }
            $datadet["modal"]=$modal;
            $datadet["untung"]=$untung;
            $datadet["tanggal"]=date('Y-m-d h:i:s');
            $datadet["jenis"]=$jenis;
            $this->mod_conf->InsertData("transaksi_detail",$datadet);
            $this->db->trans_complete();

        }
        $datains["trx_id"]=$trx_id;
        $datains["tanggal"]=date('Y-m-d H:i:s');
        $datains["status"]="Selesai";
        $datains["idtransaksi"]=$idtransaksi;
        if($this->mod_conf->InsertData("transaksi_status",$datains))
        {
            $where["idtransaksi"]=$idtransaksi;
            $dataup["status"]="Selesai";
            $dataup["idadmin"]=$idadmin;
            if($this->mod_conf->UpdateData("transaksi",$dataup,$where)){
                $output["hasil"]=1;
            }
        }else{
            $output["hasil"]=0;
        }
        
        if($iduser!=""){
            $wharr = array("idapp"=>"13","item"=>"point");
            $dt=$this->mod_app->listing($wharr);
            foreach($dt as $d){
                $point = $d->val;
            }
            $jumlahpoint = $harga/$point;
            $datapoint["idtransaksi"]=$idtransaksi;
            $datapoint["iduser"]=$iduser;
            $datapoint["point"]=$jumlahpoint;
            $datapoint["jenis"]="Debet";
            $datapoint["tanggal"]=date('Y-m-d h:i:s');
            $this->mod_conf->InsertData("point",$datapoint);
        }
        

        $output["email"]=$email;
        $output["message"]=$message;
        echo json_encode($output);
        // $this->sendEmail($email,$message);
    }
    public function kirimemail()
    {
        $email = $this->input->post("email");
        $message = $this->input->post("message");
        $this->sendEmail($email,$message);
    }
    public function selesaikirim()
    {
        $iduser="";
        $idadmin = $this->session->userdata("id");
        $idtransaksi = $this->input->post("id");
        $dttrans = $this->mod_transaksi->listing_join(array('transaksi.idtransaksi'=>$idtransaksi));
        foreach($dttrans as $t){
            $email = $t->email;
            $idproduk = $t->idproduk;
            $iduser = $t->iduser;
            $gamename = $t->gamename;
            $productname = $t->productname;
            $payment=$t->payment;
            $jumlah=$t->jumlah;
            $trx_id = $t->trx_id;
            $akun = $t->akun;
            $zona = $t->zone;
            $harga = $t->harga;
            $kurir = $this->input->post("kurir");
            $noresi = $this->input->post("noresi");
            $message = "<p>Pembelian anda telah diproses dengan detail sebagai berikut:<br>Game : ".$gamename."<br> Nama Produk : ".$productname."<br> Jumlah : ".$jumlah."<br> Pengiriman :".$kurir." ".$noresi."</p>";
        }
        if($payment=="BCA")
        {

            $this->db->trans_start();
            $wherekode["kode"]=$trx_id;
            $wherekode["transaksi"]="Produk";
            $dataupdatekode["status"]="1";
            $this->mod_conf->UpdateData("kodeunik",$dataupdatekode,$wherekode);
            
            $kode=$this->mod_transaksi->getKode($idtransaksi);
            $via=$this->mod_transaksi->getVia($idtransaksi);
            $idproduk=$this->mod_transaksi->getIdProduk($idtransaksi);
            $jenis=$this->mod_transaksi->getJenis($idtransaksi);

            $dataproduct = $this->mod_product->listing(array("idproduct"=>$idproduk));
            foreach($dataproduct as $dp)
            {
                $modal = $dp->harga_dasar;
                $jual = $dp->harga_jual;
                $reseller = $dp->harga_reseller;
            }
            $datadet["kode"]=$kode;
            $datadet["via"]="BCA";
            if($jenis=="Reseller")
            {
                $datadet["harga"]=$reseller;
                $untung=$reseller-$modal;
            }else{
                $datadet["harga"]=$jual;
                $untung=$jual-$modal;
            }
            $datadet["modal"]=$modal;
            $datadet["untung"]=$untung;
            $datadet["tanggal"]=date('Y-m-d h:i:s');
            $datadet["jenis"]=$jenis;
            $this->mod_conf->InsertData("transaksi_detail",$datadet);
            $this->db->trans_complete();

        }
        $datains["trx_id"]=$trx_id;
        $datains["tanggal"]=date('Y-m-d H:i:s');
        $datains["status"]="Selesai";
        $datains["idtransaksi"]=$idtransaksi;
        if($this->mod_conf->InsertData("transaksi_status",$datains))
        {
            $where["idtransaksi"]=$idtransaksi;
            $dataup["status"]="Selesai";
            $dataup["idadmin"]=$idadmin;
            $dataup["kurir"]=$this->input->post("kurir");
            $dataup["resi"]=$this->input->post("noresi");
            if($this->mod_conf->UpdateData("transaksi",$dataup,$where)){
                $output["hasil"]=1;
            }
        }else{
            $output["hasil"]=0;
        }
        
        if($iduser!=""){
            $wharr = array("idapp"=>"13","item"=>"point");
            $dt=$this->mod_app->listing($wharr);
            foreach($dt as $d){
                $point = $d->val;
            }
            $jumlahpoint = $harga/$point;
            $datapoint["idtransaksi"]=$idtransaksi;
            $datapoint["iduser"]=$iduser;
            $datapoint["point"]=$jumlahpoint;
            $datapoint["jenis"]="Debet";
            $datapoint["tanggal"]=date('Y-m-d h:i:s');
            $this->mod_conf->InsertData("point",$datapoint);
        }
        

        echo json_encode($output);
        $this->sendEmail($email,$message);
    }
    public function selesaitransvoucher()
    {
        $iduser="";
        $idadmin = $this->session->userdata("id");
        $idtransaksi = $this->input->post("id");
        $dttrans = $this->mod_transaksi->listing_voucher(array('transaksi.idtransaksi'=>$idtransaksi));
        foreach($dttrans as $t){
            $email = $t->email;
            $idproduk = $t->idproduk;
            $iduser = $t->iduser;
            $gamename = $t->gamename;
            $productname = $t->vouchername;
            $payment=$t->payment;
            $jumlah=$t->jumlah;
            $kategori=$t->kategori;
            $trx_id = $t->trx_id;
            $akun = $t->akun;
            $zona = $t->zone;
            $harga = $t->harga;
            
        }
        $reqvoucher = $this->mod_voucherstok->listingvoucher(array("idvoucher"=>$idproduk,"status"=>"Pesan"),$jumlah);
        $jumlahstok = $this->mod_voucher->getstokvoucher(array("idvoucher"=>$idproduk));
        $kodevoucher="";
        if(count($reqvoucher)>0){
            foreach($reqvoucher as $rv){
                $kodevoucher .= $rv->kode.",";
                $idstokvoucher = $rv->idvoucherstok;
                $dataupdatestok["status"]="Terjual";
                $whereupdatestok["idvoucherstok"]=$idstokvoucher;
                $this->mod_conf->UpdateData("voucher_stok",$dataupdatestok,$whereupdatestok);
            }
            $message = "<p>Pembelian anda telah diproses dengan detail sebagai berikut:<br>Game : ".$gamename."<br> Voucher : ".$productname."<br> <b>Kode Voucher : ".substr($kodevoucher,0,-1)."</b></p>";
            $this->sendEmail($email,$message);
            $statsendvoucher=true;
        }else{
            $statsendvoucher=false;
        }
        
       
        if($payment=="BCA")
        {

            $this->db->trans_start();
            $wherekode["kode"]=$trx_id;
            $wherekode["transaksi"]="Produk";
            $dataupdatekode["status"]="1";
            $this->mod_conf->UpdateData("kodeunik",$dataupdatekode,$wherekode);
            
            $kode=$this->mod_transaksi->getKode($idtransaksi);
            $via=$this->mod_transaksi->getVia($idtransaksi);
            $idproduk=$this->mod_transaksi->getIdProduk($idtransaksi);
            $jenis=$this->mod_transaksi->getJenis($idtransaksi);


            if($kategori=="Voucher"){
                $dataproduct = $this->mod_voucher->listing(array("idvoucher"=>$idproduk));
                foreach($dataproduct as $dp)
                {
                    $modal = $dp->harga_dasar;
                    $jual = $dp->harga_jual;
                    $reseller = $dp->harga_reseller;
                }
                $datadet["kode"]=$kode;
                $datadet["via"]="BCA";
                if($jenis=="Reseller")
                {
                    $datadet["harga"]=$reseller;
                    $untung=$reseller-$modal;
                }else{
                    $datadet["harga"]=$jual;
                    $untung=$jual-$modal;
                }
            }else{
                $dataproduct = $this->mod_product->listing(array("idproduct"=>$idproduk));
                foreach($dataproduct as $dp)
                {
                    $modal = $dp->harga_dasar;
                    $jual = $dp->harga_jual;
                    $reseller = $dp->harga_reseller;
                }
                $datadet["kode"]=$kode;
                $datadet["via"]="BCA";
                if($jenis=="Reseller")
                {
                    $datadet["harga"]=$reseller;
                    $untung=$reseller-$modal;
                }else{
                    $datadet["harga"]=$jual;
                    $untung=$jual-$modal;
                }
            }
            
            $datadet["modal"]=$modal;
            $datadet["untung"]=$untung;
            $datadet["tanggal"]=date('Y-m-d h:i:s');
            $datadet["jenis"]=$jenis;
            $this->mod_conf->InsertData("transaksi_detail",$datadet);
            $this->db->trans_complete();

        }
        $datains["trx_id"]=$trx_id;
        $datains["tanggal"]=date('Y-m-d H:i:s');
        $datains["status"]="Selesai";
        $datains["idtransaksi"]=$idtransaksi;
        if($this->mod_conf->InsertData("transaksi_status",$datains))
        {
            $where["idtransaksi"]=$idtransaksi;
            $dataup["status"]="Selesai";
            $dataup["idadmin"]=$idadmin;
            $this->mod_conf->UpdateData("transaksi",$dataup,$where);
        }
        
        if($iduser!=""){
            $wharr = array("idapp"=>"13","item"=>"point");
            $dt=$this->mod_app->listing($wharr);
            foreach($dt as $d){
                $point = $d->val;
            }
            $jumlahpoint = $harga/$point;
            $datapoint["idtransaksi"]=$idtransaksi;
            $datapoint["iduser"]=$iduser;
            $datapoint["point"]=$jumlahpoint;
            $datapoint["jenis"]="Debet";
            $datapoint["tanggal"]=date('Y-m-d h:i:s');
            $this->mod_conf->InsertData("point",$datapoint);
        }
        
        if($statsendvoucher)
        {
            $output["hasil"]=1;
        }else{
            $output["hasil"]=0;
        }
        echo json_encode($output);
        
    }
    public function datadetailtransaksi()
    {
        $idtransaksi = $this->input->post("id");
        $dttrans = $this->mod_transaksi->listing_join(array('transaksi.idtransaksi'=>$idtransaksi));
        $X = array('hasildata'=>$dttrans);               
		echo json_encode($X);  
    }
    public function detailtransaksi($idtrans)
    {
        $logged = $this->session->userdata("logged_in");
		$rol = $this->session->userdata("rol");
		if (($logged == "yes")&&(($rol=="Superadmin")||($rol=="Admin Web"))) {
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
            $data["idtrans"] = $idtrans;
			// $data["rightmenu"] = $tmplt["rightmenu"];
			$this->load->view("content/transaksidetail", $data);
		} else {
			redirect('keluar');
		}
    }
    public function potonhsaldo()
    {
        $rol = $this->session->userdata("rol");
        if($rol=="Reseller")
        {
            $jenis="Reseller";
        }else{
            $jenis="Publik";
        }
        

        $email=$this->input->post("email");
        $amount=$this->input->post("amount");
        $idgame=$this->input->post("idgame");
        $idproduct=$this->input->post("idproduct");
        $akun=$this->input->post("akun");
        $zone=$this->input->post("zone");
        $server=$this->input->post("server");
        $iduser=$this->input->post("iduser");

        
        $payment="Potong saldo";
        
        $referenceId=date('YmdHis');

        $datains["tanggal"]= date('Y-m-d H:i:s');
        $datains["kode"]=$referenceId;
        $datains["idgame"]=$idgame;
        $datains["idproduk"]=$idproduct;
        $datains["harga"]=$amount;
        $datains["payment"]=$payment;
        $datains["email"]=$email;
        $datains["url"]="-";
        $datains["trx_id"]="-";
        $datains["kategori"]="Top Up";
        $datains["akun"]=$akun;
        $datains["zone"]=$zone;
        $datains["server"]=$server;
        $datains["jenis"]=$jenis;
        $datains["status"]="Sudah Bayar";
        $datains["iduser"]=$iduser;
        $this->db->trans_start();
        $trans = $this->mod_conf->InsertData("transaksi",$datains);

        $datauser = $this->mod_user->listing(array("iduser"=>$iduser));
        foreach($datauser as $u){
            $email =$u->email;
            $saldo =$u->saldo;
        }

        if($saldo<$amount)
        {
            $output['hasil']=0;
            $output['pesan']='Transaksi berhasil';  
        }else{
            $where["iduser"]=$iduser;
            $dataup["saldo"]=$saldo-$amount;
            $this->mod_conf->UpdateData("user",$dataup,$where);
    
            $jenis="Reseller";
            $dataproduct = $this->mod_product->listing(array("idproduct"=>$idproduct));
            foreach($dataproduct as $dp)
            {
                $modal = $dp->harga_dasar;
                $jual = $dp->harga_jual;
                $reseller = $dp->harga_reseller;
            }
            $datadet["kode"]=$referenceId;
            $datadet["via"]=$payment;
            if($jenis=="Reseller")
            {
                $datadet["harga"]=$reseller;
                $untung=$reseller-$modal;
            }else{
                $datadet["harga"]=$jual;
                $untung=$jual-$modal;
            }
            $datadet["modal"]=$modal;
            $datadet["untung"]=$untung;
            $datadet["tanggal"]=date('Y-m-d h:i:s');
            $datadet["jenis"]=$jenis;
            $this->mod_conf->InsertData("transaksi_detail",$datadet);
            
    
            if($trans){
                $output['hasil']=1;
                $output['pesan']='Transaksi berhasil';  
            }else{
                $output['hasil']=0;
                $output['pesan']='Transaksi gagal';  
            }
    
            $this->db->trans_complete();
        }

        
        echo json_encode($output);  
    }
    public function qris()
    {
        $name=$this->input->post("name");
        $phone=$this->input->post("phone");
        $email=$this->input->post("email");
        $amount=$this->input->post("amount");
        $notifyUrl=$this->input->post("notifyUrl");
        $iduser=$this->input->post('iduser');
        $referenceId=date('YmdHis');
        $apikey = $this->mod_app->getAPIIPAYMU();
        $apiurl = $this->mod_app->getURLQRISIPAYMU();
        $va_from_web = $this->mod_app->getVAIPAYMU();
        $idgame=$this->input->post("idgame");
        $idproduct=$this->input->post("idproduct");
        $akun=$this->input->post("akun");
        $zone=$this->input->post("zone");
        $jumlah=$this->input->post("jumlah");
        $server=$this->input->post("server");
        $jenis=$this->input->post("jenis");
        if(!empty($idgame)){
            $namagame = $this->mod_game->getName($idgame);
        }else{
            $namagame ="";
        }
        if(!empty($idproduct))
        {
            $namaproduct = $this->mod_product->getName($idproduct);
        }else{
            $namaproduct ="";
        }
        $va           = $va_from_web; //get on iPaymu dashboard
        $secret       = $apikey; //get on iPaymu dashboard
    
        $url          = 'https://my.ipaymu.com/api/v2/payment/direct'; //url
        $method       = 'POST'; //method
    
        // //Request Body//
        $body['name'] = $name;
        $body['phone'] = "082160716903";
        $body['email'] = $email;
        $body['amount'] = $amount;
        $body['notifyUrl'] = $notifyUrl;
        $body['expired'] = '24';
        $body['expiredType'] = 'hours';
        // $body['comments'] = 'Catatan';
        $body['referenceId'] = $referenceId;
        $body['paymentMethod'] = 'qris';
        $body['paymentChannel'] = 'qris';
        $body['product'] = array($namagame."-".$namaproduct);
        $body['qty'] = array('1');
        $body['price'] = array($amount);
        $body['weight'] = array('1');
        $body['width'] = array('1');
        $body['height'] = array('1');
        $body['length'] = array('1');
        // $body['deliveryArea'] = '76111';
        // $body['deliveryAddress'] = 'Denpasar';
        // //End Request Body//
    
        //Generate Signature
        // *Don't change this
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $secret;
        $signature    = hash_hmac('sha256', $stringToSign, $secret);
        $timestamp    = Date('YmdHis');
        //End Generate Signature
    
    
        $ch = curl_init($url);

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'va: ' . $va,
            'signature: ' . $signature,
            'timestamp: ' . $timestamp
        );

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, count($body));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);
        if($err) {
            echo $err;
        } else {
            $ret = json_decode($ret);
            if($ret->Status == 200) {
                // print_r($ret);
                $status = $ret->Status;
                $message = $ret->Message;
                $sessionId = $ret->Data->SessionId;
                $trx_id = $ret->Data->TransactionId;
                $referenceId = $ret->Data->ReferenceId;
                $via = $ret->Data->Via;
                $channel = $ret->Data->Channel;
                $paymentNo = $ret->Data->PaymentNo;
                $qrString = $ret->Data->QrString;
                $paymentName = $ret->Data->PaymentName;
                $total = $ret->Data->Total;
                $fee = $ret->Data->Fee;
                $expired = $ret->Data->Expired;
                $qrImage = $ret->Data->QrImage; 
                $qrTemplate = $ret->Data->QrTemplate;
                
                $datares[] = array(
                    "status"=>$status,
                    "pesan"=>$message,
                    "ReferenceId"=>$referenceId,
                    "QrImage"=>$qrImage,
                    "QrTemplate"=>$qrTemplate,
                    "trx_id"=>$trx_id,
                    "total"=>$total,
                    "Expired"=>$expired,
                    "Via"=>$via,
                    "Total"=>$total,
                );
                $this->db->trans_start();
                $datains["tanggal"]= date('Y-m-d H:i:s');
                $datains["kode"]=$referenceId;
                $datains["idgame"]=$idgame;
                $datains["idproduk"]=$idproduct;
                $datains["harga"]=$amount;
                $datains["payment"]=$via;
                $datains["email"]=$email;
                $datains["jumlah"]=$jumlah;
                $datains["url"]=$qrTemplate;
                $datains["trx_id"]=$trx_id;
                $datains["akun"]=$akun;
                $datains["zone"]=$zone;
                $datains["kategori"]="Top Up";
                $datains["server"]=$server;
                $datains["status"]="Belum Bayar";
                $datains["jenis"]=$jenis;
                $datains["iduser"]=$iduser;
                $this->mod_conf->InsertData("transaksi",$datains);

                $this->db->trans_complete();
                echo json_encode($datares);
            } else {
                print_r($ret);
            }
    }
        

    // $va_from_web = "1179001231534620";
    // $apikey = "3EFF4444-7D58-440A-AC34-D8907A88A7E2";

    }
    public function qris_voucher()
    {
        $name=$this->input->post("name");
        $phone=$this->input->post("phone");
        $email=$this->input->post("email");
        $amount=$this->input->post("amount");
        $jumlah=$this->input->post("jumlah");
        $notifyUrl=$this->input->post("notifyUrl");
        $iduser=$this->input->post('iduser');
        $referenceId=date('YmdHis');
        $apikey = $this->mod_app->getAPIIPAYMU();
        $apiurl = $this->mod_app->getURLQRISIPAYMU();
        $idgame=$this->input->post("idgame");
        $idproduct=$this->input->post("idproduct");
        $jenis=$this->input->post("jenis");
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

        $this->db->trans_start();
        $datains["tanggal"]= date('Y-m-d H:i:s');
        $datains["kode"]=$referenceId;
        $datains["kategori"]="Voucher";
        $datains["jumlah"]=$jumlah;
        $datains["idgame"]=$idgame;
        $datains["idproduk"]=$idproduct;
        $datains["harga"]=$amount;
        $datains["payment"]=$Via;
        $datains["email"]=$email;
        $datains["url"]=$QrTemplate;
        $datains["trx_id"]=$trx_id;
        $datains["status"]="Belum Bayar";
        $datains["jenis"]=$jenis;
        $datains["iduser"]=$iduser;
        $this->mod_conf->InsertData("transaksi",$datains);

        $reqvoucher = $this->mod_voucherstok->listingvoucher(array("idvoucher"=>$idproduct,"status"=>"Aktif"),$jumlah);
        $jumlahstok = $this->mod_voucher->getstokvoucher(array("idvoucher"=>$idproduct));
        $kodevoucher="";
        if(count($reqvoucher)>0){
            foreach($reqvoucher as $rv){
                $idstokvoucher = $rv->idvoucherstok;
                $dataupdatestok["status"]="Pesan";
                $dataupdatestok["tanggal"]=date('Y-m-d H:i:s');
                $dataupdatevoucher["stok"]=$jumlahstok-count($reqvoucher);
                $whereupdatestok["idvoucherstok"]=$idstokvoucher;
                $whereupdatevoucher["idvoucher"]=$idproduct;
                $this->mod_conf->UpdateData("voucher_stok",$dataupdatestok,$whereupdatestok);
                $this->mod_conf->UpdateData("voucher",$dataupdatevoucher,$whereupdatevoucher);
            }
           $statsendvoucher=true;
        }else{
            $statsendvoucher=false;
        }
        

        $this->db->trans_complete();
        echo json_encode($datares);

    }
    public function modal()
    {
        $jual = $this->mod_product->getJual("3");
        echo $jual;
    }
    public function qris_dev()
    {
        $name=$this->input->post("name");
        $phone=$this->input->post("phone");
        $email=$this->input->post("email");
        $amount=$this->input->post("amount");
        $notifyUrl=$this->input->post("notifyUrl");
        $referenceId=date('YmdHis');
        $apikey = $this->mod_app->getAPIIPAYMU();
        $apiurl = $this->mod_app->getURLQRISIPAYMU();
        $idgame=$this->input->post("idgame");
        $idproduct=$this->input->post("idproduct");
        $akun=$this->input->post("akun");
        $zone=$this->input->post("zone");
        $server=$this->input->post("server");
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
        $tanggal =  date('Y-m-d H:i:s');
        $datains["tanggal"]= date('Y-m-d H:i:s');
        $datains["kode"]=$referenceId;
        $datains["idgame"]=$idgame;
        $datains["idproduk"]=$idproduct;
        $datains["harga"]=$amount;
        $datains["payment"]=$Via;
        $datains["email"]=$email;
        $datains["url"]=$QrTemplate;
        $datains["trx_id"]=$trx_id;
        $datains["akun"]=$akun;
        $datains["zone"]=$zone;
        $datains["server"]=$server;
        $datains["status"]="Belum Bayar";
        $this->mod_conf->InsertData("transaksi",$datains);

        $datadet["kode"]=$referenceId;
        $datadet["via"]=$Via;
        $datadet["via"]=$Via;
        
        echo json_encode($datares);
        
    }
    public function unotify_voucher()
    {
        $trx_id =$this->input->post("trx_id");
        $idtransaksi = $this->mod_transaksi->getIdByTrx($trx_id);
		$datains["tanggal"] = date('Y-m-d H:i:s');
        $datains["trx_id"] = $this->input->post("trx_id");
		$datains["sid"] = $this->input->post("sid");
        $datains["status"] = $this->input->post("status");
        $datains["idtransaksi"]=$idtransaksi;
        $this->mod_conf->InsertData("transaksi_status",$datains);
        $status=$this->input->post("status");
        if($status=="berhasil"){
            $this->db->trans_start();
            $where["idtransaksi"]=$idtransaksi;
            $dataups["status"] = "Sudah Bayar";
            $this->mod_conf->UpdateData("transaksi",$dataups,$where);

            $kode=$this->mod_transaksi->getKode($idtransaksi);
            $via=$this->mod_transaksi->getVia($idtransaksi);
            $idproduk=$this->mod_transaksi->getIdProduk($idtransaksi);
            $jenis=$this->mod_transaksi->getJenis($idtransaksi);
            $dataproduct = $this->mod_voucher->listing(array("idvoucher"=>$idproduk));
            foreach($dataproduct as $dp)
            {
                $modal = $dp->harga_dasar;
                $jual = $dp->harga_jual;
                $reseller = $dp->harga_reseller;
            }
            $datadet["kode"]=$kode;
            $datadet["via"]=$via;
            if($jenis=="Reseller")
            {
                $datadet["harga"]=$reseller;
                $untung=$reseller-$modal;
            }else{
                $datadet["harga"]=$jual;
                $untung=$jual-$modal;
            }
            $datadet["modal"]=$modal;
            $datadet["untung"]=$untung;
            $datadet["tanggal"]=date('Y-m-d h:i:s');
            $datadet["jenis"]=$jenis;
            $this->mod_conf->InsertData("transaksi_detail",$datadet);
            $this->db->trans_complete();
        }
    }
    public function unotify()
    {
        $trx_id =$this->input->post("trx_id");
        $idtransaksi = $this->mod_transaksi->getIdByTrx($trx_id);
		$datains["tanggal"] = date('Y-m-d H:i:s');
        $datains["trx_id"] = $this->input->post("trx_id");
		$datains["sid"] = $this->input->post("sid");
        $datains["status"] = $this->input->post("status");
        $datains["idtransaksi"]=$idtransaksi;
        $this->mod_conf->InsertData("transaksi_status",$datains);
        $status=$this->input->post("status");
        if($status=="berhasil"){
            $this->db->trans_start();
            $where["idtransaksi"]=$idtransaksi;
            $dataups["status"] = "Sudah Bayar";
            $this->mod_conf->UpdateData("transaksi",$dataups,$where);

            $kode=$this->mod_transaksi->getKode($idtransaksi);
            $via=$this->mod_transaksi->getVia($idtransaksi);
            $idproduk=$this->mod_transaksi->getIdProduk($idtransaksi);
            $jenis=$this->mod_transaksi->getJenis($idtransaksi);
            $dataproduct = $this->mod_product->listing(array("idproduct"=>$idproduk));
            foreach($dataproduct as $dp)
            {
                $modal = $dp->harga_dasar;
                $jual = $dp->harga_jual;
                $reseller = $dp->harga_reseller;
            }
            $datadet["kode"]=$kode;
            $datadet["via"]=$via;
            if($jenis=="Reseller")
            {
                $datadet["harga"]=$reseller;
                $untung=$reseller-$modal;
            }else{
                $datadet["harga"]=$jual;
                $untung=$jual-$modal;
            }
            $datadet["modal"]=$modal;
            $datadet["untung"]=$untung;
            $datadet["tanggal"]=date('Y-m-d h:i:s');
            $datadet["jenis"]=$jenis;
            $this->mod_conf->InsertData("transaksi_detail",$datadet);
            $this->db->trans_complete();
        }
    }
    public function unotifycstore()
    {
        $trx_id =$this->input->post("trx_id");
        $idtransaksi = $this->mod_transaksi->getIdByTrx($trx_id);
		$datains["tanggal"] = date('Y-m-d H:i:s');
        $datains["trx_id"] = $this->input->post("trx_id");
		$datains["sid"] = $this->input->post("sid");
        $datains["status"] = $this->input->post("status");
        $datains["idtransaksi"]=$idtransaksi;
        $this->mod_conf->InsertData("transaksi_status",$datains);
        $status=$this->input->post("status");
        if($status=="berhasil"){
            
            $this->db->trans_start();
            $where["idtransaksi"]=$idtransaksi;
            $dataups["status"] = "Sudah Bayar";
            $this->mod_conf->UpdateData("transaksi",$dataups,$where);

            $kode=$this->mod_transaksi->getKode($idtransaksi);
            $via=$this->mod_transaksi->getVia($idtransaksi);
            $idproduk=$this->mod_transaksi->getIdProduk($idtransaksi);
            $jenis=$this->mod_transaksi->getJenis($idtransaksi);

            $dataproduct = $this->mod_product->listing(array("idproduct"=>$idproduk));
            foreach($dataproduct as $dp)
            {
                $modal = $dp->harga_dasar;
                $jual = $dp->harga_jual;
                $reseller = $dp->harga_reseller;
            }
            $datadet["kode"]=$kode;
            $datadet["via"]="BRI";
            if($jenis=="Reseller")
            {
                $datadet["harga"]=$reseller;
                $untung=$reseller-$modal;
            }else{
                $datadet["harga"]=$jual;
                $untung=$jual-$modal;
            }
            $datadet["modal"]=$modal;
            $datadet["untung"]=$untung;
            $datadet["tanggal"]=date('Y-m-d h:i:s');
            $datadet["jenis"]=$jenis;
            $this->mod_conf->InsertData("transaksi_detail",$datadet);
            $this->db->trans_complete();
        }
    }
    public function bcatransfer()
    {
        $name=$this->input->post("name");
        $phone=$this->input->post("phone");
        $email=$this->input->post("email");
        $amount=$this->input->post("amount");
        $notifyUrl=$this->input->post("notifyUrl");
        $referenceId=date('YmdHis');
        $apikey = $this->mod_app->getAPIIPAYMU();
        $apiurl = $this->mod_app->getURLBCAIPAYMU();
        $idgame=$this->input->post("idgame");
        $idproduct=$this->input->post("idproduct");
        $akun=$this->input->post("akun");
        $zone=$this->input->post("zone");
        $server=$this->input->post("server");
        $jenis=$this->input->post("jenis");
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
                'amount' => $amount,
                'uniqid' => $referenceId,
                'notifyUrl' => $notifyUrl,
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'zipCode' => '-',
                'city' => '-'),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
       
        $arr = json_decode($response);
        $status =$arr->Status;
        $message =$arr->Message;
        $ReferenceId =$arr->Data->ReferenceId;
        $Channel =$arr->Data->Channel;
        $PaymentNo =$arr->Data->PaymentNo;
        $trx_id =$arr->Data->TransactionId;
        $total =$arr->Data->Total;
        $Expired =$arr->Data->Expired;
        $Via =$arr->Data->Via;
        $Total =$arr->Data->Total;
        
        $datares[] = array(
            "status"=>$status,
            "pesan"=>$message,
            "trx_id"=>$trx_id,
            "Via"=>$Via,
            "Channel"=>$Channel,
            "PaymentNo"=>$PaymentNo,
            "Total"=>$Total,
            "Expired"=>$Expired,
        );
        $datains["tanggal"]= date('Y-m-d H:i:s');
        $datains["kode"]=$referenceId;
        $datains["idgame"]=$idgame;
        $datains["idproduk"]=$idproduct;
        $datains["harga"]=$Total;
        $datains["payment"]=$Via." ".$Channel;
        $datains["email"]=$email;
        //$datains["url"]=$QrTemplate;
        $datains["trx_id"]=$trx_id;
        $datains["akun"]=$akun;
        $datains["zone"]=$zone;
        $datains["server"]=$server;
        $datains["status"]="Belum Bayar";
        $datains["jeni"]=$jenis;
        $this->mod_conf->InsertData("transaksi",$datains);

        echo json_encode($datares);
    }
    public function cstore()
    {
        $this->db->trans_start();
        $kategori = $this->input->post("kategori");
        $jumlah=$this->input->post("jumlah");
        $idproduct=$this->input->post("idproduct");
        if($kategori==""||empty($kategori))
        {
            $kategori = "Top Up";
        }else{

            $kategori = "Voucher";
            $reqvoucher = $this->mod_voucherstok->listingvoucher(array("idvoucher"=>$idproduct,"status"=>"Aktif"),$jumlah);
            $jumlahstok = $this->mod_voucher->getstokvoucher(array("idvoucher"=>$idproduct));
            $kodevoucher="";
            if(count($reqvoucher)>0){
                foreach($reqvoucher as $rv){
                    $idstokvoucher = $rv->idvoucherstok;
                    $dataupdatestok["status"]="Pesan";
                    $dataupdatestok["tanggal"]=date('Y-m-d H:i:s');
                    $dataupdatevoucher["stok"]=$jumlahstok-count($reqvoucher);
                    $whereupdatestok["idvoucherstok"]=$idstokvoucher;
                    $whereupdatevoucher["idvoucher"]=$idproduct;
                    $this->mod_conf->UpdateData("voucher_stok",$dataupdatestok,$whereupdatestok);
                    $this->mod_conf->UpdateData("voucher",$dataupdatevoucher,$whereupdatevoucher);
                }
                $statsendvoucher=true;
            }else{
                $statsendvoucher=false;
            }
            
        }
        if($jumlah==""||empty($jumlah))
        {
            $jumlah = "0";
        }else{

            $jumlah = $jumlah;
        }
        
        
        $channel=$this->input->post("channel");
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
        $idgame=$this->input->post("idgame");
        $akun=$this->input->post("akun");
        $zone=$this->input->post("zone");
        $server=$this->input->post("server");
        $jenis=$this->input->post("jenis");
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
                'channel' => $channel,
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
        
        print_r($arr);
        // $ket = $arr->keterangan;

        // $this->db->trans_start();
        // $datains["tanggal"]= date('Y-m-d H:i:s');
        // $datains["kode"]=$referenceId;
        // $datains["idgame"]=$idgame;
        // $datains["idproduk"]=$idproduct;
        // $datains["akun"]=$akun;
        // $datains["zone"]=$zone;
        // $datains["server"]=$server;
        // $datains["harga"]=$amount;
        // $datains["fee"]=$fee;
        // $datains["payment"]=$arr->channel;
        // $datains["email"]=$email;
        // $datains["url"]="-";
        // $datains["kategori"]=$kategori;
        // $datains["jumlah"]=$jumlah;
        // $datains["trx_id"]=$arr->trx_id;
        // $datains["status"]="Belum Bayar";
        // $datains["jenis"]=$jenis;
        // $datains["iduser"]=$iduser;
        // $datains["ket"]=$ket;
        // $this->db->insert('transaksi', $datains);
        // $insert_id = $this->db->insert_id();
        // $datastat["tanggal"]=date('Y-m-d H:i:s');
        // $datastat["trx_id"]=$arr->trx_id;
        // $datastat["status"]="pending";
        // $datastat["idtransaksi"]=$insert_id;
        // $this->mod_conf->InsertData("transaksi_status",$datastat);
        // $this->db->trans_complete();
        // $hargaproduk = $amount-$fee;
        // $datares[] = array(
        //     "keterangan"=>$ket,
        //     "harga"=>$amount,
        //     "hargaproduk"=>$hargaproduk,
        //     "fee"=>$fee,
        //     "referenceid"=>$referenceId
        // );
        // $this->db->trans_complete();
        // echo json_encode($datares);
    }
    public function cstoresimpan()
    {
        $datains["tanggal"]= date('Y-m-d H:i:s');
        $datains["kode"]=date('YmdHis');
        $datains["idgame"]=$this->input->post("idgame");
        $datains["idproduk"]=$this->input->post("idproduct");
        $datains["akun"]=$this->input->post("akun");
        $datains["zone"]=$this->input->post("zone");
        $datains["server"]=$this->input->post("server");
        $datains["harga"]=$this->input->post("harga");
        $datains["payment"]=$this->input->post("channel");
        $datains["email"]=$this->input->post("email");
        $datains["url"]="-";
        $datains["trx_id"]=$this->input->post("trx_id");
        $datains["status"]="Belum Bayar";
        $this->mod_conf->InsertData("transaksi",$datains);
        $datares[] = array(
            "status"=>"success",
        );
        $email =$this->input->post("email");
        echo json_encode($datares);
    }
    public function emailsaja()
    {
        $this->sendEmail("annassolichin01@gmail.com");
    }
    public function sendEmail($email_send,$message)
    {
        $email_user = $this->mod_app->getEmail();
        $pass = $this->mod_app->getPassword();
        $smtp = $this->mod_app->getSMTPSERVER();
        $port = $this->mod_app->getSMTPPORT();
        $namaapp = $this->mod_app->getNamaApps();
        
        $config = Array(
            'mailtype'  => 'html',
            'protocol' => 'smtp',
            'smtp_host' => $smtp,
            'smtp_crypto' => 'ssl',
            'smtp_port' => $port,
            'smtp_user' => $email_user,
            'smtp_pass' => $pass,
            'crlf' => "\r\n",
            'newline' => "\r\n"
          );
   
          $this->load->library('email', $config);

          $this->email->from($email_user, $namaapp);
          $this->email->to($email_send);
          $this->email->subject('Transaksi '.$namaapp);
          $this->email->message($message);

        if($this->email->send()){
			// echo "success";
		}else{
		    // show_error($this->email->print_debugger());
            // echo "failed";
		}
    }
    public function balance()
	{
		$this->load->library('Cekmutasi/cekmutasi');

		$balance = $this->cekmutasi->balance();

        //print_r($balance);
        echo json_encode($balance);
    }
    public function kodetrans()
    {
        echo date('YmdHis');
    }
    public function transferbca()
    {
        $this->db->trans_start();
        $kategori = $this->input->post("kategori");
        $jumlah=$this->input->post("jumlah");
        $idproduct=$this->input->post("idproduct");
        if($kategori==""||empty($kategori))
        {
            $kategori = "Top Up";
        }else{

            $kategori = "Voucher";
            $reqvoucher = $this->mod_voucherstok->listingvoucher(array("idvoucher"=>$idproduct,"status"=>"Aktif"),$jumlah);
            $jumlahstok = $this->mod_voucher->getstokvoucher(array("idvoucher"=>$idproduct));
            $kodevoucher="";
            if(count($reqvoucher)>0){
                foreach($reqvoucher as $rv){
                    $idstokvoucher = $rv->idvoucherstok;
                    $dataupdatestok["status"]="Pesan";
                    $dataupdatestok["tanggal"]=date('Y-m-d H:i:s');
                    $dataupdatevoucher["stok"]=$jumlahstok-count($reqvoucher);
                    $whereupdatestok["idvoucherstok"]=$idstokvoucher;
                    $whereupdatevoucher["idvoucher"]=$idproduct;
                    $this->mod_conf->UpdateData("voucher_stok",$dataupdatestok,$whereupdatestok);
                    $this->mod_conf->UpdateData("voucher",$dataupdatevoucher,$whereupdatevoucher);
                }
                $statsendvoucher=true;
            }else{
                $statsendvoucher=false;
            }
        }
        if($jumlah==""||empty($jumlah))
        {
            $jumlah = "0";
        }else{

            $jumlah = $jumlah;
        }
        
        $name=$this->input->post("name");
        $phone=$this->input->post("phone");
        $email=$this->input->post("email");
        $amount=$this->input->post("amount");
        $notifyUrl=$this->input->post("notifyUrl");
        $referenceId=date('YmdHis');
        $idgame=$this->input->post("idgame");
        $akun=$this->input->post("akun");
        $zone=$this->input->post("zone");
        $server=$this->input->post("server");
        $jenis=$this->input->post("jenis");
        $iduser=$this->input->post("iduser");
            
        $uniqkode = rand(1,999);
        $statkode = $this->mod_transaksi->getKodeStatus($uniqkode);
        if($statkode)
        {
            $uniqkode = rand(1,999);
        }

        $harga =$amount+$uniqkode;
        $datains["tanggal"]= date('Y-m-d H:i:s');
        $datains["kode"]=$referenceId;
        $datains["idgame"]=$idgame;
        $datains["idproduk"]=$idproduct;
        $datains["harga"]=$harga;
        $datains["payment"]="BCA";
        $datains["email"]=$email;
        $datains["kategori"]=$kategori;
        $datains["jumlah"]=$jumlah;
        $datains["trx_id"]=$uniqkode;
        $datains["akun"]=$akun;
        $datains["zone"]=$zone;
        $datains["server"]=$server;
        $datains["status"]="Belum Bayar";
        $datains["jenis"]=$jenis;
        $datains["iduser"]=$iduser;
            
        $this->db->insert('transaksi', $datains);
        $insert_id = $this->db->insert_id();

        $datastat["tanggal"]= date('Y-m-d H:i:s');
        $datastat["trx_id"]= $uniqkode;
        $datastat["status"]="pending";
        $datastat["idtransaksi"]=$insert_id;

        $inststat = $this->mod_conf->InsertData("transaksi_status",$datastat);

        $datakode["tanggal"]= date('Y-m-d H:i:s');
        $datakode["kode"]=$uniqkode;
        $datakode["idtransaksi"]=$insert_id;
        $datakode["status"]="0";
        $datakode["transaksi"]="Produk";
        $instkode = $this->mod_conf->InsertData("kodeunik",$datakode);

        $this->db->trans_complete();
        if($inststat){
            if($instkode){
                $datares[] = array(
                    "total"=>$harga,
                    "harga"=>$amount,
                    "kodeunik"=>$uniqkode,
                    "kodetrans"=>$referenceId
                );
            }
        }
        echo json_encode($datares);
    }
    public function transfer()
    {
        $this->db->trans_start();
        $kategori = $this->input->post("kategori");
        $jumlah=$this->input->post("jumlah");
        $idproduct=$this->input->post("idproduct");

        if($kategori==""||empty($kategori))
        {
            $kategori = "Top Up";
        }else{

            $kategori = "Voucher";
            $reqvoucher = $this->mod_voucherstok->listingvoucher(array("idvoucher"=>$idproduct,"status"=>"Aktif"),$jumlah);
            $jumlahstok = $this->mod_voucher->getstokvoucher(array("idvoucher"=>$idproduct));
            $kodevoucher="";
            if(count($reqvoucher)>0){
                foreach($reqvoucher as $rv){
                    $idstokvoucher = $rv->idvoucherstok;
                    $dataupdatestok["status"]="Pesan";
                    $dataupdatestok["tanggal"]=date('Y-m-d H:i:s');
                    $dataupdatevoucher["stok"]=$jumlahstok-count($reqvoucher);
                    $whereupdatestok["idvoucherstok"]=$idstokvoucher;
                    $whereupdatevoucher["idvoucher"]=$idproduct;
                    $this->mod_conf->UpdateData("voucher_stok",$dataupdatestok,$whereupdatestok);
                    $this->mod_conf->UpdateData("voucher",$dataupdatevoucher,$whereupdatevoucher);
                }
                $statsendvoucher=true;
            }else{
                $statsendvoucher=false;
            }
        }
        if($jumlah==""||empty($jumlah))
        {
            $jumlah = "0";
        }else{

            $jumlah = $jumlah;
        }
        
        
        $name=$this->input->post("name");
        $phone=$this->input->post("phone");
        $email=$this->input->post("email");
        $amount=$this->input->post("amount");
        $notifyUrl=$this->input->post("notifyUrl");
        $referenceId=date('YmdHis');
        $idgame=$this->input->post("idgame");
       
        $akun=$this->input->post("akun");
        $zone=$this->input->post("zone");
        $server=$this->input->post("server");
        $jenis=$this->input->post("jenis");
        $iduser=$this->input->post("iduser");
        $transferpayment = $this->input->post("payment");
            
        $uniqkode = rand(1,999);
        $statkode = $this->mod_transaksi->getKodeStatus($uniqkode);
        if($statkode)
        {
            $uniqkode = rand(1,999);
        }

        $harga =$amount+$uniqkode;
        $datains["tanggal"]= date('Y-m-d H:i:s');
        $datains["kode"]=$referenceId;
        $datains["idgame"]=$idgame;
        $datains["idproduk"]=$idproduct;
        $datains["harga"]=$harga;
        if($transferpayment=="bri")
        {
            $datains["payment"]="BRI";
        }else if($transferpayment=="bni")
        {
            $datains["payment"]="BNI";
        }
        $datains["email"]=$email;
        $datains["trx_id"]=$uniqkode;
        $datains["kategori"]=$kategori;
        $datains["jumlah"]=$jumlah;
        $datains["akun"]=$akun;
        $datains["zone"]=$zone;
        $datains["server"]=$server;
        $datains["status"]="Belum Bayar";
        $datains["jenis"]=$jenis;
        $datains["iduser"]=$iduser;

        $this->db->insert('transaksi', $datains);
        $insert_id = $this->db->insert_id();

        $datastat["tanggal"]= date('Y-m-d H:i:s');
        $datastat["trx_id"]= $uniqkode;
        $datastat["status"]="pending";
        $datastat["idtransaksi"]=$insert_id;

        $inststat = $this->mod_conf->InsertData("transaksi_status",$datastat);

        $datakode["tanggal"]= date('Y-m-d H:i:s');
        $datakode["kode"]=$uniqkode;
        $datakode["idtransaksi"]=$insert_id;
        $datakode["status"]="0";
        $datakode["transaksi"]="Produk";
        $instkode = $this->mod_conf->InsertData("kodeunik",$datakode);

        $this->db->trans_complete();
        if($inststat){
            if($instkode){
                $datares[] = array(
                    "total"=>$harga,
                    "harga"=>$amount,
                    "kodeunik"=>$uniqkode,
                    "kodetrans"=>$referenceId
                );
            }
        }
        echo json_encode($datares);
    }
    public function topupbri()
    {
        $this->db->trans_start();
        $iduser =$this->input->post("iduser");
        $email=$this->input->post("email");
		$amount=$this->input->post("nominal");
        $payment="BRI";
        $uniqkode = rand(1,999);
        $statkode = $this->mod_transaksi->getKodeStatus($uniqkode);
        if($statkode)
        {
            $uniqkode = rand(1,999);
        }

        $referenceId=date('YmdHis');

        $datains["tanggal"]= date('Y-m-d H:i:s');
        $datains["kode"]=$referenceId;
		$datains["iduser"]=$iduser;
        
        $nominaltopup=$amount+$uniqkode;
        
        $datains["topup"]=$nominaltopup;
        $datains["payment"]=$payment;
        $datains["email"]=$email;
        $datains["url"]='-';
        $datains["trx_id"]=$uniqkode;
		$datains["status"]="Belum Bayar";
		
        $this->db->insert('topup', $datains);
        $insert_id = $this->db->insert_id();

        $datastat["tanggal"]=date('Y-m-d H:i:s');
        $datastat["trx_id"]=$uniqkode;
        $datastat["sid"]=$referenceId;
        $datastat["status"]="pending";
        $datastat["idtopup"]=$insert_id;

        $inststat = $this->mod_conf->InsertData("topup_status",$datastat);

        $datakode["tanggal"]= date('Y-m-d H:i:s');
        $datakode["kode"]=$uniqkode;
        $datakode["idtransaksi"]=$insert_id;
        $datakode["status"]="0";
        $datakode["transaksi"]="Top Up";
        $instkode = $this->mod_conf->InsertData("kodeunik",$datakode);

        $this->db->trans_complete();
        if($inststat){
            if($instkode){
                $datares[] = array(
                    "total"=>$nominaltopup,
                    "harga"=>$amount,
                    "kodeunik"=>$uniqkode,
                    "kodetrans"=>$referenceId
                );
            }
        }
        echo json_encode($datares);
    }
    public function callbacktransfer()
    {
        
        $cekmutasi = array(
            "api_signature" => "vxQOAjIJQK1nuH2hhVkX3KCVRarA70dJ"
        );
        
        $incomingApiSignature = isset($_SERVER['HTTP_API_SIGNATURE']) ? $_SERVER['HTTP_API_SIGNATURE'] : '';
        
        // validasi API Signature
        if( !hash_equals($cekmutasi['api_signature'], $incomingApiSignature) ) {
            exit("Invalid Signature");
        }
        
        $post = file_get_contents("php://input");
        $json = json_decode($post);
        
        if( json_last_error() !== JSON_ERROR_NONE ) {
            exit("Invalid JSON");
        }
        
        if( $json->action == "payment_report" )
        {
            foreach( $json->content->data as $data )
            {
                # Waktu transaksi dalam format unix timestamp
                $time = $data->unix_timestamp;
        
                # Tipe transaksi : credit / debit
                $type = $data->type;
        
                # Jumlah (2 desimal) : 50000.00
                $amount = $data->amount;
        
                # Berita transfer
                $description = $data->description;
        
                # Saldo rekening (2 desimal) : 1500000.00
                $balance = $data->balance;
                
                if( $type == "credit" ) // dana masuk
                {
                    $nominal = round($amount, 0);
                    $stattrans = $this->mod_transaksi->getNominalTrans($nominal);
                    $trx_id = $this->mod_transaksi->getTRX($nominal);
                    if($stattrans!="")
                    {
                  
                        $trans = $this->mod_transaksi->getJenisKodeUnik($stattrans,$trx_id);
                        if($trans=="Produk")
                        {
                            $this->db->trans_start();
                            $where["idtransaksi"]=$stattrans;
                            $dataupdate["status"]="Sudah Bayar";
                            $this->mod_conf->UpdateData("transaksi",$dataupdate,$where);

                            $wherekode["kode"]=$trx_id;
                            $dataupdatekode["transaksi"]="Produk";
                            $dataupdatekode["status"]="1";
                            $this->mod_conf->UpdateData("kodeunik",$dataupdatekode,$wherekode);

                            $insertstat["tanggal"]=date('Y-m-d H:i:s');
                            $insertstat["trx_id"]=$trx_id;
                            $insertstat["status"]="berhasil";
                            $insertstat["idtransaksi"]=$stattrans;
                            $this->mod_conf->InsertData("transaksi_status",$insertstat);

                            $kode=$this->mod_transaksi->getKode($stattrans);
                            $via=$this->mod_transaksi->getVia($stattrans);
                            $idproduk=$this->mod_transaksi->getIdProduk($stattrans);
                            $jenis=$this->mod_transaksi->getJenis($stattrans);
                            $kategori=$this->mod_transaksi->getKategori($stattrans);

                            $datanotif["kode_trans"]=$kode;
                            $datanotif["tanggal"]=date('Y-m-d h:i:s');
                            $datanotif["status"]="0";
                            $datanotif["idtrans"]=$stattrans;
                            $datanotif["jenis"]="Transaksi";
                            $this->mod_conf->InsertData("notifikasi",$datanotif);



                            if($kategori=="Voucher")
                            {
                                $dataproduct = $this->mod_voucher->listing(array("idvoucher"=>$idproduk));
                                foreach($dataproduct as $dp)
                                {
                                    $modal = $dp->harga_dasar;
                                    $jual = $dp->harga_jual;
                                    $reseller = $dp->harga_reseller;
                                }
                                $datadet["kode"]=$kode;
                                $datadet["via"]="BRI";
                                if($jenis=="Reseller")
                                {
                                    $datadet["harga"]=$reseller;
                                    $untung=$reseller-$modal;
                                }else{
                                    $datadet["harga"]=$jual;
                                    $untung=$jual-$modal;
                                }
                            }else{
                                $dataproduct = $this->mod_product->listing(array("idproduct"=>$idproduk));
                                foreach($dataproduct as $dp)
                                {
                                    $modal = $dp->harga_dasar;
                                    $jual = $dp->harga_jual;
                                    $reseller = $dp->harga_reseller;
                                }
                                $datadet["kode"]=$kode;
                                $datadet["via"]="BRI";
                                if($jenis=="Reseller")
                                {
                                    $datadet["harga"]=$reseller;
                                    $untung=$reseller-$modal;
                                }else{
                                    $datadet["harga"]=$jual;
                                    $untung=$jual-$modal;
                                }
                            }
                            
                            $datadet["modal"]=$modal;
                            $datadet["untung"]=$untung;
                            $datadet["tanggal"]=date('Y-m-d h:i:s');
                            $datadet["jenis"]=$jenis;
                            $this->mod_conf->InsertData("transaksi_detail",$datadet);

                            $this->db->trans_complete();
                        }
                    }else{
                        
                        $idtopup = $this->mod_topup->getTopupId($nominal);
                        $trx_id = $this->mod_topup->getTRX($nominal);
                        $trans = $this->mod_transaksi->getJenisKodeUnik($idtopup,$trx_id);
                        $iduser = $this->mod_topup->getUserId($idtopup);
                        $balance = $this->mod_topup->getBallance($iduser);
                        if($trans=="Top Up")
                        {
                            
                            $nominaltopup = $nominal-$trx_id;
                            $updatesaldo = $balance+$nominaltopup;

                            $this->db->trans_start();
                            $whereusr["iduser"]=$iduser;
                            $dataupdateusr["saldo"]=$updatesaldo;
                            $this->mod_conf->UpdateData("user",$dataupdateusr,$whereusr);

                            $where["idtopup"]=$idtopup;
                            $dataupdate["status"]="Sudah Bayar";
                            $this->mod_conf->UpdateData("topup",$dataupdate,$where);

                            $wherekode["kode"]=$trx_id;
                            $dataupdatekode["transaksi"]="Top Up";
                            $dataupdatekode["status"]="1";
                            $this->mod_conf->UpdateData("kodeunik",$dataupdatekode,$wherekode);

                            $insertstat["tanggal"]=date('Y-m-d H:i:s');
                            $insertstat["trx_id"]=$trx_id;
                            $insertstat["status"]="berhasil";
                            $insertstat["idtopup"]=$idtopup;
                            $this->mod_conf->InsertData("topup_status",$insertstat);

                            $this->db->trans_complete();
                        }
                    }
                }
            }
        }
    }
    public function hapusnotif()
    {
        $id = $this->input->post("id");
        $logged = $this->session->userdata("logged_in");
		$rol = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		if (($status!="")&&($logged == "yes")&&(($rol=="Superadmin")||($rol=="Admin Web"))) 
		{
            $this->db->trans_start();
            $data["status"]="1";
            $where['id']=$id;
			$delrol = $this->mod_conf->UpdateData("notifikasi",$data,$where);
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
		$rol = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $status = $this->mod_admin->getAkun($idakun);
		if (($status!="")&&($logged == "yes")&&(($rol=="Superadmin")||($rol=="Admin Web"))) 
		{
			$this->db->trans_start();
            $id=$this->input->post("id");
            
            $kodetrans = $this->mod_transaksi->getKode($id);
            $where['idtransaksi']=$id;
			$wherekode['kode']=$kodetrans;

			$delrol = $this->mod_conf->DeleteData("transaksi",$where);
			$delrol = $this->mod_conf->DeleteData("transaksi_detail",$wherekode);
            $delrol = $this->mod_conf->DeleteData("transaksi_status",$where);
            // $datatrans= $this->mod_transaksi->listing(array("idtransaksi"=>$id));
            // foreach($datatrans as $dt){
            //     $payment = $dt->payment;
            // }
            // if($payment=="Cek Mutasi")
            // {
			//     $where2['idtransaksi']=$id;
            //     $delrol3 = $this->mod_conf->DeleteData("kodeunik",$where2);
            // }
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