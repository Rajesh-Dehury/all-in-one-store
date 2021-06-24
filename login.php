    <?php include "include/header.php"?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Admin Login Area</h2>
                        <div class="breadcrumb__option">
                            <!-- <a href="./index.html">Home</a> -->
                            <!-- <span>Admin Login Area</span> -->
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
                    <!-- <div class="row">
                        <div class="col-lg-12">
                            <div class="contact__form__title">
                                <h2>Admin Login Area</h2>
                            </div>
                        </div>
                    </div> -->
            <?php if(isset($login_message)) 
              {
              ?>
               <p style="color: red;"><?php echo $login_message;?></p> 
              <?php
              } 
            ?>
                    <form method="post" enctype="multipart/form-data" class="form-field">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 text-center mb-3">
                                <span style="font-weight: bold; color: #fff;">Admin Login</span>
                                <hr/>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <input type="text" placeholder="Email Id" name="userid" required>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <input type="password" placeholder="Password" name="password" required>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="site-btn" name="user_login_submit">SUBMIT</button><br/>
                                <p style="color: #fff;">Do you've an account ? <a href="register" style="color: #1e13c3;">Register Now</a></p>
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
