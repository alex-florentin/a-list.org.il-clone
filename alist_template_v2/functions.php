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
	wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/style.css', false,'1.1','all');
	//js and css files added
	?>
	<div class="title-n-form">
		<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
		<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
		<h2>Manage users</h2>
		<form class="back-search-box" method="post">
			<input class="field" type="text" name="search_query" size="30" placeholder="email, first name & last name">
			<button class="button" type="submit" name="search_button">Search</button>
		</form>
	</div>
	<?php echo $output; ?>
	<?php

	$conn = new mysqli ('localhost', 'alexflor_alist', 'U9B_CxijWz:/X{zdJg', 'alexflor_alist') or die ("Connexion problem!");
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

				<form class='search-result' method='POST' action='/project/alist/wp-admin/admin.php?page=manage-users-page.php'>
				<input type='hidden' name='id' value='<?php echo $id ?>'>
					<div class='block'>
						<div class='left_side'>
							<div class='avatar'><img src='/project/alist/wp-content/themes/alist_template_v2/uploads/profile/size/<?php echo $avatar ?>'></div>
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

						<div class='right_side'>
							<!-- break -->
							<div id='edit_prefix'>
								<b href='#' id='edit_prefix'>
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</b>
								<span>Prefix: </span>
								<p>
									<input type="hidden" name="prefix" value="<?php echo $str = str_replace('"','\'\'',$prefix); ?>">
									<p class="fade_prefix edit_prefix"><?php echo $str = str_replace('"','\'\'',$prefix); ?></p>
								</p>
							</div>
							<!-- break -->
							<div id='edit_name'>
								<b href='#' id='edit_name'>
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</b>
								<span>First name: </span>
								<p>
									<input type="hidden" name="name" value="<?php echo $str = str_replace('"','\'\'',$first_name); ?>">
									<p class="fade_name edit_name"><?php echo $str = str_replace('"','\'\'',$first_name); ?></p>
								</p>
							</div>
							<!-- break -->
							<div id='edit_last_name'>
								<b href='#' id='edit_last_name'>
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</b>
								<span>Last name: </span>
								<p>
									<input type="hidden" name="last_name" value="<?php echo $str = str_replace('"','\'\'',$last_name); ?>">
									<p class="fade_last_name edit_last_name"><?php echo $str = str_replace('"','\'\'',$last_name); ?></p>
								</p>
							</div>
							<!-- break -->
							<div id='edit_position'>
								<b href='#' id='edit_position'>
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</b>
								<span>Position: </span>
								<p>
									<input type="hidden" name="position" value="<?php echo $str = str_replace('"','\'\'',$position); ?>">
									<p class="fade_position edit_position"><?php echo $position ?></p>
								</p>
							</div>
							<!-- break -->
							<div id='edit_bio'>
								<b href='#' id='edit_bio'>
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</b>
								<span>Bio: </span>
								<p>
									<input type="hidden" name="bio" value="<?php echo $str = str_replace('"','\'\'',$bio); ?>">
									<p class="fade_bio edit_bio"><?php echo $bio ?></p>
								</p>
							</div>
							<!-- break -->
							<div id='edit_expertise'>
								<b href='#' id='edit_expertise'>
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</b>
								<span>More in expertise: </span>
								<p>
									<input type="hidden" name="more_expertise" value="<?php echo $str = str_replace('"','\'\'',$more_expertise); ?>">
									<p class="fade_expertise edit_expertise"><?php echo $more_expertise ?></p>
								</p>
							</div>
							<!-- break -->
							<div id='edit_drives'>
								<b href='#' id='edit_drives'>
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</b>
								<span>What drives me: </span>
								<p>
									<input type="hidden" name="what_drives_me" value="<?php echo $str = str_replace('"','\'\'',$what_drives_me); ?>">
									<p class="fade_drives edit_drives"><?php echo $what_drives_me ?></p>
								</p>
							</div>
							<!-- break -->
							<div id='edit_city'>
								<b href='#' id='edit_city'>
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</b>
								<span>City: </span>
								<p>
									<input type="hidden" name="city" value="<?php echo $str = str_replace('"','\'\'',$city); ?>">
									<p class="fade_city edit_city"><?php echo $str = str_replace('"','\'\'',$city); ?></p>
								</p>
							</div>
							<!-- break -->
							<div id='edit_area'>
								<b href='#' id='edit_area'>
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</b>
								<span>Area: </span>
								<p>
									<input type="hidden" name="area" value="<?php echo $str = str_replace('"','\'\'',$area); ?>">
									<p class="fade_area edit_area"><?php echo $str = str_replace('"','\'\'',$area); ?></p>
								</p>
							</div>
							<!-- break -->
							<div id='edit_email' class="edit_email">
								<b id='edit_email'>
									<i class="fa fa-lock" aria-hidden="true"></i>
								</b>
								<span>Email: </span>
								<p>
									<input type="hidden" name="email" class="edit_email" value="<?php echo $email ?>">
									<p class="fade_email"><?php echo $email ?></p>
								</p>
							</div>
							<!-- break -->
							<div id='edit_phone'>
								<b href='#' id='edit_phone'>
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</b>
								<span>Phone: </span>
								<p>
									<input type="hidden" name="phone" value="<?php echo $phone ?>">
									<p class="fade_phone edit_phone"><?php echo $phone ?></p>
								</p>
							</div>
							<!-- break -->
							<div id='edit_facebook'>
								<b href='#' id='edit_facebook'>
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</b>
								<span>Facebook: </span>
								<p>
									<input type="hidden" name="facebook" value="<?php echo $facebook ?>">
									<p class="fade_facebook edit_facebook"><?php echo $facebook ?></p>
								</p>
							</div>
							<!-- break -->
							<div id='edit_twitter'>
								<b href='#' id='edit_twitter'>
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</b>
								<span>Twitter: </span>
								<p>
									<input type="hidden" name="twitter" value="<?php echo $twitter ?>">
									<p class="fade_twitter edit_twitter"><?php echo $twitter ?></p>
								</p>
							</div>
							<!-- break -->
							<div id='edit_linkedin'>
								<b href='#' id='edit_linkedin'>
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</b>
								<span>Linkedin: </span>
								<p>
									<input type="hidden" name="linkedin" value="<?php echo $linkedin ?>">
									<p class="fade_linkedin edit_linkedin"><?php echo $linkedin ?></p>
								</p>
							</div>
							<!-- break -->
						</div> <!--right_side-->
					</div> <!--block-->
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
		$update_order = "ALTER TABLE `wp_people_table` ORDER BY `order_number`";
		$conn->query($update_order);
	} // if isset update_button

