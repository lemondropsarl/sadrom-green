<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_version extends MY_Migration {

    public function __construct()
    {
        $this->load->dbforge();
        $this->load->library('migration');
        
    }

    public function up() {
        $this->dbforge->drop_table('version',TRUE);
        $this->dbforge->add_field(array('current_version'=>[
            'type' =>'VARCHAR',
            'constraint' =>'3'
        ]));
        $this->dbforge->create_table('version',TRUE);
        $this->db->insert('version', array('current_version'=>'0.1.0'));
        
    }

    public function down() {
        $this->dbforge->drop+table('version',TRUE);
    }

}

/* End of file version.php */
