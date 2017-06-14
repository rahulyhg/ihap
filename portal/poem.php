<?php 
//to-do move to zahra
include './header.php';
include '../extensions/zahra/zahra.php';
$hPoem = new _hPoems();

if ( isset( $_GET['view'] )){
	if ( $_GET['view'] == "list" ) {
		if ( isset( $_GET['type'] ) ) {
			$hPoem -> getUsersType( $_GET['type'] );
			if ( isCap( 'admin' ) ) {
				newButton('poem', $_GET['type'], 'create' );
			}
		} else {
			$hPoem -> getPoems();
			if ( isCap( 'admin' ) ) {
				newButton('post', 'poem', 'create' );
			}
		}
	} else {
		$hPoem -> getPoem( $_GET['view'] );
	}

}
include './footer.php'; ?>