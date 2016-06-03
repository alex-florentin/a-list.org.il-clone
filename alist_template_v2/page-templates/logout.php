<?
/**

 * Template Name: Logout Page

 * 

 * 

 * @package WordPress

 * @subpackage Twenty_Fourteen

 * @since Twenty Fourteen 1.0

 */

 @session_start();

?>



<!DOCTYPE html>


<html <?php language_attributes(); ?>>
  <?php include (TEMPLATEPATH . '/head.php'); ?>

  <body>

  	<?php get_header(); ?>

  <?php

  session_start();

  session_destroy();

  ?>

            <div class="logout-container">

                <span>סיום</span>

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">עבור לדף הראשי</a>

            </div>



        <?php include (TEMPLATEPATH . '/footer.php'); ?>

	</body>

</html>

