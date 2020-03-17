<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
class Customer extends MY_Controller{

    function __construct(){

        parent::__construct();
        $this->load->model('customer_model');
        $this->load->model('settings/setting_model');
        $this->load->model('messaging/messaging_model');
        $this->load->library('form_validation');
        
    }
    function list(){
        $data['app'] =$this->setting_model->get_app_setting();
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
    function import(){
        $data['app'] =$this->setting_model->get_app_setting();
        $data['added'] = $this->session->flashdata('added');
        
        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar_search');
        $this->load->view('templates/topbar_alerts');
        $this->load->view('templates/topbar_user_info');
        $this->load->view('import',$data);
        $this->load->view('templates/footer');
    }
    function batch_insert(){
        $file_mimes = array
        (
            'text/x-comma-separated-values', 
            'text/comma-separated-values', 
            'application/octet-stream', 
            'application/vnd.ms-excel', 
            'application/x-csv', 
            'text/x-csv', 
            'text/csv', 
            'application/csv', 
            'application/excel', 
            'application/vnd.msexcel', 
            'text/plain', 
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        
        if (isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
           //get file extension
            $arr_file = explode('.', $_FILES['file']['name']);
            $extension = end($arr_file);

            //instantiate according to extension
            if('csv' == $extension) {
                $reader = new Csv();
            } else {
                $reader = new Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow(); // e.g. 10
            $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5
            $added=0;
            //Iterate in the file
            for ($row=0; $row <= $highestRow ; $row++) { 
               for ($col=0; $col <=$highestColumnIndex ; $col++) { 
                   $first_name = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                   $last_name = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                   $address = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                   $area = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                   $phoneNumber = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                   $subscription = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                   $custNo = $this->customer_model->get_customer_no(); // get customer NO
                   
                   $data  = array
                   (
                        'customer_no'=> $custNo,
                        'first_name'=> $first_name,
                        'last_name'=> $last_name,
                        'adresse'=> $address,
                        'area_id'=> $area,
                        'phone_number'=> $phoneNumber
                 );
                    //saving to database
                    $this->customer_model->add_customer($data);
               }
               $added++;
            }
            $this->session->set_flashdata('added', $added);           
            redirect('customer/import');

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