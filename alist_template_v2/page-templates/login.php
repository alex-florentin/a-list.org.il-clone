<?

/**

 * Template Name: Login Page

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

	<main class="container login">

        <form name="form" action="<?= get_template_directory_uri()?>/codes/login.php" method="POST" enctype="multipart/form-data">

    		<div class="container">

                <?

        			if($_SESSION["error"]!=""){

        				echo "<div class='row'>

        					<span style='color:red'>".$_SESSION["error"]."</span>

        				</div>";

        			}elseif($_SESSION["msg"]!=""){

        				echo "<div class='row'>

        					<span style='color:green'>".$_SESSION["msg"]."</span>

        				</div>";

        			}

        		?>



                <div class="row">

        			<div class="input">

        				<div class="field">

                            <input type="text" name="email" placeholder="דואל" required />

        				</div>

        			</div> <!-- input -->

        			<div class="input">

        				<div class="field">

        		            <input type="password" name="password" placeholder="סיסמה" required />

        				</div>

        			</div> <!-- input -->

                    <input type="submit" name="submit" value="הגשה" class="submit-login">

                </div><!-- Row -->

            </div><!-- Container -->

        </form>











	</main>











		<?php include (TEMPLATEPATH . '/footer.php'); ?>







	</body>







</html>



<?

	unset($_SESSION["error"]);

	unset($_SESSION["msg"]);

?>

