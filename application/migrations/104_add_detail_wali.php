<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_Add_detail_wali extends CI_Migration {
	public function up() {
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'npsn' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
			),
			'nama' => array(
				'nama' => 'VARCHAR',
				'constraint' => '255',
				'null' => false,
				'unique' => true
			),
			'jurusan' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'alamat' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'kota' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'provinsi' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'tahun_masuk' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
			),
			'tahun_lulus' => array(
				'type' => 'VARCHAR',
				'constraint' => '5',
			),
			'status' => array(
				'type' => 'ENUM("SMA", "SMK", "S1", "S2)',
				'constraint' => '5',
			),
			'upload_ijazah' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'upload_daftar_nilai' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'created_at timestamp default current_timestamp',
			'updated_at timestamp default current_timestamp', 
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('detail_wali');
	}
	public function down() {
		$this->dbforge->drop_table('detail_wali');
	}
}
