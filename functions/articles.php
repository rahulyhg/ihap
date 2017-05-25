<?php

class _hArticles {
  var $h_alias; 
  var $h_author; 
  var $h_avatar; 
  var $h_by; 
  var $h_category; 
  var $h_center; 
  var $h_code; 
  var $h_created; 
  var $h_custom; 
  var $h_description; 
  var $h_email; 
  var $h_fav; 
  var $h_key; 
  var $h_level; 
  var $h_link; 
  var $h_location; 
  var $h_notes; 
  var $h_phone; 
  var $h_reading; 
  var $h_status; 
  var $h_style; 
  var $h_subtitle; 
  var $h_tags; 
  var $h_type; 
  var $h_updated;
  
  function createArticle() {

    $date = date("YmdHms");
    if (isset($_SESSION['myEmail'])) {
      $email = $_SESSION['myEmail'];
    } else {
      $email = hEMAIL;
    }

    $h_alias = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_alias']); 
    $h_author = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_author']); 
    $h_avatar = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_avatar']); 
    $h_category = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_category']); 
    $h_center = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_center']);
    $h_key = str_shuffle(md5($email.$date));
    $h_code = substr($h_key, rand(0, 15), 16); 
    $h_created = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_created']); 
    $h_custom = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_custom']); 
    $h_desc = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_desc']); 
    $h_email = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_email']); 
    $h_fav = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_fav']); 
    $h_level = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_level']); 
    $h_link = hPORTAL."article?view=$h_key&action=view"; 
    $h_location = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_location']); 
    $h_notes = substr($h_desc, 250); 
    $h_phone = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_phone']); 
    $h_reading = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_reading']); 
    $h_status = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_status']); 
    $h_style = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_style']); 
    $h_subtitle = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_subtitle']); 
    $h_tags = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_tags']); 
    $h_type = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_type']); 
    $h_updated = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_updated']);

    $createArticle = mysqli_query($GLOBALS['conn'], "INSERT INTO harticles (h_alias, h_author, h_avatar, h_category, h_center, h_code, h_created, h_custom, h_description, h_email, h_fav, h_key, h_level, h_link, h_location, h_notes, h_phone, h_reading, h_status, h_style, h_subtitle, h_tags, h_text, h_type, h_updated) 
      VALUES ('".$h_alias."', '".$h_author."', '".$h_avatar."', '".$h_category."', '".$h_center."', '".$h_code."', '".$h_created."', '".$h_custom."', '".$h_desc."', '".$h_email."', '".$h_fav."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_location."', '".$h_notes."', '".$h_phone."', '".$h_reading."', '".$h_status."', '".$h_style."', '".$h_subtitle."', '".$h_tags."', '".$h_type."', '".$h_updated."'");
    if ($createArticle) {
       echo '<div class="modal"><p>Article Created Successfuly!</p></div>';
     } else {
       echo '<div class="modal"><p>Error!</p>'.$createArticle ->conn_error.'</div>';
     }
  }

  function updateArticle($h_code) {
    
    $date = date("YmdHms");
    if (isset($_SESSION['myEmail'])) {
      $email = $_SESSION['myEmail'];
    } else {
      $email = hEMAIL;
    }

    $h_alias = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_alias']); 
    $h_author = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_author']); 
    $h_avatar = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_avatar']); 
    $h_category = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_category']); 
    $h_center = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_center']);
    $h_key = strshuffle(md5($email.$date)); 
    $h_code = substr($h_key, rand(0, 15), 16); 
    $h_created = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_created']); 
    $h_custom = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_custom']); 
    $h_desc = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_desc']); 
    $h_email = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_email']); 
    $h_fav = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_fav']); 
    $h_level = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_level']); 
    $h_link = hPORTAL."article?view=$h_key&action=view"; 
    $h_location = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_location']); 
    $h_notes = subst($h_desc, 250); 
    $h_phone = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_phone']); 
    $h_reading = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_reading']); 
    $h_status = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_status']); 
    $h_style = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_style']); 
    $h_subtitle = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_subtitle']); 
    $h_tags = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_tags']); 
    $h_text = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_text']); 
    $h_type = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_type']); 
    $h_updated = mysqli_real_escape_string($GLOBALS['conn'], $_POST['h_updated']);    

    $updateArticle = mysqli_query($GLOBALS['conn'], "UPDATE harticles SET h_var='".$h_var."', h_var='".$h_var."' WHERE h_code='".$h_code."'");
    // if (!$updateArticle ->conn_error) {
    //   echo '<div><p>Article Created Successfuly!</p></div>';
    // } else {
    //   echo '<div><p>Error!</p>'.$updateArticle ->conn_error.'</div>';
    // }
  }

  
  function deleteArticle($h_code) {
    
    $deleteArticle = mysqli_query($GLOBALS['conn'], "DELETE FROM harticles WHERE h_code='".$h_code."'");
    if (!$createArticle ->conn_error) {
      echo '<div><p>Article Created Successfuly!</p></div>';
    } else {
      echo '<div><p>Error!</p>'.$deleteArticle ->conn_error.'</div>';
    }
  }

  function getArticlesBySort($by, $sort) {
    $getArticlesBySort = mysqli_query($GLOBALS['conn'], "SELECT * FROM harticles WHERE h_status = 'active' AND h_".$by." = '".$sort."' ORDER BY h_created DESC");
    if($getArticlesBySort -> num_rows > 0) {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">CODE</th>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
      while ($articlesDetails = mysqli_fetch_assoc($getArticlesBySort)){
        echo '
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_code']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_articlename']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_email']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_center']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_location']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric"><a href="" ><i class="material-icons">phone</i></a> <a href="" ><i class="material-icons">message</i></a>  <a href="" ><i class="material-icons">edit</i></a> <a href="" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody>';
      } echo '
        </table></div>';
    } else {
      echo 'No Articles Found';
    }
  }

