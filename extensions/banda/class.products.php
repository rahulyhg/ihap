<?php 

class _hProducts extends _hPosts {

  function getProducts() { ?>
    <title>All Products [ <?php getOption( 'name' ); ?> ]</title><?php 
    $products = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts LEFT JOIN hproducts ON hproducts.h_code = hposts.h_code WHERE h_type = 'product'" );
    if ( $products -> num_rows > 0) {
      while( $row = mysqli_fetch_assoc( $products) ) {
        $products_array[] = $row;
      }
    }

    if ( !empty( $products_array) ) { 
      foreach( $products_array as $key=>$value){ ?>
      <div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
        <div class="mdl-card-media">
          <img src="<?php echo $products_array[$key]["h_avatar"]; ?>" width="100%" style="overflow: hidden;" >
        </div>
        <form enctype="multipart/form-data" method="post" action="./shop?view=list&buy=add&code=<?php echo $products_array[$key]["h_code"]; ?>">
          <div class="mdl-card__title mdl-card--expand">
              <div class="mdl-card__title-text">
                <?php echo $products_array[$key]["h_alias"]; ?>
              </div>
              <div class="mdl-layout-spacer"></div>
                <div class="mdl-card__subtitle-text">
            <?php echo "KSh ".$products_array[$key]["h_price"]; ?>
              
            </div>
            </div>
          <div class="mdl-card__supporting-text">
            <div class="input-field inline">
              <input type="number" name="quantity" value="1" size="2" />
            </div>
            <div class="input-field inline" style="padding-left: 10px;">
              <button type="submit" class="mdl-button mdl-button--fab mdl-button--colored mdl-js-button mdl-js-ripple-effect alignright">
              <i class="material-icons">add_shopping_cart</i></button>
            </div>
          </div>
          <span style="padding: 20px;">
          <a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">thumb_up</i></a>

          <a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">comment</i></a>

          <a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">image</i></a>

          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon alignright" id="prbtn">
                  <i class="material-icons">more_vert</i>
                </button>
                <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-card mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>" for="prtbtn">
                  <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
                  <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
                  <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
                </ul>
              </span>
              
          <div class="mdl-card__menu">
          <a href="?fav=<?php echo $products_array[$key]["h_code"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">favorite</i></a>
          </div>
        </form>
      </div><?php 
      }
    }
  }

  function getProduct( $code) { ?>
    <title>Shop [ <?php getOption( 'name' ); ?> ]</title><?php 
    $product = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts LEFT JOIN hproducts ON hproducts.h_code = hposts.h_code WHERE hposts.h_code='". $_GET["view"] ."'" );
    if ( $product -> num_rows > 0) { 
      while( $product_array = mysqli_fetch_assoc( $product) ) {
        $product_deets[] = $product_array;
      }
    } ?>

    <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
      <div class="mdl-card-media">
        <img src="<?php echo $product_deets[0]["h_avatar"]; ?>" width="100%" style="overflow: hidden;" >
      </div>
      <form enctype="multipart/form-data" method="post" action="./shop?view=list&buy=add&code=<?php echo $products_array[$key]["h_code"]; ?>">
        <div class="mdl-card__title mdl-card--expand">
            <div class="mdl-card__title-text">
              <?php echo $product_deets[0]["h_alias"]; ?>
            </div>
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-card__subtitle-text">
              <?php echo "KSh ".$product_deets[0]["h_price"]; ?>
            </div>
        </div>

        <div class="mdl-card__supporting-text">
          <div class="input-field inline">
            <input type="number" name="quantity" value="1" size="2" />
          </div>
          <div class="input-field inline" style="padding-left: 10px;">
            <button type="submit" class="mdl-button mdl-button--fab mdl-button--colored mdl-js-button mdl-js-ripple-effect alignright">
            <i class="material-icons">add_shopping_cart</i></button>
          </div>
        </div>
        <span style="padding: 20px;">
          <a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">thumb_up</i></a>

          <a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">comment</i></a>

          <a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">image</i></a>

          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon alignright" id="prbtn">
                  <i class="material-icons">more_vert</i>
                </button>
                <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-card mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>" for="prtbtn">
                  <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
                  <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
                  <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
                </ul>
        </span>
            
        <div class="mdl-card__menu">
        <a href="?fav=<?php echo $product_deets[0]["h_code"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">favorite</i></a>
        </div>
      </form>
    </div<?php 
    }
} ?>

