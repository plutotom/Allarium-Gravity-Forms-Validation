<?php

/*
Plugin Name: Gravity Forms Validation - Allarium
Plugin URI: https://github.com/plutotom/Allarium-Gravity-Forms-Validation
Description: Checks for gravity forms fields to have unique values.
Version: 1.0
Author: Allarium
Author URI: https://www.allarium.com/
License: GPLv2 or later
Text Domain: Gravity Forms Validation
*/


if( !function_exists ( 'add_action' ) ){
    echo "Hi there! I'm just a plugin not much I can do when called directly.";
    exit;
}


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
        // Checks if class is available from Gravity Forms. 
        if ( class_exists( 'GFCommon' ) ) {
            $entry = GFFormsModel::get_current_lead();
            if($entry === false){
                // If no one is on a form then stops class from running.
                return false;
            }else{
                $this->AGFVvalidationCheck();
            }
        }
	}

    public function find_duplicates ($input){
        $unique = array_unique($input);
        $duplicates_values = array_diff_assoc($input, $unique);
        return $duplicates_values;
    }

    public function AGFVvalidationCheck(){
        // Gets current selected form entries.
        $entry = GFFormsModel::get_current_lead();
        // The id of each field in group one.
        for ($i = 0; $i < count($this->_args['field_ids']); $i++) {
            $id_of_section = $this->_args['field_ids'][$i];
            $section = array(intval($entry[$id_of_section[0]]),intval($entry[$id_of_section[1]]),intval($entry[$id_of_section[2]]),intval($entry[$id_of_section[3]]));

            $duplicate = $this->find_duplicates($section);
            if($duplicate !== []){
                // looping through each id to check it agents the duplicates array.
                foreach($id_of_section as $id){
                    //this is getting the value of each field by its id.
                    $value_of_field = rgpost( 'input_'. $id ); 
                    if(in_array($value_of_field, $duplicate) ){
                        // Getting all fields that had duplicates in them and sending error messages.
                        add_filter( 'gform_field_validation_' . $this->_args['form_id'] . "_" . $id, function($result, $value, $form, $field){
                            $result["message"] = "Please make sure all values are unique.";
                            $result["is_valid"] = false;
                            return $result;
                        },
                        10, 4 );
                    }
                }
            }
        }
    }
    
}

