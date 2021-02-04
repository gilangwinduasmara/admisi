<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_Add_akun extends CI_Migration {
	public function up() {
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'nama' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => false,
				'unique' => true
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
			),
			'email_verified_at' => array(
				'type' => 'timestamp',
				'null' => TRUE
			),
			'created_at timestamp default current_timestamp',
			'updated_at timestamp default current_timestamp', 
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('akun');
	}
	public function down() {
		$this->dbforge->drop_table('akun');
	}
}
