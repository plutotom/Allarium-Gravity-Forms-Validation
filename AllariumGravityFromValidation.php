<?php

/*
Plugin Name: Gravity Forms Validation - Allarium
Plugin URI: 
Description: Checks for gravity forms fields to have unique values.
Version: 1.0
Author: Allarium
Author URI: https://www.allarium.com/
License: GPLv2 or later
Text Domain: Gravity Forms Validation
*/


// Allarium-Gravity-Form-Validation
class AGFVValidationCheck {
    

    public function __construct( $args = array() ) {
		$this->_args = wp_parse_args( $args, array(
			'form_id'             => false,
			'field_ids'           => false,
            		) );      
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
		add_filter( sprintf( 'gform_field_validation_%s', $this->_args['form_id'] ), array( $this, 'AGFVvalidationCheck' ),10 , 4 );

	}
    // Function to check if there are duplicates in an array.
    public function AGFVhas_duplicates( $array ) {
        return count( array_keys( array_flip($array))) == count( $array );
    }

    public function AGFVvalidationCheck($result, $value, $form, $field){
        // Gets current selected form entries.
        $entry = GFFormsModel::get_current_lead();
        // The id of each field in group one.

        for ($i = 0; $i < count($this->_args['field_ids']); $i++) {
            $id_of_section = $this->_args['field_ids'][$i];
            $section = array(intval($entry[$id_of_section[0]]),intval($entry[$id_of_section[1]]),intval($entry[$id_of_section[2]]),intval($entry[$id_of_section[3]]));
            
            if($this->AGFVhas_duplicates($section)){
            }else {
                $result['is_valid'] = false;
                break;
            }
        }
        return $result;
    }
}
