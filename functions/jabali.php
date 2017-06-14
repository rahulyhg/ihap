<?php 
/**
* @package Jabali Framework
* @subpackage Database
* @link https://docs.mauko.co.ke/jabali/classes/hdb
* @author Mauko Maunde
* @version 0.17.06
**/

/**
* Default Date/Timezone
**/
date_default_timezone_set( "Africa/Nairobi" );

/**
* Install main instance of Jabali
**/
function installJabali() {
	$husers = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS husers(
	h_alias VARCHAR(100),
	h_author VARCHAR(12),
	h_avatar VARCHAR(100), 
	h_center VARCHAR(100),
	h_code VARCHAR(16),
	h_created DATE,
	h_custom VARCHAR(12),
	h_description TEXT,
	h_email VARCHAR(50),
	h_fav INT(5),
	h_gender VARCHAR(10),
	h_key VARCHAR(100),
	h_level VARCHAR(12),
	h_link VARCHAR(100),
	h_location VARCHAR(50),
	h_logdate VARCHAR(12),
	h_logip VARCHAR(20),
	h_notes TEXT,
	h_password VARCHAR(50),
	h_phone VARCHAR(20),
	h_social VARCHAR(500),
	h_status VARCHAR(20),
	h_style VARCHAR(100),
	h_type VARCHAR(50),
	h_updated DATE,
	h_username VARCHAR(20),
	PRIMARY KEY(h_code)
	)" );

	$resources = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS hresources (
	h_alias VARCHAR(100),
	h_author VARCHAR(12),
	h_avatar VARCHAR(20),
	h_by VARCHAR(20), 
	h_center VARCHAR(20),
	h_code VARCHAR(16),
	h_created DATE,
	h_custom VARCHAR(12),
	h_description TEXT,
	h_email VARCHAR(50),
	h_key VARCHAR(100),
	h_level VARCHAR(12),
	h_link VARCHAR(100),
	h_location VARCHAR(50),
	h_notes TEXT,
	h_phone VARCHAR(20),
	h_social VARCHAR(500),
	h_status VARCHAR(20),
	h_type VARCHAR(50),
	h_updated DATE,
	PRIMARY KEY(h_code)
	)" );

	$services = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS hservices (
	h_alias VARCHAR(100),
	h_author VARCHAR(12),
	h_by VARCHAR(20), 
	h_center VARCHAR(20),
	h_code VARCHAR(16),
	h_created DATE,
	h_email VARCHAR(50),
	h_key VARCHAR(100),
	h_level VARCHAR(12),
	h_link VARCHAR(100),
	h_location VARCHAR(50),
	h_notes TEXT,
	h_status VARCHAR(20),
	h_type VARCHAR(50),
	h_updated DATE,
	PRIMARY KEY(h_code)
	)" );

	$hmessages = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS hmessages(
	h_alias VARCHAR(100),
	h_author VARCHAR(20),
	h_by VARCHAR(20),
	h_code VARCHAR(16),
	h_created DATE,
	h_description TEXT,
	h_email VARCHAR(50),
	h_for VARCHAR(20),
	h_key VARCHAR(100),
	h_level VARCHAR(12),
	h_link VARCHAR(100),
	h_phone VARCHAR(20),
	h_status VARCHAR(20),
	h_type VARCHAR(50),
	PRIMARY KEY(h_code)
	)" );

	$hnotifications = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS hnotifications(
	h_alias VARCHAR(100),
	h_author VARCHAR(20),
	h_by VARCHAR(20),
	h_code VARCHAR(16),
	h_created DATE,
	h_description TEXT,
	h_email VARCHAR(50),
	h_for VARCHAR(20),
	h_key VARCHAR(100),
	h_level VARCHAR(12),
	h_link VARCHAR(100),
	h_status VARCHAR(20),
	h_type VARCHAR(50),
	h_updated DATE,
	PRIMARY KEY(h_code)
	)" );

	$huploads = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS huploads(
	h_alias VARCHAR(100),
	h_author VARCHAR(12),
	h_avatar VARCHAR(20),
	h_by VARCHAR(20), 
	h_center VARCHAR(20),
	h_code VARCHAR(16),
	h_created DATE,
	h_custom VARCHAR(12),
	h_description TEXT,
	h_email VARCHAR(50),
	h_for VARCHAR(20),
	h_key VARCHAR(100),
	h_level VARCHAR(12),
	h_link VARCHAR(100),
	h_location VARCHAR(50),
	h_notes TEXT,
	h_phone VARCHAR(20),
	h_status VARCHAR(20),
	h_type VARCHAR(50),
	h_updated DATE,
	PRIMARY KEY(h_code)
	)" );

	$hposts = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS hposts(
	h_alias VARCHAR(300),
	h_author VARCHAR(20),
	h_by VARCHAR(100),
	h_avatar VARCHAR(100),
	h_category VARCHAR(20), 
	h_center VARCHAR(20),
	h_code VARCHAR(16),
	h_created DATE,
	h_description TEXT,
	h_email VARCHAR(50),
	h_fav INT(5),
	h_gallery VARCHAR(500),
	h_key VARCHAR(100),
	h_level VARCHAR(12),
	h_link VARCHAR(100),
	h_location VARCHAR(100),
	h_notes TEXT,
	h_phone VARCHAR(100),
	h_reading VARCHAR(500),
	h_status VARCHAR(20),
	h_subtitle VARCHAR(100),
	h_tags VARCHAR(50),
	h_type VARCHAR(50),
	h_updated DATE,
	PRIMARY KEY(h_code)
	)" );

	$hnotes = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS hnotes (
	id INT(10) NOT NULL AUTO_INCREMENT,
	h_author VARCHAR(20),
	h_by VARCHAR(100),
	h_created DATE,
	h_description TEXT,
	h_for VARCHAR(20),
	h_link VARCHAR(100),
	h_type VARCHAR(50),
	PRIMARY KEY(id)
	)" );

	$hratings = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS hratings (
	id INT(10) NOT NULL AUTO_INCREMENT,
	h_author VARCHAR(20),
	h_code VARCHAR(16),
	h_for VARCHAR(20),
	h_type VARCHAR(50),
	PRIMARY KEY(id)
	)" );

	$faqs = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS hfaqs (
	h_alias VARCHAR(100),
	h_code VARCHAR(16),
	h_description TEXT,
	h_type VARCHAR(50),
	PRIMARY KEY(h_code)
	)" );

	$hoptions = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS hoptions (
	id INT(10) NOT NULL AUTO_INCREMENT,
	h_alias VARCHAR(200),
	h_code VARCHAR(100) UNIQUE,
	h_description TEXT,
	h_updated DATE,
	PRIMARY KEY(id)
	)" );

	$hextensions = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS hmenus(
	h_alias VARCHAR(100),
	h_avatar VARCHAR(100), 
	h_code VARCHAR(16),
	h_description TEXT,
	h_for VARCHAR(50),
	h_link VARCHAR(300),
	h_location VARCHAR(100),
	h_type VARCHAR(100),
	PRIMARY KEY(h_code)
	)" );

	$hextensions = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS hextensions(
	h_alias VARCHAR(300),
	h_author VARCHAR(20),
	h_avatar VARCHAR(100),
	h_category VARCHAR(20), 
	h_code VARCHAR(16),
	h_created DATE,
	h_description TEXT,
	h_email VARCHAR(50),
	h_social VARCHAR(500),
	h_status VARCHAR(20),
	h_support VARCHAR(500),
	h_updated DATE,
	h_website VARCHAR(500),
	PRIMARY KEY(h_code)
	)" );

	if ( $husers && $hresources && $hmessages && $hnotifications && $huploads && $hposts && $hnotes && $hratings && $hfaqs && $hoptions && $hextensions ) {
		return true; 
	} else {
		return false;
	}

return true;
} 

