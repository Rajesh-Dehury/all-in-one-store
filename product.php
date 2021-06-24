

    <?php include "include/header.php"?>
<?php
    $p_id = $_GET['p_id'];
?>
    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
<?php
    $select_s_ctg_b = mysqli_query($conn,"SELECT single_product.id,single_product.prdct_id,single_product.sprdct_id,single_product.img,single_product.s_prdct_name,single_product.price,single_product.ratting,single_product.description,single_product.availability,single_product.shipping,single_product.entry_time,sub_product.id as subpdct_id,sub_product.pdct_id,sub_product.name,sub_product.entry_time as s_p_time,product.id as pdct_id,product.name as pdct_name FROM single_product INNER JOIN sub_product ON single_product.sprdct_id=sub_product.id INNER JOIN product ON single_product.prdct_id=product.id WHERE single_product.sprdct_id='$p_id'");
    $select_s_ctgs = mysqli_fetch_array($select_s_ctg_b);
?>
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <?php
                            if (isset($select_s_ctgs['name'])) {
                                echo '<h2>'.$select_s_ctgs['name'].'</h2>';
                            }
                            else{
                                echo '<h2>Empty Products</h2>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- <input type="" name="" value="<?php echo $p_id;?>"> -->

<?php
$select_s_ctg_a = mysqli_query($conn,"SELECT single_product.id,single_product.prdct_id,single_product.sprdct_id,single_product.img,single_product.s_prdct_name,single_product.price,single_product.ratting,single_product.description,single_product.availability,single_product.shipping,single_product.entry_time,sub_product.id as subpdct_id,sub_product.pdct_id,sub_product.name,sub_product.entry_time as s_p_time,product.id as pdct_id,product.name as pdct_name FROM single_product INNER JOIN sub_product ON single_product.sprdct_id=sub_product.id INNER JOIN product ON single_product.prdct_id=product.id WHERE single_product.sprdct_id='$p_id'");
while ($select_s_ctg = mysqli_fetch_array($select_s_ctg_a)) {
?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/product/<?php echo $select_s_ctg['img']?>">
                            <ul class="product__item__pic__hover">
                                <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                                <li><a href="single-product?s_p_id=<?php echo $select_s_ctg['id']?>"><i class="fa fa-retweet"></i></a></li>
                                <!-- <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li> -->
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#"><?php echo $select_s_ctg['s_prdct_name']?></a></h6>
                            <h5><?php echo $select_s_ctg['price']?></h5>
                        </div>
                    </div>
                </div>
<?php
    }
?>
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

    <?php include "include/footer.php"?>