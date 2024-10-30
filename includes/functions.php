<?php
/*
* @Author 		pickplugins
* Copyright: 	pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	
	

	
	function classified_maker_loc_ajax_add_suggestion()
	{
		$location = $_POST['location'];
		$arr_html = array();
		
		$args = array(	
			'post_type' 	=> 'location',
			'post_status' 	=> 'publish',
			's' 			=> $location,
		);
							
		$wp_query = new WP_Query( $args );
		
		if ( $wp_query->have_posts() ) :
		
			$i=0;
			while ( $wp_query->have_posts() ) : $wp_query->the_post();	
				//array_push($arr_html, get_the_title());
				
				$arr_html[$i] = get_the_title();
				
				$i++;
			endwhile;
		endif;
		
		echo json_encode($arr_html);
		die();
	}
	add_action('wp_ajax_classified_maker_loc_ajax_add_suggestion', 'classified_maker_loc_ajax_add_suggestion');
	add_action('wp_ajax_nopriv_classified_maker_loc_ajax_add_suggestion', 'classified_maker_loc_ajax_add_suggestion');


	function classified_maker_filter_ads_meta_fields( $options = array() ) {
		
		$options[] = array(
			'title'=>__('Location',classified_maker_loc_textdomain),
			'description'=>'',								
			'options'=>array(
				'classified_maker_loc_api_key'=>array(
					'key'=>'classified_maker_loc_api_key',
					'css_class'=>'loc_api_key',
					'placeholder'=>'',
					'title'=>__('Google Maps API Key', classified_maker_loc_textdomain),
					'option_details'=>'',
					'input_type'=>'text', // text, radio, checkbox, select,
					'input_values'=> '',
				),
				
				
				'classified_maker_loc_map_type'=>array(
					'key'=>'classified_maker_loc_map_type',
					'css_class'=>'loc_map_type',
					'placeholder'=>'',
					'title'=>__('Select Map Type', classified_maker_loc_textdomain),
					'option_details'=>'',
					'input_type'=>'select',
					'input_values'=> array(''),
					'input_args'=> array('dynamic'=>__('Dynamic', classified_maker_loc_textdomain),'static'=>__('Static',classified_maker_loc_textdomain)), // could be array	
				),
				
				'classified_maker_loc_map_zoom'=>array(
					'key'=>'classified_maker_loc_map_zoom',
					'css_class'=>'loc_map_zoom',
					'placeholder'=>'',
					'title'=>__('Select Zoom Scale', classified_maker_loc_textdomain),
					'option_details'=>'',	
					'input_type'=>'text',
					'input_values'=> '10',
					
				),
				
				'classified_maker_loc_display_wiki_content'=>array(
					'key'=>'classified_maker_loc_display_wiki_content',
					'css_class'=>'loc_display_wiki_content',
					'placeholder'=>'',
					'title'=>__('Display content from Wikipedia', classified_maker_loc_textdomain),
					'option_details'=>__('If your location has no content itself then this will collect information from WikiPedia', classified_maker_loc_textdomain),					
					'input_type'=>'select',
					'input_values'=> array(''),
					'input_args'=> array('yes'=>__('Yes', classified_maker_loc_textdomain),'no'=>__('No	',classified_maker_loc_textdomain)), // could be array	
					
				),
				
				'classified_maker_loc_display_img_from_map'=>array(
					'key'=>'classified_maker_loc_display_img_from_map',
					'css_class'=>'loc_display_img_from_map',
					'placeholder'=>'',
					'title'=>__('Display Image from Map', classified_maker_loc_textdomain),
					'option_details'=>__('If your location has no media itself then this will collect image from Google Map', classified_maker_loc_textdomain),					
					'input_type'=>'select',
					'input_values'=> array(''),
					'input_args'=> array('yes'=>__('Yes', classified_maker_loc_textdomain),'no'=>__('No	',classified_maker_loc_textdomain)), // could be array	
					
				),
				
				'classified_maker_loc_submitted_loc_status'=>array(
					'key'=>'classified_maker_loc_submitted_loc_status',
					'css_class'=>'submitted_loc_status',
					'placeholder'=>'',
					'title'=>__('New Submitted Location Status ?', classified_maker_loc_textdomain),
					'option_details'=>__('ew Submitted Location Status ?', classified_maker_loc_textdomain),					
					'input_type'=>'select',
					'input_values'=> array(''),
					'input_args'=> array( 'draft'=>__('Draft',classified_maker_loc_textdomain), 'pending'=>__('Pending',classified_maker_loc_textdomain), 'publish'=>__('Published',classified_maker_loc_textdomain), 'private'=>__('Private',classified_maker_loc_textdomain), 'trash'=>__('Trash',classified_maker_loc_textdomain)), // could be array	
				),
				
				'classified_maker_loc_allow_edit_published_loc'=>array(
					'key'=>'classified_maker_loc_allow_edit_published_loc',
					'css_class'=>'allow_edit_published_loc',
					'placeholder'=>'',
					'title'=>__('Can user edit published Location ?', classified_maker_loc_textdomain),
					'option_details'=>__('Can user edit their published Location ?', classified_maker_loc_textdomain),	
					'input_type'=>'select',
					'input_values'=> array(''),
					'input_args'=> array('no'=>__('No',classified_maker_loc_textdomain),'yes'=>__('Yes', classified_maker_loc_textdomain),), // could be array
				),
				
				
				
				
			),
		);
		
		
		return $options;
	}
	add_filter( 'classified_maker_filter_ads_meta_fields', 'classified_maker_filter_ads_meta_fields' );
	


	
	function curl_get_contents($url){
	  $curl = curl_init($url);
	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	  $data = curl_exec($curl);
	  curl_close($curl);
	  return $data;
	}
	
	
	