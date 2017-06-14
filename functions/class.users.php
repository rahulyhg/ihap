<?php 

class _hUsers {
  var $h_alias; 
  var $h_author; 
  var $h_avatar; 
  var $h_center; 
  var $h_code; 
  var $h_created; 
  var $h_custom; 
  var $h_desc; 
  var $h_email; 
  var $h_fav; 
  var $h_key; 
  var $h_level; 
  var $h_link; 
  var $h_location; 
  var $h_notes; 
  var $h_phone; 
  var $h_reading; 
  var $h_status; 
  var $h_style; 
  var $h_type; 
  var $h_updated;


  function loginUser( $user) {
    if ( isEmail( $user) ) {
      $result = mysqli_query( $GLOBALS['conn'], "SELECT * FROM husers WHERE h_email = '".$user."'" );
    } else {
      $result = mysqli_query( $GLOBALS['conn'], "SELECT * FROM husers WHERE h_username = '".$user."'" );
    }

    if ( $result->num_rows > 0 ) {
      while ( $row = mysqli_fetch_assoc( $result) ) {
        $userDetails[] = $row;
      }
    } else {
      ?><div class="alert mdl-color--red">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
          Oops! Something went wrong. Please try again
          </div><?php 
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
      ?><div class="alert mdl-color--red">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      Wrong Password
      </div><?php 
    }
 }
  
 function emailUser( $email, $subject, $key) {
   if ( $subject == "create" ) { 
      error_reporting(-1 );

      $name = $_POST['name']; 
      $submit_links = $_POST['submit_links']; 

      if ( isset( $_POST['submit'] ))
      {
      $from_add = hEMAIL; 
      $to_add = "ben@webdesignrepo.com"; 
      $subject = "Your Subject Name";
      $message = "Name:$name \n Sites: $submit_links";

      $headers = 'From: submit@webdesignrepo.com' . "\r\n" .
      'Reply-To: ben@webdesignrepo.com' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

      if ( mail( $to_add,$subject,$message,$headers)) 
      {
          $msg = "Mail sent";

      echo $msg;

      } 
      }
   } elseif ( $subject == "confirm" ) {
   } elseif ( $subject == "forgot" ) {
   } elseif ( $subject == "reset" ) {
   }
 }
  
