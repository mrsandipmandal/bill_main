<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$grpnm = "";
if (isset($_REQUEST['pnm'])) {
	$page_title = base64_decode($_REQUEST['pnm']);
} else {
	$page_title = "Dashboard";
}
$user_current_level = $Members->User_Details->userlevel;
$user_current_bcd = $Members->User_Details->bcd;
$user_currently_loged = $Members->User_Details->username;

include "header.php";
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

						<form method="POST" action="trucks.php" enctype="multipart/form-data">
						<input type="hidden"   value=""  id="sl" name="sl"   />
									
						
							<div class="row">
							<div class="col-md-4">
									<div class="form-group">
										<label>BRANCH  : </label>
										<select id="bcd" name="bcd" class="form-control" required  onchange="get_vendor()">		
										<option value="" >---Select---</option>						
										<?php
										if($user_current_level<0)
										{
										?>
										
										<?php
										}
										else
										{
											
											$fld2['sl']=$user_current_bcd;
											$op2['sl']="IN, and";	
											
										}
											
											$fld2['brnch']='';
											$op2['brnch']="!=, ";

											$plist  = new Init_Table();
											$plist->set_table("main_brnch", "sl");
											 $group2=$plist->search_custom($fld2,$op2,'',array('sl' => 'ASC'));

											foreach($group2 as $key2=>$ptp)
											{
												
											?>
											<option value="<?php echo $ptp['sl']; ?>"><?php echo $ptp['brnch']; ?></option>
											<?php
											
											}
											?>
										</select>
									</div>
								</div>				
								<!-- end col-3 -->
								<div class="col-md-4">
									<div class="form-group">
										<label>VENDOR : </label>
										<div id="get_vendor">
										<select id="vendor" name="vendor" class="form-control ch_req" required style="width:95%">
											<option value="">---Select---</option>
										
										</select>

									</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">

										<label>TRUCK NUMBER  : </label>

										<input type="text" value=""  id="trkno" name="trkno" required class="form-control brd" />
									</div>
								</div>		
								<div class="col-md-4">
									<div class="form-group">

										<label>TRUCK CATEGORY  : </label>

										<select id="cat" name="cat" class="form-control"  style="width:95%">
											<option value="">---Select---</option>
											<?php
											$plist  = new Init_Table();
											$plist->set_table("main_truck_cat", "sl");
											$plists = $plist->all();
											foreach ($plists as $key => $ptp) {
											
											?>
													<option value="<?php echo $ptp['sl']; ?>"><?php echo $ptp['nm']; ?></option>
											<?php
												
											}
											?>
										</select>

									</div>
								</div>			
								<div class="col-md-4">
									<div class="form-group">

										<label>WHEELER  : </label>

										<select id="whlr" name="whlr" class="form-control"  style="width:95%">
											<option value="">---Select---</option>
											<?php
											$plist  = new Init_Table();
											$plist->set_table("main_wheeler", "sl");
											$plists = $plist->all();
											foreach ($plists as $key => $ptp) {
											
											?>
													<option value="<?php echo $ptp['sl']; ?>"><?php echo $ptp['nm']; ?></option>
											<?php
												
											}
											?>
										</select>
										</div>
								</div>		
								<div class="col-md-4">
									<div class="form-group">

										<label>TRUCK DRIVER  : </label>

										<select id="dr_nm" name="dr_nm" class="form-control"  style="width:95%" onchange="add_driver()">
											<option value="">---Select---</option>
											<option value="Add">----ADD NEW----</option>
											<?php
											$plist  = new Init_Table();
											$plist->set_table("main_driver", "sl");
											$plists = $plist->all();
											foreach ($plists as $key => $ptp) {
											
											?>
													<option value="<?php echo $ptp['sl']; ?>"><?php echo $ptp['nm']; ?></option>
											<?php
												
											}
											?>
										</select>
									</div>
								</div>		
								<div class="col-md-4">
									<div class="form-group">

										<label>DRIVER MOBILE  : </label>

										<input type="text" value="" readonly id="dmob" name="dmob"  class="form-control brd" />
									</div>
								</div>		
								<div class="col-md-4">
									<div class="form-group">

										<label>DRIVER LICENCE  : </label>

										<input type="text" value=""  readonly id="licno" name="licno"  class="form-control brd" />
									</div>
								</div>		
								<div class="col-md-4">
									<div class="form-group">

										<label>RC/BLUE BOOK  : </label>

										<input type="text" value=""  id="rcb" name="rcb"  class="form-control brd" />
									</div>
								</div>	
								<div class="col-md-4">
									<div class="form-group">

										<label>TDS DECLARATION : </label>

										<input type="text" value=""  id="tds" name="tds"  class="form-control brd" />
									</div>
								</div>	
								<div class="col-md-4">
									<div class="form-group">

										<label>OWNER MOBILE : </label>

										<input type="text" value=""  id="omob" name="omob"  class="form-control brd" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										<label>OWNER AS PER RC : </label>

										<input type="text" value=""  id="orc" name="orc"  class="form-control brd" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										<label>CHASIS NUMBER : </label>

										<input type="text" value=""  id="chasis" name="chasis"  class="form-control brd" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										<label>ENGINE NUMBER : </label>

										<input type="text" value=""  id="engno" name="engno"  class="form-control brd" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										<label>PAN (MAX 5 MB) : </label>

										<input type="file"  id="panf" name="panf"  class="form-control brd" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										<label>TDS DECLARATION (MAX 5 MB) : </label>

										<input type="file"  id="tdsf" name="tdsf"  class="form-control brd" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										<label>RC COPY (MAX 5 MB) : </label>

										<input type="file"  id="rcf" name="rcf"  class="form-control brd" />
									</div>
								</div>
								<!-- end col-3 -->

							
							</div>
					


							<div class="row">
								<input type="hidden" name="table_name" value="main_truck" class="form-control" />
								<input type="hidden" name="page_name" value="truck.php" class="form-control" />
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
					<div class="row">						
					<div class="col-md-6">
					<div class="form-group">
					<label>BRANCH  : </label>
					<select id="bcds" name="bcds" class="form-control" >								
					<?php
					if($user_current_level<0)
					{
					?>
					<option value="" >---ALL---</option>
					<?php
					}
					else
					{

					$fld2['sl']=$user_current_bcd;
					$op2['sl']="IN, and";	

					}

					$fld2['brnch']='';
					$op2['brnch']="!=, ";

					$plist  = new Init_Table();
					$plist->set_table("main_brnch", "sl");
					$group2=$plist->search_custom($fld2,$op2,'',array('sl' => 'ASC'));

					foreach($group2 as $key2=>$ptp)
					{

					?>
					<option value="<?php echo $ptp['sl']; ?>"<?php if($ptp['sl']==$user_current_bcd){ echo 'selected';} ?>><?php echo $ptp['brnch']; ?></option>
					<?php

					}
					?>
					</select>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">

					<label>Search: </label>

					<input type="text" value=""  id="all" name="all"  class="form-control brd" />
					</div>
					</div>	
					<div class="form-group pull-right">
					<div class="col-md-12">
					<button type="button" class="btn btn-sm btn-success" onclick="truck_list()">Show</button>
					</div>
					</div>
					</div>						

					<div class="row" id="show" style="overflow:scroll;">						



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
<script>

window.onload = function() {
    if (window.jQuery) {  
        // jQuery is loaded  
        truck_list();
    } 
}


function pagnt(pno){
var ps=document.getElementById('ps').value;
var bcd = document.getElementById('bcds').value;
var all =encodeURIComponent(document.getElementById('all').value);
$('#show').load("truck_list.php?ps="+ps+"&pno="+pno+"&bcd="+bcd+"&all="+all).fadeIn('fast');
$('#pgn').val=pno;
}

function pagnt1(pno){
pno=document.getElementById('pgn').value;
pagnt(pno);
}

//$('#bcd').chosen({no_results_text: "Oops, nothing found!",});
//$('#cid').chosen({no_results_text: "Oops, nothing found!",});
$('#vendor').chosen({no_results_text: "Oops, nothing found!",allow_single_deselect: true,});
$('#cat').chosen({no_results_text: "Oops, nothing found!",allow_single_deselect: true,});
$('#whlr').chosen({no_results_text: "Oops, nothing found!",allow_single_deselect: true,});
$('#dr_nm').chosen({no_results_text: "Oops, nothing found!",allow_single_deselect: true,});
</script>

</body>


</html>