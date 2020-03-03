<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Messaging extends MY_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('messaging_model');
        $this->load->model('settings/setting_model');
        $this->load->database();
    }

    public function send_sms(){

        
        $receiver = $this->input->post('pnumber');
        $message = $this->input->post('message');
        //get the sender from app setting
        $sender = $this->setting_model->get_sender();
        $sender_name=$this->setting_model->get_sender_name();

        $done = $this->messaging_model->sendSMS($sender,$receiver,$message,$sender_name);
        if (!$done) {
            # code...
            echo "message not sent";
        }else {
            
            echo "message sent successfully";
        }

    }   
}

?>