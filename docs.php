<?php include 'header.php'; ?>
<title>Jabali Docs [ <?php getOption( 'name' ); ?> ]</title>
  <div id="drawer" class="mdl-tabs vertical-mdl-tabs mdl-js-tabs mdl-js-ripple-effect mdl-grid">
            <div class="mdl-cell mdl-cell--12-col mdl-grid mdl-grid--no-spacing mdl-card mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
            <div class="mdl-cell mdl-cell--2-col">
                <div class="mdl-tabs__tab-bar ">

                     <a href="#tab1-panel" class="mdl-tabs__tab is-active">preparations<span class="mdl-list__item-icon material-icons alignright">query_builder</span>
                     </a>
                     <a href="#tab2-panel" class="mdl-tabs__tab">db constants<span class="mdl-list__item-icon material-icons alignright">public</span>
                     </a>
                      <a href="#tab3-panel" class="mdl-tabs__tab">installation<span class="mdl-list__item-icon material-icons alignright">power_settings_new</span>
                     </a>
                  <a href="#tab3-panel" class="mdl-tabs__tab">customization<span class="mdl-list__item-icon material-icons alignright">palette</span>
                     </a>
                  <a href="#tab3-panel" class="mdl-tabs__tab">permisions<span class="mdl-list__item-icon material-icons alignright">lock</span>
                     </a>
                  <a href="#tab3-panel" class="mdl-tabs__tab">preferences<span class="mdl-list__item-icon material-icons alignright">settings</span>
                     </a>
                  <a href="#tab3-panel" class="mdl-tabs__tab">extensions<span class="mdl-list__item-icon material-icons alignright">power_settings_on</span>
                     </a>
                  <a href="#tab3-panel" class="mdl-tabs__tab">advanced<span class="mdl-list__item-icon material-icons alignright">developer_mode</span>
                     </a>
                </div>
           </div>
           <div class="mdl-cell mdl-cell--10-col">
                <div class="mdl-tabs__panel is-active" id="tab1-panel"><h6>
                  Once we’ve added them, we can start building the UI with colors as per defined in the main stylesheet name. The main stylesheet is named according to the following convention: material.{primary}-{accent}.min.css. Our primary color here is teal while red is the accent color. These colors are applied to components like the navigation and the buttons, but they won’t influence the Grid unless we add special classes like .mdl-color--primary and .mdl-color--accent.

You can change the color combination to whatever you prefer by referring to the Material Design color specification, for example: material.purple-pink.min.css,material.blue_grey-pink.min.css, and material.blue-orange.min.css.

However, if you find specifying the color combination within the css file unintuitive, you can always use the Customize tool instead. Select whichever colors you need, then, replace the main stylesheet link with one generated through the tool.</h6><h6>
                  Once we’ve added them, we can start building the UI with colors as per defined in the main stylesheet name. The main stylesheet is named according to the following convention: material.{primary}-{accent}.min.css. Our primary color here is teal while red is the accent color. These colors are applied to components like the navigation and the buttons, but they won’t influence the Grid unless we add special classes like .mdl-color--primary and .mdl-color--accent.

You can change the color combination to whatever you prefer by referring to the Material Design color specification, for example: material.purple-pink.min.css,material.blue_grey-pink.min.css, and material.blue-orange.min.css.

However, if you find specifying the color combination within the css file unintuitive, you can always use the Customize tool instead. Select whichever colors you need, then, replace the main stylesheet link with one generated through the tool.</h6>
                </div>
                <div class="mdl-tabs__panel" id="tab2-panel">
                     <h5>Database Host</h5>
                     Usually "localhost"
                     <h5>Database Username</h5>
                     "root" if you are using a development environment.
                     <h5>Database Password</h5>
                      XAMPP/WAMPP/LAMPP usually the password set to null.
                     <h5>Database Name</h5>
                     This is the database you are connecting to. Make sure it exists first before starting the setup process.<h5><br></h5>
                </div>
                <div class="mdl-tabs__panel" id="tab3-panel">
                      Content 3
                </div>
            </div>
          </div>
        </div><?php 
include 'footer.php';