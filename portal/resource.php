<?php 
include './header.php';

if ( isset( $_GET['delete'] ) ) {
	mysqli_query( $GLOBALS['conn'], "DELETE FROM hresources WHERE h_code='".$_GET['delete']."'" );
	$hResource -> getResources();
}

if ( isset( $_GET['create'] ) ) {
	$hForm -> resourceForm();
}

if ( isset( $_GET['edit'] ) ) {
	$hForm -> editResourceForm( $_GET['edit'] );
}

if ( isset( $_GET['fav'] ) ) {
	$getRate = mysqli_query( $GLOBALS['conn'], "INSERT INTO hratings (h_author, h_for, h_type ) 
		VALUES ('".$_SESSION['myCode']."', '".$_GET['fav']."', 'resource' )" );
}

if ( isset( $_GET['author'] ) ) {
	$hResource-> getResourcesAuthor( $_GET['author'] );
	if ( isCap( 'admin' ) ) {
		newButton('resource', 'resource', 'create' );
	}
}

if ( isset( $_GET['view'] )){
	if ( $_GET['view'] == "list" ) {
		if ( isset( $_GET['type'] ) ) {
			$hResource -> getResourcesType( $_GET['type'] );
			if ( isCap( 'admin' ) || isCap( 'center' ) ) {
				newButton('resource', $_GET['type'], 'create' );
			}
		} elseif ( isset( $_GET['location'] ) ) {
			$hResource -> getResourcesLoc( $_GET['location'] );
			if ( isCap( 'admin' ) || isCap( 'center' ) ) {
				newButton('resource', $_GET['location'], 'create' );
			}
		} else {
			$hResource -> getResources();
			if ( isCap( 'admin' ) || isCap( 'center' ) ) {
				newButton('resource', 'center', 'create' );
			}
		}
	} else {
		$hResource -> getResourceCode( $_GET['view'] );
	}

}

if ( isset( $_POST['update'] ) ) {
	$hResource -> updateResource( $_POST['h_code'] );
}

if ( isset( $_POST['register'] ) ) {
	$hResource -> createResource();
}

include './footer.php';
