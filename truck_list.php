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
$all1="";
if($_REQUEST['bcd']!='')
{
$fld1['bcd']=$_REQUEST['bcd'];
$op1['bcd']="=, and";
}
if($_REQUEST['all']!='')
{
$all="%".rawurldecode($_REQUEST['all'])."%";
$all1=" and (trkno like '$all' or cat like '$all' or whlr like '$all' or rcb like '$all' or tds like '$all' or omob like '$all' or orc like '$all' or chasis like '$all' or engno like '$all')";
}

$fld1['sl']='0';
$op1['sl']=">, $all1";

$limit1="limit ".$start.",".$ps;


		$list1  = new Init_Table();
		$list1->set_table("main_truck","sl");

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
<th width="5%" style="text-align:center">ACTION</font></th>
<th width="5%" style="text-align:center">SL</font></th>
<th style="text-align:left">BRANCH</font></th>
<th style="text-align:left">VENDOR </font></th>
<th style="text-align:left">TRUCK NUMBER </font></th>
<th style="text-align:left">TRUCK CATEGORY </font></th>
<th style="text-align:left">WHEELER </font></th>
<th style="text-align:left">TRUCK DRIVER  </font></th>
<th style="text-align:left">DRIVER MOBILE</font></th>
<th style="text-align:left">DRIVER LICENCE</font></th>
<th style="text-align:left">RC/BLUE BOOK </font></th>
<th style="text-align:left">TDS DECLARATION</font></th>
<th style="text-align:left">OWNER MOBILE</font></th>
<th style="text-align:left">OWNER AS PER RC </font></th>
<th style="text-align:left">CHASIS NUMBER </font></th>
<th style="text-align:left">ENGINE NUMBER  </font></th>
<th style="text-align:left">PAN (File) </font></th>
<th style="text-align:left">TDS (File) </font></th>
<th style="text-align:left">RC COPY (File) </font></th>
</tr>
<?php


		foreach($group as $key=>$row)
		{  
$sl=$row['sl'];
$bcd=$row['bcd'];
$vendor=$row['vendor'];
$trkno=$row['trkno'];
$cat=$row['cat'];
$whlr=$row['whlr'];
$dr_nm=$row['dr_nm'];
$rcb=$row['rcb'];
$tds=$row['tds'];
$omob=$row['omob'];
$orc=$row['orc'];
$chasis=$row['chasis'];
$engno=$row['engno'];
$panf=$row['panf'];
$tdsf=$row['tdsf'];
$rcf=$row['rcf'];
$edt=$row['edt'];
$edtm=$row['edtm'];
$eby=$row['eby'];
$stat=$row['stat'];
		
$brnch_nm=$pdo->get_value('main_brnch','brnch',array('sl'=>$bcd));
$vendor_nm=$pdo->get_value('main_vendor','nm',array('sl'=>$vendor));
$vendor_pan=$pdo->get_value('main_vendor','pan',array('sl'=>$vendor));
$cat_nm=$pdo->get_value('main_truck_cat','nm',array('sl'=>$cat));
$whlr_nm=$pdo->get_value('main_wheeler','nm',array('sl'=>$whlr));
$d_nm=$pdo->get_value('main_driver','nm',array('sl'=>$dr_nm));
$dr_mob=$pdo->get_value('main_driver','mob',array('sl'=>$dr_nm));
$licno=$pdo->get_value('main_driver','licno',array('sl'=>$dr_nm));
		
	$sln++;      

	?>
	<tr>
		<td  align="center" >
		<a title="Click to Edit"  style="cursor:pointer" href="truck_edt.php?sl=<?php echo $sl;?>"><i class="fa fa-pencil-square-o"></i></a>&nbsp;
		</td>
		<td align="center"><?php echo $sln;?></td>
		<td align="left"><?php echo $brnch_nm;?></td>
		<td align="left"><?php echo $vendor_nm;?> (<?php echo $vendor_pan;?>)</td>
		<td align="left"><?php echo $trkno;?></td>
		<td align="left"><?php echo $cat_nm;?></td>
		<td align="left"><?php echo $whlr_nm;?></td>
		<td align="left"><?php echo $d_nm;?></td>
		<td align="left"><?php echo $dr_mob;?></td>
		<td align="left"><?php echo $licno;?></td>
		<td align="left"><?php echo $rcb;?></td>
		<td align="left"><?php echo $tds;?></td>
		<td align="left"><?php echo $omob;?></td>
		<td align="left"><?php echo $orc;?></td>
		<td align="left"><?php echo $chasis;?></td>
		<td align="left"><?php echo $engno;?></td>
		<td align="left"><?php if($panf!=null){?><a href="<?php echo $panf;?>" target="_blank">Click Here</a><?php }?></td>
		<td align="left"><?php if($tdsf!=null){?><a href="<?php echo $tdsf;?>"  target="_blank">Click Here</a><?php }?></td>
		<td align="left"><?php if($rcf!=null){?><a href="<?php echo $rcf;?>"  target="_blank">Click Here</a><?php }?></td>
	
	
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


