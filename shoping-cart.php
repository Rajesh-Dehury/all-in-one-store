<?php include "include/header.php"?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="index">Home</a>
                            <span>Shopping Cart</span>
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
$shop = mysqli_query($conn, "SELECT select_product.id,select_product.userid,select_product.pdct_id,select_product.quantity,select_product.sub_total,select_product.status,single_product.id as spid,single_product.img,single_product.s_prdct_name,single_product.price FROM select_product INNER JOIN single_product ON select_product.pdct_id=single_product.id WHERE select_product.userid='$user_id' && select_product.status=0");
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
                                        <button style="font-size: 25px; cursor: pointer; border: none; padding: 2px 15px 2px 15px !important;" onclick="decrement(<?php echo $count;?>);">-</button>
                                            <input type="text" id="value_count<?php echo $count;?>" style="width: 30%; border: none; text-align: center;" value="<?php echo $shop_a['quantity'];?>" required readonly>
                                        <button style="font-size: 25px; cursor: pointer; border: none; padding: 2px 15px 2px 15px !important;" onclick="increment(<?php echo $count;?>);">+</button>
                                        <!-- <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="<?php echo $shop_a['quantity'];?>">
                                            </div>
                                        </div> -->
                                    </td>
                                    <td class="shoping__cart__total">
                                        <input type="text" id="sub_total<?php echo $count;?>" value="<?php echo $shop_a['sub_total'];?>" style="width: 80%; border:0px;" readonly>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close" onclick="delect_pdct(<?php echo $shop_a['id'];?>)"></span>
                                    </td>
                                </tr>
<?php
    }
?>
<script type="text/javascript">
  function delect_pdct(dlt)
  {
    if (confirm("Do you went delete ?")) {
      window.location.href="database/value-delete?delect_pdct_id="+dlt+'';
    }
  }
</script>
                                <!-- <tr>
                                    <td class="shoping__cart__item">
                                        <img src="img/cart/cart-2.jpg" alt="">
                                        <h5>Fresh Garden Vegetable</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        $39.00
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        $39.99
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"></span>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="shoping__cart__btns">
                        <a href="index" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <!-- <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a> -->
                    </div>
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
$shop_count = mysqli_query($conn, "SELECT * FROM select_product WHERE userid='$user_id' && status='0'");
while ($shop_count_a = mysqli_fetch_array($shop_count)) {
    // $number_count++;
    $counts = $shop_count_a['sub_total']+$counts;
    // $shop_count_a = $shop_count_b['sub_total'];
}
?>
                            <li>Total <input type="text" id="total_price" value="<?php echo $counts;?>" style="width: 80%; border:0px; text-align: right; background: none;" readonly>
                                <!-- <span id="total_price<?php echo $number_count;?>"><?php echo $counts;?></span> --></li>
                        </ul>


<?php
if(5<=$count){
    echo '<a href="checkout?id='.$user_id.'" class="primary-btn">PROCEED TO CHECKOUT</a>';
}
?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    <?php include "include/footer.php"?>

<script>
    $(document).ready(function(){
        // value_show();
    });
</script>