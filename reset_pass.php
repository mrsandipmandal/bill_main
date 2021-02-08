<?php
 ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);

$sl=$_REQUEST['sl'];

$pdo_obj  = new Init_Table();
$pdo_obj->set_table("main_signup","sl");
if($sl!='')
{
$pdo_obj->password='123';	
$pdo_obj->pass=md5('123');	
$pdo_obj->sl=$sl;	
$pdo_obj->save();
}
?>
<script>
    alert("Reset Successfully. Thank You.....");
</script>
