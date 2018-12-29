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

		echo "<h1>This is templates modules  here i ready for the new changes</h1>";
		// $this->public_view();
	}

	function public_view($data)
	{
		$this->load->view('public_view');
		// echo "this is public view";
	}


	function public_jqm($data)
	{
		$this->load->view('public_jqm');
	}


	function admin($data)
	{
		if(!isset($data['view_module'])){
			$data['view_module'] = $this->uri->segment(1);
		}
	 	 $this->load->view('admin',$data);
	}
    
}
 ?>