<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_initial_install extends MY_Migration{

    private $tables;
    private $views;
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->config('customer',TRUE);
        $this->tables = $this->config->item('tables', 'customer');
        $this->views  = $this->config->item('views', 'customer');
    }
    public function up(){
        //drop table 'area' 
        $this->dbforge->drop_table($this->tables['areas'],TRUE);
        $this->dbforge->add_field([
            'area_id' => [
				'type'           => 'INT',
				'constraint'     => '11',
				'auto_increment' => TRUE
			],
			'area_name' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
			],
        ]);
        $this->dbforge->add_key('area_id', TRUE);
        $this->dbforge->create_table($this->tables['areas']);
        
        //dump data in the 'area' table
        $data =[
            ['area_name' => 'Dilala'],
            ['area_name' => 'Manika']
        ];
        $this->db->insert_batch($this->tables['areas'], $data);

        //drop 'customers' table
        $this->dbforge->drop_table($this->tables['customers'],TRUE);
        $this->dbforge->add_field([
            'cust_id' =>[
                'type' =>'INT',
                'constraint' =>'11',
                'auto_increment' =>TRUE,
            ],
            'customer_no' =>[
                'type' => 'VARCHAR',
                'constraint' =>'50',
                'unique' => TRUE,
            ],
            'first_name' =>[
                'type' =>'VARCHAR',
                'constraint' => '100'
            ],
            'last_name' =>[
                'type' =>'VARCHAR',
                'constraint' => '100'
            ],
            'adresse' =>[
                'type' =>'VARCHAR',
                'constraint' => '250'
            ],
            'phone_number' =>[
                'type' =>'VARCHAR',
                'constraint' => '100'
            ],
            'area_id' =>[
                'type' =>'INT',
                'constraint' => '11'
            ]
        ]);
        $this->dbforge->add_key('cust_id',TRUE);
        $this->dbforge->create_table($this->tables['customers']);
        $this->dbforge->modify_column($this->tables['customers'],[
            'CONSTRAINT fk_id FOREIGN KEY(area_id) REFERENCES areas(area_id)'
        ]);
        
        //drop 'customers' table
        $this->dbforge->drop_table($this->tables['subscriptions'],TRUE);
        $this->dbforge->add_field([
            'id' =>[
                'type' =>'INT',
                'constraint' =>'11',
                'auto_increment' => TRUE
            ],
            'sub_name' =>[
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'sub_description' =>[
                'type' => 'VARCHAR',
                'constraint' => '250'
            ],
            'sub_price' =>[
                'type' => 'double',              
            ]
        ]);
        $this->dbforge->add_key('id',TRUE);
        $this->dbforge->create_table($this->tables['subscriptions']);
        //dumb some data

        $data = [
            [
                'sub_name' => 'Bronze',
                'sub_description' =>'une poubelle plastique',
                'sub_price' => 25
            ],
            [
                'sub_name' => 'Cuivre',
                'sub_description' =>'deux poubelles plastique(1 fut), collecte une fois par semaine, 50 USD LE MOIS',
                'sub_price' => 50
            ],
            [
                'sub_name' => 'Platine',
                'sub_description' =>'trois poubelles plastique(2 fut), collecte deux fois par semaine, 100 USD le mois',
                'sub_price' => 100
            ],
            [
                'sub_name' => 'Diamant',
                'sub_description' =>'quatre repoubelles plastique(3 fut), collecte trois fois par semaine, 150 USD le mois',
                'sub_price' => 150
            ],
        ];
        $this->db->insert_batch($this->tables['subscriptions'], $data);

        //drop 'account' table
        $this->dbforge->drop_table($this->tables['accounts'],TRUE);
        $this->dbforge->add_field([
            'acc_id' =>[
                'type' =>'INT',
                'constraint' =>'11',
                'auto_increment' =>TRUE
            ],
            'customer_id' =>[
                'type' =>'INT',
                'constraint' =>'11'
            ],
            'subscription_id' =>[
                'type' =>'INT',
                'constraint' =>'11'
            ],
            'is_active' =>[
                'type' =>'tinyint',
                'constraint' =>'4',
                'default' => 1
            ],
            'start_date' =>[
                'type' =>'VARCHR',
                'constraint' =>'50'
            ],
            'end_date' =>[
                'type' =>'VARCHAR',
                'constraint' =>'50'
            ]
        ]);
        $this->dbforge->add_key('acc_id',TRUE);
        $this->dbforge->create_table($this->tables['accounts']);
        
        //creating views
        $view_customer = 'CREATE VIEW'.$this->views['view_customer'].'AS select `customers`.`cust_id` AS `cust_id`, `customers`.`customer_no` AS `customer_no`, `customers`.`last_name` AS `last_name`,`customers`.`first_name` AS `first_name`, `customers`.`adresse` AS `address`, `customers`.`phone_number` AS `phone_number`, `areas`.`area_name` AS `commune` from (`customers` join `areas`) where (`customers`.`area_id` = `areas`.`area_id`)';
        $this->db->query($view_customer);

        $view_contract = 'CREATE VIEW'.$this->views['view_contract'].'AS select `customers`.`cust_id` AS `cust_id`,`customers`.`first_name` AS `first_name`,`customers`.`last_name` AS `last_name`,`subscriptions`.`sub_name` AS `sub_name`,`accounts`.`start_date` AS `start_date`,`accounts`.`end_date` AS `exp_date`,`accounts`.`is_active` AS `sub_status` from ((`customers` join `accounts`) join `subscriptions`) where ((`customers`.`cust_id` = `accounts`.`customer_id`) and (`accounts`.`subscription_id` = `subscriptions`.`id`))';
        $this->db->query($view_contract);
        
        $view_cust_sub ='CREATE VIEW'.$this->views['customer_subscription']. 'AS select `subscriptions`.`sub_name` AS `sub_name`,`accounts`.`customer_id` AS `cust_id`,`accounts`.`is_active` AS `sub_status`,`accounts`.`start_date` AS `start_date`,`accounts`.`end_date` AS `end_date` from (`subscriptions` join `accounts`) where (`subscriptions`.`id` = `accounts`.`subscription_id`)';
        $this->db->query($view_cust_sub);

    }
    public function down(){
        $this->dbforge->drop_table($this->tables['areas'],TRUE);
        $this->dbforge->drop_table($this->tables['customers'],TRUE);
        $this->dbforge->drop_table($this->tables['subscriptions'],TRUE);
        $this->dbforge->drop_table($this->tables['accounts'],TRUE);
    }
    
}