<?php include "include/header.php"?>
<?php
$ctg_edit = $_GET['ctg_edit'];
  $single_get_qry = mysqli_query($conn, "SELECT select_product.id,select_product.userid,select_product.pdct_id,select_product.quantity,select_product.sub_total,select_product.order_number,select_product.status,select_product.entry_date,singup.id as sp_id,singup.name,singup.email,singup.mobile,singup.address FROM select_product INNER JOIN singup on select_product.userid=singup.id WHERE select_product.order_number='$ctg_edit'");
  $single_get_qry_a = mysqli_fetch_array($single_get_qry);

  $provide_date = mysqli_query($conn, "SELECT * FROM prdct_provide_date WHERE product_id='$ctg_edit' && status='3'");
  $provide_date_a=mysqli_fetch_array($provide_date);

?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include "include/sidbar.php"?>
        <?php include "include/navbar.php"?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Booking List</h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="clearfix"></div>

                <!-- ******************** -->

                <div class="x_panel">
                  <!-- <div class="x_title">
                    <h2>Categories Details</h2>
                    <div class="title_right text-right">
                      <button class="btn btn-default" type="button">Go!</button>
                    </div>
                    <div class="clearfix"></div>
                  </div> -->
                  <p style="color:#000;">Provided Date: <?php echo $provide_date_a['provided_date']?></p>
                  <p style="color:#000;"><span style="font-weight: bold;">Name:</span> <?php echo $single_get_qry_a['name']?></p>
                  <p style="color:#000;"><span style="font-weight: bold;">Mobile:</span> <?php echo $single_get_qry_a['mobile']?></p>
                  <p style="color:#000;"><span style="font-weight: bold;">Email:</span> <?php echo $single_get_qry_a['email']?></p>
                  <p style="color:#000;"><span style="font-weight: bold;">Address:</span> <?php echo $single_get_qry_a['address']?></p>

                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead class="table_heade">
                        <tr>
                          <th>Sl No.</th>
                          <th>Images</th>
                          <th>Product Name</th>
                          <th>Quantity</th>
                          <th>Price</th>
                        </tr>
                      </thead>
                      <tbody>
<?php
  $number=0;
  $get_qry = mysqli_query($conn, "SELECT select_product.id,select_product.userid,select_product.pdct_id,select_product.quantity,select_product.sub_total,select_product.order_number,select_product.status,select_product.entry_date,single_product.id as sp_id,single_product.prdct_id,single_product.sprdct_id,single_product.img,single_product.s_prdct_name,single_product.price,single_product.ratting,single_product.description,single_product.availability,single_product.shipping FROM select_product INNER JOIN single_product on select_product.pdct_id=single_product.id WHERE select_product.order_number='$ctg_edit' && select_product.status='3'");
  while ($get_qry_a = mysqli_fetch_array($get_qry)) {
    $number++;
?>
                        <tr>
                          <td><?php echo $number?></td>
                          <td><img src="../img/product/<?php echo $get_qry_a['img']?>"></td>
                          <td><?php echo $get_qry_a['s_prdct_name']?></td>
                          <td><?php echo $get_qry_a['quantity']?></td>
                          <td><?php echo $get_qry_a['sub_total']?></td>
                        </tr>
<?php
  }
?>
                      </tbody>
                      <thead class="table_heade">
                        <tr>
                          <th>Sl No.</th>
                          <th>Images</th>
                          <th>Product Name</th>
                          <th>Quantity</th>
                          <th>Price</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php include "include/footer.php"?>
