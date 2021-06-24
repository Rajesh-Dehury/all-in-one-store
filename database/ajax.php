<?php
include "connect.php";
if (isset($_POST['pdct_id'])) {
	$pdct_id = $_POST['pdct_id'];
	$get_sub_qry = mysqli_query($conn, "SELECT * FROM sub_product WHERE pdct_id='$pdct_id'");
	while ($get_sub_qry_a = mysqli_fetch_array($get_sub_qry)) {
	  echo '<option value="'.$get_sub_qry_a['id'].'">'.$get_sub_qry_a['name'].'</option>';
	}
}

if (isset($_POST['pdctid'])) {
	$pdctid = $_POST['pdctid'];
	$quantity = $_POST['quantity'];
	$sub_total = $_POST['sub_total'];

	$insert_qry = mysqli_query($conn, "UPDATE select_product SET quantity='$quantity', sub_total='$sub_total' WHERE id='$pdctid'");
}



if (isset($_POST['delete_row'])=="delete_row") {
	$current_date = date("Y-m-d");
	$att_date_a = date('Y-m-d',strtotime($current_date. '-30 day'));
	$get_sub_qry = mysqli_query($conn, "SELECT * FROM select_product WHERE status='0'");
	while ($get_sub_qry_a = mysqli_fetch_array($get_sub_qry)) {
		$entry_date = $get_sub_qry_a['entry_date'];
		if ($entry_date<$att_date_a) {
			$value_delete = mysqli_query($conn,"DELETE FROM select_product WHERE entry_date='$entry_date'");
		}
	}
}

?>