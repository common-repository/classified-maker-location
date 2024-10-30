<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_classified_maker_loc_shortcodes_ads_count_lcoaiton{
	
    public function __construct(){
		
		//add_shortcode( 'ads_in_map', array( $this, 'classified_maker_loc_ads_in_map' ) );
		//add_shortcode( 'classified_maker_loc_new', array( $this, 'classified_maker_loc_new' ) );
		add_shortcode( 'classified_maker_ads_count_lcoaiton', array( $this, 'classified_maker_ads_count_lcoaiton' ) );

		
   	}

		

	
	public function classified_maker_ads_count_lcoaiton($atts, $content = null ) {
		$atts = shortcode_atts( 
			array(
				'max_item' => '10',
		), $atts);
		
		$max_item = $atts['max_item'];
		
		$html = '';
		include classified_maker_loc_plugin_dir .'templates/adcount.php';				
		return $html;
	}
	
	
	
	
	
} 

new class_classified_maker_loc_shortcodes_ads_count_lcoaiton();