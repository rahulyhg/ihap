<?php 

class _hServices {
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
  var $h_key; 
  var $h_level; 
  var $h_link; 
  var $h_location; 
  var $h_notes; 
  var $h_phone; 
  var $h_reading; 
  var $h_status;  
  var $h_type; 
  var $h_updated;

  function createService() {

    $date = date( "YmdHms" );
    $email = $_SESSION['myEmail'];

    $hash = str_shuffle(md5( $email.$date ) );
    $abbr = substr( $_POST['lname'], 0,2 );

    $h_alias = $_POST['h_alias'];
    $h_author = substr( $hash, 20 );
    $h_by = $_POST['h_by'];
    $h_center = $_POST['h_center'];
    $h_code = substr( $hash, 20 );
    $h_created = date('Ymd' );
    $h_email = $_POST['h_email'];
    $h_key = $hash;
    $h_level = $_POST['h_level'];
    $h_link = hPORTAL."service?view=".$h_code;
    $h_location = strtolower( $_POST['h_location'] );
    $h_notes = $_POST['h_notes'];
    $h_status = "pending";
    $h_type = strtolower( $_POST['h_type'] );

    if ( mysqli_query( $GLOBALS['conn'], "INSERT INTO hservices (h_alias, h_author, h_by, h_center, h_code, h_created, h_email, h_key, h_level, h_link, h_location, h_notes, h_status, h_type) 
    VALUES ('".$h_alias."', '".$h_author."', '".$h_by."', '".$h_center."', '".$h_code."', '".$h_created."', '".$h_email."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_location."', '".$h_notes."', '".$h_status."', '".$h_type."' )" ) ) {
      echo "<script type = \"text/javascript\">
                      alert(\"Service Created Successfully!\" );
                  </script>";
    } else {
        echo "Error: " .$GLOBALS['conn']->error;
    } 

  }

  function updateService( $h_code) {
    
    $date = date( "YmdHms" );
    $email = $_SESSION['myEmail'];

    $hash = str_shuffle(md5( $email.$date ) );
    $abbr = substr( $_POST['lname'], 0,2 );

    $h_alias = $_POST['fname'].' '.$_POST['lname'];
    $h_author = substr( $hash, 20 );
    $h_avatar = $_POST['h_avatar'];
    $h_center = $_POST['h_center'];
    $h_code = substr( $hash, 20 );
    $h_created = date('Ymd' );
    $h_description = $_POST['h_description'];
    $h_email = $_POST['h_email'];
    $h_gender = strtolower( $_POST['h_gender'] );
    $h_key = $hash;
    $h_level = $_POST['h_level'];
    $h_link = hPORTAL."service?view=$h_code";
    $h_location = strtolower( $_POST['h_location'] );
    $h_notes = "Account updated on ".$date;
    $h_password = md5( $_POST['h_password'] );
    $h_phone = $_POST['h_phone'];
    $h_status = "active"; //Sort emailservice();, Change to "pending"
    $h_style = "zahra";
    $h_type = strtolower( $_POST['h_type'] );
    $h_servicename = strtolower( $_POST['fname'].$abbr );

    if ( mysqli_query( $GLOBALS['conn'], "UPDATE hservices SET h_alias = '".$h_alias."', h_author = '".$h_author."', h_avatar = '".$h_avatar."', h_center = '".$h_center."', h_code = '".$h_code."', h_created = '".$h_created."', h_description = '".$h_description."', h_email = '".$h_email."', h_gender = '".$h_gender."', h_key = '".$h_key."', h_level = '".$h_level."', h_link = '".$h_link."', h_location = '".$h_location."', h_notes = '".$h_notes."', h_password = '".$h_password."', h_phone = '".$h_phone."', h_type = '".$h_type."' WHERE h_code = '".$h_code."'" ) ) {
      echo "<script type = \"text/javascript\">
                      alert(\"Service Updated Successfully!\" );
                  </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
    }   

    $updateService = mysqli_query( $GLOBALS['conn'], " h_var='".$h_var."', h_var='".$h_var."' WHERE h_code='".$h_code."'" );

  }

  
  function deleteService( $h_code) {
    
    $deleteService = mysqli_query( $GLOBALS['conn'], "DELETE FROM hservices WHERE h_code='".$h_code."'" );
    if ( !$createService ->conn_error) {
      echo '<div><p>Service Created Successfuly!</p></div>';
    } else {
      echo '<div><p>Error!</p>'.$deleteService ->conn_error.'</div>';
    }
  }

  function getServicesType( $type) { ?>
  <title><?php _show_( ucfirst( $type) ); ?>s List [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getServicesBy = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hservices WHERE h_status = 'active' AND h_type='".$type."'" );
    if ( $getServicesBy -> num_rows > 0) {
      ?>
      <a href="./service?create=<?php _show_( $type ); ?>" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">create</i></a>
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
        <th class="mdl-data-table__cell--non-numeric">REQUEST</th>
        <th class="mdl-data-table__cell--non-numeric">BY</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $servicesDetails = mysqli_fetch_assoc( $getServicesBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $servicesDetails['h_alias'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $servicesDetails['h_by'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $servicesDetails['h_center'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( ucwords( $servicesDetails['h_location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./service?view=<?php _show_( $servicesDetails['h_code'] ); ?>&key=<?php _show_( $servicesDetails['h_alias'] ); ?>" ><i class="material-icons">account_circle</i></a> 
        <a href="tel:<?php _show_( $servicesDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php _show_( $_SESSION['myCode'] ); ?>" ><i class="material-icons">message</i></a>  
        <a href="./service?edit=<?php _show_( $servicesDetails['h_code'] ); ?>&key=<?php _show_( $servicesDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./service?delete=<?php _show_( $servicesDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div><?php 
    } else {
        echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">REQUEST</th>
        <th class="mdl-data-table__cell--non-numeric">BY</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
        echo '
        <tbody>
        <tr>
        <td><p>No '.ucfirst( $type).'s Found</p></td>
        </tr>
        </tbody>';
         echo '
        </table>
        </div>';
    }
  }

  function getPendingService( $author) { ?>
  <title><?php _show_( "Pending Requests" ); ?> [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getServiceStatus = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hservices WHERE h_status = 'pending' AND h_type = 'request' AND h_author = '".$author."'" );
    if ( $getServiceStatus -> num_rows > 0) {
      ?>
      <a href="./service?create=request" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">create</i></a>
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
        <th class="mdl-data-table__cell--non-numeric">REQUEST</th>
        <th class="mdl-data-table__cell--non-numeric">CREATED</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $servicesDetails = mysqli_fetch_assoc( $getServiceStatus)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $servicesDetails['h_alias'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $servicesDetails['h_created'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $servicesDetails['h_center'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( ucwords( $servicesDetails['h_location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./service?view=<?php _show_( $servicesDetails['h_code'] ); ?>&key=<?php _show_( $servicesDetails['h_alias'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
        <a href="tel:<?php _show_( $servicesDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php _show_( $_SESSION['myCode'] ); ?>" ><i class="material-icons">message</i></a>  
        <a href="./service?edit=<?php _show_( $servicesDetails['h_code'] ); ?>&key=<?php _show_( $servicesDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./service?delete=<?php _show_( $servicesDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div><?php 
    } else { ?>
      <div style="margin:1%;" >
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">REQUEST</th>
        <th class="mdl-data-table__cell--non-numeric">CREATED</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p> No Pending Reguests Found!</p></td>
        </tr>
        </tbody>
        </table>
        </div><?php 
    }

  }

  function getServices() {
      ?><title>All Services [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getServices = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hservices ORDER BY h_created DESC" );

    if ( $getServices -> num_rows > 0) {
      ?>
      <a href="./service?create=request" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">create</i></a>
      <div class="mdl-grid">
        <div class="mdl-cell--12-col" >
          <form>
            <center>
            <div class="input-field">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php _show_( "Service" ); ?>">
            </div></center>
            </form>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">REQUEST</th>
        <th class="mdl-data-table__cell--non-numeric">BY</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $servicesDetails = mysqli_fetch_assoc( $getServices)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $servicesDetails['h_alias'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $servicesDetails['h_by'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $servicesDetails['h_center'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( ucwords( $servicesDetails['h_location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./service?view=<?php _show_( $servicesDetails['h_code'] ); ?>&key=<?php _show_( $servicesDetails['h_alias'] ); ?>" ><i class="material-icons">account_circle</i></a> 
        <a href="tel:<?php _show_( $servicesDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php _show_( $_SESSION['myCode'] ); ?>" ><i class="material-icons">message</i></a>  
        <a href="./service?edit=<?php _show_( $servicesDetails['h_code'] ); ?>&key=<?php _show_( $servicesDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./service?delete=<?php _show_( $servicesDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div>
      <?php   } else { ?>
      <div style="margin:1%;" >
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">REQUEST</th>
        <th class="mdl-data-table__cell--non-numeric">BY</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>No Services Found</p></td>
        </tr>
        </tbody>
        </table></div></div><?php 
    }
  }

  function getServiceCode( $code) {
    $getServiceCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hservices WHERE h_code = '".$code."'" );
    if ( $getServiceCode -> num_rows > 0) {
      while ( $serviceDetails = mysqli_fetch_assoc( $getServiceCode)){
        if ( $_SESSION['myCode'] !== $serviceDetails['h_code'] ) {
          $name = explode( " ", $serviceDetails['h_alias'] );
          $greettype = 'Contact Details';
        } else {
          $name = explode( " ", $serviceDetails['h_alias'] );
          $greettype = '<b>Hello,</b> '.ucfirst( $name[0] );
        }
        ?><title><?php _show_( $serviceDetails['h_alias'] ); ?> [ <?php getOption( 'name' ); ?> ]</title>
        <div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text"><?php _show_( ucfirst( $serviceDetails['h_alias'] ) ); ?></h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a href="./service?view=<?php _show_( $serviceDetails['h_code'] ); ?>&fav=<?php _show_( $serviceDetails['h_code'] ); ?>" class="material-icons mdl-badge mdl-badge--overlap">favorite</a>
                                <a href="./service?edit=<?php _show_( $serviceDetails['h_code'] ); ?>&key=<?php _show_( $serviceDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a>
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <h5><?php _show_( $greettype ); ?>
                              <i class="mdi mdi-gender-<?php 
                                if ( $serviceDetails['h_gender'] == "male" ) {
                                  echo "male";
                                } elseif ( $serviceDetails['h_gender'] == "female" ) {
                                  echo "female";
                                } else {
                                  echo "transgender";
                                } ?> mdl-button-icon mdl-badge mdl-badge--overlap alignright">
                              </i>
                            <h5>
                            <h6><b>Email:</b> <a href="mailto:<?php _show_( $serviceDetails['h_email'] ); ?>"><?php _show_( $serviceDetails['h_email'] ); ?></a><br>
                            <b>Center:</b> <a href="./resource?center=<?php _show_( $serviceDetails['h_center'] ); ?>"><?php _show_( $serviceDetails['h_center'] ); ?></a><br>
                            <b>Location:</b> <a href="./resource?location=<?php _show_( $serviceDetails['h_location'] ); ?>"><?php _show_( ucwords( $serviceDetails['h_location'] ) ); ?></a><br>
                            <b>Phone:</b> <a href="tel:<?php _show_( $serviceDetails['h_phone'] ); ?>"><?php _show_( $serviceDetails['h_phone'] ); ?></a><br>
                            <b>Expertise: </b><?php _show_( $serviceDetails['h_type'] ); ?></h6>
                            <a href="tel:<?php _show_( $serviceDetails['h_phone'] ); ?>"><i class="material-icons">phone</i></a>
                            <a href="mailto:<?php _show_( $serviceDetails['h_email'] ); ?>"><i class="material-icons">mail_outline</i></a>
                            <a href="./message?create=message"><i class="material-icons">message</i></a>
                            <a href="./message?create=chat"><i class="material-icons">forum</i></a>
                            <a href="./notification?create=note"><i class="material-icons">notifications</i></a>
                            
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                            <img src="<?php _show_( $serviceDetails['h_avatar'] ); ?>" width="100%">
                          </div>
                          <div class="mdl-cell mdl-cell--12-col">
                          <div><?php _show_( $serviceDetails['h_description'] ); ?></div></div>
                          <div><h6><b>Joined:</b> <?php _show_( $serviceDetails['h_created'] ); ?></h6></div>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                        <div class="mdl-card__title">
                        <i class="material-icons">local_hospital</i>
                          <span class="mdl-button"><?php _show_( $serviceDetails['h_center'] ); ?></span>
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text mdl-button">
                                <i class="material-icons">person_pin_circle</i>
                                <?php _show_( $serviceDetails['h_location'] ); ?>
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
                          <div class="collapsible-header"><i class="material-icons">description</i>Posts by <?php _show_( ucfirst( $name[0] ) ); ?></div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                      </ul>
                        </div>
                    </div>
                </div>

                </div><?php 
      }
    } else {
      echo 'Service Not Found';
    }
  }
 
}
