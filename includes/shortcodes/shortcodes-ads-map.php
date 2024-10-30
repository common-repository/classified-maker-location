<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_classified_maker_loc_shortcodes_ads_map{
	
    public function __construct(){
		
		add_shortcode( 'classified_maker_ads_map', array( $this, 'classified_maker_loc_ads_map' ) );
		//add_shortcode( 'classified_maker_loc_new', array( $this, 'classified_maker_loc_new' ) );
		//add_shortcode( 'classified_maker_loc_adcount', array( $this, 'classified_maker_loc_adcount' ) );

		
   	}

		
	public function classified_maker_loc_ads_map($atts, $content = null ) {
		$atts = shortcode_atts( 
			array(

		), $atts);
		
		$html = '';
			
		include classified_maker_loc_plugin_dir .'templates/ads-in-map.php';				

		return $html;
	}
	

	
	
} 

new class_classified_maker_loc_shortcodes_ads_map();