<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 15-9-12
 * Time: 下午2:10
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_session extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'session_id' => array(
                'type' => 'INT',
                'constraint' => 1,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'session_auth' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'session_end' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
        ));
        $this->dbforge->add_key('session_id', TRUE);
        $this->dbforge->create_table('session');
    }

    public function down()
    {
        $this->dbforge->drop_table('session');
    }
}