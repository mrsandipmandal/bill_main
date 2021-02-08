<?php
$reqlevel = 1;
include("membersonly.inc.php");

$sl=$_REQUEST['sl'];

$prd  = new Init_Table();
$prd->set_table("main_driver","sl");
$prd->find($sl);
$nm=$prd->nm;
$mob=$prd->mob;
$licno=$prd->licno;
echo $nm."@@".$mob."@@".$licno;
?>