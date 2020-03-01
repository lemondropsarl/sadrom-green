<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use Osms\Osms;

class messaging_model extends CI_Model{

    
    public function __construct(){
        parent::__construct();
        $this->load->model('setting_model');
        $this->load->database();

    }
   
    public function sendSMS($sender, $receiver, $message, $senderName){
        $appId = $this->config->item('osms_appId');
        $api = $this->setting_model->get_api_by_appId($appId);

        $senderAddress = 'tel:+'.$sender;
        $receiverAddress = 'tel:+'.$receiver;
        //Instatiate
        $config = array(
            'token' => $api['api_token']
        );
        $osms = New Osms($config);
        $osms->setVerifyPeerSSL(false);
        $response = $osms->sendSms($senderAddress,$receiverAddress,$message,$senderName);
        if (empty($response['error'])) {

            return true;
        } else {

            echo $response['error'];
            return false;
        }
        
    }
   
}






