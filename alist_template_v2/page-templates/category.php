<?
/**


 * Template Name: Category Page


 *


 *


 * @package WordPress


 * @subpackage Twenty_Fourteen


 * @since Twenty Fourteen 1.0


 */





 @session_start();
 ini_set("display_errors","off");


 $marked=$_REQUEST["marked"];





	if($marked!=""){


		$con.="`expertise` like '%$marked,%' or `expertise` like '%$marked,%'";


	}


?>





<!DOCTYPE html>
<html <?php language_attributes(); ?>>


<?php include (TEMPLATEPATH . '/head.php'); ?>





    <body>





    <?php get_header(); ?>



	<main class="container profiles">
		<div id="content" class="row">


			<?


			$rows=$wpdb->get_results("Select * from wp_people_table where `status`='A' and $con");

			foreach($rows as $row){


			if(is_array(getimagesize(get_template_directory_uri()."/uploads/profile/".$row->profile_image))){}{

			$page= get_page_by_title('Profile Page');


			//$link= get_site_url()."/?page_id=".$page->ID."&marked=".$row->id;
			$link= get_site_url()."/profile-page/".$row->id;

			?>





         <a href="<?= $link ?>" class="image-wrapper col-xs-12 col-sm-4 col-md-3 col-lg-3">
			 <span class="mask"></span>
			 <img src="<?php echo get_template_directory_uri(); ?>/uploads/profile/size/<?= $row->profile_image?>" class="grayscale">
			 <div class="name-and-title">
            <div class="name"><?= $row->name." ".$row->last_name ?></div>
            <span class="title"><?= $row->position?></span>
			 </div>
			</a>



            <?		}



				}



			?>
		</div>


	</main>





		<?php include (TEMPLATEPATH . '/footer.php'); ?>



	</body>
    <!-- search page -->


</html>
