<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$user_current_level = $Members->User_Details->userlevel;
$user_current_bcd = $Members->User_Details->bcd;
$user_currently_loged = $Members->User_Details->username;
$grpnm = "";
if (isset($_REQUEST['pnm'])) {
	$page_title = base64_decode($_REQUEST['pnm']);
} else {
	$page_title = "Dashboard";
}
$user_current_level = $Members->User_Details->userlevel;
$user_current_bcd = $Members->User_Details->bcd;

include "header.php";
$fld1['sl']=$_REQUEST['sl'];
$op1['sl']="=, ";
$list1  = new Init_Table();
$list1->set_table("main_freight","sl");
$group=$list1->search_custom($fld1,$op1,'',array('sl' => 'ASC'));
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
		}
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?php echo $Members->User_Details->name; ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<?php echo include "left_bar.php"; ?>
	</section>
	<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $page_title; ?>
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><?php echo $page_title; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">

			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo $page_title; ?></h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<div class="box-body">

						<form method="POST" action="freight_edts.php" enctype="multipart/form-data">
						<input type="hidden"   value="<?php echo $sl;?>"   id="sl" name="sl"   />
									
						
							<div class="row">
							<div class="col-md-4">
									<div class="form-group">
										<label>BRANCH  : </label>
										<select id="bcd" name="bcd" class="form-control" required onchange="get_cust();freight_list();" style="width:95%">	
															
										<?php
										
											
											$fld2['sl']=$bcd;
											$op2['sl']="=, ";

											$plist  = new Init_Table();
											$plist->set_table("main_brnch", "sl");
											 $group2=$plist->search_custom($fld2,$op2,'',array('sl' => 'ASC'));

											foreach($group2 as $key2=>$ptp)
											{
												
											?>
											<option value="<?php echo $ptp['sl']; ?>"<?php if($bcd==$ptp['sl']){echo 'selected';}?>><?php echo $ptp['brnch']; ?></option>
											<?php
											
											}
											?>
										</select>
									</div>
								</div>				
								<!-- end col-3 -->
								<div class="col-md-4">
									<div class="form-group">
										<label>CUSTOMER : </label>
										<div id="get_cust">
										<select id="cid" name="cid" class="form-control" required onchange="get_loding()" style="width:95%">
											<option value="">---Select---</option>
											<?php
										$fld21['bcd']=$bcd;
										$op21['bcd']="=, ";

										$plist  = new Init_Table();
										$plist->set_table("main_loading_point", "sl");
										$group2=$plist->search_custom($fld21,$op21,'',array('sl' => 'ASC'));

										foreach($group2 as $key2=>$ptp)
										{
										

										?>
										<option value="<?php echo $ptp['cid']; ?>"<?php if($cid==$ptp['cid']){echo 'selected';}?>><?php echo $pdo->get_value('main_cust','nm',array('sl'=>$ptp['cid'])); ?> - <?php echo  $pdo->get_value('main_cust','ccd',array('sl'=>$ptp['cid'])); ?></option>
										<?php

										}
										?>										
										</select>
									</div>
									</div>
								</div>	

								<div class="col-md-4">
									<div class="form-group">

										<label>LOADING POINT  : </label>

										<div id="get_loding">
										<select id="lp" name="lp" class="form-control" required  style="width:95%">
											<option value="">---Select---</option>
											<?php
											$fld22['bcd']=$bcd;
											$op22['bcd']="=, and";
											$fld22['cid']=$cid;
											$op22['cid']="=, ";

											$plist  = new Init_Table();
											$plist->set_table("main_loading_point", "sl");
											$group2=$plist->search_custom($fld22,$op22,'',array('sl' => 'ASC'));

											foreach($group2 as $key2=>$ptp)
											{										
											?>
											<option value="<?php echo $ptp['sl']; ?>"<?php if($lp==$ptp['sl']){echo 'selected';}?>><?php echo $ptp['nm']; ?></option>
											<?php
											}
											?>
										</select>
									</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">

										<label>SEGMENT  : </label>

										<input type="text" value="<?php echo $segment ?>"  id="segment" name="segment" required class="form-control brd" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										<label>DESTINATION  : </label>

										<input type="text" value="<?php echo $dest ?>"  id="dest" name="dest" required class="form-control brd" />
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">

										<label>LOAD TYPE  : </label>

										<input type="text" value="<?php echo $load_type ?>"  id="load_type" name="load_type" required class="form-control brd" />
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">

										<label>WHEELER : </label>

										<input type="text" value="<?php echo $whlr ?>"  id="whlr" name="whlr" required class="form-control brd" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										<label>FREIGHT RECEIVABLE (Rs/MT) : </label>

										<input type="text" value="<?php echo $fr ?>"  id="fr" name="fr" required class="form-control brd" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										<label>KM : </label>

										<input type="text" value="<?php echo $km ?>"  id="km" name="km" required class="form-control brd" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										<label>RETURN LOAD : </label>

										<input type="text" value="<?php echo $rload ?>"  id="rload" name="rload" required class="form-control brd" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										<label>VALID FROM : </label>

										<input type="text" value="<?php echo date('d-m-Y',strtotime($vdt)) ?>"  id="vdt" name="vdt" required class="form-control datepicker" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										<label>INCOTERM : </label>

										<input type="text" value="<?php echo $it ?>"  id="it" name="it" required class="form-control brd" />
									</div>
								</div>
							</div>
					


							<div class="row">
								<input type="hidden" name="table_name" value="main_freight" class="form-control" />
								<input type="hidden" name="page_name" value="freight.php" class="form-control" />
								<!-- begin col-6 -->
								<div class="col-md-12">
									<div class="form-group" id="fl_fld">

									</div>
									<!-- end col-6 -->
									<div class="form-group pull-right">
										<div class="col-md-12">
											<button type="submit" class="btn btn-sm btn-success">Submit</button>
										</div>
									</div>


								</div>

							</div>
						</form>


											



						<!-- /.box body -->
					</div>
					

					
					<!-- /.box body -->
				</div>
				<div class="box box-success">
					
					<div class="box-body">
					<div class="row" id="show">						



					</div>
					</div>


					</div>



			</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php
include "footer.php";
?>


</body>
<script>
$('#bcd').chosen({no_results_text: "Oops, nothing found!",allow_single_deselect: true,});
$('#cid').chosen({no_results_text: "Oops, nothing found!",allow_single_deselect: true,});
$('#lp').chosen({no_results_text: "Oops, nothing found!",allow_single_deselect: true,});
</script>

</html>