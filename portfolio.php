<?php 
/**
* @package Jabali Framework
* @subpackage Home
* @link https://docs.mauko.co.ke/jabali/home
* @author Mauko Maunde
* @version 0.17.06
**/

include 'header.php'; ?>
<title>My Portfolio [ <?php getOption( 'name' ); ?> ]</title>
<script>
var options = {
        valueNames: ['material', 'quantity', 'price']
    }
  , documentTable = new List('mdl-table', options)
  ;


$( $('th.sort' )[0] ).trigger('click', function () {
  console.log('clicked' );
} );

$('input.search' ).on('keyup', function (e) {
  if ( e.keyCode === 27) {
    $(e.currentTarget).val('' );
    documentTable.search('' );
  }
} );
</script>
<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp mdl-color">

  <ul id="tabs-swipe-demo" style="border-radius: 5px;" class="tabs mdl-card__title">
      <li class="tab col s3"><a class="mdl-color--teal active" href="#test-swipe-1">All</a></li>
      <li class="tab col s3"><a href="#test-swipe-2">Websites</a></li>
      <li class="tab col s3"><a href="#test-swipe-3">Flyers</a></li>
      <li class="tab col s3"><a href="#test-swipe-4">Web Apps</a></li>
      <li class="tab col s3"><a href="#test-swipe-5">Android Apps</a></li>
      <li class="tab col s3"><a href="#test-swipe-6">Web/Email Hosting</a></li>
      <li class="tab col s3"><a href="#test-swipe-7">Graphic Design</a></li>
  </ul>
  <div id="test-swipe-1" class="col s12"><?php $hPost -> getArticles(); ?></div>
  <div id="test-swipe-2" class="col s12">2</div>
  <div id="test-swipe-3" class="col s12">3</div>
  <div id="test-swipe-4" class="col s12">1</div>
  <div id="test-swipe-5" class="col s12">2</div>
  <div id="test-swipe-6" class="col s12">3</div>
  </div>
</div>
<?php 
include 'footer.php';
?>