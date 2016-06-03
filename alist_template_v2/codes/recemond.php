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
	if($wpdb->insert(
	$table,
	$values,
	$val_type )){


$email= $wpdb->get_var("Select email from wp_people_table where `id`='$id'");
$name= $wpdb->get_var("Select name from wp_people_table where `id`='$id'");
$lname= $wpdb->get_var("Select last_name from wp_people_table where `id`='$id'");
ini_set("SMTP", "smtp.a-list.org.il");
ini_set("sendmail_from", "support@a-list.org.il");

$headers ='From: support@a-list.org.il'."\n";
$headers .='Reply-To: support@a-list.org.il'."\n";
$headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
$headers .='Content-Transfer-Encoding: 8bit';
		$to=$email.",mayanksharma1273@gmail.com";

		// subject
		$subject = 'New recommendation on A-list';
		// message
        $message = "
		  
		  			Hello $name $lname,

					You have a new recommendation on your profile.
					Please review it.

					A-list team.


					";

		// To send HTML mail, the Content-type header must be set

    mail(
        $to,
        $subject,
        $message,
        $headers
    );
	}

	wp_safe_redirect(wp_get_referer());

}



?>
