<?php 
/**
* @package Jabali Framework
* @subpackage Home
* @link https://docs.mauko.co.ke/jabali/home
* @author Mauko Maunde
* @version 0.17.06
**/

$dbfile = 'functions/config.php';
if ( !file_exists( $dbfile) ) {
	header( "Location: ./setup" );
}

include 'header.php';
$year = date( "Y" );
$month = date( "m" );
$day = date( "d" );
$directory = "uploads/$year/$month/$day/";

if ( !is_dir( $directory) ) {
	mkdir( $directory, 755, true );
}

if ( isset( $_GET['post'] ) ) {
	if ( $_GET['post'] == "posts" ) {
		$hPost -> getArticles();
	} else {
		$hPost -> getArticleCode( $_GET['post'] );
		$hSocial -> bottomshare( $_GET['post'] );
	}
} else { ?>
	<title>Access Your Health [ <?php getOption( 'name' ); ?> ]</title>
	<div style="padding-top:40px;" >
	    <div id="login_div" class="mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { primaryColor( $_SESSION['myCode'] ); } else { echo "grey"; } ?>">
		<center><a href="<?php echo hROOT; ?>"><img src="<?php echo hIMAGES; ?>logo.png" width="300px;"></a><br><?php 
		if ( isset( $_GET['logout'] ) ) {

			session_start();
			session_destroy();

			echo '<div id="success" class="alert mdl-color--orange">
                    <span>You are now logged out!</span>
                </div>';
		} 
		if ( !isset( $_SESSION['myCode'] ) ) { ?>
		<a href="./login" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { secondaryColor( $_SESSION['myCode'] ); } else { echo "red"; } ?>">
	  		<i class="material-icons">exit_to_app</i> LOGIN
	  	</a><br><?php 
	  } ?><br>
	  <p>© <?php getOption( 'name' ); ?> 2017 - All Rights Reserved</p>
	  <a href="./about">About</a> - <a href="./tos">TOS</a> - <a href="./faq">FAQs</a>
		</center><br>
	    </div>



            <div class="fixed-action-btn toolbar">
              <a class="btn-floating btn-large mdl-color--<?php 
          		if ( isset( $_SESSION['myCode'] ) ) {
		            primaryColor( $_SESSION['myCode'] );
		        } else { 
		        	echo "grey"; 
		        }  ?>">
                <i class="large material-icons">create</i>
              </a>
              <ul>
                <li class="waves-effect waves-light"><a href="./register?type=user" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
	  <i class="mdi mdi-account mdi-2x"></i></a></li>
                <li class="waves-effect waves-light"><a href="./register?type=center" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
	  <i class="material-icons">location_city</i></a></li>
                <li class="waves-effect waves-light"><a href="./about" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
	  <i class="material-icons">message</i></a></li>
              </ul>
            </div>
	</div><?php 
}

include 'footer.php'; ?>