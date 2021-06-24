<?php
mysqli_set_charset($conn, 'utf8');
// ***************Admin Login*****************
if (isset($_POST['login_submit'])) {
  $userid = $_POST['userId'];
  $password = $_POST['password'];
  $password_a = md5($password);
  
  $qerry = "SELECT * FROM admin WHERE userid = '$userid' && password = '$password_a'";
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

// *****Admin Change Password******

if(isset($_POST['continue_change'])){
  $crnt_pass = $_POST['crnt_pass'];
  $password = md5($crnt_pass);
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
  $new_pass = $_POST['new_pass'];
  $newpassword = md5($new_pass);
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


// ***************Users Login & Employer Login*****************

if (isset($_POST['user_login'])) {
  $userid = $_POST['userId'];
  $password = $_POST['password'];
  $password_a = md5($password);

  $userqry = mysqli_query($conn, "SELECT * FROM user WHERE email = '$userid' && password = '$password_a' && status=1");
  $userqrys = mysqli_query($conn, "SELECT * FROM user WHERE mobile = '$userid' && password = '$password_a' && status=1");
  if ($userqry) {
    $count = mysqli_num_rows($userqry);
    if ($count > 0) {
    $userqry_a = mysqli_fetch_array($userqry);
    $userqry_b = $userqry_a['type'];
    $userqry_name = $userqry_a['full_name'];
    $userid_a = $userqry_a['email'];
    
      $_SESSION['userid'] = $userid_a;
      $_SESSION['employer_user'] = $userqry_b;
      $_SESSION['qry_name'] = $userqry_name;
      header("Location:index");
    }
    else{
      // $login_message = "Invalid userid & password..!!";
      echo '<script>alert("Invalid userid & password..!!")</script>';
    }
  }
  if ($userqrys) {
    $count = mysqli_num_rows($userqrys);
    if ($count > 0) {
    $userqry_a = mysqli_fetch_array($userqrys);
    $userqry_b = $userqry_a['type'];
    $userqry_name = $userqry_a['full_name'];
    $userid_a = $userqry_a['email'];
    
      $_SESSION['userid'] = $userid_a;
      $_SESSION['employer_user'] = $userqry_b;
      $_SESSION['qry_name'] = $userqry_name;
      header("Location:index");
    }
    else{
      // $login_message = "Invalid userid & password..!!";
      echo '<script>alert("Invalid userid & password..!!")</script>';
    }
  }
}


if (isset($_POST['employer_login'])) {
  // session_destroy();
  $userid = $_POST['userId'];
  $password = $_POST['password'];
  $password_a = md5($password);
  
  $employer_qry = mysqli_query($conn, "SELECT * FROM employer WHERE mobile = '$userid' && password = '$password_a' && status=1");  
  $employer_qrys = mysqli_query($conn, "SELECT * FROM employer WHERE email = '$userid' && password = '$password_a' && status=1");
  if ($employer_qry) {
    $count = mysqli_num_rows($employer_qry);
    if ($count > 0) {
    $employer_qry_a = mysqli_fetch_array($employer_qry);
    $userid_a = $employer_qry_a['email'];
    $employer_qry_b = $employer_qry_a['type'];
    $emp_company_name = $employer_qry_a['company_name'];
    $employer_qry_name = $employer_qry_a['name'];

      $_SESSION['userid'] = $userid_a;
      $_SESSION['employer_user'] = $employer_qry_b;
      $_SESSION['company_name'] = $emp_company_name;
      $_SESSION['qry_name'] = $employer_qry_name;
      header("Location:index");
    }
    else{
      // $login_message = "Invalid userid & password..!!";
      echo '<script>alert("Invalid userid & password..!!")</script>';
    }
  }
  if ($employer_qrys) {
    $count = mysqli_num_rows($employer_qrys);
    if ($count > 0) {
    $employer_qry_a = mysqli_fetch_array($employer_qrys);
    $userid_a = $employer_qry_a['email'];
    $employer_qry_b = $employer_qry_a['type'];
    $employer_qry_name = $employer_qry_a['name'];

      $_SESSION['userid'] = $userid_a;
      $_SESSION['employer_user'] = $employer_qry_b;
      $_SESSION['qry_name'] = $employer_qry_name;
      header("Location:index");
    }
    else{
      // $login_message = "Invalid userid & password..!!";
      echo '<script>alert("Invalid userid & password..!!")</script>';
    }
  }
}

if (isset($_GET['login_message'])) {
  $login_message = $_GET['login_message'];
}


// *****User & Employer Change Password******


if(isset($_POST['change_pas'])){
  $current_password_a = $_POST['current_password'];
  $current_password = md5($current_password_a);
  $new_password_a = $_POST['new_password'];
  $new_password = md5($new_password_a);
  $userid = $_SESSION['userid'];
  if (isset($_SESSION['get_row_login_id'])) {
    if ($_SESSION['get_row_login_id'] == "Consultant" || $_SESSION['get_row_login_id'] == "Employer") {
      $passresult = mysqli_query($conn,"SELECT * FROM employer WHERE email='$userid'");
      if ($passresult) {
        $pass_row = mysqli_fetch_array($passresult);
        $gg = $pass_row['password'];
        $type = $pass_row['type'];
        if($current_password==$gg) {
          $pass_qry = "UPDATE employer SET password = '$new_password' WHERE email = '$userid' ";
          if (mysqli_query($conn, $pass_qry)) {
            header("location:change-password?update_success=Password Changed Successfully!");
          }
        }
        else{
          $update_faild = "Please Enter the Correct Old Password!";
        }      
      }
    }else{
      // echo "sdfsdfdsf0";
      // exit();
      $passresult_a = mysqli_query($conn,"SELECT * FROM user WHERE email='$userid'");
      if ($passresult_a) {
        $pass_row_a = mysqli_fetch_array($passresult_a);
        $gg= $pass_row_a['password'];
        if($current_password==$gg) {
          $pass_qry = "UPDATE user SET password = '$new_password' WHERE email = '$userid' ";
          if (mysqli_query($conn, $pass_qry)) {
            header("location:change-password?update_success=Password Changed Successfully!");
          }
        }
        else{
          $update_faild = "Please Enter the Correct Old Password!";
        }
      }
    }
  }
}
if (isset($_GET['update_success'])) {
  $update_success = $_GET['update_success'];
}



// **************** User & Employer Forget Password ****************

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
        $header = "From:info@mottojobs.in" . "\r\n" . "CC:";
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
  $new_password_a = $_POST['new_password'];
  $new_password = md5($new_password_a);
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

// **************************

if(isset($_POST['employer_get_password'])){
  $a= $_POST['email'];
  $email_qrys = mysqli_query($conn, "SELECT * FROM employer where email='$a'");
  if ($email_qrys) {
    $email_row = mysqli_fetch_array($email_qrys);
    $b= $email_row['email'];

    if($a==$b) {
      $otp = rand(10000,99999);
      $otp_result = mysqli_query($conn, "UPDATE employer SET otp='$otp' WHERE email='$a'");
      // echo $otp;
      // exit();
      if ($otp_result) {
        // $_SESSION['email_message'] = $a;
        $to = $a;
        $subject = "Forget Password";
        $message = "Your otp is : ".$otp;
        $header = "From:info@mottojobs.in" . "\r\n" . "CC:";
        mail($to,$subject,$message,$header);
        $_SESSION['OTP_EMAIL'] = $a;
        header("location: emp-cons-forgot-password-a");
      }
    }
    else{
      header("location: emp-cons-forgot-password-a?faild_msg=failed!Invalid Email id!");
    }
  }
}


if(isset($_POST['employer_set_otp'])){
  $OTP_EMAIL= $_SESSION['OTP_EMAIL'];
  $otp= $_POST['otp'];
  $email_qrys = mysqli_query($conn, "SELECT * FROM employer where email='$OTP_EMAIL' && otp='$otp'");
  $count_otp = mysqli_num_rows($email_qrys);
  if ($count_otp>0) {
    $_SESSION['OTP_EMAIL'] = $OTP_EMAIL;
    header("location: emp-cons-forgot-password-b");
  }
  else {
    header("location: emp-cons-forgot-password-a?faild_msg=failed!Invalid OTP!");
  }
}

if(isset($_POST['update_emp_pas'])){
  $new_password_a = $_POST['new_password'];
  $new_password = md5($new_password_a);
  $userid = $_SESSION['OTP_EMAIL'];
      $passresult = mysqli_query($conn,"SELECT * FROM employer WHERE email='$userid'");
      if ($passresult) {
        $pass_qry = "UPDATE employer SET password = '$new_password' WHERE email = '$userid' ";
        if (mysqli_query($conn, $pass_qry)) {
          // $_SESSION['email_message_complete'] = $userid;
          session_unset();
          header("location:emp-cons-forgot-password?update_success=Password Changed Successfully!");
        }      
      }
}



if (isset($_GET['update_success'])) {
  $update_success = $_GET['update_success'];
}
if (isset($_GET['success_msg'])) {
  $success_msg = $_GET['success_msg'];
}
if (isset($_GET['faild_msg'])) {
  $faild_msg = $_GET['faild_msg'];
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


// ********************Ticker*****************
if (isset($_POST['ticker_submit'])) {
  $ticker_name = $_POST['ticker_name'];
  $qerry = "INSERT INTO ticker(name) VALUES('$ticker_name')";
  if (mysqli_query($conn,$qerry)) {
    header("Location:ticker_slide");
  }else {
    echo "Error: " . $qerry . " " . mysqli_error($conn);
  }
  mysqli_close($conn);
}

if (isset($_POST['ticker_details_submit'])) {
  $ticker_id = $_POST['ticker_id'];
  $ticker_name = $_POST['ticker_name'];
  $qerry = mysqli_query($conn,"UPDATE ticker SET name='$ticker_name' WHERE id='$ticker_id'");
  header("Location:ticker_slide");
}


// ********************Categories*****************
if (isset($_POST['ctg_submit'])) {
  $ctg_name = $_POST['ctg_name'];
  $qerry = "INSERT INTO categories(name) VALUES('$ctg_name')";
  if (mysqli_query($conn,$qerry)) {
    header("Location:categories");
  }else {
    echo "Error: " . $qerry . " " . mysqli_error($conn);
  }
  mysqli_close($conn);
}

if (isset($_POST['categories_details_submit'])) {
  $categories_id = $_POST['categories_id'];
  $categories_name = $_POST['categories_name'];
  $qerry = mysqli_query($conn,"UPDATE categories SET name='$categories_name' WHERE id='$categories_id'");
  header("Location:categories");
}


// ********************User Details Submit(Admin Panel)*****************
if (isset($_POST['user_details_submit'])) {
  
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $password_a = $_POST['password'];
  $password = md5($password_a);
  $full_name = $_POST['full_name'];
  $address = $_POST['address'];
  $dob = $_POST['dob'];
  $Religion = $_POST['Religion'];
  $sex = $_POST['sex'];
  $verification = $_POST['verification'];

    $image_name = $_FILES['upload_photo']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['upload_photo']['type'];
    $image_size = $_FILES['upload_photo']['size'];
    $image_tmp_name = $_FILES['upload_photo']['tmp_name'];
    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);
    $dd = $image_name."_".date("mjYHis").".".$image_ext;

    $resume_name = $_FILES['upload_resume']['name'];
    $resume_tmp_name = $_FILES['upload_resume']['tmp_name'];
    $resume_ext = pathinfo($resume_name,PATHINFO_EXTENSION);
    $resume_flnm = pathinfo($resume_name,PATHINFO_FILENAME);
    $resume = $resume_flnm."_".date("mjYHis").".".$resume_ext;

      // if ($upload_photo == true || $upload_resume == true) {      
        if(!empty($dd)) {
          if ($image_size<=20000000) {
            if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
              $final_file = "../images/photos/".$dd;
              $upload_photo = move_uploaded_file($image_tmp_name, $final_file);
            }
          }
        }

        if(!empty($resume)){
          $path = "../images/file/".$resume;
          $upload_file = move_uploaded_file($resume_tmp_name, $path);
        }
        $qerry = "INSERT INTO user(email, mobile, password, full_name, address, dob, religion, sex, photo, file, verification) VALUES('$email', '$mobile', '$password', '$full_name', '$address', '$dob', '$Religion', '$sex', '$dd', '$resume', '$verification')";
        if (mysqli_query($conn,$qerry)) {
          header("Location:user_details");
        }else {
          echo "Error: " . $qerry . " " . mysqli_error($conn);
        }
          mysqli_close($conn);
      // }
}

if (isset($_POST['upload_user_image'])) {
  $user_id = $_POST['user_id'];
  $_SESSION['user_id'] = $user_id;
  header("Location:edit_user_img?user_id/=".$user_id);
}

if (isset($_POST['edit_user_img_submit'])) {
  
  $image_id = $_POST['image_id'];

  $image_name = $_FILES['user_img']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['user_img']['type'];
    $image_size = $_FILES['user_img']['size'];
    $image_tmp_name = $_FILES['user_img']['tmp_name'];

    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);

    $dd = $image_name."_".date("mjYHis").".".$image_ext;


      if(!empty($dd)) {
           if ($image_size<=20000000) {
               if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                   $final_file = "../images/photos/".$dd;
                   $upload = move_uploaded_file($image_tmp_name, $final_file);
                   if ($upload) {
                       $qerry = "UPDATE user SET photo='$dd' WHERE id='$image_id'";
                        if (mysqli_query($conn,$qerry)) {
                            header("Location:edit_user_details?id=".$image_id);
                        }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                   }
               }
           }
        }
}