/**
* Include the main configuration file
**/
include 'config.php';
function connectDb() {
	$GLOBALS['conn'] = mysqli_connect( hDBHOST, hDBUSER, hDBPASS, hDBNAME );

	if ( mysqli_connect_errno() ) {
		printf( "Connection failed: %s\ ", mysqli_connect_error() );
		exit();
	}
	return true;
	
}

/**
* Script Directories
**/
define('hPORTAL', hROOT.'portal/' );
define('hFUNCTIONS', hROOT.'functions/' );
define('hUPLOADS', hROOT.'uploads/' );
define('hEXTENSIONS', hROOT.'extensions/' );

/**
* Assets Directories
**/
define('hASSETS', hROOT.'assets/' );
define('hSTYLES', hASSETS.'css/' );
define('hSCRIPTS', hASSETS.'js/' );
define('hIMAGES', hASSETS.'images/' );
define('hFONTS', hASSETS.'fonts/' );

/**
* 
**/
define('hLOGIN', hROOT.'login/' );
define('hREGISTER', hROOT.'register/' );
define('hAPI', hROOT.'api/' );

/**
* 
**/
define('hEMAIL', 'portal@mtaandao.co.ke' );
define('hPHONE', '254702630550' );

/**
* Include Function
**/
function getFile( $path, $file ) {

	include $path.$file.'.php';
}

