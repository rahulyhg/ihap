<?php 

class _hPoems extends _hPosts {
  
  function getPoems() { ?>
  <title>All Poems [ <?php getOption( 'name' ); ?> ]</title>
    <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone "><?php 
            $getPoems = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts WHERE h_author = '".$_SESSION['myCode']."'" );
            if ( $getPoems -> num_rows >= 0) { ?>
                <ul class="collapsible popout " data-collapsible="accordion"><?php 
                    while ( $note = mysqli_fetch_assoc( $getPoems) ) { ?>
                    <li>
                      <div class="collapsible-header mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><i class="material-icons">label_outline</i>
                        
                          <b><?php _show_( $note['h_alias'] ); ?></b><span class="alignright"><a href="./post?view=<?php _show_( $note['h_code'] ); ?>" ><i class="material-icons">open_in_new</i></a></span>
                      </div>
                      <div class="collapsible-body mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                          <span><?php 
                          _show_( $note['h_description'] ); ?></span>
                      </div>
                    </li><?php 
                    } ?>
              </ul><?
            } else {
            echo '<div class="mdl-card__title">
  <i class="material-icons">notifications_none</i>
    <span class="mdl-button">No Recent Messages</span>
      <div class="mdl-layout-spacer">';
          }
        ?>
  </div><?php 
  }

