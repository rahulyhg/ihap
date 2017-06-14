<?php 
if ( isset( $_POST['reset'] ) && $_POST['h_password'] !== "" ) {
  include 'functions/jabali.php';

  if ( mysqli_query( $GLOBALS['conn'], "UPDATE husers SET h_password = '".md5( $_POST['h_password'] )."', h_key = '".md5(date('YmdHms' ))."' WHERE h_code = '".$_POST['h_code']."'" ) ) {
    if ( $hUser -> emailUser( $user[0]['h_email'], "reset", $user[0]['h_key'] ) ) {
      header( "Location: ./forgot?error=null" );
    } else {
      header( "Location: ./forgot?error=email" );
    }
  } else {
    header( "Location: ./reset?error=update" );
  }

}

if ( isset( $_GET['email'] ) && $_GET['key'] !== "" ) {
  include 'functions/jabali.php';
  
  if ( emailExists( $_GET['email'] ) ) {
    $theUser = mysqli_query( $GLOBALS['conn'], "SELECT h_email, h_key FROM husers WHERE h_email = '".$_GET['email']."'" );
    if ( $theUser -> num_rows > 0 ) {
      while ( $thisuser = mysqli_fetch_assoc( $theUser) ) {
        $user[] = $thisuser;
      }
    }

    if ( !empty( $user) && $user[0]['h_key'] = $_GET['key'] ) {
      include 'header.php'; ?>
      <title>Reset Password [ <?php getOption( 'name' ); ?> ]</title>
      <div style="padding-top:40px;" >
          <div id="login_div">
      <center><?php frontlogo(); ?></center>
              <form enctype="multipart/form-data" method="POST" action="">

              <div class="input-field">
              <i class="material-icons prefix">lock</i>
              <input class="validate" name="pass1" id="pass1" type="password">
              <label for="pass1">New Password</label>
              </div>

              <div class="input-field">
              <i class="material-icons prefix">lock_outline</i>
              <input name="h_password" id="password" type="password">
              <label for="password">Repeat Password</label>
              </div>

              <input type="hidden" name="h_code" value="<?php _show_( $user[0]['h_code'] ); ?>">

              <button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="reset"><i class="material-icons">send</i></button>

              <p>
              <a href="./register" id="register">Register</a>
              </p>

              <br>
              <br>
              </form>
          </div>
      </div><?php 
      include 'footer.php';
    }
  }
}
?>