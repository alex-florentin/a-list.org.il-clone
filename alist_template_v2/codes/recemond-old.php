<?
@session_start();

ini_set("display_errors","off");
require( '../../../../wp-load.php' ); // Include the file  to load wordpress connections//
global $wpdb;//Declare the global variable..//


$id=$_POST["expert_id"];
$recomender_name=$_POST["recommender_name"];
$recomender_message=$_POST["recommender_message"];

if($recomender_name!="" and $recomender_message!=""){

$values=array(
	'expert_id' => $id,
		'name' => $recomender_name,
		'comment' => $recomender_message,
		'showit' => "N",
		'status' => "A",
	'date' => date("Y/m/d")
);

$values_type=array(
"%s","%s","%s","%s","%s","%s"
);
$table= $GLOBALS['wpdb']->prefix ."expert_comments";
	$wpdb->insert(
	$table,
	$values,
	$val_type );
	wp_safe_redirect(wp_get_referer());

}
?>
