<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$user_current_level = $Members->User_Details->userlevel;
$user_current_bcd = $Members->User_Details->bcd;
$user_currently_loged = $Members->User_Details->username;
$eby = $Members->User_Details->username;

if($eby!='')
{
$prd  = new Init_Table();
$prd->set_table("main_freight","eby");
$prd->delete_all($eby);
}
?>
<script>
 alert("Delete Successfully. Thank You...");
window.document.location="freight.php";   
</script>