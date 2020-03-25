<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Messaging extends MY_Controller{

    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('settings/setting_model');
        $this->load->model('customer/customer_model');
        $this->load->model('messaging_model');
        $this->load->config('app',TRUE);
    }

    function send(){

        
        $receiver = $this->input->post('dphone');
        $message = $this->input->post('smstxt');
        //get the sender from app setting
        $sender = $this->config->item('osms_sender','app');
        $sender_name= $this->config->item('osms_sender_name','app');

        $done = $this->messaging_model->sendSMS($sender,$receiver,$message,$sender_name);
        if (!$done) {
            # code...
            echo "message not sent";
        }else {
            
            echo "message sent successfully";
        }

    }
    function sms(){
        $mycustomers = $this->customer_model->customers();
        $rows = array();
        foreach ($mycustomers as $key => $value) {
                $rows[$key]['name'] = $value['first_name'].' '.$value['last_name'];
                $rows[$key]['phone'] = $value['phone_number'];
        }
       $data['customers'] = $rows;
        $this->load->view('templates/header');
        $this->load->view('templates/topbar_search');
        $this->load->view('templates/topbar_alerts');
        $this->load->view('templates/topbar_user_info');
        $this->load->view('sms',$data);
        $this->load->view('templates/footer');
    }
    function template(){
        $data['tpls'] = $this->messaging_model->get_tpl();

        $this->load->view('templates/header');
        $this->load->view('templates/topbar_search');
        $this->load->view('templates/topbar_alerts');
        $this->load->view('templates/topbar_user_info');
        $this->load->view('tpl', $data);
        $this->load->view('templates/footer');
    }
    function addtpl(){

        $data = array(
            'sms_name'=> $this->input->post('sms_name'),
            'sms_description' => $this->input->post('sms_desc')
        );
        $this->messaging_model->tpl_add($data);
        redirect('messaging/template');
    }
    function editpl(){
        $id = $this->input->post('sms_id');
        $data = array(
            'sms_name'=> $this->input->post('sms_name'),
            'sms_description' => $this->input->post('sms_desc')
        );
        $this->messaging_model->tpl_update($id,$data);
        redirect('messaging/template');
    }
    function tpl(){
        

            $id = $_POST('id');
           
           $tpl = $this->messaging_model->tpl_by_id($id);

           return json_encode($tpl['sms_description']);
        
    }
}

?>