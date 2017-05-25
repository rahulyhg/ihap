<?php

class _hMessages {
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

  
  function createMessage() {

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
    $h_link = hPORTAL."message?view=$h_code";
    $h_status = "unread";
    $h_type = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_type']);

    $createMessage = "INSERT INTO hmessages (h_alias, h_author, h_by, h_code, h_created, h_description, h_email, h_key, h_level, h_link, h_phone h_status, h_type) 
    VALUES ('".$h_alias."', '".$h_author."', '".$h_by."', '".$h_code."', '".$h_created."', '".$h_desc."', '".$h_email."', '".$h_key."', '".$h_level."', '".$_SESSION['myPhone']."', '".$h_link."', '".$h_status."', '".$h_type."')";
     if (mysqli_query($conn, $createMessage)) {
       echo "<script type = \"text/javascript\">
                    alert(\"Message Sent\");
                </script>";
     } else {
       echo "<script type = \"text/javascript\">
                    alert(\"Check and try again\");
                </script>";
     }
  }

  function updateMessage($h_code) {
    
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
    $h_link = hPORTAL."message?view=$h_key&action=view"; 
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

    $updateMessage = mysqli_query($GLOBALS['conn'], "UPDATE hmessages SET h_var='".$h_var."', h_var='".$h_var."' WHERE h_code='".$h_code."'");
    // if (!$updateMessage ->conn_error) {
    //   echo '<div><p>Message Created Successfuly!</p></div>';
    // } else {
    //   echo '<div><p>Error!</p>'.$updateMessage ->conn_error.'</div>';
    // }
  }

  
  function deleteMessage($h_code) {
    
    $deleteMessage = mysqli_query($GLOBALS['conn'], "DELETE FROM hmessages WHERE h_code='".$h_code."'");
    if (!$createMessage ->conn_error) {
      echo '<div><p>Message Created Successfuly!</p></div>';
    } else {
      echo '<div><p>Error!</p>'.$deleteMessage ->conn_error.'</div>';
    }
  }

  function getMessagesType($type) {

    echo '<title>'.ucfirst($type).'s List | IHAP</title>';
    $getMessagesBy = mysqli_query($GLOBALS['conn'], "SELECT * FROM hmessages WHERE h_status = 'active' AND h_type='".$type."'");
    if($getMessagesBy -> num_rows > 0) {
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
      while ($messagesDetails = mysqli_fetch_assoc($getMessagesBy)){
        echo '
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">'
        .$messagesDetails['h_messagename']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$messagesDetails['h_email']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$messagesDetails['h_phone']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$messagesDetails['h_location']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./message?create='.$messagesDetails['h_type']. '&code='.$messagesDetails['h_author'].'" ><i class="material-icons">reply</i></a> <a href="./message?view='.$messagesDetails['h_code']. '" ><i class="material-icons">account_circle</i></a> <a href="tel:'.$messagesDetails['h_phone']. '" ><i class="material-icons">phone</i></a> <a href="./message?chat='.$messagesDetails['h_author']. '" ><i class="material-icons">message</i></a> <a href="./message?delete='.$messagesDetails['id'].'" ><i class="material-icons">delete</i></a>
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

  function getMessages() {
    echo "<title>All Messages | IHAP</title>";
    $getMessages = mysqli_query($GLOBALS['conn'], "SELECT * FROM hmessages ORDER BY h_created DESC");
    if($getMessages -> num_rows > 0) {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">FROM</th>
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
      while ($messagesDetails = mysqli_fetch_assoc($getMessages)){
        echo '
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">'
        .$messagesDetails['h_email']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$messagesDetails['h_description']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$messagesDetails['h_created']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$messagesDetails['h_status']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./message?create='.$messagesDetails['h_type']. '&code='.$messagesDetails['h_author']. '" ><i class="material-icons">reply</i></a> <a href="./message?view='.$messagesDetails['h_code']. '" ><i class="material-icons">account_circle</i></a> <a href="tel:'.$messagesDetails['h_phone']. '" ><i class="material-icons">phone</i></a> <a href="./message?chat='.$messagesDetails['h_author']. '" ><i class="material-icons">message</i></a> <a href="./message?delete='.$messagesDetails['id']. '" ><i class="material-icons">delete</i></a>
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
        <td><p>No Messages Found</p></td>
        </tr>
        </tbody>';
         echo '
        </table></div>';
    }
  }

  function getChats() {
    echo "<title>All Chats | IHAP</title>";
    $getMessages = mysqli_query($GLOBALS['conn'], "SELECT * FROM hmessages WHERE h_type='chat' ORDER BY h_created DESC");
    if($getMessages -> num_rows > 0) {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">FROM</th>
        <th class="mdl-data-table__cell--non-numeric">LAST MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
      while ($messagesDetails = mysqli_fetch_assoc($getMessages)){
        echo '
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">'
        .$messagesDetails['h_email']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$messagesDetails['h_description']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$messagesDetails['h_created']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./message?create=chat&code='.$messageDetails['h_author']. '" ><i class="material-icons">reply</i></a> <a href="./message?chat='.$messagesDetails['h_author']. '" ><i class="material-icons">account_circle</i></a> <a href="tel:'.$messagesDetails['h_phone']. '" ><i class="material-icons">phone</i></a> <a href="./message?chat='.$messagesDetails['h_author']. '" ><i class="material-icons">message</i></a> <a href="./message?delete='.$messagesDetails['id']. '" ><i class="material-icons">delete</i></a>
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
        <td><p>No Chats Found</p></td>
        </tr>
        </tbody>';
         echo '
        </table></div>';
    }
  }

  function getMessageCode($code) {
    $getMessageCode = mysqli_query($GLOBALS['conn'], "SELECT * FROM hmessages WHERE h_code = '".$code."'");
    mysqli_query($GLOBALS['conn'], "UPDATE hmessages SET h_status = 'read' WHERE h_code = '".$code."'");
    if($getMessageCode -> num_rows > 0) {
      while ($messageDetails = mysqli_fetch_assoc($getMessageCode)){
        echo '<title>'.$messageDetails['h_alias'].' [ IHAP Messages ]</title>';
        echo '<div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">'.$messageDetails['h_alias'].'</h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a id="reply" href="./message?create='.$messageDetails['h_type']. '&code='.$messageDetails['h_author'].'" ><i class="material-icons">reply</i></a>
                                <a id="chat" href="./message?chat='.$messageDetails['h_author'].'" ><i class="material-icons">mail_outline</i></a>
                                <a id="delete" href="./message?delete='.$messageDetails['id'].'" ><i class="material-icons">delete</i></a>
                            </div>

                            <div class="mdl-tooltip" for="reply" >Reply to Message</div>
                            <div class="mdl-tooltip" for="chat" >Chats</div>
                            <div class="mdl-tooltip" for="delete" >Delete Message</div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <blockquote>'.$messageDetails['h_description'].'</blockquote>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                            <h5>From: '.$messageDetails['h_email'].'</h5>
                            <h5>Sent: '.$messageDetails['h_created'].'</h5>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                        <i class="material-icons">business</i>
                          '.$messageDetails['h_center'].'
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text mdl-button">
                                <i class="material-icons">room</i>
                                '.$messageDetails['h_location'].'
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                            Messages and latest chats go here
                        </div>
                    </div>
                </div>
                </div>';
      }
    } else {
      echo 'Message Not Found';
    }
  }

  function getChatCode($code) {
    $getMessageCode = mysqli_query($GLOBALS['conn'], "SELECT * FROM hmessages WHERE h_type='chat' AND (h_author = '".$code."')");
    mysqli_query($GLOBALS['conn'], "UPDATE hmessages SET h_status = 'read' WHERE h_code = '".$code."'");
    if($getMessageCode -> num_rows > 0) {
      echo '<div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">';
      while ($messageDetails = mysqli_fetch_assoc($getMessageCode)){
        echo '<div class="mdl-card__title">
                <h2 class="mdl-card__title-text"> Chat with '.$messageDetails['h_author'].'</h2>
              </div>';
        echo '<title>'.$messageDetails['h_alias'].' [ IHAP Chats ]</title>';
        echo '
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <blockquote>'.$messageDetails['h_description'].'</blockquote>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                            <h5>Sent: '.$messageDetails['h_created'].'</h5>
                          </div>
                        </div>';
      }
            ?><div class="mdl-card__supporting-text mdl-card--expand">
                    <form name="messageForm" method="POST" action="">
                      <title>Create Message</title>
                        <input type="hidden" name="h_alias" value="Reply">
                        <input type="hidden" name="h_email" value="'.$_SESSION['myEmail'].'">
                        <input type="hidden" name="h_author" value="'.$_SESSION['myCode'].'">
                        <input type="hidden" name="h_for" value="'.$_GET['code'].'">
                        <input type="hidden" name="h_level" value="private">
                        <input type="hidden" name="h_type" value="chat">

                        <div class="input-field">
                          <p>Your Response</p>
                        <textarea id="message" rows="5" name="h_desc"></textarea><script>CKEDITOR.replace( 'message' );</script>
                        </div>

                        <a href="./message?create=chat" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"style="float:left;"><i class="material-icons">chat</i></a>
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
      echo 'Chat Not Found';
    }
  }
}
