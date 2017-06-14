<?php include 'header.php'; ?>
<title>Frequently Asked Questions [ <?php getOption( 'name' ); ?> ]</title>
  <?php 
    $getfaqs = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hfaqs" );
    if ( $getfaqs) { ?>
      <div class="mdl-grid ">
        <div class="mdl-card mdl-cell mdl-cell--12-col mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
          <ul class="collapsible popout" data-collapsible="accordion">
            <li>
              <div class="collapsible-header"><i class="material-icons">help</i>Ask for Help</div>
              <div class="collapsible-body">
              <?php $hForm -> faqForm(); ?>
              </div>
            </li><?php 
            while ( $faq = mysqli_fetch_assoc( $getfaqs) ) { ?>
              <li>
                <div class="collapsible-header"><i class="material-icons">help_outline</i>'.$faq['h_alias'].'</div>
                <div class="collapsible-body"><span>'.$faq['h_description'].'</span></div>
              </li><?php 
            } ?>
          </ul>
        </div>
      </div><?php 
    }
include 'footer.php';