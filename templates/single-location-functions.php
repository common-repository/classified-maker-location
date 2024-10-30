<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 




	add_action( 'classified_maker_action_loc_single_main', 'classified_maker_template_loc_single_header', 10 );
	add_action( 'classified_maker_action_loc_single_main', 'classified_maker_loc_template_single_ads_list', 20 );	
	add_action( 'classified_maker_action_loc_single_main', 'classified_maker_loc_template_single_related', 20 );	

	function get_custom_post_type_template_location($single_template) {
		 global $post;

		 if ($post->post_type == 'location') {
			  $single_template = classified_maker_loc_plugin_dir . 'templates/location-single.php';
		 }
		 return $single_template;
	}
	add_filter( 'single_template', 'get_custom_post_type_template_location' );

	if ( ! function_exists( 'classified_maker_template_loc_single_header' ) ) {
		function classified_maker_template_loc_single_header() {
			require_once( classified_maker_loc_plugin_dir. 'templates/location-single-header.php');
		}
	}





if ( ! function_exists( 'classified_maker_loc_template_single_ads_list' ) ) {

	
	function classified_maker_loc_template_single_ads_list() {
				
		require_once( classified_maker_loc_plugin_dir. 'templates/location-single-ads-list.php');
	}
}


if ( ! function_exists( 'classified_maker_loc_template_single_related' ) ) 
{
	function classified_maker_loc_template_single_related() 
	{
		//$job_bm_location_latlang = get_post_meta(get_the_ID(),'job_bm_location_latlang', true);
		//$job_bm_location_latlang = explode(',',$job_bm_location_latlang);
		
		//require_once( classified_maker_loc_plugin_dir .'includes/class-geoplugin.php');
		//$geoplugin = new geoPlugin();
		//$geoplugin->latitude 	= $job_bm_location_latlang[0];
		//$geoplugin->longitude 	= $job_bm_location_latlang[1];
		//$geoplugin->radius		= 100;
		//$nearby = $geoplugin->nearby(300);
		
		//if ( isset($nearby[0]['geoplugin_place']) ) {
		//	foreach ( $nearby as $key => $array ) {
		//		echo "\t Place: " . $array['geoplugin_place'] . "<br />";
		//	}
		//}

		$check = 0;
		$id = get_the_ID();
		$classified_maker_loc_country_code = get_post_meta( $id,'classified_maker_loc_country_code', true);
		
		$wp_query = new WP_Query(
			array (
				'post_type' => 'location',
				'orderby' => 'Date',
				'order' => 'DESC',
				'meta_query' => array(
					array(
						'key' => 'classified_maker_loc_country_code',
						'value' => $classified_maker_loc_country_code,
						'compare' => 'LIKE',
					),
				)
			) );
		
		$html = '';	
		$html .= '<h2 class="related-location-header">'.__('Related Location',classified_maker_loc_textdomain).'</h2>';
		$html .= '<div class="related-location-container">';
		
		if ( $wp_query->have_posts() ) :
			while ( $wp_query->have_posts() ) : $wp_query->the_post();	
		if( $id != get_the_ID() ): //$check = 1;	
			
			$html .= '<div class="single-location">';
			
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
			$thumb_url = $thumb['0'];	
			if(empty($thumb_url))  {
				
				$classified_maker_loc_display_img_from_map = get_option('classified_maker_loc_display_img_from_map');
				if ( !empty($classified_maker_loc_display_img_from_map) && $classified_maker_loc_display_img_from_map == 'yes' ) {
					
					$classified_maker_loc_latlang 	= get_post_meta(get_the_ID(),'classified_maker_loc_latlang', true);
					if ( !empty($classified_maker_loc_latlang) ) {
						$classified_maker_loc_latlang 	= explode(',',$classified_maker_loc_latlang);
						if(!empty($classified_maker_loc_latlang[0]))
							$classified_maker_loc_latlang['lat'] =$classified_maker_loc_latlang[0];
						else $classified_maker_loc_latlang['lat'] ='';
						if(!empty($classified_maker_loc_latlang[1]))
							$classified_maker_loc_latlang['lng'] =$classified_maker_loc_latlang[1];
						else $classified_maker_loc_latlang['lng'] ='';
						
						$thumb_url = 'https://maps.googleapis.com/maps/api/staticmap?center='.$classified_maker_loc_latlang['lat'].','.$classified_maker_loc_latlang['lng'].'&zoom=12&size=300x300&markers=color:red|label:C|'.$classified_maker_loc_latlang['lat'].','.$classified_maker_loc_latlang['lng'];
					} else {
						$thumb_url = classified_maker_loc_plugin_url .'assets/front/images/map.png';
					}
				
				} else {
					$thumb_url = classified_maker_loc_plugin_url .'assets/front/images/map.png';
				}
			}
			
			$html .= '<div class="thumb"><a href="'.get_the_permalink().'"><img src="'.$thumb_url.'" /></a></div>';
			$html .= '<span itemprop="name" class="name"><a href="'.get_the_permalink().'">'.get_the_title().'</a></span>';	

			$html .= '</div>'; // single location
		
		endif;
			endwhile;
		wp_reset_query();
		
		$html .= '</div>'; // location container
		endif;
		
		//if ( $check == 1 ) 
			echo $html;
	
	}
}





if ( ! function_exists( 'classified_maker_loc_template_single_css' ) ) {

	
	function classified_maker_loc_template_single_css() {
				
		require_once( classified_maker_loc_plugin_dir. 'templates/location-single-css.php');
	}
}








