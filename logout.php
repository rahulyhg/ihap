<?php
session_start();

if (isset($_GET['action'])) {
	session_destroy();
}

include 'header.php';
?>
<title>Logout [ IHAP ]</title>
<div style="padding-top:40px;" >
    <div id="login_div">
    <center><?php frontlogo(); ?><br>
      <h4>You are now logged out</h4>
      <a href="./register" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons">edit</i> REGISTER</a> <a href="./login" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons">exit_to_app</i> LOGIN</a>
    </center><br>
      </div>
    </div>
<?php
include 'footer.php';
?>