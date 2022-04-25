<?php 
namespace Aba_Booking;

use Aba_Booking\Frontend\Modal;
use Aba_Booking\Frontend\Shortcode;

class Frontend {
      public function __construct() {
            
            new Modal();
            new Shortcode();
      } 
      
}
