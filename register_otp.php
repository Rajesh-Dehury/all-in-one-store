  <?php include "include/header.php"?>
<!-- <?php
if (isset($_SESSION['OTP_EMAIL'])) {
    $OTP_EMAIL = $_SESSION['OTP_EMAIL'];
    $_SESSION['OTP_EMAIL'] = $OTP_EMAIL;
}
else{
  header("Location:register");
  die();
}
?> -->
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Contact Us</h2>
                        <div class="breadcrumb__option">
                            <a href="index">Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


<section class="container login">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12"></div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="contact-form spad">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="contact__form__title">
                                <h2>Leave Message</h2>
                            </div>
                        </div>
                    </div>
            <?php
              if(isset($email_msg)){
                echo '<script>alert("Invailde OTP")</script>';
              }
            ?>
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <p style="color: green;">Please check your email</p>
                                <input type="text" placeholder="Enter your OTP" name="otp" required>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="site-btn" name="otp_submit">Continue</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Contact Form Begin -->
    
    <!-- Contact Form End -->

    <?php include "include/footer.php"?>
