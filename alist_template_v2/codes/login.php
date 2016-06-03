<?
@session_start();

ini_set("display_errors","off");
require( '../../../../wp-load.php' ); // Include the file  to load wordpress connections//
global $wpdb;//Declare the global variable..//

$user=$_POST["email"];
$password=md5($_POST["password"]);

if($user=="" or $password==""){
	$_SESSION["error"]="Both fields are necessary. Please fill up both fields";
}else{
$check=$wpdb->get_var("Select id from wp_people_table where `email` like '$user' and `password`='$password'");
if($check!=""){
	
	$_SESSION["email"]=$email;
	$_SESSION["password"]=$password;
	$_SESSION["user_id"]=$check;
	$_SESSION["nick"]=$wpdb->get_var("Select username from wp_people_table where `id` like '$check'");
	 
	 wp_safe_redirect(get_site_url());
}else{
	$_SESSION["error"]="The email and password combination do not match.";
	 wp_safe_redirect(wp_get_referer());
	
}
}

?>