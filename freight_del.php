<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
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