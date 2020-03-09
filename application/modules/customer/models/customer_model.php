<?php
class customer_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function get_customers(){
                //get all customers from View Customer
               // $this->db->group_by('last_name');
                $query =  $this->db->get('view_customer');
                return $query->result_array();
        }
        public function get_by_id($id){
                              
                $query = $this->db->get_where('view_customer',array('cust_id'=> $id));
                return $query->row_array();
        }
        public function update_customer($id, $data){
                
                $this->db->update('customers',$data, array('cust_id'=>$id));
                
        }
        public function add_customer($data){
                $this->db->insert('customers',$data);
                return $this->db->insert_id();
        }
        public function add_account($data){
                $this->db->insert('accounts',$data);
        }
        public function get_customer_no() {

                $code ='';
                for ($i=0; $i < 5 ; $i++) { 
                        # code...
                        $code .= rand(1,9);
                }            
                return "SD-".strval($code);
        }
        public function get_areas(){
                $query = $this->db->get('areas');
                return $query->result_array();
        }
        public function get_subscriptions(){
                $query = $this->db->get('subscriptions');
                return $query->result_array();
        }
        public function get_customer_sub_by_id ($id){
               $query =  $this->db->get_where('customer_subscription',array('cust_id'=>$id));
               return $query->row_array();
        }
        public function get_contract(){
                $query = $this->db->get('view_contract');
                return $query->result_array();
        }
        public function get_customer_count(){
               return  $this->db->count_all('customers');
        }
        public function get_customer_phone_number($id){
               $this->db->select('phone_number');
               $query = $this->db->get_where('customers',array('cust_id'=>$id));
               return $query->row_array();
        }
        public function get_customer_names($id){
                $this->db->select(array('first_name','last_name'));
               $query = $this->db->get_where('customers',array('cust_id'=>$id));
               return $query->row_array();
        }
        public function get_customer_address($id){
                $this->db->select('adresse');
                $query = $this->db->get_where('customers',array('cust_id'=>$id));
                return $query->row_array();
        }
        public function update_customer_account($data, $id){
                
                $this->db->update('accounts',$data,array('acc_id'=>$id));
        }
        public function get_acc_by_id($customer_id){
                $query = $this->db->get_where('accounts',array('customer_id'=> $customer_id));
                return $query->row_array();              
        }

}