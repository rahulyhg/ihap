<?php 
session_start();
?>
</main>
<footer class="mdl-footer mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
	<div style="float:left;padding-left:20px;"><?php getOption( 'copyright' ); ?></div>
	<span style="float:right;padding-right:20px;"><?php getOption( 'attribution' ); ?></span>
</footer>
<?php mysqli_close( $GLOBALS['conn'] ); ?>
<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
<script>window.mdc.autoInit();</script>
<script src="<?php echo hASSETS; ?>js/d3.js"></script>
<script src="<?php echo hASSETS; ?>js/getmdl-select.min.js"></script>
<script src="<?php echo hASSETS; ?>js/material.js"></script>
<script src="<?php echo hASSETS; ?>js/materialize.min.js"></script>
<script src="<?php echo hASSETS; ?>js/nv.d3.js"></script>
<script src="<?php echo hASSETS; ?>js/widgets/employer-form/employer-form.js"></script>
<script src="<?php echo hASSETS; ?>js/widgets/line-chart/line-chart-nvd3.js"></script>
<script src="<?php echo hASSETS; ?>js/list.js"></script>
<script src="<?php echo hASSETS; ?>js/widgets/pie-chart/pie-chart-nvd3.js"></script>
<script src="<?php echo hASSETS; ?>js/widgets/table/table.js"></script>
<script src="<?php echo hASSETS; ?>js/widgets/todo/todo.js"></script>
</div>
</body>
</html>