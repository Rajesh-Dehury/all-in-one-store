<?php
mysqli_set_charset($conn, 'utf8');
// ***************Admin Login*****************
if (isset($_POST['login_submit'])) {
  $userid = $_POST['userid'];
  $password = $_POST['password'];
  
  $qerry = "SELECT * FROM admin WHERE userid = '$userid' && password = '$password'";
  $qry = mysqli_query($conn, $qerry);
  $count = mysqli_num_rows($qry);
  
  if ($count > 0) {
    $_SESSION['userid'] = $userid;
    header("Location:AdminPanel/index");
  }
  else{
    header("Location:login?login_message=Invalid userid & password..!!");
  }
}

if (isset($_GET['login_message'])) {
  $login_message = $_GET['login_message'];
}

// *****Admin Change Password******

if(isset($_POST['continue_change'])){
  $password = $_POST['crnt_pass'];
  $userid = $_SESSION['userid'];
  $passresult = mysqli_query($conn,"SELECT * FROM admin where password='$password' && userid='$userid'");
  $pass_row = mysqli_fetch_array($passresult);
  $gg= $pass_row['password'];
  if($password==$gg) {
    $_SESSION['userid'] = $userid;
    header("location:change_password_a?userid=".$userid);
  }
  else{
    $update_faild = "Please Enter the Correct Old Password!";
  }
}

if(isset($_POST['change_submit'])){
  $userid = $_SESSION['userid'];
  $newpassword = $_POST['new_pass'];
  $pass_qry = "UPDATE admin SET password = '$newpassword' WHERE userid = '$userid' ";
  if (mysqli_query($conn, $pass_qry)) {
    header("location:change_password?update_success=Password Changed Successfully!");
  }
}

if (isset($_GET['update_faild'])) {
  $update_faild = $_GET['update_faild'];
}
if (isset($_GET['update_success'])) {
  $update_success = $_GET['update_success'];
}



// **************** Forget Password ****************

if(isset($_POST['get_password'])){
  $a= $_POST['email'];
  $email_qry = mysqli_query($conn, "SELECT * FROM user WHERE email='$a'");
  if ($email_qry) {
    $email_row = mysqli_fetch_array($email_qry);
    $b= $email_row['email'];
    
    if($a==$b) {
      $otp = rand(10000,99999);
      $otp_result = mysqli_query($conn, "UPDATE user SET otp='$otp' WHERE email='$a'");
      // echo $otp;
      // exit();
      if ($otp_result) {
        // $_SESSION['email_message'] = $a;
        $to = $a;
        $subject = "Forget Password";
        $message = "Your otp is : ".$otp;
        $header = "From:info@hexaphor.com" . "\r\n" . "CC:";
        mail($to,$subject,$message,$header);
        $_SESSION['OTP_EMAIL'] = $a;
        header("location: forgot-password-a");
      }
    }
    else{
      header("location: forgot-password?faild_msg=failed!Invalid Email id!");
    }
  }
}

if(isset($_POST['set_otp'])){
  $OTP_EMAIL= $_SESSION['OTP_EMAIL'];
  $otp= $_POST['otp'];
  $email_qrys = mysqli_query($conn, "SELECT * FROM user WHERE email='$OTP_EMAIL' && otp='$otp'");
  $count_otp = mysqli_num_rows($email_qrys);
  if ($count_otp>0) {
    $_SESSION['OTP_EMAIL'] = $OTP_EMAIL;
    header("location: forgot-password-b");
  }
  else {
    header("location: forgot-password-a?faild_msg=failed!Invalid OTP!");
  }
}

if(isset($_POST['update_pas'])){
  $new_password = $_POST['new_password'];
  $userid = $_SESSION['OTP_EMAIL'];
      // echo "sdfsdfdsf0";
      // exit();
      $passresult_a = mysqli_query($conn,"SELECT * FROM user WHERE email='$userid'");
      if ($passresult_a) {
        $pass_qry = "UPDATE user SET password = '$new_password' WHERE email = '$userid' ";
        if (mysqli_query($conn, $pass_qry)) {
          // $_SESSION['email_message_complete'] = $userid;
          session_unset();
          header("location:forgot-password?update_success=Password Changed Successfully!");
        }
      }
}

if (isset($_GET['update_success'])) {
  $update_success = $_GET['update_success'];
}
if (isset($_GET['faild_msg'])) {
  $faild_msg = $_GET['faild_msg'];
}

