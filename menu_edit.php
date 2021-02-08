<?php

 ini_set("display_errors", "1");
error_reporting(E_ALL);

$page_title="Menu Edit";
include "membersonly.inc.php";
$Members  = new isLogged(1);
include "header.php";
$sld=base64_decode($_REQUEST['sl']);
$adtl  = new Init_Table();
$adtl->set_table("main_menu","sl");
$row=$adtl->all();
$row2=$adtl->search(array('sl'=>$sld));

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
			 <!-- begin panel -->
			 
	<div class="col-md-12">
                    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Menu Setup</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
<div class="box-body">
<form class="form-inline form-bordered" action="menu_setups.php" method="POST">
<div id="wizard">

<div class="row">
<div class="form-group col-md-3">
<label>
<b><font color="#ed2618"></font> Menu : </b>
</label>
<select id="rmsl" name="rmsl" class="form-control" style="width:100%">
<option value="">---Select---</option>

<option value="0"<?php if(0==$row2[0]['rmsl']){echo 'selected';}?>>root</option>
<?php
foreach ($row as $value) 
{
$mnm=$value['mnm'];
$sl=$value['sl'];
?>
<option value="<?php echo $sl;?>"<?php if($sl==$row2[0]['rmsl']){echo 'selected';}else{}?>><?php echo $mnm;?></option>
<?php
}

?>
</select>
</div>	

<div class="form-group col-md-3">
<label>
<b><font color="#ed2618"></font> Menu Name : </b>
</label>
<input type="text" id="mnm" name="mnm" class="form-control" value="<?php echo $row2[0]['mnm'];?>" style="width:100%">
</div>	
<div class="form-group col-md-3">
<label>
<b><font color="#ed2618"></font> Page Name : </b>
</label>
<input type="text" id="page" name="page" class="form-control" value="<?php echo $row2[0]['page'];?>" style="width:100%">
<input type="hidden" id="sl" name="sl" class="form-control" value="<?php echo $sld;?>" style="width:100%">
</div>	
<div class="form-group col-md-3">
<label>
<b><font color="#ed2618"></font> Order : </b>
</label>
<input type="number" id="ordr" name="ordr" class="form-control" value="<?php echo $row2[0]['ordr'];?>" style="width:100%">
</div>	
</div>	

<div class="row">
<div class="form-group col-md-12" style="text-align:right;">
<p>
<br>
<input type="submit" class="btn btn-primary" value="Update">
</p>
</div>
</div>	
<input type="hidden" name="table_name" value="main_menu">	 
<input type="hidden" name="page_name" value="menu_setup.php">  
							</form>
                        </div>
                    </div>
                    <!-- end panel -->
			
			</div>
			</div>	
			</div>
		<!-- end #content -->
 </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    
    <strong>Copyright &copy; 2019-2020 </strong> All rights reserved. Designed & Developed By <a href="http://onnetsolution.com">Onnet Solution Infotech Pvt. Ltd.</a>.
  </footer>

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
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
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

		function assign(sl)
{
		
		$('#cnt1').load('assign.php?sl='+sl).fadeIn("fast");
		$('#modal1').modal('show');
}
	</script>


</body>
</html>
