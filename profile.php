<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$grpnm="";

if(isset($_REQUEST['pnm']))
{
$page_title=base64_decode($_REQUEST['pnm']);
}
else
{
	$page_title="Profile";
}







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
          <p><?php echo $Members->User_Details->name;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
	  <?php echo include "left_bar.php";?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $page_title;?>
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $page_title;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	<div class="row">
	
<?php
$mailadres="";
				$fld1['username']=$Members->User_Details->username;
				$op1['username']="=,"; 	

				$list1  = new Init_Table();
				$list1->set_table("main_signup","sl");
				$group=$list1->search_custom($fld1,$op1,'',array('sl' => 'ASC'));

				foreach($group as $key=>$ptp)
				{
				
				$username=$ptp['username'];
				$mob=$ptp['mob'];
				$mailadres=$ptp['mailadres'];
					
				}
?>

<div class="box box-primary">
<div class="box-header">	
<h3 class="box-title">Profile Details</h3>
</div>
<div class="box box-success">
<table border="0" width="80%" class="table table-hover table-striped table-bordered">
<tbody><tr>
<th><font color="#000000">User Name</font></th><td><font color="#000000">onsadmin</font></td></tr>
<tr>
<th>Name</th><td><font color="#000000"><?php echo $username; ?></font></td></tr>
<tr>
<th>Mobile No.</th><td><font color="#000000"><?php echo $mob; ?></font></td></tr>
<tr>
<th>Email</th><td><font color="#000000"><?php echo $mailadres; ?></font></td></tr><tr>
<th>Password</th><td><a onclick="chPass()" style="cursor:pointer;">Change Password</a></td>
</tr>
<input type="hidden" value="0" id="edtt">	
</tbody></table>
</div>
 </div>	

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><label><b>Change Password</b></label></h4>
        </div>
        <div class="modal-body">
         <div id="cntat"></div>
        </div>
      </div>
      
    </div>
  </div>	
	
	

	
	
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">

    <strong>Copyright &copy; 2019-2020 </strong> All rights reserved. Designed & Developed By <a href="http://onnetsolution.com">Onnet Solution Infotech Pvt. Ltd.</a>.
  </footer>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


<script>
/*$(document).ready(function()
{
	//App.init();
show();
});*/

function chPass()
{
$('#cntat').load("change_pass.php").fadeIn("slow");
$("#myModal").modal();
}



</script>


<script>
//Date picker
  /*  $('.datepicker').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    })
		function file_field(tp)
		{
		    if(tp==2)
		    {
		      $('#fl_fld').html('<label>Form Description</label><input type="file" name="fileToUpload" class="btn btn-sm btn-success" placeholder="Form Description" /></div>');
		    }
		    else
		    {
		      $('#fl_fld').html('');
		    }
		}*/
	</script>


</body>
</html>