// ******************** Register *****************
if(isset($_POST['otp_send'])){
  $a= $_POST['email'];
  $emailresult = mysqli_query($conn,"SELECT * FROM singup where email='" . $_POST['email'] . "'");
  $email_row = mysqli_fetch_array($emailresult);
  $b= $email_row['email'];

  if ($a==$b) {
    $email_msg = "Already exist your EmailID!";
  }
  else{
    $otp = rand(10000,99999);
    $otp_result = mysqli_query($conn, "INSERT INTO singup(email, otp) VALUES('$a', '$otp')");
    if ($otp_result) {
      $to = $a;
      $subject = "Forget Password";
      $message = "Your otp is : ".$otp;
      $header = "From:info@hexaphor.com" . "\r\n" . "CC:";
      mail($to,$subject,$message,$header);
      $_SESSION['OTP_EMAIL'] = $a;
      header("location: register_otp");
    }
  }
}

if(isset($_POST['otp_submit'])){
  $OTP_EMAIL = $_SESSION['OTP_EMAIL'];
  $otp= $_POST['otp'];
  $opt_results = mysqli_query($conn,"SELECT * FROM singup where otp='$otp' && email='$OTP_EMAIL'");
  $opt_results_count = mysqli_num_rows($opt_results);
  if ($opt_results_count == 1) {
    $_SESSION['OTP_EMAIL'] = $OTP_EMAIL;
    header("location: register_submit");
  }
  else{
    $email_msg = "Please enter your correct OTP";
  }
}
if(isset($_POST['register_submit'])){
  $OTP_EMAIL = $_SESSION['OTP_EMAIL'];
  $name = $_POST['name'];
  $mobile = $_POST['mobile'];
  $address = $_POST['address'];
  $password = $_POST['password'];
  $opt_results = mysqli_query($conn,"UPDATE singup SET name='$name', mobile='$mobile', address='$address', password='$password' WHERE email='$OTP_EMAIL'");
  if ($opt_results) {
    $_SESSION['userid'] = $OTP_EMAIL;
    header("location: index");
  }
  else{
    echo "string";
    exit();
  }
  
}


if (isset($_POST['user_login_submit'])) {
  $userid = $_POST['userid'];
  $password = $_POST['password'];
  
  $qerry = "SELECT * FROM singup WHERE email = '$userid' && password = '$password'";
  $qry = mysqli_query($conn, $qerry);
  $count = mysqli_num_rows($qry);
  
  if ($count > 0) {
    $_SESSION['userid'] = $userid;
    header("Location:index");
  }
  else{
    header("Location:login?login_message=Invalid userid & password..!!");
  }
}

if (isset($_GET['login_message'])) {
  $login_message = $_GET['login_message'];
}



// ********************Banners*****************
if (isset($_POST['banner_submit'])) {
	$banner_name = $_POST['banner_name'];
  $banner_link = $_POST['banner_link'];
  $banner_type = $_POST['banner_type'];

	$image_name = $_FILES['banner_img']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['banner_img']['type'];
    $image_size = $_FILES['banner_img']['size'];
    $image_tmp_name = $_FILES['banner_img']['tmp_name'];

    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);

    $dd = $image_name."_".date("mjYHis").".".$image_ext;


   		if(!empty($dd)) {
           if ($image_size<=20000000) {
               if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                   $final_file = "../images/banners/".$dd;
                   $upload = move_uploaded_file($image_tmp_name, $final_file);
                   if ($upload) {
                       $qerry = "INSERT INTO banner(bnr_name, bnr_link, bnr_type, bnr_img) VALUES('$banner_name', 'https://$banner_link', '$banner_type', '$dd')";
                        if (mysqli_query($conn,$qerry)) {
                            header("Location:banner_slide");
                        }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                   }
               }
           }
        }
}

if (isset($_POST['upload_bnr_image'])) {
	$bnr_id = $_POST['bnr_id'];
	$_SESSION['bnr_id'] = $bnr_id;
	header("Location:edit_banner_img?bnr_id/=".$bnr_id);
}

