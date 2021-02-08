<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);

$school=rawurldecode($_REQUEST['school']);



if($school!=''){ 

$fld2['username']=$school;
$op2['username']="=, and";
}

$fld2['userlevel']=-1;
$op2['userlevel']=">, and";
$fld2['sl']=0;
$op2['sl']=">,";
set_time_limit(0);

$file="user_list.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 
 
$list2 = new Init_Table();
$list2->set_table("main_signup","sl");
$group2=$list2->search_custom($fld2,$op2,'',array('sl' => 'ASC'));
$cntz=$list2->row_count_custom($fld2,$op2,'',array('sl' => 'ASC'));
if($cntz>0)
{
?>

<table class="table table-bordered table-striped" border="1" >
<tr>
<th style="text-align:left;">SL</th>
<th style="text-align:left;">User Name</th>
<th style="text-align:left;">Password</th>
<th style="text-align:left;">School Name</th>
<th style="text-align:left;">Mobile</th>

</tr>
<?php
$cnt=0;
$slist  = new Init_Table();
$slist->set_table("main_master","SCHCD");	
foreach($group2 as $key2=>$ptp2)
{
	//project_sl	client_sl	work_des	edt	edtm	eby	stat
	$sl=$ptp2['sl'];
	$username=$ptp2['username'];
	$password=$ptp2['password'];
	$name=$ptp2['name'];

$mob=$slist->search_value('MOBILE1',array('SCHCD'=>$username),'');	
	$cnt++;
?>
<tr>
<td><?php echo $cnt;?></td>
<td><?php echo $username;?></td>
<td><?php echo $password;?></td>
<td><?php echo $name;?></td>
<td><?php echo $mob;?></td>
</tr>
<?php
}
?>
</table>

<?php
}
?>