if (isset($_POST['upload_user_file'])) {
  $file_id = $_POST['file_id'];
  $_SESSION['file_id'] = $file_id;
  header("Location:edit_user_file?file_id/=".$file_id);
}

if (isset($_POST['edit_user_file_submit'])) {
  
  $file_id = $_POST['file_id'];

    $resume_name = $_FILES['user_file']['name'];
    $resume_tmp_name = $_FILES['user_file']['tmp_name'];
    $resume_ext = pathinfo($resume_name,PATHINFO_EXTENSION);
    $resume_flnm = pathinfo($resume_name,PATHINFO_FILENAME);
    $resume = $resume_flnm."_".date("mjYHis").".".$resume_ext;

      if(!empty($resume)){
        $path = "../images/file/".$resume;
        $upload_file = move_uploaded_file($resume_tmp_name, $path);
        if ($upload_file) {
          $qerry = "UPDATE user SET file='$resume' WHERE id='$file_id'";
          if (mysqli_query($conn,$qerry)) {
            header("Location:edit_user_details?id=".$file_id);
          }else {
            echo "Error: " . $qerry . " " . mysqli_error($conn);
          }
            mysqli_close($conn);
        }
      }
}



if (isset($_POST['update_user_details'])) {
  $user_id = $_POST['user_id'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $password = $_POST['password'];
  $full_name = $_POST['full_name'];
  $address = $_POST['address'];
  $dob = $_POST['dob'];
  $Religion = $_POST['Religion'];
  $sex = $_POST['sex'];
  $verification = $_POST['verification'];

  $qerry = mysqli_query($conn,"UPDATE user SET email='$email', mobile='$mobile', password='$password', full_name='$full_name', address='$address', dob='$dob', religion='$Religion', sex='$sex', verification='$verification' WHERE id='$user_id'");
  header("Location:user_details");
}



// ********************User Details Submit(Website)*****************
if (isset($_POST['user_details_submit_website'])) {

  $email= $_POST['email'];
  $mobile = $_POST['mobile'];
  $emailresult = mysqli_query($conn,"SELECT * FROM user WHERE email='$email' || mobile='$mobile'");
  $email_row = mysqli_num_rows($emailresult);
  if ($email_row>0) {
    $email_msg = "User already exist..!!!";
    if(isset($_GET['email_msg'])){ 
      $email_msg = $_GET['email_msg'];
    }
  }
  else{
    $password = $_POST['password'];
    $password_a = md5($password);
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $dob = $day.'-'.$month.'-'.$year;
    $Religion = $_POST['Religion'];
    $sex = $_POST['sex'];
    $type = "user";

      $image_name = $_FILES['upload_photo']['name'];
      $image_name = preg_replace("/\s+/","_",$image_name);
      $image_type = $_FILES['upload_photo']['type'];
      $image_size = $_FILES['upload_photo']['size'];
      $image_tmp_name = $_FILES['upload_photo']['tmp_name'];
      $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
      $image_name = pathinfo($image_name,PATHINFO_FILENAME);
      $dd = $image_name."_".date("mjYHis").".".$image_ext;

      $resume_name = $_FILES['upload_resume']['name'];
      $resume_tmp_name = $_FILES['upload_resume']['tmp_name'];
      $resume_ext = pathinfo($resume_name,PATHINFO_EXTENSION);
      $resume_flnm = pathinfo($resume_name,PATHINFO_FILENAME);
      $resume = $resume_flnm."_".date("mjYHis").".".$resume_ext;

        // if ($upload_photo == true || $upload_resume == true) {      
          if(!empty($dd)) {
            if ($image_size<=20000000) {
              if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                $final_file = "images/photos/".$dd;
                $upload_photo = move_uploaded_file($image_tmp_name, $final_file);
              }
            }
          }

          if(!empty($resume)){
            $path = "images/file/".$resume;
            $upload_file = move_uploaded_file($resume_tmp_name, $path);
          }
          $qerry = "INSERT INTO user(email, mobile, password, full_name, address, dob, religion, sex, photo, file) VALUES('$email', '$mobile', '$password_a', '$full_name', '$address', '$dob', '$Religion', '$sex', '$dd', '$resume')";
          if (mysqli_query($conn,$qerry)) {
            // $last_id = mysqli_insert_id($conn)
    $select_reg_qry = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    $select_reg_qry_a = mysqli_fetch_array($select_reg_qry);
      $_SESSION['userid'] = $select_reg_qry_a['email'];
      $_SESSION['employer_user'] = $select_reg_qry_a['type'];
      $_SESSION['qry_name'] = $select_reg_qry_a['full_name'];

            // $_SESSION['userid'] = $email;
            // $_SESSION['employer_user'] = $type;
            // $_SESSION['qry_name'] = $full_name;
            header("Location:index");
            // header("Location:jobseeker_register?add_user=Your details are submited successfully...!!");
          }else {
            echo "Error: " . $qerry . " " . mysqli_error($conn);
          }
            mysqli_close($conn);
        // }
  }
}

