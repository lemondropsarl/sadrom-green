<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MX_Controller{

    function __construct(){

        parent::__construct();
        $this->load->model('setting_model');
        $this->load->library('form_validation');
        $this->load->database();
    }
}