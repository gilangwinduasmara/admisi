<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_Add_prodi extends CI_Migration {
	public function up() {
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'fakultas_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
			),
			'nama_prodi' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
			),
			'created_at timestamp default current_timestamp',
			'updated_at timestamp default current_timestamp', 
			'foreign key(fakultas_id) references fakultas(id)'
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('prodi');
	}
	public function down() {
		$this->dbforge->drop_table('prodi');
	}
}
