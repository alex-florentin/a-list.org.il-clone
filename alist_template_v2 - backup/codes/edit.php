<?

@session_start();


ini_set("display_errors","off");

require( '../../../../wp-load.php' ); // Include the file  to load wordpress connections//

global $wpdb;//Declare the global variable..//





$use1=$_POST["cat"];

$bio=$_POST["bio"];

$drive=$_POST["drive"];

$language=$_POST["language"];

$media_title=$_POST["title"];

$media_link=$_POST["link"];

$use2=$_POST["cat1"];

$youtube=$_POST["youtube"];

$facebook=$_POST["facebook"];

$twitter=$_POST["twitter"];

$linkedn=$_POST["linkdn"];

$use3=$_POST["use"];

$nick=$_POST["nick"];

$prefix=$_POST["prefix"];

$name=$_POST["name"];

$last_name=$_POST["last_name"];

$position=$_POST["position"];

$contact=$_POST["contact"];

$city=$_POST["city"];

$contact=$_POST["contact"];

$area=$_POST["area"];

$profile=$_POST["profile"];

$more=$_POST["more"];

$public=$_POST["public"];

$id=$_GET["mark"];

$title=$_POST["title"];

$link=$_POST["link"];



if($public==""){

	$public="N";

}else{

	$public="Y";

}

$check=$wpdb->get_var("Select id from wp_people_table where `username` like '$nick'");



$max_id=$wpdb->get_var("Select max(id) from wp_people_table");

$filename= $max_id+1;

if($id=="" ){

	$_SESSION["error"]="שגיאה: אנא הזן דואר אלקטרוני.";



}else{



if($_FILES["cv"]["size"]>1){

	$ext=end(explode(".",$_FILES["cv"]["name"]));

	if($ext=="pdf" or $ext=="PDF" or $ext=="doc" or $ext=="docx"){

		$cv_name=$id.".".$ext;

		if(!move_uploaded_file($_FILES["cv"]["tmp_name"],"../uploads/cv/".$cv_name)){

			$_SESSION["error"].="CV upload failed.";

		}else{

			$wpdb->update("wp_people_table",array("cv"=>$cv_name),array("id"=>$id),array("%s"),array("%s"));

		}

	}else{

		$_SESSION["mgs"]="קרתה שגיאה: רק ניתן להעלות קובץ PDF עבור קורות חיים.";

	}

}



if($_FILES["photo"]["size"]>1){

	if(is_array(getimagesize($_FILES["photo"]["tmp_name"]))){

		$ext1=end(explode(".",$_FILES["photo"]["name"]));

		$photo_name=$id.".".$ext1;

		if(!move_uploaded_file($_FILES["photo"]["tmp_name"],"../uploads/profile/".$photo_name)){

			$_SESSION["error"].="שגיאה: נכשלה העלאת תמונה הפרופיל. נסה שוב.";
		}else{

			$wpdb->update("wp_people_table",array("profile_image"=>$photo_name),array("id"=>$id),array("%s"),array("%s"));

			//==============Resize Image===========================//


$path= "../uploads/profile/".$photo_name;


$dest="../uploads/profile/size/".$photo_name;

 unlink($dest);
include_once("Thumbnail.php");


$thumb = new Thumbnail($path);


$thumb->resize(300,450);


$thumb->save($dest);


//======================================================//


		}

	}

}



foreach($language as $temp){

	$lang.=$temp.",";

}

foreach($profile as $temp){

	$pro.=$temp.",";

}

foreach($title as $temp){

	$tit.=$temp.";";

}

foreach($link as $temp){

	$lnk.=$temp.",";

}



$values=array(

			'name' => $name,

  			'last_name' => $last_name,

  			'username' => $nick,

  			'contact' => $contact,

  			'prefix' => ($prefix),

  			'city' => $city,

  			'position' => $position,

  			'area' => $area,

  			'expertise' => $pro,

  			'language' =>$lang,

  			'more_expertise' => $more,

  			'bio' => $bio,

  			'what_drives_me' => $drive,

  			'youtube' =>$youtube,

  			'title' =>$tit,

  			'link' =>$lnk,

  			'institutional_use_1' => $use1[0].",".$use1[1].",".$use1[2],

  			'institutional_use_2' => $use2[0].",".$use2[1].",".$use2[2].",".$use2[3],

  			'institutional_use_3' => $use3,

  			'facebook_link' => $facebook,

  			'twitter_link' => $twitter,

  			'linkdn_link' => $linkedn,

			'public' => $public

);



$values_type=array(

"%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s");

$where= array('id'=>$id);

$where_type=array("%s");



$table= $GLOBALS['wpdb']->prefix ."people_table";

	$wpdb->update(

	$table,

	$values,

	 $where,

	$val_type,

	$where_type );
		$_SESSION["msg"]="הפרופיל שלך עודכן.";








}

wp_safe_redirect(wp_get_referer());







?>