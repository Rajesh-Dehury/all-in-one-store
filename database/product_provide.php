<?php
error_reporting(E_ALL);
include "connect.php";

if (isset($_GET["sub_product_provide_id"])) {
	$sub_product_provide_id = $_GET["sub_product_provide_id"];
	$qrry = "UPDATE select_product SET status='2' WHERE order_number='" . $_GET["sub_product_provide_id"] . "'";
	$data = mysqli_query($conn, $qrry);
	$insert_qry = mysqli_query($conn, "INSERT INTO prdct_provide_date(product_id,status) VALUES('$sub_product_provide_id','2')");
	header("Location:../AdminPanel/booking_list");
}
if (isset($_GET["completed_product_provide_id"])) {
	$completed_product_provide_id = $_GET["completed_product_provide_id"];
	$qrry = "UPDATE select_product SET status='3' WHERE order_number='" . $_GET["completed_product_provide_id"] . "'";
	$data = mysqli_query($conn, $qrry);

	$insert_qry = mysqli_query($conn, "INSERT INTO prdct_provide_date(product_id,status) VALUES('$completed_product_provide_id','3')");
	header("Location:../AdminPanel/on-the-way-product");
}

?>