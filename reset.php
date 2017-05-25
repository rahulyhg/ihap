<?php
session_start();
include 'header.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

  $conn = mysqli_connect( hDBHOST, hDBUSER, hDBPASS, hDBNAME );
  $sql = "SELECT * FROM hUsers WHERE h_email=".$email."";
    $result = mysqli_query($conn, $sql);
    if( $result->num_rows > 0 ) {
      while ($row = mysqli_fetch_assoc($result)) {

        if ($password = $row['h_password']) {
          $_SESSION['myAlias'] = $row['h_alias'];
          $_SESSION['myUsername'] = $row['h_username'];
          $_SESSION['myCode'] = $row['h_code'];
          $_SESSION['myEmail'] = $row['h_email'];
          $_SESSION['myCenter'] = $row['h_center'];
          $_SESSION['myCap'] = $row['h_cap'];
          $_SESSION['myLocation'] = $row['h_location'];
          $_SESSION['myAvatar'] = $row['h_avatar'];

          header('Location ./portal/id=user&code='.$_SESSION['myCode'].'/view');
          exit();

        } else {
          echo "Wrong Password";
        }
      }

    } else {
      echo '<div>
      <p>User Does not exist</p>
      </div>';
    }
}

?>
<title>Reset Password [ IHAP ]</title>
<div style="padding-top:40px;" >
    <div id="login_div">
<center><?php frontlogo(); ?></center>
        <form method="POST" action="">

        <div class="input-field">
        <i class="mdi-social-person-outline prefix"></i>
        <input class="validate" name="pass1" id="email" type="password">
        <label for="email" data-error="wrong" data-success="right" class="center-align">New Password</label>
        </div>

        <div class="input-field">
        <i class="mdi-action-lock-outline prefix"></i>
        <input name="password" id="password" type="password">
        <label for="password">Repeat Password</label>
        </div>

        <input type="hidden" name="login"/>

        <div class="input-field">
        <button class="btn waves-effect waves-light" type="submit" name="action">RESET PASSWORD</button>
        </div>

        <p>
        <a href="./register" id="register">Register</a>
        </p>

        <br>
        <br>
        </form>
    </div>
</div>
<?php
include 'footer.php';
?>