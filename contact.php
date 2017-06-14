<?php include './header.php'; ?>
<title>About [ <?php getOption( 'name' ); ?> ]</title>
    <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
      <div class="demo-main mdl-layout__content">
      <div class="demo-ribbon mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ){ primaryColor( $_SESSION['myCode'] ); } else { echo "grey"; } ?>" style="background: url(<?php echo hIMAGES.'logo.png' ?> );">
      <center><img src="<?php echo hIMAGES.'logo-w.png' ?>" width="250px;"></center></div>
      
        <div class="demo-container mdl-grid">
          <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
            <div ><br><br>
              <h5>Get In Touch</h5>
              <?php $hForm -> contactForm(); ?>
          </div>
        </div>
      </div>


      <span class="addfab mdl-button mdl-button--fab notification mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>" id="addfab" >
        <i class="material-icons mdl-badge mdl-badge--overlap" >chat</i>
        </span><div class="mdl-tooltip" for="addfab">My Cart</div>

          <div id="messageModal" class="modal">
              <div class="modal-content mdl-card mdl-shadow--2dp mdl-color--teal">
                <div class="mdl-card__title">
                  <div class="mdl-card__title-text mdl-button">
                        <i class="material-icons">question_answer</i> Get In Touch
                        </div>
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-card__subtitle-text">
                        <span class="close">
                        <i class="material-icons">clear</i>
                        </span>
                    </div>
                  </div>
                  <div class="mdl-card__supporting-text">
                    <form enctype="multipart/form-data" class="" name="payForm" method="POST" action=""><br>
                      <div class="input-field inline">
                        <i class="material-icons prefix">label</i>
                        <input type="text" name="h_by" value="<?php _show_( $_SESSION['myAlias'] ); ?>">
                        <label>Your Name</label>
                      </div>

                      <div class="input-field inline">
                        <i class="material-icons prefix">mail</i>
                        <input type="text" name="h_email" value="<?php _show_( $_SESSION['myEmail'] ); ?>">
                        <label>Your Email</label>
                      </div>

                      <div class="input-field">
                        <i class="material-icons prefix">mail</i>
                        <textarea class="materialize-textarea col s12" type="text" id="h_descryiption" rows="5" name="h_description"></textarea><script>CKEDITOR.replace( 'h_descryiption' );</script>
                        <label>Your Message</label>
                      </div>

                      <div class="input-field inline alignright">
                    <button class="mdl-button mdl-button--fab mdl-js-button mdl-button--colored mdl-js-ripple-effect " type="submit" name="send"><i class="material-icons">send</i></button>
                    </div>
                    </form>
                  </div>
                </div>
            </div>

        <script>
        var modal = document.getElementById('messageModal' );
        var h = document.getElementById( "addfab" );
        var span = document.getElementsByClassName( "close" )[0];
        h.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if ( event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>
    </div>
<?php include './footer.php';

