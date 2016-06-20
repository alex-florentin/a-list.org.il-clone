<?
/**
* Template Name: Edit Profile Page
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/

@session_start();
error_reporting(0);
$id=$_SESSION["user_id"];
$row=$wpdb->get_row("select * from wp_people_table where `id`='$id'");

foreach($row as $key=>$value){
	$row->$key = stripslashes($value);
}

if($_SESSION["user_id"]==""){

	echo "Error: Login required!";

}else{


?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php include (TEMPLATEPATH . '/head.php'); ?>
<body>

<script>	$(document).ready(function(){	$("#AddMore").click(function(){	document.write("hi"); });	});</script>

<?php get_header(); ?>

<!-- delete -->
<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>


<main class="container register">

	<div class="row">

		<form name="form" action="<?= get_template_directory_uri(); ?>/codes/edit.php?mark=<?= $_SESSION["user_id"]?>" method="POST" enctype="multipart/form-data">

			<?
			if($_SESSION["error"]!=""){
				echo "<div class='row'><div class='say-error'>".$_SESSION["error"]. "</div></div>"; }
				elseif($_SESSION["msg"]!=""){
						echo "<div class='row'><div class='say-ok'>".$_SESSION["msg"]. "</div></div>"; }
			?>

		<div class="left-side col-xs-12 col-sm-6 col-md-6 col-xs-12">

			<div class="input">
				<label class="title" for="bio">ניסיון תעסוקתי / אקדמי</label> <!-- work/academic experience -->
				<div class="field">
					<textarea name="bio" rows="2" cols="60"><?= strip_tags($row->bio)?></textarea>
				</div>
			</div> <!-- input -->

			<div class="input">
				<label class="title" for="">מה מניע אותי?</label> <!-- what drives me? -->
				<div class="field">
					<textarea name="drive" rows="2" cols="60"><?= strip_tags($row->what_drives_me)?></textarea>
				</div>
			</div> <!-- input -->

			<div class="input">
				<label class="title" for="">שפות</label> <!-- languages -->
				<div class="field">
					<?	$values=explode(",",$row->language);
					if(in_array("עברית",$values)){ $selected1="checked";	}
					if(in_array("אנגלית",$values)){	$selected2="checked";	}
					if(in_array("ערבית",$values)){ $selected3="checked";	}
					if(in_array("רוסית",$values)){	$selected4="checked";	}
					if(in_array("אמהרית",$values)){	$selected5="checked";	}
					if(in_array("צרפתית",$values)){	$selected6="checked";	}
					if(in_array("יידיש",$values)){	$selected7="checked";	}
					if(in_array("פרסית",$values)){	$selected8="checked";	}
					if(in_array("גרמנית",$values)){	$selected9="checked";	}
					if(in_array("פולנית",$values)){	$selected10="checked";}
					if(in_array("איטלקית",$values)){ echo $selected11="checked"; }
					if(in_array("ספרדית",$values)){ $selected12="checked";	}
					if(in_array("פורטוגזית",$values)){	$selected13="checked"; }
					if(in_array("הינדי",$values)){	$selected14="checked";	}
					?>
					<div class="checkbox-group">
						<label>
							<input name="language[]" type="checkbox" value="עברית" <?= $selected1?>><span>עברית</span>
						</label>
						<label>
							<input name="language[]" type="checkbox" value="אנגלית" <?= $selected2?>><span>אנגלית</span>
						</label>
						<label>
							<input name="language[]" type="checkbox" value="ערבית" <?= $selected3?>><span>ערבית</span>
						</label>
						<label>
							<input name="language[]" type="checkbox" value="רוסית" <?= $selected4?>><span>רוסית</span>
						</label>
						<label>
							<input name="language[]" type="checkbox" value="אמהרית" <?= $selected5?>><span>אמהרית</span>
						</label>
						<label>
							<input name="language[]" type="checkbox" value="צרפתית" <?= $selected6?>><span>צרפתית</span>
						</label>
						<label>
							<input name="language[]" type="checkbox" value="יידיש" <?= $selected7?>><span>יידיש</span>
						</label>
						<label>
							<input name="language[]" type="checkbox" value="פרסית" <?= $selected8?>><span>פרסית</span>
						</label>
						<label>
							<input name="language[]" type="checkbox" value="גרמנית" <?= $selected9?>><span>גרמנית</span>
						</label>
						<label>
							<input name="language[]" type="checkbox" value="פולנית" <?= $selected10?>><span>פולנית</span>
						</label>
						<label>
							<input name="language[]" type="checkbox" value="איטלקית" <?= $selected11?>><span>איטלקית</span>
						</label>
						<label>
							<input name="language[]" type="checkbox" value="ספרדית" <?= $selected12?>><span>ספרדית</span>
						</label>
						<label>
							<input name="language[]" type="checkbox" value="פורטוגזית" <?= $selected13?>><span>פורטוגזית</span>
						</label>
						<label>
							<input name="language[]" type="checkbox" value="הינדי" <?= $selected14?>><span>הינדי</span>
						</label>
					</div>
				</div>
			</div> <!-- input -->

			<div class="input">
				<label class="title" for="">הופעות במדיה מאמרים</label> <!-- media -->
				<div class="field">
					<div class="media">
						<div id="add">
							<?
							$title=explode(";",$row->title);
							$link=explode(",",$row->link);
							for($id=0; $title[$id]!=""; $id++){
								?>
								<input type="text" placeholder="שֵׁם" name="title[]" value="<?= $title[$id] ?>">
								<input type="text" placeholder="לְקַשֵׁר" name="link[]" value="<?= $link[$id]?>"><br />
								<?
							}
							?>
						</div>
						<button type="button" id="AddMore">+</button>
					</div>
				</div>
			</div> <!-- input -->

			<div class="input">
				<label class="title" for="">רשתות חברתיות</label> <!-- social networks -->
				<div class="field">
					<input class="facebook" name="facebook" type="text" placeholder="קישור פייסבוק" value="<?= $row->facebook_link?>"><i class="fa fa-facebook"></i>
					<input class="twitter" name="twitter" type="text" placeholder="קישור טוויטר" value="<?= $row->twitter_link?>"><i class="fa fa-twitter"></i>
					<input class="linkedin" name="linkdn" type="text"  placeholder="קישור Linkedin" value="<?= $row->linkdn_link?>"><i class="fa fa-linkedin"></i>
				</div>
			</div> <!-- input -->

			<div class="input">
				<label class="title" for="">סרטון יוטיוב</label> <!-- youtube video -->
				<div class="field">
					<input type="text" placeholder="קישור וידאו" name="youtube" value="<?= $row->youtube?>">
				</div>
			</div> <!-- input -->

	<div class="input">
		<label class="title" for="file">תמונת פרופיל</label>
		<div class="field">
		<div class="profile-image">
				<img src="<?= get_template_directory_uri()?>/uploads/profile/size/<?= $row->profile_image?>" />
				<div class="update_profile_image">
					<input type="file" name="photo" id="photo-file" class="inputfile" value="<?= $row->cv?>" />
					<label for="photo-file" class="upload-photo-input"><span>תמונת פרופיל עדכון</span></label>
				</div>
		</div>
		</div>
	</div> <!-- input -->

</div> <!-- left side -->


<div class="right-side col-xs-12 col-sm-6 col-md-6 col-xs-12">
	<div class="input">
		<label class="title" name="email" for="">כתובת דואר אלקטרוני</label>
		<div class="field">
			<input type="text" name="email" value="<?= $row->email?>">
		</div>
	</div> <!-- input -->

	<div class="input">
		<label class="title" for="">כינוי</label>
		<div class="field">
			<input type="text" name="nick" value="<?= $row->username?>">
		</div>
	</div> <!-- input -->

	<div class="input">
		<label class="title" for="">תחילית (לדוגמה - פרופ', ד"ר, עו"ד וכו'.)</label>
		<div class="field">
			<input type="text" name="prefix" value="<?= htmlentities($row->prefix); ?>">
		</div>
	</div> <!-- input -->

	<div class="input">
		<label class="title" for="">שם פרט</label>
		<div class="field">
			<input type="text" name="name" value="<?= $row->name?>">
		</div>
	</div> <!-- input -->

	<div class="input">
		<label class="title" for="">שם משפחה</label>
		<div class="field">
			<input type="text" name="last_name" value="<?= $row->last_name?>">
		</div>
	</div> <!-- input -->

	<div class="input">
		<label class="title" for="">תואר</label>
		<div class="field">
			<input type="text" name="position" value="<?= htmlentities($row->position); ?>">
		</div>
	</div> <!-- input -->

	<div class="input">
		<label class="title" for="">טלפון</label>
		<div class="field">
			<input type="text" name="contact" value="<?= $row->contact?>">
		</div>
	</div> <!-- input -->

	<div class="input">
		<label class="title" for="">ישוב</label>
		<div class="field">
			<input type="text" name="city" value="<?= $row->city?>">
		</div>
	</div> <!-- input -->

	<div class="input">
		<label class="title" for="">אזור מגורים</label>
		<div class="field">
			<select class="" name="area">
				<?
				if($row->area == "- ללא -"){
					$selected1="selected";
				}else
				{
					$selected1="";
				}
				if($row->area == "שארן"){
					$selected2="selected";
				}
				if($row->area == "דָרוֹם"){
					$selected3="selected";
				}
				if($row->area == "תל אביב"){
					$selected4="selected";
				}
				if($row->area == "יְרוּשָׁלַיִם")
				{
					$selected5="selected";
				}
				if($row->area == "צָפוֹן"){
					$selected6="selected";
				}
				?>
				<option value="- ללא -" <?= $selected1 ?> >- ללא -</option>
				<option value="שארן" <?= $selected2 ?> >שארן</option>
				<option value="דָרוֹם" <?= $selected3?> >דָרוֹם</option>
				<option value="תל אביב" <?= $selected4 ?> >תל אביב</option>
				<option value="יְרוּשָׁלַיִם" <?= $selected5 ?> >יְרוּשָׁלַיִם</option>
				<option value="צָפוֹן" <?= $selected6 ?> >צָפוֹן</option>
			</select>
		</div>
	</div> <!-- input -->

	<div class="input">
		<label class="title" for=""></label> <!-- areas of expertise -->
		<div class="field">
			<div class="checkbox-group">
				<? global $wpdb;	$rows=$wpdb->get_results("Select name , id from wp_category_table");
				foreach($rows as $row1) {	$value=explode(",",$row->expertise);
					$selected="";
					foreach($value as $temp){
						if($row1->id == $temp){
							$selected="checked";
						}
					}
					echo "<label><input name='profile[]' type='checkbox' value='".$row1->id."' $selected><span>".$row1->name."</span></label>&nbsp;";
				}
				?>
			</div>
		</div>
	</div> <!-- input -->

	<div class="input">
		<label class="title" for="">More in expertise</label>
		<div class="field">
			<textarea name="more" rows="2" cols="60" id="br2"><?= strip_tags($row->more_expertise)?></textarea>
		</div>
	</div> <!-- input -->
</div> <!-- right side -->

<div class="middle-side col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="cv-edit">
		<? if($row->cv!="") { ?>
			<a class="uploaded-cv" href="<?= get_template_directory_uri()?>/uploads/cv/<?= $row->cv?>" target="_blank">
				CV זמין
			</a>


			<div class="update-cv">
					<input type="file" name="cv" id="file" class="inputfile" value="<?= $row->cv?>" />
					<label for="file" class="update-cv-input"><span>CV עדכון</span></label>
			</div>


		<? } else {
			?>
			<div class="upload-cv">
				<input type="file" name="cv" id="file" class="inputfile" value="<?= $row->cv?>" />
				<label for="file" class="upload-cv-input"><span>העלה קורות חיים שלך</span></label>
			</div>
			<?
		}?>
	</div>

	<input type="submit" value="הגשה" class="submit-edit">


	<div class="password">
		<? $page= get_page_by_title('Change Password');
		$link= get_site_url()."/?page_id=".$page->ID;
		?>
		<a href='<?= $link ?>' class="change-password">שנה סיסמא</a>
	</div>

</div> <!-- middle side -->

		</form> <!-- form -->

	</div> <!-- row -->

</main> <!-- main -->


<script src="<?php bloginfo('template_url') ?>/js/custom-file-input.js"></script>

<?php include (TEMPLATEPATH . '/footer.php'); ?>
<script>
 $('#AddMore').click(function(){	var family_html =
	'<input type="text" placeholder="שֵׁם" name="title[]" maxlength="40"><input type="text" placeholder="לְקַשֵׁר" name="link[]"><br />';
	$('#add').append(family_html);	});
</script>
<?	unset($_SESSION["error"]);	unset($_SESSION["msg"]); ?>

</body>
</html>
<?php } ?>
