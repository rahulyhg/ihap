<?php include './header.php'; ?>
<title>About [ <?php getOption( 'name' ); ?> ]</title>
    <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout">
      <div class="demo-main mdl-layout__content">
      <div class="demo-ribbon mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ){ primaryColor( $_SESSION['myCode'] ); } else { echo "grey"; } ?>" style="background: url(<?php echo hIMAGES.'logo.png' ?> );">
      <center><img src="<?php echo hIMAGES.'logo-w.png' ?>" width="250px;"></center></div>
      
        <div class="demo-container mdl-grid">
          <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
            <b><h3><?php getOption( 'name' ); ?></h3></b>
            <br><br>
            <div>
            <article class="mdl-color-text--black">
              <?php getOption( 'description' ); ?>
            </article>
            </div>
        </div>
      </div>
    </div>
<?php include './footer.php';

