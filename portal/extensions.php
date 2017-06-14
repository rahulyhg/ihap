<?php include './header.php';

if ( isset( $_GET['install'] ) ) {
	function intallX( $name, $source) {
		$xZip = fopen( "../extensions/temp/$name.zip", "w" );
    if ( $xZip) {
      file_put_contents( $xZip, fopen( $source, "r" ) );
    }

    $install = new ZipArchive();
    $xT = $install -> open( $xZip );
    if ( $xT === TRUE ) {
      $install -> extractTo( hEXTENSIONS );

      $xJson = file_get_contents( hEXTENSIONS.$name."/".$name.".json" );
      $xD = json_decode( $xJson, true );

      mysqli_query( $GLOBALS['conn'], "INSERT INTO hextensions (h_alias, h_author, h_avatar, h_category, h_code, h_created, h_description, h_email, h_key, h_social, h_status, h_support, h_website) VALUES ('".$xD['name']."', '".$xD['author']."', '".$xD['screenshot']."', '".$xD['category']."', '".substr(md5(date(YmdHms)), 0, 12)."', '".date('Ymd' )."', '".$xD['description']."', '".$xD['social']['email']."', '".md5(date(YmdHms))."', '".$xD['social']['facebook'].", ".$xD['social']['twitter'].", ".$xD['social']['github']."', 'active', '".$xD['support']."', '".$xD['website']."' )" );

      $install -> close();
    } else {
      echo "Error!";
    }
	}

  intallX( $_GET['install'], "http://code.mauko.co.ke/dl/extensions/".$_GET['install'].".zip" );

} elseif ( isset( $_GET['activate'] ) ) {
	function activateX( $x) {

    mysqli_query( $GLOBALS['conn'], "UPDATE hextensions SET h_status='active' WHERE h_code='".$x."'" );
	}

  activateX( $_GET['activate'] );

} elseif ( isset( $_GET['view'] ) ) {
	function getX() {
		# code...
	}
} else { ?>
<title>Extensions [ JABALI ]</title>
	<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--2dp  mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">

  <ul id="tabs-swipe-demo" style="border-radius: 5px;" class="tabs mdl-card__title mdl-card--expand">
      <li class="tab col s3"><a class="active" href="#test-swipe-1">All</a></li>
      <li class="tab col s3"><a href="#test-swipe-2">Ecommerce</a></li>
      <li class="tab col s3"><a href="#test-swipe-3">Accounting</a></li>
      <li class="tab col s3"><a href="#test-swipe-4">Education</a></li>
      <li class="tab col s3"><a href="#test-swipe-5">Events</a></li>
  </ul>

  <div class="mdl-card__supporting-text">
  <div id="test-swipe-1" class="col s12"><?php 
  	$getXs = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hextensions" );
  	if ( $getXs -> num_rows > 0) {
  	 	while ( $xDeet = mysqli_fetch_assoc( $getXs) ) { ?>
  	 		<div class="mdl-cell mdl-card">
          <div class="mdl-card-media">
              <img src="<?php _show_( $xDeet['h_avatar'] ); ?>" width="100%" style="overflow: hidden;" >
          </div>
          <div class="mdl-card__title mdl-card--expand">
            <?php _show_( $xDeet['h_alias'] ); ?>
          </div>
  	 			<div class="mdl-card__supporting-text">
            <?php _show_( $xDeet['h_description'] ); ?>
          </div>
          <div class="mdl-card__menu">
          <a href="?install=<?php echo strtolower( $xDeet["h_alias"] ); ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">file_download</i></a>
          <a href="?activate=<?php echo $xDeet["h_code"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">play_arrow</i></a>
          </div>
  	 		</div><?php 
  	 	} 
  	} else {
      echo "No Extensions Found";
    } ?>
  </div>
  <div id="test-swipe-2" class="col s12"><?php 
    $getXs = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hextensions" );
    if ( $getXs -> num_rows > 0) {
      while ( $xDeet = mysqli_fetch_assoc( $getXs) ) { ?>
        <div class="mdl-cell mdl-card">
          <div class="mdl-card-media">
              <img src="<?php _show_( $xDeet['h_avatar'] ); ?>" width="100%" style="overflow: hidden;" >
          </div>
          <div class="mdl-card__title mdl-card--expand">
            <?php _show_( $xDeet['h_alias'] ); ?>
          </div>
          <div class="mdl-card__supporting-text">
            <?php _show_( $xDeet['h_description'] ); ?>
          </div>
          <div class="mdl-card__menu">
          <a href="?install=<?php echo strtolower( $xDeet["h_alias"] ); ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">file_download</i></a>
          <a href="?activate=<?php echo $xDeet["h_code"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">play_arrow</i></a>
          </div>
        </div><?php 
      } 
    } else {
      echo "No Extensions Found";
    } ?>
  </div>
  <div id="test-swipe-3" class="col s12"><?php 
    $getXs = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hextensions" );
    if ( $getXs -> num_rows > 0) {
      while ( $xDeet = mysqli_fetch_assoc( $getXs) ) { ?>
        <div class="mdl-cell mdl-card">
          <div class="mdl-card-media">
              <img src="<?php _show_( $xDeet['h_avatar'] ); ?>" width="100%" style="overflow: hidden;" >
          </div>
          <div class="mdl-card__title mdl-card--expand">
            <?php _show_( $xDeet['h_alias'] ); ?>
          </div>
          <div class="mdl-card__supporting-text">
            <?php _show_( $xDeet['h_description'] ); ?>
          </div>
          <div class="mdl-card__menu">
          <a href="?install=<?php echo strtolower( $xDeet["h_alias"] ); ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">file_download</i></a>
          <a href="?activate=<?php echo $xDeet["h_code"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">play_arrow</i></a>
          </div>
        </div><?php 
      } 
    } else {
      echo "No Extensions Found";
    } ?>
  </div>
  <div id="test-swipe-4" class="col s12"><?php 
    $getXs = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hextensions" );
    if ( $getXs -> num_rows > 0) {
      while ( $xDeet = mysqli_fetch_assoc( $getXs) ) { ?>
        <div class="mdl-cell mdl-card">
          <div class="mdl-card-media">
              <img src="<?php _show_( $xDeet['h_avatar'] ); ?>" width="100%" style="overflow: hidden;" >
          </div>
          <div class="mdl-card__title mdl-card--expand">
            <?php _show_( $xDeet['h_alias'] ); ?>
          </div>
          <div class="mdl-card__supporting-text">
            <?php _show_( $xDeet['h_description'] ); ?>
          </div>
          <div class="mdl-card__menu">
          <a href="?install=<?php echo strtolower( $xDeet["h_alias"] ); ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">file_download</i></a>
          <a href="?activate=<?php echo $xDeet["h_code"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">play_arrow</i></a>
          </div>
        </div><?php 
      } 
    } else {
      echo "No Extensions Found";
    } ?>
  </div>

  <div id="test-swipe-5" class="col s12"><?php 
    $getXs = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hextensions" );
    if ( $getXs -> num_rows > 0) {
      while ( $xDeet = mysqli_fetch_assoc( $getXs) ) { ?>
        <div class="mdl-cell mdl-card">
          <div class="mdl-card-media">
              <img src="<?php _show_( $xDeet['h_avatar'] ); ?>" width="100%" style="overflow: hidden;" >
          </div>
          <div class="mdl-card__title mdl-card--expand">
            <?php _show_( $xDeet['h_alias'] ); ?>
          </div>
          <div class="mdl-card__supporting-text">
            <?php _show_( $xDeet['h_description'] ); ?>
          </div>
          <div class="mdl-card__menu">
          <a href="?install=<?php echo strtolower( $xDeet["h_alias"] ); ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">file_download</i></a>
          <a href="?activate=<?php echo $xDeet["h_code"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">play_arrow</i></a>
          </div>
        </div><?php 
      } 
    } else {
      echo "No Extensions Found";
    } ?>
  </div>
  </div>
  </div>
  <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp  mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
    <div class="mdl-card__title">
    <i class="material-icons">help</i>
      <span class="mdl-button">Tips on Extending Jabali</span>
    </div>
    <div class="mdl-card__supporting-text mdl-card--expand">
     <ul class="collapsible popout" data-collapsible="accordion">
        <li>
        <div class="collapsible-header"><i class="material-icons">help</i>Installing Extension</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li>
        <div class="collapsible-header"><i class="material-icons">help</i>Activating Extension</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li>
        <div class="collapsible-header"><i class="material-icons">help</i>Deactivating Extension</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li>
        <div class="collapsible-header"><i class="material-icons">help</i>UnInstalling Extension</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li>
        <div class="collapsible-header"><i class="material-icons">delete</i>Deleting Extension</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
      </ul>
    </div>
  </div> 
</div><?php 
}

include './footer.php'; ?>