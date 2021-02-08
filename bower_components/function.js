function bcd_list() {

    $('#show').load('branch_list.php').fadeIn('fast');
}


function fr_stat(sl, val) {

    $('#free').load('fr_stat.php?sl=' + sl + '&val=' + val).fadeIn('fast');
}

function get_pan() {
    var gstin = document.getElementById('gstin').value;
    $.get('gst_pan.php?gstin=' + gstin, function(data) {
        var pan = data;
        $('#pan').val(pan);
    });
}

function cust_list() {

    $('#show').load('cust_list.php').fadeIn('fast');
}

function lp_list() {
    var bcd = document.getElementById('bcd').value;
    var cid = document.getElementById('cid').value;
    $('#show').load('lp_list.php?bcd=' + bcd + '&cid=' + cid).fadeIn('fast');
}

function segment_list() {

    $('#show').load('segment_list.php').fadeIn('fast');
}

function load_type_list() {

    $('#show').load('load_type_list.php').fadeIn('fast');
}

function wheeler_list() {

    $('#show').load('wheeler_list.php').fadeIn('fast');
}

function deg_list() {

    $('#show').load('deg_list.php').fadeIn('fast');
}

function truck_cat_list() {

    $('#show').load('truck_cat_list.php').fadeIn('fast');
}

function account_grp_list() {
    var pcd = document.getElementById('pcd').value;

    $('#show').load('account_grp_list.php?pcd=' + pcd).fadeIn('fast');
}

function ldgr_get_bcd() {
    gcd = document.getElementById('gcd').value;
    if (gcd == 1) {
        document.getElementById("ldgdiv").innerText = "BANK ACCOUNT NO. :";
        $('#bcd_div').show();
        $("#bcd").attr('required', '');
    } else if (gcd == 10) {
        document.getElementById("ldgdiv").innerText = "LEDGER HEAD : ";
        $('#bcd_div').show();
        $("#bcd").attr('required', '');
    } else {
        document.getElementById("ldgdiv").innerText = "LEDGER HEAD :";
        $('#bcd_div').hide();
        $('#bcd').val('');
        $("#bcd").removeAttr('required');

    }
}

function ldgr_list() {
    var gcd = document.getElementById('gcd').value;
    var bcd = document.getElementById('bcd').value;

    $('#show').load('ldgr_list.php?gcd=' + gcd + '&bcd=' + bcd).fadeIn('fast');
}

function user_list() {
    var usl = document.getElementById('usl').value;
    $('#show').load('user_list.php?usl=' + usl).fadeIn('fast');
}

function user_status(sl, val) {
    $('#free').load("updt.php?sl=" + sl + "&val=" + val).fadeIn('fast');
}

function reset_pass(sl) {
    $('#free').load("reset_pass.php?sl=" + sl).fadeIn('fast');
}

function vendor_list() {
    var bcd = document.getElementById('bcds').value;
    var all = encodeURIComponent(document.getElementById('all').value);
    $('#show').load('vendor_list.php?bcd=' + bcd + '&all=' + all).fadeIn('fast');
}

function get_vendor() {
    var bcd = document.getElementById('bcd').value;

    $('#get_vendor').load('get_vendor.php?bcd=' + bcd).fadeIn('fast');
}

function add_driver() {

    var dr_nm = document.getElementById('dr_nm').value;
    if (dr_nm == 'Add') {

        $('#details_div').load('add_driver.php?dr_nm=' + dr_nm).fadeIn("fast");
        $('#compose-modal').modal('show');
    } else {
        $.get('get_driver.php?sl=' + dr_nm, function(data) {

            var str = data;
            var stra = str.split("@@")
            var nm = stra.shift()
            var mob = stra.shift()
            var licno = stra.shift()

            $('#dmob').val(mob);
            $('#licno').val(licno);

        });

    }

}

function add_drivers() {
    var dnm = encodeURIComponent(document.getElementById('dnm').value);
    var dmob = encodeURIComponent(document.getElementById('ddmob').value);
    var dlicno = encodeURIComponent(document.getElementById('dlicno').value);
    if (dnm == "") {
        alert("Please Enter Driver Name !")
    } else {
        $('#free').load("add_drivers.php?nm=" + dnm + "&mob=" + dmob + "&licno=" + dlicno).fadeIn('fast');
    }
}

function truck_list() {
    var bcd = document.getElementById('bcds').value;
    var all = encodeURIComponent(document.getElementById('all').value);
    $('#show').load('truck_list.php?bcd=' + bcd + '&all=' + all).fadeIn('fast');
}

function get_cust() {
    var bcd = document.getElementById('bcd').value;

    $('#get_cust').load('get_cust.php?bcd=' + bcd).fadeIn('fast');
}

function get_loding() {
    var bcd = document.getElementById('bcd').value;
    var cid = document.getElementById('cid').value;

    $('#get_loding').load('get_loding.php?bcd=' + bcd + "&cid=" + cid).fadeIn('fast');
}

function freight_del()

{
    var bcd = document.getElementById('bcd').value;


    if (confirm('Are You Sure To Delete...')) {

        document.location = "freight_del.php?bcd=" + bcd;

    }

}

function freight_list() {
    var bcd = document.getElementById('bcd').value;

    $('#show').load('freight_list.php?bcd=' + bcd).fadeIn('fast');
}

function freight_edt(sl) {
    $('#details_div').load('freight_edt.php?sl=' + sl).fadeIn("fast");
    $('#compose-modal').modal('show');

}


function freight_submit()

{


    if (confirm('Are You Sure To Submit !')) {

        document.location = "freight_submit.php";

    }

}