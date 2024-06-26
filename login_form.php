<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM tbl_user WHERE email_user = '$email' && password_user = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['nama_user'];
         header('location:dashboard_admin.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['nama_user'];
         header('location:dashboard_user.php');

      }elseif($row['user_type'] == 'koor'){

         $_SESSION['user_name'] = $row['nama_user'];
         header('location:dashboard_koor.php');
     
   }else{
      $error[] = 'incorrect email or password!';
   }
}
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="assets/styles/page-style.css" />

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h4>Nutri<span>Share</span></h4>
      <h3>Login</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>Don't have an account? <a href="register_form.php">Register now</a></p>
   </form>

</div>

</body>
</html>