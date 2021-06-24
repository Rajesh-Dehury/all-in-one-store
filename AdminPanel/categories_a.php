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
                <h3>Categories</h3>
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
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Categories Field</h2>
                    <div class="title_right text-right">
                      <a href="categories"><button class="btn btn-default" style="background: #0b6abf; color: #fff;" type="button">Back To</button></a>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Categories Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" required="required" class="form-control col-md-7 col-xs-12" name="ctg_name" id="ctg_name">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="ctg_add">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>

                <!-- ******************** -->

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Categories Details</h2>
                    <!-- <div class="title_right text-right">
                      <button class="btn btn-default" type="button">Go!</button>
                    </div> -->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead class="table_heade">
                        <tr>
                          <th>Sl. No.</th>
                          <th>Name</th>
                          <th>Entry Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>

<?php
  $number=0;
  $banner_qry = mysqli_query($conn, "SELECT * FROM product order by id desc");
  while ($banner_qry_a = mysqli_fetch_array($banner_qry)) {
    $number++;
?>
                        <tr>
                          <td><?php echo $number?></td>
                          <td><?php echo $banner_qry_a['name']?></td>
                          <td><?php echo $banner_qry_a['entry_time']?></td>
                          <td><a href="categories_a_edit?ctg_edit=<?php echo $banner_qry_a['id']?>"><i class="fa fa-edit" style="color: green; cursor: pointer; font-size: 17px;"></i></a> &#X00A0; <i class="fa fa-trash" style="color: red; cursor: pointer; font-size: 17px;" onclick="delete_product(<?php echo $banner_qry_a['id']?>)"></i></td>
                        </tr>
<?php
  }
?>
                      </tbody>

<script type="text/javascript">
  function delete_product(dlt)
  {
    // alert(dlt);
    // return false;
    if (confirm("Do you went delete ?")) {
      window.location.href="../database/value-delete.php?delete_product_id="+dlt+'';
    }
  }
</script>

                      <thead class="table_heade">
                        <tr>
                          <th>Sl. No.</th>
                          <th>Name</th>
                          <th>Entry Time</th>
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
