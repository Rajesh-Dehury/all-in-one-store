<?php include "include/header.php"?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Order History</h2>
                        <div class="breadcrumb__option">
                            <a href="index">Home</a>
                            <span>Order History</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="pill" href="#Order_Place">Order Place</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="pill" href="#Product_on_the_way">Product on the way</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="pill" href="#Your_Product">Your Product</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="pill" href="#Order_Canceled">Order Canceled</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="Order_Place">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                <input type="text" style="display: none;" id="this_value">
                            </thead>
                            <tbody>
<?php
 // WHERE single_product.id='$s_p_id'
$count=0;
$shop = mysqli_query($conn, "SELECT select_product.id,select_product.userid,select_product.pdct_id,select_product.quantity,select_product.sub_total,select_product.status,single_product.id as spid,single_product.img,single_product.s_prdct_name,single_product.price FROM select_product INNER JOIN single_product ON select_product.pdct_id=single_product.id WHERE select_product.userid='$user_id' && select_product.status=1");
while ($shop_a = mysqli_fetch_array($shop)) {
    $count++;
    // count_function();
?>
<input type="text" style="display: none;" id="count_value" value="<?php echo $count;?>">
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="img/product/<?php echo $shop_a['img'];?>" alt="">
                                        <h5><?php echo $shop_a['s_prdct_name'];?></h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <input type="text" name="pdct_id" id="pdct_id<?php echo $count;?>" style="display: none;" value="<?php echo $shop_a['id'];?>">
                                        <!-- <input type="text" name="user_id" style="display: none;" value="<?php echo $user_id;?>"> -->
                                        <input type="text" id="price<?php echo $count;?>" value="<?php echo $shop_a['price'];?>" style="width: 80%; border:0px;" readonly>
                                    </td>
                                    <td class="shoping__cart__quantity">
                                            <input type="text" id="value_count<?php echo $count;?>" style="width: 30%; border: none; text-align: center;" value="<?php echo $shop_a['quantity'];?>" required readonly>
                                        <!-- <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="<?php echo $shop_a['quantity'];?>">
                                            </div>
                                        </div> -->
                                    </td>
                                    <td class="shoping__cart__total">
                                        <input type="text" id="sub_total<?php echo $count;?>" value="<?php echo $shop_a['sub_total'];?>" style="width: 80%; border:0px;" readonly>
                                    </td>
                                    <td class="shoping__cart__action">
                                        <span style="padding: 2px 8px 2px 8px; background: red; color: #fff; cursor: pointer;" onclick="cancel_pdct(<?php echo $shop_a['id'];?>)">Cancel</span>
                                    </td>
                                </tr>
<?php
    }
?>



                            </tbody>
                        </table>
                    </div>
            <div class="row">
                <div class="col-lg-6">
                </div>
                <!-- <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
<?php
// $number_count=0;
$counts=0;
$shop_count = mysqli_query($conn, "SELECT * FROM select_product WHERE userid='$user_id' && status='1'");
while ($shop_count_a = mysqli_fetch_array($shop_count)) {
    // $number_count++;
    $counts = $shop_count_a['sub_total']+$counts;
    // $shop_count_a = $shop_count_b['sub_total'];
}
?>
                            <li>Total <input type="text" id="" value="<?php echo $counts;?>" style="width: 80%; border:0px; text-align: right; background: none;" readonly></li>
                        </ul>
                    </div>
                </div>
            </div>
  </div>
  <div class="tab-pane container fade" id="Product_on_the_way">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                                <input type="text" style="display: none;" id="this_value">
                            </thead>
                            <tbody>
<?php
 // WHERE single_product.id='$s_p_id'
