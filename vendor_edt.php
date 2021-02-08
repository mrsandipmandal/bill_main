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

include "header.php";
$sl=$_REQUEST['sl'];
$prd  = new Init_Table();
$prd->set_table("main_vendor","sl");
$prd->find($sl);
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

						<form method="POST" action="vendors.php" enctype="multipart/form-data">
						<input type="hidden"   value="<?php echo $sl;?>"  id="sl" name="sl"   />
									
						
							<div class="row">
							<div class="col-md-6">
									<div class="form-group">
										<label>BRANCH  : </label>
										<select id="bcd" name="bcd" class="form-control" required>								
										<?php
										if($user_current_level<0)
										{
										?>
										<option value="" >---Select---</option>
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
											<option value="<?php echo $ptp['sl']; ?>"<?php if($ptp['sl']==$prd->bcd){ echo 'selected';} ?>><?php echo $ptp['brnch']; ?></option>
											<?php
											
											}
											?>
										</select>
									</div>
								</div>				
								<!-- end col-3 -->
								

								<div class="col-md-6">
									<div class="form-group">

										<label>NAME  : </label>

										<input type="text" value="<?php echo $prd->nm ?>"  id="nm" name="nm" required class="form-control brd" />
									</div>
								</div>		
								
								<div class="col-md-6">
									<div class="form-group">

										<label>PAN NO.  : </label>

										<input type="text" value="<?php echo $prd->pan ?>"  id="pan" name="pan" required class="form-control brd" />
									</div>
								</div>	
								<div class="col-md-6">
									<div class="form-group">

										<label>MOBILE  : </label>

										<input type="number" value="<?php echo $prd->mob ?>"  id="mob" name="mob" pattern= "[0-9]"  maxlength="10"  class="form-control brd" />
									</div>
								</div>	
								<div class="col-md-6">
									<div class="form-group">

										<label>GSTIN  : </label>

										<input type="text" value="<?php echo $prd->gstin ?>"  id="gstin" name="gstin"  class="form-control brd" />
									</div>
								</div>	
								<div class="col-md-6">
									<div class="form-group">

										<label>ADDRESS : </label>

										<input type="text" value="<?php echo $prd->addr ?>"  id="addr" name="addr"  class="form-control brd" />
									</div>
								</div>	
								<div class="col-md-6">
									<div class="form-group">

										<label>BANK NAME : </label>

										<input type="text" value="<?php echo $prd->bank_nm ?>"  id="bank_nm" name="bank_nm"  class="form-control brd" />
									</div>
								</div>	
								<div class="col-md-6">
									<div class="form-group">

										<label>BANK BRANCH : </label>

										<input type="text" value="<?php echo $prd->bank_bcd ?>"  id="bank_bcd" name="bank_bcd"  class="form-control brd" />
									</div>
								</div>	
								<div class="col-md-6">
									<div class="form-group">

										<label>IFSC CODE : </label>

										<input type="text" value="<?php echo $prd->ifsc ?>"  id="ifsc" name="ifsc"  class="form-control brd" />
									</div>
								</div>	
								<div class="col-md-6">
									<div class="form-group">

										<label>BANK A/C NO. : </label>

										<input type="text" value="<?php echo $prd->bank_ac ?>"  id="bank_ac" name="bank_ac"  class="form-control brd" />
									</div>
								</div>	
							
								<!-- end col-3 -->

							
							</div>
					


							<div class="row">
								<input type="hidden" name="table_name" value="main_vendor" class="form-control" />
								<input type="hidden" name="page_name" value="vendor.php" class="form-control" />
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



//$('#bcd').chosen({no_results_text: "Oops, nothing found!",});
//$('#cid').chosen({no_results_text: "Oops, nothing found!",});

</script>

</body>


</html>