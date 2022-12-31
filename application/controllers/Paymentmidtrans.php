<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentmidtrans extends CI_Controller {

	public function __construct()
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
        

		\Midtrans\Config::$serverKey = "SB-Mid-server-6KtEcfI5ykCtaIBQoSzP4ZjX";
		\Midtrans\Config::$isProduction = false;
		\Midtrans\Config::$isSanitized = true;
		\Midtrans\Config::$is3ds = true;

    }
    public function cobamidtrans(){
		$params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'payment_type' => 'gopay',
            // 'gopay' => array(
            //     'enable_callback' => true,                // optional
            //     'callback_url' => 'someapps://callback'   // optional
            // )
        );
         
        $response = \Midtrans\CoreApi::charge($params);
        

		print_r($response);
	}
}