?>

<script>
      function edit_prefix(id) {
      $('#' + id + ' .edit_prefix').each(function(index) {
      $(this).replaceWith($('<input value="' + $(this).html() + '" type="text" name="prefix"/>'));
      });};
      $('#edit_prefix').click(function(){
		edit_prefix('edit_prefix');
      });
      ///////////////////////////////////////////////////////////////////////////////
		function edit_name(id) {
      $('#' + id + ' .edit_name').each(function(index) {
      $(this).replaceWith($('<input value="' + $(this).html() + '" type="text" style="margin-right:5px" name="name"/>'));
      });};
      $('#edit_name').click(function(){
		edit_name('edit_name');
      });
      ///////////////////////////////////////////////////////////////////////////////
		function edit_last_name(id) {
      $('#' + id + ' .edit_last_name').each(function(index) {
      $(this).replaceWith($('<input value="' + $(this).html() + '" type="text" style="margin-right:5px" name="last_name"/>'));
      });};
      $('#edit_last_name').click(function(){
		edit_last_name('edit_last_name');
      });
		///////////////////////////////////////////////////////////////////////////////
		function edit_position(id) {
      $('#' + id + ' .edit_position').each(function(index) {
      $(this).replaceWith($('<input value="' + $(this).html() + '" type="text" style="margin-right:5px" name="position"/>'));
      });};
      $('#edit_position').click(function(){
		edit_position('edit_position');
      });
      ///////////////////////////////////////////////////////////////////////////////
      function edit_bio(id) {
      $('#' + id + ' .edit_bio').each(function(index) {
      $(this).replaceWith($('<textarea style="width:100%;margin-top:5px;" name="bio" cols="100" rows="5">' + $(this).html() + '</textarea>'));
      });};

      $('#edit_bio').click(function(){
		edit_bio('edit_bio');
      });
		///////////////////////////////////////////////////////////////////////////////
		function edit_expertise(id) {
      $('#' + id + ' .edit_expertise').each(function(index) {
      $(this).replaceWith($('<textarea style="width:100%;margin-top:5px;" name="more_expertise" cols="100" rows="5">' + $(this).html() + '</textarea>'));
      });};

      $('#edit_expertise').click(function(){
		edit_expertise('edit_expertise');
      });
		///////////////////////////////////////////////////////////////////////////////
		function edit_drives(id) {
      $('#' + id + ' .edit_drives').each(function(index) {
      $(this).replaceWith($('<textarea style="width:100%;margin-top:5px;" name="what_drives_me" cols="100" rows="5">' + $(this).html() + '</textarea>'));
      });};

      $('#edit_drives').click(function(){
		edit_drives('edit_drives');
      });
		///////////////////////////////////////////////////////////////////////////////
		function edit_city(id) {
      $('#' + id + ' .edit_city').each(function(index) {
      $(this).replaceWith($('<input value="' + $(this).html() + '" type="text" name="city"/>'));
      });};
      $('#edit_city').click(function(){
		edit_city('edit_city');
      });
		///////////////////////////////////////////////////////////////////////////////
		function edit_area(id) {
      $('#' + id + ' .edit_area').each(function(index) {
      $(this).replaceWith($('<input value="' + $(this).html() + '" type="text" name="area"/>'));
      });};
      $('#edit_area').click(function(){
		edit_area('edit_area');
      });
		///////////////////////////////////////////////////////////////////////////////
		function edit_phone(id) {
      $('#' + id + ' .edit_phone').each(function(index) {
      $(this).replaceWith($('<input value="' + $(this).html() + '" type="text" name="phone"/>'));
      });};
      $('#edit_phone').click(function(){
		edit_phone('edit_phone');
      });
		///////////////////////////////////////////////////////////////////////////////
		function edit_facebook(id) {
      $('#' + id + ' .edit_facebook').each(function(index) {
      $(this).replaceWith($('<input value="' + $(this).html() + '" type="text" name="facebook"/>'));
      });};
      $('#edit_facebook').click(function(){
		edit_facebook('edit_facebook');
      });
		///////////////////////////////////////////////////////////////////////////////
		function edit_twitter(id) {
      $('#' + id + ' .edit_twitter').each(function(index) {
      $(this).replaceWith($('<input value="' + $(this).html() + '" type="text" name="twitter"/>'));
      });};
      $('#edit_twitter').click(function(){
		edit_twitter('edit_twitter');
      });
		///////////////////////////////////////////////////////////////////////////////
		function edit_linkedin(id) {
      $('#' + id + ' .edit_linkedin').each(function(index) {
      $(this).replaceWith($('<input value="' + $(this).html() + '" type="text" name="linkedin"/>'));
      });};
      $('#edit_linkedin').click(function(){
		edit_linkedin('edit_linkedin');
      });
		///////////////////////////////////////////////////////////////////////////////

		$(".edit_prefix").click(function(){
			$(".fade_prefix").fadeOut(0);
		});
		$(".edit_name").click(function(){
			$(".fade_name").fadeOut(0);
		});
		$(".edit_last_name").click(function(){
			$(".fade_last_name").fadeOut(0);
		});
		$(".edit_position").click(function(){
			$(".fade_position").fadeOut(0);
		});
		$(".edit_bio").click(function(){
			$(".fade_bio").fadeOut(0);
		});
		$(".edit_expertise").click(function(){
			$(".fade_expertise").fadeOut(0);
		});
		$(".edit_drives").click(function(){
			$(".fade_drives").fadeOut(0);
		});
		$(".edit_language").click(function(){
			$(".fade_language").fadeOut(0);
		});
		$(".edit_city").click(function(){
			$(".fade_city").fadeOut(0);
		});
		$(".edit_area").click(function(){
			$(".fade_area").fadeOut(0);
		});
		$(".edit_phone").click(function(){
			$(".fade_phone").fadeOut(0);
		});
		$(".edit_facebook").click(function(){
			$(".fade_facebook").fadeOut(0);
		});
		$(".edit_twitter").click(function(){
			$(".fade_twitter").fadeOut(0);
		});
		$(".edit_linkedin").click(function(){
			$(".fade_linkedin").fadeOut(0);
		});

  </script>

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
