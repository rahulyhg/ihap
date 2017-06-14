<?php 
if ( isset( $_POST['forgot'] ) && $_POST['h_email'] !== "" ) {
  include 'functions/jabali.php';

  if ( emailExists( $_POST['h_email'] ) ) {
    $theUser = mysqli_query( $GLOBALS['conn'], "SELECT h_email, h_key FROM husers WHERE h_email = '".$_POST['h_email']."'" );
    if ( $theUser -> num_rows >0 ) {
      while ( $thisuser = mysqli_fetch_assoc( $theUser) ) {
        $user[] = $thisuser;
      }
    }
    
    if ( !empty( $user) ) {
      if ( $hUser -> emailUser( $user[0]['h_email'], "forgot", $user[0]['h_key'] ) ) {
        header( "Location: ./forgot?error=null" );
      } else {
        header( "Location: ./forgot?error=email" );
      }
    }
  }

} else {
  include 'header.php';
  ?>
  <title>Forgot Password [ <?php getOption( 'name' ); ?> ]</title>
  <div style="padding-top:40px;" >
      <div id="login_div">
  <center><?php frontlogo(); ?>
          <form enctype="multipart/form-data" method="POST" action="" class="">
          
          <div class="input-field">
          <i class="material-icons prefix">mail</i>
          <input class="validate" name="email" id="email" type="email" placeholder="jabali@mauko.co.ke">
          <label for="email" data-error="Please Enter A Valid Email Address" data-success="Okay. Press the buton to submit" class="center-align">Enter Your Email</label>
          </div>

          <button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="forgot"><i class="material-icons">send</i></button>
          <p>
          <span id="register"><a href="./register?type=user" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons">create</i> NEW USER</a> <a href="./register?type=center" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons">edit</i> NEW CENTER</a></span>
          <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored" href="./login" id="forgot">Already Registered? Login</a>
          </p>

          <br>
          <br>
          </form>
      </div>
  </div>
  <?php 
  include 'footer.php';
}
?>