<?php

class Register_controller extends CI_Controller
{
	public function register_post(){
		redirect(base_url()+"index.php/login");
	}
}