/**
* Load stylesheets
**/
function getStyle( $link ) { ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $link; ?>"><?php 
}

/**
* Load Javascript
**/
function getScript( $link ) { ?>
	<script src="<?php echo $link; ?>"></script><?php 
}

/**
* Display logo
**/
function frontlogo() {
	
	echo '<a href="'.hROOT.'"><img src="'.hIMAGES.'logo.png" width="250px;"></a>';
}

/**
* Print out something
**/
function _show_( $what ) {

	echo $what;
}

/**
* Window Alert
**/
function showAlert( $alert ) {
	?><script>
	function showText() {
	    alert( "<?php echo $alert; ?>" );
	}

	showText();
	</script><?php 
}

/**
* Window Confirm
**/
function showConf( $message, $yes, $no, $where ) {
	?><script>
	function confirmAcion() {
    var txt;
    if ( confirm( "<?php echo $message; ?>" ) == true ) {
        txt = "<?php echo $yes; ?>";
    } else {
        txt = "<?php echo $no; ?>";
    }
    document.getElementById( "<?php echo $where; ?>" ).innerHTML = txt;
	}

	confirmAcion();
	</script><?php 
}


/**
* Check if user has appropriate permisions
**/
function isCap( $cap ) {
	if ( $_SESSION['myCap'] == $cap ) {
		return true;
	} else {
		return false;
	}
}

function emailExists( $email ) {
	$theEmail = mysqli_query( $GLOBALS['conn'], "SELECT h_email FROM husers WHERE h_email ='".$email."'" );
	if ( $theEmail -> num_rows > 0 ) {
		return true;
	} else {
		return false;
	}
}

/**
* Check if user is viewing own profile
**/
function isProfile( $cap ) {
	if ( $_SESSION['myCode'] == $_GET['view'] ) {
		return true;
	} else {
		return false;
	}
}


/**
* 
**/
function uploadFile() {
	$year = date('Y' );
	$month = date('m' );
	$day = date('d' );
	$uploads = hUPLOADS . "$year/$month/$day/";
	$upload = $uploads . basename( $_FILES['h_avatar']['name'] );
	$uploadOk = 1;

	if ( file_exists( $upload) ) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
	}

	if ( $uploadOk == 0 ) {
    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if ( move_uploaded_file( $_FILES['h_avatar']["tmp_name"], $upload) ) {
	        echo "The file ". basename( $_FILES["h_avatar"]["name"] ). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}

}

/**
* 
**/
function getMsgCount() {
    $getMessages = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmessages WHERE (h_status = 'unread' AND h_for = '".$_SESSION['myCode']."' )" );
    if ( $getMessages -> num_rows >= 0 ) {
      $messagecount = $getMessages -> num_rows;
      echo $messagecount;
    } else {
      _show_( '0' );
    }
}

