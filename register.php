<?php
session_start();
include 'header.php';

if (isset($_POST['create'])) {
    $date = date(YmdHms);
    if (isset($_SESSION['myEmail'])) {
      $email = $_SESSION['myEmail'];
    } else {
      $email = hEMAIL;
    }

    $hash = md5($email.$date);
    $code = substr($hash, 20);
    $abbr = substr($_POST['lname'], 0,1);

    $h_alias = $_POST['fname'].' '.$_POST['lname'];
    $h_author = $code;
    $h_avatar = hIMAGES.'avatar.svg';
    $h_center = $_POST['h_center'];
    $h_code = $code;
    $h_created = date(Ymd);
    $h_email = $_POST['h_email'];
    $h_key = $hash;
    $h_level = $_POST['h_level'];
    $h_link = hPORTAL."user?view=$h_code";
    $h_location = strtolower( $_POST['h_location'] );
    $h_password = md5($_POST['h_password']);
    $h_phone = $_POST['h_phone'];
    $h_status = "active"; //Sort emailuser();, Change to "pending"
    $h_style = "love";
    $h_type = strtolower( $_POST['h_type'] );
    $h_username = strtolower($_POST['fname'].$abbr);

    $conn = mysqli_connect( hDBHOST, hDBUSER, hDBPASS, hDBNAME );
    $sql = "INSERT INTO husers (h_alias, h_author, h_avatar, h_center, h_code, h_created, h_email, h_key, h_level, h_link, h_location, h_notes, h_password, h_phone, h_status, h_style, h_type, h_username) 
    VALUES ('".$h_alias."', '".$h_author."', '".$h_avatar."', '".$h_center."', '".$h_code."', '".$h_created."', '".$h_email."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_location."', '".$h_notes."', '".$h_password."', '".$h_phone."', '".$h_status."', '".$h_style."', '".$h_type."', '".$h_username."')";

  if (mysqli_query($conn, $sql)) {
    echo "<script type = \"text/javascript\">
                    alert(\"Account Created Successfully!\");
                </script>";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

?>
<title>Register [ IHAP ]</title>

<div style="padding-top:40px;" >
<div id="login_div">
<center><?php frontlogo(); ?></center>
    <center><ul id="tabs-swipe-demo" style="border-radius: 5px;" class="tabs">
        <li class="tab col s3"><a class="active" href="#test-swipe-1">Create Account</a></li>
        <li class="tab col s3"><a href="#test-swipe-2">Add Resource</a></li>
        <li class="tab col s3"><a href="#test-swipe-3">Request Service</a></li>
    </ul></center>
    <div id="test-swipe-1" class="col s12">
        <form name="registerUser" method="POST" action="">

        <div class="input-field">
        <i class="material-icons prefix">account_circle</i>
        <input id="fname" name="fname" type="text">
        <label for="fname">First Name</label>
        </div>
               
        <div class="input-field">
        <i class="material-icons prefix">account_circle</i>
        <input id="lname" name="lname" type="text">
        <label for="lname">Last Name</label>
        </div>

        <div class="input-field">
        <i class="material-icons prefix">mail_outline</i>
        <input class="validate" id="email" name="h_email" type="email">
        <label for="email" data-error="Please enter a valid email" data-success="OK!" class="center-align">Email Address</label>
        </div>

        <div class="input-field">
        <i class="material-icons prefix">phone</i>
        <input  id="h_phone" name="h_phone" type="text">
        <label for="h_phone" data-error="wrong" data-success="right" class="center-align">Phone Number</label>
        </div>

        <div class="input-field">
        <i class="material-icons prefix">lock</i>
        <input id="password" name=="h_password" type="text">
        <label for="password">Password</label>
        </div>

        <div class="input-field">
        <i class="material-icons prefix">lock</i>
        <input id="h_type" name="h_type" type="text">
        <label for="h_type">Type</label>
        </div>

        <div class="input-field">
        <i class="material-icons prefix">local_hospital</i>
        <input id="h_center" name="h_center" type="text">
        <label for="h_center">Center</label>
        </div>

        <div class="input-field mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
        <i class="material-icons prefix">room</i>
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
        </div>

        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="create">CREATE ACCOUNT</button>

        <br>
        </form>
    </div>

    <div id="test-swipe-2" class="col s12">
        <form name="registerResource" method="POST" action="">
        <div class="input-field">
        <i class="mdi-social-person-outline prefix"></i>
        <input class="validate" id="email" name="h_email" type="email">
        <label for="email" data-error="wrong" data-success="right" class="center-align">Enter Your Email</label>
        </div>

        <div class="input-field">
        <i class="mdi-action-lock-outline prefix"></i>
        <input id="fname" name="fname" type="text">
        <label for="fname">Your Name</label>
        </div>
               
        <div class="input-field">
        <i class="mdi-action-lock-outline prefix"></i>
        <input id="lname" name="lname" type="text">
        <label for="lname">Resource Name</label>
        </div>

        <div class="input-field">
        <i class="mdi-action-lock-outline prefix"></i>
        <input id="h_type" name="h_type" type="text">
        <label for="h_type">Type</label>
        </div>

        <div class="input-field">
        <i class="mdi-action-lock-outline prefix"></i>
        <input id="h_center" name="h_center" type="text">
        <label for="h_center">Center</label>
        </div>

        <input type="hidden" name="register"/>

        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="register">REGISTER RESOURCE</button>

        <br>
        </form>
    </div>


    <div id="test-swipe-3" class="col s12">
        <form name="registerService" method="POST" action="">
        <div class="input-field">
        <i class="mdi-social-person-outline prefix"></i>
        <input class="validate" id="email" name="h_email" type="email">
        <label for="email" data-error="wrong" data-success="right" class="center-align">Email Address</label>
        </div>

        <div class="input-field">
        <i class="mdi-action-lock-outline prefix"></i>
        <input id="fname" name="fname" type="text">
        <label for="fname">First Name</label>
        </div>
               
        <div class="input-field">
        <i class="mdi-action-lock-outline prefix"></i>
        <input id="lname" name="lname" type="text">
        <label for="lname">Last Name</label>
        </div>

        <div class="input-field">
        <i class="mdi-action-lock-outline prefix"></i>
        </div>

        <div class="input-field">
        <i class="mdi-action-lock-outline prefix"></i>
        <input id="h_center" name="h_center" type="text">
        <label for="h_center">Center</label>
        </div>

        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="request">REQUEST SERVICE</button>
        <br>
        </form>
    </div>
</div>   
</div>
<?php
include 'footer.php';
?>
