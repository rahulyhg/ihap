<?php 
include './header.php';

function getCount($utype) {
    $usersCount = mysqli_query($GLOBALS['conn'], "SELECT h_type FROM husers WHERE h_type='".$utype."'");
	if ($usersCount -> num_rows > 0) {
			echo '<div class="mdl-cell mdl-card mdl-shadow--2dp"><i class="material-icons prefix">people</i><center>'
			.ucfirst($utype).'s
			<br>'.$usersCount -> num_rows.'
			</center></div>';
	} else {
		echo '<div class="mdl-cell mdl-card mdl-shadow--2dp"><i class="material-icons prefix">people</i><center>'
		.ucfirst($utype).'s
		<br>0
		</center></div>';
	}
}

$types = "admin, doctor, nurse, manager, patient";
$type = explode(", ", $types);

?>
<title>IHAP PORTAL</title>
  <div class="mdl-grid demo-content">
  	<?php
  		getCount($type[0]);
  		getCount($type[1]);
  		getCount($type[2]);
  		getCount($type[3]);
  		getCount($type[4]);
  	?>
  </div>
<?php 
include './footer.php';
?>