<?php 
class _hMenus {

	/**
	* Drawer menu
	**/
	function drawer() {
		$getMenu = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmenus WHERE h_type = 'main' AND h_location = 'drawer'" );
		if ( $getMenu -> num_rows > 0 ) {
			while ( $menus = mysqli_fetch_assoc( $getMenu) ) {
				$menu[] = $menu;
			}
		}

		if ( !empty( $menu) ) {
			foreach ( $menu as $menuitem) {

				echo '<a class="mdl-navigation__link" href="'.$menuitem["h_link"].'"><i class="mdl-color-text--white material-icons" role="presentation">'.$menuitem["h_avatar"].'</i>'.$menuitem["h_description"].'</a>';
				if ( $menuitem['h_type'] == "drop" ) {
					$subMenu = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmenus WHERE h_type = 'main' AND h_location = 'drawer' AND h_for = '".$menuitem['h_id']."'" );
					if ( $subMenu -> num_rows > 0 ) {
						echo '<ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-left" for="'.$menuitem['h_id'].'">';
						while ( $menusub = mysqli_fetch_assoc( $subMenu) ) {
							echo '<a class="mdl-navigation__link" href="'.$menusub["h_link"].'"><i class="mdl-color-text--white material-icons" role="presentation">'.$menusub["h_avatar"].'</i>'.$menusub["h_description"].'</a>';
						}
						echo "</ul>";
					}
				}
			}
		}
	}

	/**
	* Header menu
	**/
	function header() {}

	/**
	* Main Front menu
	**/
	function main() {}

	/**
	* Front Footer Menu
	**/
	function footer() {}

	/**
	* If Extension/Template Has Menu
	**/
	function hasMenu( $x) {
		$getX = mysqli_query( $GLOBALS['conn'], "SELECT h_menu FROM hextensions WHERE h_slug = '".$x."'" );
		if ( $getX -> num_rows > 0 ) {
			while ( $menus = mysqli_fetch_assoc( $getX) ) {
				$menu[] = $menu;
			}
		}

		if ( !empty( $menu) && $menu[0]['h_menu'] == "yes" ) {
			if ( $menu[0]['h_menu'] == "yes" ) {
				return true;
			} else {
				return false;
			}
		}
	}

} ?>
