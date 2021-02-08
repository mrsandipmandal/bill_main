
<html><body>
	<form method="POST" action="change_passs.php">
    <div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label>Old Password : </label>
	  <input  id="oldpass" type="password" value="" name="oldpass"  required class="form-control brd" required>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label>New Password : </label>
					  <input  id="password" type="password" value="" name="password"  required class="form-control brd" required>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label>Confirm Password : </label>
				<input Confirm Password id="password2" type="password" value="" name="password2" required class="form-control brd" required>
			</div>
		</div>



			</div>



			<div class="row">
				<input type="hidden" name="table_name" value="main_signup" class="form-control"  />
				<input type="hidden" name="page_name" value="profile.php" class="form-control"  />
			
				<div class="col-md-12">
					<div class="form-group" id="fl_fld">

				</div>
			
				<div class="form-group pull-right">
					<div class="col-md-12">
						<button type="submit" class="btn btn-sm btn-success">Change Password</button>
					</div>
				</div>


			</div>

			   </div>
				            </form>

</body>
</html>