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
                      <a href="categories_a"><button class="btn btn-default" style="background: #0b6abf; color: #fff;" type="button">Add New Categories</button></a>
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
                          <select type="text" id="ctg_name" name="ctg_name" required="required" class="form-control col-md-7 col-xs-12">
                            <option value="">Select Categories</option>
<?php
$get_qry = mysqli_query($conn, "SELECT * FROM product");
while ($get_qry_a = mysqli_fetch_array($get_qry)) {
  echo '<option value="'.$get_qry_a['id'].'">'.$get_qry_a['name'].'</option>';
}
?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sub Categories Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="sub_ctg" name="sub_ctg" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="add_sub_ctg">Submit</button>
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
                          <th>Sl No.</th>
                          <th>Categories</th>
                          <th>Sub Categories</th>
                          <th>Entry Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
<?php
  $number=0;
  $banner_qry = mysqli_query($conn, "SELECT sub_product.id,sub_product.pdct_id,sub_product.name,sub_product.entry_time,product.id as pdct_id,product.name as pdct_name FROM sub_product INNER JOIN product on sub_product.pdct_id=product.id order by id desc");
  while ($banner_qry_a = mysqli_fetch_array($banner_qry)) {
    $number++;
?>
                        <tr>
                          <td><?php echo $number?></td>
                          <td><?php echo $banner_qry_a['pdct_name']?></td>
                          <td><?php echo $banner_qry_a['name']?></td>
                          <td><?php echo $banner_qry_a['entry_time']?></td>
                          <td><a href="sub-categories-edit?ctg_edit=<?php echo $banner_qry_a['id']?>"><i class="fa fa-edit" style="color: green; cursor: pointer; font-size: 17px;"></i></a> &#X00A0; <i class="fa fa-trash" style="color: red; cursor: pointer; font-size: 17px;" onclick="delete_sub_product(<?php echo $banner_qry_a['id']?>)"></i></td>
                        </tr>
<?php
  }
?>
                      </tbody>
<script type="text/javascript">
  function delete_sub_product(dlt)
  {
    // alert(dlt);
    // return false;
    if (confirm("Do you went delete ?")) {
      window.location.href="../database/value-delete.php?delete_sub_product_id="+dlt+'';
    }
  }
</script>
                      <thead class="table_heade">
                        <tr>
                          <th>Sl No.</th>
                          <th>Categories</th>
                          <th>Sub Categories</th>
                          <th>Entry Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>



                <!-- ***************************** -->

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Categories Field</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Categories Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select type="text" id="pdct_name" name="pdct_name" required="required" class="form-control col-md-7 col-xs-12" onchange="get_sub_pdct()">
                            <option value="">Select Categories</option>
<?php
$get_qry = mysqli_query($conn, "SELECT * FROM product");
while ($get_qry_a = mysqli_fetch_array($get_qry)) {
  echo '<option value="'.$get_qry_a['id'].'">'.$get_qry_a['name'].'</option>';
}
?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sub Categories Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select type="text" id="subctg" name="sub_ctg" required="required" class="form-control col-md-7 col-xs-12">
                            <option value="">Select Sub Categories</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Image Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ctg_img">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ctg_name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Price <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ctg_price">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ratting <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ctg_ratting">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ctg_description">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Availability <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ctg_availability">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Shipping <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ctg_shipping">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="single_ctg_submit">Submit</button>
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
                    <table id="datatable_a" class="table table-striped table-bordered">
                      <thead class="table_heade">
                        <tr>
                          <th>Sl. No.</th>
                          <th>Images</th>
                          <th>Categories</th>
                          <th>Sub Categories</th>
                          <th>Product Name</th>
                          <th>Price</th>
                          <th>Ratting</th>
                          <th>Description</th>
                          <th>Availability</th>
                          <th>Shipping</th>
                          <th>Entry Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
<?php
  $number=0;
  $single_qry = mysqli_query($conn, "SELECT single_product.id,single_product.prdct_id,single_product.sprdct_id,single_product.img,single_product.s_prdct_name,single_product.price,single_product.ratting,single_product.description,single_product.availability,single_product.shipping,single_product.entry_time,sub_product.id as subpdct_id,sub_product.pdct_id,sub_product.name,sub_product.entry_time as s_p_time,product.id as pdct_id,product.name as pdct_name FROM single_product INNER JOIN sub_product ON single_product.sprdct_id=sub_product.id INNER JOIN product ON single_product.prdct_id=product.id order by id desc");
  while ($single_qry_a = mysqli_fetch_array($single_qry)) {
    $number++;
?>
                        <tr>
                          <td><?php echo $number?></td>
                          <td style="width: 80px;"><img src="../img/product/<?php echo $single_qry_a['img']?>" style="width: 100%;"></td>
                          <td><?php echo $single_qry_a['pdct_name']?></td>
                          <td><?php echo $single_qry_a['name']?></td>
                          <td><?php echo $single_qry_a['s_prdct_name']?></td>
                          <td><?php echo $single_qry_a['price']?></td>
                          <td><?php echo $single_qry_a['ratting']?></td>
                          <td><?php echo $single_qry_a['description']?></td>
                          <td><?php echo $single_qry_a['availability']?></td>
                          <td><?php echo $single_qry_a['shipping']?></td>
                          <td><?php echo $single_qry_a['entry_time']?></td>
                          <td><a href="edit-single-categories?ctg_edit=<?php echo $single_qry_a['id']?>"><i class="fa fa-edit" style="color: green; cursor: pointer; font-size: 17px;"></i></a> &#X00A0; <i class="fa fa-trash" style="color: red; cursor: pointer; font-size: 17px;" onclick="delete_sub_product_a(<?php echo $single_qry_a['id']?>)"></i></td>
                        </tr>
<?php
  }
?>
                      </tbody>
<script type="text/javascript">
  function delete_sub_product_a(dlt)
  {
    // alert(dlt);
    // return false;
    if (confirm("Do you went delete ?")) {
      window.location.href="../database/value-delete.php?delete_sub_product_a_id="+dlt+'';
    }
  }
</script>
                      <thead class="table_heade">
                        <tr>
                          <th>Sl. No.</th>
                          <th>Categories</th>
                          <th>Sub Categories</th>
                          <th>Images</th>
                          <th>Product Name</th>
                          <th>Price</th>
                          <th>Ratting</th>
                          <th>Description</th>
                          <th>Availability</th>
                          <th>Shipping</th>
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