if(isset($_GET['add_user'])){ 
  $add_user = $_GET['add_user'];
}


// *************Update User*********




if (isset($_POST['user_photo_submit'])) {
  
  $userid = $_SESSION['userid'];

  $image_name = $_FILES['userphoto']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['userphoto']['type'];
    $image_size = $_FILES['userphoto']['size'];
    $image_tmp_name = $_FILES['userphoto']['tmp_name'];

    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);

    $dd = $image_name."_".date("mjYHis").".".$image_ext;


      if(!empty($dd)) {
           if ($image_size<=6000000) {
               if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                   $final_file = "images/photos/".$dd;
                   $upload = move_uploaded_file($image_tmp_name, $final_file);
                   if ($upload) {
                       $qerry = "UPDATE user SET photo='$dd' WHERE email='$userid'";
                        if (mysqli_query($conn,$qerry)) {
                            header("Location:user-edit-profile");
                        }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                   }
               }
           }
        }
}


if (isset($_POST['user_file_submit'])) {
  
  $userid = $_SESSION['userid'];

    $resume_name = $_FILES['user_resume']['name'];
    $resume_tmp_name = $_FILES['user_resume']['tmp_name'];
    $resume_ext = pathinfo($resume_name,PATHINFO_EXTENSION);
    $resume_flnm = pathinfo($resume_name,PATHINFO_FILENAME);
    $resume = $resume_flnm."_".date("mjYHis").".".$resume_ext;

      if(!empty($resume)){
        $path = "images/file/".$resume;
        $upload_file = move_uploaded_file($resume_tmp_name, $path);
        if ($upload_file) {
          $qerry = "UPDATE user SET file='$resume' WHERE email='$userid'";
          if (mysqli_query($conn,$qerry)) {
            header("Location:user-edit-profile");
          }else {
            echo "Error: " . $qerry . " " . mysqli_error($conn);
          }
            mysqli_close($conn);
        }
      }
}

