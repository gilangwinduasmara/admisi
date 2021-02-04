<?php


class Fakultas_model extends Model{
	private $_table = "fakultas";
	public $nama_fakultas;
	
	public function rules(){
		return 
		[
			[
				'field' => 'nama_fakultas',
				'label' => 'Nama Fakultas',
				'rultes' => 'required'
			]
		];
	}
	public function getAll()
	{
		return $this->db->get($this->_table)->result();
	}
}
