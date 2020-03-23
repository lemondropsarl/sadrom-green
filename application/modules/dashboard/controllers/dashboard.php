<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{
        
        function __construct(){
            parent::__construct();
            $this->load->library('ion_auth');
            $this->load->model('settings/setting_model');
            $this->load->model('customer/customer_model');
            $this->load->model('messaging/messaging_model');
            $this->load->library('migration');
            $this->config->set_item('sess_driver','database');
            $this->migration->migrate_all_modules();
            /*if ($this->ion_auth->logged_in() ===FALSE) {
               redirect('auth/login');
            }*/
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
