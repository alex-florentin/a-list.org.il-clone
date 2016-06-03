<?
@session_start();

ini_set("display_errors","off");
require( '../../../../wp-load.php' ); // Include the file  to load wordpress connections//
global $wpdb;//Declare the global variable..//


$id=$_GET["id"];

$table=$GLOBALS["wpdb"]->prefix."expert_comments";
$update= $wpdb->update($table,array("status" => "NA"),array("id" => $id),array("%s"),array("%s"));	
	wp_safe_redirect(wp_get_referer());

		
			

?>