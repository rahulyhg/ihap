<?php 

include './header.php'; ?>
<title>Menus [ <?php getOption( 'name' ); ?> ]</title>
<div class="mdl-grid">

<div class="mdl-cell mdl-cell--9-col-desktop mdl-cell--9-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
    
    <div class="mdl-card__title">
      <span class="mdl-button">Menus</span>
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-card__subtitle-text mdl-button">
            <i class="material-icons">menu</i>
        </div>
    </div>
    <div class="mdl-card__supporting-text">
        <ul id="tabs-swipe-demo" style="border-radius: 5px;" class="tabs mdl-card__title mdl-card--expand">
          <li class="tab col s3"><a class="active" href="#drawer">drawer</a></li>
          <li class="tab col s3"><a href="#header">header</a></li>
          <li class="tab col s3"><a href="#main">main</a></li>
          <li class="tab col s3"><a href="#footer">footer</a></li>
        </ul>
        <div id="drawer" class="mdl-tabs vertical-mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
            <div class="mdl-grid mdl-card">
            <div class="mdl-cell mdl-cell--3-col mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                <div class="mdl-tabs__tab-bar ">

                     <a href="#tab1-panel" class="mdl-tabs__tab is-active">Summary
                     </a>
                     <a href="#tab2-panel" class="mdl-tabs__tab">Blog
                      </a>
                      <a href="#tab3-panel" class="mdl-tabs__tab">Users
                      </a>
                  <a href="#tab3-panel" class="mdl-tabs__tab">Settings
                  </a>
                  <a href="#tab3-panel" class="mdl-tabs__tab">Theme
                  </a>
                </div>
           </div>
           <div class="mdl-cell mdl-cell--9-col mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                <div class="mdl-tabs__panel is-active" id="tab1-panel">
                    <form class="mdl-grid">
                      <div class="input-field mdl-cell">
                        <i class="material-icons prefix">label</i>
                      <input id="h_by" name="h_by" type="text">
                      <label for="h_by">Label</label>
                      </div>

                      <div class="input-field mdl-cell">
                        <i class="material-icons prefix">link</i>
                      <input id="h_email" name="h_email" type="text">
                      <label for="h_email">Link</label>
                      </div>

                      <div class="input-field mdl-cell">
                        <i class="material-icons prefix">code</i>
                      <input id="h_phone" name="h_phone" type="text">
                      <label for="h_phone">Icon</label>
                      </div>
                    </form>

                      <button type="submit" name="" class="mdl-button mdl-button--fab alignright"><i  class="material-icons">save</i></button>
                    <h6>New Menu Item</h6><br>
                    <form class="mdl-grid">
                      <div class="input-field mdl-cell">
                        <i class="material-icons prefix">label</i>
                      <input id="h_by" name="h_by" type="text">
                      <label for="h_by">Label</label>
                      </div>

                      <div class="input-field mdl-cell">
                        <i class="material-icons prefix">link</i>
                      <input id="h_email" name="h_email" type="text">
                      <label for="h_email">Link</label>
                      </div>

                      <div class="input-field mdl-cell">
                        <i class="material-icons prefix">code</i>
                      <input id="h_phone" name="h_phone" type="text">
                      <label for="h_phone">Icon</label>
                      </div>
                    </form>
                </div>
                <div class="mdl-tabs__panel" id="tab2-panel">
                     Content 2
                </div>
                <div class="mdl-tabs__panel" id="tab3-panel">
                      Content 3
                </div>
            </div>
          </div>
        </div>
        <div id="header"></div>
        <div id="main"></div>
        <div id="footer"></div>
    </div>
</div>

<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
    
    <div class="mdl-card__title">
      <span class="mdl-button">Tips</span>
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-card__subtitle-text mdl-button">
            <i class="material-icons">info</i>
        </div>
    </div>
    <div class="mdl-card__supporting-text">
        <ul class="collapsible popout" data-collapsible="accordion">
            <li>
              <div class="collapsible-header active"><i class="material-icons">label</i>
                  <b>Adding Menus</b>
              </div>
              <div class="collapsible-body">
              </div>
            </li>
            <li>
              <div class="collapsible-header"><i class="material-icons">label_outline</i>
                  <b>Adding Items</b>
              </div>
              <div class="collapsible-body">
              </div>
            </li>
      </ul>
    </div>
</div>

</div><?php 
include './footer.php';
