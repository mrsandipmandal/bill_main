<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);

$utyp=$_REQUEST['utyp'];
$dept=$_REQUEST['dept'];
$block=$_REQUEST['block'];
$gp=$_REQUEST['gp'];
$all=$_REQUEST['all'];



$fld2['userlevel']=-1;
$op2['userlevel']=">, and";



if($utyp!='')
{
	$fld2['utyp']=$utyp;
	$op2['utyp']="=, and";	
}

if($dept!='')
{
//$dept1=" and FIND_IN_SET('$dept',dept)>0";	
} 

if($block!='')
{
	$fld2['block']=$block;
	$op2['block']="=, and";	
}

if($gp!='')
{
	$fld2['gp']=$gp;
	$op2['gp']="=, and";	
}

if($all!='')
{
	$al=" and (name LIKE '%$all%' or mob LIKE '%$all%' or mailadres LIKE '%$all%' or deg LIKE '%$all%')";
}
else
{
	$al="";	
}

$fld2['sl']=0;
$op2['sl']=">, $al ";



set_time_limit(0);


$edt=date('d-m-Y');
$file="User-List-Excel-".$edt.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 


 
$list2 = new Init_Table();
$list2->set_table("main_signup","sl");
$group2=$list2->search_custom($fld2,$op2,'',array('sl' => 'ASC'));
$cntz=$list2->row_count_custom($fld2,$op2,'',array('sl' => 'ASC'));
if($cntz>0)
{
?>

<table border="1">
<tr bgcolor="#e8ecf6">
<td >Sl</td>
<td >User ID</td>
<td >Password</td>
<td >Name</td>
<td >Mobile</td>
<td >Designation</td>
<td >E-mail</td>

</tr>
<?php
$cnt=0;

$user_type  = new Init_Table();
$user_type->set_table("main_user_type","sl");	
$user_dept  = new Init_Table();
$user_dept->set_table("main_dept","sl");	
$blist  = new Init_Table();
$blist->set_table("main_bdo","sl");
$user_gp  = new Init_Table();
$user_gp->set_table("main_gp","sl");

foreach($group2 as $key2=>$ptp2)
{
	//project_sl	client_sl	work_des	edt	edtm	eby	stat
	$sl=$ptp2['sl'];
	$username=$ptp2['username'];
	$password=$ptp2['password'];
	$name=$ptp2['name'];
	$mob=$ptp2['mob'];
	$utyp=$ptp2['utyp'];
	$dept=$ptp2['dept'];
	$block=$ptp2['block'];
	$gp=$ptp2['gp'];
	$deg=$ptp2['deg'];
	$mailadres=$ptp2['mailadres'];
	$is_ins=$ptp2['is_ins'];

$utyp_nm=$user_type->search_value('type',array('sl'=>$utyp),'');	

$fld_dpt['sl']=$dept;
$op_dpt['sl']="IN,"; 	
$i=0;
$dept_nm="";
$data=$user_dept->search_custom($fld_dpt,$op_dpt,'',array('sl' => 'ASC'));
foreach($data as $key=>$row)
{
$i++;	
if($dept_nm=="")
{					
$dept_nm=$i.". ".$row['nm'];
}
else
{
$dept_nm.="<br>".$i.". ".$row['nm'];	
}
}

$fld_block['sl']=$block;
$op_block['sl']="IN,"; 	
$i=0;
$block_nm="";
$data=$blist->search_custom($fld_block,$op_block,'',array('sl' => 'ASC'));
foreach($data as $key=>$row)
{
$i++;	
if($block_nm=="")
{					
$block_nm=$i.". ".$row['bnm'];
}
else
{
$block_nm.="<br>".$i.". ".$row['bnm'];	
}
}	
$is_ins_nm="No";
if($is_ins=='1'){$is_ins_nm="Yes";}
	$cnt++;
?>
<tr>
<td ><?php echo $cnt;?></td>
<td ><?php echo $username;?></td>
<td ><?php echo $password;?></td>
<td ><?php echo $name;?></td>
<td ><?php echo $mob;?></td>
<td ><?php echo $deg;?></td>
<td ><?php echo $mailadres;?></td>
</tr>
<?php
}
?>
</table>

<?php
}
?>