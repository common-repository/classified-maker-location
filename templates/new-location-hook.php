<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	
	add_action('classified_maker_action_post_location_main','classified_maker_action_post_location_field_set');
	
	function classified_maker_action_post_location_field_set(){
	
		//$class_classified_maker_pickform = new class_classified_maker_pickform();		
		$class_pickform = new class_pickform();		
		
		
		$class_classified_maker_loc_functions = new class_classified_maker_loc_functions();
		$post_type_location_input_fields = $class_classified_maker_loc_functions->post_type_location_input_fields();
			
			
		$top_input_field['post_title'] = $post_type_location_input_fields['post_title'];	
		$top_input_field['post_content'] = $post_type_location_input_fields['post_content'];
		$recaptcha = $post_type_location_input_fields['recaptcha'];		
		
		//$top_input_field['post_thumbnail'] = $post_type_location_input_fields[0]['post_thumbnail'];
		$meta_fields = $post_type_location_input_fields['meta_fields'];

		foreach($top_input_field as $key=>$field) {
					
			?>
            
            <div class="item">
			
			<?php

					if(!empty($top_input_field[$key])){
						
						if(!empty($_POST)){

							$meta_value = sanitize_text_field($_POST[$key]);
							$field[$key] = array_replace($field, array('input_values'=>$meta_value));
							$output_html = $class_pickform->field_set($field[$key]);
							}
						else{
							$output_html = $class_pickform->field_set($field);
							}

						//var_dump($field);
						
						
						
						echo $output_html;
						}
			?>
            
            </div>
			
			<?php
		}			
		
		
		


		foreach($meta_fields as $key=>$field){
			
			?>
            
            <div class="item">
			
			<?php
				
			if( !empty($field) ) {
				
				if(!empty($_POST)){
					
					$POST_KEY = isset($_POST[$key]) ? $_POST[$key] : '';
					
					$meta_value = sanitize_text_field($POST_KEY);
					$field[$key] = array_merge($field, array('input_values'=>$meta_value));
					$output_html = $class_pickform->field_set($field[$key]);
				
				} else {
					$output_html = $class_pickform->field_set($field);
				}
				
				//$meta_value = sanitize_text_field($_POST[$key]);
				//$field = array_merge($field, array('input_values'=>$meta_value ));
					
				
					
				echo $output_html;
			}
			?>
            
            </div>
			
			<?php
			
			

			
			
			
			
			
			
		}
		
		
					echo '<div class="item">';
					echo $class_pickform->field_set($recaptcha);
					echo '</div>';
		
		
		
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	add_action('classified_maker_action_post_location_save','classified_maker_action_post_location_save');
	
	function classified_maker_action_post_location_save(){
	
		$class_classified_maker_loc_functions = new class_classified_maker_loc_functions();
		$post_type_location_input_fields = $class_classified_maker_loc_functions->post_type_location_input_fields();
		
		$classified_maker_loc_submitted_loc_status = get_option('classified_maker_loc_submitted_loc_status');
		
		if(empty($classified_maker_loc_submitted_loc_status)){
			$classified_maker_loc_submitted_loc_status='pending';
		}
		
		$userid = get_current_user_id();
		
		$post_title = sanitize_text_field($_POST['post_title']);
		$post_content = sanitize_text_field($_POST['post_content']);
		//$post_thumbnail_id = ($_POST['post_thumbnail']);					
		
		$ads_post_data = array(
		  'post_title'    => $post_title,
		  'post_content'  => $post_content,
		  'post_status'   => $classified_maker_loc_submitted_loc_status,
		  'post_type'     => 'location',
		  'post_author'   => $userid,
		);
		
		$ads_ID = wp_insert_post($ads_post_data);

		//update_post_meta( $ads_ID, '_thumbnail_id', $post_thumbnail_id[0] );
		
		$meta_fields = $post_type_location_input_fields['meta_fields'];

	
		foreach($meta_fields as $field_key=>$field){
				
			if(!empty($_POST[$field_key])){
				
				if(is_array($_POST[$field_key])){
					$option_value = serialize($_POST[$field_key]);
				} else{
					$option_value = sanitize_text_field($_POST[$field_key]);
				}
			} else {
				$option_value = '';
			}
			update_post_meta($ads_ID, $field_key , $option_value);
		}
	}
	
	
	
	
	
	
	