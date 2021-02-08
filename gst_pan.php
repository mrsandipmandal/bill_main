<?php
$reqlevel = 1;
include("membersonly.inc.php");

$gstin=$_REQUEST['gstin'];

$pan=substr($gstin,2,10);	
$state=substr($gstin,0,2);	

echo $pan;
?>