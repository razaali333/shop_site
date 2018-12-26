<?php 
class Test extends MX_Controller {

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

		echo "<h1>That is Test </h1>";
	}

	function hello()
	{
		$name="Raza Ali Jan";
		echo "This is $name";
	}
    
}
 ?>