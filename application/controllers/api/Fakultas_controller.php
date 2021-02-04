<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function index_get(){
		echo "tes";
	}
}
