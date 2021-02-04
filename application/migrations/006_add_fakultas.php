<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_Add_fakultas extends CI_Migration {
	public function up() {
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'nama_fakultas' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
			),
			'created_at timestamp default current_timestamp',
			'updated_at timestamp default current_timestamp', 
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('fakultas');
	}
	public function down() {
		$this->dbforge->drop_table('fakultas');
	}
}
