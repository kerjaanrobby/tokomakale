<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transmidtrans extends CI_Controller {

    require_once dirname(__FILE__) . '/helpers/midtrans/Midtrans.php';
    
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
		$this->load->model("mod_game");
		$this->load->model("mod_product");
		$this->load->model("mod_transaksi");
        $this->load->model("mod_topup");
        $this->load->model("mod_notifikasi");
    }

    public function generatePayment()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'Mid-server-brOyDP6_7LjZm3FYdPT2lT0c';
        
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'payment_type' => 'gopay',
            'gopay' => array(
                'enable_callback' => false,                // optional
                // 'callback_url' => 'someapps://callback'   // optional
            )
        );
        
        $response = \Midtrans\CoreApi::charge($params);
    }
    // public function ipaymu()
    // {
    //     $name= $this->input->post("name");
    //     $phone= $this->input->post("phone");
    //     $email= $this->input->post("email");
    //     $amount= $this->input->post("amount");
    //     $payment= $this->input->post("payment");
    //     // $notifyUrl= $this->input->post("notifyUrl");
    //     $idgame= $this->input->post("idgame");
    //     $idproduct= $this->input->post("idproduct");
    //     $akun= $this->input->post("akun");
    //     $jumlah=$this->input->post("jumlah");
    //     $zone= $this->input->post("zone");
    //     $server= $this->input->post("server");
    //     $jenis= $this->input->post("jenis");
    //     $referenceId=date('YmdHis');
    //     $iduser=$this->input->post('iduser');

    //     $datapayment = $this->mod_payment->listing(array("idpayment"=>$payment));
    //     if(count($datapayment)>0)
    //     {
    //         foreach($datapayment as $dp)
    //         {
    //             $paymentchannel = $dp->paymentchannel;
    //             $paymentmethod = $dp->paymentmethod;
    //         }
    //     }
       
    //     if(!empty($idgame)){
    //         $namagame = $this->mod_game->getName($idgame);
    //     }else{
    //         $namagame ="";
    //     }
    //     if(!empty($idproduct))
    //     {
    //         $namaproduct = $this->mod_product->getName($idproduct);
    //     }else{
    //         $namaproduct ="";
    //     }
    //     $urlqris = $this->mod_app->getURLQRISIPAYMU();
    //     $urltransfer = $this->mod_app->getURLTransferIpaymu();
    //     $notifyUrl= $this->mod_app->getURLNotifyUrlQris();
    //     $apikey = $this->mod_app->getAPIIPAYMU();
    //     $va_from_web = $this->mod_app->getVAIPAYMU();
        

    //     if($paymentmethod=="qris"){
    //         $url = $urlqris;
    //         $body['paymentChannel'] = "qris";
    //     }else{
    //         $url = "https://my.ipaymu.com/api/v2/payment";
    //         $body['returnUrl'] = base_url();
    //         $body['cancelUrl'] = base_url();
    //     }
  
    //     $va     = $va_from_web;
    //     $secret = $apikey;
    //     $method = 'POST'; //method

    //     $body['name'] = $name;
    //     $body['phone'] = "082160716903";
    //     $body['email'] = $email;
    //     $body['amount'] = $amount;
    //     $body['notifyUrl'] = $notifyUrl;
    //     $body['expired'] = '24';
    //     $body['expiredType'] = 'hours';
    //     $body['referenceId'] = $referenceId;
    //     $body['paymentMethod'] = $paymentmethod;
    //     $body['qty'] = array("1");
    //     $body['price'] = array($amount);
    //     $body['product'] = array($namagame."-".$namaproduct);

    //     $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
    //     $requestBody  = strtolower(hash('sha256', $jsonBody));
    //     $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $secret;
    //     $signature    = hash_hmac('sha256', $stringToSign, $secret);
    //     $timestamp    = Date('YmdHis');

    //     $ch = curl_init($url);

    //     $headers = array(
    //         'Accept: application/json',
    //         'Content-Type: application/json',
    //         'va: ' . $va,
    //         'signature: ' . $signature,
    //         'timestamp: ' . $timestamp
    //     );


        

    //     curl_setopt($ch, CURLOPT_HEADER, false);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_POST, count($body));
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    //     $err = curl_error($ch);
    //     $ret = curl_exec($ch);
    //     curl_close($ch);
    //     if($err) {
    //         echo $err;
    //     } else {
    //         $ret = json_decode($ret);
           
    //         if($ret->Status == 200) {

    //             if($paymentmethod=="qris")
    //             {
    //                 $status = $ret->Status;
    //                 $message = $ret->Message;
    //                 $sessionId = $ret->Data->SessionId;
    //                 $trx_id = $ret->Data->TransactionId;
    //                 $referenceId = $ret->Data->ReferenceId;
    //                 $via = $ret->Data->Via;
    //                 $channel = $ret->Data->Channel;
    //                 $paymentNo = $ret->Data->PaymentNo;
    //                 $paymentName = $ret->Data->PaymentName;
    //                 $total = $ret->Data->Total;
    //                 $fee = $ret->Data->Fee;
    //                 $expired = $ret->Data->Expired;
    //                 $qrString = $ret->Data->QrString;
    //                 $qrImage = $ret->Data->QrImage; 
    //                 $qrTemplate = $ret->Data->QrTemplate;
    //                 $datains["qrstring"]=$qrString;
    //                 $datains["qrimage"]=$qrImage;
    //                 $datains["qrtemplate"]=$qrTemplate;
    //                 $datains["linkpayment"]=$qrTemplate;
    //                 $datains["trx_id"]=$trx_id;
    //                 $datains["channel"]=$channel;
    //                 $datains["paymentno"]=$paymentNo;
    //                 $datains["paymentname"]=$paymentName;
    //                 $datains["total"]=$total;
    //                 $datains["fee"]=$fee;
    //                 $datains["expired"]=$expired;
    //                 $datains["url"]=$qrTemplate;

    //             }else if(($paymentmethod=="va")||($paymentmethod=="cstore")||($paymentmethod=="banktransfer"))
    //             {
    //                 $message = $ret->Message;
    //                 $sessionId = $ret->Data->SessionID;
    //                 $url = $ret->Data->Url;
    //                 $datains["linkpayment"]=$url;
    //             }
    //             $this->db->trans_start();

    //             $datains["tanggal"]= date('Y-m-d H:i:s');
    //             $datains["pesan"]=$message;
    //             $datains["sessionid"]=$sessionId;
    //             $datains["kode"]=$referenceId;
    //             $datains["idgame"]=$idgame;
    //             $datains["idproduk"]=$idproduct;
    //             $datains["payment"]=$paymentchannel;// insert column payment
    //             $datains["harga"]=$amount;
    //             $datains["email"]=$email;
    //             $datains["jumlah"]=$jumlah;
    //             $datains["akun"]=$akun;
    //             $datains["zone"]=$zone;
    //             $datains["kategori"]="Top Up";
    //             $datains["server"]=$server;
    //             $datains["status"]="Belum Bayar";
    //             $datains["jenis"]=$jenis;
    //             $datains["iduser"]=$iduser;

    //             $this->mod_conf->InsertData("transaksi",$datains);
    //             $this->db->trans_complete();

    //             echo json_encode($datains);

    //         }else{
    //             print_r($ret);
    //         }
    //     }
    // }
    // public function manual()
    // {
    //     $kategori = "Top Up";
    //     $name= $this->input->post("name");
    //     $phone= $this->input->post("phone");
    //     $email= $this->input->post("email");
    //     $amount= $this->input->post("amount");
    //     $payment= $this->input->post("payment");
    //     $notifyUrl= $this->input->post("notifyUrl");
    //     $idgame= $this->input->post("idgame");
    //     $idproduct= $this->input->post("idproduct");
    //     $akun= $this->input->post("akun");
    //     $jumlah=$this->input->post("jumlah");
    //     $zone= $this->input->post("zone");
    //     $server= $this->input->post("server");
    //     $jenis= $this->input->post("jenis");
    //     $referenceId=date('YmdHis');
    //     $iduser=$this->input->post('iduser');
        
    //     $uniqkode = rand(1,999);
    //     $statkode = $this->mod_transaksi->getKodeStatus($uniqkode);
    //     if($statkode)
    //     {
    //         $uniqkode = rand(1,999);
    //     }
    //     $harga =$amount+$uniqkode;


    //     $this->db->trans_start();

    //     $datains["tanggal"]= date('Y-m-d H:i:s');
    //     $datains["trx_id"]=$uniqkode;
    //     $datains["kode"]=$referenceId;
    //     $datains["idgame"]=$idgame;
    //     $datains["idproduk"]=$idproduct;
    //     $datains["harga"]=$harga;
    //     $datains["email"]=$email;
    //     $datains["jumlah"]=$harga;
    //     $datains["akun"]=$akun;
    //     $datains["zone"]=$zone;
    //     $datains["kategori"]="Top Up";
    //     $datains["server"]=$server;
    //     $datains["status"]="Belum Bayar";
    //     $datains["jenis"]=$jenis;
    //     $datains["iduser"]=$iduser;
    //     $datains["payment"]="manual";
    //     $datains["pesan"]="success";
    //     $datains["linkpayment"]= base_url()."/shop/invoice/".$referenceId;
    //     // print_r($datains);

    //     $this->db->insert('transaksi', $datains);
    //     $insert_id = $this->db->insert_id();
        

    //     $datastat["status"]="pending";
    //     $datastat["idtransaksi"]=$insert_id;
    //     $inststat = $this->mod_conf->InsertData("transaksi_status",$datastat);

    //     $datakode["tanggal"]= date('Y-m-d H:i:s');
    //     $datakode["kode"]=$uniqkode;
    //     $datakode["idtransaksi"]=$insert_id;
    //     $datakode["status"]="0";
    //     $datakode["transaksi"]="Produk";
    //     $instkode = $this->mod_conf->InsertData("kodeunik",$datakode);


    //     $this->db->trans_complete();
    //     if($inststat){
    //         if($instkode){
    //             $datares[] = array(
    //                 "total"=>$harga,
    //                 "harga"=>$amount,
    //                 "kodeunik"=>$uniqkode,
    //                 "kodetrans"=>$referenceId
    //             );
    //         }
    //     }
    //     $this->db->trans_complete();
                
    //     echo json_encode($datares);
    // }
    // public function cekmutasi()
    // {
    //     $kategori = "Top Up";
    //     $name= $this->input->post("name");
    //     $phone= $this->input->post("phone");
    //     $email= $this->input->post("email");
    //     $amount= $this->input->post("amount");
    //     $payment= $this->input->post("payment");
    //     $notifyUrl= $this->input->post("notifyUrl");
    //     $idgame= $this->input->post("idgame");
    //     $idproduct= $this->input->post("idproduct");
    //     $akun= $this->input->post("akun");
    //     $jumlah=$this->input->post("jumlah");
    //     $zone= $this->input->post("zone");
    //     $server= $this->input->post("server");
    //     $jenis= $this->input->post("jenis");
    //     $referenceId=date('YmdHis');
    //     $iduser=$this->input->post('iduser');
        
    //     $uniqkode = rand(1,999);
    //     $statkode = $this->mod_transaksi->getKodeStatus($uniqkode);
    //     if($statkode)
    //     {
    //         $uniqkode = rand(1,999);
    //     }
    //     $harga =$amount+$uniqkode;


    //     $this->db->trans_start();

    //     $datains["tanggal"]= date('Y-m-d H:i:s');
    //     $datains["trx_id"]=$uniqkode;
    //     $datains["kode"]=$referenceId;
    //     $datains["idgame"]=$idgame;
    //     $datains["idproduk"]=$idproduct;
    //     $datains["harga"]=$harga;
    //     $datains["email"]=$email;
    //     $datains["jumlah"]=$harga;
    //     $datains["akun"]=$akun;
    //     $datains["zone"]=$zone;
    //     $datains["kategori"]="Top Up";
    //     $datains["server"]=$server;
    //     $datains["status"]="Belum Bayar";
    //     $datains["jenis"]=$jenis;
    //     $datains["iduser"]=$iduser;
    //     $datains["payment"]="Cek Mutasi";
    //     $datains["pesan"]="success";
    //     $datains["linkpayment"]= base_url()."/shop/invoice/".$referenceId;
    //     // print_r($datains);

    //     $this->db->insert('transaksi', $datains);
    //     $insert_id = $this->db->insert_id();
        

    //     $datastat["status"]="pending";
    //     $datastat["idtransaksi"]=$insert_id;
    //     $inststat = $this->mod_conf->InsertData("transaksi_status",$datastat);

    //     $datakode["tanggal"]= date('Y-m-d H:i:s');
    //     $datakode["kode"]=$uniqkode;
    //     $datakode["idtransaksi"]=$insert_id;
    //     $datakode["status"]="0";
    //     $datakode["transaksi"]="Produk";
    //     $instkode = $this->mod_conf->InsertData("kodeunik",$datakode);


    //     $this->db->trans_complete();
    //     if($inststat){
    //         if($instkode){
    //             $datares[] = array(
    //                 "total"=>$harga,
    //                 "harga"=>$amount,
    //                 "kodeunik"=>$uniqkode,
    //                 "kodetrans"=>$referenceId
    //             );
    //         }
    //     }
    //     $this->db->trans_complete();
                
    //     echo json_encode($datares);
    // }
    // public function unotify_qris()
    // {
    //     $trx_id =$this->input->post("trx_id");
    //     $idtransaksi = $this->mod_transaksi->getIdByTrx($trx_id);
	// 	$datains["tanggal"] = date('Y-m-d H:i:s');
    //     $datains["trx_id"] = $this->input->post("trx_id");
	// 	$datains["sid"] = $this->input->post("sid");
    //     $datains["status"] = $this->input->post("status");
    //     $datains["idtransaksi"]=$idtransaksi;
    //     $this->mod_conf->InsertData("transaksi_status",$datains);
    //     $status=$this->input->post("status");

        
    //     if($status=="berhasil"){
    //         $this->db->trans_start();
    //         $where["idtransaksi"]=$idtransaksi;
    //         $dataups["status"] = "Sudah Bayar";
    //         $this->mod_conf->UpdateData("transaksi",$dataups,$where);

    //         $kode=$this->mod_transaksi->getKode($idtransaksi);
    //         $via=$this->mod_transaksi->getVia($idtransaksi);
    //         $idproduk=$this->mod_transaksi->getIdProduk($idtransaksi);
    //         $jenis=$this->mod_transaksi->getJenis($idtransaksi);
    //         $dataproduct = $this->mod_product->listing(array("idproduct"=>$idproduk));
    //         foreach($dataproduct as $dp)
    //         {
    //             $modal = $dp->harga_dasar;
    //             $jual = $dp->harga_jual;
    //             $reseller = $dp->harga_reseller;
    //         }
    //         $datadet["kode"]=$kode;
    //         $datadet["via"]=$via;
    //         if($jenis=="Reseller")
    //         {
    //             $datadet["harga"]=$reseller;
    //             $untung=$reseller-$modal;
    //         }else{
    //             $datadet["harga"]=$jual;
    //             $untung=$jual-$modal;
    //         }
    //         $datadet["modal"]=$modal;
    //         $datadet["untung"]=$untung;
    //         $datadet["tanggal"]=date('Y-m-d h:i:s');
    //         $datadet["jenis"]=$jenis;
    //         $this->mod_conf->InsertData("transaksi_detail",$datadet);
            
    //         $datanotif["kode_trans"]=$kode;
    //         $datanotif["tanggal"]=date('Y-m-d h:i:s');
    //         $datanotif["status"]="0";
    //         $datanotif["jenis"]="Transaksi";
    //         $datanotif["idtrans"]=$idtransaksi;
    //         $this->mod_conf->InsertData("notifikasi",$datanotif);
    //         $this->db->trans_complete();
    //     }
    // }
    // public function ipaymutopup()
    // {
    //     $iduser =$this->input->post("iduser");
	// 	$name=$this->input->post("name");
    //     $phone=$this->input->post("phone");
    //     $email=$this->input->post("email");
	// 	$amount=$this->input->post("nominal");
    //     $fee=$this->input->post("fee");
        
    //     if($fee==""){
    //         $fee="0";
    //     }

    //     $payment= $this->input->post("payment");
    //     $notifyUrl=base_url()."user/unotify";
    //     $referenceId=date('YmdHis');

    //     $datapayment = $this->mod_payment->listing(array("idpayment"=>$payment));
    //     if(count($datapayment)>0)
    //     {
    //         foreach($datapayment as $dp)
    //         {
    //             $paymentchannel = $dp->paymentchannel;
    //             $paymentmethod = $dp->paymentmethod;
    //         }
    //     }
       
    //     $urlqris = $this->mod_app->getURLQRISIPAYMU();
    //     $urltransfer = $this->mod_app->getURLTransferIpaymu();
    //     // $notifyUrl= $this->mod_app->getURLNotifyUrlQris();
    //     $apikey = $this->mod_app->getAPIIPAYMU();
    //     $va_from_web = $this->mod_app->getVAIPAYMU();
        

    //     if($paymentmethod=="qris"){
    //         $url = $urlqris;
    //         $body['paymentChannel'] = "qris";
    //     }else{
    //         $url = "https://my.ipaymu.com/api/v2/payment";
    //         $body['returnUrl'] = base_url();
    //         $body['cancelUrl'] = base_url();
    //     }
  
    //     $va     = $va_from_web;
    //     $secret = $apikey;
    //     $method = 'POST'; //method

    //     $body['name'] = $name;
    //     $body['phone'] = "082160716903";
    //     $body['email'] = $email;
    //     $body['amount'] = $amount;
    //     $body['notifyUrl'] = $notifyUrl;
    //     $body['expired'] = '24';
    //     $body['expiredType'] = 'hours';
    //     $body['referenceId'] = $referenceId;
    //     $body['paymentMethod'] = $paymentmethod;
    //     $body['qty'] = array("1");
    //     $body['price'] = array($amount);
    //     $body['product'] = array("Top Up Saldo Toko Petani Online");

    //     $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
    //     $requestBody  = strtolower(hash('sha256', $jsonBody));
    //     $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $secret;
    //     $signature    = hash_hmac('sha256', $stringToSign, $secret);
    //     $timestamp    = Date('YmdHis');

    //     $ch = curl_init($url);

    //     $headers = array(
    //         'Accept: application/json',
    //         'Content-Type: application/json',
    //         'va: ' . $va,
    //         'signature: ' . $signature,
    //         'timestamp: ' . $timestamp
    //     );


        

    //     curl_setopt($ch, CURLOPT_HEADER, false);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_POST, count($body));
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    //     $err = curl_error($ch);
    //     $ret = curl_exec($ch);
    //     curl_close($ch);
    //     if($err) {
    //         echo $err;
    //     } else {
    //         $ret = json_decode($ret);
           
    //         if($ret->Status == 200) {

    //             if($paymentmethod=="qris")
    //             {
    //                 $status = $ret->Status;
    //                 $message = $ret->Message;
    //                 $sessionId = $ret->Data->SessionId;
    //                 $trx_id = $ret->Data->TransactionId;
    //                 $referenceId = $ret->Data->ReferenceId;
    //                 $via = $ret->Data->Via;
    //                 $channel = $ret->Data->Channel;
    //                 $paymentNo = $ret->Data->PaymentNo;
    //                 $paymentName = $ret->Data->PaymentName;
    //                 $total = $ret->Data->Total;
    //                 // $fee = $ret->Data->Fee;
    //                 $expired = $ret->Data->Expired;
    //                 $qrString = $ret->Data->QrString;
    //                 $qrImage = $ret->Data->QrImage; 
    //                 $qrTemplate = $ret->Data->QrTemplate;
    //                 $datains["qrstring"]=$qrString;
    //                 $datains["qrimage"]=$qrImage;
    //                 $datains["qrtemplate"]=$qrTemplate;
    //                 $datains["linkpayment"]=$qrTemplate;
    //                 $datains["trx_id"]=$trx_id;
    //                 $datains["channel"]=$channel;
    //                 $datains["paymentno"]=$paymentNo;
    //                 $datains["paymentname"]=$paymentName;
    //                 $datains["total"]=$total;
    //                 $datains["fee"]=$fee;
    //                 $datains["expired"]=$expired;
    //                 $datains["url"]=$qrTemplate;
    //                 $datares[] = array(
    //                     "status"=>$status,
    //                     "pesan"=>$message,
    //                     "ReferenceId"=>$referenceId,
    //                     "QrImage"=>$qrImage,
    //                     "QrTemplate"=>$qrTemplate,
    //                     "trx_id"=>$trx_id,
    //                     "linkpayment"=>$qrTemplate,
    //                     "kode"=>$referenceId,
    //                     "total"=>$total,
    //                     "Expired"=>$expired,
    //                     "Via"=>$via,
    //                     "Total"=>$total,
    //                 );

    //             }else if(($paymentmethod=="va")||($paymentmethod=="banktransfer"))
    //             {
    //                 $message = $ret->Message;
    //                 $sessionId = $ret->Data->SessionID;
    //                 $url = $ret->Data->Url;
    //                 $datains["linkpayment"]=$url;
    //             }else if($paymentmethod=="cstore")
    //             {
    //                 $message = $ret->Message;
    //                 $sessionId = $ret->Data->SessionID;
    //                 $url = $ret->Data->Url;
    //                 $datains["linkpayment"]=$url;
    //                 $datains["ket"]=$ret->keterangan;;
    //             }
    //             $this->db->trans_start();

    //             $datains["tanggal"]= date('Y-m-d H:i:s');
    //             $datains["kode"]=$referenceId;
    //             $datains["iduser"]=$iduser;

    //             $datains["topup"]=$amount;
    //             $datains["payment"]=strtoupper($paymentchannel);// insert column payment
    //             $datains["email"]=$email;
    //             $datains["fee"]=$fee;
    //             $datains["status"]="Belum Bayar";

    //             $this->mod_conf->InsertData("topup",$datains);
    //             $this->db->trans_complete();

    //             echo json_encode($datares);

    //         }else{
    //             print_r($ret);
    //         }
    //     }
    // }
    // public function cekmutasitopup()
    // {
    //     $this->db->trans_start();
    //     $iduser =$this->input->post("iduser");
    //     $email=$this->input->post("email");
    //     $amount=$this->input->post("nominal");
    //     $payment= $this->input->post("payment");

    //     $referenceId=date('YmdHis');

    //     $datapayment = $this->mod_payment->listing(array("idpayment"=>$payment));
    //     if(count($datapayment)>0)
    //     {
    //         foreach($datapayment as $dp)
    //         {
    //             $paymentchannel = $dp->paymentchannel;
    //             $paymentmethod = $dp->paymentmethod;
    //         }
    //     }



    //     $payment=strtoupper($paymentchannel);
    //     $uniqkode = rand(1,999);
    //     $statkode = $this->mod_transaksi->getKodeStatus($uniqkode);
    //     if($statkode)
    //     {
    //         $uniqkode = rand(1,999);
    //     }

    //     $referenceId=date('YmdHis');

    //     $datains["tanggal"]= date('Y-m-d H:i:s');
    //     $datains["kode"]=$referenceId;
	// 	$datains["iduser"]=$iduser;
        
    //     $nominaltopup=$amount+$uniqkode;
        
    //     $datains["topup"]=$nominaltopup;
    //     $datains["payment"]=$payment;
    //     $datains["email"]=$email;
    //     $datains["url"]='-';
    //     $datains["trx_id"]=$uniqkode;
	// 	$datains["status"]="Belum Bayar";
		
    //     $this->db->insert('topup', $datains);
    //     $insert_id = $this->db->insert_id();

    //     $datastat["tanggal"]=date('Y-m-d H:i:s');
    //     $datastat["trx_id"]=$uniqkode;
    //     $datastat["sid"]=$referenceId;
    //     $datastat["status"]="pending";
    //     $datastat["idtopup"]=$insert_id;

    //     $inststat = $this->mod_conf->InsertData("topup_status",$datastat);

    //     $datakode["tanggal"]= date('Y-m-d H:i:s');
    //     $datakode["kode"]=$uniqkode;
    //     $datakode["idtransaksi"]=$insert_id;
    //     $datakode["status"]="0";
    //     $datakode["transaksi"]="Top Up";
    //     $instkode = $this->mod_conf->InsertData("kodeunik",$datakode);

    //     $this->db->trans_complete();
    //     if($inststat){
    //         if($instkode){
    //             $datares[] = array(
    //                 "total"=>$nominaltopup,
    //                 "harga"=>$amount,
    //                 "kodeunik"=>$uniqkode,
    //                 "kodetrans"=>$referenceId
    //             );
    //         }
    //     }
    //     echo json_encode($datares);
    // }
    // public function manualtopup()
    // {
    //     $this->db->trans_start();
    //     $iduser =$this->input->post("iduser");
    //     $email=$this->input->post("email");
    //     $amount=$this->input->post("nominal");
    //     $payment= $this->input->post("payment");

    //     $referenceId=date('YmdHis');

    //     $datapayment = $this->mod_payment->listing(array("idpayment"=>$payment));
    //     if(count($datapayment)>0)
    //     {
    //         foreach($datapayment as $dp)
    //         {
    //             $paymentchannel = $dp->paymentchannel;
    //             $paymentmethod = $dp->paymentmethod;
    //         }
    //     }

    //     $payment=strtoupper($paymentchannel);
    //     $uniqkode = rand(1,999);
    //     $statkode = $this->mod_transaksi->getKodeStatus($uniqkode);
    //     if($statkode)
    //     {
    //         $uniqkode = rand(1,999);
    //     }

    //     $referenceId=date('YmdHis');

    //     $datains["tanggal"]= date('Y-m-d H:i:s');
    //     $datains["kode"]=$referenceId;
	// 	$datains["iduser"]=$iduser;
        
    //     $nominaltopup=$amount+$uniqkode;
        
    //     $datains["topup"]=$nominaltopup;
    //     $datains["payment"]=$payment;
    //     $datains["email"]=$email;
    //     $datains["url"]='-';
    //     $datains["trx_id"]=$uniqkode;
	// 	$datains["status"]="Belum Bayar";
		
    //     $this->db->insert('topup', $datains);
    //     $insert_id = $this->db->insert_id();

    //     $datastat["tanggal"]=date('Y-m-d H:i:s');
    //     $datastat["trx_id"]=$uniqkode;
    //     $datastat["sid"]=$referenceId;
    //     $datastat["status"]="pending";
    //     $datastat["idtopup"]=$insert_id;

    //     $inststat = $this->mod_conf->InsertData("topup_status",$datastat);

    //     $datakode["tanggal"]= date('Y-m-d H:i:s');
    //     $datakode["kode"]=$uniqkode;
    //     $datakode["idtransaksi"]=$insert_id;
    //     $datakode["status"]="0";
    //     $datakode["transaksi"]="Top Up";
    //     $instkode = $this->mod_conf->InsertData("kodeunik",$datakode);

    //     $this->db->trans_complete();
    //     if($inststat){
    //         if($instkode){
    //             $datares[] = array(
    //                 "total"=>$nominaltopup,
    //                 "harga"=>$amount,
    //                 "kodeunik"=>$uniqkode,
    //                 "kodetrans"=>$referenceId
    //             );
    //         }
    //     }
    //     echo json_encode($datares);
    // }
    // public function konfirmasimanualtopup()
    // {
    //     $logged = $this->session->userdata("logged_in");
	// 	$rol = $this->session->userdata("rol");
    //     $idakun = $this->session->userdata("id");
    //     $status = $this->mod_admin->getAkun($idakun);

	// 	if (($status!="")&&($logged == "yes")&&(($rol=="Superadmin")||($rol=="Admin Web"))) {
    //         $kodetrans = $this->input->post("id");
    //         $datatrans = $this->mod_topup->listing(array("kode"=>$kodetrans));
    //         if(count($datatrans)>0)
    //         {
    //             foreach($datatrans as $d){
    //                 $trx_id = $d->trx_id;
    //                 $idtopup = $d->idtopup;
    //                 $iduser = $d->iduser;
    //                 $nominal = $d->topup;
    //                 $fee = $d->fee;
    //                 $payment = $d->payment;
    //             }
    //             $balance = $this->mod_topup->getBallance($iduser);
                
    //             if($payment=="QRIS")
    //             {
    //                 $nominaltopup = $nominal-$fee;
    //             }else{
    //                 $nominaltopup = $nominal-$trx_id;
    //             }
                
    //             $updatesaldo = $balance+$nominaltopup;
                
    //             $this->db->trans_start();
    //             $whereusr["iduser"]=$iduser;
    //             $dataupdateusr["saldo"]=$updatesaldo;
    //             $dbtrans1 = $this->mod_conf->UpdateData("user",$dataupdateusr,$whereusr);

    //             $where["idtopup"]=$idtopup;
    //             $dataupdate["status"]="Sudah Bayar";
    //             $dbtrans2 = $this->mod_conf->UpdateData("topup",$dataupdate,$where);

    //             $wherekode["kode"]=$trx_id;
    //             $dataupdatekode["transaksi"]="Top Up";
    //             $dataupdatekode["status"]="1";
    //             $dbtrans3 = $this->mod_conf->UpdateData("kodeunik",$dataupdatekode,$wherekode);

    //             $insertstat["tanggal"]=date('Y-m-d H:i:s');
    //             $insertstat["trx_id"]=$trx_id;
    //             $insertstat["status"]="berhasil";
    //             $insertstat["idtopup"]=$idtopup;
    //             $dbtrans4 = $this->mod_conf->InsertData("topup_status",$insertstat);
    //             $this->db->trans_complete();

    //             if(($dbtrans1==true)&&($dbtrans2==true)&&($dbtrans3==true)&&($dbtrans4==true))
    //             {
    //                 $output["hasil"]="1";
    //             }else{
    //                 $output["hasil"]="0";
    //             }
    //         }else{

    //             $output["hasil"]="0";
    //         }
    //         echo json_encode($output);

    //     }else{
	// 		redirect('keluar');
    //     }
        
    // }
    // public function notification()
    // {
    //     $datanotif = $this->mod_notifikasi->listing(array("status"=>"0"));
    //     $jumnotif = count($datanotif);
    //     $datashow["jumlahnotif"]=$jumnotif;
    //     $datashow["datanotif"]=$datanotif;
    //     echo json_encode($datashow);
    // }
    // public function testcronjob()
    // {
    //     $insdata["tanggal"]=date('Y-m-d h:i:s');
    //     $insdata["status"]="dari";
    //     $this->mod_conf->InsertData("record_callback",$insdata);
    // }
}