$count=0;
$shop = mysqli_query($conn, "SELECT select_product.id,select_product.userid,select_product.pdct_id,select_product.quantity,select_product.sub_total,select_product.status,single_product.id as spid,single_product.img,single_product.s_prdct_name,single_product.price FROM select_product INNER JOIN single_product ON select_product.pdct_id=single_product.id WHERE select_product.userid='$user_id' && select_product.status=2");
while ($shop_a = mysqli_fetch_array($shop)) {
    $count++;
    // count_function();
?>
<input type="text" style="display: none;" id="count_value" value="<?php echo $count;?>">
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="img/product/<?php echo $shop_a['img'];?>" alt="">
                                        <h5><?php echo $shop_a['s_prdct_name'];?></h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <input type="text" name="pdct_id" id="pdct_id<?php echo $count;?>" style="display: none;" value="<?php echo $shop_a['id'];?>">
                                        <!-- <input type="text" name="user_id" style="display: none;" value="<?php echo $user_id;?>"> -->
                                        <input type="text" id="price<?php echo $count;?>" value="<?php echo $shop_a['price'];?>" style="width: 80%; border:0px;" readonly>
                                    </td>
                                    <td class="shoping__cart__quantity">
                                            <input type="text" id="value_count<?php echo $count;?>" style="width: 30%; border: none; text-align: center;" value="<?php echo $shop_a['quantity'];?>" required readonly>
                                        <!-- <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="<?php echo $shop_a['quantity'];?>">
                                            </div>
                                        </div> -->
                                    </td>
                                    <td class="shoping__cart__total">
                                        <input type="text" id="sub_total<?php echo $count;?>" value="<?php echo $shop_a['sub_total'];?>" style="width: 80%; border:0px;" readonly>
                                    </td>
                                    <!-- <td class="shoping__cart__action">
                                        <span style="padding: 2px 8px 2px 8px; background: red; color: #fff; cursor: pointer;" onclick="cancel_pdct(<?php echo $shop_a['id'];?>)">Cancel</span>
                                    </td> -->
                                </tr>
<?php
    }
?>

                            </tbody>
                        </table>
                    </div>
            <div class="row">
                <div class="col-lg-6">
                </div>
                <!-- <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
<?php
// $number_count=0;
$counts=0;
$shop_count = mysqli_query($conn, "SELECT * FROM select_product WHERE userid='$user_id' && status='2'");
while ($shop_count_a = mysqli_fetch_array($shop_count)) {
    // $number_count++;
    $counts = $shop_count_a['sub_total']+$counts;
    // $shop_count_a = $shop_count_b['sub_total'];
}
?>
                            <li>Total <input type="text" id="" value="<?php echo $counts;?>" style="width: 80%; border:0px; text-align: right; background: none;" readonly></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
  <div class="tab-pane container fade" id="Your_Product">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                                <input type="text" style="display: none;" id="this_value">
                            </thead>
                            <tbody>
<?php
 // WHERE single_product.id='$s_p_id'
$count=0;
$shop = mysqli_query($conn, "SELECT select_product.id,select_product.userid,select_product.pdct_id,select_product.quantity,select_product.sub_total,select_product.status,single_product.id as spid,single_product.img,single_product.s_prdct_name,single_product.price FROM select_product INNER JOIN single_product ON select_product.pdct_id=single_product.id WHERE select_product.userid='$user_id' && select_product.status=3");
while ($shop_a = mysqli_fetch_array($shop)) {
    $count++;
    // count_function();
?>
<input type="text" style="display: none;" id="count_value" value="<?php echo $count;?>">
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="img/product/<?php echo $shop_a['img'];?>" alt="">
                                        <h5><?php echo $shop_a['s_prdct_name'];?></h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <input type="text" name="pdct_id" id="pdct_id<?php echo $count;?>" style="display: none;" value="<?php echo $shop_a['id'];?>">
                                        <!-- <input type="text" name="user_id" style="display: none;" value="<?php echo $user_id;?>"> -->
                                        <input type="text" id="price<?php echo $count;?>" value="<?php echo $shop_a['price'];?>" style="width: 80%; border:0px;" readonly>
                                    </td>
                                    <td class="shoping__cart__quantity">
                                            <input type="text" id="value_count<?php echo $count;?>" style="width: 30%; border: none; text-align: center;" value="<?php echo $shop_a['quantity'];?>" required readonly>
                                        <!-- <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="<?php echo $shop_a['quantity'];?>">
                                            </div>
                                        </div> -->
                                    </td>
                                    <td class="shoping__cart__total">
                                        <input type="text" id="sub_total<?php echo $count;?>" value="<?php echo $shop_a['sub_total'];?>" style="width: 80%; border:0px;" readonly>
                                    </td>
                                </tr>
<?php
    }
