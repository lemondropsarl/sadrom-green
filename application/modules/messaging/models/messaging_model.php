<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use Osms\Osms;

class messaging_model extends CI_Model{

    private $clientId = '';
    private $clientSecret ='';
    private $myConfig = array('clientId','clientSecret','token');
    public function __construct(){
        parent::__construct();
        $this->load->database();

    }
    private function initialize($client_id, $client_secret){
        $this->clientId = $client_id;
        $this->clientSecret = $client_secret;

        $this->myConfig['clientId'] = $this->clientId;
        $this->myConfig['clientSecret'] = $this->clientSecret;

    }
    public function sendSMS($sender, $receiver, $message, $senderName){

        //Instatiate
        $osms = New Osms($this->myConfig);

        $respnse = $osms->sendSms($sender,$receiver,$message,$senderName);
        if (empty($response['error'])) {

            return true;
        } else {

            echo $response['error'];
            return false;
        }
        
    }
    function check_token_validity(){}
    function generate_token(){}
    function get_api_settings(){}
}






