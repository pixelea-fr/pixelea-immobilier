<?php
function setAnneeConstruction($value){

	return '<strong>'.$value.'</strong>';
}
add_filter( 'ng1_filter_annee_construction', 'setAnneeConstruction',10,2) ;


function format_get_prix($value){
	return Ng1ImmoFormat::formatPrice( $value );
}
add_filter( 'ng1_filter_prix', 'format_get_prix',10,2) ;

function format_get_description($value){

	return Ng1ImmoFormat::formatDescription($value);
}
add_filter( 'ng1_filter_description', 'format_get_description',10,2) ;