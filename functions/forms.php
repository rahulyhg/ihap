<?php
/*
*User Forms
*/

class _hForms {

  function logoutForm() {
    echo '<div style="padding-top:40px;" >
    <div id="login_div">
    <form method="post">

    <button><i class="mdi-plus prefix"></i></button> <button><i class="mdi-login prefix"></i></button>

    <p>
    <a href="./register" id="register">Register Now!</a>
    <a href="./forgot" id="forgot">Forgot password?</a>
    </p>

    <br>
    <br>
    </form>
    </div>
    </div>';
  }

  
  function forgotForm() {
    echo '<div style="padding-top:40px;" >
    <div id="login_div">
    <form method="post">

    <div class="input-field">
    <i class="mdi-action-lock-outline prefix"></i>
    <input id="password" type="password">
    <label for="password">Email</label>
    </div>

    <div class="input-field">
    <button class="btn waves-effect waves-light" type="submit" name="action">SUBMIT</button>
    </div>

    <p>
    <a href="#" id="register">Register Now!</a>
    <a href="#" id="forgot">Login</a>
    </p>

    <br>
    <br>
    </form>
    </div>
    </div>';
  }
  
  function resetForm() {
    echo '<div style="padding-top:40px;" >
    <div id="login_div">
    <form method="post">

    <div class="input-field">
    <i class="mdi-action-lock-outline prefix"></i>
    <input id="password" type="password">
    <label for="password">New Password</label>
    </div>

    <div class="input-field">
    <i class="mdi-action-lock-outline prefix"></i>
    <input id="password" type="password">
    <label for="password">Repeat Password</label>
    </div>

    <div class="input-field">
    <button class="btn waves-effect waves-light" type="submit" name="action">RESET</button>
    </div>

    <p>
    <a href="#" id="register">Register Now!</a>
    <a href="#" id="forgot">Login</a>
    </p>

    <br>
    <br>
    </form>
    </div>
    </div>';
  }
  
  function aboutForm() {
    echo '<div style="padding-top:40px;" >
    <div id="login_div">
    <form method="post">

    <button><i class="mdi-plus prefix"></i></button> <button><i class="mdi-login prefix"></i></button>

    <p>
    <a href="#" id="register">Register Now!</a>
    <a href="#" id="forgot">Forgot password?</a>
    </p>

    <br>
    <br>
    </form>
    </div>
    </div>';
  }
  
  
  //Users class
  function typeSummary() {
  }
  
  function getTypes() {
  }
  
  function getCount() {
  }
  
  function getCountby($status) {
  }
  
  function listUsers($by) {
  }
  
  function lastLogin() {
  }
  
