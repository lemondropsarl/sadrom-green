<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use Osms\Osms;

class messaging_model extends CI_Model{

    
    public function __construct(){
        parent::__construct();
        $this->load->model('settings/setting_model');
        $this->load->database();

    }
   
    public function sendSMS($sender, $receiver, $message, $senderName){
        $appId = $this->config->item('osms_appId');
        $apiToken = $this->setting_model->get_api_by_appId($appId);
        
        $senderAddress = 'tel:+'.$sender;
        $receiverAddress = 'tel:+'.$receiver;
        //Instatiate
        $config = array(
            'token' => $apiToken
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
    public function get_tpl(){
       $query = $this->db->get('tpl_sms');
      return  $query->result_array();
    }
    public function tpl_by_id($id){
        $query = $this->db->get_where('tpl_sms', array('sms_id'=>$id));
        return $query->row();      
    }
    public function tpl_add($data){
        $this->db->insert('tpl_sms',$data);
    }
    public function tpl_update($id,$data){
        $this->db->update('tpl_sms',$data, array('sms_id'=>$id));
    }
   
}






