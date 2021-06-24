<?php include "include/header.php"?>
<?php
$ctg_edit = $_GET['ctg_edit'];
// $get_qry = mysqli_query($conn, "SELECT * FROM single_product WHERE id='$ctg_edit'");
$get_qry = mysqli_query($conn, "SELECT single_product.id,single_product.prdct_id,single_product.sprdct_id,single_product.img,single_product.s_prdct_name,single_product.price,single_product.ratting,single_product.description,single_product.availability,single_product.shipping,sub_product.id as subpdct_id,sub_product.pdct_id,sub_product.name,product.id as pdct_id,product.name as pdct_name FROM single_product INNER JOIN sub_product ON single_product.sprdct_id=sub_product.id INNER JOIN product ON single_product.prdct_id=product.id WHERE single_product.id='$ctg_edit'");
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
                



                <!-- ***************************** -->

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
                          <select type="text" id="pdct_name" name="pdct_name" required="required" class="form-control col-md-7 col-xs-12" onchange="get_sub_pdct()">
                            <option value="<?php echo $get_qry_a['pdct_id']?>"><?php echo $get_qry_a['pdct_name']?></option>
<?php
$gets_qry = mysqli_query($conn, "SELECT * FROM product");
while ($gets_qry_a = mysqli_fetch_array($gets_qry)) {
  echo '<option value="'.$gets_qry_a['id'].'">'.$gets_qry_a['name'].'</option>';
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
                            <option value="<?php echo $get_qry_a['subpdct_id']?>"><?php echo $get_qry_a['name']?></option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="single_pdct_id" style="display: none;" value="<?php echo $ctg_edit;?>">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ctg_name" value="<?php echo $get_qry_a['s_prdct_name']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Price <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ctg_price" value="<?php echo $get_qry_a['price']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ratting <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ctg_ratting" value="<?php echo $get_qry_a['ratting']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ctg_description" value="<?php echo $get_qry_a['description']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Availability <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ctg_availability" value="<?php echo $get_qry_a['availability']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Shipping <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="ctg_shipping" value="<?php echo $get_qry_a['shipping']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Image Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img src="../img/product/<?php echo $get_qry_a['img']?>" style="width: 50%;"><a href="edit-ctg-img?img_id=<?php echo $ctg_edit;?>"> <span style="padding: 1px 7px 1px 7px; background: #0c3f6d; color: #fff;">Upload Image</span></a>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="single_product_edit">Submit</button>
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
