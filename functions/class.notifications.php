<?php 

class _hNotifications {
  var $h_alias; 
  var $h_author;
  var $h_category; 
  var $h_center; 
  var $h_code; 
  var $h_created; 
  var $h_desc; 
  var $h_email;
  var $h_for; 
  var $h_key; 
  var $h_level; 
  var $h_link; 
  var $h_location; 
  var $h_notes; 
  var $h_phone; 
  var $h_status; 
  var $h_type; 

  
  function createNotification() {

    $date = date( "YmdHms" );
    if ( isset( $_SESSION['myEmail'] ) ) {
      $email = $_SESSION['myEmail'];
    } else {
      $email = hEMAIL;
    }

    $h_alias = $_POST['h_alias'];
    $h_author = $_POST['h_author'];
    $h_by = $_POST['h_by'];
    $h_key = str_shuffle(md5( $email.$date ) );
    $h_code = substr( $h_key, rand(0, 15), 12 ); 
    $h_created = date(Ymd );
    $h_desc = $_POST['h_description']; 
    $h_email = $_POST['h_email'];
    $h_for = $_POST['h_for'];
    $h_level = $_POST['h_level']; 
    $h_link = hPORTAL."notification?view=".$h_code;
    $h_status = "unread";
    $h_type = $_POST['h_type'];

     if ( mysqli_query( $GLOBALS['conn'], "INSERT INTO hnotifications (h_alias, h_author, h_by, h_code, h_created, h_description, h_email, h_key, h_level, h_link, h_status, h_type) 
    VALUES ('".$h_alias."', '".$h_author."', '".$h_by."', '".$h_code."', '".$h_created."', '".$h_desc."', '".$h_email."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_status."', '".$h_type."' )" ) ) {
       echo "<script type = \"text/javascript\">
                    alert(\"Notification Sent\" );
                </script>";
     } else {
        echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
     //   echo "<script type = \"text/javascript\">
     //                alert(\"Notification Not Sent. \n
     //                Check and try again\" );
     //            </script>";
      }
  }

  function deleteNotification( $h_code) {}

  function getNotificationsType( $type) { ?>
  <title><?php _show_( ucfirst( $type) ); ?>'s  List [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getNotificationsBy = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hnotifications WHERE h_type = '".$type."' " );
    if ( $getNotificationsBy -> num_rows > 0) { ?>
      <div style="margin:1%;" >
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">NOTIFICATION</th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $notificationsDetails = mysqli_fetch_assoc( $getNotifications)){ ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $notificationsDetails['h_alias'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $notificationsDetails['h_by'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $notificationsDetails['h_created'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $notificationsDetails['h_status'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./notification?create=<?php _show_( $notificationsDetails['h_type'] ); ?>&code=<?php _show_( $notificationsDetails['h_author'] ); ?>" ><i class="material-icons">reply</i></a> 
        <a href="./notification?view=<?php _show_( $notificationsDetails['h_code'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
        <a href="tel:<?php _show_( $notificationsDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <!-- <a href="./notification?chat=<?php _show_( $notificationsDetails['h_author'] ); ?>" ><i class="material-icons">question_answer</i></a>  -->
        <a href="./notification?delete=<?php _show_( $notificationsDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody><?php 
      } ?>
        </table>
        </div><?php 
    } else { ?>
      <div style="margin:1%;" >
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">NOTIFICATION</th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>No <?php _show_( ucfirst( $type) ); ?>s Found</p></td>
        </tr>
        </tbody>
        </table>
        </div><?php 
    }
  }

  function getNotifications() { ?>
  <title>All Notifications [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getNotifications = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hnotifications ORDER BY h_created DESC" );
    if ( $getNotifications -> num_rows > 0) { ?>
      <div style="margin:1%;" >
        <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
          <thead>
            <tr>
              <th class="mdl-data-table__cell--non-numeric">NOTIFICATION</th>
              <th class="mdl-data-table__cell--non-numeric">BY</th>
              <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
              <th class="mdl-data-table__cell--non-numeric">STATUS</th>
              <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
            </tr>
          </thead><?php 
        while ( $notificationsDetails = mysqli_fetch_assoc( $getNotifications)){ ?>
          <tbody>
            <tr>
              <td class="mdl-data-table__cell--non-numeric">
                <?php _show_( $notificationsDetails['h_alias'] ); ?>
              </td>
              <td class="mdl-data-table__cell--non-numeric">
                <?php _show_( $notificationsDetails['h_by'] ); ?>
              </td>
              <td class="mdl-data-table__cell--non-numeric">
                <?php _show_( $notificationsDetails['h_created'] ); ?>
              </td>
              <td class="mdl-data-table__cell--non-numeric">
                <?php _show_( $notificationsDetails['h_status'] ); ?>
              </td>
              <td class="mdl-data-table__cell--non-numeric">
              <a href="./notification?create=<?php _show_( $notificationsDetails['h_type'] ); ?>&code=<?php _show_( $notificationsDetails['h_author'] ); ?>" ><i class="material-icons">reply</i></a> 
              <a href="./notification?view=<?php _show_( $notificationsDetails['h_code'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
              <a href="tel:<?php _show_( $notificationsDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
              <!-- <a href="./notification?chat=<?php _show_( $notificationsDetails['h_author'] ); ?>" ><i class="material-icons">question_answer</i></a>  -->
              <a href="./notification?delete=<?php _show_( $notificationsDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
              </td>
            </tr>
          </tbody><?php 
        } ?>
        </table>
      </div><?php 
    } else { ?>
      <div style="margin:1%;" >
        <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
          <thead>
            <tr>
              <th class="mdl-data-table__cell--non-numeric">NOTIFICATION</th>
              <th class="mdl-data-table__cell--non-numeric">BY</th>
              <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
              <th class="mdl-data-table__cell--non-numeric">STATUS</th>
              <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><p>No Notifications Found</p></td>
            </tr>
          </tbody>
        </table>
      </div><?php 
    }
  }

  function getNotificationCode( $code) {
    $getNotificationCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hnotifications WHERE h_code = '".$code."'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hnotifications SET h_status = 'read' WHERE h_code = '".$code."'" );
    if ( $getNotificationCode -> num_rows > 0) {
      while ( $notificationDetails = mysqli_fetch_assoc( $getNotificationCode)){ ?>
      <title><?php _show_( $notificationDetails['h_alias'] ); ?> [ <?php getOption( 'name' ); ?> ]</title>
        <div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text"><?php _show_( $notificationDetails['h_alias'] ); ?></h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a id="reply" href="./notification?create=<?php _show_( $notificationDetails['h_type'] ); ?>&code=<?php _show_( $notificationDetails['h_author'] ); ?>" ><i class="material-icons">reply</i></a>
                                <a id="chat" href="./notification?chat=<?php _show_( $notificationDetails['h_author'] ); ?>" ><i class="material-icons">question_answer</i></a>
                                <a id="delete" href="./notification?delete=<?php _show_( $notificationDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
                            </div>

                            <div class="mdl-tooltip" for="reply" >Reply to Notification</div>
                            <div class="mdl-tooltip" for="chat" >Chats</div>
                            <div class="mdl-tooltip" for="delete" >Delete Notification</div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <blockquote><?php _show_( $notificationDetails['h_description'] ); ?></blockquote>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                            <h5>From: <?php _show_( $notificationDetails['h_email'] ); ?></h5>
                            <h5>Sent: <?php _show_( $notificationDetails['h_created'] ); ?></h5>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?> mdl-card mdl-shadow--2dp mdl-card--expand"><?php 
                  $getNotes = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hnotifications LIMIT 5" );
                  if ( $getNotes -> num_rows >= 0) { ?>
                    <div class="mdl-card__title">
                    <i class="material-icons">query_builder</i>
                      <span class="mdl-button">Recent Notifications</span>
                    <div class="mdl-layout-spacer"></div>
                      <div class="mdl-card__subtitle-text">
                        <i class="material-icons">notifications</i>
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
                                <a href="./notification?create=note&code=<?php _show_( $note['h_author'] ); ?>" ><i class="material-icons">reply</i></a> 
                                <a href="./notification?view=<?php _show_( $note['h_code'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
                                <a href="./notification?delete=<?php _show_( $note['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
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
                </div><?php 
      }
    } else {
      echo 'Notification Not Found';
    }
  }

  function getChatCode( $code) {
    $getNotificationCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hnotifications WHERE h_type='chat' AND h_author = '".$code."' " );
    if ( $getNotificationCode -> num_rows > 0) {
      echo '<div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">';
      while ( $notificationDetails = mysqli_fetch_assoc( $getNotificationCode)){
        echo '<div class="mdl-card__title">
                <h2 class="mdl-card__title-text"> Chat with '.$notificationDetails['h_author'].'</h2>
              </div>';
        echo '<title>'.$notificationDetails['h_alias'].' [ JABALI Chats ]</title>';
        echo '
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <blockquote>'.$notificationDetails['h_description'].'</blockquote>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                            <h5>Sent: '.$notificationDetails['h_created'].'</h5>
                          </div>
                        </div>';
      }
            ?><div class="mdl-card__supporting-text mdl-card--expand">
                    <form enctype="multipart/form-data" name="notificationForm" method="POST" action="">
                      <title>Create Notification</title>
                        <input type="hidden" name="h_alias" value="Reply">
                        <input type="hidden" name="h_email" value="'.$_SESSION['myEmail'].'">
                        <input type="hidden" name="h_author" value="'.$_SESSION['myCode'].'">
                        <input type="hidden" name="h_for" value="'.$_GET['code'].'">
                        <input type="hidden" name="h_level" value="private">
                        <input type="hidden" name="h_type" value="chat">

                        <div class="input-field">
                          <p>Your Response</p>
                        <textarea id="notification" rows="5" name="h_desc"></textarea><script>CKEDITOR.replace( 'notification' );</script>
                        </div>

                        <a href="./notification?create=chat" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"style="float:left;"><i class="material-icons">chat</i></a>
                        <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" type="submit" name="create" style="float:right;"><i class="material-icons">send</i></button>
                    </form>
                </div><div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?> mdl-card mdl-shadow--2dp mdl-card--expand"><?php 
                  $getNotes = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hnotifications LIMIT 5" );
                  if ( $getNotes -> num_rows >= 0) { ?>
                    <div class="mdl-card__title">
                    <i class="material-icons">query_builder</i>
                      <span class="mdl-button">Recent Notifications</span>
                    <div class="mdl-layout-spacer"></div>
                      <div class="mdl-card__subtitle-text">
                        <i class="material-icons">notifications</i>
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
                                <a href="./notification?create=note&code=<?php _show_( $note['h_author'] ); ?>" ><i class="material-icons">reply</i></a> 
                                <a href="./notification?view=<?php _show_( $note['h_code'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
                                <a href="./notification?delete=<?php _show_( $note['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
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
        </div><?php 
    } else {
      echo 'Chat Not Found';
    }
  }
}
