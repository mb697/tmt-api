<?php
/* this simply logs the date, time and status of the booking as a demonstration of pingback in action.
 * if you place this file and response.txt on a server and pass the URL as pingback the text file will be updated won notification of payment success/failure from the bank. 
 * Please note that if we don't get a definitive fail (e.g. traveller closes their browser without completing payment), you can wait up to 30 minutes for notification of this.
 */ 
$file = 'response.txt';
$current = file_get_contents( $file );
$data = ( isset( $_GET['status'] ) ) ? $_GET['status'] . ' ' : ' ';
$current .=  date( 'Y-m-d H:i:s') . " status: " . $data . "\n";
file_put_contents( $file, $current );
?>