  function messageForm() {
    
    $getUser = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE h_code = '".$GET['code']."'");
    if($getUser -> num_rows > 0) {
      $h_email = ""; $h_alias = "";
        while ($userDeets = mysqli_fetch_assoc($getUser)){
                $h_email = $userDeets['h_alias'];
                $h_email = $userDeets['h_email'];
        }
    }
      
            ?><div class="mdl-grid">
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand">
                  <div class="mdl-card__supporting-text mdl-card--expand">
                      <form name="messageForm" method="POST" action="">
                        <title>Compose <?php echo ucfirst($_GET['create']); ?> [ IHAP ]</title>
                          <div class="input-field">
                          <input id="subject" type="text" name="h_alias" >
                          <label for="email" data-error="wrong" data-success="right" class="center-align">Subject</label>
                          </div>

                          <div class="input-field">
                          <input class="active" id="for" type="text" name="h_email" value="<?php echo $h_email; ?>" >
                          <label for="for" data-error="wrong" data-success="right" class="center-align">For</label>
                          </div>
                          <input type="hidden" name="h_author" value="<?php echo $_SESSION['myCode']; ?>">
                          <input type="hidden" name="h_by" value="<?php echo $_SESSION['myAlias']; ?>">
                          <input type="hidden" name="h_for" value="<?php echo $_GET['code']; ?>">
                          <input type="hidden" name="h_level" value="private">
                          <input type="hidden" name="h_type" value="<?php echo $_GET['create']; ?>">

                          <div class="input-field">
                          <p>Your Message</p>
                          <textarea class="mdl-textfield__input" type="text" id="message" rows="5" name="h_desc"></textarea><script>CKEDITOR.replace( 'message' );</script>
                          </div>

                          <div class="input-field">
                          <button class="btn waves-effect waves-light" type="submit" name="create"><i class="material-icons">send</i></button>
                          </div>
                      </form>
                  </div>
              </div>
              <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone ">
              <?php
                  $getNotes = mysqli_query($GLOBALS['conn'], "SELECT * FROM hmessages");
                  if ($getNotes -> num_rows >= 0) {
                    echo '<h4 class="mdl-card mdl-shadow--2dp">Recent Messages</h4>';
                    while ($note = mysqli_fetch_assoc($getNotes)) {
                      echo '<div class="mdl-card mdl-shadow--2dp mdl-card--expand">
                          <h5>('.$note['h_created'].') '.$note['h_alias'].'</h5><br><blockquote class="center-align">'
                          .$note['h_description'].'
                          </blockquote>
                          <div class="center-align"">
                          <a href="./message?create=message&code='.$note['h_author']. '" ><i class="material-icons">reply</i></a> <a href="./message?view='.$note['h_code']. '" ><i class="material-icons">account_circle</i></a> <a href="tel:'.$note['h_phone']. '" ><i class="material-icons">phone</i></a> <a href="./message?chat='.$note['h_author']. '" ><i class="material-icons">mail_outline</i></a> <a href="./notification?delete='.$notificationsDetails['id'].'" ><i class="material-icons">delete</i></a>
                          </div>
                          </div><br>';
                    }
                  } else {
                    echo "No Messages";
                  }
                ?>
              </div>
          </div><?php
  }


