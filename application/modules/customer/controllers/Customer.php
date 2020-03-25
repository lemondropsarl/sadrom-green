<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class Customer extends MY_Controller{

    function __construct(){

        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        
        $this->load->model('customer_model');
        $this->load->model('settings/setting_model');
        $this->load->model('messaging/messaging_model');
        $this->load->library('form_validation');
        $config['upload_path'] = './uploads/files/';
        $config['allowed_types'] = 'csv|xlsx';
        $config['max_size']     = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload',$config);
        
    }
    function list(){
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
       $this->form_validation->set_rules('fname','Prénom','required');
       if ($this->form_validation->run() == FALSE) {
           # code...
           $this->load->view('templates/header');
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
        $data['added'] = $this->session->flashdata('added');
        
        $this->load->view('templates/header');
        $this->load->view('templates/topbar_search');
        $this->load->view('templates/topbar_alerts');
        $this->load->view('templates/topbar_user_info');
        $this->load->view('import',$data);
        $this->load->view('templates/footer');
    }
    function edit(){
        $customer_id = $this->uri->segment(3);
        $data['customer'] = $this->customer_model->get_by_id($customer_id);
        $data['id'] = $customer_id;
        $data['field_options'] = $this->customer_model->get_areas();
            //form validation
        $this->form_validation->set_rules('fname','Prénom','required');
        if($this->form_validation->run() == false) {
                # code...
            $this->load->view('templates/header');
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
            $data['tpls'] = $this->messaging_model->get_tpl();
            $data['subs'] = $this->customer_model->get_subscriptions();
            $this->load->view('templates/header');
            $this->load->view('templates/topbar_search');
            $this->load->view('templates/topbar_alerts');
            $this->load->view('templates/topbar_user_info');
            $this->load->view('detail_customer', $data);
            $this->load->view('templates/footer');
        }

        
    }
    function account(){
        $data['contracts'] = $this->customer_model->get_contract();
        $this->load->view('templates/header');
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
    function batch_insert(){
       
        if ($this->upload->do_upload('exfile')){
           
            $file_name = $this->upload->data('full_path');
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($file_name);

            $sheetWork = $spreadsheet->getActiveSheet();
            $highestRow = $sheetWork->getHighestRow(); // e.g. 10
            $highestColumn = $sheetWork->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5
            $added=0;
            
            for ($row=2; $row <= $highestRow ; $row++) { 
                $model = array();
                $model[0] = $this->customer_model->get_customer_no(); // get customer NO
                for ($col=1; $col <= $highestColumnIndex ; $col++) { 
                   $model[$col] = $sheetWork->getCellByColumnAndRow($col,$row)->getValue();
                }
                $data = array(
                    'customer_no'=> $model[0],
                    'first_name'=> $model[1],
                    'last_name'=> $model[2],
                    'adresse'=> $model[3],
                    'area_id'=> intval($model[4]),
                    'phone_number'=> $model[5]
                );
                $customer_id = $this->customer_model->add_customer($data);
 
                $start_date = New DateTime();
                $date = New DateTime();
                $end_date = date_add($date,date_interval_create_from_date_string("365 days"));
                $acc = array(
                   'customer_id'=> $customer_id,
                   'subscription_id'=> intval($model[6]),
                   'start_date'=> $start_date->format("d-m-Y"),
                   'end_date'=> $end_date->format("d-m-Y")      
                );
                $this->customer_model->add_account($acc);
                $added++;
            }           
            $this->session->set_flashdata('added', strval($added));           
            redirect('customer/import','refresh');           
        }       
    }

}