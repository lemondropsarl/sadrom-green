<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{
        
        function __construct(){
            parent::__construct();
            $this->load->model('settings/setting_model');
            $this->load->database();
        }

        function index(){
        $data['header'] = $this->setting_model->get_app_setting();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/topbar_search');
		$this->load->view('templates/topbar_alerts');
		$this->load->view('templates/topbar_user_info');
		$this->load->view('index');
        $this->load->view('templates/footer');
        }
}
