<?php

include './header.php';
if(isset($_GET['type'])) {
	$hNotification -> getNotificationsType($_GET['type']);
}

if (isset($_GET['create'])) {
	$hForm -> notificationForm();
}

if (isset($_GET['chat'])) {
	$hMessage -> getChats();
}

if (isset($_GET['delete'])) {
	mysqli_query($GLOBALS['conn'], "DELETE FROM hnotifications WHERE id=".$_GET['delete']."");
	$hNotification -> getNotifications();
}

if (isset($_GET['edit']) && $_GET['view'] !=="") {
	$hNotification -> editNotificationForm($_GET['view']);
}

if(isset($_GET['view'])){
	if ($_GET['view'] == "list") {
		if(isset($_GET['type'])) {
			$hNotification -> getNotificationsType($_GET['type']);
		} else {
			$hNotification -> getNotifications();
		}
	} else {
		$hNotification -> getNotificationCode($_GET['view']);
	}

}

if (isset($_POST['create'])) {
	$hNotification -> createNotification();
}

if (isset($_POST['update'])) {
	$hNotification -> loginNotification();
}

if (isset($_POST['register'])) {
	$hNotification -> createNotification();
}

if (isset($_POST['confirm'])) {
	$hNotification -> confirmNotification();
} 
if (isset($_POST['logout'])) {
	$hNotification -> logoutNotification();
}

if (isset($_POST['forgot'])) {
	$hNotification -> forgotPass();
} 

if (isset($_POST['reset'])) {
	$hNotification -> resetPass();
}
?>
<a href="./register" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">add</i></a>
<?php
include './footer.php';
