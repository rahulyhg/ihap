<?php 
include '../functions/jabali.php';
connectDb();

if ( isset( $_GET['view'] ) ) {
	if ( $_GET['view'] == "all" ) {
		$user = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmessages" );
	} else {
		$user = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmessages WHERE h_code='".$_GET['view']."'" );
	}
}

if ( isset( $_GET['chat'] ) ) {
	if ( $_GET['chat'] == "all" ) {
		$user = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmessages WHERE h_type='chat'" );
	} else {
		$user = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmessages WHERE (h_type='chat' AND h_code='".$_GET['chat']."' )" );
	}
}

if ( $user->num_rows > 0) {

    while( $row = mysqli_fetch_assoc( $user) ) {
        $array[] = $row;
    }

    header('Content-Type:Application/json' );
    echo json_encode( $array );
}

?>
