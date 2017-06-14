<?php 

class _hMessages {
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

  
  function createMessage() {

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
    $h_link = hPORTAL."message?view=".$h_code;
    $h_phone = $_POST['h_phone'];
    $h_status = "unread";
    $h_type = $_POST['h_type'];

     if ( mysqli_query( $GLOBALS['conn'], "INSERT INTO hmessages (h_alias, h_author, h_by, h_code, h_created, h_description, h_email, h_for, h_key, h_level, h_link, h_phone, h_status, h_type) 
    VALUES ('".$h_alias."', '".$h_author."', '".$h_by."', '".$h_code."', '".$h_created."', '".$h_desc."', '".$h_email."', '".$h_for."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_phone."', '".$h_status."', '".$h_type."' )" ) ) {
       echo "<script type = \"text/javascript\">
                    alert(\"Message Sent\" );
                </script>";
     } else {
       echo '<script type = \"text/javascript\">
              alert(\"Error: "'.$GLOBALS['conn']->error.'!\" );
          </script>';
      }
  }

  function deleteMessage( $h_code) {}

  function getMessagesType( $type) { ?>
  <title><?php _show_( ucfirst( $type) ); ?>'s  List - <?php getMsgCount(); ?> Unread [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getMessagesBy = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmessages WHERE (h_type = '".$type."' AND h_for = '".$_SESSION['myCode']."' ) " );
    if ( $getMessagesBy -> num_rows > 0) { ?>
      <div style="margin:1%;" >
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $messagesDetails = mysqli_fetch_assoc( $getMessagesBy)){ ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $messagesDetails['h_alias'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $messagesDetails['h_by'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $messagesDetails['h_created'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $messagesDetails['h_status'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./message?create=<?php _show_( $messagesDetails['h_type'] ); ?>&code=<?php _show_( $messagesDetails['h_author'] ); ?>" ><i class="material-icons">reply</i></a> 
        <a href="./message?view=<?php _show_( $messagesDetails['h_code'] ); ?>&key=<?php _show_( $messagesDetails['h_alias'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
        <a href="tel:<?php _show_( $messagesDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?chat=<?php _show_( $messagesDetails['h_author'] ); ?>" ><i class="material-icons">question_answer</i></a>
        <a href="./message?delete=<?php _show_( $messagesDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
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
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
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

  function getMessages() { ?>
    <title>All Messages - <?php getMsgCount(); ?> Unread [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getMessages = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmessages WHERE h_for = '".$_SESSION['myCode']."' ORDER BY h_created DESC" );
    if ( $getMessages -> num_rows > 0) { ?>
      <div style="margin:1%;" >
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $messagesDetails = mysqli_fetch_assoc( $getMessages)){ ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $messagesDetails['h_alias'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $messagesDetails['h_by'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $messagesDetails['h_created'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $messagesDetails['h_status'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./message?create=<?php _show_( $messagesDetails['h_type'] ); ?>&code=<?php _show_( $messagesDetails['h_author'] ); ?>" ><i class="material-icons">reply</i></a> 
        <a href="./message?view=<?php _show_( $messagesDetails['h_code'] ); ?>&key=<?php _show_( $messagesDetails['h_alias'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
        <a href="tel:<?php _show_( $messagesDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <!-- <a href="./message?chat=<?php _show_( $messagesDetails['h_author'] ); ?>" ><i class="material-icons">question_answer</i></a>  -->
        <a href="./message?delete=<?php _show_( $messagesDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
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
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>Looks like you haven't received any message.</p></td>
        <td><p>Check back later?</p></td>
        </tr>
        </tbody>
        </table>
        </div><?php 
    }
  }

  function getSentMessages() { ?>
    <title>Sent Messages [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getMessages = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmessages WHERE h_author = '".$_SESSION['myCode']."' ORDER BY h_created DESC" );
    if ( $getMessages -> num_rows > 0) { ?>
      <div style="margin:1%;" >
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $messagesDetails = mysqli_fetch_assoc( $getMessages)){ ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $messagesDetails['h_alias'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $messagesDetails['h_created'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $messagesDetails['h_status'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./message?create=<?php _show_( $messagesDetails['h_type'] ); ?>&code=<?php _show_( $messagesDetails['h_for'] ); ?>" ><i class="material-icons">reply</i></a>
        <a href="./message?chat=<?php _show_( $messagesDetails['h_for'] ); ?>" ><i class="material-icons">question_answer</i></a>
        <a href="./message?delete=<?php _show_( $messagesDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
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
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
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

  function getUnreadMessages() { ?>
    <title>Unread Messages - <?php getMsgCount(); ?> [ <?php getOption( 'name' ); ?> ]</title><?php 
    $getMessages = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmessages WHERE (h_status = 'unread' AND h_for = '".$_SESSION['myCode']."' ) ORDER BY h_created DESC" );
    if ( $getMessages -> num_rows > 0) { ?>
      <div style="margin:1%;" >
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $messagesDetails = mysqli_fetch_assoc( $getMessages)){ ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $messagesDetails['h_alias'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $messagesDetails['h_by'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $messagesDetails['h_created'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $messagesDetails['h_status'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./message?create=<?php _show_( $messagesDetails['h_type'] ); ?>&code=<?php _show_( $messagesDetails['h_author'] ); ?>" ><i class="material-icons">reply</i></a> 
        <a href="./message?view=<?php _show_( $messagesDetails['h_code'] ); ?>&key=<?php _show_( $messagesDetails['h_alias'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
        <a href="tel:<?php _show_( $messagesDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <!-- <a href="./message?chat=<?php _show_( $messagesDetails['h_author'] ); ?>" ><i class="material-icons">question_answer</i></a>  -->
        <a href="./message?delete=<?php _show_( $messagesDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
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
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td>
        <center><i class="material-icons">done_all</i><p>Oops! You have read all your messages.</p></center>
        </td>
        </tr>
        </tbody>
        </table>
        </div><?php 
    }
  }

  function getMessageCode( $code) {
    $getMessageCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmessages WHERE h_code = '".$code."'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hmessages SET h_status = 'read' WHERE h_code = '".$code."'" );
    if ( $getMessageCode -> num_rows > 0) {
      while ( $messageDetails = mysqli_fetch_assoc( $getMessageCode)){ ?>
      <title><?php _show_( $messageDetails['h_alias'] ); ?> [ <?php getOption( 'name' ); ?> ]</title>
        <div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text"><?php _show_( $messageDetails['h_alias'] ); ?></h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a id="reply" href="./message?create=<?php _show_( $messageDetails['h_type'] ); ?>&code=<?php _show_( $messageDetails['h_author'] ); ?>" ><i class="material-icons">reply</i></a>
                                <!-- <a id="chat" href="./message?chat=<?php _show_( $messageDetails['h_author'] ); ?>" ><i class="material-icons">question_answer</i></a> -->
                                <a id="delete" href="./message?delete=<?php _show_( $messageDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
                            </div>

                            <div class="mdl-tooltip" for="reply" >Reply to Message</div>
                            <div class="mdl-tooltip" for="chat" >Chats</div>
                            <div class="mdl-tooltip" for="delete" >Delete Message</div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <blockquote><?php _show_( $messageDetails['h_description'] ); ?></blockquote>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                            <h5>From: <?php _show_( $messageDetails['h_email'] ); ?></h5>
                            <h5>Sent: <?php _show_( $messageDetails['h_created'] ); ?></h5>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                        <div class="mdl-card__title">
                        <i class="material-icons">business</i>
                          <?php _show_( $_SESSION['myCenter'] ); ?>
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text mdl-button">
                                <i class="material-icons">room</i>
                                <?php _show_( $_SESSION['myLocation'] ); ?>
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                            Messages and latest chats go here
                        </div>
                    </div>
                </div>
                </div><?php 
      }
    } else {
      echo 'Message Not Found';
    }
  }

  function getChatCode( $code) {
    $getMessageCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmessages WHERE h_author = '".$code."'" );
    if ( $getMessageCode -> num_rows > 0) {
      while ( $messageDetail = mysqli_fetch_assoc( $getMessageCode)){
        $messageDetails[] = $messageDetail;
      }
    } else {
      echo 'Chat Not Found';
    }

    if ( !empty( $messageDetails) ) { ?>
    <div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                    <div class="mdl-card__title">
                <h2 class="mdl-card__title-text"> Chat with <?php _show_( $messageDetails[0]['h_by'] ); ?></h2>
              </div>
              <title><?php _show_( $messageDetails[0]['h_by'] ); ?> [ JABALI Chats ]</title><?php 
        foreach ( $messageDetails as $message) { ?>
        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                  <div><?php _show_( $message['h_description'] ); ?>
                  <span class="alignright" >Sent: <?php _show_( $message['h_created'] ); ?></span></div>
                </div>
              </div><?php } ?>
              <div class="mdl-card__supporting-text mdl-card--expand">
                    <form enctype="multipart/form-data" name="messageForm" method="POST" action="">
                      <title>Create Message</title>
                        <input type="hidden" name="h_alias" value="Reply">
                        <input type="hidden" name="h_email" value="<?php _show_( $_SESSION['myEmail'] ); ?>">
                        <input type="hidden" name="h_author" value="<?php _show_( $_SESSION['myCode'] ); ?>">
                        <input type="hidden" name="h_for" value="<?php _show_( $_GET['code'] ); ?>">
                        <input type="hidden" name="h_level" value="private">
                        <input type="hidden" name="h_type" value="chat">

                        <div class="input-field">
                          <p>Your Response</p>
                        <textarea id="message" rows="5" name="h_desc"></textarea><script>CKEDITOR.replace( 'message' );</script>
                        </div>
                        <br>
                        <a href="./message?create=chat" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect "style="float:left;"><i class="material-icons">chat</i></a>
                        <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect " type="submit" name="create" style="float:right;"><i class="material-icons">send</i></button>
                    </form>
                </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?> mdl-card"><?php 
                  $getNotes = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmessages LIMIT 5" );
                  if ( $getNotes -> num_rows >= 0) { ?>
                    <div class="mdl-card__title">
                    <i class="material-icons">query_builder</i>
                      <span class="mdl-button">Recent Messages</span>
                    <div class="mdl-layout-spacer"></div>
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
                    echo "No Messages";
                  } ?>
              </div>
                </div><?php 
    }
  }
}
