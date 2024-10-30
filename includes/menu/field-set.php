<?php	


/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


	$class_classified_maker_loc_functions = new class_classified_maker_loc_functions();
	$meta_fields_data = $class_classified_maker_loc_functions->meta_fields_data();
	
	$meta_fields = $meta_fields_data[0]['meta_fields'];
	
	
	//var_dump($meta_fields);


	if(empty($_POST['classified_maker_loc_hidden']))
		{

			$classified_maker_loc_field_set = get_option( 'classified_maker_loc_field_set' );

		}
	else
		{	
			if($_POST['classified_maker_loc_hidden'] == 'Y') {
				//Form data sent
	
				if(empty($_POST['classified_maker_loc_field_set']))
					{
						$_POST['classified_maker_loc_field_set'] = array();
					}
				
				$classified_maker_loc_field_set = stripslashes_deep($_POST['classified_maker_loc_field_set']);
				update_option('classified_maker_loc_field_set', $classified_maker_loc_field_set);
	
	
				?>
				<div class="updated"><p><strong><?php _e('Changes Saved.', classified_maker_loc_textdomain ); ?></strong></p></div>
		
				<?php
				} 
		}
	

	?>





<div class="wrap classified-maker-admin field-set">

	<div id="icon-tools" class="icon32"><br></div>
    
	<h2><?php _e(sprintf('%s - Category Field Set',classified_maker_loc_plugin_name), classified_maker_loc_textdomain); ?></h2>
    
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
            <input type="hidden" name="classified_maker_loc_hidden" value="Y">
            <?php settings_fields( 'classified_maker_loc_plugin_options' );
                    do_settings_sections( 'classified_maker_loc_plugin_options' );
    
                
            ?>





            <p>
            You can display input fields based on catgory, please check which input fields you want to load on ads submission form on which category.
            </p>
            
			<div class="reset-field-set button">Reset</div>
			<div class="update-field-set button">Update</div>
            
            
			<?php
			
			classified_maker_loc_admin_update_field_set();
			
			
			$taxonomy = 'ads_cat';

			$args=array(
			  'orderby' => 'name',
			  'order' => 'ASC',
			  'taxonomy' => $taxonomy,
			  'hide_empty' => false,
			  //'parent'  => 0,
			  );
			
			$categories = get_categories($args);


			
			
			
			
			//var_dump($categories);
			
			foreach($categories as $category){
				//var_dump($category);
				
				echo '<div class="cat-set expandable">';
				echo '<div class="header">'.$category->name.'</div>';
				echo '<div class="options">';	
				
				echo '<div class="meta-fields">';
				
				if(!empty($classified_maker_loc_field_set)){
					
					$field_set_cat = $classified_maker_loc_field_set[$category->cat_ID];
					
					
					
					foreach($field_set_cat as $key=>$field){
						
						$field_title = $meta_fields[$key]['title'];
						
						if(isset($classified_maker_loc_field_set[$category->cat_ID][$key]['checked']) && $classified_maker_loc_field_set[$category->cat_ID][$key]['checked']=='yes'){
							
							$checked = 'checked';
							
							}
						else{
							$checked = '';
							}
						
						echo '<div class="items">
						<div class="title">'.$field_title.'</div>
						<label><input type="checkbox" '.$checked.' name="classified_maker_loc_field_set['.$category->cat_ID.']['.$key.'][checked]" value="yes" />'.__('Display ads submission form',classified_maker_loc_textdomain).'</label>
								<br />				
						';
						
						if(isset($classified_maker_loc_field_set[$category->cat_ID][$key]['display_ads_page']) && $classified_maker_loc_field_set[$category->cat_ID][$key]['display_ads_page']=='yes'){
							
							$checked = 'checked';
							
							}
						else{
							$checked = '';
							}
						
						
						echo '<label><input type="checkbox" '.$checked.' name="classified_maker_loc_field_set['.$category->cat_ID.']['.$key.'][display_ads_page]" value="yes" />'.__('Display on Ads page',classified_maker_loc_textdomain).'</label>';
						
						
					
						echo '<input type="hidden" name="classified_maker_loc_field_set['.$category->cat_ID.']['.$key.'][id]" value="'.$key.'" />';
						echo '</div>';	
						}
					
					}
				else{
					
					foreach($meta_fields as $field_id=>$field){
						
						echo '<div class="items">
						<div class="title">'.$field['title'].'</div>
						<label><input type="checkbox" checked name="classified_maker_loc_field_set['.$category->cat_ID.']['.$field_id.'][checked]" value="yes" />'.__('Display ads submission form',classified_maker_loc_textdomain).'</label><br />
						<label><input type="checkbox" checked name="classified_maker_loc_field_set['.$category->cat_ID.']['.$field_id.'][display_ads_page]" value="yes" />'.__('Display on Ads page',classified_maker_loc_textdomain).'</label>						
						';
						
						
						echo '<input type="hidden" name="classified_maker_loc_field_set['.$category->cat_ID.']['.$field_id.'][id]" value="'.$field_id.'" />';					
						
						
						
						
						echo '</div>';					
						
						}
					
					}
				
							

				echo '</div>';					
				
				echo '</div>';				
				
							
				echo '</div>';
				
				
				}
			
			
			
			
			
			
			
			
			
			?>


<script>
jQuery(document).ready(function($)
	{
		$( ".meta-fields" ).sortable({revert: "invalid",});
		//$( ".meta-fields" ).sortable({revert: "invalid", handle: '.items'});		
		

	})
</script> 







			<p class="submit">
				<input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes',classified_maker_loc_textdomain ); ?>" />
			</p>
		</form>


</div>
