<?php
//Main Functions file

//Date
date_default_timezone_set("Africa/Nairobi");

//Database Constants
define("hDBNAME","ihap");
define("hDBUSER","root");
define("hDBPASS","namulash");
define("hDBHOST","localhost");

//Directories
define('hROOT','http://localhost/ihap/');
define('hPORTAL', hROOT.'portal/');
define('hFUNCTIONS', hROOT.'functions/');
define('hUPLOADS', hROOT.'uploads/');


//Assets
define('hASSETS', hROOT.'assets/');
define('hSTYLES', hASSETS.'css/');
define('hSCRIPTS', hASSETS.'js/');
define('hIMAGES', hASSETS.'images/');
define('hFONTS', hASSETS.'fonts/');

//Actions
define('hLOGIN', hROOT.'login/');
define('hREGISTER', hROOT.'register/');

define('hEMAIL', 'portal@mtaandao.co.ke');
define('hPHONE', '254702630550');

define('hAPI', hROOT.'api/');

function connectDb() {
	$GLOBALS['conn'] = mysqli_connect( hDBHOST, hDBUSER, hDBPASS, hDBNAME );
	
	if ( mysqli_connect_errno() ) {
		printf("Connection failed: %s\ ", mysqli_connect_error());
		exit();
	}
	return true;
		
}

function getFile($path, $file) {

	include $path.$file.'.php';
}

function getStyle($link) {
	?><link rel="stylesheet" type="text/css" href="<?php echo $link; ?>"><?php
}

function getScript($link) {
	?><script src="<?php echo $link; ?>"></script><?php
}

function frontlogo() {

        echo '<a href="'.hROOT.'"><img src="'.hIMAGES.'logo.png" width="250px;"></a>';
}

function show($what) {
	echo $what;
}

function showAlert($alert) {
	?><script>
	function showText() {
	    alert("<?php echo $alert; ?>");
	}

	showText();
	</script><?php
}

function showConf($message, $yes, $no, $where) {
	?><script>
	function confirmAcion() {
    var txt;
    if (confirm("<?php echo $message; ?>") == true) {
        txt = "<?php echo $yes; ?>";
    } else {
        txt = "<?php echo $no; ?>";
    }
    document.getElementById("<?php echo $where; ?>").innerHTML = txt;
	}

	confirmAcion();
	</script><?php
}

//Check if user has appropriate permisions
function isCap($cap) {
	if ($_SESSION['myCap'] == $cap) {
		return true;
	} else {
		return false;
	}
}

//Show/hide edit/delete buttons
// if (isCap( 'admin' ) && isCap( 'doctor' ) && $_SESSION['myCode'] == $_GET['view']) {
// 	# show
// } else {
// 	# hide
// }

//fav button
// if ($_SESSION['myCode'] !== $_GET['view']) {
// 	# show
//}

function uploadFile() {
	$uploaddir = "uploads/$year/$month/$day";
	$uploadfile = $uploaddir. basename($_FILES['file']['name']);
	move_uploaded_file(filename, destination);

}

function getMsgCount() {
    $getMessages = mysqli_query($GLOBALS['conn'], "SELECT * FROM hmessages WHERE h_status='unread'");
    if ($getMessages -> num_rows >= 0) {
      $messagecount = $getMessages -> num_rows;
      echo $messagecount;
    } else {
      show( '0' );
    }
}

function getNoteCount() {
	$getMessages = mysqli_query($GLOBALS['conn'], "SELECT * FROM hnotifications");
	if ($getMessages -> num_rows >= 0) {
	  	$messagecount = $getMessages -> num_rows;
	  	echo $messagecount;
	} else {
	  	show( '0' );
	}
}

function primaryColor($code) {
	$getColor = mysqli_query($GLOBALS['conn'], "SELECT h_style FROM husers  WHERE h_code='".$code."'");
	if ($getColor) {
		while ($themes = mysqli_fetch_assoc($getColor)) {
			if ($themes['h_style'] == "love") {
				echo "cyan";
			} elseif ($themes['h_style'] == "zahra") {
				echo "teal";
			} elseif ($themes['h_style'] == "wizz") {
				echo "brown";
			} elseif ($themes['h_style'] == "pint") {
				echo "orange";
			} elseif ($themes['h_style'] == "stack") {
				echo "grey";
			}
		}
	}
}

function secondaryColor($code) {
	$getColor = mysqli_query($GLOBALS['conn'], "SELECT h_style FROM husers  WHERE h_code='".$code."'");
	if ($getColor) {
		while ($themes = mysqli_fetch_assoc($getColor)) {
			if ($themes['h_style'] == "love") {
				echo "cyan";
			} elseif ($themes['h_style'] == "zahra") {
				echo "teal";
			} elseif ($themes['h_style'] == "wizz") {
				echo "brown";
			} elseif ($themes['h_style'] == "bluepint") {
				echo "blue";
			} elseif ($themes['h_style'] == "stack") {
				echo "grey";
			}
		}
	}
}

function textColor($code) {
	$getColor = mysqli_query($GLOBALS['conn'], "SELECT h_style FROM husers  WHERE h_code='".$code."'");
	if ($getColor) {
		while ($themes = mysqli_fetch_assoc($getColor)) {
			if ($themes['h_style'] == "love") {
				echo "cyan";
			} elseif ($themes['h_style'] == "zahra") {
				echo "teal";
			} elseif ($themes['h_style'] == "wizz") {
				echo "brown";
			} elseif ($themes['h_style'] == "bluepint") {
				echo "blue";
			} elseif ($themes['h_style'] == "stack") {
				echo "grey";
			}
		}
	}
}

 include 'forms.php';
 include 'users.php';
 include 'resources.php';
 include 'services.php';
 include 'messages.php';
 include 'notifications.php';
 include 'articles.php';

?>
