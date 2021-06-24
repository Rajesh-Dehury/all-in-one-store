<?php include "include/header.php"?>

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
                    <!-- <div class="title_right text-right">
                      <select style="background: #0b6abf; color: #fff;" onchange="">
                        <option>Select Booking List</option>
<?php
  $order_qry = mysqli_query($conn, "SELECT distinct order_number FROM select_product WHERE status='1'");
  while ($order_qry_a = mysqli_fetch_array($order_qry)) {
?>
  <option value="<?php echo $order_qry_a['order_number'];?>"><?php echo $order_qry_a['order_number'];?></option>
<?php
  }
?>
                      </select>
                    </div> -->
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
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead class="table_heade">
                        <tr>
                          <th>Sl No.</th>
                          <th>Categories</th>
                          <th>Provided Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
<?php
  $number=0;
    $banner_qry = mysqli_query($conn, "SELECT * FROM prdct_provide_date WHERE status='3'");
  while ($banner_qry_a = mysqli_fetch_array($banner_qry)) {
    // $userid = $banner_qry_a['userid'];
    // $select_qry = mysqli_query($conn, "SELECT * FROM singup WHERE id='$userid'");
    // $select_qry_a = mysqli_fetch_array($select_qry);
    $number++;
?>
                        <tr>
                          <td><?php echo $number?></td>
                          <td><?php echo $banner_qry_a['product_id']?></td>
                          <td><?php echo $banner_qry_a['provided_date']?></td>
                          <td><a href="view-completed-product_provide?ctg_edit=<?php echo $banner_qry_a['product_id']?>"> <span style="padding: 2px 8px 2px 8px; background: green; color: #fff;">View</span></a></td>
                        </tr>
<?php
  }
?>
                      </tbody>
                      <thead class="table_heade">
                        <tr>
                          <th>Sl No.</th>
                          <th>Categories</th>
                          <th>Provided Date</th>
                          <th>Action</th>
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
