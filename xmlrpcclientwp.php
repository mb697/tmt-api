<?php
//you have to include class-IXR.php	
require( 'class-IXR.php' ); 
//your username and password and the server you are connecting too are included in config, change to your details.
require( 'config.php' );
//validation functions
require( 'functions.php' );

$client = new IXR_Client( $url );

//if any of the fields dont meet our validation, the booking will be refused, so best to validate even though the booking should not have got this far without all this data being validated

//test that all required data is present
$reqs = array(
    'firstname' => 'You have to supply traveller first name',
    'surname' => 'You have to supply traveller surname',
    'email' => 'You have to supply traveller email address',
    'date' => 'You have to supply a start date',
    'date_end' => 'You have to supply an end date',
    'total' => 'You have to supply a total amount',
    'address' => 'You have to supply an address',
    'city' => 'You have to supply a city',
    'country' => 'You have to supply a country',
    'postcode' => 'You have to supply a postcode'
);

/* test we have a value for all required fields */
foreach( $reqs as $field => $response ) {
    
    if( !isset( $_POST[$field] ) || $_POST[$field] ==  '' )
        die( $response );
    
}   

//is email valid
$email = $_POST['email'];
if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) )
    die( 'Invalid email address' );

// is format yyyy-mm-dd and a valid date 
$date = $_POST['date'];
if ( !checkdateformat( $date ) )
    die( 'Invalid start date format' );
    
// is format yyyy-mm-dd and a valid date 
$date_end = $_POST['date_end'];
if ( !checkdateformat( $date_end ) )
    die( 'Invalid end date format' );

// is start date before end date 
if ( !date_compare( $date_end, $date ) )
    die( 'Start date must be before, or same day as, end date' );

// test total is valid format - commas will not pass the filter, so if you use them, strip them
$total = str_replace( ',', '', $_POST['total'] );
if ( !valid_total( $total ) )
    die( 'Invalid total' );

// test phone number is valid but only if we are using axcess 
$phone = $_POST['phone'];
if ( !checkPhone( $phone ) )
    die( 'Invalid phone number' );

$booking_data = array();

// you can call your post variables anything you like, but you must use the array fields shown below when passing data to TMT
$booking_data['firstname'] = $_POST['firstname'];
$booking_data['surname'] = $_POST['surname'];
$booking_data['email'] = $email;
$booking_data['address'] = $_POST['address'];
$booking_data['address2'] = $_POST['address2'];
$booking_data['city'] = $_POST['city'];
$booking_data['country'] = $_POST['country'];
$booking_data['state'] = $_POST['state'];
$booking_data['postcode'] = $_POST['postcode'];
$booking_data['phone'] = $phone;
$booking_data['date'] = $date;
$booking_data['date_end'] = $date_end;
$booking_data['total'] = $total;
$booking_data['line_items'] = $_POST['line_items'];
$booking_data['reference'] = $_POST['reference'];
//amend this to pass the URL you want to redirect users to on completion of payment. A demo thankyou page is included in the API demo
$booking_data['redirect'] = 'http://tmt.api/thankyou.php';
//amend this to pass the URL you want us to ping when an order is flagged as success of fail. The status will be appended onto it.
$booking_data['pingback'] = 'http://tmt.api/pingback.php';


//if the connection fails display error message, otherwise, TMT set-up a booking for you
if ( !$client->query( 'my.addBooking','', $user, $pass, $booking_data ) )
    die( 'Error while creating a new booking: ' . $client->getErrorCode() ." : ". $client->getErrorMessage());  

//we pass a URL back to you
$redirect = urldecode( $client->getResponse() );
//redirect the user to the URL, they will automatically be logged in to TMT and be able to make payment
header( 'Location: '  . $redirect );
?>
