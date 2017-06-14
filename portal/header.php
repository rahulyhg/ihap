<?php 
session_start();

include '../functions/jabali.php';

if ( !isset( $_SESSION['myCode'] ) ) {
	header( "Location: ../login" );
}

connectDb();

$hUser = new _hUsers();
$hForm = new _hForms();
$hResource = new _hResources();
$hService = new _hServices();
$hMessage = new _hMessages();
$hNotification = new _hNotifications();
$hPost = new _hPosts();
$hMenu = new _hMenus();
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

<html lang="en" class="mdc-typography">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#008080">

    <link rel="shortcut icon" href="<?php getOption( 'favicon' ); ?>">

    <link
      rel="stylesheet"
      href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
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
    .accent, a, .mdl-data-table.a, .mdl-badge.mdl-badge--no-background[data-badge]:after, .mdl-layout__drawer.mdl-navigation.mdl-navigation__link--current.material-icons, .mdl-layout__drawer.mdl-navigation.mdl-navigation__link:hover, .mdl-layout__drawer.mdl-navigation.mdl-navigation__link:hover.material-icons {
        color: <?php secondaryColor( $_SESSION['myCode'] ); ?>;
    }


    .accent, .mdl-button--fab.mdl-button--colored, .mdl-badge[data-badge]:after {
        background-color: <?php secondaryColor( $_SESSION['myCode'] ); ?>;
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

    <script src="<?php echo hASSETS; ?>js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo hASSETS; ?>js/jquery-ui.min.js"></script>
    <script src="<?php echo hASSETS; ?>js/ckeditor/ckeditor.js"></script>
    
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color-text--grey-600 mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title"><?php 
          if ( isset( $_GET['type'] ) ) {
            echo ucfirst( $_GET['type'].'s ' );
          } elseif ( isset( $_GET['view'] ) && $_GET['key'] !== "" ) {
            if ( $_GET['view'] == "list" ) {
              echo ucfirst( $_GET['key']." List" );
            } else {
              echo ucwords( $_GET['key'] );
            }
          } elseif ( isset( $_GET['create'] ) ) {
            echo "Create ".ucfirst( $_GET['create'].' ' );
          } elseif ( isset( $_GET['chat'] ) ) {
            if ( $_GET['chat'] == "list" ) {
              echo "Chats List";
            } else {
              echo "Chat ".ucfirst( $_GET['chat'] );
            }
          } elseif ( isset( $_GET['page'] ) ) {
            echo ucfirst( $_GET['page'].' Options' );
          } elseif ( isset( $_GET['edit'] ) && $_GET['key'] !== "" ) {
            echo 'Editing '.ucfirst( $_GET['key'].' ' );
          } elseif ( isset( $_GET['pay'] ) ) {
            echo "Pay Via ".strtoupper( $_GET['method'] );
          }
          ?></span>
          <div class="mdl-layout-spacer"></div><?php 
          if ( isCap( 'admin' ) ) { ?>
          <span class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon" id="happs">apps</span>
            <div class="mdl-tooltip" for="happs">Options</div><?php } ?>
            <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-card mdl-grid mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>" for="happs">
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
              <a class="" href="<?php _show_( hPORTAL . 'options?page=general' ); ?>"><i class="material-icons mdl-list__item-icon">settings</i></a>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
              <a class="" href="<?php _show_( hPORTAL . 'options?page=color' ); ?>"><i class="material-icons mdl-list__item-icon">palette</i></a>
            </div>
            <div class="mdl-cell">
            <a class="" href="<?php _show_( hPORTAL . 'shop?view=list&key=products' ); ?>"><i class="material-icons mdl-list__item-icon">store</i></a>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
            <a class="" href="<?php _show_( hPORTAL . 'shop?orders='.$_SESSION['myCode'] ); ?>"><i class="material-icons mdl-list__item-icon">shopping_basket</i></a>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
            <a class="" href="<?php _show_( hPORTAL . 'shop?payments='.$_SESSION['myCode'] ); ?>"><i class="material-icons mdl-list__item-icon">monetization_on</i></a>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
            <a class="" href="<?php _show_( hPORTAL . 'shop?author='.$_SESSION['myCode'] ); ?>"><i class="fa fa-cart-arrow-down mdl-list__item-icon" aria-hidden="true"></i></a>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
            <a class="" href="<?php _show_( hPORTAL . 'options?page=shop' ); ?>"><i class="material-icons mdl-list__item-icon">shopping_cart</i></a>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
              <a class="" href="<?php _show_( hPORTAL . 'post?view=list' ); ?>"><i class="material-icons mdl-list__item-icon">description</i></a>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
            <a class="" href="<?php _show_( hPORTAL . 'wapi?events=list' ); ?>"><i class="material-icons mdl-list__item-icon">date_range</i></a>
            </div>
          </ul>

          <a href="./notification?view=list" class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon notification" id="h_notifications"
               >
              notifications_none
          </a><div class="mdl-tooltip" for="h_notifications">Notifications</div>

          <a href="./message?view=unread&key=unread messages" class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon notification" id="h_messages"
                 data-badge="<?php getMsgCount() ?>">
                mail_outline
            </a><div class="mdl-tooltip" for="h_messages"><?php getMsgCount(); ?> Messages</div>

          <a href="#" class="material-icons mdl-js-button mdl-badge mdl-badge--overlap mdl-button--icon" id="hdrbtn">exit_to_app</a><div class="mdl-tooltip" for="hdrbtn">Logout</div>
          <div id="exitModal" class="modal">
              <div class="modal-content mdl-card mdl-shadow--2dp mdl-color--orange">
                <div class="mdl-card__title">
                  <div class="mdl-card__title-text">Are You Sure?</div>
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-card__subtitle-text">
                        
                    </div>
                  </div>
                  <div class="mdl-card__supporting-text">
                  <a href="<?php _show_( hROOT . '?logout=true' ); ?>">
                    <span class="alignleft">Yes, log me out.<br><center>
                   <i class="material-icons">done</i>
                    </center>
                    </span></a>

                    <div class="mdl-layout-spacer"></div>
                    <span class="alignright eclose">
                        Keep me logged in.<br>
                        <center>
                              <i class="material-icons mdl-button--icon">clear</i>
                        </center>
                    </span>
                  </div>
                </div>
            </div>

        <script>
        var emodal = document.getElementById('exitModal' );
        var h = document.getElementById( "hdrbtn" );
        var span = document.getElementsByClassName( "eclose" )[0];
        h.onclick = function() {
            emodal.style.display = "block";
        }
        span.onclick = function() {
            emodal.style.display = "none";
        }
        window.onclick = function(event) {
            if ( event.target == emodal ) {
               emodal.style.display = "none";
            }
        }
        </script>
        </div>
      </header>
      <div class="mdl-layout__drawer mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?> mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <a href="./user?view=<?php _show_( $_SESSION['myCode'] ); ?>&key=<?php _show_( $_SESSION['myAlias'] ); ?>">
            <img src="<?php _show_( $_SESSION['myAvatar'] ); ?>" class="demo-avatar">
          </a>
          <div class="demo-avatar-dropdown">
            <span><?php _show_( $_SESSION['myAlias'] ); ?></span>
            <div class="mdl-layout-spacer"></div>
            <a href="./user?edit=<?php _show_( $_SESSION['myCode'] ); ?>&key=<?php _show_( $_SESSION['myAlias'] ); ?>"><button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="mdi mdi-account-edit" role="presentation"></i></button></a>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
          <a class="mdl-navigation__link" href="./index?view=summary"><i class="mdl-color-text--white material-icons" role="presentation">insert_chart</i>Summary</a>
          <a class="mdl-navigation__link" id="husers" href="#"><i class="mdl-color-text--white material-icons" role="presentation">group</i>Contacts</a>
            <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-left mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>" for="husers">
                <a class="mdl-navigation__link" href="./user?view=list&key=users">
                    <i class="mdl-color-text--white material-icons" role="presentation">group</i>
                    All Users
                </a>
                <a class="mdl-navigation__link" id="husers" href="./user?view=list&type=doctor">
                    <i class="mdl-color-text--white material-icons" role="presentation">group</i>
                    Doctors
                </a>
                <a class="mdl-navigation__link" id="husers" href="./user?view=list&type=center">
                    <i class="mdl-color-text--white material-icons" role="presentation">supervisor_account</i>
                    Centers
                </a><?php if ( isCap( 'admin' ) ) { ?>
                <div class="mdl-layout-spacer"></div>
                <a class="mdl-navigation__link" href="./user?view=pending">
                    <i class="mdl-color-text--white material-icons" role="presentation">done</i>
                    Pending Users
                </a><?php } ?>
            </ul>
          <a id="hresources" class="mdl-navigation__link" href="#"><i class="mdl-color-text--white material-icons" role="presentation">local_hospital</i>Resources</a>
            <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-left mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>" for="hresources">

                <a class="mdl-navigation__link" href="./resource?view=list&location=<?php _show_( strtolower( $_SESSION['myLocation'] ) ); ?>&type=ambulance">
                    <i class="material-icons" role="presentation">directions_car</i>
                    Nearby Ambulances
                </a>

                <a class="mdl-navigation__link" id="husers" href="./resource?view=list&location=<?php _show_( strtolower( $_SESSION['myLocation'] ) ); ?>&type=lab">
                    <i class="mdl-color-text--white material-icons" role="presentation">business</i>
                    Nearby Labs
                </a>

                <a class="mdl-navigation__link" id="husers" href="./resource?view=list&location=<?php _show_( strtolower( $_SESSION['myLocation'] ) ); ?>&type=morgue">
                    <i class="mdl-color-text--white material-icons" role="presentation">location_city</i>
                    Nearby Morgues
                </a>
                <div class="mdl-layout-spacer"></div>

                <a class="mdl-navigation__link" href="./user?view=list&location=<?php _show_( strtolower( $_SESSION['myLocation'] ) ); ?>&type=center">
                    <i class="material-icons" role="presentation">room</i>
                    Nearby Centers
                </a>
            </ul>
          <a id="hservices" class="mdl-navigation__link" href="#"><i class="mdl-color-text--white material-icons" role="presentation">link</i>My Services</a>
            <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>" for="hservices">
                <a class="mdl-navigation__link" href="./service?view=list">
                    <i class="material-icons" role="presentation">link</i>
                    My Services
                </a>
                <a class="mdl-navigation__link" id="husers" href="./service?view=list&status=pending">
                    <i class="mdl-color-text--white material-icons" role="presentation">schedule</i>
                    Pending Requests
                </a>
                <a class="mdl-navigation__link" href="./service?create=request">
                    <i class="mdl-color-text--white material-icons" role="presentation">create</i>
                    Request Service
                </a>
            </ul>
          <a id="hmessages" class="mdl-navigation__link" href="#"><i class="mdl-color-text--white material-icons" role="presentation">mail</i>My Messages</a>
            <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>" for="hmessages">
                <a class="mdl-navigation__link" href="./message?view=list&type=message">
                    <i class="material-icons" role="presentation">message</i>
                    My Messages
                </a>

                <a class="mdl-navigation__link" href="./message?view=sent&key=messages">
                    <i class="material-icons" role="presentation">message</i>
                    Sent Messages
                </a>

                <a class="mdl-navigation__link" href="./message?view=unread&key=messages">
                    <i class="material-icons" role="presentation">message</i>
                    Unread Messages
                </a>
            </ul>
          <div class="mdl-layout-spacer"></div>
          
          <a id="hpref" class="mdl-navigation__link" href="#"><i class="mdl-color-text--white material-icons" role="presentation">settings</i>Preferences</a>
            <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>" for="hpref">
            <a class="mdl-navigation__link" href="./options?page=color"><i class="mdl-color-text--white material-icons" role="presentation">color_lens</i><span>Theme Options</span></a><?php 
          if ( isCap( 'admin' ) ) { ?>
          <a class="mdl-navigation__link" href="./menus"><i class="mdl-color-text--white material-icons" role="presentation">menu</i><span>Menu Options</span></a>
          <a class="mdl-navigation__link" href="./options?page=general"><i class="mdl-color-text--white material-icons" role="presentation">settings</i><span>General Settings</span></a>
          <?php } ?>
            </ul>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--">