<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Messaging extends MX_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('messaging_model');
        $this->load->database();
    }

    public function send_sms($callfrom){

        $customer_id = "";
        $receiver = $this->input->post('pnumber');
        $message = $this->input->post('message');
        //get the sender from app setting
        $sender ="";
        $sender_name="";

        $done = $this->messaging_model->sendSMS($sender,$receiver,$message,$sender_name);
        if (!$done) {
            # code...
        }else {
            
            //Show a cconfirmation dialog
            //redirect
            if ($callfrom == 'detail') {
                # code...
                redirect('customer/details'.$customer_id);
            }else {
                redirect('customer/account');
            }
        }

    }
   
    
}

?>