  function articleForm() {  
    ?><div class="mdl-grid">
            <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand">
                <div class="mdl-card__supporting-text mdl-card--expand">
                    <form name="messageForm" method="POST" action="" class="mdl-grid">
                      <title>New <?php echo ucfirst($_GET['create']); ?> [ IHAP ]</title>
                      <div class="mdl-cell mdl-cell--7-col-desktop mdl-cell--7-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand">
                        <div class="mdl-cell mdl-cell--12-col">
                        <div class="input-field">
                        <input id="h_alias" type="text" name="h_alias" >
                        <label for="h_alias" data-error="wrong" data-success="right" class="center-align">Title</label>
                        </div>

                        <div class="input-field">
                        <input id="h_subtitle" type="text" name="h_subtitle" >
                        <label for="h_subtitle" data-error="wrong" data-success="right" class="center-align">Subtitle(Optional)</label>
                        </div>

                        <?php
                        if ($_GET['create'] == "article") { ?>

                        <div class="input-field inline">
                        <input id="h_category" type="text" name="h_category" >
                        <label for="h_category" data-error="wrong" data-success="right" class="center-align">Category</label>
                        </div>

                        <div class="input-field inline">
                        <textarea id="h_tags" type="text" name="h_tags" ></textarea>
                        <label for="h_tags" data-error="wrong" data-success="right" class="center-align">Tags</label>
                        </div>

                        <?php } ?>
                      </div>
                      </div>
                      <div class="mdl-cell mdl-cell--5-col-desktop mdl-cell--5-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand">

                        <div class="input-field inline">
                        <div style="height:0px;overflow:hidden">
                        <input id="h_avatar" type="file" name="h_avatar" >
                        </div>
                        <img onclick="chooseFile();" src="../assets/images/placeholder.svg" width="100%"></i>
                        </div>
                        <script>
                             function chooseFile() {
                                $("#h_avatar").click();
                             }
                          </script>
                      </div>
                        <input type="hidden" name="h_type" value="<?php echo $_GET['create']; ?>" >
                        <input type="hidden" name="h_author" value="<?php echo $_SESSION['myCode']; ?>">
                        <input type="hidden" name="h_by" value="<?php echo $_SESSION['myAlias']; ?>">
                        <input type="hidden" name="h_center" value="<?php echo $_SESSION['myCenter']; ?>">
                        <input type="hidden" name="h_level" value="public">
                        <input type="hidden" name="h_location" value="<?php echo $_SESSION['myLocation']; ?>">
                        <input type="hidden" name="h_phone" value="<?php echo $_SESSION['myPhone']; ?>">
                        <input type="hidden" name="h_type" value="<?php echo $_GET['create']; ?>">

                        <div class="mdl-cell mdl-cell--12-col">
                        <div class="input-field">
                        <p><?php echo ucfirst($_GET['create']); ?> Content</p>
                        <textarea class="mdl-textfield__input" type="text" id="message" rows="5" name="h_desc"></textarea><script>CKEDITOR.replace( 'message' );</script>
                        <br>
                        <button class="btn waves-effect waves-light" type="submit" name="create"><i class="material-icons">save</i></button>
                        </div>
                      </div>

                    </form>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone ">
            <?php
                $getNotes = mysqli_query($GLOBALS['conn'], "SELECT * FROM harticles WHERE h_status='published' AND h_type = '".$_GET['create']."'");
                echo '<h4 class="mdl-card mdl-shadow--2dp">Recently Published '.ucfirst($_GET['create']).'s</h4>';
                if ($getNotes -> num_rows > 0) {
                  while ($note = mysqli_fetch_assoc($getNotes)) {
                    echo '<div class="mdl-card mdl-shadow--2dp mdl-card--expand" syle="display:inline-flex">
                        <h5>('.$note['h_created'].') '.$note['h_alias'].'  <span><a href="./message?create='.$note['h_author']. '" ><i class="material-icons">reply</i></a> <a href="./message?view='.$note['h_code']. '" ><i class="material-icons">account_circle</i></a> <a href="tel:'.$note['h_phone']. '" ><i class="material-icons">phone</i></a> <a href="./message?chat='.$note['h_author']. '" ><i class="material-icons">mail_outline</i></a> <a href="./notification?delete='.$notificationsDetails['id'].'" ><i class="material-icons">delete</i></a></span>
                        </h5></div>
                        </div><br>';
                  }
                } else {
                  echo '<div class="mdl-card mdl-shadow--2dp mdl-card--expand">No '.ucfirst($_GET['create']).'s Found</div>';
                }
              ?>
            </div>
        </div><?php
  }

function notificationForm() {
  $getUser = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE h_code = '".$GET['create']."'");
  if($getUser -> num_rows > 0) {
      while ($userDeets = mysqli_fetch_assoc($getUser)){
              $h_email = $userDeets['h_email'];
          }
  }
    
    ?><div class="mdl-grid">
            <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand">
                <div class="mdl-card__supporting-text mdl-card--expand">
                    <form name="messageForm" method="POST" action="">
                      <title>New Notification</title>
                        <div class="input-field">
                        <input id="subject" type="text" name="h_alias" >
                        <label for="email" data-error="wrong" data-success="right" class="center-align">Subject</label>
                        </div>

                        <div class="input-field">
                        <input id="for" type="text" name="h_email" value="<?php echo $h_email; ?>" >
                        <label for="for" data-error="wrong" data-success="right" class="center-align">For</label>
                        </div>
                        <input type="hidden" name="h_author" value="<?php echo $_SESSION['myCode']; ?>">
                        <input type="hidden" name="h_for" value="<?php echo $_GET['create']; ?>">
                        <input type="hidden" name="h_level" value="private">
                        <input type="hidden" name="h_type" value="message">

                        <div class="input-field">
                        <textarea id="message" rows="5" name="h_desc"></textarea>
                        <label for="message" data-error="wrong" data-success="right" class="center-align">Your Note</label>
                        </div>

                        <div class="input-field">
                        <button class="btn waves-effect waves-light" type="submit" name="create"><i class="material-icons">send</i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
            <?php
                $getNotes = mysqli_query($GLOBALS['conn'], "SELECT * FROM hnotifications");
                if ($getNotes -> num_rows >= 0) {
                  echo '<h4 class="mdl-card mdl-shadow--2dp">Recent Notifications</h4>';
                  while ($note = mysqli_fetch_assoc($getNotes)) {
                    echo '<div class="mdl-card mdl-shadow--2dp mdl-card--expand">
                        <h5>('.$note['h_created'].') '.$note['h_alias'].'</h5><br><blockquote class="center-align">'
                        .$note['h_description'].'
                        </blockquote>
                        <div class="center-align"">
                        <a href="./message?create='.$note['h_author']. '" ><i class="material-icons">reply</i></a> <a href="./message?view='.$note['h_code']. '" ><i class="material-icons">account_circle</i></a> <a href="tel:'.$note['h_phone']. '" ><i class="material-icons">phone</i></a> <a href="./message?chat='.$note['h_author']. '" ><i class="material-icons">mail_outline</i></a> <a href="./notification?delete='.$notificationsDetails['id'].'" ><i class="material-icons">delete</i></a>
                        </div>
                        </div><br>';
                  }
                } else {
                  echo "No Messages";
                }
              ?>
            </div>
        </div><?php
  }