if (isset($_POST['edit_bnr_img_submit'])) {
	
	$image_id = $_POST['image_id'];

	$image_name = $_FILES['banner_img']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['banner_img']['type'];
    $image_size = $_FILES['banner_img']['size'];
    $image_tmp_name = $_FILES['banner_img']['tmp_name'];

    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);

    $dd = $image_name."_".date("mjYHis").".".$image_ext;


   		if(!empty($dd)) {
           if ($image_size<=20000000) {
               if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                   $final_file = "../images/banners/".$dd;
                   $upload = move_uploaded_file($image_tmp_name, $final_file);
                   if ($upload) {
                       $qerry = "UPDATE banner SET bnr_img='$dd' WHERE id='$image_id'";
                        if (mysqli_query($conn,$qerry)) {
                            header("Location:edit_banner_slide?id=".$image_id);
                        }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                   }
               }
           }
        }
}

if (isset($_POST['banner_details_submit'])) {
	$bnr_id = $_POST['bnr_id'];
	$banner_name = $_POST['banner_name'];
  $banner_link = $_POST['banner_link'];
	$qerry = mysqli_query($conn,"UPDATE banner SET bnr_name='$banner_name', bnr_link='$banner_link' WHERE id='$bnr_id'");
	header("Location:banner_slide");
}


// **************************Send Message***********************
if (isset($_POST['send_message'])) {
  $name= $_POST['name'];
  $email= $_POST['email'];
  $mobile= $_POST['mobile'];
  $message= $_POST['message'];
  $insert_qry = mysqli_query($conn, "INSERT INTO `contact_us`(`name`, `email`, `mobile`, `message`) VALUES ('$name', '$email', '$mobile', '$message')");
  if ($insert_qry) {
      $to = "info@apsdp.com";
      $subject = "Contact Message";
      $message =  $message. "\r\n" .$name. "\r\n" .$mobile;
      $header = "From: ".$email. "\r\n" . "CC: ";
      $retval = mail($to,$subject,$message,$header);
      header("Location:contact?msg=Message send successfully...!! ");      
  }    
}
if(isset($_GET['msg'])){ 
  $msg = $_GET['msg'];
}



// *********************Categories********************
if (isset($_POST['ctg_add'])) {
  $ctg_name= $_POST['ctg_name'];
  $insert_qry = mysqli_query($conn, "INSERT INTO `product`(`name`) VALUES ('$ctg_name')");
  if ($insert_qry) {
      header("Location:categories_a?add_ctg=Categories add successfully...!! ");      
  }    
}
if (isset($_POST['ctg_update'])) {
  $ctg_edit_id= $_POST['ctg_edit_id'];
  $ctg_name= $_POST['ctg_name'];
  $insert_qry = mysqli_query($conn, "UPDATE product SET name='$ctg_name' WHERE id='$ctg_edit_id'");
  if ($insert_qry) {
      header("Location:categories_a?add_ctg=Categories Updated successfully...!! ");      
  }    
}
if(isset($_GET['add_ctg'])){ 
  $add_ctg = $_GET['add_ctg'];
}

// *********************Sub Categories********************
if (isset($_POST['add_sub_ctg'])) {
  $ctg_name= $_POST['ctg_name'];
  $sub_ctg= $_POST['sub_ctg'];
  $insert_qry = mysqli_query($conn, "INSERT INTO `sub_product`(`pdct_id`,`name`) VALUES ('$ctg_name','$sub_ctg')");
  if ($insert_qry) {
      header("Location:categories?add_ctg=Sub categories add successfully...!! ");      
  }    
}
if (isset($_POST['update_sub_ctg'])) {
  $ctg_edit_id= $_POST['ctg_edit_id'];
  $ctg_name= $_POST['ctg_name'];
  $sub_ctg= $_POST['sub_ctg'];
  $insert_qry = mysqli_query($conn, "UPDATE sub_product SET pdct_id='$ctg_name', name='$sub_ctg' WHERE id='$ctg_edit_id'");
  if ($insert_qry) {
      header("Location:categories?add_ctg=Categories Updated successfully...!! ");      
  }    
}
if(isset($_GET['add_ctg'])){ 
  $add_ctg = $_GET['add_ctg'];
}


