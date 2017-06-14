<?php 

class _hStyles(){

	/**
	* 
	**/
	function primaryColor( $code) {
		$getColor = mysqli_query( $GLOBALS['conn'], "SELECT h_style FROM husers  WHERE h_code='".$code."'" );
		if ( $getColor) {
			while ( $themes = mysqli_fetch_assoc( $getColor) ) {
				if ( $themes['h_style'] == "love" ) {
					echo "cyan";
				} elseif ( $themes['h_style'] == "zahra" ) {
					echo "teal";
				} elseif ( $themes['h_style'] == "wizz" ) {
					echo "yellow";
				} elseif ( $themes['h_style'] == "pint" ) {
					echo "blue";
				} elseif ( $themes['h_style'] == "stack" ) {
					echo "grey";
				} elseif ( $themes['h_style'] == "hot" ) {
					echo "red";
				} elseif ( $themes['h_style'] == "princess" ) {
					echo "pink";
				} elseif ( $themes['h_style'] == "haze" ) {
					echo "purple";
				} elseif ( $themes['h_style'] == "prince" ) {
					echo "deep-purple";
				} elseif ( $themes['h_style'] == "indie" ) {
					echo "indigo";
				} elseif ( $themes['h_style'] == "sky" ) {
					echo "light-blue";
				} elseif ( $themes['h_style'] == "greene" ) {
					echo "green";
				} elseif ( $themes['h_style'] == "vegan" ) {
					echo "light-green";
				} elseif ( $themes['h_style'] == "lemon" ) {
					echo "lime";
				} elseif ( $themes['h_style'] == "wait" ) {
					echo "amber";
				} elseif ( $themes['h_style'] == "orange" ) {
					echo "orange";
				} elseif ( $themes['h_style'] == "sun" ) {
					echo "deep-orange";
				} elseif ( $themes['h_style'] == "earth" ) {
					echo "brown";
				} elseif ( $themes['h_style'] == "ghost" ) {
					echo "blue-grey";
				} elseif ( $themes['h_style'] == "zebra" ) {
					echo "black";
				}
			}
		}
	}

	/**
	* 
	**/
	function accentColor( $code) {
		$getColor = mysqli_query( $GLOBALS['conn'], "SELECT h_style FROM husers  WHERE h_code='".$code."'" );
		if ( $getColor) {
			while ( $themes = mysqli_fetch_assoc( $getColor) ) {
				if ( $themes['h_style'] == "love" ) {
					echo "cyan";
				} elseif ( $themes['h_style'] == "zahra" ) {
					echo "teal";
				} elseif ( $themes['h_style'] == "wizz" ) {
					echo "brown";
				} elseif ( $themes['h_style'] == "bluepint" ) {
					echo "blue";
				} elseif ( $themes['h_style'] == "stack" ) {
					echo "grey";
				}
			}
		}
	}

	/**
	* 
	**/
	function textColor( $code) {
		$getColor = mysqli_query( $GLOBALS['conn'], "SELECT h_style FROM husers  WHERE h_code='".$code."'" );
		if ( $getColor) {
			while ( $themes = mysqli_fetch_assoc( $getColor) ) {
				if ( $themes['h_style'] == "love" ) {
					echo "cyan";
				} elseif ( $themes['h_style'] == "zahra" ) {
					echo "teal";
				} elseif ( $themes['h_style'] == "wizz" ) {
					echo "brown";
				} elseif ( $themes['h_style'] == "bluepint" ) {
					echo "blue";
				} elseif ( $themes['h_style'] == "stack" ) {
					echo "grey";
				}
			}
		}
	}

} ?>
