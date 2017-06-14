<?php 

include './header.php';

if ( isset( $_GET['create'] ) ) {
	$hForm -> postForm();
}

if ( isset( $_GET['edit'] ) ) {
	$hForm -> editPostForm( $_GET['edit'] );
}

if ( isset( $_GET['delete'] ) ) {
	mysqli_query( $GLOBALS['conn'], "DELETE FROM hposts WHERE id=".$_GET['delete']."" );
	$hPost -> getPosts();
}

if ( isset( $_GET['view'] )){
	if ( $_GET['view'] == "list" ) {
		if ( isset( $_GET['type'] ) ) {
			$hPost -> getPostsType( $_GET['type'] );
		} else {
			$hPost -> getPosts();
		}
	} else {
		$hPost -> getPostCode( $_GET['view'] );
	}

}

if ( isset( $_POST['create'] ) ) {
	$hPost -> createPost();
}

if ( isset( $_POST['update'] ) ) {
	$hPost -> updatePost();
}
include './footer.php';
?>