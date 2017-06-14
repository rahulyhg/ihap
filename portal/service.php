<?php 
include './header.php';

if ( isset( $_GET['delete'] ) ) {
	mysqli_query( $GLOBALS['conn'], "DELETE FROM hservices WHERE h_code='".$_GET['delete']."'" );
	$hService -> getServices();
}

if ( isset( $_GET['create'] ) ) {
	$hForm -> serviceForm();
}

if ( isset( $_GET['edit'] ) ) {
	$hForm -> editServiceForm( $_GET['edit'] );
}

if ( isset( $_GET['fav'] ) ) {
	$getRate = mysqli_query( $GLOBALS['conn'], "INSERT INTO hratings (h_author, h_for, h_type ) 
		VALUES ('".$_SESSION['myCode']."', '".$_GET['fav']."', 'service' )" );
}

if ( isset( $_GET['view'] )){
	if ( $_GET['view'] == "list" ) {
		if ( isset( $_GET['type'] ) ) {
			$hService -> getServicesType( $_GET['type'] );
			if ( isCap( 'admin' ) ) {
				newButton('service', $_GET['type'], 'create' );
			}
		} elseif ( isset( $_GET['status'] ) ) {
			$hService -> getPendingService( $_SESSION['myCode'] );
			if ( isCap( 'admin' ) ) {
				newButton('service', 'request', 'create' );
			}
		} else {
			$hService -> getServices();
			if ( isCap( 'admin' ) ) {
				newButton('service', 'request', 'create' );
			}
		}
	} else {
		$hService -> getServiceCode( $_GET['view'] );
	}

}

if ( isset( $_POST['update'] ) ) {
	$hService -> updateService( $_POST['h_code'] );
}

if ( isset( $_POST['create'] ) ) {
	$hService -> createService();
}

include './footer.php';
