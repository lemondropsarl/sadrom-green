<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller{

    function __construct(){

        parent::__construct();
        $this->load->model('customer_model');
        $this->load->model('settings/setting_model');
        $this->load->model('messaging/messaging_model');
        $this->load->library('form_validation');
        $this->load->database();
    }
    function list(){
        $data['header'] =$this->setting_model->get_app_setting();
        $data['clients'] =  $this->customer_model->get_customers();
        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar_search');
        $this->load->view('templates/topbar_alerts');
        $this->load->view('templates/topbar_user_info');
        $this->load->view('list_customer', $data);
        $this->load->view('templates/footer');
    }
    function insert(){
        //get different data
       $data['customer_no'] = $this->customer_model->get_customer_no();
       $data['field_options'] = $this->customer_model->get_areas();
       $data['sub_options'] = $this->customer_model->get_subscriptions();
       $data['header'] =$this->setting_model->get_app_setting();
       $this->form_validation->set_rules('fname','Prénom','required');
       if ($this->form_validation->run() == FALSE) {
           # code...
           $this->load->view('templates/header',$data);
           $this->load->view('templates/topbar_search');
           $this->load->view('templates/topbar_alerts');
           $this->load->view('templates/topbar_user_info');
           $this->load->view('add_customer', $data);
           $this->load->view('templates/footer');
       }else {
           
        $model = array(
            'customer_no'=> $this->input->post('custno'),
            'first_name'=> $this->input->post('fname'),
            'last_name'=> $this->input->post('lname'),
            'adresse'=> $this->input->post('address'),
            'area_id'=> $this->input->post('darea'),
            'phone_number'=> $this->input->post('pnumber')
        );

        //insert into db
         $customer_id = $this->customer_model->add_customer($model);
        
         $start_date = New DateTime();
         $date = New DateTime();
         $end_date = date_add($date,date_interval_create_from_date_string("365 days"));
         $acc = array(
            'customer_id'=> $customer_id,
            'subscription_id'=> $this->input->post('dsub'),
            'start_date'=> $start_date->format("d-m-Y"),
            'end_date'=> $end_date->format("d-m-Y")

         );
         $this->customer_model->add_account($acc);
        //load successfull ;essage
        redirect('customer/list');
       }
    }
    function edit(){
        $customer_id = $this->uri->segment(3);
       
            $data['customer'] = $this->customer_model->get_by_id($customer_id);
            $data['id'] = $customer_id;
            $data['field_options'] = $this->customer_model->get_areas();
            $data['header'] =$this->setting_model->get_app_setting();
            //form validation
            $this->form_validation->set_rules('fname','Prénom','required');

            if ($this->form_validation->run() == false) {
                # code...
                $this->load->view('templates/header', $data);
                $this->load->view('templates/topbar_search');
                $this->load->view('templates/topbar_alerts');
                $this->load->view('templates/topbar_user_info');
                $this->load->view('edit_customer', $data);
                $this->load->view('templates/footer');
            }else {
                
                $id = $this->input->post('hid');
                if ($id == NULL) {
                    # code...
                    echo "error";
                }else{

                    $model = array(
                        'first_name'=> $this->input->post('fname'),
                        'last_name'=> $this->input->post('lname'),
                        'adresse'=> $this->input->post('address'),
                        'area_id'=> $this->input->post('darea'),
                        'phone_number'=> $this->input->post('pnumber')
                    );
                    $this->customer_model->update_customer($id,$model);
                    redirect('customer/details/'.$id);
                }
              
            }
       
    }
    function details(){
        $customer_id = $this->uri->segment(3);
        if ($customer_id == '') {
            echo "error";
            # code...
        }else{
            $data['customer'] = $this->customer_model->get_by_id($customer_id);
            $data['subscription'] = $this->customer_model->get_customer_sub_by_id($customer_id);
            $data['header'] =$this->setting_model->get_app_setting();
            $data['tpls'] = $this->messaging_model->get_tpl();
            $data['subs'] = $this->customer_model->get_subscriptions();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar_search');
            $this->load->view('templates/topbar_alerts');
            $this->load->view('templates/topbar_user_info');
            $this->load->view('detail_customer', $data);
            $this->load->view('templates/footer');
        }

        
    }
    function account(){
        $data['contracts'] = $this->customer_model->get_contract();
        $data['header'] =$this->setting_model->get_app_setting();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar_search');
        $this->load->view('templates/topbar_alerts');
        $this->load->view('templates/topbar_user_info');
        $this->load->view('ctr_customer', $data);
        $this->load->view('templates/footer');
    }
    function account_renew(){
       $customer_id =  $this->uri->segment(3);
       $acc = $this->customer_model->get_acc_by_id($customer_id);
       $acc_id = intval($acc['acc_id']);

       $start_date = New DateTime();
       $date = New DateTime();
       $end_date = date_add($date,date_interval_create_from_date_string("365 days"));
       $acc = array(
          'start_date'=> $start_date->format("d-m-Y"),
          'end_date'=> $end_date->format("d-m-Y")

       );
       $this->customer_model->update_customer_account($data,$acc_id);
       redirect('customer/details/'.$customer_id);
        
    }
    function account_upgrade(){
       $customer_id =  $this->uri->segment(3);
       $acc = $this->customer_model->get_acc_by_id($customer_id);
       $acc_id = intval($acc['acc_id']);
       $data  = array(
           'subscription_id'=>$this->input->post('sub') 
       );
       $this->customer_model->update_customer_account($data,$acc_id);
       redirect('customer/details/'.$customer_id);
        
    }
    function account_suspend(){}

}