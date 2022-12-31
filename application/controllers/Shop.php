<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

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
    public function index()
	{

        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $leveldb = $this->mod_user->getLevel($idakun);

        
        $logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
        $favicon = $this->mod_app->getFavicon();

		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
		$tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);

        $data_news = $this->mod_news->listing();
        $data_fitur = $this->mod_fitur->listing();
        $data_banner = $this->mod_banner->listing();
        if($leveldb=="VVIP")
        {
            $data_game = $this->mod_game->listing(array("status"=>"Aktif"));
            $data_game_pop = $this->mod_game->listingorder(array("kategori"=>"Populer","status"=>"Aktif"));
        }else{
            $data_game = $this->mod_game->listing(array("status"=>"Aktif","kategori_harga !="=>"VVIP"));
            $data_game_pop = $this->mod_game->listingorder(array("kategori"=>"Populer","status"=>"Aktif","kategori_harga !="=>"VVIP"));    
        }

        $data["game"]=$data_game;
        $data["gamepop"]=$data_game_pop;
        $data["banner"]=$data_banner;
        $data["fitur"]=$data_fitur;
        $data["news"]=$data_news;

        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $this->load->view("content/homepage",$data);
    }
    public function cobavvip()
	{

        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $leveldb = $this->mod_user->getLevel($idakun);

        
        $logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
        $favicon = $this->mod_app->getFavicon();

		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
		$tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);

        $data_news = $this->mod_news->listing();
        $data_fitur = $this->mod_fitur->listing();
        $data_banner = $this->mod_banner->listing();
        if($leveldb=="VVIP")
        {
            $data_game = $this->mod_game->listing(array("status"=>"Aktif"));
            $data_game_pop = $this->mod_game->listingorder(array("kategori"=>"Populer","status"=>"Aktif"));
        }else{
            $data_game = $this->mod_game->listing(array("status"=>"Aktif","kategori_harga !="=>"VVIP"));
            $data_game_pop = $this->mod_game->listingorder(array("kategori"=>"Populer","status"=>"Aktif","kategori_harga !="=>"VVIP"));    
        }
        
        $data["game"]=$data_game;
        $data["gamepop"]=$data_game_pop;
        $data["banner"]=$data_banner;
        $data["fitur"]=$data_fitur;
        $data["news"]=$data_news;

        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $this->load->view("content/homepage",$data);
    }
    // public function games($idgame)
    // {
    //     $logged = $this->session->userdata("logged_in");
    //     $level = $this->session->userdata("rol");
    //     $idakun = $this->session->userdata("id");
    //     $leveldb = $this->mod_user->getLevel($idakun);
    //     if(($logged=="yes")&&($leveldb=="VVIP"))
    //     {
    //         $leveluser = "VVIP";
    //         $data["iduser"]=$idakun;
    //         $saldo = $this->mod_user->getSaldo($idakun);
    //     }else if(($logged=="yes")&&($leveldb=="User")){
    //         $leveluser = "User";
    //         $data["iduser"]=$idakun;
    //         $saldo = $this->mod_user->getSaldo($idakun);
    //     }else if(($logged=="yes")&&($leveldb=="Reseller")){
    //         $leveluser = "Reseller";
    //         $data["iduser"]=$idakun;
    //         $saldo = $this->mod_user->getSaldo($idakun);   
    //     }else{
    //         $leveluser = "Publik";
    //         $saldo="0";
    //         if(!empty($idakun))
    //         {
    //             $data["iduser"]=$idakun;
    //         }else{
    //             $data["iduser"]="kosong";
    //         }
    //     }
        
    //     $logo = $this->mod_app->getLogo();
    //     $nameapp = $this->mod_app->getNamaApps();
    //     $favicon = $this->mod_app->getFavicon();
        
    //     $dtapp["logo"] = $logo;
    //     $dtapp["nameapp"] = $nameapp;
    //     $dtapp["favicon"] = $favicon;
                    
    //     $tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
    //     $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
                
    //     $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
    //     $data_product = $this->mod_product->listing(array("idgame"=>$idgame,"status"=>"Aktif"));
    //     $data_payment = $this->mod_payment->listing(array("status"=>"0"));
    //     $data_server = $this->mod_server->listing(array("idgame"=>$idgame));
        
    //     $status= $this->mod_game->GetStatus($idgame);
        
    //     $data["head"] = $tmplt["header"];
    //     $data["footer"] = $tmplt["foot"];
    //     $data["status"]=$status;
    //     $data["game"]=$data_game;
    //     $data["product"]=$data_product;
    //     $data["payment"]=$data_payment;
    //     $data["server"]=$data_server;
    //     $data["leveluser"]=$leveluser;
    //     $data["saldo"]=$saldo;
        
    //     $this->load->view("content/gamedetails",$data);
    // }
    public function games_midtrans($idgame)
    {
        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $leveldb = $this->mod_user->getLevel($idakun);
        if(($logged=="yes")&&($leveldb=="VVIP"))
        {
            $datauser = $this->mod_user->listing(array("iduser"=>$idakun));
            foreach($datauser as $u){
                $email =$u->email;
            }
            $data["email"]=$email;
            $leveluser = "VVIP";
            $data["iduser"]=$idakun;
            $saldo = $this->mod_user->getSaldo($idakun);
        }else if(($logged=="yes")&&($leveldb=="User")){
            $datauser = $this->mod_user->listing(array("iduser"=>$idakun));
            foreach($datauser as $u){
                $email =$u->email;
            }
            $data["email"]=$email;
            $leveluser = "User";
            $data["iduser"]=$idakun;
            $saldo = $this->mod_user->getSaldo($idakun);
        }else if(($logged=="yes")&&($leveldb=="Reseller")){
            $datauser = $this->mod_user->listing(array("iduser"=>$idakun));
            foreach($datauser as $u){
                $email =$u->email;
            }
            $data["email"]=$email;
            $leveluser = "Reseller";
            $data["iduser"]=$idakun;
            $saldo = $this->mod_user->getSaldo($idakun);   
        }else{
            $data["email"]="";
            $leveluser = "Publik";
            $saldo="0";
            if(!empty($idakun))
            {
                $data["iduser"]=$idakun;
            }else{
                $data["iduser"]="kosong";
            }
        }
        
        
        $logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
        $favicon = $this->mod_app->getFavicon();
        
        $dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
        $dtapp["favicon"] = $favicon;
                    
        $tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
        $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
                
        $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
        $data_product = $this->mod_product->listing(array("idgame"=>$idgame,"status"=>"Aktif"));
        $data_payment = $this->mod_payment->listing(array("status"=>"0"));
        $data_server = $this->mod_server->listing(array("idgame"=>$idgame));
        
        $status= $this->mod_game->GetStatus($idgame);
        
        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $data["status"]=$status;
        $data["game"]=$data_game;
        $data["product"]=$data_product;
        $data["payment"]=$data_payment;
        $data["server"]=$data_server;
        $data["leveluser"]=$leveluser;
        $data["saldo"]=$saldo;
        
        $this->load->view("content/gamedetails_midtrans",$data);
    }
    public function games($idgame)
    {
        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $leveldb = $this->mod_user->getLevel($idakun);
        if(($logged=="yes")&&($leveldb=="VVIP"))
        {
            $datauser = $this->mod_user->listing(array("iduser"=>$idakun));
            foreach($datauser as $u){
                $email =$u->email;
            }
            $data["email"]=$email;
            $leveluser = "VVIP";
            $data["iduser"]=$idakun;
            $saldo = $this->mod_user->getSaldo($idakun);
        }else if(($logged=="yes")&&($leveldb=="User")){
            $datauser = $this->mod_user->listing(array("iduser"=>$idakun));
            foreach($datauser as $u){
                $email =$u->email;
            }
            $data["email"]=$email;
            $leveluser = "User";
            $data["iduser"]=$idakun;
            $saldo = $this->mod_user->getSaldo($idakun);
        }else if(($logged=="yes")&&($leveldb=="Reseller")){
            $datauser = $this->mod_user->listing(array("iduser"=>$idakun));
            foreach($datauser as $u){
                $email =$u->email;
            }
            $data["email"]=$email;
            $leveluser = "Reseller";
            $data["iduser"]=$idakun;
            $saldo = $this->mod_user->getSaldo($idakun);   
        }else{
            $data["email"]="";
            $leveluser = "Publik";
            $saldo="0";
            if(!empty($idakun))
            {
                $data["iduser"]=$idakun;
            }else{
                $data["iduser"]="kosong";
            }
        }
        
        
        $logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
        $favicon = $this->mod_app->getFavicon();
        
        $dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
        $dtapp["favicon"] = $favicon;
                    
        $tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
        $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
                
        $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
        $data_product = $this->mod_product->listing(array("idgame"=>$idgame,"status"=>"Aktif"));
        $data_payment = $this->mod_payment->listing(array("status"=>"0"));
        $data_server = $this->mod_server->listing(array("idgame"=>$idgame));
        
        $status= $this->mod_game->GetStatus($idgame);
        
        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $data["status"]=$status;
        $data["game"]=$data_game;
        $data["product"]=$data_product;
        $data["payment"]=$data_payment;
        $data["server"]=$data_server;
        $data["leveluser"]=$leveluser;
        $data["saldo"]=$saldo;
        
        $this->load->view("content/gamedetails_secure",$data);
    }
    // public function games_dev($idgame)
    // {
    //     $logged = $this->session->userdata("logged_in");
    //     $level = $this->session->userdata("rol");
    //     $idakun = $this->session->userdata("id");
    //     $leveldb = $this->mod_user->getLevel($idakun);
    //     if(($logged=="yes")&&($leveldb=="VVIP"))
    //     {
    //         $datauser = $this->mod_user->listing(array("iduser"=>$idakun));
    //         foreach($datauser as $u){
    //             $email =$u->email;
    //         }
    //         $data["email"]=$email;
    //         $leveluser = "VVIP";
    //         $data["iduser"]=$idakun;
    //         $saldo = $this->mod_user->getSaldo($idakun);
    //     }else if(($logged=="yes")&&($leveldb=="User")){
    //         $datauser = $this->mod_user->listing(array("iduser"=>$idakun));
    //         foreach($datauser as $u){
    //             $email =$u->email;
    //         }
    //         $data["email"]=$email;
    //         $leveluser = "User";
    //         $data["iduser"]=$idakun;
    //         $saldo = $this->mod_user->getSaldo($idakun);
    //     }else if(($logged=="yes")&&($leveldb=="Reseller")){
    //         $datauser = $this->mod_user->listing(array("iduser"=>$idakun));
    //         foreach($datauser as $u){
    //             $email =$u->email;
    //         }
    //         $data["email"]=$email;
    //         $leveluser = "Reseller";
    //         $data["iduser"]=$idakun;
    //         $saldo = $this->mod_user->getSaldo($idakun);   
    //     }else{
    //         $leveluser = "Publik";
    //         $saldo="0";
    //         if(!empty($idakun))
    //         {
    //             $data["iduser"]=$idakun;
    //         }else{
    //             $data["iduser"]="kosong";
    //         }
    //     }
        
        
    //     $logo = $this->mod_app->getLogo();
    //     $nameapp = $this->mod_app->getNamaApps();
    //     $favicon = $this->mod_app->getFavicon();
        
    //     $dtapp["logo"] = $logo;
    //     $dtapp["nameapp"] = $nameapp;
    //     $dtapp["favicon"] = $favicon;
                    
    //     $tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
    //     $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
                
    //     $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
    //     $data_product = $this->mod_product->listing(array("idgame"=>$idgame,"status"=>"Aktif"));
    //     $data_payment = $this->mod_payment->listing(array("status"=>"0"));
    //     $data_server = $this->mod_server->listing(array("idgame"=>$idgame));
        
    //     $status= $this->mod_game->GetStatus($idgame);
        
    //     $data["head"] = $tmplt["header"];
    //     $data["footer"] = $tmplt["foot"];
    //     $data["status"]=$status;
    //     $data["game"]=$data_game;
    //     $data["product"]=$data_product;
    //     $data["payment"]=$data_payment;
    //     $data["server"]=$data_server;
    //     $data["leveluser"]=$leveluser;
    //     $data["saldo"]=$saldo;
        
    //     $this->load->view("content/gamedetails_dev",$data);
    // }
    public function game($idgame)
    {

        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $leveldb = $this->mod_user->getLevel($idakun);
        $jenisgame = $this->mod_game->getJenis($idgame);
        if($jenisgame=="Fisik")
        {
            redirect("shop/merchant/".$idgame);
        }else{
            if($leveldb=="VVIP")
            {
                redirect("shop/game_vvip/".$idgame);
            }else{
                if(($logged=="yes")&&($level=="Reseller")){
                    redirect("shop/game_reseller/".$idgame);
                }else{
                    $logo = $this->mod_app->getLogo();
                    $nameapp = $this->mod_app->getNamaApps();
                    $favicon = $this->mod_app->getFavicon();
        
                    $dtapp["logo"] = $logo;
                    $dtapp["nameapp"] = $nameapp;
                    $dtapp["favicon"] = $favicon;
                    
                    $tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
                    $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
                
                    $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
                    $data_product = $this->mod_product->listing(array("idgame"=>$idgame,"status"=>"Aktif"));
                    $data_payment = $this->mod_payment->listing(array("status"=>"0"));
                    $data_server = $this->mod_server->listing(array("idgame"=>$idgame));
        
                    $status= $this->mod_game->GetStatus($idgame);
        
                    $data["head"] = $tmplt["header"];
                    $data["footer"] = $tmplt["foot"];
                    $data["status"]=$status;
                    $data["game"]=$data_game;
                    $data["product"]=$data_product;
                    $data["payment"]=$data_payment;
                    $data["server"]=$data_server;
        
                    $this->load->view("content/gamedetail",$data);
                }
            }
        }
    }
    public function merchant($idgame)
    {
        $logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
        $favicon = $this->mod_app->getFavicon();
    
        $dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
        $dtapp["favicon"] = $favicon;
              
        $tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
        $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
            
        $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
        $data_product = $this->mod_product->listing(array("idgame"=>$idgame));
        $data_payment = $this->mod_payment->listing(array("status"=>"0"));
        $data_server = $this->mod_server->listing(array("idgame"=>$idgame));

        $data['province'] = $this->province();
        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $data["game"]=$data_game;
        $data["product"]=$data_product;
        $data["payment"]=$data_payment;
        $data["server"]=$data_server;
    
        $this->load->view("content/gamemerchant",$data);
    }
    public function kota_select($kota)
    {
        $datakota = $this->kota($kota);
        foreach($datakota->rajaongkir->results as $kota)
        {
            echo "<option value=".$kota->city_id.">".$kota->city_name."</option>";
        } 
    }
    public function detailproduct()
    {
        $idproduk = $this->input->post("idproduk");
        $wharr = array("idproduct"=>$idproduk);
		$dtrol=$this->mod_product->listing($wharr);
		$X = array('hasildata'=>$dtrol);               
		echo json_encode($X);  
    }
    public function service_kurir($prov,$kota,$courier)
    {
        $dataservice = $this->service($prov,$kota,$courier);
        $data =$dataservice->rajaongkir->results[0]->costs;
        // echo json_encode($data);
        $option ="<option value=''>Service</option>";
        foreach($data as $d){
            $option .="<option value=".$d->service." data-foo=".$d->cost[0]->value.">".$d->service."</option>";
        }
        echo $option;
    }
    public function game_reseller($idgame)
    {
        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $leveldb = $this->mod_user->getLevel($idakun);
        if($leveldb=="VVIP")
        {
            redirect("shop/game_vvip/".$idgame);
        }else{
            if(($logged=="yes")&&($level=="Reseller")){

                $idakun = $this->session->userdata("id");
                $logo = $this->mod_app->getLogo();
                $nameapp = $this->mod_app->getNamaApps();
                $favicon = $this->mod_app->getFavicon();
    
                $dtapp["logo"] = $logo;
                $dtapp["nameapp"] = $nameapp;
                $dtapp["favicon"] = $favicon;
                
                $tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
                $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
            
                $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
                $data_product = $this->mod_product->listing(array("idgame"=>$idgame,"status"=>"Aktif"));
                $data_payment = $this->mod_payment->listing(array("status"=>"0"));
                $data_server = $this->mod_server->listing(array("idgame"=>$idgame));
    
                $saldo = $this->mod_user->getSaldo($idakun);
                $datauser = $this->mod_user->listing(array("iduser"=>$idakun));
                foreach($datauser as $u){
                    $email =$u->email;
                }
                $data["head"] = $tmplt["header"];
                $data["footer"] = $tmplt["foot"];
                $data["game"]=$data_game;
                $data["product"]=$data_product;
                $data["payment"]=$data_payment;
                $data["saldo"]=$saldo;
                $data["email"]=$email;
                $data["iduser"]=$idakun;
                $data["server"]=$data_server;
    
                $this->load->view("content/gamedetailreseller",$data);
            }else{
                redirect("loginuser");
            }
        }
        
    }
    public function game_nonreseller($idgame)
    {
        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        $leveldb = $this->mod_user->getLevel($idakun);
        if($leveldb=="VVIP")
        {
            redirect("shop/game_vvip/".$idgame);
        }else{
            if(($logged=="yes")&&($level=="User")){

                $idakun = $this->session->userdata("id");
                $logo = $this->mod_app->getLogo();
                $nameapp = $this->mod_app->getNamaApps();
                $favicon = $this->mod_app->getFavicon();
    
                $dtapp["logo"] = $logo;
                $dtapp["nameapp"] = $nameapp;
                $dtapp["favicon"] = $favicon;
                
                $tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
                $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
            
                $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
                $data_product = $this->mod_product->listing(array("idgame"=>$idgame,"status"=>"Aktif"));
                $data_payment = $this->mod_payment->listing(array("status"=>"0"));
                $data_server = $this->mod_server->listing(array("idgame"=>$idgame));
    
                $saldo = $this->mod_user->getSaldo($idakun);
                $datauser = $this->mod_user->listing(array("iduser"=>$idakun));
                foreach($datauser as $u){
                    $email =$u->email;
                }
                $data["head"] = $tmplt["header"];
                $data["footer"] = $tmplt["foot"];
                $data["game"]=$data_game;
                $data["product"]=$data_product;
                $data["payment"]=$data_payment;
                $data["saldo"]=$saldo;
                $data["email"]=$email;
                $data["iduser"]=$idakun;
                $data["server"]=$data_server;
    
                $this->load->view("content/gamedetailnonreseller",$data);
            }else{
                redirect("loginuser");
            }
        }
    }
    public function game_vvip($idgame)
    {
        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        if(($logged=="yes")&&($level=="VVIP")){

            $idakun = $this->session->userdata("id");
            $logo = $this->mod_app->getLogo();
            $nameapp = $this->mod_app->getNamaApps();
            $favicon = $this->mod_app->getFavicon();

            $dtapp["logo"] = $logo;
            $dtapp["nameapp"] = $nameapp;
            $dtapp["favicon"] = $favicon;
            
            $tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
            $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
        
            $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
            $data_product = $this->mod_product->listing(array("idgame"=>$idgame,"status"=>"Aktif"));
            $data_payment = $this->mod_payment->listing(array("status"=>"0"));
            $data_server = $this->mod_server->listing(array("idgame"=>$idgame));

            $saldo = $this->mod_user->getSaldo($idakun);
            $datauser = $this->mod_user->listing(array("iduser"=>$idakun));
            foreach($datauser as $u){
                $email =$u->email;
            }
            $data["head"] = $tmplt["header"];
            $data["footer"] = $tmplt["foot"];
            $data["game"]=$data_game;
            $data["product"]=$data_product;
            $data["payment"]=$data_payment;
            $data["saldo"]=$saldo;
            $data["email"]=$email;
            $data["iduser"]=$idakun;
            $data["server"]=$data_server;

            $this->load->view("content/gamedetailvvip",$data);
        }else{
            redirect("loginuser");
        }
    }
    public function game_voucher($idgame)
    {
        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        if(($logged=="yes")&&($level=="Reseller")){
            redirect("shop/game_voucher_reseller/".$idgame);
        }else if($logged=="yes"){
            redirect("shop/game_voucher_nonreseller/".$idgame);
        }else{

            $logo = $this->mod_app->getLogo();
            $nameapp = $this->mod_app->getNamaApps();
            $favicon = $this->mod_app->getFavicon();

            $dtapp["logo"] = $logo;
            $dtapp["nameapp"] = $nameapp;
            $dtapp["favicon"] = $favicon;
            
            $tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
            $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
        
            $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
            $data_product = $this->mod_voucher->listing(array("idgame"=>$idgame));
            $data_payment = $this->mod_payment->listing(array("status"=>"0"));

            $data["head"] = $tmplt["header"];
            $data["footer"] = $tmplt["foot"];
            $data["game"]=$data_game;
            $data["product"]=$data_product;
            $data["payment"]=$data_payment;

            $this->load->view("content/gamevoucher",$data);
        }
    }
    public function game_voucher_nonreseller($idgame)
    {
        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        if($logged=="yes"){

            $idakun = $this->session->userdata("id");
            $logo = $this->mod_app->getLogo();
            $nameapp = $this->mod_app->getNamaApps();
            $favicon = $this->mod_app->getFavicon();

            $dtapp["logo"] = $logo;
            $dtapp["nameapp"] = $nameapp;
            $dtapp["favicon"] = $favicon;
            
            $tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
            $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
        
            $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
            $data_product = $this->mod_voucher->listing(array("idgame"=>$idgame));
            $data_payment = $this->mod_payment->listing(array("status"=>"0"));
            $data_server = $this->mod_server->listing(array("idgame"=>$idgame));

            $saldo = $this->mod_user->getSaldo($idakun);
            $datauser = $this->mod_user->listing(array("iduser"=>$idakun));
            foreach($datauser as $u){
                $email =$u->email;
            }
            $data["head"] = $tmplt["header"];
            $data["footer"] = $tmplt["foot"];
            $data["game"]=$data_game;
            $data["product"]=$data_product;
            $data["payment"]=$data_payment;
            $data["saldo"]=$saldo;
            $data["email"]=$email;
            $data["iduser"]=$idakun;
            $data["server"]=$data_server;

            $this->load->view("content/gamevoucher_nonreseller",$data);
        }else{
            redirect("loginuser");
        }
    }
    public function game_voucher_reseller($idgame)
    {
        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        $idakun = $this->session->userdata("id");
        if($logged=="yes"){

            $idakun = $this->session->userdata("id");
            $logo = $this->mod_app->getLogo();
            $nameapp = $this->mod_app->getNamaApps();
            $favicon = $this->mod_app->getFavicon();

            $dtapp["logo"] = $logo;
            $dtapp["nameapp"] = $nameapp;
            $dtapp["favicon"] = $favicon;
            
            $tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
            $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
        
            $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
            $data_product = $this->mod_voucher->listing(array("idgame"=>$idgame));
            $data_payment = $this->mod_payment->listing(array("status"=>"0"));
            $data_server = $this->mod_server->listing(array("idgame"=>$idgame));

            $saldo = $this->mod_user->getSaldo($idakun);
            $datauser = $this->mod_user->listing(array("iduser"=>$idakun));
            foreach($datauser as $u){
                $email =$u->email;
            }
            $data["head"] = $tmplt["header"];
            $data["footer"] = $tmplt["foot"];
            $data["game"]=$data_game;
            $data["product"]=$data_product;
            $data["payment"]=$data_payment;
            $data["saldo"]=$saldo;
            $data["email"]=$email;
            $data["iduser"]=$idakun;
            $data["server"]=$data_server;

            $this->load->view("content/gamevoucher_reseller",$data);
        }else{
            redirect("loginuser");
        }
    }


    public function game_dev($idgame)
    {

        $logged = $this->session->userdata("logged_in");
        $level = $this->session->userdata("rol");
        if(($logged=="yes")&&($level=="Reseller")){
            redirect("shop/game_reseller/".$idgame);
        }else{
            $logo = $this->mod_app->getLogo();
            $nameapp = $this->mod_app->getNamaApps();
            $favicon = $this->mod_app->getFavicon();

            $dtapp["logo"] = $logo;
            $dtapp["nameapp"] = $nameapp;
            $dtapp["favicon"] = $favicon;
            
            $tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
            $tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);    
        
            $data_game = $this->mod_game->listing(array("idgame"=>$idgame));
            $data_product = $this->mod_product->listing(array("idgame"=>$idgame));
            $data_payment = $this->mod_payment->listing();
            $data_server = $this->mod_server->listing(array("idgame"=>$idgame));

            $data["head"] = $tmplt["header"];
            $data["footer"] = $tmplt["foot"];
            $data["game"]=$data_game;
            $data["product"]=$data_product;
            $data["payment"]=$data_payment;
            $data["server"]=$data_server;

            $this->load->view("content/gamedevdetail",$data);
        }
    }
    public function invoice($kodetrans)
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
        // $data["game"]=$data_game;
        // $data["product"]=$data_product;
        // $data["payment"]=$data_payment;

        $this->load->view("content/invoice",$data);
    }
    public function invoice_voucher($kodetrans)
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

        $datatrans = $this->mod_transaksi->listing_voucher(array("kode"=>$kodetrans));
        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $data["kodetrans"]=$kodetrans;
        $data["datatrans"]=$datatrans;
        // $data["game"]=$data_game;
        // $data["product"]=$data_product;
        // $data["payment"]=$data_payment;

        $this->load->view("content/invoice_voucher",$data);
    }
    public function invoice_retail($kodetrans)
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
        // $data["game"]=$data_game;
        // $data["product"]=$data_product;
        // $data["payment"]=$data_payment;

        $this->load->view("content/invoice_retail",$data);
    }
    
    
    public function invoice_topup($kodetrans)
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

        $datatrans = $this->mod_topup->listing_join(array("topup.kode"=>$kodetrans));
        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $data["kodetrans"]=$kodetrans;
        $data["datatrans"]=$datatrans;
        // $data["game"]=$data_game;
        // $data["product"]=$data_product;
        // $data["payment"]=$data_payment;

        $this->load->view("content/invoice_topup",$data);
    }
    public function invoice_topup_retail($kodetrans)
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

        $datatrans = $this->mod_topup->listing_join(array("topup.kode"=>$kodetrans));
        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $data["kodetrans"]=$kodetrans;
        $data["datatrans"]=$datatrans;
        // $data["game"]=$data_game;
        // $data["product"]=$data_product;
        // $data["payment"]=$data_payment;

        $this->load->view("content/invoice_topup_retail",$data);
    }
    public function province()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: c5111c4e424ce3f0f1e1f7e56050c193"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        return json_decode($response);
        }
    }
    public function kota($idprovince)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$idprovince,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: c5111c4e424ce3f0f1e1f7e56050c193"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response);
            // return json_encode($response->rajaongkir->results);
        }
    }
    public function service($prov,$kota,$courier)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=105&destination=".$kota."&weight=1000&courier=".$courier,
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: c5111c4e424ce3f0f1e1f7e56050c193"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }
    public function ongkir()
    {
        $prov = $this->input->post("prov");
        $kota = $this->input->post("kota");
        $courier = $this->input->post("courier");
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=105&destination=".$kota."&weight=1000&courier=".$courier,
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: c5111c4e424ce3f0f1e1f7e56050c193"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }
}