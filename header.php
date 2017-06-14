<?php 
session_start();
include './functions/jabali.php';
if ( file_exists('./functions/config.php' ) ) {
    connectDb();
}

$hUser = new _hUsers();
$hForm = new _hForms();
$hResource = new _hResources();
$hService = new _hServices();
$hMessage = new _hMessages();
$hNotification = new _hNotifications();
$hPost = new _hPosts();
$hSocial = new _hSocial();
?>
<!doctype html>
<!--
  Jabali Framework
  © 2017 Mauko Maunde. All rights reserved.

  Licensed under the MIT license (the "License" );
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at https://opensource.org/licenses/MIT
-->
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <link rel="shortcut icon" href="<?php 
    if ( file_exists('./functions/config.php' ) ) {
        getOption( 'favicon' );
    } else {
        echo hIMAGES."marker.png"; 
    } ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">


    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">


    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="stylesheet" href='<?php echo hSTYLES; ?>lib/getmdl-select.min.css'>
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>lib/nv.d3.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>jquery-ui.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>materialize.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>material-icons.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>materialdesignicons.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>font-awesome.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>jabali.css">
    <style type="text/css">
    .mdl-menu__outline {
        background-color: <?php primaryColor( $_SESSION['myCode'] ); ?>;
        overflow-y: auto;
    }

    .primary {
        color: <?php primaryColor( $_SESSION['myCode'] ); ?>;
    }
    .accent, a {
        color: <?php if ( isset( $_SESSION['myCode'] ) ) { secondaryColor( $_SESSION['myCode'] ); } else { echo "red"; } ?>;
    }
    .accent, .mdl-button--fab.mdl-button--colored, .mdl-badge[data-badge]:after {
        background-color: <?php if ( isset( $_SESSION['myCode'] ) ) { secondaryColor( $_SESSION['myCode'] ); } else { echo "red"; } ?>;
    }
    .mdl-data-table {
    color: white;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    -o-text-overflow: ellipsis;
    width: 100%;
    height: auto;
    }
    </style>

    <script src="<?php echo hSCRIPTS; ?>jquery-3.1.1.min.js"></script>
    <script src="<?php echo hSCRIPTS; ?>jquery-ui.min.js"></script>
    <script src="<?php echo hASSETS; ?>js/ckeditor/ckeditor.js"></script>
    <script src="<?php echo hASSETS; ?>js/list.js"></script>
</head>
<div class="demo-layout-transparent mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
<body>
        <header class="demo-header mdl-layout__header mdl-color-text--grey-600 mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { primaryColor( $_SESSION['myCode'] ); } else { echo "grey"; } ?>">
        <div class="mdl-layout__header-row">
          <a href="<?php if ( file_exists('./functions/config.php' ) ) {
              echo hROOT;
          } else { echo './'; } ?>"><span class="mdl-layout-title"><img src="<?php if ( file_exists('./functions/config.php' ) ) {
              echo hIMAGES.'logo-w.png';
          } else { echo './assets/images/logo-w.png'; } ?>" width="100px;"></span></a>
          <div class="mdl-layout-spacer"></div>
          <a href="<?php echo hROOT.'about'; ?>" class="mdi mdi-email mdl-badge mdl-badge--overlap mdl-button--icon notification" id="h_contact"></a>
            <div class="mdl-tooltip" for="h_contact">Contact</div>
          <a href="<?php echo hROOT.'register'; ?>" class="mdi mdi-account-plus mdl-badge mdl-badge--overlap mdl-button--icon notification" id="h_submit"></a>
            <div class="mdl-tooltip" for="h_submit">Register</div>

          <a href="<?php if ( isset( $_SESSION['myCode'] ) ) {
              echo hPORTAL.'user?view='.$_SESSION['myCode'].'&key='.$_SESSION['myAlias'];
            } else {
            echo hROOT.'login'; 
            }
            ?>" class="mdi <?php if ( isset( $_SESSION['myCode'] ) ) {
              echo 'mdi-account';
            } else {
            echo 'mdi-login-variant'; 
            }
            ?> mdl-badge mdl-badge--overlap mdl-button--icon notification" id="h_login"></a>
            <div class="mdl-tooltip" for="h_login">Portal</div>

            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
            <i class="material-icons">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { primaryColor( $_SESSION['myCode'] ); } else { echo "grey"; } ?>" for="hdrbtn">
            <a class="mdl-menu__item mdl-list__item" href="<?php echo hROOT."about"; ?>"><i class="material-icons mdl-list__item-icon">mail_outline</i><span style="padding-left: 20px">Contact</span></a>
            <a class="mdl-menu__item mdl-list__item"href="<?php echo hROOT."register"; ?>"><i class="material-icons mdl-list__item-icon">link</i><span style="padding-left: 20px">Request Service</span></a>
            <a class="mdl-menu__item mdl-list__item"href="<?php if ( isset( $_SESSION['myCode'] ) ) {
              echo hPORTAL.'user?view='.$_SESSION['myCode'].'&key='.$_SESSION['myAlias'];
            } else {
            echo hROOT.'login'; 
            }
            ?>"><i class="material-icons mdl-list__item-icon"><?php if ( isset( $_SESSION['myCode'] ) ) {
              echo 'account_circle';
            } else {
            echo 'exit_to_app'; 
            }
            ?></i><span style="padding-left: 20px"><?php if ( isset( $_SESSION['myCode'] ) ) {
              echo 'Account';
            } else {
            echo 'Login'; 
            }
            ?></span></a>
          </ul>
        </div>
      </header>
    <main class="mdl-layout__content mdl-color-text--white">