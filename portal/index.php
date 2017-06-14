<?php 
include './header.php';

function getCount( $utype) {
    $usersCount = mysqli_query( $GLOBALS['conn'], "SELECT h_type FROM husers WHERE h_type='".$utype."'" );
	if ( $usersCount -> num_rows > 0) {
			?><div class="mdl-cell mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><i class="material-icons prefix">people</i><center><?php 
			_show_( ucfirst( $utype ).'s
			<br>'.$usersCount -> num_rows.'
			</center></div>' );
	} else {
		?><div class="mdl-cell mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>"><i class="material-icons prefix">people</i><center><?php 
		echo ucfirst( $utype).'s
		<br>0
		</center></div>';
	}
}

$types = "admin, doctor, nurse, center, patient";
$type = explode( ", ", $types );

?>
<title><? _show_( ucwords( $_SESSION['myCap'] ) ); ?> Dashboard [ <?php getOption( 'name' ); ?> ]</title>
  <div class="mdl-grid demo-content">
  	<?php 
  		getCount( $type[0] );
  		getCount( $type[1] );
  		getCount( $type[2] );
  		getCount( $type[3] );
  		getCount( $type[4] );
  	?>

  	<table class="mdl-data-table mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
  <thead>
    <tr>
      <th>
          <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select" for="table-header">
            <input type="checkbox" id="table-header" class="mdl-checkbox__input" />
          </label>
      </th>
      <th class="mdl-data-table__cell--non-numeric">Material</th>
      <th>Quantity</th>
      <th>Unit price</th>
    </tr>
  </thead>
  <tbody>
    <tr>
       <td>
          <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select" for="row[1]">
            <input type="checkbox" id="row[1]" class="mdl-checkbox__input" />
          </label>
      </td>
      <td class="mdl-data-table__cell--non-numeric">Acrylic (Transparent)</td>
      <td>25</td>
      <td>$2.90</td>
    </tr>
    <tr>
       <td>
          <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select" for="row[2]">
            <input type="checkbox" id="row[2]" class="mdl-checkbox__input" />
          </label>
      </td>
      <td class="mdl-data-table__cell--non-numeric">Plywood (Birch)</td>
      <td>50</td>
      <td>$1.25</td>
    </tr>
    <tr>
      <td>
          <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select" for="row[3]">
            <input type="checkbox" id="row[3]" class="mdl-checkbox__input" />
          </label>
      </td>
      <td class="mdl-data-table__cell--non-numeric">Laminate (Gold on Blue)</td>
      <td>10</td>
      <td>$2.35</td>
    </tr>
  </tbody>
</table>
<script type="">
	var table = document.querySelector('table');
var headerCheckbox = table.querySelector('thead .mdl-data-table__select input');
var boxes = table.querySelectorAll('tbody .mdl-data-table__select');
var headerCheckHandler = function(event) {
  if (event.target.checked) {
    for (var i = 0, length = boxes.length; i < length; i++) {
      boxes[i].MaterialCheckbox.check();
      boxes[i].MaterialCheckbox.updateClasses();
    }
  } else {
    for (var i = 0, length = boxes.length; i < length; i++) {
      boxes[i].MaterialCheckbox.uncheck();
      boxes[i].MaterialCheckbox.updateClasses();
    }
  }
};
headerCheckbox.addEventListener('change', headerCheckHandler);
</script>
  </div>
<?php 
include './footer.php';
?>