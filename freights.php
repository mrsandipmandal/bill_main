<?php
 ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$user_current_level = $Members->User_Details->userlevel;
$user_current_bcd = $Members->User_Details->bcd;
$user_currently_loged = $Members->User_Details->username;	
function array_except($array, $keys) {
  return array_diff_key($array, array_flip((array) $keys));   
}
$_POST["eby"]=$Members->User_Details->username;
$_POST["edt"]=date('Y-m-d');
$_POST["edtm"]=date('d-M-Y h:i:s A');
$tbl_nm=$_POST['table_name'];
$page_name=$_POST['page_name'];

$bcd=$_POST['bcd'];
$cid=$_POST['cid'];
$lp=$_POST['lp'];

set_time_limit(0);
$msg="";
	

if($msg=="")
{

	$path="excel_file/";
	if(!is_dir($path)){mkdir($path);}


	if(isset($_FILES["file"]))
	{
		if($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
		else
		{
			if (file_exists($_FILES["file"]["name"]))
			{
				unlink($_FILES["file"]["name"]);
			} 
			$storagename = $path.$_FILES["file"]["name"];
			
			move_uploaded_file($_FILES["file"]["tmp_name"],  $storagename);
			$uploadedStatus = 1;
		}
	}
	else
	{
		echo "No file selected <br />";
	}

	set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
	include 'PHPExcel/IOFactory.php';
	// This is the file path to be uploaded.
	$inputFileName = $storagename;
	try {
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	} catch (Exception $e) {
		die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
	}
	$data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
	$arrayCount = count($data);  // Here get total count of row in that Excel sheet

$sbmt=0;
$unsbmt=0;

for($i=2;$i<=$arrayCount;$i++){

	$err="Success";
	
	$_POST['segment']=strtoupper(trim($data[$i]["A"]));
	$_POST['dest']=strtoupper(trim($data[$i]["B"]));
	$_POST['load_type']=strtoupper(trim($data[$i]["C"]));
	$_POST['whlr']=strtoupper(trim($data[$i]["D"]));
	$_POST['fr']=strtoupper(trim($data[$i]["E"]));
	$_POST['dist']=strtoupper(trim($data[$i]["F"]));
	$_POST['clrst']=strtoupper(trim($data[$i]["G"]));
	$_POST['km']=strtoupper(trim($data[$i]["H"]));
	$_POST['rload']=strtoupper(trim($data[$i]["I"]));
	$_POST['vdt']=trim($data[$i]["J"]);
	$_POST['it']=strtoupper(trim($data[$i]["K"]));
	$_POST['vdt']=date('Y-m-d',strtotime($_POST['vdt']));
	
		if($_POST['vdt']>'2000-01-01')
		{
		
		$sbmt++;
	

$exception=array('submit_form','table_name','page_name');
$field=array_except($_POST,$exception);
//print_r($_POST);
		$pdo_obj  = new Init_Table();
		$pdo_obj->set_table($tbl_nm,"sl");
		foreach($field as $key=>$vl)
		{
		$pdo_obj->$key=$vl;	
		}
    	$pdo_obj->create();
		}
		else
		{
		$unsbmt++;
		}
		}
		$msg="Data Submited Successfully...";


?>
	
<script>
alert('<?php echo $sbmt;?> Submited Successfully & <?php echo $unsbmt;?> not Submited Successfully.');
window.document.location="<?php echo $page_name;?>";
</script>
<?php 
}
else
{
?>
<script>
alert("<?php echo $msg;?>");
history.go(-1);
</script>
<?php	
}

?>
