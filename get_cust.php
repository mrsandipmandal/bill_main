<?php
$reqlevel = 1;
include("membersonly.inc.php");
?>

    <select id="cid" name="cid" class="form-control ch_req" required style="width:95%" onchange="get_loding()">
    <option value="">---Select---</option>
    <?php
    $fld2['bcd']=$_REQUEST['bcd'];
    $op2['bcd']="=, group by cid";

    $plist  = new Init_Table();
    $plist->set_table("main_loading_point", "sl");
    $group2=$plist->search_custom($fld2,$op2,'',array('sl' => 'ASC'));

    foreach($group2 as $key2=>$ptp)
    {
     

    ?>
    <option value="<?php echo $ptp['cid']; ?>"><?php echo $pdo->get_value('main_cust','nm',array('sl'=>$ptp['cid'])); ?> - <?php echo  $pdo->get_value('main_cust','ccd',array('sl'=>$ptp['cid'])); ?></option>
    <?php

    }
    ?>
    </select>
 <script>
    $('#cid').chosen({no_results_text: "Oops, nothing found!",allow_single_deselect: true,});
</script>