  function userForm() {

        echo '<title>'.$userDetails['h_alias'].' Create '.$_GET['create'].' [ IHAP ]</title>';
        ?><form name="registerUser" method="POST" action="" class="mdl-grid" >
                <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor($_SESSION['myCode']); ?>">
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">

                            <div class="input-field">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="fname" name="fname" type="text" >
                            <label for="fname">First Name</label>
                            </div>
                                   
                            <div class="input-field">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="lname" name="lname" type="text">
                            <label for="lname">Last Name</label>
                            </div>                            

                            <div class="input-field inline">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input class="mdl-textfield__input mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select" type="text" name="h_type" id="h_type" value="" list="post_types">
                            <div class="mdl-card">
                            <datalist id="post_types">
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="doctor">Doctor</option>
                            <option value="nurse">Nurse</option>
                            <option value="inpatient">Patient (Admit)</option>
                            <option value="outpatient">Patient (Outpatient)</option>
                            </datalist>
                            </div>
                            <label for="h_type">Type</label>
                            </div>

                            <div class="input-field mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                            <input class="mdl-textfield__input" type="text" id="counties" name="h_location" readonly tabIndex="-1">
                            <ul for="counties" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                <?php 
                                $county_list = "mombasa, kwale, kilifi, tana river, lamu, taita-taveta, garissa, wajir, mandera, marsabit, isiolo, meru, tharaka-nithi, embu, kitui, machakos, makueni, nyandarua, ol kalou, nyeri, kirinyanga, muranga, kiambu, turkana, west pokot, kapenguria, samburu, trans-nzoia, uasin-gishu, elgeyo-marakwet, nandi, baringo, laikipia, nakuru, narok, kajiado, kericho, bomet, kakamega, vihiga, bungoma, busia, siaya, kisumu, homa bay, migori, kisii, nyamira, nairobi";
                                $counties = explode(",", $county_list);
                                for ($c=0; $c < count($counties); $c++) {
                                    $label = ucwords($counties[$c]);
                                    echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
                                }
                                 ?>
                            </ul>
                            <label for="h_location">Select County</label>
                            </div>

                            <div class="input-field inline">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="h_center" name="h_center" type="text" >
                            <label for="h_center">Center</label>
                            </div>

                            <div class="input-field">
                            <i class="mdi-social-person-outline prefix"></i>
                            <input class="validate" id="email" name="h_email" type="email" >
                            <label for="email" data-error="wrong" data-success="right" class="center-align">Email Address</label>
                            </div>

                            <div class="input-field">
                            <i class="mdi-social-person-outline prefix"></i>
                            <input  id="h_phone" name="h_phone" type="text" >
                            <label for="h_phone" data-error="wrong" data-success="right" class="center-align">Phone Number</label>
                            </div>

                            <div class="input-field">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="password" name=="h_password" type="text" >
                            <label for="password">Password</label>
                            </div>

                            <br>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">                            
                          <script>
                             function chooseFile() {
                                $("#fileInput").click();
                             }
                          </script>                        
                        <div class="input-field inline">
                        <div style="height:0px;overflow:hidden">
                        <input id="h_avatar" type="file" name="h_avatar" >
                        </div>
                        <img onclick="chooseFile();" src="../assets/images/placeholder.svg" width="100%"></i>
                        </div>
                        <script>
                             function chooseFile() {
                                $("#h_avatar").click();
                             }
                          </script>

                            <div class="input-field center-align">
                            <input type="checkbox" id="remember-me" name="h_status" name="active"/>
                            <label for="remember-me">Activate Account</label>
                            </div>
                            <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" type="submit" style="margin-left: 150px;margin-top: 100px;" name="create"><i class="material-icons">save</i></button>
                        

                        </div>
                    </div>
                </div>
                </form><?php
  }