if (isset($_POST['user_details_edit_submit'])) {
  $userid = $_SESSION['userid'];
  $get_row_login_id = $_SESSION['get_row_login_id'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $password = $_POST['password'];
  $full_name = $_POST['full_name'];
  $address = $_POST['address'];
  // $dob = $_POST['dob'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $dob = $day.'-'.$month.'-'.$year;
  $Religion = $_POST['Religion'];
  $sex = $_POST['sex'];
  
  // $emailresult = mysqli_query($conn,"SELECT * FROM user");
  // $email_row = mysqli_fetch_array($emailresult);
  // $email_a= $email_row['email'];

  // if ($email == $email_a) {
    // $emailresult_a = mysqli_query($conn,"SELECT * FROM user WHERE email='$userid'");
    // $email_row_a = mysqli_fetch_array($emailresult_a);
    // $user_id= $email_row_a['id'];
      // echo $user_id;
      // exit();
    // email='$email', mobile='$mobile', id='$get_row_login_id'
    // if ($get_row_login_id == $user_id) {
      $qerry = mysqli_query($conn,"UPDATE user SET email='$email', mobile='$mobile', full_name='$full_name', address='$address', dob='$dob', religion='$Religion', sex='$sex' WHERE email='$userid'");
      if ($qerry) {
        $_SESSION['userid'] = $email;
        header("Location:user-edit-profile?edit_user=Your details are submited successfully...!!");
      }else {
        echo "Error: " . $qerry . " " . mysqli_error($conn);
      }
        mysqli_close($conn);
    // }
    // else {
    //   $email_msg = "Already exist this EmailID!";     
    // }
  // }
  // else{
  //   $qerry = mysqli_query($conn,"UPDATE user SET email='$email', mobile='$mobile', full_name='$full_name', address='$address', dob='$dob', religion='$Religion', sex='$sex' WHERE id='$get_row_login_id'");
  //   if ($qerry) {
  //     $_SESSION['userid'] = $email;
  //     header("Location:user-edit-profile?edit_user=Your details are submited successfully...!!");
  //   }else {
  //     echo "Error: " . $qerry . " " . mysqli_error($conn);
  //   }
  //     mysqli_close($conn);
  // }
}
if(isset($_GET['edit_user'])){ 
  $edit_user = $_GET['edit_user'];
}


// **************************Employers***********************

if (isset($_POST['register_employer'])) {
  $email= $_POST['email'];
  $mobile = $_POST['mobile'];
  $emailresult = mysqli_query($conn,"SELECT * FROM employer WHERE email='$email' || mobile='$mobile'");
  $email_row = mysqli_num_rows($emailresult); 
  if ($email_row > 0) {
    $email_msg = "User already exist..!!!";
    if(isset($_GET['email_msg'])){ 
      $email_msg = $_GET['email_msg'];
    }
  }
  else{
    $password = $_POST['password'];
    $password_a = md5($password);
    $company_name = $_POST['company_name'];
    $address = $_POST['address'];
    $land_line = $_POST['land_line'];
    $website = $_POST['website'];
    $type = $_POST['type'];
    $full_name = $_POST['full_name'];
    $per_mobile = $_POST['per_mobile'];
    $per_email = $_POST['per_email'];
    $designation = $_POST['designation'];
      $image_name = $_FILES['company_loho']['name'];
      $image_name = preg_replace("/\s+/","_",$image_name);
      $image_type = $_FILES['company_loho']['type'];
      $image_size = $_FILES['company_loho']['size'];
      $image_tmp_name = $_FILES['company_loho']['tmp_name'];
      $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
      $image_name = pathinfo($image_name,PATHINFO_FILENAME);
      $dd = $image_name."_".date("mjYHis").".".$image_ext;
        if(!empty($dd)) {
             if ($image_size<=20000000) {
                 if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                     $final_file = "images/logos/".$dd;
                     $upload = move_uploaded_file($image_tmp_name, $final_file);
                     if ($upload) {
                        $qerry = mysqli_query($conn, "INSERT INTO employer(name, per_mobile, per_email, designation, email, mobile, password, company_name, address, land_line, website, logo, type) VALUES ('$full_name', '$per_mobile', '$per_email', '$designation', '$email', '$mobile', '$password_a', '$company_name', '$address', '$land_line', '$website', '$dd', '$type')");
                          if ($qerry) {
    $select_reg_qry = mysqli_query($conn, "SELECT * FROM employer WHERE email='$email'");
    $select_reg_qry_a = mysqli_fetch_array($select_reg_qry);
      $_SESSION['userid'] = $select_reg_qry_a['email'];
      $_SESSION['employer_user'] = $select_reg_qry_a['type'];
      $_SESSION['qry_name'] = $select_reg_qry_a['name'];

                            header("Location:index");
                            // header("Location:employer_register?add_employer=Your details are sebmited successfully...!!");
                          }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                          }
                          mysqli_close($conn);
                     }
                 }
             }
          }
    }
}
if(isset($_GET['add_employer'])){ 
  $add_employer = $_GET['add_employer'];
}






