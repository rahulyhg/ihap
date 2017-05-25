<?php
include 'header.php';
$year = date("Y");
$month = date("m");
$day = date("d");
$directory = "uploads/$year/$month/$day/";

if (!is_dir($directory)) {
	mkdir($directory, 755, true);
}

if (isset($_GET['article'])) {
	if ($_GET['article'] == "articles") {
		$hArticle -> getArticles();
	} else {
		$hArticle -> getArticleCode($_GET['article']);
	}
} else { ?>
	<title>Access Your Health [ IHAP ]</title>
	<div style="padding-top:40px;">
	    <div id="login_div">
		<center><a href="<?php echo hROOT; ?>"><img src="<?php echo hIMAGES; ?>logo.png" width="300px;"></a><br>
	    <a href="./register" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
	  <i class="material-icons">edit</i> REGISTER</a> <a href="./login" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
	  <i class="material-icons">exit_to_app</i> LOGIN</a>
	  <p>© IHAP 2017 - All Rights Reserved</p>
	  <a href="./about">About</a> - <a href="./tos">TOS</a> - <a href="./faq">FAQs</a>
		</center><br>
	    </div>
	</div> 
<?php }
mysqli_close($GLOBALS['conn']); ?>
</main>
<script src="<?php echo hASSETS; ?>js/d3.js"></script>
<script src="<?php echo hASSETS; ?>js/getmdl-select.min.js"></script>
<script src="<?php echo hASSETS; ?>js/material.js"></script>
<script src="<?php echo hASSETS; ?>js/materialize.min.js"></script>
<script src="<?php echo hASSETS; ?>js/nv.d3.js"></script>
<script src="<?php echo hASSETS; ?>js/widgets/employer-form/employer-form.js"></script>
<script src="<?php echo hASSETS; ?>js/widgets/line-chart/line-chart-nvd3.js"></script>
<script src="<?php echo hASSETS; ?>js/widgets/map/maps.js"></script>
<script src="<?php echo hASSETS; ?>js/widgets/pie-chart/pie-chart-nvd3.js"></script>
<script src="<?php echo hASSETS; ?>js/widgets/table/table.js"></script>
<script src="<?php echo hASSETS; ?>js/widgets/todo/todo.js"></script>
</body>
</div>
</html>