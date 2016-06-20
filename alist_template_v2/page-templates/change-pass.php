<?


/**


 * Template Name: Change Password


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


<script>


$(document).ready(function(){


	$("#AddMore").click(function(){


		document.write("hi");


	});


});


</script>


	<?php get_header(); ?>


	<main class="container password">


		<div class="row">
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

		<form name="pass_form" action="<?= get_template_directory_uri(); ?>/codes/changepass.php" method="POST" >

        <div class="col-md-12" align="right">



			<div class="input">

				<label class="title" for="" style="direction:rtl">סיסמה ישנה</label>

				<div class="field">
                <input type="password" name="old-pass" id="old-pass" required />
				</div>

			</div> <!-- input -->



			<div class="input">

				<label class="title" for="" style="direction:rtl">סיסמה חדשה</label>

				<div class="field">

                <input type="password" name="new-pass" id="new-pass" required />

				</div>

			</div> <!-- input -->

			<div class="input">

				<label class="title" for="" style="direction:rtl">אשר סיסמא חדשה</label>

				<div class="field">

                <input type="password" name="con-pass" id="con-pass" required />

				</div>

			</div> <!-- input -->

			<input type="submit" value="לְהַגִישׁ" class="change-password">

		</div><!-- rightt side -->

        </form>





			</div>


	</main>


		<?php include (TEMPLATEPATH . '/footer.php'); ?>


	</body>


<script>


    $('#AddMore').click(function(){


	var family_html =  '<input type="text" placeholder="שֵׁם" name="title[]"><input type="text" placeholder="לְקַשֵׁר" name="link[]"><br />';


	$('#add').append(family_html);


});


</script>





</html>


<?


	unset($_SESSION["error"]);


	unset($_SESSION["msg"]);


?>