// **************************Edit Employers***********************

if (isset($_POST['edit_employer_details'])) {
  $employer_login_id = $_SESSION['employer_login_id'];
    $email= $_POST['email'];
    $mobile = $_POST['mobile'];
    $company_name = $_POST['company_name'];
    $address = $_POST['address'];
    $land_line = $_POST['land_line'];
    $website = $_POST['website'];
    $type = $_POST['type'];
    $full_name = $_POST['full_name'];
    $per_mobile = $_POST['per_mobile'];
    $per_email = $_POST['per_email'];
    $designation = $_POST['designation'];

  $emailresult = mysqli_query($conn,"SELECT * FROM employer");
  $email_row = mysqli_fetch_array($emailresult);
  $email_a= $email_row['email'];
  if ($email == $email_a) {
    $emailresult_a = mysqli_query($conn,"SELECT * FROM employer WHERE email='$email_a'");
    $email_row_a = mysqli_fetch_array($emailresult_a);
    $emp_id= $email_row_a['id'];
      // echo $emp_id;
      // exit();
    if ($employer_login_id == $emp_id) {
      $qerry = mysqli_query($conn, "UPDATE employer SET name='$full_name', per_mobile='$per_mobile', per_email='$per_email', designation='$designation', email='$email', mobile='$mobile', company_name='$company_name', address='$address', land_line='$land_line', website='$website', type='$type' WHERE id='$employer_login_id'");
      if ($qerry) {
        $_SESSION['userid'] = $email;
        header("Location:employer-edit-profile?edit_employer=Your details are submited successfully...!!");
      }else {
        echo "Error: " . $qerry . " " . mysqli_error($conn);
      }
        mysqli_close($conn);
    }
    else {
      // echo "0000";
      // exit();
      $email_msg = "Already exist this EmailID!";     
    }
  }
  else{
    // echo "0000";
    // exit();
    $qerry = mysqli_query($conn, "UPDATE employer SET name='$full_name', per_mobile='$per_mobile', per_email='$per_email', designation='$designation', email='$email', mobile='$mobile', company_name='$company_name', address='$address', land_line='$land_line', website='$website', type='$type' WHERE id='$employer_login_id'");
    if ($qerry) {
      $_SESSION['userid'] = $email;
      header("Location:employer-edit-profile?edit_employer=Your details are submited successfully...!!");
    }else {
      echo "Error: " . $qerry . " " . mysqli_error($conn);
    }
      mysqli_close($conn);
  }
}

if(isset($_GET['edit_employer'])){ 
  $edit_employer = $_GET['edit_employer'];
}

if (isset($_POST['employer_logo_submit'])) {
  
  $userid = $_SESSION['userid'];

  $image_name = $_FILES['company_logo']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['company_logo']['type'];
    $image_size = $_FILES['company_logo']['size'];
    $image_tmp_name = $_FILES['company_logo']['tmp_name'];

    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);

    $dd = $image_name."_".date("mjYHis").".".$image_ext;


      if(!empty($dd)) {
           if ($image_size<=20000000) {
               if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                   $final_file = "images/logos/".$dd;
                   $upload = move_uploaded_file($image_tmp_name, $final_file);
                   if ($upload) {
                       $qerry = "UPDATE employer SET logo='$dd' WHERE email='$userid'";
                        if (mysqli_query($conn,$qerry)) {
                            header("Location:employer-edit-profile");
                        }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                   }
               }
           }
        }
}


// **************Admin Part--Edit Emp Details***********
if (isset($_POST['update_emp_details'])) {
    $emp_id= $_POST['emp_id'];
    $company_name = $_POST['company_name'];
    $address = $_POST['address'];
    $land_line = $_POST['land_line'];
    $website = $_POST['website'];
    $type = $_POST['type'];
    $full_name = $_POST['name'];
    $per_mobile = $_POST['per_mobile'];
    $per_email = $_POST['per_email'];
    $designation = $_POST['designation'];


    $qerry = mysqli_query($conn, "UPDATE employer SET name='$full_name', per_mobile='$per_mobile', per_email='$per_email', designation='$designation', company_name='$company_name', address='$address', land_line='$land_line', website='$website', type='$type' WHERE id='$emp_id'");
      if ($qerry) {
        header("Location:verified_employer_details?update_employer=Your details are submited successfully...!!");
      }else {
        echo "Error: " . $qerry . " " . mysqli_error($conn);
      }
        mysqli_close($conn);
}

if (isset($_POST['update_employer_logo_a'])) {
  
  $img_id = $_POST['img_id'];

  $image_name = $_FILES['img_file']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['img_file']['type'];
    $image_size = $_FILES['img_file']['size'];
    $image_tmp_name = $_FILES['img_file']['tmp_name'];

    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);

    $dd = $image_name."_".date("mjYHis").".".$image_ext;


      if(!empty($dd)) {
           if ($image_size<=20000000) {
               if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                   $final_file = "../images/logos/".$dd;
                   $upload = move_uploaded_file($image_tmp_name, $final_file);
                   if ($upload) {
                       $qerry = mysqli_query($conn, "UPDATE employer SET logo='$dd' WHERE id='$img_id'");
                        if ($qerry) {
                            header("Location:edit_emp_details?id=".$img_id);
                        }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                   }
               }
           }
        }
}



