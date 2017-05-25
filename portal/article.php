<?php

include './header.php';

if (isset($_GET['create'])) {
	$hForm -> articleForm();
}

if (isset($_GET['delete'])) {
	mysqli_query($GLOBALS['conn'], "DELETE FROM harticles WHERE id=".$_GET['delete']."");
	$hArticle -> getArticles();
}

if(isset($_GET['view'])){
	if ($_GET['view'] == "list") {
		if(isset($_GET['type'])) {
			$hArticle -> getArticlesType($_GET['type']);
		} else {
			$hArticle -> getArticles();
		}
	} else {
		$hArticle -> getArticleCode($_GET['view']);
	}

}

if (isset($_POST['update'])) {
	$hArticle -> loginArticle();
}

if (isset($_POST['create'])) {
	$hArticle -> createArticle();
}

if (isset($_POST['confirm'])) {
	$hArticle -> confirmArticle();
} 
if (isset($_POST['logout'])) {
	$hArticle -> logoutArticle();
}

if (isset($_POST['forgot'])) {
	$hArticle -> forgotPass();
} 

if (isset($_POST['reset'])) {
	$hArticle -> resetPass();
}
?>
<div class="card__share">
    <div class="card__social ">  
        <a class="share-icon email" href="#"><i class="mdi mdi-account-plus"></i></a>

        <a class="share-icon email" href="#"><i class="mdi mdi-city"></i></a>

        <a class="share-icon email" href="mailto:sample@email.com" data-rel="external"><i class="mdi mdi-eye"></i></a>
    </div>

    <a id="share" class="addfab share-toggle share-icon mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" href="#"><i class="material-icons">add</i></a>
</div>

<?php
include './footer.php';
