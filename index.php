<!DOCTYPE html>
<html lang="en">
<head>
  <title>Main</title>
  <meta name="description" content="Myapp, the simplest version of a social networking app.">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="frontend/css/common.css">
  <link rel="stylesheet" href="frontend/css/style.css">
</head>
<body>
  <div class="nav flex">
    <h1 style="color: rgb(37, 36, 36);">MyApp</h1>
  </div>
  <div class="wrapper">

    <!-- LOGIN FORM -->

    <form action="#" class="login_form" autocomplete="off">
      <p class="form_title">Login</p>
      <p class="error_msg msg"></p>
      <input type="text" name="username" placeholder="Username.." class="input_field"/>
      <div class="password_eye_wrapper">
        <input type="password" name="password" placeholder="Password.." class="input_field pword"/>
        <i class="fa-solid eye fa-eye-slash"></i>
      </div>
      <input type="submit" class="login_btn btn" value="Login">
      <span class="forgot_password">Forgot password?</span>
      <span class="signup">Create account</span>
    </form>

    <!-- SIGN UP FORM -->

    <form action="#" class="signup_form" enctype="multipart-form-data" autocomplete="off">
      <p class="form_title">Create Account</p>
      <p class="error_msg msg"></p>
      <p class="success_msg msg"></p>
      <div class="profile_pic">
        <p>Upload profile picture</p>
        <input type="file" name="profile_pic"/>
      </div>
      <div class="flex input_group">
        <input type="text" name="fname" placeholder="First name..." class="input_field"/>
        <input type="text" name="lname" placeholder="Last name..." class="input_field"/>
      </div>
      <div class="flex input_group">
        <input type="text" name="address" placeholder="Address..." class="input_field"/>
        <input type="number" name="contact" placeholder="Contact..." class="input_field"/>
      </div>
      <div class="flex input_group">
        <input type="email" name="email" placeholder="Email..." class="input_field"/>
        <input type="text" name="uname" placeholder="Username..." class="input_field"/>
      </div>
      <div class="flex input_group">
        <input type="password" name="pword" placeholder="Password..." class="input_field"/>
        <input type="password" name="conpword" placeholder="Confirm Password..." class="input_field"/>
      </div>
      <input type="submit" value="Sign up" class="signup_btn btn"/>
      <span class="login">Login</span>
    </form>
  </div>
  <div class="modal" id="pass_reset">
    <div class="modal_content">
      <p>Password reset</p>
      <p class="pwr_msg">Password has been reset.</p>
      <form action="#" id="pass_reset_form" autocomplete="off">
        <div class="input_wrapper flex">
          <input type="email" name="email" placeholder="Email..."/>
          <input type="password" name="pass1" placeholder="New password..."/>
          <input type="password" name="pass2" placeholder="Confirm password..."/>
        </div>
        <div class="btn_group flex">
          <button type="submit">Change</button>
          <button type="reset">Cancel</button>
        </div>
      </form>
    </div>
  </div>
  <script src="frontend/js/jquery-3.6.0.min.js"></script>
  <script src="frontend/js/index.js"></script>
  <script type="module" src="backend/ajax/main.js"></script>
</body>
</html>