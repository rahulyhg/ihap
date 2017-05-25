<?php

class _hNotifications {
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

  
  function createNotification() {

    $date = date("YmdHms");
    if (isset($_SESSION['myEmail'])) {
      $email = $_SESSION['myEmail'];
    } else {
      $email = hEMAIL;
    }

    $conn = mysqli_connect( hDBHOST, hDBUSER, hDBPASS, hDBNAME );

    $h_alias = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_alias']); 
    $h_author = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_author']);
    $h_key = str_shuffle(md5($email.$date));
    $h_code = substr($h_key, rand(0, 15), 12); 
    $h_created = date(Ymd);
    $h_desc = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_desc']); 
    $h_email = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_email']);
    $h_for = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_for']);
    $h_level = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_level']); 
    $h_link = hPORTAL."notification?view=$h_code";
    $h_status = "unread";
    $h_type = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_type']);

    $createNotification = "INSERT INTO hnotifications (h_alias, h_author, h_code, h_created, h_description, h_email, h_key, h_level, h_link, h_status, h_type) 
    VALUES ('".$h_alias."', '".$h_author."', '".$h_code."', '".$h_created."', '".$h_desc."', '".$h_email."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_status."', '".$h_type."')";
    if (mysqli_query($conn, $createNotification)) {
      echo "Notification Sent";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  function updateNotification($h_code) {
    
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
    $h_link = hPORTAL."notification?view=$h_key&action=view"; 
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

    $updateNotification = mysqli_query($GLOBALS['conn'], "UPDATE hnotifications SET h_var='".$h_var."', h_var='".$h_var."' WHERE h_code='".$h_code."'");
    // if (!$updateNotification ->conn_error) {
    //   echo '<div><p>Notification Created Successfuly!</p></div>';
    // } else {
    //   echo '<div><p>Error!</p>'.$updateNotification ->conn_error.'</div>';
    // }
  }

  
  function deleteNotification($h_code) {
    
    $deleteNotification = mysqli_query($GLOBALS['conn'], "DELETE FROM hnotifications WHERE h_code='".$h_code."'");
    if (!$createNotification ->conn_error) {
      echo '<div><p>Notification Created Successfuly!</p></div>';
    } else {
      echo '<div><p>Error!</p>'.$deleteNotification ->conn_error.'</div>';
    }
  }

  function getNotificationsType($type) {

    $getNotificationsBy = mysqli_query($GLOBALS['conn'], "SELECT * FROM hnotifications WHERE h_status = 'active' AND h_type='".$type."'");
    if($getNotificationsBy -> num_rows > 0) {
      echo "<title>".ucfirst($type)."s List | IHAP</title>";
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
      while ($notificationsDetails = mysqli_fetch_assoc($getNotificationsBy)){
        echo '
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">'
        .$notificationsDetails['h_notificationname']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$notificationsDetails['h_email']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$notificationsDetails['h_phone']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$notificationsDetails['h_location']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./notification?create='.$notificationsDetails['h_author']. '" ><i class="material-icons">reply</i></a> <a href="./notification?view='.$notificationsDetails['h_code']. '" ><i class="material-icons">account_circle</i></a> <a href="tel:'.$notificationsDetails['h_phone']. '" ><i class="material-icons">phone</i></a> <a href="./notification?chat='.$notificationsDetails['h_author']. '" ><i class="material-icons">notification</i></a> <a href="./notification?delete='.$notificationsDetails['id'].'" ><i class="material-icons">delete</i></a>
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
        <td><p>No Notifications Found</p></td>
        </tr>
        </tbody>';
         echo '
        </table></div>';
    }
  }

  function getNotifications() {
    $getNotifications = mysqli_query($GLOBALS['conn'], "SELECT * FROM hnotifications ORDER BY h_created DESC");
    if($getNotifications -> num_rows > 0) {
      echo "<title>All Notifications | IHAP</title>";
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">FROM</th>
        <th class="mdl-data-table__cell--non-numeric">NOTE</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
      while ($notificationsDetails = mysqli_fetch_assoc($getNotifications)){
        echo '
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">'
        .$notificationsDetails['h_email']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$notificationsDetails['h_description']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$notificationsDetails['h_created']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./notification?create='.$notificationsDetails['h_author']. '" ><i class="material-icons">reply</i></a> <a href="./notification?view='.$notificationsDetails['h_code']. '" ><i class="material-icons">account_circle</i></a> <a href="tel:'.$notificationsDetails['h_phone']. '" ><i class="material-icons">phone</i></a> <a href="./notification?chat='.$notificationsDetails['h_author']. '" ><i class="material-icons">mail_outline</i></a> <a href="./notification?delete='.$notificationsDetails['id'].'" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody>';
      } echo '
        </table></div>';
    } else {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">CODE</th>
        <th class="mdl-data-table__cell--non-numeric">FROM</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
        echo '
        <tbody>
        <tr>
        <td><p>No Notifications Found</p></td>
        </tr>
        </tbody>';
         echo '
        </table></div>';
    }
  }

  function getNotificationCode($code) {
    $getNotificationCode = mysqli_query($GLOBALS['conn'], "SELECT * FROM hnotifications WHERE h_code = '".$code."'");
    mysqli_query($GLOBALS['conn'], "UPDATE hnotifications SET h_status = 'read' WHERE h_code = '".$code."'");
    if($getNotificationCode -> num_rows > 0) {
      while ($notificationDetails = mysqli_fetch_assoc($getNotificationCode)){
        echo '<title>'.$notificationDetails['h_alias'].'</title>';
        echo '<div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">'.$notificationDetails['h_alias'].'</h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a id="reply" href="./notification?create='.$notificationDetails['h_author'].'" ><i class="material-icons">reply</i></a>
                                <a id="chat" href="./notification?chat='.$notificationDetails['h_author'].'" ><i class="material-icons">mail_outline</i></a>
                                <a id="delete" href="./notification?delete='.$notificationDetails['id'].'" ><i class="material-icons">delete</i></a>
                            </div>

                            <div class="mdl-tooltip" for="reply" >Reply to Notification</div>
                            <div class="mdl-tooltip" for="chat" >Chats</div>
                            <div class="mdl-tooltip" for="delete" >Delete Notification</div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <blockquote>'.$notificationDetails['h_description'].'</blockquote>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                            <h5>From: '.$notificationDetails['h_email'].'</h5>
                            <h5>Sent: '.$notificationDetails['h_created'].'</h5>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                        <i class="material-icons">business</i>
                          '.$notificationDetails['h_center'].'
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text mdl-button">
                                <i class="material-icons">room</i>
                                '.$notificationDetails['h_location'].'
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                            Notifications and latest chats go here
                        </div>
                    </div>
                </div>
                </div>';
      }
    } else {
      echo 'Notification Not Found';
    }
  }
}
