<?php
$reqlevel = 1;
include("membersonly.inc.php");
?>

    <select id="lp" name="lp" class="form-control ch_req" required style="width:95%">
    <option value="">---Select---</option>
    <?php
    $fld2['bcd']=$_REQUEST['bcd'];
    $op2['bcd']="=, and";
    $fld2['cid']=$_REQUEST['cid'];
    $op2['cid']="=, ";

    $plist  = new Init_Table();
    $plist->set_table("main_loading_point", "sl");
    $group2=$plist->search_custom($fld2,$op2,'',array('sl' => 'ASC'));

    foreach($group2 as $key2=>$ptp)
    {
     

    ?>
    <option value="<?php echo $ptp['sl']; ?>"><?php echo $ptp['nm']; ?></option>
    <?php

    }
    ?>
    </select>
 <script>
    $('#lp').chosen({no_results_text: "Oops, nothing found!",allow_single_deselect: true,});
</script>