if(isset($_GET['update_employer'])){ 
  $update_employer = $_GET['update_employer'];
}



// ***********************Contact Page*************
if (isset($_POST['contact_page_submit'])) {
  $contact_id= $_POST['contact_id'];
  $address= $_POST['address'];
  $email= $_POST['email'];
  $mobile= $_POST['mobile'];
  $web= $_POST['web'];
  $qerry = "UPDATE contact_page SET address='$address', email='$email', mobile='$mobile', web='$web' WHERE id='$contact_id'";
  if (mysqli_query($conn,$qerry)) {
    header("Location:contact?contactmessage=Submited Successfully...!!");
  }else {
    echo "Error: " . $qerry . " " . mysqli_error($conn);
  }
    mysqli_close($conn);
}
if (isset($_GET['contactmessage'])) {
  $contactmessage = $_GET['contactmessage'];
}



// ***********************About Page*************
if (isset($_POST['about_submit'])) {
  $about_id= $_POST['about_id'];
  $title= $_POST['title'];
  $description= $_POST['description'];
  // echo $description;
  // exit();
  $qerry = "UPDATE about SET title='$title', description='$description' WHERE id='$about_id'";
  if (mysqli_query($conn,$qerry)) {
    header("Location:about?aboutmessage=Submited Successfully...!!");
  }else {
    echo "Error: " . $qerry . " " . mysqli_error($conn);
  }
    mysqli_close($conn);
}
if (isset($_GET['aboutmessage'])) {
  $aboutmessage = $_GET['aboutmessage'];
}

if (isset($_POST['update_about_img'])) {
  $about_id= $_POST['about_id'];

    $image_name = $_FILES['abt_img']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['abt_img']['type'];
    $image_size = $_FILES['abt_img']['size'];
    $image_tmp_name = $_FILES['abt_img']['tmp_name'];

    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);

    $dd = $image_name."_".date("mjYHis").".".$image_ext;


      if(!empty($dd)) {
           if ($image_size<=20000000) {
               if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                   $final_file = "../images/about/".$dd;
                   $upload = move_uploaded_file($image_tmp_name, $final_file);
                   if ($upload) {
                       $qerry = "UPDATE about SET img='$dd' WHERE id='$about_id'";
                        if (mysqli_query($conn,$qerry)) {
                            header("Location:about");
                        }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                   }
               }
           }
        }

}

// **************************Send Message***********************
if (isset($_POST['send_message_submit'])) {
  $name= $_POST['name'];
  $email= $_POST['email'];
  $mobile= $_POST['mobile'];
  $message= $_POST['message'];
  $insert_qry = mysqli_query($conn, "INSERT INTO `contact`(`name`, `email`, `mobile`, `message`) VALUES ('$name', '$email', '$mobile', '$message')");
  if ($insert_qry) {
      $to = "info@mottojobs.in";
      $subject = "Contact Message";
      $message =  $message. "\r\n" .$name. "\r\n" .$mobile;
      $header = "From: ".$email. "\r\n" . "CC: ";
      $retval = mail($to,$subject,$message,$header);
      header("Location:contact-us?msg=Message send successfully...!! ");      
  }    
}
if(isset($_GET['msg'])){ 
  $msg = $_GET['msg'];
}

// **************************Send Message***********************
if (isset($_POST['job_post_submit'])) {
  $emplr_id= $_POST['emplr_id'];
  $title= $_POST['title'];
  $salary= $_POST['salary'];
  $categories= $_POST['categories'];
  $job_type= $_POST['job_type'];
  $description= $_POST['description'];
  $location= $_POST['location'];

    $image_name = $_FILES['post_image']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['post_image']['type'];
    $image_size = $_FILES['post_image']['size'];
    $image_tmp_name = $_FILES['post_image']['tmp_name'];

    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);

    $dd = $image_name."_".date("mjYHis").".".$image_ext;


      if(!empty($dd)) {
           if ($image_size<=20000000) {
               if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                   $final_file = "images/banners/".$dd;
                   $upload = move_uploaded_file($image_tmp_name, $final_file);
                   if ($upload) {
                        $insert_qry = mysqli_query($conn, "INSERT INTO `post_job`(`emplr_id`, `title`, `salary`, `categories`, `job_type`, `description`, `location`, `img`) VALUES ('$emplr_id', '$title', '$salary', '$categories', '$job_type', '$description', '$location', '$dd')");
                        if ($insert_qry) {
                            header("Location:post-job?post_msg=Post successfully...!! ");
                        }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                   }
                   else {
                     $faild_image = "Invalid Image...!!";
                   }
               }
           }
        }
      
}

if(isset($_GET['faild_image'])){ 
  $faild_image = $_GET['faild_image'];
}

if (isset($_POST['job_post_update'])) {
  $update_post_id= $_POST['update_post_id'];
  $title= $_POST['title'];
  $salary= $_POST['salary'];
  $categories= $_POST['categories'];
  $job_type= $_POST['job_type'];
  $description= $_POST['description'];
  $location= $_POST['location'];
  $insert_qry = mysqli_query($conn, "UPDATE `post_job` SET `title`='$title',`salary`='$salary',`categories`='$categories',`job_type`='$job_type',`description`='$description',`location`='$location',`status`=0 WHERE id='$update_post_id'");
  // $insert_qry = mysqli_query($conn, "INSERT INTO `post_job`(`emplr_id`, `title`, `salary`, `categories`, `job_type`, `description`, `location`) VALUES ('$emplr_id', '$title', '$salary', '$categories', '$job_type', '$description', '$location')");
  if ($insert_qry) {
      header("Location:my-jobs?post_msg=Post updated successfully...!! ");
  }    
}