/**
* 
**/
function getNoteCount() {
	$getMessages = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hnotifications" );
	if ( $getMessages -> num_rows >= 0 ) {
	  	$messagecount = $getMessages -> num_rows;
	  	echo $messagecount;
	} else {
	  	_show_( '0' );
	}
}

/**
* 
**/
function primaryColor( $code ) {
	$getColor = mysqli_query( $GLOBALS['conn'], "SELECT h_style FROM husers  WHERE h_code='".$code."'" );
	if ( $getColor ) {
		while ( $themes = mysqli_fetch_assoc( $getColor) ) {
			if ( $themes['h_style'] == "love" ) {
				echo "cyan";
			} elseif ( $themes['h_style'] == "zahra" ) {
				echo "teal";
			} elseif ( $themes['h_style'] == "wizz" ) {
				echo "yellow";
			} elseif ( $themes['h_style'] == "pint" ) {
				echo "blue";
			} elseif ( $themes['h_style'] == "stack" ) {
				echo "grey";
			} elseif ( $themes['h_style'] == "hot" ) {
				echo "red";
			} elseif ( $themes['h_style'] == "princess" ) {
				echo "pink";
			} elseif ( $themes['h_style'] == "haze" ) {
				echo "purple";
			} elseif ( $themes['h_style'] == "prince" ) {
				echo "deep-purple";
			} elseif ( $themes['h_style'] == "indie" ) {
				echo "indigo";
			} elseif ( $themes['h_style'] == "sky" ) {
				echo "light-blue";
			} elseif ( $themes['h_style'] == "greene" ) {
				echo "green";
			} elseif ( $themes['h_style'] == "vegan" ) {
				echo "light-green";
			} elseif ( $themes['h_style'] == "lemon" ) {
				echo "lime";
			} elseif ( $themes['h_style'] == "wait" ) {
				echo "amber";
			} elseif ( $themes['h_style'] == "orange" ) {
				echo "orange";
			} elseif ( $themes['h_style'] == "sun" ) {
				echo "deep-orange";
			} elseif ( $themes['h_style'] == "earth" ) {
				echo "brown";
			} elseif ( $themes['h_style'] == "ghost" ) {
				echo "blue-grey";
			} elseif ( $themes['h_style'] == "bred" ) {
				echo "black";
			}
		}
	}
}

/**
* 
**/
function secondaryColor( $code ) {
	$getColor = mysqli_query( $GLOBALS['conn'], "SELECT h_style FROM husers  WHERE h_code='".$code."'" );
	if ( $getColor ) {
		while ( $themes = mysqli_fetch_assoc( $getColor) ) {
			if ( $themes['h_style'] == "love" ) {
				echo "magenta";
			} elseif ( $themes['h_style'] == "zahra" ) {
				echo "red";
			} elseif ( $themes['h_style'] == "wizz" ) {
				echo "black";
			} elseif ( $themes['h_style'] == "pint" ) {
				echo "pink";
			} elseif ( $themes['h_style'] == "stack" ) {
				echo "brown";
			} elseif ( $themes['h_style'] == "hot" ) {
				echo "red";
			} elseif ( $themes['h_style'] == "princess" ) {
				echo "pink";
			} elseif ( $themes['h_style'] == "haze" ) {
				echo "green";
			} elseif ( $themes['h_style'] == "prince" ) {
				echo "green";
			} elseif ( $themes['h_style'] == "indie" ) {
				echo "indigo";
			} elseif ( $themes['h_style'] == "sky" ) {
				echo "blue";
			} elseif ( $themes['h_style'] == "greene" ) {
				echo "green";
			} elseif ( $themes['h_style'] == "vegan" ) {
				echo "green";
			} elseif ( $themes['h_style'] == "lemon" ) {
				echo "lime";
			} elseif ( $themes['h_style'] == "wait" ) {
				echo "orange";
			} elseif ( $themes['h_style'] == "orange" ) {
				echo "orange";
			} elseif ( $themes['h_style'] == "sun" ) {
				echo "deep-orange";
			} elseif ( $themes['h_style'] == "earth" ) {
				echo "orange";
			} elseif ( $themes['h_style'] == "ghost" ) {
				echo "red";
			} elseif ( $themes['h_style'] == "bred" ) {
				echo "red";
			}
		}
	}
}

