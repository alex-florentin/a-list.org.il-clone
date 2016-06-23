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
	add_menu_page( 'Manage users page', 'Manage users', 'manage_options', 'manage-users-page.php', 'manage_users_page', 'dashicons-groups', 120  );
	add_menu_page( 'Order profiles page', 'Order profiles', 'manage_options', 'order-profiles-page.php', 'order_profiles_page', 'dashicons-sort', 120  );
}

function manage_users_page(){
	wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/style.css');
	//js and css files added
	?>
	<div class="title-n-form">
		<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
		<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>
		<h2>Manage users</h2>
		<form class="back-search-box" method="post">
			<input class="field" type="text" name="search_query" size="30" placeholder="email, first name & last name">
			<button class="button" type="submit" name="search_button">Search</button>
		</form>
	</div>
	<?php echo $output; ?>
	<?php

	$conn = new mysqli ('localhost', 'alexflor_alist', 'U9B_CxijWz:/X{zdJg', 'alexflor_alist') or die ("Connexion problem!");
	$conn->set_charset("utf8");
	$update_query = "SELECT * FROM wp_people_table";
	if(isset($_POST['search_button']) && ($_POST['search_query'] !== '')) {
		$search = $_POST['search_query'];
		$search_query = mysqli_query ($conn, "SELECT * FROM wp_people_table WHERE name LIKE '%$search%' OR last_name LIKE '%$search%' OR email LIKE '%$search%'") or die (mysqli_error);
		$count = mysqli_num_rows($search_query);
		if ($count == 0) {
			echo "<div class='no-results'><p>אין תוצאות חיפוש עבור <b>$search</b></p></div>";
		} else {
			while($row = mysqli_fetch_array($search_query)) {
				$avatar = $row['profile_image'];
				$public_profile = $row['public_profile'];
				$featured_user = $row['featured'];
				$order_number = $row['order_number'];
				$id = $row['id'];
				$prefix = stripslashes($row['prefix']);
				$first_name = stripslashes($row['name']);
				$last_name = stripslashes($row['last_name']);
				$position = $row['position'];
				$bio = stripslashes($row['bio']);
				$more_expertise = stripslashes($row['more_expertise']);
				$what_drives_me = stripslashes($row['what_drives_me']);
				$city = stripslashes($row['city']);
				$area = stripslashes($row['area']);
				$language = stripslashes($row['language']);
				$city = stripslashes($row['city']);
				$area = stripslashes($row['area']);
				$phone = stripslashes($row['contact']);
				$email = stripslashes($row['email']);
				$facebook = stripslashes($row['facebook_link']);
				$twitter = stripslashes($row['twitter_link']);
				$linkedin = stripslashes($row['linkdn_link']);
				?>

				<form class='search-result' method='POST' action='admin.php?page=manage-users-page.php'>
				<input type='hidden' name='id' value='<?php echo $id ?>'>
					<div class="single-result">
						<div class="result-bar">
							<span class="name"><?php echo $prefix." ".$first_name." ".$last_name ?></span>
							<span class="email"><?php echo $email ?></span>
							<span class="order-number"><?php echo $order_number ?> <i class="fa fa-th" aria-hidden="true"></i></span>
							<span class="public"><?php
								if ($public_profile == "Y") {
									?> <i class="fa fa-power-off green" aria-hidden="true"></i> <?php
								} else {
									?> <i class="fa fa-power-off red" aria-hidden="true"></i> <?php
								}
							?></span>
							<button type="button" class="more-button" data-toggle="modal" data-target=".bs-example-modal-lg<?php echo $id ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
						</div>
						<!-- modal -->
						<div class="modal fade bs-example-modal-lg<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
						  <div class="modal-dialog modal-lg">
						    <div class="modal-content">
									<div class="row">
										<div class='left_side col-md-3 col-lg-3 col-sm-4 col-xs-12 pull-right'>
		 									<div class='avatar'><img src='<?php echo get_template_directory_uri(); ?>/uploads/profile/size/<?php echo $avatar ?>'></div>
		 									<div class="public_profile">
		 										<?php
		 										if ($public_profile == "Y") {
		 											?>
		 												<input type='hidden' name='public_profile' value='N'>
		 												<input type='checkbox' name='public_profile' value='Y' checked data-toggle="toggle" data-width="100"><span>Public</span>
		 											<?php
		 										} else {
		 											?>
		 												<input type='checkbox' name='public_profile' value='Y' data-toggle="toggle" data-width="100"><span>ּPublic</span>
		 											<?php
		 										}
		 										?>
		 									</div>
		 									<div class='featured_user'>
		 										<?php
		 										if ($featured_user == "Y") {
		 											?>
		 												<input type='hidden' name='featured_user' value='N'>
		 												<input type='checkbox' name='featured_user' value='Y' checked data-toggle="toggle" data-width="100"><span>Featured</span>
		 											<?php
		 										} else {
		 											?>
		 												<input type='checkbox' name='featured_user' value='Y' data-toggle="toggle" data-width="100"><span>Featured</span>
		 											<?php
		 										}
		 										?>
		 									</div>
		 									<div class='order_number'><input type='text' name='order_number' value='<?php echo $order_number ?>' size='2'/><span>Order</span></div>
		 									<input type='submit' name='update_button' value='Update' class='update-data'>
		 								</div> <!--left_side-->
										<div class='right_side col-md-9 col-lg-9 col-sm-8 col-xs-12'>
											<p class="parent">
												<button type="button" class="edit-button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
												<label for="prefix">Prefix: </label>
												<input type="text" name="prefix" value="<?php echo $str = str_replace('"','\'\'',$prefix); ?>" disabled>
											</p>
											<!--BR-->
											<p class="parent">
												<button type="button" class="edit-button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
												<label for="name">First name: </label>
												<input type="text" name="name" value="<?php echo $str = str_replace('"','\'\'',$first_name); ?>" disabled>
											</p>
											<!--BR-->
											<p class="parent">
												<button type="button" class="edit-button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
												<label for="last_name">Last name: </label>
												<input type="text" name="last_name" value="<?php echo $str = str_replace('"','\'\'',$last_name); ?>" disabled>
											</p>
											<!--BR-->
											<p class="parent">
												<button type="button" class="edit-button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
												<label for="position">Position: </label>
												<input type="text" name="position" value="<?php echo $str = str_replace('"','\'\'',$position); ?>" disabled>
											</p>
											<!--BR-->
											<p class="parent">
												<button type="button" class="edit-button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
												<label for="bio">Bio: </label>
												<textarea name="bio" disabled <?php if ($bio == " ") { echo "style='height:0;'"; } ?> ><?php echo $str = str_replace('"','\'\'',$bio); ?></textarea>
											</p>
											<!--BR-->
											<p class="parent">
												<button type="button" class="edit-button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
												<label for="more_expertise">More in expertise: </label>
												<textarea name="more_expertise" disabled <?php if ($more_expertise == " ") { echo "style='height:0;'"; } ?> ><?php echo $str = str_replace('"','\'\'',$more_expertise); ?></textarea>
											</p>
											<!--BR-->
											<p class="parent">
												<button type="button" class="edit-button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
												<label for="what_drives_me">What drives me: </label>
												<textarea name="what_drives_me" disabled <?php if ($what_drives_me == " ") { echo "style='height:0;'"; } ?> ><?php echo $str = str_replace('"','\'\'',$what_drives_me); ?></textarea>
											</p>
											<!--BR-->
											<p class="parent">
												<button type="button" class="edit-button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
												<label for="city">City: </label>
												<input type="text" name="city" value="<?php echo $str = str_replace('"','\'\'',$city); ?>" disabled>
											</p>
											<!--BR-->
											<p class="parent">
												<button type="button" class="edit-button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
												<label for="area">Area: </label>
												<input type="text" name="area" value="<?php echo $str = str_replace('"','\'\'',$area); ?>" disabled>
											</p>
											<!--BR-->
											<p class="parent-locked">
												<button type="button" class="edit-button" style="color: #c0392b; padding:5px 10px;"><i class="fa fa-lock" aria-hidden="true"></i></button>
												<label for="email">Email: </label>
												<input type="text" name="email" value="<?php echo $str = str_replace('"','\'\'',$email); ?>" disabled>
											</p>
											<!--BR-->
											<p class="parent">
												<button type="button" class="edit-button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
												<label for="phone">Phone: </label>
												<input type="text" name="phone" value="<?php echo $str = str_replace('"','\'\'',$phone); ?>" disabled>
											</p>
											<!--BR-->
											<p class="parent">
												<button type="button" class="edit-button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
												<label for="facebook">Facebook: </label>
												<input type="text" name="facebook" value="<?php echo $str = str_replace('"','\'\'',$facebook); ?>" disabled>
											</p>
											<!--BR-->
											<p class="parent">
												<button type="button" class="edit-button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
												<label for="twitter">Twitter: </label>
												<input type="text" name="twitter" value="<?php echo $str = str_replace('"','\'\'',$twitter); ?>" disabled>
											</p>
											<!--BR-->
											<p class="parent">
												<button type="button" class="edit-button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
												<label for="linkedin">Linkedin: </label>
												<input type="text" name="linkedin" value="<?php echo $str = str_replace('"','\'\'',$linkedin); ?>" disabled>
											</p>
										</div> <!--right_side-->
									</div>
						    </div>
						  </div>
					   </div>
						<!-- /modal -->
				  </div> <!-- user -->
				</form>

				<?php
			} //while
		} //else
	} // if isset search_button

	if (isset($_POST['update_button'])) {
		$id = $_POST['id'];
		$order_number = $_POST['order_number'];
		$public_profile = $_POST['public_profile'];
		$featured_user = $_POST['featured_user'];
		$prefix = $_POST['prefix'];
		$first_name = $_POST['name'];
		$last_name = $_POST['last_name'];
		$position = $_POST['position'];
		$bio = $_POST['bio'];
		$more_expertise = $_POST['more_expertise'];
		$what_drives_me = $_POST['what_drives_me'];
		$language = $_POST['language'];
		$city = $_POST['city'];
		$area = $_POST['area'];
		$phone = $_POST['phone'];
		$facebook = $_POST['facebook'];
		$twitter = $_POST['twitter'];
		$linkedin = $_POST['linkedin'];

		$update_query = "UPDATE wp_people_table SET
		order_number = '$order_number',
		featured = '$featured_user',
		public_profile = '$public_profile',
		prefix = '$prefix',
		name = '$first_name',
		last_name = '$last_name',
		position = '$position',
		bio = '$bio',
		more_expertise = '$more_expertise',
		what_drives_me = '$what_drives_me',
		language = '$language',
		city = '$city',
		area = '$area',
		contact = '$phone',
		facebook_link = '$facebook',
		twitter_link = '$twitter',
		linkdn_link = '$linkedin'
		WHERE id='$id'";

		$conn->query($update_query);
		$sql = "ALTER TABLE `wp_people_table` ORDER BY `order_number`;";
		$conn->query($sql);
	} // if isset update_button

?>

	<script>
		$('.parent').click(function(){
		 $('input, textarea', this).attr('disabled', false);
		 $('textarea', this).css('height', '100');
		});

		$('.update-data').click(function(){
			$('input, textarea').attr('disabled', false);
		});


	</script>

<?php

} // manage_users_page

function order_profiles_page(){
	?>

		<?php

		$mysqli=new mysqli('localhost', 'alexflor_alist', 'U9B_CxijWz:/X{zdJg', 'alexflor_alist');


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
