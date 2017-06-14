<?php 
session_start();

if ( isset( $_POST['create'] ) ) {

    include 'functions/jabali.php';
    connectDb();

  if ( emailExists( $_POST['h_email'] ) ) {

    header( "Location: ./register?create=exists" );
  } else {

    $date = date('YmdHms' );
    if ( isset( $_SESSION['myEmail'] ) ) {
      $email = $_SESSION['myEmail'];
    } else {
      $email = hEMAIL;
    }

    $hash = str_shuffle(md5( $email.$date ) );
    $abbr = substr( $_POST['lname'], 0,3 );

    $h_alias = $_POST['fname'].' '.$_POST['lname'];
    $h_author = substr( $hash, 20 );
    $h_avatar = hIMAGES.'avatar.svg';
    $h_center = $_POST['h_center'];
    $h_code = substr( $hash, 20 );
    $h_created = date('Ymd' );
    $h_email = $_POST['h_email'];
    $h_gender = strtolower( $_POST['h_gender'] );
    $h_key = $hash;
    $h_level = $_POST['h_level'];
    $h_link = hPORTAL."user?view=$h_code";
    $h_location = strtolower( $_POST['h_location'] );
    $h_notes = "Account created on ".$date;
    $h_password = md5( $_POST['h_password'] );
    $h_phone = $_POST['h_phone'];
    $h_status = "pending";
    $h_style = "zahra";
    $h_type = strtolower( $_POST['h_type'] );
    $h_username = strtolower( $_POST['fname'].$abbr );

    if ( mysqli_query( $GLOBALS['conn'], "INSERT INTO husers (h_alias, h_author, h_avatar, h_center, h_code, h_created, h_email, h_gender, h_key, h_level, h_link, h_location, h_notes, h_password, h_phone, h_status, h_style, h_type, h_username) 
    VALUES ('".$h_alias."', '".$h_author."', '".$h_avatar."', '".$h_center."', '".$h_code."', '".$h_created."', '".$h_email."', '".$h_gender."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_location."', '".$h_notes."', '".$h_password."', '".$h_phone."', '".$h_status."', '".$h_style."', '".$h_type."', '".$h_username."' )" ) ) {
        header( "Location: ./register?create=success" );
      } else {
        header( "Location: ./register?create=fail" );
      }
  }

} elseif ( isset( $_POST['resource'] ) ) {
    # code...
} elseif ( isset( $_POST['request'] ) ) {
    # code...
} else {
    include 'header.php'; ?>
<title>New <?php _show_( ucwords( $_GET['type'] ) ); ?> [ <?php getOption( 'name' ); ?> ]</title>
<div style="padding-top:40px;" >
  <div id="login_div" class="mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { primaryColor( $_SESSION['myCode'] ); } else { echo "grey"; } ?>">
      <center><?php 
      frontlogo();
      if ( isset( $_GET['create'] ) ) {
          if ( $_GET['create'] == "success" ) { ?>
              <div id="success" class="alert mdl-color--green">
                  <span>Success!<br>Check your email for a confirmation link</span>
              </div><?php 
          } elseif ( $_GET['create'] == "fail" ) { ?>
          <div id="fail" class="alert mdl-color--red">
              <span>Oops!<br>We Ran Into A Problem. Please Try Again</span>
          </div><?php 
          } elseif ( $_GET['create'] == "exists" ) { ?>
          <div id="exists" class="alert mdl-color--red">
              <span>Oops!<br>A User Already Exists With That Email. Please Try Again With A Different Email.</span>
          </div><?php 
          }
      } ?>
      </center>

          <form enctype="multipart/form-data" name="registerUser" method="POST" action="">

          <div class="input-field">
          <i class="material-icons prefix">label</i>
          <input id="fname" name="fname" type="text">
          <label for="fname">First Name</label>
          </div>
                 
          <div class="input-field">
          <i class="material-icons prefix">label_outline</i>
          <input id="lname" name="lname" type="text">
          <label for="lname">Last Name</label>
          </div>

          <div class="input-field">
          <i class="material-icons prefix">mail</i>
          <input class="validate" id="email" name="h_email" type="email">
          <label for="email" data-error="Please enter a valid email" data-success="OK!" class="center-align">Email Address</label>
          </div>

          <div class="input-field">
          <i class="material-icons prefix">phone</i>
          <input  id="h_phone" name="h_phone" type="text" value="254">
          <label for="h_phone" data-error="wrong" data-success="right" class="center-align">Phone Number</label>
          </div>

          <?php if ( $_GET['type'] !== "center" ) { ?>
          <div class="input-field">
          <i class="material-icons prefix">lock</i>
          <input id="password" name="h_password" type="text">
          <label for="password">Password</label>
          </div><?php } ?>

          <input type="hidden" name="h_type" value="<?php _show_( $_GET['type'] ); ?>">

          <div class="input-field mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
            <i class="material-icons prefix">room</i>
          <input class="mdl-textfield__input" type="text" id="counties" name="h_location" readonly tabIndex="-1" placeholder="Location">
          <ul for="counties" class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { primaryColor( $_SESSION['myCode'] ); } else { echo "grey"; } ?>" style="max-height: 250px !important; overflow-y: auto;">
              <?php 
              $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kajiado, kakamega, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";

              $cities = "baringo, bomet, Bungoma, Busia, Elgeyo/Marakwet, Embu, Garissa, Homa Bay, Isiolo, Kajiado, Kakamega, Kericho, Kiambu, Kilifi, Kirinyaga, Kisii, Kisumu, Kitui, Kwale, Laikipia, Lamu, Machakos, Makueni, Mandera, Marsabit, Meru, Migori, Mombasa, Murang'a, nairobi city, Nakuru, Nandi, Narok, Nyamira, Nyandarua, Nyeri, Samburu, Siaya, Taita/Taveta, Tana River, Tharaka-Nithi, Trans Nzoia, Turkana, Uasin Gishu, Vihiga, Wajir, West Pokot";
              $counties = explode( ", ", $county_list );
              for ( $c=0; $c < count( $counties ); $c++) {
                  $label = ucwords( $counties[$c] );
                  echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
              }
               ?>
          </ul>
          </div>

          <?php if ( $_GET['type'] !== "center" ) { ?>
          <div class="input-field inline mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
            <i class="mdi mdi-gender-transgender prefix"></i>
           <input class="mdl-textfield__input" id="h_gender" name="h_gender" type="text" readonly tabIndex="-1" placeholder="Gender" >
             <ul class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { primaryColor( $_SESSION['myCode'] ); } else { echo "grey"; } ?>" for="h_gender">
               <li class="mdl-menu__item" data-val="male">Male</li>
               <li class="mdl-menu__item" data-val="female">Female</li>
               <li class="mdl-menu__item" data-val="other">Other</li>
             </ul>
          </div>
          
          <div class="input-field mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
            <i class="material-icons prefix">local_hospital</i>
            <input class="mdl-textfield__input" type="text" id="centers" name="h_center" readonly tabIndex="-1" placeholder="Center">
            <ul for="centers" class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { primaryColor( $_SESSION['myCode'] ); } else { echo "grey"; } ?>" style="max-height: 300px !important; overflow-y: auto;">
                <?php $hUser -> getCenters(); ?>
            </ul>
          </div><?php } ?>

          <button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="create"><i class="material-icons">send</i></button>

          <br>
          </form>  
  </div>
</div><?php 
    include 'footer.php';
} ?>
