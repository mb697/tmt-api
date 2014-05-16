<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Trust My Travel API Demo</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    
    <div class="header">
        <div class="container">
            <h1>Payment Result</h1>
            <p>
               Thank you for choosing us.
            </p>
        </div>
    </div>
    
    <div class="container content">
        
        <div class="row">
            
            <div class="col-sm-12">
                
                <h1 class="page_title">Your Order</h1>
                
            </div>
            
        </div>
        
        <div class="row">
            
            <div class="col-sm-12">
                
                <?php
                //the TMT booking ID will be appended onto your redirect URL                
                if( isset( $_GET['booking_id'] ) ) {
                    
                    $booking_id = $_GET['booking_id'];
                    
                    //you have to include class-IXR.php to ping the API
                    require( 'class-IXR.php' ); 
                    //your username and password and the server you are connecting too are included in config, change to your details.
                    require( 'config.php' );
                    //validation functions
                    require( 'functions.php' );
                    
                    $client = new IXR_Client( $url );
                    
                    
                    if ( !$client->query( 'my.bookingStatus','', $user, $pass, $booking_id ) )
                        die( 'Error while getting Booking status: ' . $client->getErrorCode() ." : ". $client->getErrorMessage() );  
                    
                    //these are the only responses that we will return as indicated
                    
                    switch( $client->getResponse() ) {
                        
                        case 1 :
                            echo '<p>Booking Paid</p>';
                            break;
                        case 2:
                            echo '<p>Booking Payment Pending</p>';
                            break;
                        case 3:
                            echo '<p>Booking Payment Failed</p>';
                            break;
                    }
                    
                    } else {
                        
                        echo '<p>No Booking ID supplied. Something went wrong</p>';
                        
                    }
                ?>
                
            </div>
            
        </div>
        
    </div><!--/.container-->
    
    

</body>
</html>