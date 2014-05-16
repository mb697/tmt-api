$(function () { $("[data-toggle='tooltip']").tooltip(); });

$(function(){
	$('.dropdown-menu li a').click(function(){				
      	var country = $(this).attr('data-value');
      	var countryDisplay = $(this).text();		      	
      	$('input.country').val(country);		      	
      	$('input.country-display').val(countryDisplay);
      	$('.input-group-btn').removeClass('open');
      	return false;

   	});
});

function isValidEmailAddress(emailAddress) {
	
	var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
	return pattern.test(emailAddress);
	
}
	
function isValidPhoneNumber( phoneNumber ){
	
	phoneNumber = phoneNumber.replace( / /gi,'' );
	
	if( phoneNumber.length >= 7 && phoneNumber.length <= 25 ) {
	
		var pattern = new RegExp(/^[0-9\-\(\)\+\s]+/i);
		return pattern.test(phoneNumber);
		
	} else {
		
		return false;
		
	}
		
}

function isValidPhoneNumber( phoneNumber ){
		
	phoneNumber = phoneNumber.replace( / /gi,'' );
	
	if( phoneNumber.length >= 7 && phoneNumber.length <= 25 ) {
	
		var pattern = new RegExp(/^[0-9\-\(\)\+\s]+/i);
		return pattern.test(phoneNumber);
		
	} else {
		
		return false;
		
	}
		
}

$(function(){
		
	$('#add-booking').submit(function() {
		
		var reason = '';
		var nullfields = [ 'firstname', 'surname', 'email', 'phone', 'address', 'city', 'country', 'postcode' ];
		var emailflag = 0;
		var phoneflag = 0;
		
		for( i = 0; i < nullfields.length; i += 1 ) {
		
			if( $( 'input[name=' + nullfields[i] + ']' ).val() == '' ) {
				
				reason = 'The highlighted fields must be completed\n';
				$( 'input[name=' + nullfields[i] + ']' ).css('background-color','yellow');
				
				if( nullfields.length[i] == 'email' )
					emailflag = 1;
				if( nullfields.length[i] == 'phone' )
					phoneflag = 1;
					
			} else {
				
				$( 'input[name=' + nullfields[i] + ']' ).css('background-color','white');
				
			}

		}
		
		if( emailflag == 0 && !isValidEmailAddress( $( 'input[name=email]' ).val() ) ) {
			
			$( 'input[name= email]' ).css('background-color','yellow');
			reason += 'You must enter a valid email address';
			
		}
		
		if( phoneflag == 0 && !isValidPhoneNumber( $( 'input[name=phone]' ).val() ) ) {
			$( 'input[name=phone]' ).css('background-color','yellow');
			reason += 'You must enter a valid phone number';
		}
		
		if( reason != '' ) {
			alert(reason);
			return false;
		} else {
			return true;
		}
		
	});
});