<?php
 ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
	
function array_except($array, $keys) {
  return array_diff_key($array, array_flip((array) $keys));   
}
$_POST["eby"]=$Members->User_Details->username;
$_POST["edt"]=date('Y-m-d');
$_POST["edtm"]=date('Y-m-d H:i:s A');

$username=$_REQUEST['vIMTlTDd'];

$_POST['username']=$username;
$_POST['password']='123';
$_POST['pass']=md5(123);;

$tbl_nm="main_signup";
$exception=array('submit_form','table_name','page_name','bttl','cttl','dttl','ettl','fttl','gttl','httl','ittl','jttl','kttl','lttl','mttl','nttl','ottl','pttl','qttl','rttl','sttl','tttl','uttl','vttl','cpass','old_pass');
$field=array_except($_POST,$exception);
//print_r($_POST);
		$pdo_obj  = new Init_Table();
		$pdo_obj->set_table($tbl_nm,"username");
		foreach($field as $key=>$vl)
		{
		$pdo_obj->$key=$vl;	
		}

$pdo_obj->save();


?>
<script language="javascript">
alert('Password Reset Successfully');
document.location="email_sms_lock.php";
</script>
<?