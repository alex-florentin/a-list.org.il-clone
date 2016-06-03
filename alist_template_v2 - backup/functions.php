<?php

register_nav_menus ( array(
'main-menu' => 'Main Menu'
)); // register main menu

add_theme_support( 'post-thumbnails' );
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
	add_menu_page( 'Order profiles page', 'Order profiles', 'manage_options', 'order-profiles-page.php', 'order_profiles_page', 'dashicons-admin-generic', 120  );
}

function order_profiles_page(){
	?>

		<?php
		$mysqli=new mysqli('localhost', 'agenda_alist2', '#AcBV8,D(0o5TZ3&QZ', 'agenda_alist2');
		if(mysqli_connect_error()){
			echo "Connexion failed!", mysqli_connect_error();
		}
		$query="Select * FROM wp_people_table";
		$resultado=$mysqli->query($query);
		?>


		<h2>Order profiles</h2>

		<div id="message" class="error" style="margin:0;margin-bottom:10px;"><p><b>After finishing the reorganization of, DON'T FORGET to click the 'Delete Cache' button. You can find it in the bar above.</p></div>

		<table class="wp-list-table widefat fixed striped people">
			<thead>
				<tr>
					<th class="manage-column column-name column-primary sortable asc" scope="col">
						<a href="#">Profile image</a>
					</th>
					<th>
						<a href="#">Email</a>
					</th>
					<th>
						<a href="#">Order number</a>
					</th>
					<th>
						<a href="#">Action</a>
					</th>
				</tr>
			</thead>
			<tbody id="the-list">
		<?php while($row=$resultado->fetch_assoc()){ ?>
				<form action="/wp-admin/admin.php?page=order-profiles-page.php" method="POST">
					<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
					<tr>
						<td class="column-name has-row-actions column-primary">
							<img src="/wp-content/themes/alist_template_v2/uploads/profile/size/<?php echo $row['profile_image'] ?>" style="width:150px;height:auto" />
						</td>
						<td class="email column-email">
							<p>
								<?php echo $row['email'] ?>
							</p>
						</td>
						<td class="email column-order_number">
							<input type="text" name="order_number" value="<?php echo $row['order_number'] ?>">
						</td>
						<td class="submit column-submit">
							<input type="submit" name="submit" value="Submit">
						</td>
					</tr>
				</form>
		<?php } ?>
			</tbody>
		</table>


		<?php
			if (isset($_POST['submit'])) {

				$id=$_POST['id'];
				$order_number=$_POST['order_number'];

				$query="UPDATE wp_people_table SET order_number='$order_number' WHERE id='$id'";

				$resultado=$mysqli->query($query);

				$sql = "ALTER TABLE `wp_people_table` ORDER BY `order_number`;";

				$sql=$mysqli->query($sql);

				if ($resultado>0) {
					echo "<script>window.location.reload(true)</script>";
				}

			}
		?>

	<?php
} // order profiles page


function truncate($text, $chars = 270) {
    $text = $text." ";
    $text = substr($text,0,$chars);
    $text = substr($text,0,strrpos($text,' '));
    $text = $text."...";
    return $text;
}




?>
