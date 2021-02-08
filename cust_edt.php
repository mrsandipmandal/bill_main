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

include "header.php";
$sl=$_REQUEST['sl'];
$prd  = new Init_Table();
$prd->set_table("main_cust","sl");
$prd->find($sl);

if($prd->gstdt<'2000-01-01'){$gstdt="";}else{$gstdt=date('d-m-Y',strtotime($prd->gstdt));}
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

						<form method="POST" action="custs.php" enctype="multipart/form-data">
						<input type="hidden"   value="<?php echo $sl;?>"  id="sl" name="sl"   />
									
						
							<div class="row">
							<div class="col-md-6">
									<div class="form-group">

										<label>CUSTOMER  : </label>

										<input type="text"  value="<?php echo $prd->nm ?>" id="nm" name="nm" required class="form-control brd" />
									</div>
								</div>					
								<!-- end col-3 -->
								<div class="col-md-6">
									<div class="form-group">

										<label>CUSTOMER CODE  : </label>

										<input type="text"  value="<?php echo $prd->ccd ?>" id="ccd"  name="ccd" required class="form-control brd" />
									</div>
								</div>	

								<div class="col-md-6">
									<div class="form-group">

										<label>ADDRESS  : </label>

										<input type="text"  value="<?php echo $prd->addr ?>"  id="addr" name="addr" required class="form-control brd" />
									</div>
								</div>					
								<!-- end col-3 -->

								<div class="col-md-6">
									<div class="form-group">

										<label>GSTIN   : </label>

										<input type="text"   value="<?php echo $prd->gstin ?>" id="gstin" name="gstin" onblur="get_pan()"  class="form-control brd" />
									</div>
								</div>
							
								<div class="col-md-6">
									<div class="form-group">

										<label>PAN  : </label>

										<input type="text"  value="<?php echo $prd->pan ?>"  id="pan" name="pan"  class="form-control brd" />
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">

										<label>TAN   : </label>

										<input type="text"  value="<?php echo $prd->tan ?>"  id="tan" name="tan"  class="form-control brd" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">

										<label>GSTIN Applicable Date   : </label>

										<input type="text"   value="<?php echo $gstdt;?>"   id="gstdt" name="gstdt"  class="form-control datepicker" />
									</div>
								</div>

								
							

							
							</div>
					


							<div class="row">
								<input type="hidden" name="table_name" value="main_cust" class="form-control" />
								<input type="hidden" name="page_name" value="cust.php" class="form-control" />
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


</html>