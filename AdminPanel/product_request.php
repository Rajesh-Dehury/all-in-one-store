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
                <h3>Contact Messages</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                

                <div class="x_panel">
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead class="table_heade">
                        <tr>
                          <th>Sl. No.</th>
                          <th>Name</th>
                          <th>Organisation</th>
                          <th>Mobile</th>
                          <th>Quantity</th>
                          <th>Product Type</th>
                          <th>Messages Time</th>
                        </tr>
                      </thead>


                      <tbody>

<?php
  $number=0;
  $request_qry = mysqli_query($conn, "SELECT * FROM request_order order by id desc");
  while ($request_qry_a = mysqli_fetch_array($request_qry)) {
    $number++;
?>
                        <tr>
                          <td><?php echo $number?></td>
                          <td><?php echo $request_qry_a['per_name']?></td>
                          <td><?php echo $request_qry_a['org_name']?></td>
                          <td><?php echo $request_qry_a['mobile']?></td>
                          <td><?php echo $request_qry_a['quantity']?></td>
                          <td><?php echo $request_qry_a['pdct_type']?></td>
                          <td><?php echo $request_qry_a['send_time']?></td>
                        </tr>
<?php
  }
?>
                      </tbody>

                      <thead class="table_heade">
                        <tr>
                          <th>Sl. No.</th>
                          <th>Name</th>
                          <th>Organisation</th>
                          <th>Mobile</th>
                          <th>Quantity</th>
                          <th>Product Type</th>
                          <th>Messages Time</th>
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
