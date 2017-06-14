<?php 
include '../functions/jabali.php';
connectDb();

if ( isset( $_GET['view'] ) ) {
	if ( $_GET['view'] == "all" ) {
		$user = mysqli_query( $GLOBALS['conn'], "SELECT h_alias, h_author, h_avatar, h_center, h_code, h_created, h_description, h_email, h_fav, h_level, h_link, h_location, h_notes, h_phone, h_type, h_updated FROM husers WHERE h_status='active'" );
	} else {
		$user = mysqli_query( $GLOBALS['conn'], "SELECT h_alias, h_author, h_avatar, h_center, h_code, h_created, h_description, h_email, h_fav, h_level, h_link, h_location, h_notes, h_phone, h_type, h_updated FROM husers WHERE (h_status='active' AND h_code ='".$_GET['view']."' )" );
	}
}

if ( isset( $_GET['type'] ) ) {
	$user = mysqli_query( $GLOBALS['conn'], "SELECT h_alias, h_author, h_avatar, h_center, h_code, h_created, h_description, h_email, h_fav, h_level, h_link, h_location, h_notes, h_phone, h_type, h_updated FROM husers WHERE (h_status='active' AND h_type ='".$_GET['type']."' )" );
}

if ( isset( $_GET['county'] ) ) {
	$user = mysqli_query( $GLOBALS['conn'], "SELECT h_alias, h_author, h_avatar, h_center, h_code, h_created, h_description, h_email, h_fav, h_level, h_link, h_location, h_notes, h_phone, h_type, h_updated FROM husers WHERE h_status = 'active' AND h_location = '".$_GET['county']."'" );
}

if ( $user->num_rows > 0) {

    while( $row = mysqli_fetch_assoc( $user) ) {
        $array[] = $row;
    }

    header('Content-Type:Application/json' );
    echo json_encode( $array );
}
?>
