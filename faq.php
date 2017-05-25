<?php include 'header.php'; ?>
<title>Frequently Asked Questions [ IHAP ]</title>
  <?php 
    $getfaqs = mysqli_query($GLOBALS['conn'], "SELECT * FROM hfaqs");
    if ($getfaqs) {
      ?><div class="mdl-grid ">
            <div class="mdl-card mdl-cell mdl-cell--12-col mdl-color--<?php primaryColor($_SESSION['myCode']); ?>">
            <ul class="collapsible popout" data-collapsible="accordion">
            <li>
              <div class="collapsible-header"><i class="material-icons">help</i>Ask for Help</div>
              <div class="collapsible-body">
              <form>
              <div class="input-field inline">
                <i class="material-icons prefix">account_circle</i>
              <input id="h_by" name="h_by" type="text">
              <label for="h_by">Your Name</label>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">mail_outline</i>
              <input id="h_email" name="h_email" type="text">
              <label for="h_email">Your Email</label>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">phone</i>
              <input id="h_phone" name="h_phone" type="text">
              <label for="h_phone">Phone (Optional)</label>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">person_pin_circle</i>
              <input id="h_location" name="h_phone" type="text">
              <label for="h_location">Location (Optional)</label>
              </div>

              <div class="input-field">
              <textarea rows="5" id="h_description" name="h_description" ></textarea><script>CKEDITOR.replace( "h_description" );</script>
              <label for="h_description">Your Question</label>
              </div>
              <button type="submit" name="" class="mdl-button mdl-button--fab"><i  class="material-icons">send</i></button>
              </form>
              </div>
            </li><?php
      while ($faq = mysqli_fetch_assoc($getfaqs)) {
        echo '<li>
              <div class="collapsible-header"><i class="material-icons">help_outline</i>'.$faq['h_alias'].'</div>
              <div class="collapsible-body"><span>'.$faq['h_description'].'</span></div>
            </li>';
      }
      echo '</ul>
            </div>
            </div>';
    }
  ?>
  
</div>
<?php include 'footer.php';