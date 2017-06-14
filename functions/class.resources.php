<?php 

class _hResources {
  var $h_alias; 
  var $h_author; 
  var $h_avatar; 
  var $h_category; 
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
  var $h_subtitle; 
  var $h_tags; 
  var $h_text; 
  var $h_type; 
  var $h_updated;
  
  function createResource() {

    $date = date( "YmdHms" );
    $email = $_SESSION['myEmail'];

    $hash = str_shuffle(md5( $email.$date ) );
    $abbr = substr( $_POST['lname'], 0,2 );

    $h_alias = $_POST['h_alias'];
    $h_author = $_POST['h_author'];
    $h_avatar = $_POST['h_avatar'];
    $h_by = $_POST['h_by'];
    $h_center = $_POST['h_center'];
    $h_code = substr( $hash, 20 );
    $h_created = date('Ymd' );
    $h_email = $_POST['h_email'];
    $h_key = $hash;
    $h_level = $_POST['h_level'];
    $h_link = hPORTAL."resource?view=$h_code";
    $h_location = strtolower( $_POST['h_location'] );
    $h_notes = "Account created on ".$date;
    $h_phone = $_POST['h_phone'];
    $h_status = "active";
    $h_type = strtolower( $_POST['h_type'] );

    if ( mysqli_query( $GLOBALS['conn'], "INSERT INTO hresources (h_alias, h_by, h_author, h_avatar, h_center, h_code, h_created, h_email, h_key, h_level, h_link, h_location, h_notes, h_phone, h_status, h_type) 
    VALUES ('".$h_alias."', '".$h_author."', '".$h_avatar."', '".$h_by."', '".$h_center."', '".$h_code."', '".$h_created."', '".$h_email."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_location."', '".$h_notes."', '".$h_phone."', '".$h_status."', '".$h_type."' )" ) ) {
      echo "<script type = \"text/javascript\">
                      alert(\"Resource Created Successfully!\" );
                  </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } 

  }

  function updateResource( $h_code) {
    
    $date = date( "YmdHms" );
    $email = $_SESSION['myEmail'];

    $hash = str_shuffle(md5( $email.$date ) );
    $abbr = substr( $_POST['lname'], 0,2 );

    $h_alias = $_POST['fname'].' '.$_POST['lname'];
    $h_author = substr( $hash, 20 );
    $h_avatar = $_POST['h_avatar'];
    $h_by = $_POST['h_by'];
    $h_center = $_POST['h_center'];
    $h_code = substr( $hash, 20 );
    $h_created = date('Ymd' );
    $h_description = $_POST['h_description'];
    $h_email = $_POST['h_email'];
    $h_gender = strtolower( $_POST['h_gender'] );
    $h_key = $hash;
    $h_level = $_POST['h_level'];
    $h_link = hPORTAL."resource?view=$h_code";
    $h_location = strtolower( $_POST['h_location'] );
    $h_notes = "Account updated on ".$date;
    $h_password = md5( $_POST['h_password'] );
    $h_phone = $_POST['h_phone'];
    $h_status = "active"; //Sort emailresource();, Change to "pending"
    $h_style = "zahra";
    $h_type = strtolower( $_POST['h_type'] );
    $h_resourcename = strtolower( $_POST['fname'].$abbr );

    if ( mysqli_query( $GLOBALS['conn'], "UPDATE hresources SET h_alias = '".$h_alias."', h_author = '".$h_author."', h_avatar = '".$h_avatar."', h_center = '".$h_center."', h_code = '".$h_code."', h_created = '".$h_created."', h_description = '".$h_description."', h_email = '".$h_email."', h_gender = '".$h_gender."', h_key = '".$h_key."', h_level = '".$h_level."', h_link = '".$h_link."', h_location = '".$h_location."', h_notes = '".$h_notes."', h_password = '".$h_password."', h_phone = '".$h_phone."', h_type = '".$h_type."' WHERE h_code = '".$h_code."'" ) ) {
      echo "<script type = \"text/javascript\">
                      alert(\"Resource Updated Successfully!\" );
                  </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   

    $updateResource = mysqli_query( $GLOBALS['conn'], " h_var='".$h_var."', h_var='".$h_var."' WHERE h_code='".$h_code."'" );

  }

  
  function deleteResource( $h_code) {
    
    $deleteResource = mysqli_query( $GLOBALS['conn'], "DELETE FROM hresources WHERE h_code='".$h_code."'" );
    if ( !$createResource ->conn_error) {
      echo '<div><p>Resource Created Successfuly!</p></div>';
    } else {
      echo '<div><p>Error!</p>'.$deleteResource ->conn_error.'</div>';
    }
  }

  function getResourcesType( $type) { ?>
      <title><?php _show_( ucfirst( $type) ); ?>s List [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getResourcesBy = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hresources WHERE h_status = 'active' AND h_type='".$type."'" );
    if ( $getResourcesBy -> num_rows > 0) {
      ?>
      <a href="./resource?create=<?php _show_( $type ); ?>" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">edit</i></a>
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
        <th class="mdl-data-table__cell--non-numeric">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">ADMIN EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">CONTACT PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $resourcesDetails = mysqli_fetch_assoc( $getResourcesBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $resourcesDetails['h_alias'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $resourcesDetails['h_email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $resourcesDetails['h_phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( ucwords( $resourcesDetails['h_location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./resource?view=<?php _show_( $resourcesDetails['h_code'] ); ?>&key=<?php _show_( $resourcesDetails['h_alias'] ); ?>" ><i class="material-icons">account_circle</i></a> 
        <a href="tel:<?php _show_( $resourcesDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="?resource?message?create=message&code=<?php _show_( $_SESSION['myCode'] ); ?>" ><i class="material-icons">message</i></a>  
        <a href="./resource?edit=<?php _show_( $resourcesDetails['h_code'] ); ?>&key=<?php _show_( $resourcesDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./resource?delete=<?php _show_( $resourcesDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div><?php 
    } else {
      ?><div style="margin:1%;" >
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">ADMIN EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">CONTACT PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>No <?php _show_( ucwords( $type. 's' ) ); ?> Found</p></td>
        </tr>
        </tbody>
      </table>
      </div></div><?php 
    }
  }

  function getResourcesLoc( $location) { ?>
      <title>Resources In <?php _show_( ucwords( $location) ); ?> [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getResourcesBy = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hresources WHERE h_type = 'center' AND h_status = 'active' AND h_location='".$location."'" );
    if ( $getResourcesBy -> num_rows > 0) {
      ?>
      <a href="./resource?create=<?php _show_( $type ); ?>" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">edit</i></a>
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
        <th class="mdl-data-table__cell--non-numeric">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">ADMIN EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">CONTACT PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $resourcesDetails = mysqli_fetch_assoc( $getResourcesBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $resourcesDetails['h_alias'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $resourcesDetails['h_email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $resourcesDetails['h_phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( ucwords( $resourcesDetails['h_location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./resource?view=<?php _show_( $resourcesDetails['h_code'] ); ?>&key=<?php _show_( $resourcesDetails['h_alias'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
        <a href="tel:<?php _show_( $resourcesDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="?resource?message?create=message&code=<?php _show_( $_SESSION['myCode'] ); ?>" ><i class="material-icons">message</i></a>  
        <a href="./resource?edit=<?php _show_( $resourcesDetails['h_code'] ); ?>&key=<?php _show_( $resourcesDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./resource?delete=<?php _show_( $resourcesDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div><?php 
    } else {
      ?><div style="margin:1%;" >
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">ADMIN EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">CONTACT PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>No Resources Found in <?php _show_( ucwords( $location) )?></p></td>
        </tr>
        </tbody>
      </table>
      </div></div><?php 
    }
  }

  function getResourcesAuthor( $author) { 
    $getUser = mysqli_query( $GLOBALS['conn'], "SELECT * FROM husers WHERE h_code = '".$author."'" );
     if ( $getUser -> num_rows > 0) {
       while ( $user = mysqli_fetch_assoc( $getUser) ) {
         $userDeet[] = $user;
       }
     }
    ?>
    <title><?php _show_( $userDeet[0]['h_alias'] ); ?>'s Resources [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getResourcesBy = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hresources WHERE h_author='".$author."'" );
    if ( $getResourcesBy -> num_rows > 0) {
      ?>
      <div class="mdl-grid">
        <div class="mdl-cell--11-col" >
            <center>
            <div class="input-field search-box">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php _show_( "Resource" ); ?>">
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
        <th class="mdl-data-table__cell--non-numeric">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">TYPE</th>
        <th class="mdl-data-table__cell--non-numeric">Doctor In Charge</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $usersDetails = mysqli_fetch_assoc( $getResourcesBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_alias'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_type'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_by'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $usersDetails['h_status'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./resource?view=<?php _show_( $usersDetails['h_code'] ); ?>&key=<?php _show_( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">account_circle</i></a> 
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
        <th class="mdl-data-table__cell--non-numeric">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">TYPE</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>
            <p><?php _show_( $userDeet[0]['h_alias'] ); ?> has not created any resources yet!</p>
          </td>
        </tr>
        </tbody>
        </table>
        </div>
        </div><?php 
    }
  }

  function getResources() {
      ?><title>All Resources [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getResources = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hresources WHERE h_status = 'active' ORDER BY h_created DESC" );

    if ( $getResources -> num_rows > 0) {
      ?>
      <a href="./resource?create=center" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">create</i></a>
      <div class="mdl-grid" id="mdl-table">
        <div class="mdl-cell--12-col" >
          <form>
            <center>
            <div class="input-field">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php _show_( "Resource" ); ?>" class="search" >
            </div></center>
            
          <script>
            var options = {
            valueNames: ["h_alias", "h_location", "h_created"]
          },
            documentTable = new List( "mdl-table", options );

          $( $( "th.sort" )[0] ).trigger( "click", function() {
            console.log( "clicked" );
          } );

          $( "input.search" ).on( "keyup", function(e) {
            if ( e.keyCode === 27) {
              $(e.currentTarget).val( "" );
              documentTable.search( "" );
            }
          } );
          </script>
          </form>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table id="mdl-table" class="mdl-data-table mdl-js-data-table mdl-data-table--selectable sort mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric sort" data-sort="h_alias">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">ADMIN EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">CONTACT PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $resourcesDetails = mysqli_fetch_assoc( $getResources)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $resourcesDetails['h_alias'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $resourcesDetails['h_email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $resourcesDetails['h_phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( ucwords( $resourcesDetails['h_location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./resource?view=<?php _show_( $resourcesDetails['h_code'] ); ?>&key=<?php _show_( $resourcesDetails['h_alias'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
        <a href="tel:<?php _show_( $resourcesDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="?resource?message?create=message&code=<?php _show_( $_SESSION['myCode'] ); ?>" ><i class="material-icons">message</i></a>  
        <a href="./resource?edit=<?php _show_( $resourcesDetails['h_code'] ); ?>&key=<?php _show_( $resourcesDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./resource?delete=<?php _show_( $resourcesDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div>
      <?php   } else {
      ?><div style="margin:1%;" >
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">ADMIN EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">CONTACT PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>No Resources Found</p></td>
        </tr>
        </tbody>
      </table>
      </div></div><?php 
    }
  }

  function getResourceCode( $code) {
    $getResourceCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hresources WHERE h_code = '".$code."'" );
    if ( $getResourceCode -> num_rows > 0) {
      while ( $resourceDetails = mysqli_fetch_assoc( $getResourceCode)){
        if ( $_SESSION['myCode'] !== $resourceDetails['h_code'] ) {
          $name = explode( " ", $resourceDetails['h_alias'] );
          $greettype = 'Contact Details';
        } else {
          $name = explode( " ", $resourceDetails['h_alias'] );
          $greettype = '<b>Hello,</b> '.ucfirst( $name[0] );
        }
        ?><title><?php _show_( $resourceDetails['h_alias'] ); ?> [ <?php getOption( 'name' ); ?> ]</title>
        <div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text"><?php _show_( ucfirst( $resourceDetails['h_alias'] ) ); ?></h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a href="./resource?view=<?php _show_( $resourceDetails['h_code'] ); ?>&fav=<?php _show_( $resourceDetails['h_code'] ); ?>" class="material-icons mdl-badge mdl-badge--overlap">favorite</a>
                                <a href="./resource?edit=<?php _show_( $resourceDetails['h_code'] ); ?>&key=<?php _show_( $resourceDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a>
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <h5>
                              <?php _show_( $greettype ); ?>
                            <h5>
                            <h6><b>Admin Email:</b> <a href="mailto:<?php _show_( $resourceDetails['h_email'] ); ?>"><?php _show_( $resourceDetails['h_email'] ); ?></a><br><?php if ( $resourceDetails['h_type'] !== "center" ) { ?>
                            <b>Center:</b> <a href="./resource?center=<?php _show_( $resourceDetails['h_center'] ); ?>"><?php _show_( $resourceDetails['h_center'] ); ?></a><br><?php } 
                            ?><b>Contact Phone:</b> <a href="tel:<?php _show_( $resourceDetails['h_phone'] ); ?>"><?php _show_( $resourceDetails['h_phone'] ); ?></a><br>
                            <b>Type: </b><?php _show_( $resourceDetails['h_type'] ); ?><br>
                            <b>County:</b> <a href="./resource?location=<?php _show_( $resourceDetails['h_location'] ); ?>"><?php _show_( ucwords( $resourceDetails['h_location'] ) ); ?></a>
                            </h6>
                            <a href="tel:<?php _show_( $resourceDetails['h_phone'] ); ?>"><i class="material-icons">phone</i></a>
                            <a href="mailto:<?php _show_( $resourceDetails['h_email'] ); ?>"><i class="material-icons">mail_outline</i></a>
                            <a href="./message?create=message"><i class="material-icons">message</i></a>
                            <a href="./notification?create=note"><i class="material-icons">notifications</i></a>
                            
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                            <img src="<?php _show_( $resourceDetails['h_avatar'] ); ?>" width="100%">
                          </div>
                          <div class="mdl-cell mdl-cell--12-col">
                          <div><?php _show_( $resourceDetails['h_description'] ); ?></div></div>
                          <div><h6><b>Added:</b> <?php _show_( $resourceDetails['h_created'] ); ?></h6></div>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                        <div class="mdl-card__title">
                        <i class="material-icons">local_hospital</i>
                          <span class="mdl-button"><?php _show_( $resourceDetails['h_center'] ); ?></span>
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text mdl-button">
                                <i class="material-icons">person_pin_circle</i>
                                <?php _show_( $resourceDetails['h_location'] ); ?>
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                        <ul class="collapsible popout" data-collapsible="accordion">
                        <li>
                          <div class="collapsible-header active"><i class="material-icons">message</i>Messages from <?php _show_( $name[0] ); ?></div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">comment</i>Messages to <?php _show_( ucfirst( $name[0] ) ); ?></div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">chat_bubble</i>Chat with <?php _show_( ucfirst( $name[0] ) ); ?></div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">description</i>Posts from <?php _show_( ucfirst( $name[0] ) ); ?></div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                      </ul>
                        </div>
                    </div>
                </div>

                </div><?php 
      }
    } else {
      echo 'Resource Not Found';
    }
  }
 
}
