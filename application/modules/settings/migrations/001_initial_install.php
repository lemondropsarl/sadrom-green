<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_initial_install extends MY_Migration {
    private $tables;

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->config('setting_config',TRUE);
        $this->tables = $this->config->item('tables','setting_config');
    }

    public function up() {
        $this->dbforge->drop_table($this->tables['api_setting'],TRUE);
        $this->dbforge->add_field([
            'api_id' =>[
                'type' => 'INT',
                'constraint' =>'11',
                'auto_increment' => TRUE
            ],
            'api_name' =>[
                'type' => 'VARCHAR',
                'constraint' =>'100'
            ],
            'api_appId' =>[
                'type' => 'VARCHAR',
                'constraint' =>'250'
            ],
            'api_clientId' =>[
                'type' => 'VARCHAR',
                'constraint' =>'250'
            ],
            'api_clientSecret' =>[
                'type' => 'VARCHAR',
                'constraint' =>'250'
            ],
            'api_token' =>[
                'type' => 'VARCHAR',
                'constraint' =>'250'
            ],
            'api_validity' =>[
                'type' => 'VARCHAR',
                'constraint' =>'100'
            ],
            'api_status' =>[
                'type' => 'tinyint',
                'constraint' =>'4'
            ],
        ]);
        $this->dbforge->add_key('api_id',TRUE);
        $this->dbforge->create_table($this->tables['api_setting']);

    }

    public function down() {
        $this->dbforge->drop_table($this->tables['api_setting'],TRUE);
    }

}

/* End of file initial_install.php */
