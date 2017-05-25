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
  var $h_for; 
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

  
  function createService() {

    $date = date("YmdHms");
    if (isset($_SESSION['myEmail'])) {
      $email = $_SESSION['myEmail'];
    } else {
      $email = hEMAIL;
    }

    $conn = mysqli_connect( hDBHOST, hDBUSER, hDBPASS, hDBNAME );

    $h_alias = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_alias']);
    $h_author = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_author']);
    $h_by = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_by']);
    $h_key = str_shuffle(md5($email.$date));
    $h_code = substr($h_key, rand(0, 15), 12); 
    $h_created = date(Ymd);
    $h_desc = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_desc']); 
    $h_email = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_email']);
    $h_for = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_for']);
    $h_level = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_level']); 
    $h_link = hPORTAL."service?view=$h_code";
    $h_status = "unread";
    $h_type = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_type']);

    $createService = "INSERT INTO hservices (h_alias, h_author, h_by, h_code, h_created, h_description, h_email, h_key, h_level, h_link, h_phone h_status, h_type) 
    VALUES ('".$h_alias."', '".$h_author."', '".$h_by."', '".$h_code."', '".$h_created."', '".$h_desc."', '".$h_email."', '".$h_key."', '".$h_level."', '".$_SESSION['myPhone']."', '".$h_link."', '".$h_status."', '".$h_type."')";
     if (mysqli_query($conn, $createService)) {
       echo "<script type = \"text/javascript\">
                    alert(\"Service Sent\");
                </script>";
     } else {
       echo "<script type = \"text/javascript\">
                    alert(\"Check and try again\");
                </script>";
     }
  }

  function updateService($h_code) {
    
    $date = date("YmdHms");
    if (isset($_SESSION['myEmail'])) {
      $email = $_SESSION['myEmail'];
    } else {
      $email = hEMAIL;
    }

    $h_alias = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_alias']); 
    $h_author = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_author']); 
    $h_avatar = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_avatar']); 
    $h_category = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_category']); 
    $h_center = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_center']);
    $h_key = strshuffle(md5($email.$date)); 
    $h_code = substr($h_key, rand(0, 15), 16); 
    $h_created = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_created']); 
    $h_custom = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_custom']); 
    $h_desc = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_desc']); 
    $h_email = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_email']); 
    $h_fav = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_fav']); 
    $h_level = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_level']); 
    $h_link = hPORTAL."service?view=$h_key&action=view"; 
    $h_location = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_location']); 
    $h_notes = subst($h_desc, 250); 
    $h_phone = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_phone']); 
    $h_reading = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_reading']); 
    $h_status = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_status']); 
    $h_style = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_style']); 
    $h_subtitle = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_subtitle']); 
    $h_tags = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_tags']); 
    $h_text = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_text']); 
    $h_type = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_type']); 
    $h_updated = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_updated']);    

    $updateService = mysqli_query($GLOBALS['conn'], "UPDATE hservices SET h_var='".$h_var."', h_var='".$h_var."' WHERE h_code='".$h_code."'");
    // if (!$updateService ->conn_error) {
    //   echo '<div><p>Service Created Successfuly!</p></div>';
    // } else {
    //   echo '<div><p>Error!</p>'.$updateService ->conn_error.'</div>';
    // }
  }

  
  function deleteService($h_code) {
    
    $deleteService = mysqli_query($GLOBALS['conn'], "DELETE FROM hservices WHERE h_code='".$h_code."'");
    if (!$createService ->conn_error) {
      echo '<div><p>Service Created Successfuly!</p></div>';
    } else {
      echo '<div><p>Error!</p>'.$deleteService ->conn_error.'</div>';
    }
  }

  function getServicesType($type) {

    echo '<title>'.ucfirst($type).'s List | IHAP</title>';
    $getServicesBy = mysqli_query($GLOBALS['conn'], "SELECT * FROM hservices WHERE h_status = 'active' AND h_type='".$type."'");
    if($getServicesBy -> num_rows > 0) {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
      while ($servicesDetails = mysqli_fetch_assoc($getServicesBy)){
        echo '
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">'
        .$servicesDetails['h_servicename']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$servicesDetails['h_email']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$servicesDetails['h_phone']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$servicesDetails['h_location']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./service?create='.$servicesDetails['h_type']. '&code='.$servicesDetails['h_author'].'" ><i class="material-icons">reply</i></a> <a href="./service?view='.$servicesDetails['h_code']. '" ><i class="material-icons">account_circle</i></a> <a href="tel:'.$servicesDetails['h_phone']. '" ><i class="material-icons">phone</i></a> <a href="./service?request='.$servicesDetails['h_author']. '" ><i class="material-icons">service</i></a> <a href="./service?delete='.$servicesDetails['id'].'" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody>';
      } echo '
        </table></div>';
    } else {
        echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
        echo '
        <tbody>
        <tr>
        <td><p>No '.ucfirst($type).'s Found</p></td>
        </tr>
        </tbody>';
         echo '
        </table></div>';
    }
  }

  function getServices() {
    echo "<title>All Services | IHAP</title>";
    $getServices = mysqli_query($GLOBALS['conn'], "SELECT * FROM hservices ORDER BY h_created DESC");
    if($getServices -> num_rows > 0) {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">FROM</th>
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
      while ($servicesDetails = mysqli_fetch_assoc($getServices)){
        echo '
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">'
        .$servicesDetails['h_email']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$servicesDetails['h_description']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$servicesDetails['h_created']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$servicesDetails['h_status']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./service?create='.$servicesDetails['h_type']. '&code='.$servicesDetails['h_author']. '" ><i class="material-icons">reply</i></a> <a href="./service?view='.$servicesDetails['h_code']. '" ><i class="material-icons">account_circle</i></a> <a href="tel:'.$servicesDetails['h_phone']. '" ><i class="material-icons">phone</i></a> <a href="./service?request='.$servicesDetails['h_author']. '" ><i class="material-icons">service</i></a> <a href="./service?delete='.$servicesDetails['id']. '" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody>';
      } echo '
        </table></div>';
    } else {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">FROM</th>
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
        echo '
        <tbody>
        <tr>
        <td><p>No Services Found</p></td>
        </tr>
        </tbody>';
         echo '
        </table></div>';
    }
  }

  function getRequests() {
    echo "<title>All Requests | IHAP</title>";
    $getServices = mysqli_query($GLOBALS['conn'], "SELECT * FROM hservices WHERE h_type='request' ORDER BY h_created DESC");
    if($getServices -> num_rows > 0) {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">FROM</th>
        <th class="mdl-data-table__cell--non-numeric">LAST MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
      while ($servicesDetails = mysqli_fetch_assoc($getServices)){
        echo '
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">'
        .$servicesDetails['h_email']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$servicesDetails['h_description']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$servicesDetails['h_created']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./service?create=request&code='.$serviceDetails['h_author']. '" ><i class="material-icons">reply</i></a> <a href="./service?request='.$servicesDetails['h_author']. '" ><i class="material-icons">account_circle</i></a> <a href="tel:'.$servicesDetails['h_phone']. '" ><i class="material-icons">phone</i></a> <a href="./service?request='.$servicesDetails['h_author']. '" ><i class="material-icons">service</i></a> <a href="./service?delete='.$servicesDetails['id']. '" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody>';
      } echo '
        </table></div>';
    } else {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">FROM</th>
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
        echo '
        <tbody>
        <tr>
        <td><p>No Requests Found</p></td>
        </tr>
        </tbody>';
         echo '
        </table></div>';
    }
  }

  function getServiceCode($code) {
    $getServiceCode = mysqli_query($GLOBALS['conn'], "SELECT * FROM hservices WHERE h_code = '".$code."'");
    mysqli_query($GLOBALS['conn'], "UPDATE hservices SET h_status = 'read' WHERE h_code = '".$code."'");
    if($getServiceCode -> num_rows > 0) {
      while ($serviceDetails = mysqli_fetch_assoc($getServiceCode)){
        echo '<title>'.$serviceDetails['h_alias'].' [ IHAP Services ]</title>';
        echo '<div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">'.$serviceDetails['h_alias'].'</h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a id="reply" href="./service?create='.$serviceDetails['h_type']. '&code='.$serviceDetails['h_author'].'" ><i class="material-icons">reply</i></a>
                                <a id="request" href="./service?request='.$serviceDetails['h_author'].'" ><i class="material-icons">mail_outline</i></a>
                                <a id="delete" href="./service?delete='.$serviceDetails['id'].'" ><i class="material-icons">delete</i></a>
                            </div>

                            <div class="mdl-tooltip" for="reply" >Reply to Service</div>
                            <div class="mdl-tooltip" for="request" >Requests</div>
                            <div class="mdl-tooltip" for="delete" >Delete Service</div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <blockquote>'.$serviceDetails['h_description'].'</blockquote>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                            <h5>From: '.$serviceDetails['h_email'].'</h5>
                            <h5>Sent: '.$serviceDetails['h_created'].'</h5>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                        <i class="material-icons">business</i>
                          '.$serviceDetails['h_center'].'
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text mdl-button">
                                <i class="material-icons">room</i>
                                '.$serviceDetails['h_location'].'
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                            Services and latest requests go here
                        </div>
                    </div>
                </div>
                </div>';
      }
    } else {
      echo 'Service Not Found';
    }
  }

  function getRequestCode($code) {
    $getServiceCode = mysqli_query($GLOBALS['conn'], "SELECT * FROM hservices WHERE h_type='request' AND (h_author = '".$code."')");
    mysqli_query($GLOBALS['conn'], "UPDATE hservices SET h_status = 'read' WHERE h_code = '".$code."'");
    if($getServiceCode -> num_rows > 0) {
      echo '<div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">';
      while ($serviceDetails = mysqli_fetch_assoc($getServiceCode)){
        echo '<div class="mdl-card__title">
                <h2 class="mdl-card__title-text"> Request with '.$serviceDetails['h_author'].'</h2>
              </div>';
        echo '<title>'.$serviceDetails['h_alias'].' [ IHAP Requests ]</title>';
        echo '
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <blockquote>'.$serviceDetails['h_description'].'</blockquote>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                            <h5>Sent: '.$serviceDetails['h_created'].'</h5>
                          </div>
                        </div>';
      }
            ?><div class="mdl-card__supporting-text mdl-card--expand">
                    <form name="serviceForm" method="POST" action="">
                      <title>Create Service</title>
                        <input type="hidden" name="h_alias" value="Reply">
                        <input type="hidden" name="h_email" value="'.$_SESSION['myEmail'].'">
                        <input type="hidden" name="h_author" value="'.$_SESSION['myCode'].'">
                        <input type="hidden" name="h_for" value="'.$_GET['code'].'">
                        <input type="hidden" name="h_level" value="private">
                        <input type="hidden" name="h_type" value="request">

                        <div class="input-field">
                          <p>Your Response</p>
                        <textarea id="service" rows="5" name="h_desc"></textarea><script>CKEDITOR.replace( 'service' );</script>
                        </div>

                        <a href="./service?create=request" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"style="float:left;"><i class="material-icons">request</i></a>
                        <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" type="submit" name="create" style="float:right;"><i class="material-icons">send</i></button>
                    </form>
                </div><?php echo '
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                        <i class="material-icons">business</i>
                          '.$_SESSION['myCenter'].'
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text mdl-button">
                                <i class="material-icons">room</i>
                                '.$_SESSION['myLocation'].'
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                            Latest Notifications
                        </div>
                    </div>
                </div>
                </div>';
    } else {
      echo 'Request Not Found';
    }
  }
}
