<?php
 ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$user_current_level = $Members->User_Details->userlevel;
$user_current_bcd = $Members->User_Details->bcd;
$user_currently_loged = $Members->User_Details->username;	
function array_except($array, $keys) {
  return array_diff_key($array, array_flip((array) $keys));   
}

$sl=$_REQUEST['sl'];
$val=$_REQUEST['val'];
		if($sl!='')
		{
		if($val=='true'){$fr_stat=1;}else{$fr_stat=0;}
		$pdo_obj  = new Init_Table();
		$pdo_obj->set_table("main_brnch","sl");	
		$pdo_obj->sl=$sl;	
		$pdo_obj->fr_stat=$fr_stat;	
		$pdo_obj->save();	
		}


?>
	