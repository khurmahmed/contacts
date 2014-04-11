$(function() {
	$('#form').on('submit', validateForm)
});

//Validates input. This needs to be extended. Things like phone number need to be checked for length and isNumerical. Email => email. etc.
function validateForm() {
	
	var error = 0;
	$('input').each(function(x,y) {
		var val = $(y).val();
		if(!validate(y.name, val)) {
			$(y).css('border', 'solid 1px red')
			error = 1;
		} else {
			$(y).css('border', 'solid 1px 888');
		}
	});
	
	$('textarea').each(function(x,y) {
		var val = $(y).val();
		if(!validate(y.name, val)) {
			$(y).css('border', 'solid 1px red')
			error = 1;
		} else {
			$(y).css('border', 'solid 1px 888');
		}
	});
	
	if(error === 1) {
		return false;
	}
}

//Validates input. This needs to be extended. Things like phone number need to be checked for length and isNumerical. Email => email. etc.
function validate(input, val) {
	
	switch(input) {
		case 'home':
			return isNumerical(val) && validateLength(val);
			break;
		case 'mobile':
			return isNumerical(val) && validateLength(val);
			break;
		case 'work':
			return isNumerical(val) && validateLength(val);
			break;
		case 'country':
			break;
		default:
			return validateLength(val);
			break;
	}
}

function validateLength(val) {
	return val.length > 2;
}

function isNumerical(val) {
	return $.isNumeric(val);
}