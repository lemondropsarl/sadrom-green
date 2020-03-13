<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{
        
        function __construct(){
            parent::__construct();
            $this->load->model('settings/setting_model');
            $this->load->model('customer/customer_model');
            $this->load->model('messaging/messaging_model');
        }

        function index(){
        $data['app'] = $this->setting_model->get_app_setting();
        $data['customers'] = $this->customer_model->customers();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/topbar_search');
		$this->load->view('templates/topbar_alerts');
		$this->load->view('templates/topbar_user_info');
		$this->load->view('index',$data);
        $this->load->view('templates/footer');
        }
}
