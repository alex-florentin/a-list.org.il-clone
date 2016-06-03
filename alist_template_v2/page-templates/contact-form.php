<?
/**
 * Template Name: Contact Form Page
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
@session_start();
$id=$_SESSION["user_id"];
$row=$wpdb->get_row("select * from wp_people_table where `id`='$id'");
?>

 <!DOCTYPE html>
<html <?php language_attributes(); ?>>
 	<?php include (TEMPLATEPATH . '/head.php'); ?>
 	<body>
 	<?php get_header(); ?>
 	<div class="page-title-shadow"></div>
 	<div class="page-title">
 		<div class="container">
 			<h2 class="title-contact-form"><?php echo get_the_title(); ?></h2>
 		</div>
 	</div>
 	<main class="container page">    <div class="text-contact-page">        <?php dynamic_sidebar( 'text-contact-page' ); ?>    </div>
     <?php if (have_posts()) : while (have_posts()) : the_post();?>
     <?php the_content(); ?>
     <?php endwhile; endif; ?>
 	</main>
 		<?php include (TEMPLATEPATH . '/footer.php'); ?>
 	</body>