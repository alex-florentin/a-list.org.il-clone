<?php
register_nav_menus ( array(
'main-menu' => 'Main Menu'
)); // register main menu
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5',array('search-form') );
add_image_size('home-thumbnail', 300, auto, true);
add_image_size('profile-image', 500, auto, true);
//register thumbnails
function arphabet_widgets_init() {
	register_sidebar( array(		'name'          => 'Text on featured panel',
		'id'            => 'text-featured-panel',
		'before_widget' => '<div class="text-caption">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="text-title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(		'name'          => 'Text on contact page',
		'id'            => 'text-contact-page',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="text-title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => 'Email on footer',
		'id'            => 'email-footer',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="hidden-title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => 'Phone on footer',
		'id'            => 'phone-footer',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="hidden-title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => 'Location on footer',
		'id'            => 'location-footer',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="hidden-title">',
		'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );
// Widgets
add_action( 'admin_menu', 'my_admin_menu' );
function my_admin_menu() {
	add_menu_page( 'Manage users page', 'Manage users', 'manage_options', 'manage-users-page.php', 'manage_users_page', 'dashicons-welcome-view-site', 120  );
}

function manage_users_page(){

	$conn = mysqli_connect ('localhost', 'alexflor_alist', 'U9B_CxijWz:/X{zdJg', 'alexflor_alist') or die ("Connexion problem!");

	$output = "";

	if(isset($_POST['query']) && ($_POST['query'] !== '')) {
		$search_query = $_POST['query'];
		$query = mysqli_query ($conn, "SELECT * FROM wp_people_table WHERE name LIKE '%$search_query%' OR last_name LIKE '%$search_query%' OR email LIKE '%$search_query%'") or die (mysqli_error);
		$count = mysqli_num_rows($query);
		if ($count == 0) {
			$output = "No search results for <b>$search_query</b>";
		} else {
			while($row = mysqli_fetch_array($query)) {
				$first_name = $row['name'];
				$last_name = $row['last_name'];
				$output .= "
				<form>
					<p>$first_name</p>
					<p>$last_name</p>
				</form>
				";
			}
		}
	}

	?>

	<h2>Manage users</h2>

	<form method="post">
		<input type="text" name="query" size="30">
		<input type="submit" value="Go!">
	</form>
	<?php echo $output; ?>

	<?php

} // manage_users_page

function truncate($text, $chars = 270) {
    $text = $text." ";
    $text = substr($text,0,$chars);
    $text = substr($text,0,strrpos($text,' '));
    $text = $text."...";
    return $text;
}
?>
