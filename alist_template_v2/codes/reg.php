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
$email=$_POST["email"];
$nick=$_POST["nick"];
$password=$_POST["password"];
$con_password=$_POST["con-password"];
$prefix=$_POST["prefix"];
$name=$_POST["name"];
$last_name=$_POST["last_name"];
$position=$_POST["position"];
$contact=$_POST["contact"];
$city=$_POST["city"];
$area=$_POST["area"];
$profile=$_POST["profile"];
$more=$_POST["more"];
$public=$_POST["public"];
$title=$_POST["title"];
$link=$_POST["link"];
$_SESSION["post_values"]=$_POST;
$check=$wpdb->get_var("Select id from wp_people_table where `email` like '$email'");
$max_id=$wpdb->get_var("Select max(id) from wp_people_table");
$filename= $max_id+1;
if($password=="" or $con_password==""){
	$_SESSION["error"]="שגיאה: שדות סיסמא ואישור הסיסמה לא יכולים להיות ריקים.";
}elseif($check!=""){
	$_SESSION["error"]='שגיאה: חשבון עם דוא"ל זה כבר קיים.';
}elseif($password!=$con_password){
	$_SESSION["error"]="שגיאה: סיסמאות אינם תואמת.";
}else{
if($_FILES["cv"]["size"]>5){
$ext=end(explode(".",$_FILES["cv"]["name"]));
if($ext=="pdf" or $ext=="PDF" or $ext=="doc" or $ext=="docx"){
	$cv_name=$filename.".".$ext;
	if(!move_uploaded_file($_FILES["cv"]["tmp_name"],"../uploads/cv/".$cv_name)){
		$_SESSION["error"].="שגיאה: העלאת קורות חיים נכשלה. בבקשה נסה שוב.";
	}
	}else{
	$_SESSION["error"]="קרתה שגיאה: רק ניתן להעלות קובץ PDF עבור קורות חיים.";
	}
}
if(is_array(getimagesize($_FILES["photo"]["tmp_name"]))){
$ext1=end(explode(".",$_FILES["photo"]["name"]));
$photo_name=$filename.".".$ext1;
if(!move_uploaded_file($_FILES["photo"]["tmp_name"],"../uploads/profile/".$photo_name)){
	$_SESSION["error"].="Profile photo upload failed.";
}else{
//==============Resize Image===========================//
$path= "../uploads/profile/".$photo_name;
$dest="../uploads/profile/size/".$photo_name;
include_once("Thumbnail.php");
$thumb = new Thumbnail($path);
$thumb->resize(300,450);
$thumb->save($dest);
//======================================================//
//==============Resize Image square===========================//
$path= "../uploads/profile/".$photo_name;
$dest="../uploads/profile/square/".$photo_name;
include_once("Thumbnail.php");
$thumb_square = new Thumbnail($path);
$thumb_square->resize(150,150);
$thumb_square->save($dest);
//======================================================//
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
if($public=='Y'){
	$public="Y";
}else{
	$public="N";
}
$values=array(
			'name' => $name,
  			'last_name' => $last_name,
  			'email' => $email,
  			'username' => $nick,
  			'password' => md5($password),
			'contact' => $contact,
  			'prefix' => $prefix,
  			'city' => $city,
  			'position' => $position,
  			'area' => $area,
  			'expertise' => $pro,
  			'language' =>$lang,
  			'more_expertise' => $more,
  			'bio' => $bio,
  			'what_drives_me' => $drive,
  			'cv' =>$cv_name,
  			'youtube' =>$youtube,
  			'title' =>$tit,
  			'link' =>$lnk,
  			'institutional_use_1' => $use1[0].",".$use1[1].",".$use1[2],
  			'institutional_use_2' => $use2[0].",".$use2[1].",".$use2[2].",".$use2[3],
  			'institutional_use_3' => $use3,
  			'facebook_link' => $facebook,
  			'twitter_link' => $twitter,
  			'linkdn_link' => $linkedn,
  			'profile_image' =>$photo_name,
  			'status' => 'A',
			'featured' => 'N',
 			'date' => date("Y/m/d"),
);
$values_type=array(
"%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s"
);
$table= $GLOBALS['wpdb']->prefix ."people_table";
	if($wpdb->insert(
	$table,
	$values,
	$val_type )){
		$id=$wpdb->insert_id;
		$wpdb->update($table,array("public_profile" => $public , "public" => $public),array("id"=>$id),array("%s","%s"),array("%s"));
		$_SESSION["msg"]="חשבונך הוגדר בהצלחה והפרופיל שלך הועבר לאישור.";
	}else{
		$_SESSION["error"]="שגיאה: ייצרת החשבון שלך נכשלה. נסה שוב או פנה למנהל האתר.";
	}
}
		wp_safe_redirect(wp_get_referer());
?>
