<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MX_Controller{

    function __construct(){

        parent::__construct();
        $this->load->model('setting_model');
        $this->load->library('form_validation');
        
    }
    function apis(){
        $data['apis'] =  $this->setting_model->get_apis();
        $data['app'] = $this->setting_model->get_app_setting();
        $this->load->view('templates/header',$data);
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
     
           $model = array();
           $model['app_name'] = $this->input->post('app_name');
           if (isset($_POST['app_tag'])) {
              $model['app_tag'] = $this->input->post('app_tag');
           }
           if (isset($_POST['logo'])) {
               $model['app_logo_url'] = $this->input->post('logo');
           }
           $model['app_contact'] = $this->input->post('sender');
           $model['app_contact_name'] =$this->input->post('sender_name');
           $model['app_version'] = '0.1.0';
           $this->setting_model->app_setting_add($model);
           redirect('settings/app_setting');     
    }
    function app_setting_edit(){

    }
    function app_setting(){
        

        //get header data
        
        $data['app'] = $this->setting_model->get_app_setting();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar_search');
        $this->load->view('templates/topbar_alerts');
        $this->load->view('templates/topbar_user_info');
        $this->load->view('app_setting', $data);
        $this->load->view('templates/footer');

    }
    
}