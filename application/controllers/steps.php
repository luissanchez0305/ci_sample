<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class steps extends CI_Controller {

	public function index($step)
	{
		$this->load->view('step' . $step);
	}
	
}