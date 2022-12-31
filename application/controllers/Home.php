<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'download', 'file'));
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('form_validation');
		$this->load->model("mod_app");
		$this->load->model("mod_admin");
		$this->load->model("mod_game");
		$this->load->model("mod_banner");
		$this->load->model("mod_fitur");
		$this->load->model("mod_news");
		$this->load->model("mod_conf");
		$this->load->model("mod_product");
		$this->load->model("mod_payment");
		$this->load->model("mod_transaksi");
		$this->load->model("mod_user");
		$this->load->model("mod_point");
		$this->load->model("mod_daftarreseller");
		$this->load->model("mod_tos");
		$this->load->model("mod_kontak");
    }
    public function index()
	{
		$logged = $this->session->userdata("logged_in");
		if ($logged == "yes") {
			redirect("home/dashboard");
		} else {
			redirect("home/login");
		}
	}
	public function datagamelist()
	{
		echo $this->mod_game->fetch_data($this->uri->segment(3));

		
	}
	public function profil()
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
			$this->load->view("content/profile", $data);
		} else {
			redirect('keluar');
		}
	}
	public function loginuser()
	{
		$logged = $this->session->userdata("logged_in");
		$rol = $this->session->userdata("rol");
		
		if (($logged == "yes")&&($rol=="User")||($rol=="Reseller")) {
			redirect("akun");
		} else {
			$nameapp = $this->mod_app->getNamaApps();
			$instansi = $this->mod_app->getInstansi();
			$logo = $this->mod_app->getLogo();
			$favicon = $this->mod_app->getFavicon();
			$data["nameapp"] = $nameapp;
			$data["instansi"] = $instansi;
			$data["logo"] = $logo;
			$data["favicon"] = $favicon;
			$this->load->view("loginuser", $data);
		}
	}
	public function forgetpass()
	{
		$nameapp = $this->mod_app->getNamaApps();
		$instansi = $this->mod_app->getInstansi();
		$logo = $this->mod_app->getLogo();
		$favicon = $this->mod_app->getFavicon();
		$data["nameapp"] = $nameapp;
		$data["instansi"] = $instansi;
		$data["logo"] = $logo;
		$data["favicon"] = $favicon;
		$this->load->view("forgetpass", $data);
	}
	public function resetpasswordproses()
	{
		$where["email"]=$this->input->post("email");
		$update["password"]=$this->encryption->encrypt($this->input->post("password"));
		if($this->mod_conf->UpdateData("user",$update,$where)){
			$output['hasil']=1;
            $output['pesan']='Data berhasil di update';  
        }else{
			$output['hasil']=0;
            $output['pesan']='Data gagal di update';  
        }
        echo json_encode($output);
	}
	public function resetpassproses()
	{
		$email_send = $this->input->post("email");
		$urlparam = $this->encryption->encrypt($email_send);
		$encrypted = strtr($urlparam, array('/' => '~'));
		$encrypteded = strtr($encrypted, array('+' => '__'));
		$message="Silahkan link dibawah ini untuk reset password akun kamu<br>".base_url()."resetpassword/".$encrypteded;
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
		$this->email->subject('Reset Password');
		$this->email->message($message);
	
		if($this->email->send()){
			$output['hasil'] = "1";
			$output['pesan'] = 'Link sudah dikirim ke email, silahkan cek email kamu';
		}else{
			$output['hasil'] = "0";
			$output['pesan'] = 'Gagal';
		}
		echo json_encode($output);
	}
	public function resetpassword($urlparam)
	{
		$email = strtr($urlparam, array('~' => '/'));
		$emailstr = strtr($email, array('__' => '+'));
		$decpass=$this->encryption->decrypt($emailstr);

		$nameapp = $this->mod_app->getNamaApps();
		$instansi = $this->mod_app->getInstansi();
		$logo = $this->mod_app->getLogo();
		$favicon = $this->mod_app->getFavicon();
		$data["nameapp"] = $nameapp;
		$data["instansi"] = $instansi;
		$data["logo"] = $logo;
		$data["favicon"] = $favicon;
		$data["email"] = $decpass;
		$this->load->view("resetpassword", $data);
	}
	// public function akundev()
	// {
	// 	$logo = $this->mod_app->getLogo();
    //     $nameapp = $this->mod_app->getNamaApps();
    //     $favicon = $this->mod_app->getFavicon();
	// 	$idakun = $this->session->userdata("id");
	// 	$data_user = $this->mod_user->listing(array("iduser"=>$idakun));
	// 	$data_payment = $this->mod_payment->listing();

	// 	$dtapp["logo"] = $logo;
    //     $dtapp["nameapp"] = $nameapp;
	// 	$dtapp["favicon"] = $favicon;
	// 	$dtapp["akun"] = $data_user;
	// 	$dtapp["payment"]=$data_payment;

	// 	$tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);
	// 	$dtapp["footer"]=$tmplt["foot"];
	// 	$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
	// 	$tmplt["menuakun"] = $this->load->view("template/menuakun",$dtapp, TRUE);
		
    //     $data["akun"]=$data_user;
    //     $data["head"] = $tmplt["header"];
	// 	$data["menuakun"]= $tmplt["menuakun"];
    //     $this->load->view("content/akundev",$data);
	// }
	public function akun()
	{
		$logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
        $favicon = $this->mod_app->getFavicon();
		$idakun = $this->session->userdata("id");
		$data_user = $this->mod_user->listing(array("iduser"=>$idakun));
		$data_payment = $this->mod_payment->listingTOPUP();

		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		$dtapp["akun"] = $data_user;
		$dtapp["payment"]=$data_payment;

		$tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);
		$dtapp["footer"]=$tmplt["foot"];
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
		$tmplt["menuakun"] = $this->load->view("template/menuakun",$dtapp, TRUE);
		
        $data["akun"]=$data_user;
        $data["head"] = $tmplt["header"];
		$data["menuakun"]= $tmplt["menuakun"];
        $this->load->view("content/akun",$data);
	}
	public function point()
	{
		$logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
        $favicon = $this->mod_app->getFavicon();
		$idakun = $this->session->userdata("id");
		$data_user = $this->mod_user->listing(array("iduser"=>$idakun));
		$data_payment = $this->mod_payment->listingTOPUP();
		$data_point=$this->mod_point->getJumlahPoint(array("iduser"=>$idakun,"jenis"=>"Debet"));
		$data_point_kurang=$this->mod_point->getJumlahPointKeluar(array("iduser"=>$idakun,"jenis"=>"Kredit"));

		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		$dtapp["akun"] = $data_user;
		$dtapp["payment"]=$data_payment;
		$dtapp["point"]=$data_point-$data_point_kurang;

		$tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);
		$dtapp["footer"]=$tmplt["foot"];
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
		$tmplt["menuakun"] = $this->load->view("template/menupoint",$dtapp, TRUE);
		
        $data["akun"]=$data_user;
        $data["head"] = $tmplt["header"];
		$data["menuakun"]= $tmplt["menuakun"];
        $this->load->view("content/akun",$data);
	}
	public function widthdraw()
	{
		$logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
		$favicon = $this->mod_app->getFavicon();
		$idakun = $this->session->userdata("id");
		$data_user = $this->mod_user->listing(array("iduser"=>$idakun));

		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		$dtapp["akun"] = $data_user;
		
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
		$tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);
		$tmplt["menuwithdraw"] = $this->load->view("template/menuwithdraw",$dtapp, TRUE);

        $data["akun"]=$data_user;
        $data["head"] = $tmplt["header"];
		$data["footer"] = $tmplt["foot"];
		$data["menuakun"]= $tmplt["menuwithdraw"];
        $this->load->view("content/akun",$data);
	}
	public function history()
	{
		$logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
		$favicon = $this->mod_app->getFavicon();
		$idakun = $this->session->userdata("id");
		$data_user = $this->mod_user->listing(array("iduser"=>$idakun));

		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		$dtapp["akun"] = $data_user;
		
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
		$tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);
		$tmplt["menuhistory"] = $this->load->view("template/menuhistory",$dtapp, TRUE);

        $data["akun"]=$data_user;
        $data["head"] = $tmplt["header"];
		$data["footer"] = $tmplt["foot"];
		$data["menuakun"]= $tmplt["menuhistory"];
        $this->load->view("content/akun",$data);
	}
	public function history_detail($kode)
	{
		$logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
		$favicon = $this->mod_app->getFavicon();
		$idakun = $this->session->userdata("id");
		$data_user = $this->mod_user->listing(array("iduser"=>$idakun));

		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		$dtapp["akun"] = $data_user;
		$dtapp["kode"] = $kode;

		$idtrans =$this->mod_transaksi->getIdTrans($kode);

		$dtapp["idtrans"] = $idtrans;
		
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
		$tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);
		$tmplt["menuhistorydet"] = $this->load->view("template/menuhistorydet",$dtapp, TRUE);

        $data["akun"]=$data_user;
        $data["head"] = $tmplt["header"];
		$data["footer"] = $tmplt["foot"];
		$data["menuakun"]= $tmplt["menuhistorydet"];
        $this->load->view("content/akun",$data);
	}
	public function setakun()
	{
		$logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
        $favicon = $this->mod_app->getFavicon();
		$idakun = $this->session->userdata("id");
		$data_user = $this->mod_user->listing(array("iduser"=>$idakun));

		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		$dtapp["akun"]= $data_user;
		
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
		$tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);
		$tmplt["menusetakun"] = $this->load->view("template/menusetakun",$dtapp, TRUE);

		
		
        $data["akun"]=$data_user;

        $data["head"] = $tmplt["header"];
		$data["footer"] = $tmplt["foot"];
		$data["menuakun"]= $tmplt["menusetakun"];
        $this->load->view("content/akun",$data);
	}
    public function login()
	{
		$logged = $this->session->userdata("logged_in");
		$rol = $this->session->userdata("rol");
		if (($logged == "yes")&&(($rol=="Superadmin")||($rol=="Admin Web"))) {
			redirect("home/dashboard");
		} else {
			$nameapp = $this->mod_app->getNamaApps();
			$instansi = $this->mod_app->getInstansi();
			$logo = $this->mod_app->getLogo();
			$favicon = $this->mod_app->getFavicon();
			$data["nameapp"] = $nameapp;
			$data["instansi"] = $instansi;
			$data["logo"] = $logo;
			$data["favicon"] = $favicon;
			$this->load->view("login", $data);
		}
	}
	public function register()
	{
		$logged = $this->session->userdata("logged_in");
		if ($logged == "yes") {
			redirect("home/dashboard");
		} else {
			$nameapp = $this->mod_app->getNamaApps();
			$instansi = $this->mod_app->getInstansi();
			$logo = $this->mod_app->getLogo();
			$favicon = $this->mod_app->getFavicon();
			$data["nameapp"] = $nameapp;
			$data["instansi"] = $instansi;
			$data["logo"] = $logo;
			$data["favicon"] = $favicon;
			$this->load->view("register", $data);
		}
	}
	public function prosesregister()
	{
		$email = $this->input->post("email");
		$nama = $this->input->post("nama");
		$nowa = $this->input->post("nowa");
		$password = $this->input->post("password");
		$passwordenc =  $this->encryption->encrypt($password);

		$emailuser = $this->mod_user->getEmail($email);
		if(empty($emailuser))
		{
			$datains["email"]=$email;
			$datains["nama"]=$nama;
			$datains["nowa"]=$nowa;
			$datains["level"]="User";
			$datains["createdate"]=date('Y-m-d h:i:s');
			$datains["password"]=$passwordenc;

			$insertdata = $this->mod_conf->InsertData("user",$datains);
		
			$urlparam = $this->encryption->encrypt($email);
			$encrypted = strtr($urlparam, array('/' => '~'));
			$encrypteded = strtr($encrypted, array('+' => '__'));
			$message="Silahkan link dibawah ini untuk verifikasi akun kamu<br>".base_url()."konfirmasiakun/".$encrypteded;
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
			$this->email->to($email);
			$this->email->subject('Konfirmasi Akun');
			$this->email->message($message);
		
			$sendemail =$this->email->send();
			if($insertdata&&$sendemail){
				$output['hasil'] = "1";
				$output['pesan'] = 'Silahkan konfirmasi akun anda, Link konfirmasi akun sudah dikirim ke email';
			}else{
				$output['hasil'] = "0";
				$output['pesan'] = 'Gagal';
			}
		}else{
			$output['hasil'] = "0";
			$output['pesan'] = 'Mohon maaf email anda sudah terdaftar';
		}

		echo json_encode($output);
	}
	public function konfirmakunproses()
	{
		$email = $this->input->post("email");
		$urlparam = $this->encryption->encrypt($email);
			$encrypted = strtr($urlparam, array('/' => '~'));
			$encrypteded = strtr($encrypted, array('+' => '__'));
			$message="Silahkan link dibawah ini untuk reset password akun kamu<br>".base_url()."konfirmasiakun/".$encrypteded;
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
			$this->email->to($email);
			$this->email->subject('Konfirmasi Akun');
			$this->email->message($message);
		
			$sendemail =$this->email->send();
			if($sendemail){
				$output['hasil'] = "1";
				$output['pesan'] = 'Silahkan konfirmasi akun anda, Link konfirmasi akun sudah dikirim ke email';
			}else{
				$output['hasil'] = "0";
				$output['pesan'] = 'Gagal';
			}
			echo json_encode($output);
	}
	public function konfirmasiakun($email)
	{
		if($email=="sukses")
		{
			$nameapp = $this->mod_app->getNamaApps();
			$instansi = $this->mod_app->getInstansi();
			$logo = $this->mod_app->getLogo();
			$favicon = $this->mod_app->getFavicon();
			$data["nameapp"] = $nameapp;
			$data["instansi"] = $instansi;
			$data["logo"] = $logo;
			$data["favicon"] = $favicon;
			$data["pesan"]="Selamat akun anda berhasil diaktifkan";
			$data["status"]=$email;
			$this->load->view("content/konfrimakun",$data);
		}else if($email=="gagal")
		{
			$nameapp = $this->mod_app->getNamaApps();
			$instansi = $this->mod_app->getInstansi();
			$logo = $this->mod_app->getLogo();
			$favicon = $this->mod_app->getFavicon();
			$data["nameapp"] = $nameapp;
			$data["instansi"] = $instansi;
			$data["logo"] = $logo;
			$data["favicon"] = $favicon;
			$data["pesan"]="Mohon maaf akun anda gagal diaktifkan";
			$data["status"]=$email;
			$this->load->view("content/konfrimakun",$data);

		}else{
			$paramurl = strtr($email, array('~' => '/'));
			$paramurlfinal = strtr($paramurl, array('__' => '+'));
			$decpass=$this->encryption->decrypt($paramurlfinal);

			$emailuser = $this->mod_user->getEmail($decpass);
			if(!empty($emailuser)){
				$where["email"]=$decpass;
				$update["status"]="1";
				if($this->mod_conf->UpdateData("user",$update,$where))
				{
					redirect("konfirmasiakun/sukses");
				}
			}else{

				redirect("konfirmasiakun/gagal");
			}
		}
	}
	public function konfirmasiemail()
	{
		$nameapp = $this->mod_app->getNamaApps();
		$instansi = $this->mod_app->getInstansi();
		$logo = $this->mod_app->getLogo();
		$favicon = $this->mod_app->getFavicon();
		$data["nameapp"] = $nameapp;
		$data["instansi"] = $instansi;
		$data["logo"] = $logo;
		$data["favicon"] = $favicon;
		$this->load->view("content/konfirmasiemail",$data);
	}
    public function loginproses()
    {
        $email = $this->input->post("email");
		$pass = $this->input->post("pass");
		
		$login = $this->mod_app->getLoginAdmin($email, $pass);
		if ($login) {
			$output['hasil'] = "1";
			$output['pesan'] = 'Selamat datang kembali';
		} else {
			$output['hasil'] = "0";
			$output['pesan'] = 'Mohon periksa kembali email password anda';
		}
		echo json_encode($output);
	}
	public function loginuserproses()
	{
		$email = $this->input->post("email");
		$pass = $this->input->post("pass");
		
		$emailavail = $this->mod_user->getEmail($email);
		if(!empty($emailavail))
		{
			$emailstat = $this->mod_user->getStatusAktif($email);
			if($emailstat=="0")
			{
				$output['hasil'] = "0";
				$output['url']=base_url()."konfirmasiemail";
				$output['button']="Verifikasi email";
				$output['pesan'] = 'Mohon maaf akun anda belum di verifikasi silahkan verifikasi email anda klik tombol dibawah ini';
			}else{
				$login = $this->mod_app->getLoginUser($email, $pass);
				if ($login) {
					$output['hasil'] = "1";
					$output['pesan'] = 'Selamat datang kembali';
				} else {
					$output['hasil'] = "0";
					$output['url']="";
					$output['pesan'] = 'Mohon periksa kembali email password anda';
				}
			}
		}else{
			$output['hasil'] = "0";
			$output['url']=base_url()."konfirmasiemail";
			$output['button']="Register akun";
			$output['pesan'] = 'Mohon maaf akun belum terdaftar, silahkan register akun pada klik tombol dibawah ini';
		}
		echo json_encode($output);
	}
    public function logout()
	{
		$logged = $this->session->userdata("logged_in");
		$rol = $this->session->userdata("rol");
		if (($logged == "yes")&&(($rol=="Superadmin")||($rol=="Admin Web"))) {
			$this->session->sess_destroy();
			redirect('home');
		} else {
			redirect("home/login");
		}
	}
	public function logoutuser()
	{
		$logged = $this->session->userdata("logged_in");
		if ($logged == "yes") {
			$this->session->sess_destroy();
			redirect('shop');
		} else {
			redirect("tolakakses");
		}
	}
	public function dashboard()
	{
		$logged = $this->session->userdata("logged_in");
		$rol = $this->session->userdata("rol");
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
			$this->load->view("content/dashboard", $data);
		} elseif(($logged == "yes")&&($rol=="Admin Web")){
			redirect('transaksi');
		} else {
			redirect('keluar');
		}
	}
	public function updateprofile()
	{
		$logged = $this->session->userdata("logged_in");
		if ($logged == "yes") {
			$idadmin = $this->input->post("idadmin");
			$username = $this->input->post("username");
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			$passwordenc =  $this->encryption->encrypt($password);
			$where["idadmin"]=$idadmin;
			$dataup["username"]=$username;
			$dataup["email"]=$email;
			if(!empty($password)){
				$dataup["password"]=$passwordenc;
			}
			if($this->mod_conf->UpdateData("admin",$dataup,$where))
			{
				$output['hasil']=1;
				$output['pesan']='Data berhasil di simpan';  
			}else{
				$output['hasil']=0;
				$output['pesan']='Data gagal di simpan';
			}
			echo json_encode($output);
		} else {
			redirect('keluar');
		}
	}
	public function kemitraanreseller()
	{
		$logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
		$favicon = $this->mod_app->getFavicon();	
		
		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
		$tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);

		$datakemitraan = $this->mod_daftarreseller->listing();
		   
        $data["kemitraan"] = $datakemitraan;
        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $this->load->view("content/kemitraanreseller",$data);
	}
	public function syaratketentuan()
	{
		$logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
		$favicon = $this->mod_app->getFavicon();	
		
		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
		$tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);

		$datatos = $this->mod_tos->listing();
		   
        $data["tos"] = $datatos;
        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $this->load->view("content/syaratketentuan",$data);
	}
	public function hubungikami()
	{
		$logo = $this->mod_app->getLogo();
        $nameapp = $this->mod_app->getNamaApps();
		$favicon = $this->mod_app->getFavicon();	
		
		$dtapp["logo"] = $logo;
        $dtapp["nameapp"] = $nameapp;
		$dtapp["favicon"] = $favicon;
		
		$tmplt["header"] = $this->load->view("template/headfont", $dtapp, TRUE);
		$tmplt["foot"] = $this->load->view("template/footfont", $dtapp, TRUE);

		$datakontak = $this->mod_kontak->listing();
		   
        $data["kontak"] = $datakontak;
        $data["head"] = $tmplt["header"];
        $data["footer"] = $tmplt["foot"];
        $this->load->view("content/hubungikami",$data);
	}
}