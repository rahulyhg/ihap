<?php
/**
* Social Sharing & icons
*/
class _hSocial {
  function __construct()
  {
    # code...
  }

  function shareArticle() {
    
  echo '<div class="card__share">
          <div class="card__social">  
              <a class="share-icon facebook" href=""><span class="fa fa-facebook"></span></a>

              <a class="share-icon twitter" href="http://twitter.com/share?url='.hROOT.'blog/&text='.$articlesDetails['h_alias'].'&via=@jfwork"><span class="fa fa-twitter"></span></a>

              <a class="share-icon googleplus" href="#"><span class="fa fa-google-plus"></span></a>

              <a class="share-icon whatsapp" href="whatsapp://send?text=<?php echo $post_title; ?>" data-action="share/whatsapp/share"><span class="fa fa-whatsapp"></span></a>

              <a class="share-icon email" href="mailto:sample@email.com" data-rel="external"><span class="fa fa-envelope"></span></a>
          </div>

          <a id="share" class="share-toggle share-icon mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" href="#"><i class="material-icons">share</i></a>
        </div>';
}
}
 ?>