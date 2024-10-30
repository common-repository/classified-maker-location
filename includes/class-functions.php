<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class class_classified_maker_loc_functions{
	
		public function __construct(){

		}
	
	public function post_type_location_input_fields(){
		
		$class_classified_maker_functions = new class_classified_maker_functions();
		$classified_maker_loc_country_list = $class_classified_maker_functions->country_list();
		
		$input_fields = array(
								
			'title'			=>'',
			'description'	=>'',
			'recaptcha'		=>  array(
														'meta_key'=>'recaptcha',
														'css_class'=>'recaptcha',
														'required'=>'yes', // (yes, no) is this field required.
														'display'=>'yes', // (yes, no)
														//'placeholder'=>'',
														'title'=>__('reCaptcha', classified_maker_loc_textdomain),
														'option_details'=>__('reCaptcha test.', classified_maker_loc_textdomain),					
														'input_type'=>'recaptcha', // text, radio, checkbox, select,
														'input_values'=>get_option('classified_maker_reCAPTCHA_site_key'), // could be array
														//'field_args'=> array('size'=>'',),
														),
			
																				
			'post_title'	=>array(
									'meta_key'=>'post_title',
									'css_class'=>'post_title',
									'placeholder'=>'Location Title',
									'required'=>'yes',									
									'title'=>__('Location Title', classified_maker_loc_textdomain),
									'option_details'=>__('Location title write here.', classified_maker_loc_textdomain),					
									'input_type'=>'text',
									'input_values'=>'',
									
								),
			'post_content'=>array(
									'meta_key'=>'post_content',
									'css_class'=>'post_content',
									'placeholder'=>'',
									'required'=>'yes',									
									'title'=>__('Location Content', classified_maker_loc_textdomain),
									'option_details'=>__('Write location details here.', classified_maker_loc_textdomain),					
									'input_type'=>'wp_editor',
									'input_values'=>'',
								),


			'meta_fields'=>array(
			
				'classified_maker_loc_country_code'=>array(
														'meta_key'=>'classified_maker_loc_country_code',
														'css_class'=>'loc_country_code',
														'placeholder'=>'',
														'required'=>'yes',														
														'title'=>__('Country', classified_maker_loc_textdomain),
														'option_details'=>'Select country',
														'input_type'=>'select',
														'input_values'=> array(),
														'input_args'=> $classified_maker_loc_country_list,
													),
				
				'classified_maker_loc_latlang'=>array(
													'meta_key'=>'classified_maker_loc_latlang',
													'css_class'=>'loc_latlang',
													'placeholder'=>'',
													'required'=>'yes',													
													'title'=>__('Latitude, Longitude', classified_maker_loc_textdomain),
													'input_values'=> '',
													'option_details'=>__('Latitude,Longitude, ex: 46.414382,10.013988', classified_maker_loc_textdomain),					
													'input_type'=>'text',
												),
			)
		);

		$input_fields = apply_filters( 'classified_maker_filter_post_location_inputs', $input_fields );

		return $input_fields;
	}
	

} new class_classified_maker_loc_functions();