  function createUser() {

    $date = date( "YmdHms" );
    $email = $_SESSION['myEmail'];

    $hash = str_shuffle(md5( $email.$date ) );
    $abbr = substr( $_POST['lname'], 0,3 );

    $h_alias = $_POST['fname'].' '.$_POST['lname'];
    $h_author = substr( $hash, 20 );
    
    if ( $_FILES['h_avatar'] == "" ) {
      $h_avatar = hIMAGES.'avatar.svg';
    } else {
      $uploads = "../uploads/".date('Y' ).'/'.date('m' ).'/'.date('d' ).'/';
      $upload = $uploads . basename( $_FILES['h_avatar']['name'] );

      if ( file_exists( $upload) ) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
      }

      if ( move_uploaded_file( $_FILES['h_avatar']["tmp_name"], $upload) ) {
          //Do nothing
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
      $h_avatar = hUPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'.$_FILES['h_avatar']['name'];
    }

    $h_center = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_center'] );
    $h_code = substr( $hash, 20 );
    $h_description = "";
    $h_created = date('Ymd' );
    $h_email = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_email'] );
    $h_gender = strtolower( $_POST['h_gender'] );
    $h_key = $hash;
    $h_level = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_level'] );
    $h_link = hPORTAL."user?view=$h_code&key=$h_alias";
    $h_location = strtolower( $_POST['h_location'] );
    $h_notes = "Account created on ".$date;
    $h_password = md5( $_POST['h_password'] );
    $h_phone = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_phone'] );

    if ( !$_POST['h_status'] ) {
      $h_status = "pending";
    } else {
      $h_status = $_POST['h_status'];
    }
    
    $h_style = "zahra";
    $h_type = strtolower( $_POST['h_type'] );
    $h_username = strtolower( $_POST['fname'].$abbr );

    if ( mysqli_query( $GLOBALS['conn'], "INSERT INTO husers (h_alias, h_author, h_avatar, h_center, h_code, h_created, h_description, h_email, h_gender, h_key, h_level, h_link, h_location, h_notes, h_password, h_phone, h_status, h_style, h_type, h_username) 
    VALUES ('".$h_alias."', '".$h_author."', '".$h_avatar."', '".$h_center."', '".$h_code."', '".$h_created."', '".$h_description."', '".$h_email."', '".$h_gender."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_location."', '".$h_notes."', '".$h_password."', '".$h_phone."', '".$h_status."', '".$h_style."', '".$h_type."', '".$h_username."' )" ) ) {
      echo "<script type = \"text/javascript\">
                      alert(\"User Created Successfully!\" );
                  </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } 

  }

  function updateUser( $code) {
    
    $date = date( "YmdHms" );
    $email = $_SESSION['myEmail'];

    $hash = str_shuffle(md5( $email.$date ) );
    $abbr = substr( $_POST['lname'], 0,2 );

    $h_alias = $_POST['fname'].' '.$_POST['lname'];

    if ( !empty( $_FILES['h_avatar'] ) ) {

      $uploads = "../uploads/".date('Y' ).'/'.date('m' ).'/'.date('d' ).'/';
      $upload = $uploads . basename( $_FILES['h_avatar']['name'] );
      move_uploaded_file( $_FILES['h_avatar']["tmp_name"], $upload );
      $h_avatar = $uploads.$_FILES['h_avatar']['name'];

    } else {
      $h_avatar = $_POST['h_avatar'];
    }

    $h_center = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_center'] );
    $h_created = date('Ymd' );
    $h_description = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_description'] );
    $h_email = $_POST['h_email'];

    $h_gender = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_gender'] );
    $h_gender = strtolower( $h_gender );

    $h_key = $hash;
    $h_level = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_level'] );
    $h_link = hPORTAL."user?view=$h_code&key=$h_alias";

    $h_location = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_location'] );
    $h_location = strtolower( $h_location );

    $h_notes = "Account updated on ".$date;
    
    if ( $_POST['h_password'] !== "" ) {
      $h_password = md5( $_POST['h_password'] );
    }

    $h_phone = $_POST['h_phone'];

    $h_type = $_POST['h_type'];
    $h_type = strtolower( $h_type );

    if ( mysqli_query( $GLOBALS['conn'], "UPDATE husers SET h_alias = '".$h_alias."', h_avatar = '".$h_avatar."', h_center = '".$h_center."', h_created = '".$h_created."', h_description = '".$h_description."', h_email = '".$h_email."', h_gender = '".$h_gender."', h_key = '".$h_key."', h_level = '".$h_level."', h_link = '".$h_link."', h_location = '".$h_location."', h_notes = '".$h_notes."', h_password = '".$h_password."', h_phone = '".$h_phone."', h_type = '".$h_type."' WHERE h_code = '".$code."'" ) ) {
      echo "<script type = \"text/javascript\">
              alert(\" $h_alias Updated Successfully!\" );
          </script>";
    } else {
      echo '<script type = \"text/javascript\">
              alert(\"Error: "'.$GLOBALS['conn']->error.'!\" );
          </script>';
    }

  }

  function deleteUser( $h_code) {
    
    $deleteUser = mysqli_query( $GLOBALS['conn'], "DELETE FROM husers WHERE h_code='".$h_code."'" );
  }

  function getUsersType( $type) { ?>
    <title><?php _show_( ucfirst( $type) ); ?>s List [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getUsersBy = mysqli_query( $GLOBALS['conn'], "SELECT * FROM husers WHERE h_status = 'active' AND h_type='".$type."'" );
    if ( $getUsersBy -> num_rows > 0) {
      ?>
      <div class="mdl-grid">
        <div class="mdl-cell--12-col" >
            <center>
            <div class="input-field search-box">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php _show_( ucfirst( $type) ); ?>">
            </div></center>
            <div class="result"></div>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th><?php if ( $type !== "center" ) { ?>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th><?php } ?>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $usersDetails = mysqli_fetch_assoc( $getUsersBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_username'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_phone'] ); ?>
        </td><?php if ( $type !== "center" ) { ?>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_center'] ); ?>
        </td><?php } ?>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( ucwords( $usersDetails['h_location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./user?view=<?php _show_( $usersDetails['h_code'] ); ?>&key=<?php _show_( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">account_circle</i></a> 
        <a href="tel:<?php _show_( $usersDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php _show_( $_SESSION['myCode'] ); ?>" ><i class="material-icons">message</i></a><?php 
        if ( isCap( 'admin' ) ) { ?>  
        <a href="./user?edit=<?php _show_( $usersDetails['h_code'] ); ?>&key=<?php _show_( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./user?delete=<?php _show_( $usersDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div>
      <?php   } else { ?>

        <div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th><?php if ( $type !== "center" ) { ?>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th><?php } ?>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>
            <p>No <?php _show_( ucfirst( $type) ); ?>s Found</p>
          </td>
        </tr>
        </tbody>
        </table>
        </div>
        </div><?php 
    }
  }

  function getUsersAuthor( $author) { ?>
    <title>Users List [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getUsersBy = mysqli_query( $GLOBALS['conn'], "SELECT * FROM husers WHERE h_status = 'active' AND h_author='".$author."'" );
    if ( $getUsersBy -> num_rows > 0) {
      ?>
      <div class="mdl-grid">
        <div class="mdl-cell--11-col" >
            <center>
            <div class="input-field search-box">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php _show_( ucfirst( $type) ); ?>">
            </div></center>
            <div class="result"></div>
        </div>

        <div class="mdl-cell--1-col mdl-card" ><br>
              <a href="user?view=<?php _show_( $author ); ?>" class="alignright">
              <i class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon notification">account_circle</i></a>
            
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th><?php if ( $type !== "center" ) { ?>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th><?php } ?>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $usersDetails = mysqli_fetch_assoc( $getUsersBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_username'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_phone'] ); ?>
        </td><?php if ( $type !== "center" ) { ?>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_center'] ); ?>
        </td><?php } ?>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( ucwords( $usersDetails['h_location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./user?view=<?php _show_( $usersDetails['h_code'] ); ?>&key=<?php _show_( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">account_circle</i></a> 
        <a href="tel:<?php _show_( $usersDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php _show_( $_SESSION['myCode'] ); ?>" ><i class="material-icons">message</i></a><?php 
        if ( isCap( 'admin' ) ) { ?>  
        <a href="./user?edit=<?php _show_( $usersDetails['h_code'] ); ?>&key=<?php _show_( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./user?delete=<?php _show_( $usersDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div>
      <?php   } else { ?>

        <div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th><?php if ( $type !== "center" ) { ?>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th><?php } ?>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>
            <p>No <?php _show_( ucfirst( $type) ); ?>s Found</p>
          </td>
        </tr>
        </tbody>
        </table>
        </div>
        </div><?php 
    }
  }

  function getUsersLoc( $location) { ?>
    <title><?php _show_( ucfirst( $type) ); ?>s List [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getUsersBy = mysqli_query( $GLOBALS['conn'], "SELECT * FROM husers WHERE h_status = 'active' AND location='".$location."'" );
    if ( $getUsersBy -> num_rows > 0) {
      ?>
      <div class="mdl-grid">
        <div class="mdl-cell--12-col" >
            <center>
            <div class="input-field search-box">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php _show_( ucfirst( $type) ); ?>">
            </div></center>
            <div class="result"></div>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $usersDetails = mysqli_fetch_assoc( $getUsersBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_username'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_center'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( ucwords( $usersDetails['h_location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./user?view=<?php _show_( $usersDetails['h_code'] ); ?>&key=<?php _show_( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">account_circle</i></a> 
        <a href="tel:<?php _show_( $usersDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php _show_( $_SESSION['myCode'] ); ?>" ><i class="material-icons">message</i></a><?php 
        if ( isCap( 'admin' ) ) { ?>  
        <a href="./user?edit=<?php _show_( $usersDetails['h_code'] ); ?>&key=<?php _show_( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./user?delete=<?php _show_( $usersDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div>
      <?php   } else { ?>

        <div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>
            <p>No <?php _show_( ucfirst( $type) ); ?>s Found In <?php _show_( ucfirst( $location) ); ?></p>
          </td>
        </tr>
        </tbody>
        </table>
        </div>
        </div><?php 
    }
  }

  function getUsersTypeLoc( $type, $location) { ?>
    <title><?php _show_( ucfirst( $type) ); ?>s List [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getUsersBy = mysqli_query( $GLOBALS['conn'], "SELECT * FROM husers WHERE h_status = 'active' AND location='".$location."'" );
    if ( $getUsersBy -> num_rows > 0) {
      ?>
      <div class="mdl-grid">
        <div class="mdl-cell--12-col" >
            <center>
            <div class="input-field search-box">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php _show_( ucfirst( $type) ); ?>">
            </div></center>
            <div class="result"></div>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $usersDetails = mysqli_fetch_assoc( $getUsersBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_username'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_center'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( ucwords( $usersDetails['h_location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./user?view=<?php _show_( $usersDetails['h_code'] ); ?>&key=<?php _show_( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">account_circle</i></a> 
        <a href="tel:<?php _show_( $usersDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php _show_( $_SESSION['myCode'] ); ?>" ><i class="material-icons">message</i></a><?php 
        if ( isCap( 'admin' ) ) { ?>  
        <a href="./user?edit=<?php _show_( $usersDetails['h_code'] ); ?>&key=<?php _show_( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./user?delete=<?php _show_( $usersDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div>
      <?php   } else { ?>

        <div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>
            <p>No <?php _show_( ucfirst( $type) ); ?>s Found In <?php _show_( ucfirst( $location) ); ?></p>
          </td>
        </tr>
        </tbody>
        </table></div></div><?php 
    }
  }

  function getPendingUsers() { ?>
    <title>All Users [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getUsers = mysqli_query( $GLOBALS['conn'], "SELECT * FROM husers WHERE h_status = 'pending' ORDER BY h_created DESC" );

    if ( $getUsers -> num_rows > 0) { ?>
      <div class="mdl-grid">
        <div class="mdl-cell--12-col" >
          <form>
            <center>
            <div class="input-field">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php _show_( "User" ); ?>">
            </div></center>
            </form>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $usersDetails = mysqli_fetch_assoc( $getUsers)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_username'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_center'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( ucwords( $usersDetails['h_location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./user?view=<?php _show_( $usersDetails['h_code'] ); ?>&key=<?php _show_( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">account_circle</i></a> 
        <a href="tel:<?php _show_( $usersDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php _show_( $_SESSION['myCode'] ); ?>" ><i class="material-icons">message</i></a><?php 
        if ( isCap( 'admin' ) ) { ?>  
        <a href="./user?edit=<?php _show_( $usersDetails['h_code'] ); ?>&key=<?php _show_( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./user?delete=<?php _show_( $usersDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
        <a href="./user?activate=<?php _show_( $usersDetails['h_code'] ); ?>" ><i class="material-icons">done</i></a><?php } ?>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div>
      <?php   } else { ?>

        <div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>
            <center><i class="material-icons">done_all</i> <p>No Pending Users Found</p></center>
          </td>
        </tr>
        </tbody>
        </table></div></div><?php 
    }
  }

  function getUsers() { ?>
    <title>All Users [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getUsers = mysqli_query( $GLOBALS['conn'], "SELECT * FROM husers WHERE h_status = 'active' ORDER BY h_created DESC" );

    if ( $getUsers -> num_rows > 0) { ?>
      <div class="mdl-grid">
        <div class="mdl-cell--12-col" >
          <form>
            <center>
            <div class="input-field">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php _show_( "User" ); ?>">
            </div></center>
            </form>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $usersDetails = mysqli_fetch_assoc( $getUsers)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_username'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_center'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( ucwords( $usersDetails['h_location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./user?view=<?php _show_( $usersDetails['h_code'] ); ?>&key=<?php _show_( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">account_circle</i></a> 
        <a href="tel:<?php _show_( $usersDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php _show_( $usersDetails['h_code'] ); ?>" ><i class="material-icons">message</i></a><?php 
        if ( isCap( 'admin' ) ) { ?>  
        <a href="#" id="<?php _show_( $usersDetails['h_code'] ); ?>" class="" ><i class="material-icons ">edit</i></a>
        <div id="editModal" class="modal">
          <div class="modal-content mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
          <div class="mdl-card__title">
            <a href="./user?edit=<?php _show_( $usersDetails['h_code'] ); ?>&key=<?php _show_( $usersDetails['h_alias'] ); ?>" class="material-icons mdl-badge mdl-badge--overlap">open_in_new</a>
            <span class="mdl-button">Edit <?php _show_( $usersDetails['h_alias'] ); ?></span>
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-card__subtitle-text">
                  <span class="close">
                    <i class="material-icons">clear</i>
                  </span>
                  
              </div>
            </div>

            <div class="mdl-card__supporting-text">
              <form enctype="multipart/form-data" name="registerUser" method="POST" action="<?php _show_( hPORTAL.'user?view='.$userDetails['h_code'].'&key='.$userDetails['h_alias'] ); ?>" >

                      <div class="input-field mdl-textfield mdl-js-textfield getmdl-select">
                      <i class="material-icons prefix">donut_large</i>
                       <input class="mdl-textfield__input" id="h_type" name="h_type" type="text" readonly tabIndex="-1" placeholder="<?php _show_( ucfirst( $userDetails['h_type'] ) ); ?>" value="<?php _show_( ucwords( $usersDetails['h_type'] ) ); ?>">
                         <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>" for="h_type"><?php 
                           if ( $_SESSION['myCap'] == "admin" ) {
                            _show_( '<li class="mdl-menu__item" data-val="admin">Admin</li>' );
                           } ?>
                           <li class="mdl-menu__item" data-val="doctor">Doctor</li>
                           <li class="mdl-menu__item" data-val="center">Center</li>
                         </ul>
                      </div>

                      <div class="input-field inline">
                      <i class="material-icons prefix">phone</i>
                      <input  id="h_phone" name="h_phone" type="text" value="<?php _show_( $usersDetails['h_phone'] ); ?>">
                      <label for="h_phone" class="center-align">Phone Number</label>
                      </div>

                      <div class="input-field mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                        <i class="material-icons prefix">room</i>
                      <input class="mdl-textfield__input" type="text" id="counties" name="h_location" readonly tabIndex="-1" placeholder="<?php _show_( ucwords( $userDetails['h_location'] ) ); ?>" value="<?php _show_( ucwords( $usersDetails['h_location'] ) ); ?>">
                      <ul for="counties" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>" style="max-height: 300px !important; overflow-y: auto;">
                          <?php 
                          $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kakamega, kajiado, kapenguria, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, ol kalou, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";
                          $counties = explode( ", ", $county_list );
                          for ( $c=0; $c < count( $counties ); $c++) {
                              $label = ucwords( $counties[$c] );
                              echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
                          }
                           ?>
                      </ul>
                      </div>

                      <div class="input-field">
                      <i class="material-icons prefix">label</i>
                      <input class="validate" id="h_alias" name="h_alias" type="text" value="<?php _show_( $usersDetails['h_alias'] ); ?>">
                      <label for="h_alias" class="center-align">Full Names</label>
                      </div>

                      <div class="input-field inline">
                      <i class="material-icons prefix">mail</i>
                      <input class="validate" id="email" name="h_email" type="email" value="<?php _show_( $usersDetails['h_email'] ); ?>">
                      <label for="email" class="center-align">Email Address</label>
                      </div>

                      <?php if ( $userDetails['h_type'] !== "center" ) { ?>
                      <div class="input-field mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                        <i class="material-icons prefix">local_hospital</i>
                      <input class="mdl-textfield__input" type="text" id="centers" name="h_center" readonly tabIndex="-1" placeholder="Change Center">
                      <ul for="centers" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>" style="max-height: 300px !important; overflow-y: auto;">
                          <?php 
                          $centers = mysqli_query( $GLOBALS['conn'], "SELECT h_alias, h_code FROM husers WHERe h_type = 'center' ORDER BY h_alias" );
                          if ( $centers -> num_rows > 0 );
                          while ( $center = mysqli_fetch_assoc( $centers) ) {
                              echo '<li class="mdl-menu__item" data-val="'.$center['h_code'].'">'.$center['h_alias'].'</li>';
                          }
                           ?>
                      </ul>
                      </div><?php } ?>

                      <div class="input-field inline alignright">
                  <button class="mdl-button mdl-button--fab alignright" type="submit" name="update"><i class="material-icons">saves</i></button></div>

                  
        </form>
            </div>
          </div>

        </div>

        <script>
        // Get the modal
        var modal = document.getElementById('editModal' );
        var a = document.getElementById( "<?php _show_( $usersDetails['h_code'] ); ?>" );
        var span = document.getElementsByClassName( "close" )[0];
        a.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if ( event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>
        <a href="./user?delete=<?php _show_( $usersDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div>
      <?php   } else { ?>

        <div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>
            <p>No Users Found</p>
          </td>
        </tr>
        </tbody>
        </table></div></div><?php 
    }
  }

  function getCenters() {
    $centers = mysqli_query( $GLOBALS['conn'], "SELECT h_alias, h_code FROM husers WHERe h_type = 'center' ORDER BY h_alias" );
    if ( $centers -> num_rows > 0) {;
      while ( $center = mysqli_fetch_assoc( $centers) ) {
          echo '<li class="mdl-menu__item" data-val="'.$center['h_code'].'">'.$center['h_alias'].'</li>';
      }
    }
      echo '<center>Your Center Not Listed? <br><a href="./register?type=center">Register it Now</a></center>';
  }

  function getUserCode( $code) {
    $getUserCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM husers WHERE h_code = '".$code."'" );
    if ( $getUserCode -> num_rows > 0) {
      while ( $userDetails = mysqli_fetch_assoc( $getUserCode)){
        if ( $_SESSION['myCode'] !== $userDetails['h_code'] ) {
          $name = explode( " ", $userDetails['h_alias'] );
          $greettype = 'About '.ucfirst( $name[0] );
        } else {
          $name = explode( " ", $userDetails['h_alias'] );
          $greettype = '<b>Hello </b> '.ucfirst( $name[0] )."!";
        }
        ?><title><?php _show_( $userDetails['h_alias'] ); ?> [ <?php getOption( 'name' ); ?> ]</title>
        <div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                        <div class="mdl-card__title">
                            <div class="mdl-card__title-text">
                            <span><?php _show_( $greettype ); ?></span>
                            </div>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text"><?php if ( strtolower( $userDetails['h_type'] ) == "center" ) { ?>
                                <a href="./resource?author=<?php _show_( $userDetails['h_code'] ); ?>" class="material-icons mdl-badge mdl-badge--overlap">business</a><?php } ?>
                                <a href="./user?view=<?php _show_( $userDetails['h_code'] ); ?>&fav=<?php _show_( $userDetails['h_code'] ); ?>" class="material-icons mdl-badge mdl-badge--overlap">favorite</a><?php 
                                if ( isCap( 'admin' ) || isProfile( $_SESSION['myCode'] ) ) { ?>
                                <a href="./user?edit=<?php _show_( $userDetails['h_code'] ); ?>&key=<?php _show_( $userDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a><?php } ?>
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--7-col-desktop mdl-cell--7-col-tablet mdl-cell--12-col-phone">
                            <h5><i class="mdi mdi-<?php 
                            if ( strtolower( $userDetails['h_type'] ) == "center" ) { 
                                echo "city";
                            } else {
                                if ( strtolower( $userDetails['h_gender'] ) == "male" ) {
                                  echo "gender-male";
                                } elseif ( strtolower( $userDetails['h_gender'] ) == "female" ) {
                                  echo "gender-female";
                                } else {
                                  echo "transgender";
                                }
                            } ?> mdl-button-icon mdl-badge mdl-badge--overlap alignright">
                              </i>
                            <h5>
                            <h6><b>Email:</b> <a href="mailto:<?php _show_( $userDetails['h_email'] ); ?>"><?php _show_( $userDetails['h_email'] ); ?></a><br><?php if ( $userDetails['h_type'] !== "center" ) { ?>
                            <b>Center:</b> <a href="./resource?center=<?php _show_( $userDetails['h_center'] ); ?>"><?php _show_( $userDetails['h_center'] ); ?></a><br><?php } ?>
                            <b>Location:</b> <a href="./resource?location=<?php _show_( $userDetails['h_location'] ); ?>"><?php _show_( ucwords( $userDetails['h_location'] ) ); ?></a><br>
                            <b>Phone:</b> <a href="tel:<?php _show_( $userDetails['h_phone'] ); ?>"><?php _show_( $userDetails['h_phone'] ); ?></a><br><?php if ( $userDetails['h_type'] !== "center" ) { ?>
                            <b>Expertise: </b><?php _show_( $userDetails['h_type'] ); } ?></h6>
                            <a href="tel:<?php _show_( $userDetails['h_phone'] ); ?>"><i class="material-icons">phone</i></a>
                            <a href="mailto:<?php _show_( $userDetails['h_email'] ); ?>"><i class="material-icons">mail_outline</i></a>
                            <a href="./message?create=message&code=<?php _show_( $userDetails['h_code'] ); ?>"><i class="material-icons">message</i></a>
                            <a href="./message?chat=<?php _show_( $userDetails['h_code'] ); ?>"><i class="material-icons">forum</i></a>
                            <a href="./notification?create=note&code=<?php _show_( $userDetails['h_code'] ); ?>"><i class="material-icons">notifications</i></a>
                            
                          </div>
                          <div class="mdl-cell mdl-cell--5-col-desktop mdl-cell--5-col-tablet mdl-cell--12-col-phone">
                            <img src="<?php _show_( $userDetails['h_avatar'] ); ?>" width="100%">
                          </div>
                          <div class="mdl-cell mdl-cell--12-col">
                          <div><?php _show_( $userDetails['h_description'] ); ?></div></div>
                          <div><h6><b>Joined:</b> <?php _show_( $userDetails['h_created'] ); ?></h6></div>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><?php 
                          $getNotes = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hnotifications WHERE h_author = '".$userDetails['h_code']."'" );
                          if ( $getNotes -> num_rows > 0) { ?>
                            <div class="mdl-card__title">
                            <i class="material-icons">query_builder</i>
                              <span class="mdl-button">Recently From <?php _show_( ucfirst( $name[0] ) ); ?></span>
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                              <a href="./message?chat=<?php _show_( $userDetails['h_code'] ); ?>" ><i class="material-icons">question_answer</i></a>
                            </div>
                            </div>
                            <div class="mdl-card__supporting-text">
                              <ul class="collapsible popout" data-collapsible="accordion"><?php 
                                  while ( $note = mysqli_fetch_assoc( $getNotes) ) { ?>
                                  <li>
                                    <div class="collapsible-header"><i class="material-icons">label_outline</i>
                                      
                                        <b><?php _show_( $note['h_alias'] ); ?></b><span class="alignright"><?php 
                                        _show_( $note['h_created'] ); ?></span>
                                    </div>
                                    <div class="collapsible-body"><span class="alignright">
                                        <a href="./message?create=note&code=<?php _show_( $note['h_author'] ); ?>" ><i class="material-icons">reply</i></a> 
                                        <a href="./message?view=<?php _show_( $note['h_code'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
                                        <a href="./message?delete=<?php _show_( $note['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
                                        </span>
                                        <span><?php 
                                        _show_( $note['h_description'] ); ?></span>
                                    </div>
                                  </li><?php 
                                  } ?>
                            </ul>
                            </div><?
                          } else {
                          echo '<div class="mdl-card__title">
                <i class="material-icons">notifications_none</i>
                  <span class="mdl-button">No Recent Notifications</span>
                    <div class="mdl-layout-spacer">';
                        }
                      ?>
                    </div>
                </div>

                </div><?php 
      }
    } else {
      echo 'User Not Found';
    }
  }
 
}
