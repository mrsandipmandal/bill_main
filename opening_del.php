<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$user_current_level = $Members->User_Details->userlevel;
$user_current_bcd = $Members->User_Details->bcd;
$user_currently_loged = $Members->User_Details->username;
$eby = $Members->User_Details->username;



if($_REQUEST['sl']!='')
{
    $fld2['sl']=$_REQUEST['sl'];
    $op2['sl']="=, ";

$plist  = new Init_Table();
$plist->set_table("main_drcr", "sl");

$main_drcr_log  = new Init_Table();
$main_drcr_log->set_table("main_drcr_log","id");

$fld=array('sl','vno','bcd','sbill','cbill','vendor','cid','dt','nrtn','typ','idt','mtd','mtddtl','dldgr','cldgr','amm','edt','eby','edtm','pno','it','stat');

$group2=$plist->search_custom_ultra($fld2,$op2,'',array('sl' => 'ASC'),$fld);
foreach($group2 as $key2=>$ptp)
{
date_default_timezone_set('Asia/Kolkata');
$ptp["eby"]=$Members->User_Details->username;
$ptp["edt"]=date('Y-m-d');
$ptp["edtm"]=date('d-M-Y h:i:s A'); 

$main_drcr_log->create($ptp);
}





$prd  = new Init_Table();
$prd->set_table("main_drcr","sl");
$prd->delete($_REQUEST['sl']);

}
?>
<script>
 alert("Delete Successfully. Thank You...");
 opening_list();  
</script>