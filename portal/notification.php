<?php 
include './header.php';

if ( isset( $_GET['create'] ) ) {
	$hForm -> notificationForm();
}

if ( isset( $_GET['edit'] ) ) {
	$hForm -> editNotificationForm( $_GET['edit'] );
}

if ( isset( $_GET['fav'] ) ) {
	$getRate = mysqli_query( $GLOBALS['conn'], "INSERT INTO hratings (h_author, h_for, h_type ) 
		VALUES ('".$_SESSION['myCode']."', '".$_GET['fav']."', 'notification' )" );
}

if ( isset( $_GET['view'] )){
	if ( $_GET['view'] == "list" ) {
		if ( isset( $_GET['type'] ) ) {
			$hNotification -> getNotificationsType( $_GET['type'] );
		} elseif ( isset( $_GET['location'] ) ) {
			$hNotification -> getNotificationsLoc( $_GET['location'] );
		} else {
			$hNotification -> getNotifications();
		}
	} else {
		$hNotification -> getNotificationCode( $_GET['view'] );
	}

}

if ( isset( $_POST['create'] ) ) {
	$hNotification -> createNotification();
}
?>
<a href="./notification?create=note" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">add_alert</i></a>
<?php 
include './footer.php';
?>