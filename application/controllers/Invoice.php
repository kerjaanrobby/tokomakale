<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

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
        
    }

    public function qris($kodetrans)
    {
        $logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
        $favicon = $this->mod_app->getFavicon();

		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
        $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
    
        // $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
        // $data_product = $this->mod_product->listing(array("idgame"=>$idgame));
        // $data_payment = $this->mod_payment->listing(array("status"=>"0")); 

        $datatrans = $this->mod_transaksi->listing_join(array("kode"=>$kodetrans));
       
        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $data["kodetrans"]=$kodetrans;
        $data["datatrans"]=$datatrans;

        $this->load->view("content/invoice_qris",$data);

    }
    public function qris_topup($kodetrans)
    {
        $logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
        $favicon = $this->mod_app->getFavicon();

		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
        $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
    
        // $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
        // $data_product = $this->mod_product->listing(array("idgame"=>$idgame));
        // $data_payment = $this->mod_payment->listing(array("status"=>"0")); 

        $datatrans = $this->mod_topup->listing_join(array("kode"=>$kodetrans));
       
        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $data["kodetrans"]=$kodetrans;
        $data["datatrans"]=$datatrans;

        $this->load->view("content/invoice_qris_topup",$data);
    }
    public function manual($kodetrans)
    {
        $logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
        $favicon = $this->mod_app->getFavicon();

		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
        $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
    
        // $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
        // $data_product = $this->mod_product->listing(array("idgame"=>$idgame));
        // $data_payment = $this->mod_payment->listing(array("status"=>"0")); 

        $datatrans = $this->mod_transaksi->listing_join(array("kode"=>$kodetrans));
       
        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $data["kodetrans"]=$kodetrans;
        $data["datatrans"]=$datatrans;

        $this->load->view("content/invoice_manual",$data);
    }
    public function manual_topup($kodetrans)
    {
        $logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
        $favicon = $this->mod_app->getFavicon();

		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
        $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
    

        $datatrans = $this->mod_topup->listing_join(array("kode"=>$kodetrans));
       
        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $data["kodetrans"]=$kodetrans;
        $data["datatrans"]=$datatrans;

        $this->load->view("content/invoice_manual_topup",$data);
    }
    public function cstore_topup($kodetrans)
    {
        $logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
        $favicon = $this->mod_app->getFavicon();

		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
        $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
    

        $datatrans = $this->mod_topup->listing_join(array("kode"=>$kodetrans));
       
        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $data["kodetrans"]=$kodetrans;
        $data["datatrans"]=$datatrans;

        $this->load->view("content/invoice_cstore_topup",$data);
    }
    public function sendEmailInvoice($kodetrans)
    {
        $datatrans = $this->mod_transaksi->listing_join(array("kode"=>$kodetrans));
        // Send Invoice
        if(count($datatrans)>0){
            foreach($datatrans as $dt)
            {
                $email_send = $dt->email;
                $payment_type = $dt->payment;
            }
            
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
            
            if($payment_type =="qris")
            {
                $linkinvoice = "invoice/qris/";
            }else if($payment_type =="manual")
            {
                $linkinvoice = "invoice/manual/";
            }else if(($payment_type == "alfamart")||($payment_type == "indomaret"))
            {
                $linkinvoice = "invoice/cstore/";
            }
            $message = "Untuk melihat invoice silahkan klik link berikut ini ". base_url().$linkinvoice.$kodetrans;

            $this->load->library('email', $config);

            $this->email->from($email_user, $namaapp);
            $this->email->to($email_send);
            $this->email->subject("Invoice ".$namaapp);
            $this->email->message($message);

            if($this->email->send()){
                redirect($linkinvoice.$kodetrans);
            }else{
                redirect($linkinvoice.$kodetrans);
                // show_error($this->email->print_debugger());
                // echo "failed";
            }
        }
    }
    public function sendEmailInvoiceTopUp($kodetrans)
    {
        $datatrans = $this->mod_topup->listing_join(array("kode"=>$kodetrans));
        // Send Invoice
        if(count($datatrans)>0){
            foreach($datatrans as $dt)
            {
                $email_send = $dt->email;
                $payment_type = $dt->payment;
            }
            
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
            
            if(($payment_type =="qris")||($payment_type =="QRIS"))
            {
                $linkinvoice = "invoice/qris_topup/";
            }else if(($payment_type =="manual")||($payment_type =="BCA")||($payment_type =="BNI")||($payment_type =="BRI"))
            {
                $linkinvoice = "invoice/manual_topup/";
            }else if(($payment_type == "alfamart")||($payment_type == "indomaret"))
            {
                $linkinvoice = "invoice/cstore_topup/";
            }
            $message = "Untuk melihat invoice silahkan klik link berikut ini ". base_url().$linkinvoice.$kodetrans;

            $this->load->library('email', $config);

            $this->email->from($email_user, $namaapp);
            $this->email->to($email_send);
            $this->email->subject("Invoice ".$namaapp);
            $this->email->message($message);

            if($this->email->send()){
                redirect($linkinvoice.$kodetrans);
            }else{
                redirect($linkinvoice.$kodetrans);
                // show_error($this->email->print_debugger());
                // echo "failed";
            }
        }
    }

}