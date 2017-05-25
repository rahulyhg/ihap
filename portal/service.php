<?php

include './header.php';

if (isset($_GET['create'])) {
	$hForm -> serviceForm();
}

if (isset($_GET['request'])) {
	if ($_GET['request'] == "list") {
		$hService -> getRequests();
	} else {
		$hService -> getRequestCode($_GET['request']);

	}
}

if (isset($_GET['delete'])) {
	mysqli_query($GLOBALS['conn'], "DELETE FROM hservices WHERE id=".$_GET['delete']."");
	header("location:javascript://history.go(-1)");
}

if (isset($_GET['edit']) && $_GET['view'] !=="") {
	$hService -> editServiceForm($_GET['view']);
}

if(isset($_GET['view'])){
	if ($_GET['view'] == "list") {
		if(isset($_GET['type'])) {
			$hService -> getServicesType($_GET['type']);
		} else {
			$hService -> getServices();
		}
	} else {
		$hService -> getServiceCode($_GET['view']);
	}

}

if (isset($_POST['create'])) {
	$hService -> createService();
}

if (isset($_POST['update'])) {
	$hService -> loginService();
}

if (isset($_POST['register'])) {
	$hService -> createService();
}

if (isset($_POST['confirm'])) {
	$hService -> confirmService();
} 
if (isset($_POST['logout'])) {
	$hService -> logoutService();
}

if (isset($_POST['forgot'])) {
	$hService -> forgotPass();
} 

if (isset($_POST['reset'])) {
	$hService -> resetPass();
}
?>
<a href="./register" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">add</i></a>
<?php
include './footer.php';