  function editUserForm($code) {
    $getUserCode = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE h_code = '".$code."'");
    if($getUserCode -> num_rows > 0) {
      while ($userDetails = mysqli_fetch_assoc($getUserCode)){
        $names = explode(" ", $userDetails['h_alias']);

        ?><title>Editing <? show( $userDetails['h_alias'].' [ IHAP ]</title>' ) ?>;
        <form name="registerUser" method="POST" action="" class="mdl-grid" >
                <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor($_SESSION['myCode']); ?>">

                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid ">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">

                            <div class="input-field inline">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="fname" name="fname" type="text" value="<?php show( $names[0] ); ?>">
                            <label for="fname">First Name</label>
                            </div>
                                   
                            <div class="input-field inline">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="lname" name="lname" type="text" value="<?php show( $names[1] ); ?>">
                            <label for="lname">Last Name</label>
                            </div>
                                   
                            <div class="input-field inline">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="h_type" name="h_type" type="text" value="<?php show( ucfirst($userDetails['h_type']) ); ?>">
                            <label for="h_type">Type</label>
                            </div>

                            <div class="input-field inline">
                            <i class="mdi-social-person-outline prefix"></i>
                            <input  id="h_phone" name="h_phone" type="text" value="<?php show( $userDetails['h_phone'] ); ?>">
                            <label for="h_phone" data-error="wrong" data-success="right" class="center-align">Phone Number</label>
                            </div>

                            <div class="input-field inline">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="h_center" name="h_center" type="text" value="<?php show( $userDetails['h_center'] ); ?>">
                            <label for="h_center">Center</label>
                            </div>

                            <div class="input-field inline">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="h_location" name="h_location" type="text" value="<?php show( $userDetails['h_location'] ); ?>">
                            <label for="h_location">Location</label>
                            </div>

                            <div class="input-field">
                            <i class="mdi-social-person-outline prefix"></i>
                            <input class="validate" id="email" name="h_email" type="email" value="<?php show( $userDetails['h_email'] ); ?>">
                            <label for="email" data-error="wrong" data-success="right" class="center-align">Email Address</label>
                            </div>

                            <div class="input-field">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="password" name=="h_password" type="password" value="<?php show( $userDetails['h_password'] ); ?>">
                            <label for="password">Password</label>
                            </div>

                            <div class="input-field">
                            <i class="mdi-action-lock-outline prefix mdl-color--white"></i>
                            <textarea class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" rows="5" id="h_description" name="h_description" ><?php show( $userDetails['h_description'] ) ?></textarea>
                            <script>CKEDITOR.replace( "h_description" );</script>
                            <label for="h_description">Bio</label>
                            </div>

                            <br>
                            </div>

                            <script>
                               function chooseFile() {
                                  $("#fileInput").click();
                               }
                            </script>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                            <div style="height:0px;overflow:hidden">
                               <input type="file" id="fileInput" name="h_avatar" />
                            </div>
                            <img src="<?php show( $userDetails['h_avatar'] ); ?>" width="100%" onclick="chooseFile();">
                            <center><a href=""><h6>Click on image to change</h6></a>

                            <div class="input-field">
                                <button type="submit" name="update" class="mdl-button mdl-button--fab"><i class="material-icons">save</i></button>
                            </div></center>
                          </div>
                        </div>
                    </div>
                </div>
                </form><?php
      }
    } else {
      echo 'User Not Found';
    }
  }

} 