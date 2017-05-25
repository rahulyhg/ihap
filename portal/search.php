<?php
include './header.php';

 $arr = array();
if (!empty($_POST['keywords'])) {
 $keywords = mysqli_real_escape_string($GLOBALS['conn'], $_POST['keywords']);
 
 $result = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE h_alias LIKE '%"$keywords"%' and h_status='active'");
 if($result -> num_rows > 0){
 	while($row = mysqli_fetch_assoc($result)) {
 		$arr[] = $row;
    }   
 }

echo json_encode($arr);
include './footer.php';

?>
