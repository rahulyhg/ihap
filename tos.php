<?php include 'header.php'; ?>
<title>Terms Of Service [ <?php getOption( 'name' ); ?> ]</title>
<div class="mdl-grid ">
	 <div class="mdl-card mdl-cell mdl-cell--12-col mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?> mdl-shadow--2dp">
	  	<div class="mdl-cell mdl-cell--12-col">
	  	<?php getOption( 'tos' ); ?>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>