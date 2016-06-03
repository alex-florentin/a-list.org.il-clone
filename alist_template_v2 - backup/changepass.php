<?
@session_start();

ini_set("display_errors","off");
require( '../../../../wp-load.php' ); // Include the file  to load wordpress connections//
global $wpdb;//Declare the global variable..//

$old=$_POST["old-pass"];
$new= $_POST["new-pass"];
$confirm= $_POST["confirm-pass"];
if($new!=$confirm){
	$_SESSION["error"]="<span style='color:red'>Your new password and confirm password do not match.</span>";
}else{
	$pass= $wpdb->get_var("Select password from wp_people_table where `status`='A' and `id`='".$_SESSION["user_id"]."'");
	if($pass!=$old){
		$_SESSION["error"]="<span style='color:red'>Your old password do not match with current password.</span>";
	}else{
		$update=$wpdb->update("wp_people_table",array('password' => md5($new)), array("id" => $_SESSION["user_id"]));
		$_SESSION["msg"]="<span style='color:blue'>Your password has been successfully changed.</span>";
	}
}

wp_safe_redirect(wp_get_referer());

			

?>