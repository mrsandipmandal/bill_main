<?php
$reqlevel = 1;
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "membersonly.inc.php";
$Members  = new isLogged(1);
$eby = $Members->User_Details->username;
	
function array_except($array, $keys) {
    return array_diff_key($array, array_flip((array) $keys));   
  }
$pdo_obj  = new Init_Table();
$pdo_obj->set_table("main_freights","sl");
$main_segment  = new Init_Table();
$main_segment->set_table("main_segment","nm");
$main_dest  = new Init_Table();
$main_dest->set_table("main_dest","nm");
$main_load_type  = new Init_Table();
$main_load_type->set_table("main_load_type","nm");
$main_wheeler  = new Init_Table();
$main_wheeler->set_table("main_wheeler","nm");
$blno=date('Ymdhis').uniqid();
$fld1['eby']=$eby;
$op1['eby']="=, ";
$list1  = new Init_Table();
$list1->set_table("main_freight","sl");
$group=$list1->search_custom($fld1,$op1,'',array('sl' => 'ASC'));
foreach($group as $key=>$row)
{  

$row["eby"]=$Members->User_Details->username;
$row["edt"]=date('Y-m-d');
$row["edtm"]=date('d-M-Y h:i:s A');

$fld['nm']=$row["segment"];
$op['nm']="=, ";
$group1=$main_segment->search_custom($fld,$op,'limit 0,1',array('sl' => 'ASC'));
if(count($group1)>0)
{
foreach($group1 as $key=>$row1)
{  
$segment_sl=$row1['sl'];
}
}
else
{
$main_segment->nm=$row["segment"];	
$main_segment->edt=$row["edt"];	
$main_segment->edtm=$row["edtm"];	
$main_segment->eby=$eby;
$segment_sl=$main_segment->create();	
}

$fld2['bcd']=$row["bcd"];
$op2['bcd']="=, and";

$fld2['nm']=$row["dest"];
$op2['nm']="=, ";
$group2=$main_dest->search_custom($fld2,$op2,'limit 0,1',array('sl' => 'ASC'));
if(count($group2)>0)
{
foreach($group2 as $key=>$row2)
{  
$dest_sl=$row2['sl'];
}

}
else
{
$main_dest->nm=$row["dest"];	
$main_dest->bcd=$row["bcd"];	
$main_dest->edt=$row["edt"];	
$main_dest->edtm=$row["edtm"];	
$main_dest->eby=$eby;
$dest_sl=$main_dest->create();	

}

$fld3['nm']=$row["load_type"];
$op3['nm']="=, ";
$group3=$main_load_type->search_custom($fld3,$op3,'limit 0,1',array('sl' => 'ASC'));
if(count($group3)>0)
{
foreach($group3 as $key=>$row3)
{  
$load_type_sl=$row3['sl'];
}
}
else
{
$main_load_type->nm=$row["load_type"];	
$main_load_type->edt=$row["edt"];	
$main_load_type->edtm=$row["edtm"];	
$main_load_type->eby=$eby;
$load_type_sl=$main_load_type->create();	
}

$fld4['nm']=$row["whlr"];
$op4['nm']="=, ";
$group4=$main_wheeler->search_custom($fld4,$op4,'limit 0,1',array('sl' => 'ASC'));
if(count($group4)>0)
{
foreach($group4 as $key=>$row4)
{  
$whlr_sl=$row4['sl'];
}
}
else
{
$main_wheeler->nm=$row["whlr"];	
$main_wheeler->edt=$row["edt"];	
$main_wheeler->edtm=$row["edtm"];	
$main_wheeler->eby=$eby;
$whlr_sl=$main_wheeler->create();	
}


$row["segment"]=$segment_sl;
$row["dest"]=$dest_sl;
$row["load_type"]=$load_type_sl;
$row["whlr"]=$whlr_sl;
$row["blno"]=$blno;


$exception=array('submit_form','table_name','page_name','sl');
$field=array_except($row,$exception);
		foreach($field as $key=>$vl)
		{
		$pdo_obj->$key=$vl;	
		}
$pdo_obj->create();
	
}
if($eby!='')
{
$main_freight  = new Init_Table();
$main_freight->set_table("main_freight","eby");
$main_freight->delete_all($eby);
}

?>
<script>
 alert("Submit Successfully. Thank You...");
window.document.location="freight.php";   
</script>