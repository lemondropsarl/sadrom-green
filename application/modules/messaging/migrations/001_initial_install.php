<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_initial_install extends MY_Migration {
    
    private $tables;

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->config('messaging_config',TRUE);
        $this->tables = $this->config->item('tables','messaging_config');
        
    }

    public function up() {
        //drop table tpl_sms
        $this->dbforge->drop_table($this->tables['tpl_sms'],TRUE);
        //adding field
        $this->dbforge->add_field([
            'sms_id' => [
                'type' =>'INT',
                'constraint' =>'11',
                'auto_increment' => TRUE
            ],
            'sms_name' =>[
                'type' =>'VARCHAR',
                'constraint' =>'50'
            ],
            'sms_description' =>[
                'type' =>'VARCHAR',
                'constraint' =>'160'
            ]
        ]);
        $this->dbforge->add_key('sms_id',TRUE);
        $this->dbforge->create_table($this->tables['tpl_sms']);
    }

    public function down() {
        $this->dbforge->drop_table($this->tables['tpl_sms'],TRUE);
    }

}

/* End of file initial_install.php */