// *********************Single Categories********************
if (isset($_POST['single_ctg_submit'])) {
  $pdct_name= $_POST['pdct_name'];
  $sub_ctg= $_POST['sub_ctg'];
  $ctg_name= $_POST['ctg_name'];
  $ctg_price= $_POST['ctg_price'];
  $ctg_ratting= $_POST['ctg_ratting'];
  $ctg_description= $_POST['ctg_description'];
  $ctg_availability= $_POST['ctg_availability'];
  $ctg_shipping= $_POST['ctg_shipping'];

  $image_name = $_FILES['ctg_img']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['ctg_img']['type'];
    $image_size = $_FILES['ctg_img']['size'];
    $image_tmp_name = $_FILES['ctg_img']['tmp_name'];

    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);

    $dd = $image_name."_".date("mjYHis").".".$image_ext;


      if(!empty($dd)) {
           if ($image_size<=20000000) {
               if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                   $final_file = "../img/product/".$dd;
                   $upload = move_uploaded_file($image_tmp_name, $final_file);
                   if ($upload) {
                       $qerry = "INSERT INTO `single_product`(`prdct_id`, `sprdct_id`, `img`, `s_prdct_name`, `price`, `ratting`, `description`, `availability`, `shipping`) VALUES ('$pdct_name', '$sub_ctg', '$dd', '$ctg_name', '$ctg_price', '$ctg_ratting', '$ctg_description', '$ctg_availability', '$ctg_shipping')";
                        if (mysqli_query($conn,$qerry)) {
                            header("Location:categories");
                        }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                   }
               }
           }
        }    
}
if (isset($_POST['single_product_edit'])) {
  $single_pdct_id= $_POST['single_pdct_id'];
  $pdct_name= $_POST['pdct_name'];
  $sub_ctg= $_POST['sub_ctg'];
  $ctg_name= $_POST['ctg_name'];
  $ctg_price= $_POST['ctg_price'];
  $ctg_ratting= $_POST['ctg_ratting'];
  $ctg_description= $_POST['ctg_description'];
  $ctg_availability= $_POST['ctg_availability'];
  $ctg_shipping= $_POST['ctg_shipping'];

  $insert_qry = mysqli_query($conn, "UPDATE `single_product` SET `prdct_id`='$pdct_name',`sprdct_id`='$sub_ctg',`s_prdct_name`='$ctg_name',`price`='$ctg_price',`ratting`='$ctg_ratting',`description`='$ctg_description',`availability`='$ctg_availability',`shipping`='$ctg_shipping' WHERE id='$single_pdct_id'");
  if ($insert_qry) {
      header("Location:categories");      
  }    
}

if(isset($_POST['images_update'])){
  $single_img_id = $_POST['single_img_id'];
  $image_name = $_FILES['ctg_img']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['ctg_img']['type'];
    $image_size = $_FILES['ctg_img']['size'];
    $image_tmp_name = $_FILES['ctg_img']['tmp_name'];

    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);

    $dd = $image_name."_".date("mjYHis").".".$image_ext;

      if(!empty($dd)) {
           if ($image_size<=20000000) {
               if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                   $final_file = "../img/product/".$dd;
                   $upload = move_uploaded_file($image_tmp_name, $final_file);
                   if ($upload) {
                       $qerry = "UPDATE `single_product` SET `img`='$dd' WHERE id='$single_img_id'";
                        if (mysqli_query($conn,$qerry)) {
                            header("Location:edit-single-categories?ctg_edit=".$single_img_id);
                        }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                   }
               }
           }
        }
}



if(isset($_GET['add_ctg'])){ 
  $add_ctg = $_GET['add_ctg'];
}


// ***************************Website***************************

