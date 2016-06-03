<?
@session_start();

ini_set("display_errors","off");
require( '../../../../wp-load.php' ); // Include the file  to load wordpress connections//
global $wpdb;//Declare the global variable..//

$old=$_POST["old-pass"];
$new= $_POST["new-pass"];
$confirm= $_POST["con-pass"];
if($new!=$confirm){
	$_SESSION["error"]="<div class='say-error'>הסיסמאות אינם תואמות.</div>";
}else{
	$pass= $wpdb->get_var("Select password from wp_people_table where `status`='A' and `id`='".$_SESSION["user_id"]."'");
	if($pass!=md5($old)){
		$_SESSION["error"]="<div class='say-error'>הסיסמה הישנה תואמת לסיסמא החדשה.</div>";
	}else{
		$update=$wpdb->update("wp_people_table",array('password' => md5($new)), array("id" => $_SESSION["user_id"]));
		$_SESSION["msg"]="<div class='say-ok'>הסיסמה שונתה בהצלחה.</div>";
	}
}

wp_safe_redirect(wp_get_referer());



?>