if (isset($_POST['update_job_post_img'])) {
  $post_img_id= $_POST['post_img_id'];

  $image_name = $_FILES['post_image']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['post_image']['type'];
    $image_size = $_FILES['post_image']['size'];
    $image_tmp_name = $_FILES['post_image']['tmp_name'];

    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);

    $dd = $image_name."_".date("mjYHis").".".$image_ext;


      if(!empty($dd)) {
           if ($image_size<=20000000) {
               if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                   $final_file = "images/banners/".$dd;
                   $upload = move_uploaded_file($image_tmp_name, $final_file);
                   if ($upload) {
                        $insert_qry = mysqli_query($conn, "UPDATE `post_job` SET `img`='$dd' WHERE id='$post_img_id'");
                        if ($insert_qry) {
                            header("Location:edit-post?job_id=".$post_img_id);
                        }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                   }
                   else {
                     $faild_image = "Invalid Image...!!";
                   }
               }
           }
        }  
}


if(isset($_GET['post_msg'])){ 
  $post_msg = $_GET['post_msg'];
}


// ***********************Client Details***********************
if (isset($_POST['client_submit'])) {
  $client_name= $_POST['client_name'];
  $website_a= $_POST['website'];
  if($website_a == ""){
    $website = '';
  }
  if($website_a != ""){
    $website = 'https://www.'.$website_a;
  }
    $image_name = $_FILES['client_img']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['client_img']['type'];
    $image_size = $_FILES['client_img']['size'];
    $image_tmp_name = $_FILES['client_img']['tmp_name'];

    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);

    $dd = $image_name."_".date("mjYHis").".".$image_ext;

      if(!empty($dd)) {
           if ($image_size<=20000000) {
               if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                   $final_file = "../images/clients/".$dd;
                   $upload = move_uploaded_file($image_tmp_name, $final_file);
                   if ($upload) {
                        $qerry = "INSERT INTO our_client(name, website, img) VALUES('$client_name', '$website', '$dd')";                       
                        if (mysqli_query($conn,$qerry)) {
                            header("Location:our_client");
                        }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                   }
               }
           }
        }

}

if (isset($_POST['upload_client_image'])) {
  $client_id = $_POST['client_id'];
  $_SESSION['client_id'] = $client_id;
  header("Location:edit_client_img?client_id/=".$client_id);
}

if (isset($_POST['edit_client_img_submit'])) {
  
  $image_id = $_POST['image_id'];

  $image_name = $_FILES['client_img']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['client_img']['type'];
    $image_size = $_FILES['client_img']['size'];
    $image_tmp_name = $_FILES['client_img']['tmp_name'];

    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);

    $dd = $image_name."_".date("mjYHis").".".$image_ext;


      if(!empty($dd)) {
           if ($image_size<=20000000) {
               if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                   $final_file = "../images/clients/".$dd;
                   $upload = move_uploaded_file($image_tmp_name, $final_file);
                   if ($upload) {
                       $qerry = "UPDATE our_client SET img='$dd' WHERE id='$image_id'";
                        if (mysqli_query($conn,$qerry)) {
                            header("Location:edit_client?id=".$image_id);
                        }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                   }
               }
           }
        }
}

if (isset($_POST['edit_client_details_submit'])) {
  $client_id = $_POST['client_id'];
  $client_name = $_POST['client_name'];
  $qerry = mysqli_query($conn,"UPDATE our_client SET name='$client_name' WHERE id='$client_id'");
  header("Location:our_client");
}

// **********************Job Apply*************

if (isset($_POST['job_apply_submit'])) {
  if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    $user_id = $_POST['user_id'];
    $job_apply_id = $_POST['job_apply_id'];
    $qerry = mysqli_query($conn,"INSERT INTO apply_job(user_last_id,job_last_id) VALUES('$user_id', '$job_apply_id')");
    $_SESSION['userid'] = $userid;
    header("Location:index");
  }
  else{
    header("Location:jobseekerlogin");
  }
}

// ********************** Admin Job Post **********************
if (isset($_POST['admin_job_post_submit'])) {
  $title= $_POST['title'];
  $salary= $_POST['salary'];
  $categories= $_POST['categories'];
  $job_type= $_POST['job_type'];
  $description= $_POST['description'];
  $location= $_POST['location'];

  $image_name = $_FILES['post_image']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['post_image']['type'];
    $image_size = $_FILES['post_image']['size'];
    $image_tmp_name = $_FILES['post_image']['tmp_name'];

    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);

    $dd = $image_name."_".date("mjYHis").".".$image_ext;


      if(!empty($dd)) {
           if ($image_size<=20000000) {
               if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                   $final_file = "../images/banners/".$dd;
                   $upload = move_uploaded_file($image_tmp_name, $final_file);
                   if ($upload) {
                       $insert_qry = mysqli_query($conn, "INSERT INTO `admin_job_post`(`job_title`, `job_salary`, `job_categories`, `job_type`, `job_description`, `job_location`, `job_img`) VALUES ('$title', '$salary', '$categories', '$job_type', '$description', '$location', '$dd')");
                        if ($insert_qry) {
                            header("Location:job_post?post_msg=Posted successfully...!! ");
                        }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                   }
               }
           }
        }
  
}
if (isset($_POST['admin_job_post_edit'])) {
  $admin_edit_post_id= $_POST['admin_edit_post_id'];
  // echo $admin_edit_post_id;
  // exit();
  $title= $_POST['title'];
  $salary= $_POST['salary'];
  $categories= $_POST['categories'];
  $job_type= $_POST['job_type'];
  $description= $_POST['description'];
  $location= $_POST['location'];
  $insert_qry = mysqli_query($conn, "UPDATE `admin_job_post` SET `job_title`='$title',`job_salary`='$salary',`job_categories`='$categories',`job_type`='$job_type',`job_description`='$description',`job_location`='$location' WHERE id='$admin_edit_post_id'");
  if ($insert_qry) {
    // echo '<script>alert("Post updated successfully...!!")</script>';
    header("Location:job_post?post_msg=Post updated successfully...!!");
  }
}


