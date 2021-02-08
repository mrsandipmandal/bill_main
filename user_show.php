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
	$page_title="User";
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
	
	<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $page_title;?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">

<form action="user_list_xls.php" method="POST" name="form">
<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>User Type: </label>
<select id="utyp" name="utyp"class="form-control">
<option value="">---Select---</option>
<?php							
$plist  = new Init_Table();
$plist->set_table("main_user_type","sl");
$plists=$plist->all();

foreach($plists as $key=>$ptp)
{
?>
<option value="<?php echo $ptp['sl'];?>"><?php echo $ptp['type'];?></option>
<?php 
}
?>
</select>
</div>
</div>	

<div class="col-md-6" hidden>
<div class="form-group">
<label>Department: </label>
<select id="dept" name="dept" class="form-control">
<option value="">---Select---</option>

</select>		
</div>
</div>

<div class="col-md-6" id="block_div" hidden>
<div class="form-group">
<label>Block : </label>
<select id="block" name="block"class="form-control"  onchange="get_gp()">
<option value="">---Select---</option>
<?php							
$plist  = new Init_Table();
$plist->set_table("main_bdo","sl");
$plists=$plist->all();

foreach($plists as $key=>$ptp)
{
?>
<option value="<?php echo $ptp['sl'];?>"><?php echo $ptp['bnm'];?></option>
<?php 
}
?>
</select>
</div>
</div>
<div class="col-md-6" id="gp_div">
<div class="form-group">
<label>All Search : </label>
<div id="gp_div_get">					
<input type="text" id="all" name="all" class="form-control" placeholder="All Search">		
</div>
</div>
</div>	
</div>
<div class="row">



<div class="col-md-6" id="gp_div" hidden>
<div class="form-group">

<label>GP : </label>
<div id="gp_div_get">					
<select id="gp" name="gp" class="form-control" >
<option value="">---Select---</option>
</select>		
</div>


</div>
</div>



</div>

	
	


<div class="row">
	<div class="col-md-12">
		<div style="text-align: right;" class="form-group" >
			<button type="button" class="btn btn-sm btn-success" onclick="get_list()">Show</button> 		
         
		</div>
	</div>
</div>

</form>
<div class="row">
	<div class="col-md-12">
		<div id="show_list"></div>
	</div>
</div>


<!-- Modal Box Start-->
<div class="modal" id="myModal">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div id="cnt"></div>
		</div>
	</div>
</div>
<!-- Modal Box End -->

          <!-- /.box body -->
        </div>
	
          <!-- /.box body -->
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
  <div class="control-sidebar-bg" id="act"></div>
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
function isNumber(evt)
{
	var iKeyCode = (evt.which) ? evt.which : evt.keyCode
	if(iKeyCode < 48 || iKeyCode > 57)
	{
	return false;
	}
	return true;
}   
</script>
<script>


function get_list()
{
	var utyp=document.getElementById('utyp').value;
	var dept=document.getElementById('dept').value;
	var block=document.getElementById('block').value;
	var gp=document.getElementById('gp').value;
	var all=encodeURIComponent(document.getElementById('all').value);
	$('#show_list').load("user_list.php?utyp="+utyp+"&dept="+dept+"&block="+block+"&gp="+gp+"&all="+all).fadeIn('fast');
}

function exl()
{
  var utyp=document.getElementById('utyp').value;
  var dept=document.getElementById('dept').value;
  var block=document.getElementById('block').value;
  var gp=document.getElementById('gp').value;
  var all=encodeURIComponent(document.getElementById('all').value);
  window.open("user_list_exl.php?utyp="+utyp+"&dept="+dept+"&block="+block+"&gp="+gp+"&all="+all);
}

 get_list();
</script>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>
 $('#dept').chosen({
no_results_text: "Oops, nothing found!",
});

function get_gp()
{
var block=document.getElementById('block').value;
$('#gp_div_get').load("get_gp.php?block="+block).fadeIn('fast');	
}

function udt(sl,val)
{
$('#act').load("updt.php?sl="+sl+"&val="+val).fadeIn('fast');    
}
</script>

</body>
</html>
