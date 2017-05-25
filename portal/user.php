<?php

include './header.php';

if (isset($_GET['create'])) {
	$hForm -> userForm();
}

if (isset($_GET['edit'])) {
	$hForm -> editUserForm($_GET['edit']);
}

if (isset($_GET['delete'])) {
	showAlert( 'User '.$_GET['delete'].' will be deleted');
	mysqli_query($GLOBALS['conn'], "DELETE FROM husers WHERE h_code='".$_GET['delete']."'");
	header("location:javascript://history.go(-1)");
}

if (isset($_GET['fav'])) {
	$getRate = mysqli_query($GLOBALS['conn'], "INSERT INTO hratings (h_author, h_for, h_type ) 
		VALUES ('".$_SESSION['myCode']."', '".$_GET['fav']."', 'user')");
}

if(isset($_GET['view'])){
	if ($_GET['view'] == "list") {
		if(isset($_GET['type'])) {
			$hUser -> getUsersType($_GET['type']);
		} elseif(isset($_GET['location'])) {
			$hUser -> getUsersType($_GET['type']);
		} else {
			$hUser -> getUsers();
		}
	} else {
		$hUser -> getUserCode($_GET['view']);
	}

}

if (isset($_POST['update'])) {
	$hUser -> loginUser();
}

if (isset($_POST['register'])) {
	$hUser -> createUser();
}
?>
<!-- Search FAB-->

<form role="form" class="addfab" method="POST">
<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
    <label class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--fab mdl-shadow--8dp mdl-button--colored " for="keyword">
        <i class="material-icons">search</i>
    </label>

    <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" id="keyword" name="q" >
        <label class="mdl-textfield__label" for="keyword">Search User</label>
    </div>
</div>
</form>
<ul id="content" class="searchie"></ul>

<script type="text/javascript">
$(document).ready(function() {
$('#keyword').on('input', function() {
  var searchKeyword = $(this).val();
  if (searchKeyword.length >= 3) {
    $.post('search.php', { keywords: searchKeyword }, function(data) {
      $('ul#content').empty()
      $.each(data, function() {
        $('ul#content').append('<li><a href="example.php?id=' + this.id + '">' + this.title + '</a></li>');
      });
    }, "json");
  }
});
});
</script>
<?php
include './footer.php';
