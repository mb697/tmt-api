<?php
function checkdateformat( $date ){
        
    /* is format correct yyyy-mm-dd */
    if( preg_match( '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date ) ) { 
        
        /* is it a real date eg not 2020-13-45 */
        
        /* m, d, y */
        if ( checkdate( substr( $date, 5, 2 ), substr( $date, 8, 2 ), substr( $date, 0, 4 ) ) ) {

            return true;
        
        } else {
            return false;
        }
        
    } else { 
        return false;
    }
    
}

/* test that date1 is greater than or equal to date2 */
function date_compare( $date1, $date2 ){
    
    $check1 = mktime( 0, 0, 0, substr( $date1, 5, 2 ), substr( $date1, 8, 2 ), substr( $date1, 0, 4 ) );
    $check2 = mktime( 0, 0, 0, substr( $date2, 5, 2 ), substr( $date2, 8, 2 ), substr( $date2, 0, 4 ) );
    
    if ( $check1 >= $check2 )                 
        return true;
    else
        return false;
    
}

function checkPhone( $tel ) {
    
    $temp = preg_replace( '/\D/', '', $tel );
    
    // are there invalid chars, is the length correct, is the first digit a + sign or number
    if( 
        strlen( $tel ) >= 7 && 
        strlen( $tel ) <= 25 && 
        preg_match( '/^[0-9 .()-]++$/', substr( $tel, 1 ) ) && 
        preg_match( '/^[0-9+]++$/', substr( $tel, 0, 1 ) ) &&
        strlen( $temp ) >= 7 &&
        strlen( $temp ) <= 20 
    ) {
        
        return true;
        //if we remove brackets and plus sign, we are left with digits only, lets check that the remainder is between 7 - 20 chars long
        
    } else {
        
        return false;
        
    }
    
}


function valid_total( $number ) {
    return filter_var( $number, FILTER_VALIDATE_FLOAT );
}
?>