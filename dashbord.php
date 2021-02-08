<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$fdt=date('Y-m-d',strtotime($fdt));
$tdt=date('Y-m-d',strtotime($tdt));

$fld['edt']=$fdt."#".$tdt;
$op['edt']="BETWEEN,";	

$fld5['sl']=0;
$op5['sl']=">,";	

$list  = new Init_Table();
$list->set_table("main_user_log","sl");
$total=$list->row_count_custom($fld,$op,'',array('sl' => 'ASC'));
$ttotal=$list->row_count_custom($fld5,$op5,'',array('sl' => 'ASC'));
?>
<div class="row">
	  <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3><?php echo $ttotal;?></h3>
                  <p>Total  Inspection Done</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
	  <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua-active">
                <div class="inner">
                  <h3><?php echo $total;?></h3>
                  <p>Total  Inspection Done (This Month)</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
	

</div>
<div class="row">
<?php
$bg=array('bg-aqua','bg-green','bg-yellow');
$fld_menu['rmsl']=0;
$op_menu['rmsl']="!=, and";
$fld_menu['fsl']='';
$op_menu['fsl']="!=, group by rmsl";
$list2 = new Init_Table();
$list2->set_table("main_menu","sl");
$group=$list2->search_custom($fld_menu,$op_menu,'',array('ordr' => 'asc'));
foreach($group as $key2=>$ptp)
{
$rmsl=$ptp['rmsl'];
$mnm_main=$list2->search_value('mnm',array('sl'=>$rmsl),'');


	
?>
<section class="col-lg-12 connectedSortable ui-sortable">
<div class="box box-success">
<div class="box box-primary direct-chat direct-chat-primary">
                <div class="box-header with-border ">
                  <h3 class="box-title"><b><?php echo $mnm_main?></b></h3>
                  </div><!-- /.box-header -->
                <div class="box-body">
                 
          

<?php
$total=0;
$i=0;
$fld_menu1['rmsl']=$rmsl;
$op_menu1['rmsl']="=,";
$group2=$list2->search_custom($fld_menu1,$op_menu1,'',array('sl' => 'asc'));
foreach($group2 as $key2=>$ptp2)
{
$fsl=$ptp2['fsl'];
$mnm=$ptp2['mnm'];
$fld1['edt']=$fdt."#".$tdt;
$op1['edt']="BETWEEN, and";
$fld1['fsl']=$fsl;
$op1['fsl']="=,";	
$total=$list->row_count_custom($fld1,$op1,'',array('sl' => 'ASC'));

$fld6['fsl']=$fsl;
$op6['fsl']="=,";	
$ttotal=$list->row_count_custom($fld6,$op6,'',array('sl' => 'ASC'));

$seurl="?pnm=".base64_encode($mnm_main.' || '.$mnm);
?>	
<div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon <?php echo $bg[$i]?>"><i class="ion ion-stats-bars"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"><b><?php echo $mnm;?></b></span>
                  <span class="info-box-number">Total : <?php echo $ttotal;?></span>
                  <span class="info-box-number">This Month : <?php echo $total;?></span>
				 <a href="<?php echo $ptp2["page"].$seurl;?>" target="_blank">View Details</a>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
 </div>
 
 
<?php
$i++;
if($i==3){$i=0;}
}
?>
</div><!-- /.box-body -->

</div>
</div>
</section>
<?php
}
?>
<section class="col-lg-12 connectedSortable ui-sortable">
<div class="box box-success">
<div class="box box-primary direct-chat direct-chat-primary">
                <div class="box-header with-border ">
                  <h3 class="box-title"><b>Other </b></h3>
                  </div><!-- /.box-header -->
                <div class="box-body">
<?php
$i=0;
$fld_menu2['rmsl']=0;
$op_menu2['rmsl']="=, and";

$fld_menu2['fsl']='';
$op_menu2['fsl']="!=, ";
$group1=$list2->search_custom($fld_menu2,$op_menu2,'',array('sl' => 'asc'));
foreach($group1 as $key2=>$ptp1)
{
$fsl=$ptp1['fsl'];
$mnm=$ptp1['mnm'];
$page=$ptp1['page'];

$fld2['edt']=$fdt."#".$tdt;
$op2['edt']="BETWEEN, and";
$fld2['fsl']=$fsl;
$op2['fsl']="=,";	
$total=$list->row_count_custom($fld2,$op2,'',array('sl' => 'ASC'));


$fld7['fsl']=$fsl;
$op7['fsl']="=,";	
$ttotal=$list->row_count_custom($fld7,$op7,'',array('sl' => 'ASC'));
$seurl="?pnm=".base64_encode($ptp1["mnm"]);
?>	
<div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
			 
                <span class="info-box-icon <?php echo $bg[$i]?>"> <i class="ion ion-stats-bars"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"><b><?php echo $mnm;?></b></span>
                       <span class="info-box-number">Total : <?php echo $ttotal;?></span>
                  <span class="info-box-number">This Month : <?php echo $total;?></span>
				  <a href="<?php echo $ptp1["page"].$seurl;?>" target="_blank">View Details</a>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
 </div>
<?php
$i++;
if($i==3){$i=0;}
}
?>			
 </div><!-- /.box-body -->

</div>
</div>
</section>   		
</div>