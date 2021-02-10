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

						<form method="POST" action="account_grps.php" enctype="multipart/form-data">
						<input type="hidden"   value=""  id="sl" name="sl"   />
									
						
							<div class="row">
							<div class="col-md-6">
									<div class="form-group">
										<label>Primary Account : </label>
										<select id="pcd" name="pcd" class="form-control" required onchange="account_grp_list()">								
									
										<option value="" >---Select---</option>
										<?php							
											$fld2['sl']=0;
											$op2['sl']=">, ";

											$plist  = new Init_Table();
											$plist->set_table("main_primary", "sl");
											 $group2=$plist->search_custom($fld2,$op2,'',array('sl' => 'ASC'));

											foreach($group2 as $key2=>$ptp)
											{
												
											?>
											<option value="<?php echo $ptp['sl']; ?>"><?php echo $ptp['nm']; ?></option>
											<?php
											
											}
											?>
										</select>
									</div>
								</div>				
								<!-- end col-3 -->
							

								<div class="col-md-6">
									<div class="form-group">

										<label>Account Group : </label>

										<input type="text" value=""  id="nm" name="nm" required class="form-control brd" />
									</div>
								</div>					
								<!-- end col-3 -->

							
							</div>
					


							<div class="row">
								<input type="hidden" name="table_name" value="main_group" class="form-control" />
								<input type="hidden" name="page_name" value="account_grp.php" class="form-control" />
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
<script>

window.onload = function() {
    if (window.jQuery) {  
        // jQuery is loaded  
        account_grp_list();
    } 
}


function pagnt(pno){
var ps=document.getElementById('ps').value;
var pcd = document.getElementById('pcd').value;

$('#show').load("account_grp_list.php?ps="+ps+"&pno="+pno+"&pcd="+pcd).fadeIn('fast');
$('#pgn').val=pno;
}

function pagnt1(pno){
pno=document.getElementById('pgn').value;
pagnt(pno);
}

//$('#bcd').chosen({no_results_text: "Oops, nothing found!",});
//$('#cid').chosen({no_results_text: "Oops, nothing found!",});

</script>

</body>


</html>