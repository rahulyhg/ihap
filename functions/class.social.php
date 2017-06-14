<?php 
/**
* Social Sharing & icons
*/
class _hSocial {

  function socShare( $type) {
    
  echo '<div class="card__share">
          <div class="card__social">  
              <a class="share-icon facebook" href=""><span class="fa fa-facebook"></span></a>

              <a class="share-icon twitter" href="http://twitter.com/share?url='.hROOT.'blog/&text='.$postsDetails['h_alias'].'&via=@jfwork"><span class="fa fa-twitter"></span></a>

              <a class="share-icon googleplus" href="#"><span class="fa fa-google-plus"></span></a>

              <a class="share-icon whatsapp" href="whatsapp://send?text=<?php echo $post_title; ?>" data-action="share/whatsapp/share"><span class="fa fa-whatsapp"></span></a>

              <a class="share-icon email" href="mailto:sample@email.com" data-rel="external"><span class="fa fa-envelope"></span></a>
          </div>

          <a id="share" class="share-toggle share-icon mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" href="#"><i class="material-icons">share</i></a>
        </div>';
  }

  function bottomshare( $code) { 
    $getPostCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts WHERE h_code = '".$code."'" );
    if ( $getPostCode -> num_rows > 0) {
      while ( $postDetails = mysqli_fetch_assoc( $getPostCode)){
        $post[] = $postDetails;
      }
    }
    ?>
    <div class="fixed-action-btn horizontal click-to-toggle">
              <a class="btn-floating btn-large mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) {
            secondaryColor( $_SESSION['myCode'] );
        } else { echo "red";}  ?>">
                <i class="material-icons">share</i>
              </a>
              <ul>
                <li><a href="https://www.facebook.com/dialog/share?app_id=1084251448343450&display=page&href=<?php _show_( $post[0]['h_link'] ); ?>&redirect_uri={redirect_url}" class="btn-floating mdl-color--indigo"><i class="fa fa-facebook"></i></a></li>

                <li><a href="https://twitter.com/intent/tweet?url=<?php _show_( $post[0]['h_link'] ); ?>&text=<?php _show_( $post[0]['h_alias'] ); ?>&via={via}&hashtags={hashtags}" class="btn-floating mdl-color--light-blue"><i class="fa fa-twitter"></i></a></li>

                <li><a href="https://plus.google.com/share?url=<?php _show_( $post[0]['h_link'] ); ?>" class="btn-floating mdl-color--red"><i class="fa fa-google-plus"></i></a></li>

                <li><a href="whatsapp://send?text=<?php _show_( $post[0]['h_alias'] ); ?><?php _show_( $post[0]['h_alias'] ); ?>" class="btn-floating mdl-color--green"><i class="fa fa-whatsapp"></i></a></li>

                <li><a href="https://pinterest.com/pin/create/bookmarklet/?media={img}&url={url}&is_video={is_video}&description={title}" class="btn-floating mdl-color--red"><i class="fa fa-pinterest"></i></a></li>

                <li><a href="https://www.linkedin.com/shareArticle?url={url}&title=<?php _show_( $post[0]['h_alias'] ); ?>" class="btn-floating mdl-color--blue"><i class="fa fa-linkedin"></i></a></li>

                <li><a href="" class="btn-floating mdl-color--grey"><i class="fa fa-envelope"></i></a></li>
              </ul>
            </div><?php 
  }

  function bottomsocial( $facebook,$twitter, $github, $linkedin, $tel, $mail) { ?>
    <div class="fixed-action-btn horizontal click-to-toggle">
              <a class="btn-floating btn-large mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) {
            secondaryColor( $_SESSION['myCode'] );
        } else { echo "red";}  ?>">
                <i class="material-icons">public</i>
              </a>
              <ul>
                <li><a href="<?php _show_( $facebook ); ?>" class="btn-floating mdl-color--indigo"><i class="fa fa-facebook"></i></a></li>

                <li><a href="https://twitter.com/intent/tweet?url={url}&text={title}&via={via}&hashtags={hashtags}" class="btn-floating mdl-color--light-blue"><i class="fa fa-twitter"></i></a></li>

                <li><a href="<?php _show_( $github ); ?>" class="btn-floating mdl-color--purple"><i class="fa fa-github"></i></a></li>

                <li><a href="<?php _show_( $linkedin ); ?>" class="btn-floating mdl-color--blue"><i class="fa fa-linkedin"></i></a></li>

                <li><a href="tel:<?php _show_( $tel ); ?>" class="btn-floating mdl-color--green"><i class="fa fa-phone"></i></a></li>

                <li><a href="mailto:<?php _show_( $mail ); ?>" class="btn-floating mdl-color--grey"><i class="fa fa-envelope"></i></a></li>
              </ul>
            </div><?php 
  }
  
}
 ?>