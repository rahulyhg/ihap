<?php
session_start();

if (isset($_SESSION['myCode'])) {
    header('Location: ./portal/user?view='.$_SESSION['myCode'].'&key='.$_SESSION['myAlias'].'');
    exit();
}

if (isset($_POST['login']) && $_POST['user'] != "" && $_POST['password'] != "") {

    include 'functions/jabali.php';
    connectDb();
    $user = $_POST['user'];
    $password = md5($_POST['password']);

    function isEmail($data) {
      if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
        return true;
      } else {
        return false;
      }
    }

    $checkMail = isEmail($user);
    if ($checkMail) {
      $result = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE h_email ='".$user."'");
    } else {
      $result = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE h_username ='".$user."'");
    }

    if( $result->num_rows > 0 ) {
      while ($row = mysqli_fetch_assoc($result)) {

        if ($password = $row['h_password']) {
          $_SESSION['myAlias'] = $row['h_alias'];
          $_SESSION['myUsername'] = $row['h_username'];
          $_SESSION['myCode'] = $row['h_code'];
          $_SESSION['myEmail'] = $row['h_email'];
          $_SESSION['myPhone'] = $row['h_phone'];
          $_SESSION['myCenter'] = $row['h_center'];
          $_SESSION['myCap'] = $row['h_type'];
          $_SESSION['myLocation'] = $row['h_location'];
          $_SESSION['myAvatar'] = $row['h_avatar'];

          header('Location: ./portal/user?view='.$_SESSION['myCode'].'');
          exit();

        } else {
          echo "Wrong Password";
        }
      }
    } else {
      ?><div class="modal">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
          Oops! Something went wrong. Please try again
          </div><?
    }

} else {
  include 'header.php'; ?>
  <title>Login [ IHAP ]</title>
  <div style="padding-top:40px;" >
      <div id="login_div">
          <center><?php frontlogo(); ?></center>
          <form method="POST" action="">
          <div class="input-field">
          <i class="material-icons prefix">account_circle</i>
          <input name="user" id="email" type="text">
          <label for="email" class="center-align">Username or Email</label>
          </div>

          <div class="input-field">
          <i class="material-icons prefix">lock</i>
          <input name="password" id="password" type="password">
          <label for="password">Password</label>
          </div>
                  
          <div class="input-field">
          <span class="prefix"></span>
          <input type="checkbox" id="remember-me"/>
          <label for="remember-me">Remember me</label>
          </div>
          <button class="mdl mdl-button mdl-button--fab mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="login"><i class="material-icons">send</i></button>
    

          <p>
          <a href="./register" id="register">Register Now!</a>
          <a href="./forgot" id="forgot">Forgot password?</a>
          </p>

          <br>
          <br>
          </form>
      </div>
  </div>
  <?php
  include 'footer.php';
}  ?>
