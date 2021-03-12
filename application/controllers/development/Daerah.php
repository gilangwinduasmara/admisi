<?php

class Daerah extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('curl');
		$this->load->model('provinsi_model');
		$this->load->model('kota_model');
		$this->load->model('kecamatan_model');
		$this->load->model('kelurahan_model');
	}
	 
	public function index(){
		$this->load->library('curl');
		$provinsi_result = json_decode($this->curl->simple_get('http://dev.farizdotid.com/api/daerahindonesia/provinsi'));
		echo "Daerah<br>";
		foreach($provinsi_result->provinsi as $key=>$provinsi){
			$provinsi_id = $this->provinsi_model->create([
				'provinsi' => $provinsi->nama
			]);
			$kota_result = json_decode($this->curl->simple_get('http://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi='.$provinsi->id));
			echo "|__".$provinsi->nama."<br>";
			foreach($kota_result->kota_kabupaten as $key=>$kota){
				$kecamatan_result = json_decode($this->curl->simple_get('http://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota='.$kota->id));
				$kota_id = $this->kota_model->create([
					'kota_kab' => $kota->nama,
					'provinsi_id' => $provinsi_id
				]);
				echo "|____".$kota->nama."<br>";
				foreach($kecamatan_result->kecamatan as $key=>$kecamatan){
					$kelurahan_result = json_decode($this->curl->simple_get('http://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan='.$kecamatan->id));
					$kecamatan_id = $this->kecamatan_model->create([
						'kecamatan' => $kecamatan->nama,
						'kota_id' => $kota_id
					]);
					echo "    |____".$kecamatan->nama."<br>";
					foreach($kelurahan_result->kelurahan as $key=>$kelurahan){
						$kelurahan_id = $this->kelurahan_model->create([
							'kelurahan' => $kelurahan->nama,
							'kecamatan_id' => $kecamatan_id
						]);
						echo "      |______".$kelurahan->nama."<br>";
					}	
				}
			}
		}
	}
}
