<?
@session_start();

ini_set("display_errors","off");
require( '../../../../wp-load.php' ); // Include the file  to load wordpress connections//
global $wpdb;//Declare the global variable..//
	unset($_SESSION["email"]);
	unset($_SESSION["password"]);
	unset($_SESSION["user_id"]);
	unset($_SESSION["nick"]);;
	 
	 wp_safe_redirect(get_site_url());

?>