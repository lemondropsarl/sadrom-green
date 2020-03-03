<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Osms\Osms;



class setting_model extends CI_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

//API setting model
    public function get_apis(){
        $query = $this->db->get('api_setting');
        return $query->result_array();
        
    }
    public function get_api_by_appId($appId){
        $query = $this->db->get_where('api_setting',array('api_appId' =>$appId));
        $query->row_array();
        if ($query == null) {
            # code...
            echo "this api is not set please to go setting";
        }else {
            
            return $query;
        }
    }
    public function get_api_validity($name){
        $this->db->select('api_validity');
        $row = $this->db->get_where('api_setting'.array('api_name'=>$name));
        return $row->row_array();
    }
    public function api_insert($data){
        $this->db->insert('api_setting', $data);
    }
    public function is_token_valid($date){
        $expiration = date_create($date);
        $current = New Datetime();

        $diff = date_diff($current,$expiration);
        $check = intval($diff->format("%a"));
        if ($check <+ 90) {

            return true;
        }else {
            return false;
        }
    }
    public function api_generate_token($clientId,$clientSecret){
        $config = array(
            'clientId' => $clientId,
            'clientSecret' => $clientSecret 
        );

        $osms = new Osms($config);
        $osms->setVerifyPeerSSL(false);
        $response = $osms->getTokenFromConsumerKey();
        if (empty($response['error'])) {
            //echo $response['access_token'];
           return $response['access_token'];
           // echo $osms->getToken();
           // echo '<pre>'; print_r($response); echo '</pre>';
        } else {
            echo $response['error'];
        }

    }
    public function api_delete($id){
        $this->db->delete('api_setting',array('api_id'=>$id));
    }
    //General APP setting
    public function get_app_setting(){
        $query = $this->db->get('app_setting');
        return $query->row_array();
    }
    public function app_setting_add($data){
        $this->db->insert('app_setting',$data);
    }
}