<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Site_security extends MX_Controller
{

function __construct() {
parent::__construct();
}

function test()
{
	$name="Raza";
	$hashname=$this->_hash_string($name);
	echo "Your name is $name <br>";
	echo "<hr>";
	$submitted_name="Raza";
	$result=$this->_verify_hash($submitted_name,$hashname);
	if($result==TRUE)
	{
		echo "True";
	}
	else{
		echo  "False";
	}
}
function _hash_string($str){
	$hash_string = password_hash($str, PASSWORD_BCRYPT, array('cost' => 11));
	return $hash_string;
}
function _verify_hash($plain_text_str,$hash_string)
{
	  $result = password_verify($plain_text_str, $hash_string);
    return $result;
}
 
function _make_sure_is_admin(){
	$is_admin = TRUE;
	if($is_admin != TRUE){
		redirect('Site_security/not_allowed');
	}
}
function not_allowed(){
	echo 'You Cant Be Here';
}


}