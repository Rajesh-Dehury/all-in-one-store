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
                          <th>Mobile</th>
                          <th>Email</th>
                          <th>Messages</th>
                          <th>Messages Time</th>
                          <!-- <th>Action</th> -->
                        </tr>
                      </thead>


                      <tbody>

<?php
  $number=0;
  $cnt_qry = mysqli_query($conn, "SELECT * FROM contact_us order by id desc");
  while ($cnt_qry_a = mysqli_fetch_array($cnt_qry)) {
    $number++;
?>
                        <tr>
                          <td><?php echo $number?></td>
                          <td><?php echo $cnt_qry_a['name']?></td>
                          <td><?php echo $cnt_qry_a['mobile']?></td>
                          <td><?php echo $cnt_qry_a['email']?></td>
                          <td><?php echo $cnt_qry_a['message']?></td>
                          <td><?php echo $cnt_qry_a['msg_time']?></td>
                          <!-- <td style="text-align: center;"><a href="view_msg?msg_id=<?php echo $cnt_qry_a['id']?>"><i class="fa fa-eye" style="color: green; cursor: pointer; font-size: 17px;"></i></a> &#X00A0;</td> -->
                        </tr>
<?php
  }
?>
                      </tbody>

                      <thead class="table_heade">
                        <tr>
                          <th>Sl. No.</th>
                          <th>Name</th>
                          <th>Mobile</th>
                          <th>Email</th>
                          <th>Messages</th>
                          <th>Messages Time</th>
                          <!-- <th>Action</th> -->
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
