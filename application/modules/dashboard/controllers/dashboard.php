<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller{
        
        function __construct(){
            parent::__construct();
        }

        function index(){
	
		$this->load->view('templates/header');
		$this->load->view('templates/topbar_search');
		$this->load->view('templates/topbar_alerts');
		$this->load->view('templates/topbar_user_info');
		$this->load->view('index');
        $this->load->view('templates/footer');
        }
}
