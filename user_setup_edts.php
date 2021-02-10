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
$_POST["eby"]=$Members->User_Details->username;
$_POST["edt"]=date('Y-m-d');
$_POST["edtm"]=date('Y-m-d H:i:s A');
$tbl_nm=$_POST['table_name'];
$page_name=$_POST['page_name'];
$utyp=$_POST['utyp'];

$block1=array();

if(isset($_POST['block']))
{
$block1=$_POST['block'];
}


$msg="";
$dt=date('Y-m-d');
/*
$_POST['actnum']=0;
$fld['username']=$_POST['username'];
$op['username']="=,";
$list  = new Init_Table();
$list->set_table("main_signup","sl");
$count=$list->row_count_custom($fld,$op,'',array('sl' => 'ASC'));

if($count>0)	
{
//$msg="User Already Exists!";	
}	
*/
if($utyp=='2')
{
if(count($block1)==0){$msg="Please Select Block !";}
}
else
{
$block1=array();   
}


if($msg=="")
{
$utp  = new Init_Table();
$utp->set_table("main_user_type","sl");
$_POST['userlevel']=$utp->search_value('lvl',array('sl'=>$utyp),'');
				

if(count($block1)>0)
{
$_POST['block']=implode(',',$block1);	
}
else
{
$_POST['block']='';	
}

$exception=array('submit_form','table_name','page_name','nm','mob','username','gp','gttl','httl','ittl','jttl','kttl','lttl','mttl','nttl','ottl','pttl','qttl','rttl','sttl','tttl','uttl','vttl','cpass','old_pass');
$field=array_except($_POST,$exception);
		$pdo_obj  = new Init_Table();
		$pdo_obj->set_table("main_signup","sl");
		foreach($field as $key=>$vl)
		{
		$pdo_obj->$key=$vl;	
		}
	 $pdo_obj->save();
   $msg="Data Update Successfully...";


?>
	
<script>
alert("<?php echo $msg;?>");
window.document.location="<?php echo $page_name;?>";
</script>
<?php }
else
{
?>
<script>
alert("<?php echo $msg;?>");
history.go(-1);
</script>
<?php	
}

?>