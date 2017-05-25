<?php

include './header.php';

if (isset($_GET['create'])) {
	$hForm -> messageForm();
}

if (isset($_GET['chat'])) {
	if ($_GET['chat'] == "list") {
		$hMessage -> getChats();
	} else {
		$hMessage -> getChatCode($_GET['chat']);

	}
}

if (isset($_GET['delete'])) {
	mysqli_query($GLOBALS['conn'], "DELETE FROM hmessages WHERE id=".$_GET['delete']."");
	header("location:javascript://history.go(-1)");
}

if (isset($_GET['edit']) && $_GET['view'] !=="") {
	$hMessage -> editMessageForm($_GET['view']);
}

if(isset($_GET['view'])){
	if ($_GET['view'] == "list") {
		if(isset($_GET['type'])) {
			$hMessage -> getMessagesType($_GET['type']);
		} else {
			$hMessage -> getMessages();
		}
	} else {
		$hMessage -> getMessageCode($_GET['view']);
	}

}

if (isset($_POST['create'])) {
	$hMessage -> createMessage();
}

if (isset($_POST['update'])) {
	$hMessage -> loginMessage();
}

if (isset($_POST['register'])) {
	$hMessage -> createMessage();
}

if (isset($_POST['confirm'])) {
	$hMessage -> confirmMessage();
} 
if (isset($_POST['logout'])) {
	$hMessage -> logoutMessage();
}

if (isset($_POST['forgot'])) {
	$hMessage -> forgotPass();
} 

if (isset($_POST['reset'])) {
	$hMessage -> resetPass();
}
?>
<a href="./register" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">add</i></a>
<?php
include './footer.php';
