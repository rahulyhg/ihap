<?php 
include './header.php';
include '../functions/payments/MPESA.php';

?>
<title>Shop [ <?php getOption( 'name' ); ?> ]</title>
  <div class="mdl-grid mdl-card">
  	<?php 
  	if ( $_GET["order"] ) {
		if ( isset( $_SESSION["cart_item"] )){
		    $item_total = 0;
		?><div class="mdl-layout__content mdl-cell mdl-cell--6-col mdl-card mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">

	<div class="mdl-card__title">
    <i class="material-icons">print</i>
      <span class="mdl-button">Order <?php _show_( $_GET['order'] ); ?></span>
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-card__subtitle-text mdl-button">
        <a id="btnEmpty" href="./shop?view=list&buy=empty">
            <i class="material-icons">remove_shopping_cart</i>
            Cancel Order
        </a>
        </div>
    </div>
		<table class="mdl-data-table mdl-js-data-table mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
		<tbody>
		<tr>
		<th class="mdl-data-table__cell--non-numeric">ITEM</th>
		<th class="mdl-data-table__cell--non-numeric">QTY</th>
		<th class="mdl-data-table__cell--non-numeric">PRICE</th>
		<th class="mdl-data-table__cell--non-numeric">ACTION</th>
		</tr>	
		<?php 		
		    foreach ( $_SESSION["cart_item"] as $item){
				?>
						<tr>
						<td style="text-align:left;" ><strong><?php echo $item["name"]; ?></strong></td>
						<td style="text-align:left;" ><?php echo $item["quantity"]; ?></td>
						<td style="text-align:left;" ><?php echo "KSh ".$item["price"]; ?></td>
						<td style="text-align:left;" ><a href="./shop?order=<?php _show_( $_GET['order'] ); ?>&method=<?php _show_( $_GET['method'] ); ?>&pay=now&buy=remove&code=<?php echo $item["code"]; ?>" class="material-icons">clear</a></td>
						</tr>

						<?php 
				        $item_total += ( $item["price"]*$item["quantity"] );
						}
						?>
		<tr>
		<td colspan="5" align=left ><h5><b>TOTAL: </b> <?php echo "KSh ".$item_total; ?></h5></td>
		</tr>

		</tbody>

		</table>



		</div>
		<div class="mdl-layout__content mdl-cell mdl-cell--6-col mdl-card mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">

			<div class="mdl-card__title">
		    <i class="material-icons">account_circle</i>
		      <span class="mdl-button">Your Details</span>
		        <div class="mdl-layout-spacer"></div>
		        <div class="mdl-card__subtitle-text mdl-button">
		            <i class="mdi mdi-truck-delivery mdi-24px"></i>
		            <?php _show_( $_SESSION['myLocation'] ); ?>
		        </div>
		    </div>

			    <form enctype="multipart/form-data" class="" name="payForm" method="POST" action=""><br>
			    	<div class="input-field inline">
			    		<i class="material-icons prefix">label</i>
			    		<input type="text" name="h_by" value="<?php _show_( $_SESSION['myAlias'] ); ?>">
			    		<label>Full Names</label>
			    	</div>

			    	<div class="input-field inline">
			    		<i class="material-icons prefix">mail</i>
			    		<input type="text" name="h_email" value="<?php _show_( $_SESSION['myEmail'] ); ?>">
			    		<label>Email</label>
			    	</div>

			    	<div class="input-field inline">
			    		<i class="material-icons prefix">phone</i>
			    		<input type="text" name="h_phone" value="<?php _show_( $_SESSION['myPhone'] ); ?>">
			    		<label>Phone</label>
			    	</div>

			    	<div class="input-field inline">
			    		<i class="material-icons prefix">room</i>
			    		<input type="text" name="h_location" value="<?php _show_( ucwords( $_SESSION['myLocation'] ) ); ?>">
			    		<label>Location</label>
			    	</div>

			    	<div class="input-field inline">
			    		<i class="material-icons prefix">monetization_on</i>
			    		<input type="text" name="h_location" value="<?php _show_( strtoupper( $_GET['method'] ) ); ?>">
			    		<label>Pay Via</label>
			    	</div>
			    	<input type="hidden" name="amount" value="<?php echo $item_total; ?>">

			    	<div class="input-field inline">
					<button class="mdl-button mdl-js-button mdl-button--colored mdl-js-ripple-effect" type="submit" name="pay">pay now <i class="material-icons">send</i></button>
					</div>
			</form>

		</div>

		<?php 
	} ?>

	<div class="mdl-layout__content mdl-cell mdl-cell--6-col mdl-card mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">

	<div class="mdl-card__title">
    <i class="material-icons">shop</i>
      <span class="mdl-button">Order <?php _show_( $_GET['order'] ); ?></span>
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-card__subtitle-text mdl-button">
        <a id="btnEmpty" href="./shop?buy=empty">
            <i class="material-icons">note_add</i>
            Add Note
        </a>
        </div>
    </div>
		<table class="mdl-data-table mdl-js-data-table mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
		<tbody>
		<tr>
		<th class="mdl-data-table__cell--non-numeric">NOTES</th>
		<th class="mdl-data-table__cell--non-numeric">CREATED</th>
		<th class="mdl-data-table__cell--non-numeric">AMOUNT</th>
		<th class="mdl-data-table__cell--non-numeric">STATUS</th>
		</tr>	
		<?php 		
		    foreach ( $_SESSION["cart_item"] as $item){
				?>
						<tr>
						<td style="text-align:left;" ><strong><?php echo $item["name"]; ?></strong></td>
						<td style="text-align:left;" ><?php _show_( date(Ymd) ); ?></td>

						<?php 
				        $item_total += ( $item["price"]*$item["quantity"] );
						}
						?>
						<td style="text-align:left;" ><?php echo "KSh ".$item_total; ?></td>
						<td style="text-align:left;" >processing</td>
						</tr>
		</tbody>

		</table>



		</div>

		<?php 
  	} else {

  	if ( !empty( $_GET["buy"] ) ) {
	switch( $_GET["buy"] ) {
		case "add":
			if ( !empty( $_POST["quantity"] ) ) {
				$product = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts LEFT JOIN hproducts ON hproducts.h_code = hposts.h_code WHERE hposts.h_code='" . $_GET["code"] . "'" );
				if ( $product -> num_rows > 0) {
					while( $row = mysqli_fetch_assoc( $product) ) {
						$product_array[] = $row;
					}
				}
				$itemArray = array( $product_array[0]["h_code"]=>array('name'=>$product_array[0]["h_alias"], 'code'=>$product_array[0]["h_code"], 'quantity'=>$_POST["quantity"], 'price'=>$product_array[0]["h_price"] ) );
				
				if ( !empty( $_SESSION["cart_item"] ) ) {
					if ( in_array( $product_array[0]["h_code"],array_keys( $_SESSION["cart_item"] )) ) {
						foreach( $_SESSION["cart_item"] as $k => $v) {
								if ( $product_array[0]["h_code"] == $k) {
									if ( empty( $_SESSION["cart_item"][$k]["quantity"] ) ) {
										$_SESSION["cart_item"][$k]["quantity"] = 0;
									}
									$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
								}
						}
					} else {
						$_SESSION["cart_item"] = array_merge( $_SESSION["cart_item"],$itemArray );
					}
				} else {
					$_SESSION["cart_item"] = $itemArray;
				}
			}
		break;
		case "remove":
			if ( !empty( $_SESSION["cart_item"] ) ) {
				foreach( $_SESSION["cart_item"] as $k => $v) {
						if ( $_GET["code"] == $k)
							unset( $_SESSION["cart_item"][$k] );				
						if ( empty( $_SESSION["cart_item"] ))
							unset( $_SESSION["cart_item"] );
				}
			}
		break;
		case "empty":
			unset( $_SESSION["cart_item"] );
		break;	
	}
	}
	?>

	<div id="shopping-cart" class="mdl-cell mdl-cell--12-col grid mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>" >
	<div class="mdl-cell mdl-cell--12-col mdl-card" >
	<div class="mdl-card__title">
    <i class="material-icons">shopping_cart</i>
      <span class="mdl-button">My Cart</span>
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-card__subtitle-text mdl-button">
        <a id="btnEmpty" href="./shop?buy=empty">
            <i class="material-icons">remove_shopping_cart</i>
            Empty Cart
        </a>
        </div>
    </div>
	<?php 
	if ( isset( $_SESSION["cart_item"] )){
	    $item_total = 0;
	?><div class="mdl-layout__content">	
	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
	<tbody>
	<tr>
	<th class="mdl-data-table__cell--non-numeric">ITEM</th>
	<th class="mdl-data-table__cell--non-numeric">QTY</th>
	<th class="mdl-data-table__cell--non-numeric">PRICE</th>
	<th class="mdl-data-table__cell--non-numeric">ACTION</th>
	</tr>	
	<?php 		
	    foreach ( $_SESSION["cart_item"] as $item){
			?>
					<tr>
					<td style="text-align:left;" ><strong><?php echo $item["name"]; ?></strong></td>
					<td style="text-align:left;" ><?php echo $item["quantity"]; ?></td>
					<td style="text-align:left;" ><?php echo "KSh ".$item["price"]; ?></td>
					<td style="text-align:left;" ><a href="./shop?buy=remove&code=<?php echo $item["code"]; ?>" class="material-icons">clear</a></td>
					</tr>

					<?php 
	        $item_total += ( $item["price"]*$item["quantity"] );
			}
			?>

	<tr>
	<td colspan="5" align=left ><h5><b>TOTAL: </b> <?php echo "KSh ".$item_total; ?></h5></td>
	</tr>
	</tbody>
	</table></div><?php 
	} else { echo "<center><br>Your Cart Is Empty</center>";}
	?>
	</div>
	<?php if ( !empty( $_SESSION["cart_item"] ) ) { ?>
	<center>
		<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="./shop?order=<?php echo "KSh".$item_total; ?>">proceed to checkout <i class="material-icons">forward</i></a><br>	
	</center>
	<?php } ?>  
	</div>
<?php } ?>
  </div>
<?php 
include './footer.php';
?>