if (isset($_POST['admin_job_post_img_submit'])) {
  
  $post_img_id = $_POST['post_img_id'];

  $image_name = $_FILES['post_image']['name'];
    $image_name = preg_replace("/\s+/","_",$image_name);
    $image_type = $_FILES['post_image']['type'];
    $image_size = $_FILES['post_image']['size'];
    $image_tmp_name = $_FILES['post_image']['tmp_name'];

    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_name = pathinfo($image_name,PATHINFO_FILENAME);

    $dd = $image_name."_".date("mjYHis").".".$image_ext;


      if(!empty($dd)) {
           if ($image_size<=20000000) {
               if ($image_type=="image/jpeg" or $image_type=="image/jpg" or $image_type=="image/png" or $image_type=="image/gif") {
                   $final_file = "../images/banners/".$dd;
                   $upload = move_uploaded_file($image_tmp_name, $final_file);
                   if ($upload) {
                      $insert_qry = mysqli_query($conn, "UPDATE `admin_job_post` SET `job_img`='$dd' WHERE id='$post_img_id'");
                        if ($insert_qry) {
                            header("Location:edit_admin_post?id=".$post_img_id);
                        }else {
                            echo "Error: " . $qerry . " " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                   }
               }
           }
        }
}


// ********************User Verified********************
if (isset($_POST['user_verifing_yes'])) {
  $verifing_yes= $_POST['user_verifing_yes'];
  // echo $verifing_yes;
  $yes= $_POST['yes'];
  // echo $yes;
  // exit();
  $insert_qry = mysqli_query($conn, "UPDATE `user` SET verification='$yes' WHERE id='$verifing_yes'");
  if ($insert_qry) {
    header("Location:verified_user_details");
  }
}
if (isset($_POST['user_verifing_no'])) {
  $verifing_no= $_POST['user_verifing_no'];
  // echo $verifing_no;
  $no= $_POST['no'];
  // echo $no;
  // exit();
  $insert_qry = mysqli_query($conn, "UPDATE `user` SET verification='$no' WHERE id='$verifing_no'");
  if ($insert_qry) {
    header("Location:user_details");
  }
}





// ********************Employer Verified********************
if (isset($_POST['emp_verifing_yes'])) {
  $verifing_yes= $_POST['emp_verifing_yes'];
  // echo $verifing_yes;
  $yes= $_POST['yes'];
  // echo $yes;
  // exit();
  $insert_qry = mysqli_query($conn, "UPDATE `employer` SET verification='$yes' WHERE id='$verifing_yes'");
  if ($insert_qry) {
    header("Location:verified_employer_details");
  }
}
if (isset($_POST['emp_verifing_no'])) {
  $verifing_no= $_POST['emp_verifing_no'];
  // echo $verifing_no;
  $no= $_POST['no'];
  // echo $no;
  // exit();
  $insert_qry = mysqli_query($conn, "UPDATE `employer` SET verification='$no' WHERE id='$verifing_no'");
  if ($insert_qry) {
    header("Location:employer_details");
  }
}


// ********************User Paid********************
if (isset($_POST['user_paid_yes'])) {
  $paid_yes= $_POST['user_paid_yes'];
  // echo $paid_yes;
  $yes= $_POST['yes'];
  // echo $yes;
  // exit();
  $insert_qry = mysqli_query($conn, "UPDATE `user` SET paid='$yes' WHERE id='$paid_yes'");
  if ($insert_qry) {
    header("Location:user_details");
  }
}
if (isset($_POST['user_paid_no'])) {
  $paid_no= $_POST['user_paid_no'];
  // echo $paid_no;
  $no= $_POST['no'];
  // echo $no;
  // exit();
  $insert_qry = mysqli_query($conn, "UPDATE `user` SET paid='$no' WHERE id='$paid_no'");
  if ($insert_qry) {
    header("Location:user_details");
  }
}

if (isset($_POST['user_paid_yes_a'])) {
  $paid_yes= $_POST['user_paid_yes_a'];
  // echo $paid_yes;
  $yes= $_POST['yes'];
  // echo $yes;
  // exit();
  $insert_qry = mysqli_query($conn, "UPDATE `user` SET paid='$yes' WHERE id='$paid_yes'");
  if ($insert_qry) {
    header("Location:verified_user_details");
  }
}
if (isset($_POST['user_paid_no_a'])) {
  $paid_no= $_POST['user_paid_no_a'];
  // echo $paid_no;
  $no= $_POST['no'];
  // echo $no;
  // exit();
  $insert_qry = mysqli_query($conn, "UPDATE `user` SET paid='$no' WHERE id='$paid_no'");
  if ($insert_qry) {
    header("Location:verified_user_details");
  }
}



// ********************Employer Paid********************
if (isset($_POST['emp_paid_yes'])) {
  $paid_yes= $_POST['emp_paid_yes'];
  // echo $paid_yes;
  $yes= $_POST['yes'];
  // echo $yes;
  // exit();
  $insert_qry = mysqli_query($conn, "UPDATE `employer` SET paid='$yes' WHERE id='$paid_yes'");
  if ($insert_qry) {
    header("Location:employer_details");
  }
}
if (isset($_POST['emp_paid_no'])) {
  $paid_no= $_POST['emp_paid_no'];
  // echo $paid_no;
  $no= $_POST['no'];
  // echo $no;
  // exit();
  $insert_qry = mysqli_query($conn, "UPDATE `employer` SET paid='$no' WHERE id='$paid_no'");
  if ($insert_qry) {
    header("Location:employer_details");
  }
}

if (isset($_POST['emp_paid_yes_a'])) {
  $paid_yes= $_POST['emp_paid_yes_a'];
  // echo $paid_yes;
  $yes= $_POST['yes'];
  // echo $yes;
  // exit();
  $insert_qry = mysqli_query($conn, "UPDATE `employer` SET paid='$yes' WHERE id='$paid_yes'");
  if ($insert_qry) {
    header("Location:verified_employer_details");
  }
}
if (isset($_POST['emp_paid_no_a'])) {
  $paid_no= $_POST['emp_paid_no_a'];
  // echo $paid_no;
  $no= $_POST['no'];
  // echo $no;
  // exit();
  $insert_qry = mysqli_query($conn, "UPDATE `employer` SET paid='$no' WHERE id='$paid_no'");
  if ($insert_qry) {
    header("Location:verified_employer_details");
  }
}
?>