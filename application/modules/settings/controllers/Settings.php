<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MX_Controller{

    function __construct(){

        parent::__construct();
        $this->load->model('setting_model');
        $this->load->library('form_validation');
        $this->load->database();
    }
    function apis(){
        $data['apis'] =  $this->setting_model->get_apis();
       
        $this->load->view('templates/header');
        $this->load->view('templates/topbar_search');
        $this->load->view('templates/topbar_alerts');
        $this->load->view('templates/topbar_user_info');
        $this->load->view('api_setting', $data);
        $this->load->view('templates/footer');

    }
    function api_add(){

        //set validity TIME
        $current = New DateTime();
        $validity = date_add($current, date_interval_create_from_date_string("90 days"));

        //generate token
        $clientId = $this->input->post('clientId');
        $clientSecret = $this->input->post('clientsecret');
        $token = $this->setting_model->api_generate_token($clientId,$clientSecret);
        //set data model
       $data = array
        (
            'api_name' => $this->input->post('name'),
            'api_appId'=> $this->input->post('appId'),
            'api_clientId'=>$clientId,
            'api_clientSecret' => $clientSecret,
            'api_token' => $token,
            'api_validity' => $validity->format("d-m-Y")
         );

         //save to database
         $this->setting_model->api_insert($data);

         redirect('settings/apis');
    }
    function api_token(){}
    function api_remove($id){}
    function app_setting_add(){

    }
    function app_setting_edit(){

    }
    function get_app_setting(){

    }
    
}