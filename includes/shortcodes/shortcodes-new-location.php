<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_classified_maker_loc_shortcodes_new_location{
	
    public function __construct(){
		
		//add_shortcode( 'ads_in_map', array( $this, 'classified_maker_loc_ads_in_map' ) );
		add_shortcode( 'classified_maker_new_location', array( $this, 'classified_maker_new_location' ) );
		//add_shortcode( 'classified_maker_loc_adcount', array( $this, 'classified_maker_loc_adcount' ) );

		
   	}


	public function classified_maker_new_location($atts, $content = null ) {
		$atts = shortcode_atts( 
			array(

		), $atts);
		
		$html = '';
		
	
		include classified_maker_loc_plugin_dir .'templates/new-location.php';				

		return $html;
	}
	
	
	
} 

new class_classified_maker_loc_shortcodes_new_location();