/**
* 
**/
function textColor( $code ) {
	$getColor = mysqli_query( $GLOBALS['conn'], "SELECT h_style FROM husers  WHERE h_code='".$code."'" );
	if ( $getColor ) {
		while ( $themes = mysqli_fetch_assoc( $getColor) ) {
			if ( $themes['h_style'] == "love" ) {
				echo "cyan";
			} elseif ( $themes['h_style'] == "zahra" ) {
				echo "teal";
			} elseif ( $themes['h_style'] == "wizz" ) {
				echo "brown";
			} elseif ( $themes['h_style'] == "bluepint" ) {
				echo "blue";
			} elseif ( $themes['h_style'] == "stack" ) {
				echo "grey";
			}
		}
	}
}

/**
* 
**/
function getOption( $code ) {
    $getOptions = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hoptions WHERE h_code='".$code."'" );
    if ( $getOptions -> num_rows > 0 ) {
        while ( $siteOption = mysqli_fetch_assoc( $getOptions) ) { 
            _show_( $siteOption['h_description'] );
        }
    }
}
/**
* 
**/
function showTitle( $class ) { ?>
    <title><?php

    $class = ucwords( $class );
	//Viewing
	if ( isset( $_GET['view'] ) ) {
		if ( $_GET['view'] == "list" ) {
			if ( isset( $_GET['type'] ) ) {
				echo $_GET['type']."s List";
			} else {
				echo $class."s List";
			}
		} elseif ( $_GET['view'] == "pending" ) {
			echo "Pending ".$class;
		} else {
			if ( isset( $_GET['key'] ) ) {
				echo $_GET['key'];
			} else {
				echo $class;
			}
		} 

	//Creating 
	} elseif ( isset( $_GET['create'] ) ) {
		if ( isset( $_GET['key'] ) ) {
			echo "Create ".$_GET['key'];
		} else {
			echo "Create ".$class;
		}

	//Deleting
	} elseif ( isset( $_GET['delete'] ) ) {
		if ( isset( $_GET['key'] ) ) {
			echo "Delete ".$_GET['key'];
		} else {
			echo "Delete ".$class;
		}

	// Editing
	} elseif ( isset( $_GET['edit'] ) ) {
		if ( isset( $_GET['key'] ) ) {
			echo "Edit ".$_GET['key'];
		} else {
			echo "Edit ".$class;
		}
	}?> 
	[ <?php
	getOption( 'name' ); ?> ]
    </title><?php
}

/**
* 
**/
function tableHeader( $collums ) { ?>
	<table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">
		<thead>
			<tr><?php
			foreach ( $collumns as $collumn ) {
				echo '<th class="mdl-data-table__cell--non-numeric">'.$collumn.'</th>';
			} ?>
			</tr>
		</thead>
		<tbody>
			<tr><?php
}

/**
* 
**/
function tableFooter( $collums ) { ?>
			</tr>
		</tbody>
	</table><?php
}


/**
* 
**/
function isEmail( $data ) {
  if ( filter_var( $data, FILTER_VALIDATE_EMAIL) ) {
    return true;
  } else {
    return false;
  }
}

/**
* 
**/
function newButton( $hclass, $htype, $hicon ) {
	echo '<a href="./'.$hclass.'?create='.$htype.'" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">'.$hicon.'</i></a>';
}


/**
* Autoload Classes
**/
 include 'class.forms.php';
 include 'class.users.php';
 include 'class.resources.php';
 include 'class.services.php';
 include 'class.messages.php';
 include 'class.notifications.php';
 include 'class.posts.php';
 include 'class.menus.php';
 include 'class.social.php';


?>
