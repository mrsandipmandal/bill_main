<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);

$pdo= new MainPDO();

$pno='';
$ps='';



if (isset($_REQUEST['pno'])) {
$pno=rawurldecode($_REQUEST['pno']);
}
if (isset($_REQUEST['ps'])) {
$ps=rawurldecode($_REQUEST['ps']);
}

if($ps=="")
{
$ps=10;
}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;

$sl=0;
$sln=$start;

if($_REQUEST['usl']!='')
{
$fld1['usl']=$_REQUEST['usl'];
$op1['usl']="=, and";
}


$fld1['userlevel']='0';
$op1['userlevel']=">, ";

$limit1="limit ".$start.",".$ps;


		$list1  = new Init_Table();
		$list1->set_table("main_signup","sl");

		$rcntttl=$list1->row_count_custom($fld1,$op1,'',array('sl' => 'ASC'));

		$rcnt=$list1->row_count_custom($fld1,$op1,'',array('sl' => 'ASC'));

		$group=$list1->search_custom($fld1,$op1,$limit1,array('sl' => 'ASC'));
		$tcnt=$list1->row_count_custom($fld1,$op1,'',array('sl' => 'ASC'));
//echo $tcnt;
?>


<div align="left">
<input type="text" name="ps" id="ps" value="<?php echo $ps;?>" onblur="pagnt1(this.value)">
</div>

<br>
<table  width="100%" class="advancedtable">
<tr bgcolor="#e8ecf6">
<th width="7%"  style="text-align:center">Edit</font></th>
<th width="5%" style="text-align:center">SL</font></th>
<th style="text-align:left">BRANCH</font></th>
<th style="text-align:left">DESIGNATION</font></th>
<th style="text-align:left">User ID</font></th>
<th style="text-align:left">NAME</font></th>
<th style="text-align:left">CONTACT</font></th>
<td style="text-align:left;">Status</td>
<td style="text-align:left;" width="7%">Reset</td>
</tr>
<?php
$blist  = new Init_Table();
$blist->set_table("main_brnch","sl");

		foreach($group as $key=>$row)
		{  
			$sl=$row['sl'];
			$nm=$row['nm'];
			$bcd=$row['bcd'];
			$usl=$row['usl'];	
			$username=$row['username'];	
			$nm=$row['nm'];	
			$mob=$row['mob'];	
			$edt=$row['edt'];
			$edtm=$row['edtm'];
			$eby=$row['eby'];
			
			$actnum=$row['actnum'];
		
			
			$usl_nm=$pdo->get_value('main_deg','nm',array('sl'=>$usl));
			

			$fld_block['sl']=$bcd;
			$op_block['sl']="IN,"; 	
			$i=0;
			$bcd_nm="";
			$data=$blist->search_custom($fld_block,$op_block,'',array('sl' => 'ASC'));
			foreach($data as $key=>$row)
			{
			$i++;	
			if($bcd_nm=="")
			{					
			$bcd_nm=$i.". ".$row['brnch'];
			}
			else
			{
			$bcd_nm.="<br>".$i.". ".$row['brnch'];	
			}
			}
	$sln++;      

	?>
	<tr>
		<td  align="left"  style="text-align:center">
		<a title="Click to Edit"   href="user_setup_edt.php?sl=<?php echo $sl;?>"><i class="fa fa-pencil-square-o"> </i></a>&nbsp;
	
	</td>
		<td align="center"><?php echo $sln;?></td>
		<td align="left"><?php echo $bcd_nm;?></td>
		<td align="left"><?php echo $usl_nm;?></td>
		<td align="left"><?php echo $username;?></td>
		<td align="left"><?php echo $nm;?></td>
		<td align="left"><?php echo $mob;?></td>
		<td valign="top">
		<select id="actnum" name="actnum" class="form-control" onchange="user_status('<?php echo $sl;?>',this.value)">
		<option value="0"<?php if($actnum==0){echo 'selected';}?>>Active</option>
		<option value="1"<?php if($actnum==1){echo 'selected';}?>>Deactive</option>
		</select>	    
		</td>
		<td   style="text-align:center">
		<input type="button" value="Reset Password" class="btn btn-danger btn-xs" onclick="reset_pass('<?php echo $sl;?>')">
		</td>
	
		</tr>	
<?php
}
?>
</table>


<?php 
$tp=$rcnt/$ps;
if(($rcnt%$ps)>0)
{
    $tp=floor($tp)+1;
}
if($pno==1)
{
    $prev=1;
}
else
{
$prev=$pno-1;    
}
if($pno==$tp)
{
 $next=$tp;   
}
else
{
$next=$pno+1;
}
$flt="";
if($rcnt!=$rcntttl)
{
    $flt="(filtered from ".$rcntttl." total entries)";
}
echo "<b>Showing ".($start+1)." to ".($sln)." of ".$rcnt." entries".$flt.'</b>';
?>
<div align="left"><input type="text" size="10" id="pgn" name="pgn" value="<?php  echo $pno;?>"><input Type="button"  value="Go" onclick="pagnt1('')" ></div>

<div class="pagination pagination-centered">
<ul class="pagination pagination-sm inline">
<li <?php  if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('1')" class="btn btn-success btn-xs" style="cursor:pointer;"><i class="icon-circle-arrow-left" ></i>First</a></li> &nbsp;
<li <?php  if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $prev;?>')" class="btn btn-success btn-xs" style="cursor:pointer;"><i class="icon-circle-arrow-left"></i>Previous</a></li> &nbsp;
<?php 

if($tp<=5)
{
$n=1;  
while($n<=$tp)
{
?>
<li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')" class="btn btn-info btn-xs" style="cursor:pointer;"><?php echo $n;?></a></li> &nbsp; 
<?php 
$n+=1;
}  
}
else
{
if($pno<4)
{
$n=1;
while($n<=5)
{
?>
<li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')" class="btn btn-info btn-xs" style="cursor:pointer;"><?php echo $n;?></a></li> &nbsp; 
<?php 
$n+=1;
}     
}
elseif($pno>$tp-3)
{
$n=$tp-5;
while($n<=5)
{
?>
<li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')" class="btn btn-info btn-xs" style="cursor:pointer;"><?php echo $n;?></a></li> &nbsp; 
<?php 
$n+=1;
}   
}
else
{
$n=$pno-2; 
while($n<=$pno+2)
{
?>
<li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')" class="btn btn-info btn-xs" style="cursor:pointer;"><?php echo $n;?></a></li> &nbsp; 
<?php 
$n+=1;
}     
}



}
?>
<li <?php  if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $next;?>')" class="btn btn-warning btn-xs" style="cursor:pointer;">Next<i class="icon-circle-arrow-right"></i></a></li> &nbsp;
<li <?php  if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $tp;?>')" class="btn btn-warning  btn-xs" style="cursor:pointer;">Last<i class="icon-circle-arrow-right"></i></a></li>
</ul>
</div>


