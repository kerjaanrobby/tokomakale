<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

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
		$this->load->model("mod_news");
		$this->load->model("mod_banner");
		$this->load->model("mod_fitur");
		$this->load->model("mod_news");
		$this->load->model("mod_conf");
		$this->load->model("mod_product");
		$this->load->model("mod_payment");
		$this->load->model("mod_transaksi");
		$this->load->model("mod_user");
		$this->load->model("mod_server");
		$this->load->model("mod_topup");
		$this->load->model("mod_voucher");
    }

    public function product_detail()
    {
        $idproduct = $this->input->post("idproduct");
        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $leveldb = $this->mod_user->getLevel($idakun);
        
        $data_product = $this->mod_product->listing(array("idproduct"=>$idproduct));
        $data_payment = $this->mod_payment->listing(array("status"=>"0"));
        
        foreach($data_product as $dp)
        {
            $nama_product = $dp->nama;
            $harga_jual = $dp->harga_jual;
            $harga_reseller = $dp->harga_reseller;
            $harga_vvip = $dp->harga_vvip;
        }
        if(($logged=="yes")&&($leveldb=="VVIP"))
        {
            $leveluser = "VVIP";
            $levellabel = "VVIP";
            $data["iduser"]=$idakun;
            $harga = $harga_vvip;
            $saldo = $this->mod_user->getSaldo($idakun);
        }else if(($logged=="yes")&&($leveldb=="User")){
            $leveluser = "User";
            $levellabel="";
            $data["iduser"]=$idakun;
            $harga = $harga_jual;
            $saldo = $this->mod_user->getSaldo($idakun);
        }else if(($logged=="yes")&&($leveldb=="Reseller")){
            $leveluser = "Reseller";
            $levellabel = "Reseller";
            $data["iduser"]=$idakun;
            $harga = $harga_reseller;
            $saldo = $this->mod_user->getSaldo($idakun);   
        }else{
            $leveluser = "Publik";
            $levellabel = "";
            $saldo="0";
            if(!empty($idakun))
            {
                $data["iduser"]=$idakun;
            }else{
                $data["iduser"]="kosong";
            }
            $harga = $harga_jual;
        }
        foreach($data_payment as $pay)
        {
            $persenfee = $harga*$pay->fee/100;
            $payment["idpayment"]=$pay->idpayment;
            $payment["nama"]=$pay->nama;
            $payment["fee"]=$pay->fee;
            $payment["logo"]=$pay->logo;
            $payment["kode"]=$pay->kode;
            $payment["kategori"]=$pay->kategori;
            $payment["status"]=$pay->status;
            $payment["paymentchannel"]=$pay->paymentchannel;
            $payment["via"]=$pay->via;
            $payment["persenfee"]=$persenfee;
            $payment["hargatotal"]=$harga+$persenfee;
            $payarr[]=$payment;
        }
        if($saldo >0){
            if($harga>=$saldo){
                $potongsaldo = 0;
            }else{
                $potongsaldo = 1;
            }
        }else{
            $potongsaldo = 0;
        }
        $data_output["nama_product"]=$nama_product;
        $data_output["payment"]=$payarr;
        $data_output["potongsaldo"]=$potongsaldo;
        $data_output["harga"]=$harga;
        $data_output["saldo"]=$saldo;
        $data_output["levellabel"]=$levellabel;

        
		echo json_encode($data_output);
    }
    public function payment_detail()
    {
        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $leveldb = $this->mod_user->getLevel($idakun);

        $idpayment = $this->input->post("idpayment");
        $idproduct = $this->input->post("idproduct");
        $data_payment = $this->mod_payment->listing(array("status"=>"0","idpayment"=>$idpayment));
        $data_product = $this->mod_product->listing(array("idproduct"=>$idproduct));
        foreach($data_product as $dp)
        {
            $nama_product = $dp->nama;
            $harga_jual = $dp->harga_jual;
            $harga_reseller = $dp->harga_reseller;
            $harga_vvip = $dp->harga_vvip;
        }
        if(($logged=="yes")&&($leveldb=="VVIP"))
        {
            $leveluser = "VVIP";
            $levellabel = "VVIP";
            $data["iduser"]=$idakun;
            $harga = $harga_vvip;
            $saldo = $this->mod_user->getSaldo($idakun);
        }else if(($logged=="yes")&&($leveldb=="User")){
            $leveluser = "User";
            $levellabel="";
            $data["iduser"]=$idakun;
            $harga = $harga_jual;
            $saldo = $this->mod_user->getSaldo($idakun);
        }else if(($logged=="yes")&&($leveldb=="Reseller")){
            $leveluser = "Reseller";
            $levellabel = "Reseller";
            $data["iduser"]=$idakun;
            $harga = $harga_reseller;
            $saldo = $this->mod_user->getSaldo($idakun);   
        }else{
            $leveluser = "Publik";
            $levellabel = "";
            $saldo="0";
            if(!empty($idakun))
            {
                $data["iduser"]=$idakun;
            }else{
                $data["iduser"]="kosong";
            }
            $harga = $harga_jual;
        }

        foreach($data_payment as $pay)
        {
            $persenfee = $harga*$pay->fee/100;
            $hargatotal = $harga+$persenfee;
            $payment["idpayment"]=$pay->idpayment;
            $payment["nama"]=$pay->nama;
            $payment["fee"]=$pay->fee;
            $payment["logo"]=$pay->logo;
            $payment["kode"]=$pay->kode;
            $payment["kategori"]=$pay->kategori;
            $payment["status"]=$pay->status;
            $payment["paymentchannel"]=$pay->paymentchannel;
            $payment["via"]=$pay->via;
            $payment["persenfee"]=$persenfee;
            $payment["hargatotal"]=$harga+$persenfee;
            $payarr[]=$payment;
        }
        $data_output["payment"]=$data_payment;
        $data_output["hargatotal"]=$hargatotal;
        $data_output["persenfee"]=$persenfee;
		echo json_encode($data_output);
    }


    public function request_transaktion()
    {
        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $leveldb = $this->mod_user->getLevel($idakun);

        $kategori = "Top Up";

        $name  =$this->input->post("name");
        $email =$this->input->post("email");
        $idproduct =$this->input->post("idproduct");
        $idpayment =$this->input->post("idpayment");
        $akun =$this->input->post("akun");
        $zone =$this->input->post("zone");
        $server =$this->input->post("server");
        $referenceId=date('YmdHis');

        $data_payment = $this->mod_payment->listing(array("status"=>"0","idpayment"=>$idpayment));
        $data_product = $this->mod_product->listing(array("idproduct"=>$idproduct));

        $namagame = $this->mod_product->getGame($idproduct);

        // $urlqris = 'https://www.tokopetanionline.com/api/unotify_qris';
        $urlqris = $this->mod_app->getURLQRISIPAYMU();
        $urltransfer = $this->mod_app->getURLTransferIpaymu();
        $notifyUrl= $this->mod_app->getURLNotifyUrlQris();
        $apikey = $this->mod_app->getAPIIPAYMU();
        $va_from_web = $this->mod_app->getVAIPAYMU();

        foreach($data_product as $dp)
        {
            $nama_product = $dp->nama;
            $harga_jual = $dp->harga_jual;
            $harga_reseller = $dp->harga_reseller;
            $harga_vvip = $dp->harga_vvip;
            $idgame = $dp->idgame;
        }

        if(($logged=="yes")&&($leveldb=="VVIP"))
        {
            $leveluser = "VVIP";
            $levellabel = "VVIP";
            $jenis = "VVIP";
            $data["iduser"]=$idakun;
            $harga = $harga_vvip;
            $saldo = $this->mod_user->getSaldo($idakun);
        }else if(($logged=="yes")&&($leveldb=="User")){
            $leveluser = "User";
            $levellabel="";
            $jenis = "Publik";
            $data["iduser"]=$idakun;
            $harga = $harga_jual;
            $saldo = $this->mod_user->getSaldo($idakun);
        }else if(($logged=="yes")&&($leveldb=="Reseller")){
            $leveluser = "Reseller";
            $levellabel = "Reseller";
            $jenis = "Reseller";
            $data["iduser"]=$idakun;
            $harga = $harga_reseller;
            $saldo = $this->mod_user->getSaldo($idakun);   
        }else{
            $leveluser = "Publik";
            $levellabel = "";
            $jenis = "Publik";
            $saldo="0";
            if(!empty($idakun))
            {
                $data["iduser"]=$idakun;
            }else{
                $data["iduser"]="kosong";
            }
            $harga = $harga_jual;
        }

        foreach($data_payment as $pay)
        {
            $persenfee = $harga*$pay->fee/100;
            $hargatotal = $harga+$persenfee;;
            $namapayment=$pay->nama;
            $feepayment=$pay->fee;
            $kodepayment=$pay->kode;
            $kategoripayment=$pay->kategori;
            $paymentchannel=$pay->paymentchannel;
            $paymentmethod=$pay->paymentmethod;
            $viapayment=$pay->via;
        }

        $body['name'] = $name;
        $body['phone'] = "082160716903";
        $body['email'] = $email;
        $body['amount'] = $hargatotal;
        $body['notifyUrl'] = $notifyUrl;
        $body['expired'] = '24';
        $body['expiredType'] = 'hours';
        $body['referenceId'] = $referenceId;
        $body['paymentMethod'] = $paymentmethod;
        $body['qty'] = array("1");
        $body['price'] = array($hargatotal);
        $body['product'] = array($namagame."-".$nama_product);

        if($paymentmethod=="qris")
        {
            $body['paymentChannel'] = "qris";
        }

        if($viapayment=="Ipaymu")
        {
            $url    = $urlqris;
            $va     = $va_from_web;
            $secret = $apikey;
            $method = 'POST';

            $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
            $requestBody  = strtolower(hash('sha256', $jsonBody));
            $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $secret;
            $signature    = hash_hmac('sha256', $stringToSign, $secret);
            $timestamp    = Date('YmdHis');
            
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
            if($paymentmethod=="qris")
            {
                if($hargatotal<=1000)
                {
                    $output["status"]=0;
                    $output["keterangan"]="QRIS tidak bisa untuk transaksi dibawah 1.000";
        
                }else{
                    if($err) {
                        echo $err;
                    } else {
                        $ret = json_decode($ret);
                        if($ret->Status == 200) {
                            $status = $ret->Status;
                            $message = $ret->Message;
                            $sessionId = $ret->Data->SessionId;
                            $trx_id = $ret->Data->TransactionId;
                            $referenceId = $ret->Data->ReferenceId;
                            $via = $ret->Data->Via;
                            $channel = $ret->Data->Channel;
                            $paymentNo = $ret->Data->PaymentNo;
                            $paymentName = $ret->Data->PaymentName;
                            $total = $ret->Data->Total;
                            $fee = $ret->Data->Fee;
                            $expired = $ret->Data->Expired;
                            $qrString = $ret->Data->QrString;
                            $qrImage = $ret->Data->QrImage; 
                            $qrTemplate = $ret->Data->QrTemplate;
                            $datains["qrstring"]=$qrString;
                            $datains["qrimage"]=$qrImage;
                            $datains["qrtemplate"]=$qrTemplate;
                            $datains["linkpayment"]=$qrTemplate;
                            $datains["trx_id"]=$trx_id;
                            $datains["channel"]=$channel;
                            $datains["paymentno"]=$paymentNo;
                            $datains["paymentname"]=$paymentName;
                            $datains["total"]=$total;
                            $datains["fee"]=$fee;
                            $datains["expired"]=$expired;
                            $datains["url"]=$qrTemplate;
                            $urlrecord = $qrTemplate;
                        }
                    }
                }
            }else if(($paymentmethod=="cstore")||($paymentmethod=="va")||($paymentmethod=="banktransfer")){
                $message = $ret->Message;
                $sessionId = $ret->Data->SessionID;
                $url = $ret->Data->Url;
                $datains["linkpayment"]=$url;
                $urlrecord = $url;
            }

            $this->db->trans_start();

            $datains["tanggal"]= date('Y-m-d H:i:s');
            $datains["pesan"]=$message;
            $datains["sessionid"]=$sessionId;
            $datains["kode"]=$referenceId;
            $datains["idgame"]=$idgame;
            $datains["idproduk"]=$idproduct;
            $datains["payment"]=$paymentchannel;// insert column payment
            $datains["harga"]=$hargatotal;
            $datains["email"]=$email;
            $datains["jumlah"]="1";
            $datains["akun"]=$akun;
            $datains["zone"]=$zone;
            $datains["kategori"]="Top Up";
            $datains["server"]=$server;
            $datains["status"]="Belum Bayar";
            $datains["jenis"]=$jenis;
            $datains["iduser"]=$idakun;

            $this->mod_conf->InsertData("transaksi",$datains);

            $datarecord["idproduk"]=$idproduct;
            $datarecord["idgame"]=$idgame;
            $datarecord["jenis_harga"]=$jenis;
            $datarecord["harga_asli"]=$harga;
            $datarecord["feeipaymu"]=$persenfee;
            $datarecord["harga_ipaymu"]=$hargatotal;
            $datarecord["sessionid"]=$sessionId;
            $datarecord["kode"]=$referenceId;
            $datarecord["payment_channel"]=$paymentchannel;
            $datarecord["url"]=$urlrecord;
            $datarecord["create_date"]=date('Y-m-d H:i:s');

            $this->mod_conf->InsertData("recordreqipaymu",$datarecord);
            $this->db->trans_complete();

            $output["status"]=1;
            $output["viapayment"]=$viapayment;
            $output["keterangan"]="Order sudah masuk kedalam sistem silahkan lakukan pembayaran";
            $output["kode"]=$referenceId;
            $output["linkpayment"]=$urlrecord;
        }else if($viapayment=="Cek Mutasi"){
            $uniqkode = rand(1,999);
            $statkode = $this->mod_transaksi->getKodeStatus($uniqkode);

            if($statkode)
            {
                $uniqkode = rand(1,999);              
            }
            $hargamutasi =$harga+$uniqkode;
            $datains["tanggal"]= date('Y-m-d H:i:s');
            $datains["trx_id"]=$uniqkode;
            $datains["kode"]=$referenceId;
            $datains["idgame"]=$idgame;
            $datains["idproduk"]=$idproduct;
            $datains["harga"]=$hargamutasi;
            $datains["email"]=$email;
            $datains["jumlah"]="1";
            $datains["akun"]=$akun;
            $datains["zone"]=$zone;
            $datains["kategori"]="Top Up";
            $datains["server"]=$server;
            $datains["status"]="Belum Bayar";
            $datains["jenis"]=$jenis;
            $datains["iduser"]=$idakun;
            $datains["payment"]="Cek Mutasi";
            $datains["pesan"]="success";
            $datains["linkpayment"]= base_url()."/shop/invoice/".$referenceId;
            
            $this->db->trans_start();

            $this->db->insert('transaksi', $datains);
            $insert_id = $this->db->insert_id();
                
            $datastat["status"]="pending";
            $datastat["idtransaksi"]=$insert_id;
            $inststat = $this->mod_conf->InsertData("transaksi_status",$datastat);

            $datakode["tanggal"]= date('Y-m-d H:i:s');
            $datakode["kode"]=$uniqkode;
            $datakode["idtransaksi"]=$insert_id;
            $datakode["status"]="0";
            $datakode["transaksi"]="Produk";
            $instkode = $this->mod_conf->InsertData("kodeunik",$datakode);

            $datarecord["idproduk"]=$idproduct;
            $datarecord["idgame"]=$idgame;
            $datarecord["jenis_harga"]=$jenis;
            $datarecord["harga_asli"]=$harga;
            $datarecord["kodeunik"]=$uniqkode;
            $datarecord["harga_cekmutasi"]=$hargamutasi;
            $datarecord["kode"]=$referenceId;
            $datarecord["payment_channel"]=$paymentchannel;
            $datarecord["url"]=base_url()."/shop/invoice/".$referenceId;
            $datarecord["create_date"]=date('Y-m-d H:i:s');

            $this->mod_conf->InsertData("recordreqcekmutasi",$datarecord);

            $this->db->trans_complete();
            if($inststat){
                if($instkode){
                    $output["status"]=1;
                    $output["viapayment"]=$viapayment;
                    $output["total"]=$hargamutasi;
                    $output["harga"]=$harga;
                    $output["kodeunik"]=$uniqkode;
                    $output["kodetrans"]=$referenceId;
                }
            }
        }

        echo json_encode($output);
    }
    public function potongsaldo()
    {
        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $leveldb = $this->mod_user->getLevel($idakun);

        if($logged=="yes")
        {
            $idgame=$this->input->post("idgame");
            $idproduct=$this->input->post("idproduct");
            $akun=$this->input->post("akun");
            $zone=$this->input->post("zone");
            $server=$this->input->post("server");
            $data_product = $this->mod_product->listing(array("idproduct"=>$idproduct));
            foreach($data_product as $dp)
            {

                $modal = $dp->harga_dasar;
                $nama_product = $dp->nama;
                $harga_jual = $dp->harga_jual;
                $harga_reseller = $dp->harga_reseller;
                $harga_vvip = $dp->harga_vvip;
                $idgame = $dp->idgame;
            }

            $payment="Potong saldo";
            $referenceId=date('YmdHis');

            $datauser = $this->mod_user->listing(array("iduser"=>$idakun));
            foreach($datauser as $u){
                $email =$u->email;
                $saldo =$u->saldo;
            }

            if($leveldb=="VVIP")
            {
                $jenis="VVIP";
                $amount = $harga_vvip;
            }else if($leveldb=="User")
            {
                $jenis="Publik";
                $amount = $harga_jual;
            }else if($leveldb=="Reseller")
            {
                $jenis="Reseller";
                $amount = $harga_reseller;
            }
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
            $datains["iduser"]=$idakun;
            $this->db->trans_start();
            $trans = $this->mod_conf->InsertData("transaksi",$datains);

            if($saldo<$amount)
            {
                $output['hasil']=0;
                $output['pesan']='Transaksi gagal';  
            }else{
                $where["iduser"]=$idakun;
                $dataup["saldo"]=$saldo-$amount;
                $this->mod_conf->UpdateData("user",$dataup,$where);
        
                $untung=$amount-$modal;
            
                $datadet["kode"]=$referenceId;
                $datadet["via"]=$payment;
                $datadet["harga"]=$amount;
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

        }else{
            $output['hasil']=0;
            $output['pesan']='Transaksi gagal';  
            echo json_encode($output);  
        }
    }
    public function unotify_qris()
    {
        $trx_id =$this->input->post("trx_id");
        $idtransaksi = $this->mod_transaksi->getIdByTrx($trx_id);
		$datains["tanggal"] = date('Y-m-d H:i:s');
        $datains["trx_id"] = $this->input->post("trx_id");
		$datains["sid"] = $this->input->post("sid");
        $datains["status"] = $this->input->post("status");
        $datains["idtransaksi"]=$idtransaksi;

        $dttrans = $this->mod_transaksi->listing_join(array("transaksi.idtransaksi"=>$idtransaksi));
       
        foreach($dttrans as $trans)
        {
            $idproduk = $trans->idproduk;
            $kode = $trans->kode;
            $harga = $trans->harga;
            $jenis = $trans->jenis;
        }

        $dtproduk = $this->mod_product->listing(array("idproduct"=>$idproduk));
        foreach($dtproduk as $prod)
        {
            if($jenis == "VVIP")
            {
                $harga_produk = $prod->harga_vvip;

            }else if($jenis == "Reseller")
            {
                $harga_produk = $prod->harga_reseller;
            }else if($jenis == "Publik")
            {
                $harga_produk = $prod->harga_jual;
            }
        }
        $data_payment = $this->mod_payment->listing_limit(array("payment.paymentchannel"=>"13"));
        foreach($data_payment as $pay)
        {
            $feepay = $pay->fee;
        }


        $persenfee = $harga_produk*$feepay/100;
        $hargatotal = $harga_produk+$persenfee;
        $status=$this->input->post("status");    
        
        if(($status=="berhasil")&&(($harga==$hargatotal))){
            $this->db->trans_start();
            $this->mod_conf->InsertData("transaksi_status",$datains);
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
            
            $datanotif["kode_trans"]=$kode;
            $datanotif["tanggal"]=date('Y-m-d h:i:s');
            $datanotif["status"]="0";
            $datanotif["jenis"]="Transaksi";
            $datanotif["idtrans"]=$idtransaksi;
            $this->mod_conf->InsertData("notifikasi",$datanotif);
            $this->db->trans_complete();
        }
    }
    public function getlimit()
    {
        $data_payment = $this->mod_payment->listing_limit(array("payment.paymentchannel"=>"13"));
        print_r($data_payment);
    }
    public function hapusTransaksi()
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
            

            $datatrans= $this->mod_transaksi->listing(array("idtransaksi"=>$id));
            foreach($datatrans as $dt){
                $payment = $dt->payment;
            }
            if($payment=="Cek Mutasi")
            {
			    $where2['idtransaksi']=$id;
                $delrol3 = $this->mod_conf->DeleteData("kodeunik",$where2);
            }

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
    // public function cekKode()
    // {
    //     $uniqkode = rand(1,999);
    //     $statkode = $this->mod_transaksi->getKodeStatus($uniqkode);
    //     if($statkode)
    //     {
    //         $uniqkode = rand(1,999);
    //     }
    //     // if($statkode)
    //     // {
    //     //     echo "true";
    //     // }else{
    //     //     echo "false";
    //     // }
    //     echo "<br>";
    //     echo $uniqkode;
    //     echo "<br>";
    //     echo $statkode;
    // }
    // public function getGame($idproduct)
    // {
    //     $data_game = $this->mod_product->getGame($idproduct);
    //     print_r($data_game);
    // }
}