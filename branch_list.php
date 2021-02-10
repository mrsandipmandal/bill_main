<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$user_current_level = $Members->User_Details->userlevel;
$user_current_bcd = $Members->User_Details->bcd;
$user_currently_loged = $Members->User_Details->username;

$fld2['sl']=0;
$op2['sl']=">, ";



set_time_limit(0);


 
$list2 = new Init_Table();
$list2->set_table("main_brnch","sl");
$group2=$list2->search_custom($fld2,$op2,'',array('sl' => 'ASC'));
if(count($group2)>0)
{
?>
<table  width="100%" class="advancedtable">
<tr bgcolor="#e8ecf6">
<th width="7%">ACTION</font></th>
		<th width="5%">SL</font></th>
	    <th  style="text-align:left">BRANCH</font></th>
	    <th  style="text-align:left">Address</font></th>
	    <th  style="text-align:left">PIN</font></th>
	    <th  style="text-align:left">GSTIN</font></th>
	    <th  style="text-align:left">FREIGHT RATE EDITABLE</font></th>
		</tr>
<?php
$cnt=0;
foreach($group2 as $key2=>$row)
{
	//project_sl	client_sl	work_des	edt	edtm	eby	stat
	$sl=$row['sl'];
	$brnch=$row['brnch'];
	$addr=$row['addr'];
	$pin=$row['pin'];
	$gstin=$row['gstin'];
	$pan=$row['pan'];
	$fr_stat=$row['fr_stat'];
	$edt=$row['edt'];
	$edtm=$row['edtm'];
	$eby=$row['eby'];
	$stat=$row['stat'];

	if($fr_stat==1){ $fvl="checked";}else{$fvl="";}
	$cnt++;
?>
<tr>
		<td  align="left"  style="padding-left:25px;">
		<a title="Click to Edit" style="cursor:pointer;font-size:17px"  href="brnch_edt.php?sl=<?php echo $sl;?>" ><i class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;

		<a title="Click to Delete" style="cursor:pointer;color:red;font-size:17px" ><i class="fa fa-trash-o"></i></a>

		</td>
		<td align="center"><?php echo $cnt;?></td>
		<td align="left"><?php echo $brnch;?></td>
		<td align="left"><?php echo $addr;?></td>
		<td align="left"><?php echo $pin;?></td>
		<td align="left"><?php echo $gstin;?></td>
		<td align="center">
		<input type="checkbox" name="chk1" id="chk1"  value="<?php echo $frst;?>" <?php echo $fvl;?> onclick="fr_stat('<?php echo $sl;?>',this.checked)">
		</td>
		</tr>
<?php
}
?>
</table>

<?php
}
?>