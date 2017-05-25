<?php
session_start();

include '../functions/jabali.php';

if (!isset($_SESSION['myCode'])) {
	header("Location: ../login");
}

connectDb();

$hUser = new _hUsers();
$hForm = new _hForms();
$hResource = new _hResources();
$hService = new _hServices();
$hMessage = new _hMessages();
$hNotification = new _hNotifications();
$hArticle = new _hArticles();


?>
<!doctype html>
<!--
  Integrated Health Access Portal
  © 2017 Mauko Maunde. All rights reserved.

  Licensed under the MIT license (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at 
-->
<html lang="en">
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
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/"> -->

    <link rel="stylesheet" href='<?php echo hASSETS; ?>css/lib/getmdl-select.min.css'>
    <link rel="stylesheet" href="<?php echo hASSETS; ?>css/lib/nv.d3.css">
    <link rel="stylesheet" href="<?php echo hASSETS; ?>css/materialize.css">
    <link rel="stylesheet" href="<?php echo hASSETS; ?>css/material-icons.css">
    <link rel="stylesheet" href="<?php echo hASSETS; ?>css/materialdesignicons.css">
    <link rel="stylesheet" href="<?php echo hASSETS; ?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>ihap.css">
    <style type="text/css">
    .mdl-data-table {
    background-color: <?php primaryColor($_SESSION['myCode']); ?>;
    color: white;
    }
    </style>

    <script src="<?php echo hASSETS; ?>js/jquery.js"></script>
    <script src="<?php echo hASSETS; ?>js/ckeditor/ckeditor.js"></script>
    <script>
    $(document).ready(function($) {

    $('.card__share > a').on('click', function(e){ 
        e.preventDefault() // prevent default action - hash doesn't appear in url
        $(this).parent().find( 'div' ).toggleClass( 'card__social--active' );
        $(this).toggleClass('share-expanded');
    });

    });
    </script>

    <script>
    $(document).ready(function($) {

    $('.card__share > a').on('click', function(e){ 
        e.preventDefault() // prevent default action - hash doesn't appear in url
        $(this).parent().find( 'div' ).toggleClass( 'card__social_me--active' );
        $(this).toggleClass('share-expanded');
    });

    });
    </script>
    <script>
    $(document).ready(function(){
        $("#hide").click(function(){
            $("modal").hide();
        });
        $("#show").click(function(){
            $("modal").show();
        });
    });
    </script>
    
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--<?php primaryColor($_SESSION['myCode']); ?> mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title"><?php 
          if (isset($_GET['type'])) {
            echo ucfirst($_GET['type'].'s ');
          }

          if (isset($_GET['view']) && $_GET['key'] !== "" ) {
            if ($_GET['view'] == "list") {
              echo ucfirst($_GET['key']." List");
            } else {
              echo ucfirst( $_GET['key'] );
            }
          }

          if (isset($_GET['create'])) {
            echo "Create ".ucfirst($_GET['create'].' ');
          }

          if (isset($_GET['chat'])) {
            if ($_GET['chat'] == "list") {
              echo "Chats List";
            } else {
              echo "Chat ".ucfirst($_GET['chat']);
            }
          }

          if (isset( $_GET['page'] )) {
            echo ucfirst($_GET['page'].' Options');
          }

          if (isset( $_GET['edit'] ) && $_GET['key'] !== "" ) {
            echo 'Editing '.ucfirst($_GET['key'].' ');
          }
          ?></span>
          <div class="mdl-layout-spacer"></div>
          <span class="material-icons mdl-badge mdl-badge--overlap notification" id="addbtn">
            <i class="material-icons">add</i>
          </span>
          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--<?php primaryColor($_SESSION['myCode']); ?>" for="addbtn">
            <a class="mdl-menu__item mdl-list__item" href="<?php show( hPORTAL . 'user?create' ); ?>"><i class="material-icons mdl-list__item-icon">account_circle</i><span style="padding-left: 20px">User</span></a>
            <a class="mdl-menu__item mdl-list__item"href="<?php show( hPORTAL . 'resource?create'); ?>"><i class="material-icons mdl-list__item-icon">local_hospital</i><span style="padding-left: 20px">Resource</span></a>
            <a class="mdl-menu__item mdl-list__item"href="<?php show( hPORTAL . 'notification?create'); ?>"><i class="material-icons mdl-list__item-icon">notifications</i><span style="padding-left: 20px">Notification</span></a>
          </ul>

          <a href="<?php echo hPORTAL.'article?view=list'; ?>" class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon notification" id="h_service">description</a>
            <div class="mdl-tooltip" for="h_service">Articles</div>

          <a href="./notification?view=list" class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon notification" id="h_notifications"
               >
              notifications_none
          </a><div class="mdl-tooltip" for="h_notifications">Notifications</div>

          <a href="./message?view=list" class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon notification" id="h_messages"
                 data-badge="<?php getMsgCount() ?>">
                mail_outline
            </a><div class="mdl-tooltip" for="h_messages"><?php getMsgCount(); ?> Messages</div>

          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
            <i class="material-icons">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--<?php primaryColor($_SESSION['myCode']); ?>" for="hdrbtn">
            <a class="mdl-menu__item mdl-list__item" href="<?php show( hROOT . 'about' ); ?>"><i class="material-icons mdl-list__item-icon">account_circle</i><span style="padding-left: 20px">About IHAP</span></a>
            <a class="mdl-menu__item mdl-list__item"href="<?php show( hROOT . 'contact');?>"><i class="material-icons mdl-list__item-icon">link</i><span style="padding-left: 20px">Request Service</span></a>
            <a class="mdl-menu__item mdl-list__item"href="<?php show( hROOT . 'logout?action=true' );?>"><i class="material-icons mdl-list__item-icon text-color--secondary">exit_to_app</i><span style="padding-left: 20px">Logout</span></a>
          </ul>
        </div>
      </header>
      <div class="mdl-layout__drawer mdl-color--<?php primaryColor($_SESSION['myCode']); ?> mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <a href="./user?view=<?php show( $_SESSION['myCode'] ); ?>&key=<?php show( $_SESSION['myAlias'] ); ?>">
            <img src="<?php show( $_SESSION['myAvatar'] ); ?>" class="demo-avatar">
          </a>
          <div class="demo-avatar-dropdown">
            <span><?php show( $_SESSION['myAlias'] ); ?></span>
            <div class="mdl-layout-spacer"></div>
            <a href="./user?edit=<?php echo $_SESSION['myCode']; ?>"><button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="mdi mdi-account-edit" role="presentation"></i></button></a>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--<?php primaryColor($_SESSION['myCode']); ?>">
          <a class="mdl-navigation__link" href="./index?view=summary"><i class="mdl-color-text--white material-icons" role="presentation">insert_chart</i>Summary</a>
          <a class="mdl-navigation__link" id="husers" href="#"><i class="mdl-color-text--white material-icons" role="presentation">group</i>Contacts</a>
            <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-left mdl-color--<?php primaryColor($_SESSION['myCode']); ?>" for="husers">
                <a class="mdl-navigation__link mdl-navigation__link--current" href="./user?view=list&key=users">
                    <i class="mdl-color-text--white material-icons" role="presentation">group</i>
                    All Users
                </a>
                <a class="mdl-navigation__link" id="husers" href="./user?view=list&type=doctor">
                    <i class="mdl-color-text--white material-icons" role="presentation">group</i>
                    Doctors
                </a>
                <a class="mdl-navigation__link" href="./user?view=list&type=nurse">
                    <i class="mdl-color-text--white material-icons" role="presentation">supervisor_account</i>
                    Nurses
                </a>
                <a class="mdl-navigation__link" id="husers" href="./user?view=list&type=manager">
                    <i class="mdl-color-text--white material-icons" role="presentation">people</i>
                    Managers
                </a>
                <a class="mdl-navigation__link" href="./user?view=list&action=view&type=patient">
                    <i class="mdl-color-text--white material-icons" role="presentation">people</i>
                    Patients
                </a>
                <div class="mdl-layout-spacer"></div>
                <a class="mdl-navigation__link" href="./user?view=<?php echo $_SESSION['myCode']; ?>">
                    <i class="mdl-color-text--white material-icons" role="presentation">account_circle</i>
                    My Profile
                </a>
            </ul>
          <a id="hresources" class="mdl-navigation__link" href="#"><i class="mdl-color-text--white material-icons" role="presentation">local_hospital</i>Resources</a>
            <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left mdl-color--<?php primaryColor($_SESSION['myCode']); ?>" for="hresources">
                <a class="mdl-navigation__link mdl-navigation__link--current" href="./resource?center=list">
                    <i class="material-icons" role="presentation">business</i>
                    All Centers
                </a>
                <a class="mdl-navigation__link" id="husers" href="./resource?location=<?php echo strtolower($_SESSION['myLocation']); ?>">
                    <i class="mdl-color-text--white material-icons" role="presentation">room</i>
                    Centers In My Area
                </a>
            </ul>
          <a id="hservices" class="mdl-navigation__link" href="#"><i class="mdl-color-text--white material-icons" role="presentation">link</i>My Services</a>
            <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left mdl-color--<?php primaryColor($_SESSION['myCode']); ?>" for="hservices">
                <a class="mdl-navigation__link mdl-navigation__link--current" href="./service?view=list">
                    <i class="material-icons" role="presentation">link</i>
                    My Services
                </a>
                <a class="mdl-navigation__link" id="husers" href="./service?view=pending">
                    <i class="mdl-color-text--white material-icons" role="presentation">schedule</i>
                    Pending Requests
                </a>
                <a class="mdl-navigation__link" href="./service?create=request">
                    <i class="mdl-color-text--white material-icons" role="presentation">note_add</i>
                    Request For A Service
                </a>
            </ul>
          <a id="hmessages"class="mdl-navigation__link" href="#"><i class="mdl-color-text--white material-icons" role="presentation">mail_outline</i>My Messages</a>
            <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left mdl-color--<?php primaryColor($_SESSION['myCode']); ?>" for="hmessages">
                <a class="mdl-navigation__link mdl-navigation__link--current" href="./message?view=list">
                    <i class="material-icons" role="presentation">message</i>
                    Messages
                </a>
                <a class="mdl-navigation__link" id="husers" href="./message?chat=list">
                    <i class="mdl-color-text--white material-icons" role="presentation">chat</i>
                    Chats
                </a>
                <a class="mdl-navigation__link" href="./message?create=message">
                    <i class="mdl-color-text--white material-icons" role="presentation">comment</i>
                    New Message
                </a>
                <a class="mdl-navigation__link" id="husers" href="./message?create=chat">
                    <i class="mdl-color-text--white material-icons" role="presentation">chat_bubble</i>
                    New Chat
                </a>
            </ul>
          <a class="mdl-navigation__link" href="./notification?view=list"><i class="mdl-color-text--white material-icons" role="presentation">notifications</i>Notifications</a>
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link" href="./options?page=theme"><i class="mdl-color-text--white material-icons" role="presentation">settings</i><span>Preferences</span></a>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--<?php primaryColor($_SESSION['myCode']); ?>-100">