<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


	$class_pickform = new class_pickform();


	$classified_maker_account_required_post_ads = get_option( 'classified_maker_account_required_post_ads' );
	$classified_maker_loc_submitted_loc_status = get_option('classified_maker_loc_submitted_loc_status');
	
	
	
	//$class_classified_maker_pickform = new class_classified_maker_pickform();

?>

<div class="new-location pickform">

    <div class="validations">
    
    <?php
	
	
	if(isset($_POST['post_location_hidden'])){
		
		$class_classified_maker_loc_functions = new class_classified_maker_loc_functions();
		$post_type_location_input_fields = $class_classified_maker_loc_functions->post_type_location_input_fields();
		
		//var_dump($_POST);

			$location_title = $post_type_location_input_fields['post_title'];	
			$location_content = $post_type_location_input_fields['post_content'];
			$recaptcha = $post_type_location_input_fields['recaptcha'];			
			
			$meta_fields = $post_type_location_input_fields['meta_fields'];
			
			$validations = array();


			if(empty($_POST['post_title'])){
				
				 $validations['post_title'] = 'missing';
				 echo '<div class="failed"><b><i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.$location_title['title'].'</b> '.__('missing',classified_maker_loc_textdomain).'.</div>';
				}
			
			if(empty($_POST['post_content'])){
				
				 $validations['post_content'] = 'missing';
				 echo '<div class="failed"><b><i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.$location_content['title'].'</b> '.__('missing',classified_maker_loc_textdomain).'.</div>';
				}



			if(empty($_POST['g-recaptcha-response'])){
				
				 $validations['recaptcha'] = 'missing';
				 echo '<div class="failed"><b><i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.$recaptcha['title'].'</b> '.__('missing',classified_maker_loc_textdomain).'.</div>';
				}






				
				
			foreach($meta_fields as $key=>$field_data){
				
				$meta_key = $field_data['meta_key'];
				$meta_title = $field_data['title'];	
								
				if(isset($_POST[$meta_key]))
				 $valid = $class_pickform->validations($field_data, $_POST[$meta_key]);
				 
				 if(!empty( $valid)){
					 $validations[$meta_key] = $valid;
					 echo '<div class="failed"><b><i class="fa fa-exclamation-circle" aria-hidden="true"></i> '.$meta_title.'</b> '.$valid.'.</div>';
					 
					 }					 
				}

			//var_dump($validations);

			if(empty($validations)){
				
				do_action('classified_maker_action_post_location_save');
				
				echo '<div class="success"><i class="fa fa-check"></i> '.__('Location submitted successfully.',classified_maker_loc_textdomain).'</div>';
				echo '<div class="success"><i class="fa fa-check"></i> '.__('Status:',classified_maker_loc_textdomain).' '.$classified_maker_loc_submitted_loc_status.'</div>';				
				
				}
			else{
				
				$location_title = array_merge($location_title, array('input_values'=>$class_pickform->sanitizations($_POST['post_title'], 'text')));
				$location_content = array_merge($location_content, array('input_values'=>$class_pickform->sanitizations($_POST['post_content'], 'wp_editor')));	
				
	
				
				foreach($meta_fields as $meta_key=>$field_data){
					
					$input_type = $field_data['input_type'];
					
					if(!empty($_POST[$meta_key])){
						$meta_value = $class_pickform->sanitizations($_POST[$meta_key], $input_type);
						}
					else{
						$meta_value = '';
						}
	
					//$meta_title = $field_data['title'];	
									
					$meta_fields_new[$meta_value] =  array_merge($field_data, array('input_values'=>$meta_value));	
					
					if(!empty($meta_fields_new)){
						
						$meta_fields = $meta_fields_new;
						
						}
										 
				}
				
				
				
				
				
				
				
				
				
				}

		
	




/*

		$errors = $class_classified_maker_pickform->validations($_POST,$post_type_location_input_fields);
	

		if(!empty($_POST) && !empty($errors)){
			
			foreach($errors as $error){
				
				?>
				<div class="failed"><i class="fa fa-times"></i> <?php echo $error; ?></div>
				<?php

				}
			}
		else{
			
			do_action('classified_maker_action_post_location_save');
			
			}

*/




		}

	?>
    
    </div>



	<?php
    do_action('classified_maker_action_post_location_before');
    
    if($classified_maker_account_required_post_ads=='yes' && !is_user_logged_in()){
        echo  __(sprintf('Please <a href="%s">login</a> to post ads.',$account_page_url),classified_maker_textdomain);;
        }
    else{
        
    //var_dump($_POST);
    ?>
    <form enctype="multipart/form-data"   method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <input type="hidden" name="post_location_hidden" value="Y">
    <?php
    
    
    do_action('classified_maker_action_post_location_main');
	

	
    
    wp_nonce_field( 'classified_maker' );
    ?>
    <input class="post-ads-submit" type="submit" value="<?php _e('Submit',classified_maker_textdomain); ?>" />
    </form>
    <?php
    
    
    do_action('classified_maker_action_post_location_after');
        
	}
        
    
    ?>

</div>