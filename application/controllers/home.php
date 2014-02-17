<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */	
	function __construct(){
		parent::__construct();
		$this->check_isvalidated();
	}
	public function index()	{
		$this->load->helper('url');
		$this->load->view('home');
	}
	private function check_isvalidated(){
		if(! $this->session->userdata('validated')){
			$this->load->helper('url');
        	redirect(base_url() .'index.php/login');
		}
	}
    public function do_logout(){
        $this->session->sess_destroy();
		$this->load->helper('url');
        redirect(base_url() . 'index.php/login');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */