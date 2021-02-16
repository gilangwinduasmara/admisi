<?php


class x extends CI_Controller{
	protected Response $response;
	
	
	public function __construct()
	{
		parent::__construct();
	}
	
}

class Response{
	public function json($res){
		return $this->output
					->set_content_type('application/json')
					->set_output(json_encode($res));
	}
}
