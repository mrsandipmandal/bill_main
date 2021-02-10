<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$user_current_level = $Members->User_Details->userlevel;
$user_current_bcd = $Members->User_Details->bcd;
$user_currently_loged = $Members->User_Details->username;
$eby = $Members->User_Details->username;
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
$ps=30;
}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;

$sl=0;
$sln=$start;

if($_REQUEST['bcd']!='')
{
$fld1['bcd']=$_REQUEST['bcd'];
$op1['bcd']="=, and";
}
$fld1['eby']=$eby;
$op1['eby']="=, and";

$fld1['sl']='0';
$op1['sl']=">, ";

$limit1="limit ".$start.",".$ps;


		$list1  = new Init_Table();
		$list1->set_table("main_freight","sl");

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
<th width="3%">ACTION</font></th>
		<th width="3%">SL</font></th>
	    <th style="text-align:left">BRANCH</font></th>
	    <th style="text-align:left">CUSTOMER</font></th>
	    <th style="text-align:left">LOADING POINT</font></th>
	    <th style="text-align:left">SEGMENT</font></th>
	    <th style="text-align:left">DESTINATION</font></th>
	    <th style="text-align:left">LOAD TYPE</font></th>
	    <th style="text-align:left">WHEELER</font></th>
	    <th style="text-align:left">FREIGHT RECEIVABLE (Rs/MT)</font></th>
	    <th style="text-align:left">KM</font></th>
	    <th style="text-align:left">RETURN LOAD</font></th>
	    <th style="text-align:center;width:110px;">Valid from</font></th>
	    <th style="text-align:left">Incoterm</font></th>
</tr>
<?php


foreach($group as $key=>$row)
{  
$sl=$row['sl'];
$bcd=$row['bcd'];
$cid=$row['cid'];
$lp=$row['lp'];
$segment=$row['segment'];
$dest=$row['dest'];
$load_type=$row['load_type'];
$whlr=$row['whlr'];
$fr=$row['fr'];
$dist=$row['dist'];
$clrst=$row['clrst'];
$km=$row['km'];
$rload=$row['rload'];
$vdt=$row['vdt'];
$it=$row['it'];
$edt=$row['edt'];
$edtm=$row['edtm'];
$eby=$row['eby'];
$stat=$row['stat'];
		
$brnch_nm=$pdo->get_value('main_brnch','brnch',array('sl'=>$bcd));
$cust_nm=$pdo->get_value('main_cust','nm',array('sl'=>$cid));
$lp_nm=$pdo->get_value('main_loading_point','nm',array('sl'=>$lp));

$segment_sl=$pdo->get_value('main_segment','sl',array('nm'=>$segment));
$dest_sl=$pdo->get_value('main_dest','sl',array('nm'=>$dest));
$load_type_sl=$pdo->get_value('main_load_type','sl',array('nm'=>$load_type));
$whlr_sl=$pdo->get_value('main_wheeler','sl',array('nm'=>$whlr));
			

	$sln++;   

$fld_s['bcd']=$bcd;
$op_s['bcd']="=, and";	
$fld_s['cid']=$cid;
$op_s['cid']="=, and";
$fld_s['lp']=$lp;
$op_s['lp']="=, and";
$fld_s['segment']=$segment_sl;
$op_s['segment']="=, and";
$fld_s['dest']=$dest_sl;
$op_s['dest']="=, and";
$fld_s['load_type']=$load_type_sl;
$op_s['load_type']="=, and";
$fld_s['whlr']=$whlr_sl;
$op_s['whlr']="=, ";
$sttl="";
$main_freights  = new Init_Table();
$main_freights->set_table("main_freights","sl");
$count=$main_freights->row_count_custom($fld_s,$op_s,'',array('sl' => 'ASC'));
if($count==0){ 
$sttl="style='background-color:#baedfe'";	
}else{
$sttl="";
}
	?>
	<tr <?php echo $sttl;?>>
		<td  align="left" style="padding-left:25px;">
		<a title="Click to Edit"  style="cursor:pointer" target="_blank" href="freight_edt.php?sl=<?php echo $sl;?>"><i class="fa fa-pencil-square-o"></i></a>&nbsp;
		</td>
		<td align="center" ><?php echo $sln;?></td>
		<td align="left"><?php echo $brnch_nm;?></td>
		<td align="left"><?php echo $cust_nm;?></td>
		<td align="left"><?php echo $lp_nm;?></td>
		<td align="left"><?php echo $segment;?></td>
		<td align="left"><?php echo $dest;?></td>
		<td align="left"><?php echo $load_type;?></td>
		<td align="left"><?php echo $whlr;?></td>
		<td align="left"><?php echo $fr;?></td>
		<td align="left"><?php echo $km;?></td>
		<td align="left"><?php echo $rload;?></td>
		<td align="center"><?php echo date('d-m-Y',strtotime($vdt));?></td>
		<td align="left"><?php echo $it;?></td>
	
		</tr>	
<?php
}
if($tcnt>0)
{
?>
<tr>
<td align="right"  colspan="14" >
<input type="button" value="Submit" class="btn btn-primary" onclick="freight_submit();">
</td>
</tr>
<?php }?>
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


