<!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo1.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: <?php echo $contact['address']?></li>
                            <li>Phone: <?php echo $contact['mobile']?></li>
                            <li>Email: <?php echo $contact['email']?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Created by <a href="https://www.hexaphor.com" target="_blank">Hexaphor Technologies Pvt. Ltd.</a> , Bhubaneswar</p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
<!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery_function.js"></script>
    <script type="text/javascript" src="js/stellarnav.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery('.stellarnav').stellarNav({
                theme: 'dark',
                breakpoint: 960,
                position: 'right'
                // phoneBtn: '18009997788',
                // locationBtn: 'https://www.google.com/maps'
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>

<script>
    // function value_show(){
    //     var count_value = $('#count_value').val();
    //     // alert(count_value);
    //     for (var i = count_value.length; i > 0; i++) {
    //         if (count_value<i) {
    //             var price_value = $('#price'+i).val();
    //             var value_count = $('#value_count'+i).val();
    //             var sub_total = parseInt(price_value)*parseInt(value_count);
    //             alert(value_count);
    //         }
    //         else{};
    //     }
    // };

    function decrement(n){
        $('#this_value').val(n);
        var this_values = $('#this_value').val();
        var pdctid = $('#pdct_id'+this_values).val();
        var value_count = $('#value_count'+this_values).val();
        if (value_count==1) {
            $('#value_count'+this_values).val(value_count);
        }
        else if(value_count>1){
            var decrement_value = parseInt(value_count)-1;
            $('#value_count'+this_values).val(decrement_value);
            var quantity = $('#value_count'+this_values).val();
            var quantity_price = $('#price'+this_values).val();
            var subtoal = parseInt(decrement_value)*parseInt(quantity_price);
            $('#sub_total'+this_values).val(subtoal);
            var sub_total = $('#sub_total'+this_values).val();
            var total_price = $('#total_price').val();
            var total = parseInt(total_price)-parseInt(quantity_price);
            $('#total_price').val(total);

        // alert(sub_total);
        // return false;

            $.ajax({
                url:'database/ajax.php',
                type:'post',
                data:{
                    pdctid : pdctid,
                    quantity : quantity,
                    sub_total : sub_total
                },
                success:function(data,status){
                    console.log(data);
                }
            });
        }
    };
    function increment(n){
        $('#this_value').val(n);
        var this_values = $('#this_value').val();
        var pdctid = $('#pdct_id'+this_values).val();
        var value_count = $('#value_count'+this_values).val();
        
        var decrement_value = parseInt(value_count)+1;
        $('#value_count'+this_values).val(decrement_value);
        var quantity = $('#value_count'+this_values).val();
        var quantity_price = $('#price'+this_values).val();
        var subtoal = parseInt(decrement_value)*parseInt(quantity_price);
        $('#sub_total'+this_values).val(subtoal);
        var sub_total = $('#sub_total'+this_values).val();
        var total_price = $('#total_price').val();
        var total = parseInt(total_price)+parseInt(quantity_price);
        $('#total_price').val(total);

        // alert(value_count);
        // return false;

            $.ajax({
                url:'database/ajax.php',
                type:'post',
                data:{
                    pdctid : pdctid,
                    quantity : quantity,
                    sub_total : sub_total
                },
                success:function(data,status){
                    console.log(data);
                }
            });
    };
    // $('#time_in').on('blur change keyup keydown', function(){
        
    // }

</script>


<script>
    $(document).ready(function() {
        delete_row_a();
      });

    function delete_row_a(){
        var delete_row = "delete_row";
        // alert(delete_row);
        // return false;
        $.ajax({
            url:'database/ajax.php',
            type:'post',
            data:{
                delete_row : delete_row
            },
            success:function(data){
                console.log(data);
            }
        });
    }
</script>
<script src="js/bpopup.min.js"></script>
<script>
$( document ).ready(function() {
    $('#popup_this').bPopup();
});
</script>
</body>
</html>