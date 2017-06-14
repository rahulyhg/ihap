<?php 
/**
* @package Jabali Framework
* @subpackage Login
* @link https://docs.mauko.co.ke/jabali/login
* @author Mauko Maunde
* @version 0.17.06
**/

session_start();

if ( isset( $_SESSION['myCode'] ) ) {
    header('Location: ./portal/user?view='.$_SESSION['myCode'].'&key='.$_SESSION['myAlias'].'' );
    exit();
}

if ( isset( $_POST['login'] ) && $_POST['user'] != "" && $_POST['password'] != "" ) {

    include 'functions/jabali.php';
    connectDb();

    $user = $_POST['user'];
    $password = $_POST['password'];

    $user = stripslashes( $user );
    $password = stripslashes( $password );
    $user = mysqli_real_escape_string( $GLOBALS['conn'], $user );
    $password = mysqli_real_escape_string( $GLOBALS['conn'], $password );
    $password = md5($password );

  //$hUser -> loginUser( $user );

    if ( isEmail( $user) ) {
      $result = mysqli_query( $GLOBALS['conn'], "SELECT * FROM husers WHERE h_email = '".$user."" );
    } else {
      $result = mysqli_query( $GLOBALS['conn'], "SELECT * FROM husers WHERE h_username = '".$user."'" );
    }

    if ( $result->num_rows > 0 ) {
      while ( $row = mysqli_fetch_assoc( $result) ) {
        $userDetails[] = $row;
      }
    } else {
      header('Location: ./login?error=email' );
      exit();
    }

    if ( !empty( $userDetails) && $userDetails[0]['h_password'] = $password ) { 
      $_SESSION['myAlias'] = $userDetails[0]['h_alias'];
      $_SESSION['myUsername'] = $userDetails[0]['h_username'];
      $_SESSION['myCode'] = $userDetails[0]['h_code'];
      $_SESSION['myEmail'] = $userDetails[0]['h_email'];
      $_SESSION['myPhone'] = $userDetails[0]['h_phone'];
      $_SESSION['myCenter'] = $userDetails[0]['h_center'];
      $_SESSION['myCap'] = $userDetails[0]['h_type'];
      $_SESSION['myLocation'] = $userDetails[0]['h_location'];
      $_SESSION['myAvatar'] = $userDetails[0]['h_avatar'];
      $_SESSION['myGender'] = $userDetails[0]['h_gender'];

      header('Location: ./portal/user?view='.$_SESSION['myCode'].'&key='.$_SESSION['myAlias'].'' );
      exit();

    } else {
      header('Location: ./login?error=password' );
      exit();
    } 

} else {
  include 'header.php'; ?>
  <title>Login [ <?php getOption( 'name' ); ?> ]</title>
  <div style="padding-top:40px;" >
      <div id="login_div" class="mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { primaryColor( $_SESSION['myCode'] ); } else { echo "grey"; } ?>">
          <center><?php frontlogo(); 
      if ( isset( $_GET['error'] ) ) {
          if ( $_GET['error'] == "email" ) { ?>
              <div id="success" class="alert mdl-color--red">
                  <span>Wrong Email/Username!<br>Please try again</span>
              </div><?php 
          } elseif ( $_GET['error'] == "password" ) { ?>
          <div id="fail" class="alert mdl-color--red">
              <span>You entered the wrong password!<br>Please Try Again</span>
          </div><?php 
          }
      } ?></center>
          <form enctype="multipart/form-data" method="POST" action="">
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
          <button class="mdl mdl-button mdl-button--fab mdl-js-button mdl-button--raised mdl-button--colored alignright" type="submit" name="login"><i class="material-icons">send</i></button>
    <br>
          <br>

          <p>
          <span id="register"><a href="./register?type=user" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons">create</i> NEW USER</a> <a href="./register?type=center" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons">edit</i> NEW CENTER</a></span>
          <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored" href="./forgot" id="forgot">Forgot password?</a>
          </p>
<br>
          <br>
          <br>
          <br>
          </form>
      </div>
  </div><?php 
  include 'footer.php';
}  ?>