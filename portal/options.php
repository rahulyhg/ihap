<?php 

include './header.php';


if ( isset( $_POST['mystyle'] ) ) {
    $theme = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['theme'] );
    mysqli_query( $GLOBALS['conn'], "UPDATE husers SET h_style = '".$theme."' WHERE h_code = '".$_SESSION['myCode']."'" );
}

if ( isset( $_POST['mpesa'] ) ) {
    $date = date(Ymd );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['merchant']."', h_updated = '".$date."' WHERE h_code='merchant'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['callback']."', h_updated = '".$date."'  WHERE h_code='callback'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['paybill']."', h_updated = '".$date."'  WHERE h_code='paybill'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['timestamp']."', h_updated = '".$date."'  WHERE h_code='timestamp'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['sag']."', h_updated = '".$date."'  WHERE h_code='sag'" );
}

if ( isset( $_POST['preferences'] ) ) {
    $date = date('Ymd' );
    $uploads = "../uploads/".date('Y' ).'/'.date('m' ).'/'.date('d' )."/";
    $headerlogo = $uploads . basename( $_FILES['header_logo']['name'] );
    $homelogo = $uploads . basename( $_FILES['home_logo']['name'] );
    $favicon = $uploads . basename( $_FILES['my_favicon']['name'] );

    if ( move_uploaded_file( $_FILES['header_logo']["tmp_name"], $headerlogo ) || move_uploaded_file( $_FILES['home_logo']["tmp_name"], $homelogo ) || move_uploaded_file( $_FILES['my_favicon']["tmp_name"], $favicon ) ) {
        //Do nothing
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    $header_logo = hUPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'.$_FILES['header_logo']['name'];
    $home_logo = hUPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'.$_FILES['home_logo']['name'];
    $favicon = hUPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'.$_FILES['my_favicon']['name'];

    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['name']."', h_updated = '".$date."' WHERE h_code='name'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['description']."', h_updated = '".$date."'  WHERE h_code='description'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['email']."', h_updated = '".$date."'  WHERE h_code='email'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['copyright']."', h_updated = '".$date."'  WHERE h_code='copyright'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['attribution']."', h_updated = '".$date."'  WHERE h_code='attribution'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$header_logo."', h_updated = '".$date."'  WHERE h_code='header_logo'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$home_logo."', h_updated = '".$date."'  WHERE h_code='home_logo'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$favicon."', h_updated = '".$date."'  WHERE h_code='favicon'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['registration']."', h_updated = '".$date."'  WHERE h_code='registration'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['tos']."', h_updated = '".$date."'  WHERE h_code='tos'" );

    echo "<script type = \"text/javascript\">
              alert(\"Preferences Updated Successfully!\" );
          </script>";
}

if ( isset( $_GET['page'] ) ) {
    if ( $_GET['page'] == "general" ) {
        ?><title>General Site Options [ <?php getOption( 'name' ); ?> ]</title>
        <div class="mdl-grid" >

        <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
            <div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
            <form enctype="multipart/form-data" name="optionForm" method="POST" action="">

                    <div class="input-field">
                            <i class="material-icons prefix">label</i>
                        <input id="name" type="text" name="name" value="<?php getOption( 'name' ); ?>">
                        <label for="name" data-error="wrong" data-success="right" class="center-align">Site Name </label>
                    </div>

                    <div class="input-field">
                            <i class="material-icons prefix">details</i>
                        <textarea id="description" name="description" class="materialize-textarea col s12" ><?php getOption( "description" ); ?></textarea>
                        <label for="description" data-error="wrong" data-success="right" class="center-align">Site Description </label>
                    </div>

                    <div class="input-field">
                            <i class="material-icons prefix">mail</i>
                        <input id="email" type="text" name="email" value="<?php getOption( 'email' ); ?>">
                        <label for="email" class="center-align">Admin Email </label>
                    </div>

                    <div class="input-field">
                            <i class="material-icons prefix">copyright</i>
                        <input id="copyright" type="text" name="copyright" value="<?php getOption( 'copyright' ); ?>">
                        <label for="copyright"class="center-align">Footer Copyright </label>
                    </div>

                    <div class="input-field">
                            <i class="mdi mdi-format-color-text prefix"></i>
                        <input id="attribution" type="text" name="attribution" value="<?php getOption( 'attribution' ); ?>">
                        <label for="attribution"class="center-align">Footer Attribution </label>
                    </div>

            </div>

            <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-grid">
                <script>
                   function chooseHeader() {
                      $( "#header_logo" ).click();
                   }

                   function chooseHome() {
                      $( "#home_logo" ).click();
                   }

                   function chooseFavicon() {
                      $( "#my_favicon" ).click();
                   }
                </script>

                <div class="input-field inline mdl-cell mdl-cell--2-col-desktop mdl-cell--2-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp">
                    <div style="height:0px;overflow:hidden">
                        <input id="my_favicon" type="file" name="my_favicon" value="<?php getOption( 'favicon' ); ?>">
                    </div>
                    <img src="<?php getOption( 'favicon' ); ?>" width="100%" onclick="chooseFavicon();">
                    <label for="my_favicon" data-error="wrong" data-success="right" class="center-align">Favicon <span><i class="material-icons">edit</i></span></label>
                </div>

                <div class="input-field inline mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp">
                    <div style="height:0px;overflow:hidden">
                        <input id="header_logo" type="file" name="header_logo" value="<?php getOption( 'header_logo' ); ?>">
                    </div>
                    <img src="<?php getOption( 'header_logo' ); ?>" width="75%" onclick="chooseHeader();">
                    <label for="header_logo" data-error="wrong" data-success="right" class="center-align">Header Logo (100x80px) <span><i class="material-icons">edit</i></span></label>
                </div>

                <div class="input-field inline mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp">
                    <div style="height:0px;overflow:hidden">
                    <input id="home_logo" type="file" name="home_logo" value="<?php getOption( "home_logo" ); ?>">
                    </div>
                    <img src="<?php getOption( 'home_logo' ); ?>" width="100%" onclick="chooseHome();">
                    <label for="home_logo" data-error="wrong" data-success="right">Home Logo (250x80px) <span><i class="material-icons">edit</i></span></label>
                </div>
            </div>
        </div>

        <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
            <div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">

                <div class="input-field">
                    <textarea id="h_tos" name="tos" class="materialize-textarea col s12"><?php getOption( 'tos' ); ?></textarea>
                            <script>CKEDITOR.replace( "h_tos" );</script>
                    <label for="h_tos" data-error="wrong" data-success="right" class="center-align">Terms of Service </label>
                </div>
                <br>
                <p>
                  <input type="checkbox" id="registration" name="registration" <?php getOption( 'registration' ); ?> value="checked" />
                  <label for="registration">Allow User Registrations?</label>
                </p>
                <button class="mdl-button mdl-button--fab alignright" type="submit" name="preferences"><i class="material-icons">save</i></button>
            </div>
        </form>
        </div>
    </div>
    <?php 
    } elseif ( $_GET['page'] == "shop" ) {
        ?><title>Shop Options [ <?php getOption( 'name' ); ?> ]</title>
        <div class="mdl-grid" >

        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card">
        <div class=" mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
        <form enctype="multipart/form-data" name="optionForm" method="POST" action="" class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
        <div class="mdl-card__title">
        <i class="mdi mdi-cellphone"></i>
          <span class="mdl-button">M-PESA Settings</span>
        </div>
        <div class="mdl-card__supporting-text mdl-card--expand">
                <span><b>Required Fields Are Marked <span style="color:red;">*</span></b></span><br>

                <div class="input-field">
                        <i class="material-icons prefix">label</i>
                    <input id="merchant" type="text" name="merchant" value="<?php getOption( 'merchant' ); ?>">
                    <label for="merchant" data-error="wrong" data-success="right" class="center-align">Merchant Name <b style="color:red;">*</b></label>
                </div>

                <div class="input-field">
                        <i class="material-icons prefix">public</i>
                    <input id="callback" type="text" name="callback" value="<?php getOption( 'callback' ); ?>">
                    <label for="callback" data-error="wrong" data-success="right" class="center-align">Callback URL <b style="color:red;">*</b></label>
                </div>

                <div class="input-field">
                        <i class="material-icons prefix">payment</i>
                    <input id="paybill" type="text" name="paybill" value="<?php getOption( 'paybill' ); ?>">
                    <label for="paybill" data-error="wrong" data-success="right" class="center-align">Paybill Number <b style="color:red;">*</b></label>
                </div>

                <div class="input-field">
                        <i class="material-icons prefix">query_builder</i>
                    <input id="timestamp" type="text" name="timestamp" value="<?php getOption( 'timestamp' ); ?>">
                    <label for="timestamp" data-error="wrong" data-success="right" class="center-align">Timestamp <b style="color:red;">*</b></label>
                </div>

                <div class="input-field">
                        <i class="material-icons prefix">lock</i>
                    <textarea id="sag" name="sag" class="materialize-textarea col s12" ><?php getOption( 'sag' ); ?></textarea>
                    <label for="sag" data-error="wrong" data-success="right" class="center-align">SAG Password <b style="color:red;">*</b></label>
                </div>

                <br>
                <button class="mdl-button mdl-button--fab" type="submit" name="mpesa"><i class="material-icons">save</i></button>
        </div>
        </form>
        </div>
        <br>
        <div class=" mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
        <form enctype="multipart/form-data" name="optionForm" method="POST" action="" class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
        <div class="mdl-card__title">
        <i class="fa fa-paypal"></i>
          <span class="mdl-button">Paypal Settings</span>
        </div>
        <div class="mdl-card__supporting-text mdl-card--expand">

                <div class="input-field inline">
                        <i class="material-icons prefix">mail</i>
                    <input id="name" type="email" name="name" value="<?php getOption( 'email' ); ?>">
                    <label for="name" data-error="wrong" data-success="right" class="center-align">Paypal Email <b style="color:red;">*</b></label>
                </div>

                <div class="input-field inline">
                <button class="mdl-button mdl-button--fab" type="submit" name="paypal"><i class="material-icons">save</i></button>
                </div>

        </div>
        </form>

        <br>

        <form enctype="multipart/form-data" name="optionForm" method="POST" action="" class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
        <div class="mdl-card__title">
        <i class="fa fa-cc-stripe"></i>
          <span class="mdl-button">Stripe Settings</span>
        </div>
        <div class="mdl-card__supporting-text mdl-card--expand">

                <div class="input-field inline">
                        <i class="material-icons prefix">mail</i>
                    <input id="name" type="email" name="name" value="<?php getOption( 'email' ); ?>">
                    <label for="name" data-error="wrong" data-success="right" class="center-align">Stripe Email <b style="color:red;">*</b></label>
                </div>
                
                <div class="input-field inline">
                <button class="mdl-button mdl-button--fab" type="submit" name="stripe"><i class="material-icons">save</i></button>
                </div>
        </div>
        </form>

        <br>

        <form enctype="multipart/form-data" name="optionForm" method="POST" action="" class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
        <div class="mdl-card__title">
        <i class="fa fa-cc-stripe"></i>
          <span class="mdl-button">Bank Settings</span>
        </div>
        <div class="mdl-card__supporting-text mdl-card--expand">

                <div class="input-field">
                        <i class="material-icons prefix">account_balance</i>
                    <input id="name" type="text" name="baccount" value="<?php getOption( 'name' ); ?>">
                    <label for="name" data-error="wrong" data-success="right" class="center-align">Bank Name<b style="color:red;">*</b></label>
                </div>

                <div class="input-field">
                        <i class="material-icons prefix">business</i>
                    <input id="name" type="text" name="bname" value="<?php getOption( 'timestamp' ); ?>">
                    <label for="name" data-error="wrong" data-success="right" class="center-align">Account Number<b style="color:red;">*</b></label>
                </div>

                <div class="input-field inline">
                        <i class="material-icons prefix">business</i>
                    <input id="name" type="text" name="bname" value="<?php getOption( 'paybill' ); ?>">
                    <label for="name" data-error="wrong" data-success="right" class="center-align">Branch Code<b style="color:red;">*</b></label>
                </div>
                
                <div class="input-field inline">
                <button class="mdl-button mdl-button--fab align-right" type="submit" name="stripe"><i class="material-icons">save</i></button>
                </div>
        </div>
        </form>
        </div>

        </div>
        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                        <div class="mdl-card__title">
                        <i class="material-icons">info_outline</i>
                          <span class="mdl-button">Shop Settings Help</span>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                        <ul class="collapsible popout" data-collapsible="accordion">
                        <li>
                          <div class="collapsible-header active"><i class="material-icons">message</i>Setting Up M-PESA</div>
                          <div class="collapsible-body">
                          <span><b>Required Constants</b></span>
                            <ul>
                                <li>Paybill Number</li>
                                <li>Paybill Number</li>
                                <li>Get Paybill Number</li>
                                <li>Get Paybill Number</li>
                                <li>Get Paybill Number</li>
                            </ul>
                            <span>More details can be found on <a href="https://safaricom.co.ke">Safaricom's website.</a></span>
                          </div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="fa fa-paypal"></i>Paypal Settings</div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">chat_bubble</i>M-PESA Settings</div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">description</i>M-PESA Settings</div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                      </ul>
                        </div>
                    </div>
                </div>
        </div><?php 
    } elseif ( $_GET['page'] == "color" ) {

        function isTheme ( $theme) {
            $themes = mysqli_query( $GLOBALS['conn'], "SELECT h_style FROM husers WHERE h_code = '".$_SESSION['myCode']."'" );
            if ( $themes -> num_rows > 0) {
                while ( $mytheme = mysqli_fetch_assoc( $themes) ) {
                    if ( $theme == $mytheme['h_style'] ) {
                        echo 'checked';
                    }
                }
            }
        }
?>
    <title>Theme Color Options [ <?php getOption( 'name' ); ?> ]</title>
    <div class="mdl-grid mdl-cell mdl-cell--12-col" >
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid">
        	<div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
        		<style type="text/css">
                .cholder {
                    display: inline-flex;
                    }

                .ccolor {
                    height: 30px;
                    width: 50px;
                    border-radius: 8%;
                    border: white 1px solid;
                }

                .clabel {
                    padding-left: 20px;
                }

                </style>
                <div class="mdl-card__title">
                    <div class="mdl-card__title-text">
                        Select Theme
                    </div>
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-card__subtitle-text mdl-button">
                        <i class="material-icons">color_lens</i>
                    </div>
                </div>
                <div class="mdl-card_supporting-text">
                <form enctype="multipart/form-data" name="themeForm" method="POST" action="" class="mdl-cell mdl-cell--12-col">

                    <div class="input-field inline">
                        <input type="radio" id="zahra" name="theme" value="zahra" <?php isTheme ('zahra' ); ?>>
                        <label for="zahra"><p class="cholder" for="zahra">
                            <span class="ccolor mdl-color--teal"></span><span class="ccolor csec mdl-color--red"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="zahra">Zahra's Fade</div>

                    <div class="input-field inline">
                        <input type="radio" id="love" name="theme" value="love" <?php isTheme ('love' ); ?>>
                        <label for="love"><p class="cholder" for="love">
                            <span class="ccolor mdl-color--cyan"></span><span class="ccolor csec mdl-color--pink"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="love">Love, Olive</div>

                    <div class="input-field inline">
                        <input type="radio" id="wizz" name="theme" value="wizz" <?php isTheme ('wizz' ); ?>>
                        <label for="wizz"><p class="cholder" for="wizz">
                            <span class="ccolor mdl-color--yellow"></span><span class="ccolor csec mdl-color--black"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="wizz">The Wizz</div>

                    <div class="input-field inline">
                        <input type="radio" id="pint" name="theme" value="pint" <?php isTheme ('pint' ); ?>>
                        <label for="pint"><p class="cholder" for="pint">
                            <span class="ccolor mdl-color--blue"></span><span class="ccolor csec mdl-color--pink"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="pint">The Bluepint</div>

                    <div class="input-field inline">
                        <input type="radio" id="stack" name="theme" value="stack" <?php isTheme ('stack' ); ?>>
                        <label for="stack"><p class="cholder" for="stack">
                            <span class="ccolor mdl-color--grey"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="stack">Needle in a Haystack</div>

                    <div class="input-field inline">
                        <input type="radio" id="indie" name="theme" value="indie" <?php isTheme ('indie' ); ?>>
                        <label for="indie"><p class="cholder" for="indie">
                            <span class="ccolor mdl-color--indigo"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="indie">Indie Go</div>

                    <div class="input-field inline">
                        <input type="radio" id="haze" name="theme" value="haze" <?php isTheme ('haze' ); ?>>
                        <label for="haze"><p class="cholder" for="haze">
                            <span class="ccolor mdl-color--purple"></span><span class="ccolor csec mdl-color--green"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="haze">Purple Haze</div>

                    <div class="input-field inline">
                        <input type="radio" id="hot" name="theme" value="hot" <?php isTheme ('hot' ); ?>>
                        <label for="hot"><p class="cholder" for="hot">
                            <span class="ccolor mdl-color--red"></span><span class="ccolor csec mdl-color--blue"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="hot">Red Hot</div>

                    <div class="input-field inline">
                        <input type="radio" id="princess" name="theme" value="princess" <?php isTheme ('princess' ); ?>>
                        <label for="princess"><p class="cholder" for="princess">
                            <span class="ccolor mdl-color--pink"></span><span class="ccolor csec mdl-color--blue"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="princess">Princess Zahra</div>

                    <div class="input-field inline">
                        <input type="radio" id="sky" name="theme" value="sky" <?php isTheme ('sky' ); ?>>
                        <label for="sky"><p class="cholder" for="sky">
                            <span class="ccolor mdl-color--light-blue"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="sky">Blue Sky</div>

                    <div class="input-field inline">
                        <input type="radio" id="greene" name="theme" value="greene" <?php isTheme ('greene' ); ?>>
                        <label for="greene"><p class="cholder" for="greene">
                            <span class="ccolor mdl-color--green"></span><span class="ccolor csec mdl-color--red"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="greene">Green E</div>

                    <div class="input-field inline">
                        <input type="radio" id="vegan" name="theme" value="vegan" <?php isTheme ('vegan' ); ?>>
                        <label for="vegan"><p class="cholder" for="vegan">
                            <span class="ccolor mdl-color--light-green"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="vegan">Vegan</div>

                    <div class="input-field inline">
                        <input type="radio" id="lemon" name="theme" value="lemon" <?php isTheme ('lemon' ); ?>>
                        <label for="lemon"><p class="cholder" for="lemon">
                            <span class="ccolor mdl-color--lime"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="lemon">Life's Lemons</div>

                    <div class="input-field inline">
                        <input type="radio" id="wait" name="theme" value="wait" <?php isTheme ('wait' ); ?>>
                        <label for="wait"><p class="cholder" for="wait">
                            <span class="ccolor mdl-color--amber"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="wait">Wait A Minute</div>

                    <div class="input-field inline">
                        <input type="radio" id="orange" name="theme" value="orange" <?php isTheme ('orange' ); ?>>
                        <label for="orange"><p class="cholder" for="orange">
                            <span class="ccolor mdl-color--orange"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="orange">Orange Tan</div>

                    <div class="input-field inline">
                        <input type="radio" id="sun" name="theme" value="sun" <?php isTheme ('sun' ); ?>>
                        <label for="sun"><p class="cholder" for="sun">
                            <span class="ccolor mdl-color--deep-orange"></span><span class="ccolor csec mdl-color--cyan"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="sun">Orange Sun</div>

                    <div class="input-field inline">
                        <input type="radio" id="earth" name="theme" value="earth" <?php isTheme ('earth' ); ?>>
                        <label for="earth"><p class="cholder" for="earth">
                            <span class="ccolor mdl-color--brown"></span><span class="ccolor csec mdl-color--orange"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="earth">Down To Earth</div>
                    

                    <div class="input-field inline">
                        <input type="radio" id="ghost" name="theme" value="ghost" <?php isTheme ('ghost' ); ?>>
                        <label for="ghost"><p class="cholder" for="ghost">
                            <span class="ccolor mdl-color--blue-grey"></span><span class="ccolor csec mdl-color--red"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="ghost">Ghosting Blues</div>
                    

                    <div class="input-field inline">
                        <input type="radio" id="bred" name="theme" value="bred" <?php isTheme ('bred' ); ?>>
                        <label for="bred"><p class="cholder" for="bred">
                            <span class="ccolor mdl-color--black"></span><span class="ccolor csec mdl-color--red"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="bred">Born & Bred</div>
                    

                    <div class="input-field inline">
                        <input type="radio" id="prince" name="theme" value="prince" <?php isTheme ('prince' ); ?>>
                        <label for="prince"><p class="cholder" for="prince">
                            <span class="ccolor mdl-color--deep-purple"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="prince">Dark Prince</div>
                    

                    <div class="input-field"><br>
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" type="submit" name="mystyle" style="float:right;"><i class="material-icons">save</i></button>
                    </div>
                </form>
                </div>
        	</div>
            <div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
                <div class="mdl-card__title">
                    <div class="mdl-card__title-text">
                        Custom Styling
                    </div>

                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-card__subtitle-text mdl-button">
                        <i class="material-icons">brush</i>
                    </div>
                </div>

                <form enctype="multipart/form-data" name="themeForm" method="POST" action="" class="mdl-cell mdl-cell--12-col">
                <div class="mdl-card_supporting-text">

                    <div class="input-field">
                        <i class="mdi mdi-format-color-text prefix"></i>
                        <input id="secondary" type="text" name="secondary">
                        <label for="secondary" data-error="wrong" data-success="right" class="center-align">Accent Color </label>
                    </div>

                    <div class="input-field">
                        <i class="mdi mdi-format-paragraph prefix"></i>
                        <input id="textp" type="text" name="textp">
                        <label for="textp" data-error="wrong" data-success="right" class="center-align">Text Primary Color </label>
                    </div>

                    <div class="input-field">
                        <i class="mdi mdi-code-string prefix"></i>
                        <input id="texts" type="text" name="texts">
                        <label for="texts" data-error="wrong" data-success="right" class="center-align">Text Secondary Color </label>
                    </div>

                    <div class="input-field">
                        <i class="mdi mdi-language-css3 prefix"></i>
                        <textarea id="customs" name="customs" cols="3" class="materialize-textarea col s12"></textarea>
                        <label for="customs" data-error="wrong" data-success="right" class="center-align">Custom CSS </label>
                    </div>

                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" type="submit" name="custom" style="float:right;"><i class="material-icons">save</i></button>
                </form>
                </div>
            </div>
        </div>

        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-grid mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
            <div class="mdl-cell mdl-cell--12-col mdl-card">
                <div class="mdl-card__title">
                    <div class="mdl-card__title-text">
                        Color Palette
                    </div>

                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-card__subtitle-text mdl-button">
                        <i class="material-icons">palette</i>
                    </div>
                </div>
                <div class="mdl-card_supporting-text"><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--red"></span><span class="clabel"> Red</span><span class="clabel"> ( red )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--pink"></span><span class="clabel"> Pink</span><span class="clabel"> ( pink )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--purple"></span><span class="clabel"> Purple</span><span class="clabel"> ( purple )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--deep-purple"></span><span class="clabel"> Deep Purple</span><span class="clabel"> ( deep-purple )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--indigo"></span><span class="clabel"> Indigo</span><span class="clabel"> ( indigo )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--blue"></span><span class="clabel"> Blue</span><span class="clabel"> ( blue )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--light-blue"></span><span class="clabel"> Light Blue</span><span class="clabel"> ( light-blue )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--cyan"></span><span class="clabel"> Cyan</span><span class="clabel"> ( cyan )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--teal"></span><span class="clabel"> Teal</span><span class="clabel"> ( teal )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--green"></span><span class="clabel"> Green</span><span class="clabel"> ( green )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--light-green"></span><span class="clabel"> Light Green</span><span class="clabel"> ( light-green )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--lime"></span><span class="clabel"> Lime</span><span class="clabel"> ( green )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--yellow"></span><span class="clabel"> Yellow</span><span class="clabel"> ( yellow )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--amber"></span><span class="clabel"> Amber</span><span class="clabel"> ( amber )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--orange"></span><span class="clabel"> Orange</span><span class="clabel"> ( orange )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--deep-orange"></span><span class="clabel"> Deep Orange</span><span class="clabel"> ( deep-orange )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--brown"></span><span class="clabel"> Brown</span><span class="clabel"> ( brown )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--grey"></span><span class="clabel"> Grey</span><span class="clabel"> ( grey )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--blue-grey"></span><span class="clabel"> Blue Grey</span><span class="clabel"> ( blue-grey )</span>
                    </p><br>
                </div>
            </div>
        </div>
    </div>
<?php 
    }
}

include './footer.php';