  function getPoem( $code) {
    $getPoemCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts WHERE h_code = '".$code."'" );
    if ( $getPoemCode -> num_rows > 0) {
      while ( $postDetails = mysqli_fetch_assoc( $getPoemCode)){ ?>
      <title><?php _show_( $postDetails['h_alias'] ); ?> [ JABALI Poems ]</title>
        <div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text"><?php _show_( $postDetails['h_alias'] ); ?></h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a href="tel:<?php _show_( $postDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a>
                                <a href="./post?view=<?php _show_( $postDetails['h_code'] ); ?>&fav=<?php _show_( $postDetails['h_code'] ); ?>" ><i class="material-icons">star</i></a>
                                <a href="./post?edit=<?php _show_( $postDetails['h_code'] ); ?>" ><i class="material-icons">edit</i></a>
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <h4><?php _show_( $postDetails['h_subtitle'] ); ?></h4>
                            <h6>Published: <?php _show_( $postDetails['h_created'] ); ?><br>
                            Authored by: <?php _show_( $postDetails['h_by'] ); ?><br>
                            Category: <?php _show_( $postDetails['h_category'] ); ?><br>
                            Tagged: <?php _show_( ucwords( $postDetails['h_tags'] ) ); ?></br>
                            Readings: <?php _show_( ucwords( $postDetails['h_tags'] ) ); ?></h6>
                            SHARE 
                            <a href="mailto:<?php _show_( $userDetails['h_email'] ); ?>"><i class="mdi mdi-email"></i></a>
                            <a href="sms://<?php _show_( $_SESSION['myPhone'] ); ?>?body=<?php _show_( $postDetails['h_alias'].' '.hPORTAL ); ?>post?view=<?php _show_( $postDetails['h_code'] ); ?>"><i class="mdi mdi-message"></i></a>
                            <a href="whatsapp://send?text=<?php _show_( $postDetails['h_alias'].' '.hPORTAL ); ?>post=view=<?php _show_( $postDetails['h_code'] ); ?>" data-action="share/whatsapp/share"><i class="mdi mdi-whatsapp"></i></a>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                            <img src="<?php _show_( $postDetails['h_avatar'] ); ?>" width="100%">
                          </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                        <?php _show_( $postDetails['h_description'] ); ?>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><?php 
                      $getPoems = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmessages LIMIT 5" );
                      if ( $getPoems -> num_rows >= 0) { ?>
                        <div class="mdl-card__title">
                          <i class="material-icons">comment</i>
                            <span class="mdl-button">Comments</span>
                          <div class="mdl-layout-spacer"></div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                          <ul class="collapsible popout" data-collapsible="accordion"><?php 
                              while ( $note = mysqli_fetch_assoc( $getPoems) ) { ?>
                              <li>
                                <div class="collapsible-header"><i class="material-icons">label_outline</i>
                                  
                                    <b><?php _show_( $note['h_alias'] ); ?></b><span class="alignright"><?php 
                                    _show_( $note['h_created'] ); ?></span>
                                </div>
                                <div class="collapsible-body"><span class="alignright">
                                    <a href="./notification?create=note&code=<?php _show_( $note['h_author'] ); ?>" ><i class="material-icons">reply</i></a> 
                                    <a href="./notification?view=<?php _show_( $note['h_code'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
                                    <a href="./notification?delete=<?php _show_( $note['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
                                    </span>
                                    <span><?php 
                                    _show_( $note['h_description'] ); ?></span>
                                </div>
                              </li><?php 
                              } ?>
                          </ul><?
                      } else {
                        echo "No Messages";
                      } ?>
                            <p>Add Comment</p>
                            <form>
                            <div class="input-field">
                            <input id="h_alias" name=="h_alias" type="text">
                            <label for="h_alias">Title</label>
                            </div>

                            <div class="input-field">
                            <textarea class="materialize-textarea col s12" id="h_description" name="h_description" ><?php _show_( $userDetails['h_description'] ); ?></textarea>
                            <label for="h_description">Your Comment</label>
                            </div>
                            <button type="submit" name="" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect alignright"><i  class="material-icons">send</i></button>
                            </form>
                        </div>
                    </div><br>
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><?php 
                          $getPoems = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hnotes LIMIT 5" );
                          if ( $getPoems -> num_rows >= 0) { ?>
                            <div class="mdl-card__title">
                              <i class="material-icons">note</i>
                                <span class="mdl-button">Poems</span>
                              <div class="mdl-layout-spacer"></div>
                            </div>
                            <div class="mdl-card__supporting-text mdl-card--expand">
                              <ul class="collapsible popout" data-collapsible="accordion"><?php 
                                  while ( $note = mysqli_fetch_assoc( $getPoems) ) { ?>
                                  <li>
                                    <div class="collapsible-header"><i class="material-icons">label_outline</i>
                                      
                                        <b><?php _show_( $note['h_alias'] ); ?></b><span class="alignright"><?php 
                                        _show_( $note['h_created'] ); ?></span>
                                    </div>
                                    <div class="collapsible-body"><span class="alignright">
                                        <a href="./notification?create=note&code=<?php _show_( $note['h_author'] ); ?>" ><i class="material-icons">reply</i></a> 
                                        <a href="./notification?view=<?php _show_( $note['h_code'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
                                        <a href="./notification?delete=<?php _show_( $note['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
                                        </span>
                                        <span><?php 
                                        _show_( $note['h_description'] ); ?></span>
                                    </div>
                                  </li><?php 
                                  } ?>
                              </ul><?
                          } else {
                            echo "No Messages";
                          } ?>
                                <p>Add Poem</p>
                                <form>

                                <div class="input-field">
                                <textarea class="materialize-textarea col s12" id="h_description" name="h_description" ><?php _show_( $userDetails['h_description'] ); ?></textarea>
                                <label for="h_description">Your Poem</label>
                                </div>
                                <button type="submit" name="" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect alignright"><i  class="material-icons">save</i></button>
                                </form>
                            </div>
                    </div>
                </div>
                <br>
                <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-card mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                  <div class="mdl-card__title">
                    <i class="material-icons">face</i>
                      <span class="mdl-button">More by this author</span>
                    <div class="mdl-layout-spacer"></div>
                  </div>
                  <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                    <div class="mdl-cell">
                      h
                    </div>
                    <div class="mdl-cell">
                      h
                    </div>
                    <div class="mdl-cell">
                      h
                    </div>
                  </div>
                </div><?php 
      }
    } else {
      echo 'Poem Not Found';
    }
  }

}

?>