if (isset($_POST['quantity_submit'])) {
  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $s_p_id= $_POST['s_p_id'];
    $pdct_price= $_POST['pdct_price'];
    $quantity_count= $_POST['quantity_count'];
    $price = $pdct_price*$quantity_count;
    $select = mysqli_query($conn, "SELECT * FROM select_product WHERE userid='$user_id' && pdct_id='$s_p_id' && status='0'");
    $rows = mysqli_num_rows($select);
    if ($rows>0) {
      $select_a = mysqli_fetch_array($select);
      // echo $select_a['pdct_id'].$select_a['userid'].$select_a['status'];
      // exit();
      $insert_qry = mysqli_query($conn, "UPDATE `select_product` SET `userid`='$user_id', `pdct_id`='$s_p_id', `quantity`='$quantity_count', `sub_total`='$price', `status`='0' WHERE userid='$user_id' && pdct_id='$s_p_id' && status='0'");
      header("Location:shoping-cart");

      // if ($s_p_id == $select_a['pdct_id'] && $user_id == $select_a['userid'] && $select_a['status'] == 0) {
      //   $insert_qry = mysqli_query($conn, "UPDATE `select_product` SET `userid`='$user_id', `pdct_id`='$s_p_id', `quantity`='$quantity_count', `sub_total`='$price', `status`='0' WHERE userid='$user_id' && pdct_id='$s_p_id' && status='0'");
      //   header("Location:shoping-cart");
      // }
      // if ($s_p_id == $select_a['pdct_id'] && $user_id == $select_a['userid'] && $select_a['status'] != 0) {
      //   $insert_qry = mysqli_query($conn, "INSERT INTO `select_product`(`userid`, `pdct_id`, `quantity`, `sub_total`, `status`) VALUES ('$user_id', '$s_p_id', '$quantity_count', '$price', '0')");
      //   if ($insert_qry) {
      //       header("Location:shoping-cart");
      //   }
      // }
      // else{
      //   $insert_qry = mysqli_query($conn, "INSERT INTO `select_product`(`userid`, `pdct_id`, `quantity`, `sub_total`, `status`) VALUES ('$user_id', '$s_p_id', '$quantity_count', '$price', '0')");
      //   if ($insert_qry) {
      //       header("Location:shoping-cart");
      //   }
      // }
    }
    else{
      // echo "00000";
      // exit();
      $insert_qry = mysqli_query($conn, "INSERT INTO `select_product`(`userid`, `pdct_id`, `quantity`, `sub_total`, `status`) VALUES ('$user_id', '$s_p_id', '$quantity_count', '$price', '0')");
      if ($insert_qry) {
          header("Location:shoping-cart");
      }
    }
    // $select_a = mysqli_fetch_array($select);
    // if ($s_p_id == $select_a['pdct_id'] && $user_id == $select_a['userid']) {
    //   $insert_qry = mysqli_query($conn, "UPDATE `select_product` SET `userid`='$user_id', `pdct_id`='$s_p_id', `quantity`='$quantity_count', `sub_total`='$price', `status`='0' WHERE userid='$user_id' && pdct_id='$s_p_id'");
    //   header("Location:shoping-cart");     
    // }
    // else{
    //   $insert_qry = mysqli_query($conn, "INSERT INTO `select_product`(`userid`, `pdct_id`, `quantity`, `sub_total`, `status`) VALUES ('$user_id', '$s_p_id', '$quantity_count', '$price', '0')");
    //   if ($insert_qry) {
    //       header("Location:shoping-cart");
    //   }
    // }
  }
  else {
    header("Location:index");
  }
}




if (isset($_POST['place_order'])) {
  $place_order_id= $_POST['place_order_id'];
  // echo $place_order_id;
  // exit();
  $active_number = rand(10000,99999);
  $insert_qry = mysqli_query($conn, "UPDATE `select_product` SET `order_number`='$active_number', `status`='1' WHERE userid='$place_order_id' && status='0'");
  header("Location:shoping-cart");
}

// **********************Product Request***********************
if (isset($_POST['request_submit'])) {
  $per_name= $_POST['per_name'];
  $org_name= $_POST['org_name'];
  $quantity= $_POST['quantity'];
  $pdct_type= $_POST['pdct_type'];
  $mobile= $_POST['mobile'];
  $insert_qry = mysqli_query($conn, "INSERT INTO `request_order`(`per_name`, `org_name`, `quantity`, `pdct_type`, `mobile`) VALUES ('$per_name', '$org_name', '$quantity', '$pdct_type', '$mobile')");
  if ($insert_qry) {
      header("Location:index?request_msg=Message send successfully...!! ");      
  }    
}
if(isset($_GET['request_msg'])){ 
  $request_msg = $_GET['request_msg'];
}


// **********************Contact page************

if (isset($_POST['contact_page_submit'])) {
  $ids= $_POST['ids'];
  $address= $_POST['address'];
  $email= $_POST['email'];
  $mobile= $_POST['mobile'];
  $insert_qry = mysqli_query($conn, "UPDATE contact_page SET address='$address',email='$email',mobile='$mobile' WHERE id='$ids'");
  if ($insert_qry) {
      header("Location:contact-page?request_msg=Message send successfully...!! ");      
  }    
}
if(isset($_GET['request_msg'])){ 
  $request_msg = $_GET['request_msg'];
}





?>