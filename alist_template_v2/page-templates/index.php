<?
/**
 * Template Name: Search Page
 *
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
 @session_start();
//$marked=$_GET["marked"];
$value = trim($_POST["cat"]);
$temp = explode(",",$value);
foreach($temp as $val){
	if($val!=0 and $val!=""){
	$con .= "(`expertise` like '%,$val,%' or `expertise` like '$val,%') and ";
	}
}
$con.="1=1";
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>">
      <title>מומחים ומומחיות ערבים</title>
      <meta property="og:title" content="מומחים ומומחיות ערבים" />
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
      <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css">
      <?php do_action('wp_head'); ?>
      <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    </head>
	<body>
	<?php get_header(); ?>
	<main class="container profiles">
		<div id="content" class="row">
			<?
			global $wpdb;
			$rows=$wpdb->get_results("Select * from wp_people_table where `status`='A' and ($con)");
			//echo $wpdb->last_query;
			foreach($rows as $row){
			if(is_array(getimagesize(get_template_directory_uri()."/uploads/profile/sieze/".$row->profile_image))){
			$page= get_page_by_title('Profile Page');
			$link= get_site_url()."/?page_id=".$page->ID."&marked=".$row->id;
			?>
            <a href="<?= $link ?>" class="image-wrapper col-xs-12 col-sm-4 col-md-3 col-lg-3 slideOutRight">
			 <span class="mask"></span>
			 <img src="<?php echo get_template_directory_uri(); ?>/uploads/profile/size/<?= $row->profile_image?>" class="grayscale">
			 <div class="name-and-title">            <div class="name"><?= stripslashes($row->prefix). " " .stripslashes($row->name)." ".stripslashes($row->last_name) ?></div>  			   <span class="title"><?= stripslashes($row->position) ?></span>			 </div>
			</a>
            <?	}
			}	?>
		</div>
	</main>
		<?php include (TEMPLATEPATH . '/footer.php'); ?>
	</body>
</html>