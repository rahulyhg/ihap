<?php
include '../functions/jabali.php';
connectDb();

if (isset($_GET['view'])) {
	if ($_GET['view'] == "all") {
		$user = mysqli_query($GLOBALS['conn'], "SELECT h_alias, h_author, h_avatar, h_center, h_code, h_created, h_custom, h_description, h_email, h_fav, h_level, h_link, h_location, h_notes, h_phone, h_type, h_updated FROM husers WHERE h_status='active'");
	} else {
		$user = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE (h_status='active' AND h_code='".$_GET['view']."')");
	}
}

if (isset($_GET['type'])) {
	$user = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE (h_status='active' AND h_type='".$_GET['type']."')");
}

if (isset($_GET['county'])) {
	$user = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE (h_status='active' AND h_location='".$_GET['county']."')");
}

if ($user->num_rows > 0) {

    while($row = mysqli_fetch_assoc($user)) {
        $array[] = $row;
    }

    header('Content-Type:Application/json');
    echo json_encode($array);
}

//$arr = array();

// if (!empty($_POST['keywords'])) {
//  $keywords = mysqli_real_escape_string($GLOBALS['conn'], $_POST['keywords']);
//  $search = mysqli_query("SELECT h_code, h_alias FROM h_users WHERE h_alias LIKE '%".$keywords."%' AND h_status = 'active'");
//  if ($search->num_rows > 0) {
//  while ($obj = $result->fetch_object()) {
//  $arr[] = array('id' => $obj->ID, 'title' => $obj->post_title);
//  }
//  }
// }
// echo json_encode($arr);

?>
