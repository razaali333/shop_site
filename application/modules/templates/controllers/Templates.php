<?php 
class Templates extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		// $this->load->library('session');
		// 		$autoload = array(
		// 	'helper'    => array('url', 'form'),
		// 	'libraries' => array('session'),
		// );
	}	

    function index(){
		 //$this->load->library('session');

		echo "<h1>This is templates modules </h1>";
	}

	function public_view($data)
	{
		$this->load->view('public_view',$data);
	}


	function public_jqm($data)
	{
		$this->load->view('public_jqm',$data);
	}


	function admin($data)
	{
		$this->load->view('admin',$data);
	}
    
}
 ?>