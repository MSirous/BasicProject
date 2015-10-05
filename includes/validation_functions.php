
<?php
	$error = array();


function fieldname_as_text($fieldname){
	$fieldname = str_replace("_", " ", $fieldname);
	$fieldname = ucfirst($fieldname);
	return $fieldname;
}

	// * presence
function has_presence($value){
	return isset($value) && $value !=="";

}

function validation_presence($required_fields){
	global $error;
	foreach ($required_fields as $field ) {
		$value = trim($_POST[$field]);
		if (!has_presence($value)) {
			$error[$field] = fieldname_as_text($field). " can't be blank. ";
		}
	}
}

	
	// * string length
function has_max_length($value, $max){
	return strlen($value) <= $max;
}



function validate_max_length ($fields_with_max_lengths){
	global $error;
	foreach ($fields_with_max_lengths as $field => $max) {
		$value = trim($_POST[$field]);
		if (!has_max_length($value, $max)) {
			$error[$field] = fieldname_as_text($field). " is too long";
		}
	}
}
	

	// * inclusion is a set
function has_inclusion_in ($value, $set){
	return in_array($value,$set);
}

?>