?>
                            </tbody>
                        </table>
                    </div>
            <div class="row">
                <div class="col-lg-6">
                </div>
                <!-- <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
<?php
// $number_count=0;
$counts=0;
$shop_count = mysqli_query($conn, "SELECT * FROM select_product WHERE userid='$user_id' && status='3'");
while ($shop_count_a = mysqli_fetch_array($shop_count)) {
    // $number_count++;
    $counts = $shop_count_a['sub_total']+$counts;
    // $shop_count_a = $shop_count_b['sub_total'];
}
?>
                            <li>Total <input type="text" id="" value="<?php echo $counts;?>" style="width: 80%; border:0px; text-align: right; background: none;" readonly></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
  <div class="tab-pane container fade" id="Order_Canceled">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                                <input type="text" style="display: none;" id="this_value">
                            </thead>
                            <tbody>
<?php
 // WHERE single_product.id='$s_p_id'
$count=0;
$shop = mysqli_query($conn, "SELECT select_product.id,select_product.userid,select_product.pdct_id,select_product.quantity,select_product.sub_total,select_product.status,single_product.id as spid,single_product.img,single_product.s_prdct_name,single_product.price FROM select_product INNER JOIN single_product ON select_product.pdct_id=single_product.id WHERE select_product.userid='$user_id' && select_product.status=4");
while ($shop_a = mysqli_fetch_array($shop)) {
    $count++;
    // count_function();
?>
<input type="text" style="display: none;" id="count_value" value="<?php echo $count;?>">
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="img/product/<?php echo $shop_a['img'];?>" alt="">
                                        <h5><?php echo $shop_a['s_prdct_name'];?></h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <input type="text" name="pdct_id" id="pdct_id<?php echo $count;?>" style="display: none;" value="<?php echo $shop_a['id'];?>">
                                        <!-- <input type="text" name="user_id" style="display: none;" value="<?php echo $user_id;?>"> -->
                                        <input type="text" id="price<?php echo $count;?>" value="<?php echo $shop_a['price'];?>" style="width: 80%; border:0px;" readonly>
                                    </td>
                                    <td class="shoping__cart__quantity">
                                            <input type="text" id="value_count<?php echo $count;?>" style="width: 30%; border: none; text-align: center;" value="<?php echo $shop_a['quantity'];?>" required readonly>
                                        <!-- <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="<?php echo $shop_a['quantity'];?>">
                                            </div>
                                        </div> -->
                                    </td>
                                    <td class="shoping__cart__total">
                                        <input type="text" id="sub_total<?php echo $count;?>" value="<?php echo $shop_a['sub_total'];?>" style="width: 80%; border:0px;" readonly>
                                    </td>
                                    <td class="shoping__cart__action">
                                        <span style="padding: 2px 8px 2px 8px; background: red; color: #fff; cursor: pointer;" onclick="continue_pdct(<?php echo $shop_a['id'];?>)">Continue</span>
                                    </td>
                                </tr>
<?php
    }
?>
                            </tbody>
                        </table>
                    </div>
            <div class="row">
                <div class="col-lg-6">
                </div>
                <!-- <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
<?php
// $number_count=0;
$counts=0;
$shop_count = mysqli_query($conn, "SELECT * FROM select_product WHERE userid='$user_id' && status='4'");
while ($shop_count_a = mysqli_fetch_array($shop_count)) {
    // $number_count++;
    $counts = $shop_count_a['sub_total']+$counts;
    // $shop_count_a = $shop_count_b['sub_total'];
}
?>
                            <li>Total <input type="text" id="" value="<?php echo $counts;?>" style="width: 80%; border:0px; text-align: right; background: none;" readonly></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</div>
                    
                </div>
            </div>
        </div>
    </section>

<script type="text/javascript">
  function cancel_pdct(dlt)
  {
    if (confirm("Do you went to cancel this order ?")) {
      window.location.href="database/value-delete?cancel_pdct_id="+dlt+'';
    }
  }
  function continue_pdct(dlt)
  {
    if (confirm("Do you went to continue this order ?")) {
      window.location.href="database/value-delete?continue_pdct_id="+dlt+'';
    }
  }
</script>




    <!-- Shoping Cart Section End -->

    <?php include "include/footer.php"?>

<script>
    $(document).ready(function(){
        // value_show();
    });
</script>