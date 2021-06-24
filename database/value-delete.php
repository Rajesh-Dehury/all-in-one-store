<?php
error_reporting(E_ALL);
include "connect.php";

if (isset($_GET["delete_product_id"])) {
	$qrry = "DELETE FROM product WHERE id='" . $_GET["delete_product_id"] . "'";
	$data = mysqli_query($conn, $qrry);
	header("Location:../AdminPanel/categories_a");
}
if (isset($_GET["delete_sub_product_id"])) {
	$qrry = "DELETE FROM sub_product WHERE id='" . $_GET["delete_sub_product_id"] . "'";
	$data = mysqli_query($conn, $qrry);
	header("Location:../AdminPanel/categories");
}
if (isset($_GET["delete_sub_product_a_id"])) {
	$qrry = "DELETE FROM single_product WHERE id='" . $_GET["delete_sub_product_a_id"] . "'";
	$data = mysqli_query($conn, $qrry);
	header("Location:../AdminPanel/categories");
}
if (isset($_GET["delect_pdct_id"])) {
	$qrry = "DELETE FROM select_product WHERE id='" . $_GET["delect_pdct_id"] . "'";
	$data = mysqli_query($conn, $qrry);
	header("Location:../shoping-cart");
}



if (isset($_GET["cancel_pdct_id"])) {
	$qrry = "UPDATE select_product SET status='4' WHERE id='" . $_GET["cancel_pdct_id"] . "'";
	$data = mysqli_query($conn, $qrry);
	header("Location:../order-history");
}
if (isset($_GET["continue_pdct_id"])) {
	$qrry = "UPDATE select_product SET status='0' WHERE id='" . $_GET["continue_pdct_id"] . "'";
	$data = mysqli_query($conn, $qrry);
	header("Location:../shoping-cart");
}
?>