  function getArticlesType($type) {

    $getArticlesBy = mysqli_query($GLOBALS['conn'], "SELECT * FROM harticles WHERE h_status = 'active' AND h_type='".$type."'");
    if($getArticlesBy -> num_rows > 0) {
      echo "<title>".ucfirst($type)."s List | IHAP</title>";
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
      while ($articlesDetails = mysqli_fetch_assoc($getArticlesBy)){
        echo '
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_articlename']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_email']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_phone']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_center']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_location']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./article?view='.$articlesDetails['h_code']. '" ><i class="material-icons">account_circle</i></a> <a href="tel:'.$articlesDetails['h_phone']. '" ><i class="material-icons">phone</i></a> <a href="?article?view='.$_SESSION['myCode']. '&action=chat&by='.$articlesDetails['h_code']. '" ><i class="material-icons">message</i></a>  <a href="./article?view='.$articlesDetails['h_code']. '&action=edit" ><i class="material-icons">edit</i></a> <a href="./article?view='.$articlesDetails['h_code']. '&action=delete" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody>';
      } echo '
        </table></div>';
    } else {
        echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
        echo '
        <tbody>
        <tr>
        <td><p>No '.ucfirst($type).'s Found</p></td>
        </tr>
        </tbody>';
         echo '
        </table></div>';
    }
  }

  function getArticles() {
      echo "<title>All Articles [ IHAP ]</title>";
    $getArticles = mysqli_query($GLOBALS['conn'], "SELECT * FROM harticles WHERE h_status = 'published' ORDER BY h_created DESC");
    if($getArticles -> num_rows > 0) {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">ARTICLE</th>
        <th class="mdl-data-table__cell--non-numeric">AUTHOR</th>
        <th class="mdl-data-table__cell--non-numeric">CATEGORY</th>
        <th class="mdl-data-table__cell--non-numeric">TAGS</th>
        <th class="mdl-data-table__cell--non-numeric">CREATED</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
      while ($articlesDetails = mysqli_fetch_assoc($getArticles)){
        echo '
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_alias']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_author']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_category']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_tags']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_created']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">'
        .$articlesDetails['h_status']. '
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./article?view='.$articlesDetails['h_code']. '" ><i class="material-icons">loupe</i></a> <a href="tel:'.$articlesDetails['h_phone']. '" ><i class="material-icons">phone</i></a> <a href="?article?view='.$_SESSION['myCode']. '&action=chat&by='.$articlesDetails['h_code']. '" ><i class="material-icons">message</i></a>  <a href="./article?view='.$articlesDetails['h_code']. '&action=edit" ><i class="material-icons">edit</i></a> <a href="./article?view='.$articlesDetails['h_code']. '&action=delete" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody>';
      } echo '
        </table></div>';
    } else {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">ARTICLE</th>
        <th class="mdl-data-table__cell--non-numeric">AUTHOR</th>
        <th class="mdl-data-table__cell--non-numeric">CATEGORY</th>
        <th class="mdl-data-table__cell--non-numeric">TAGS</th>
        <th class="mdl-data-table__cell--non-numeric">CREATED</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
        echo '
        <tbody>
        <tr>
        <td><p>No Articles Found</p></td>
        </tr>
        </tbody>';
         echo '
        </table></div>';
    }
  }

  function getArticleCode($code) {
    $getArticleCode = mysqli_query($GLOBALS['conn'], "SELECT * FROM harticles WHERE h_code = '".$code."'");
    if($getArticleCode -> num_rows > 0) {
      while ($articleDetails = mysqli_fetch_assoc($getArticleCode)){
        echo '<title>'.$articleDetails['h_alias'].' [ IHAP Articles ]</title>';
        echo '<div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">'.$articleDetails['h_alias'].'</h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a href="tel:'.$articleDetails['h_phone'].'" ><i class="material-icons">phone</i></a>
                                <a href="./article?view='.$articleDetails['h_code'].'&fav='.$articleDetails['h_code'].'" ><i class="material-icons">star</i></a>
                                <a href="./article?edit='.$articleDetails['h_code'].'" ><i class="material-icons">edit</i></a>
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <h4>'.$articleDetails['h_subtitle'].'</h4>
                            <h6>Published: '.$articleDetails['h_created'].'<br>
                            Authored by: '.$articleDetails['h_by'].'<br>
                            Category: '.$articleDetails['h_category'].'<br>
                            Tagged: '.ucwords($articleDetails['h_tags']).'</br>
                            Readings: '.ucwords($articleDetails['h_tags']).'</h6>
                            SHARE 
                            <a href="mailto:'.$userDetails['h_email'].'"><i class="mdi mdi-email"></i></a>
                            <a href="sms://'.$_SESSION['myPhone'].'?body='.$articleDetails['h_alias'].' '.hPORTAL.'article=view='.$articleDetails['h_code'].'"><i class="mdi mdi-message"></i></a>
                            <a href="whatsapp://send?text='.$articleDetails['h_alias'].' '.hPORTAL.'article=view='.$articleDetails['h_code'].'" data-action="share/whatsapp/share"><i class="mdi mdi-whatsapp"></i></a>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                            <img src="'.$articleDetails['h_avatar'].'" width="100%">
                          </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                        '.$articleDetails['h_description'].'
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text mdl-button">
                                <i class="material-icons">comments</i>
                                comments
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                            In this tutorial we’re using jQuery and PHP to build a Ajax live search feature for your website. 
                            A live search doesn’t need to reload the whole page and show the search results based on the currently entered keyword.
                            <form>
                            <div class="input-field">
                            <input id="h_alias" name=="h_alias" type="text">
                            <label for="h_alias">Title</label>
                            </div>

                            <div class="input-field">
                            <textarea rows="5" id="h_description" name="h_description" >'.$userDetails['h_description'].'</textarea>
                            <label for="h_description">Your Comment</label>
                            </div>
                            <button type="submit" name="" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect"><i  class="material-icons">send</i></button>
                            </form>
                        </div>
                    </div><br>
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text mdl-button">
                                <i class="material-icons">note</i>
                                Notes
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                            In this tutorial we’re using jQuery and PHP to build a Ajax live search feature for your website. 
                            A live search doesn’t need to reload the whole page and show the search results based on the currently entered keyword.
                            <form>
                            <div class="input-field">
                            <input id="h_alias" name="h_alias" type="text">
                            <label for="h_alias">Title</label>
                            </div>

                            <div class="input-field">
                            <textarea rows="5" id="h_description" name="h_description" >'.$userDetails['h_description'].'</textarea>
                            <label for="h_description">Note</label>
                            </div>
                            <button type="submit" name="" class="mdl-button mdl-button--fab"><i  class="material-icons">send</i></button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>';
      }
    } else {
      echo 'Article Not Found';
    }
  }

    function editArticleForm($code) {
    $getArticleCode = mysqli_query($GLOBALS['conn'], "SELECT * FROM harticles WHERE h_code = '".$code."'");
    if($getArticleCode -> num_rows > 0) {
      while ($articleDetails = mysqli_fetch_assoc($getArticleCode)){
        $names = explode(" ", $articleDetails['h_alias']);

        echo '<title>'.$articleDetails['h_alias'].' Article Edit [ IHAP ]</title>';
        echo '<form name="registerArticle" method="POST" action="" class="mdl-grid" >
                <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text">Editing '.$articleDetails['h_alias'].'</h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                            <div class="input-field">
                        <button class="btn waves-effect waves-light" type="submit" name="update"><i class="material-icons">save</i></button>
                                <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" href="./message?view='.$messageDetails['h_code'].'&action=delete" ><i class="material-icons">delete</i></a>
                        </div>
                        </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">

                            <div class="input-field">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="fname" name="fname" type="text" value="'.$names[0].'">
                            <label for="fname">First Name</label>
                            </div>
                                   
                            <div class="input-field">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="lname" name="lname" type="text" value="'.$names[1].'">
                            <label for="lname">Last Name</label>
                            </div>

                            <div class="input-field">
                            <i class="mdi-social-person-outline prefix"></i>
                            <input class="validate" id="email" name="h_email" type="email" value="'.$articleDetails['h_email'].'">
                            <label for="email" data-error="wrong" data-success="right" class="center-align">Email Address</label>
                            </div>

                            <div class="input-field">
                            <i class="mdi-social-person-outline prefix"></i>
                            <input  id="h_phone" name="h_phone" type="text" value="'.$articleDetails['h_phone'].'">
                            <label for="h_phone" data-error="wrong" data-success="right" class="center-align">Phone Number</label>
                            </div>

                            <div class="input-field">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="password" name=="h_password" type="text" value="'.$articleDetails['h_password'].'">
                            <label for="password">Password</label>
                            </div>

                            <div class="input-field">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="h_type" name="h_type" type="password" value="'.$articleDetails['h_password'].'">
                            <label for="h_type">Type</label>
                            </div>

                            <div class="input-field">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="h_center" name="h_center" type="text" value="'.$articleDetails['h_center'].'">
                            <label for="h_center">Center</label>
                            </div>

                            <div class="input-field">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="h_location" name="h_location" type="text" value="'.$articleDetails['h_location'].'">
                            <label for="h_location">Location</label>
                            </div>

                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="update">SAVE</button>

                            <br>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                            <img src="'.$articleDetails['h_avatar'].'" width="90%">
                          </div>
                        </div>
                    </div>
                </div>>

                <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                        <i class="material-icons">business</i>
                          '.$articleDetails['h_center'].'
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text mdl-button">
                                <i class="material-icons">room</i>
                                '.$articleDetails['h_location'].'
                            </div>
                        </div>
                    </div>
                </div>
                </form>';
      }
    } else {
      echo 'Article Not Found';
    }
  }
 
}



/**
* Poetry Class
*/
class _hPoems extends _hArticles {
  
  function getPoemCode($code) {}
  
}
?>

