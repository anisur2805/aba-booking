<?php
namespace Aba_Booking\Traits;

/**
 * Form error handler trait
 */ 
trait Form_Error {

    public $errors = [];
    
    function has_error( $key ) {
        // return isset( $this->errors[ $key ] ) ? true : false;
        return array_key_exists( $key, $this->errors );
    }

    function get_error( $key ) { 
        return array_key_exists( $key, $this->errors ) ? $this->errors[ $key ] : false;
    }
    
}