<?php include "include/header.php"?>
<?php
$ctg_edit = $_GET['ctg_edit'];
$get_qry = mysqli_query($conn, "SELECT * FROM product WHERE id='$ctg_edit'");
$get_qry_a = mysqli_fetch_array($get_qry);
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
                      <a href="categories_a"><button class="btn btn-default" style="background: #0b6abf; color: #fff;" type="button">Back To</button></a>
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
                          <input type="text" name="ctg_edit_id" style="display: none;" value="<?php echo $ctg_edit;?>">
                          <input type="text" required="required" class="form-control col-md-7 col-xs-12" name="ctg_name" id="ctg_name" value="<?php echo $get_qry_a['name'];?>">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="ctg_update">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>

              </div>
            </div>


          </div>
        </div>
        <!-- /page content -->
<?php include "include/footer.php"?>
