<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";

$Members  = new isLogged(1);
$user_current_level = $Members->User_Details->userlevel;
$user_current_bcd = $Members->User_Details->bcd;
$user_currently_loged = $Members->User_Details->username;
$page_title = "ADD NEW DRIVER";
?>

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
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">

									<label>NAME : </label>

									<input type="text" value="" id="dnm" name="dnm"  class="form-control brd" />
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">

									<label>MOBILE : </label>

									<input type="number" value="" id="ddmob" name="ddmob"  class="form-control brd" />
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">

									<label>LICENCE  : </label>

									<input type="text" value="" id="dlicno" name="dlicno"  class="form-control brd" />
								</div>
							</div>
							<!-- end col-3 -->
					</div>



						<div class="row">
							<!-- begin col-6 -->
							<div class="col-md-12">
								<div class="form-group" id="fl_fld">

								</div>
								<!-- end col-6 -->
								<div class="form-group pull-left">
									<div class="col-md-12">
										<button type="button" class="btn btn-sm btn-success" onclick="add_drivers()">Submit</button>
									</div>
								</div>


							</div>

						</div>
		






					<!-- /.box body -->
				</div>



				<!-- /.box body -->
			</div>


		</div>
</section>
<!-- /.content -->
<script>
	  $(document).ready(function () {  
        $("input[type=text]").keyup(function () {  
            $(this).val($(this).val().toUpperCase());  
        });  
	}); 
	</script>