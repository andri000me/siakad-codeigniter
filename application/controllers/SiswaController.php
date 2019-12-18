<?php  

/**
 * 
 */
class SiswaController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('MyModel','Models');
	}

	public function index()
	{
		$this->load->view('siswa/template/header');
		$this->load->view('siswa/template/menu');
		$this->load->view('siswa/dasboard');
		$this->load->view('siswa/template/footer');

	}
}