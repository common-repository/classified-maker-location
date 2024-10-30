<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


	$classified_maker_loc_map_type		= get_option('classified_maker_loc_map_type');
	$classified_maker_loc_map_zoom 		= get_option('classified_maker_loc_map_zoom');	
	$classified_maker_loc_api_key 		= get_option('classified_maker_loc_api_key');	

	$classified_maker_loc_country_code 	= get_post_meta(get_the_ID(),'classified_maker_loc_country_code', true);	
	$classified_maker_loc_latlang 		= get_post_meta(get_the_ID(),'classified_maker_loc_latlang', true);
	$location_post_data 				= get_post(get_the_ID());
	
	if ( !empty($classified_maker_loc_latlang) ) {
		
		$classified_maker_loc_latlang = explode(',',$classified_maker_loc_latlang);
		if(!empty($classified_maker_loc_latlang[0]))
			$classified_maker_loc_latlang['lat'] =$classified_maker_loc_latlang[0];
		else $classified_maker_loc_latlang['lat'] ='';
		
		if(!empty($classified_maker_loc_latlang[1]))
			$classified_maker_loc_latlang['lng'] =$classified_maker_loc_latlang[1];
		else $classified_maker_loc_latlang['lng'] ='';
			
		if(empty($classified_maker_loc_map_type)) $classified_maker_loc_map_type = 'dynamic';
		
		if($classified_maker_loc_map_type=='dynamic')
		{
			echo '<div class="map-container"><div id="map"></div></div>';
			echo '
			<script>
				function initMap() {
					
					var myLatLng = {lat: '.$classified_maker_loc_latlang['lat'].', lng: '.$classified_maker_loc_latlang['lng'].'};
					var map = new google.maps.Map(document.getElementById("map"), {
						zoom: '.$classified_maker_loc_map_zoom.',
						center: myLatLng,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					});
					var marker = new google.maps.Marker({
						position: myLatLng,
						map: map,
						draggable: false,
						raiseOnDrag: true,
						labelContent: "ABCD",
						labelAnchor: new google.maps.Point(15, 65),
						labelClass: "labels", // the CSS class for the label
						labelInBackground: true,
						title: "'.get_the_title().'"
					});
					
					var infowindow = new google.maps.InfoWindow({
						content: "'.get_the_title().'"
					});

					//google.maps.event.addListener(marker, "click", function() {
						infowindow.open(map,marker);
					//});						
				}
			</script>';
			
			if( !empty($classified_maker_loc_api_key))
				echo '<script async defer src="https://maps.googleapis.com/maps/api/js?key='.$classified_maker_loc_api_key.'&signed_in=true&callback=initMap"></script>';
			else echo '<script async defer src="https://maps.googleapis.com/maps/api/js?signed_in=true&callback=initMap"></script>';
		
		}
		elseif($classified_maker_loc_map_type=='static'){
			echo '<div class="map-container"><div id="map"><img  src="https://maps.googleapis.com/maps/api/staticmap?center='.$classified_maker_loc_latlang['lat'].','.$classified_maker_loc_latlang['lng'].'&zoom='.$classified_maker_loc_map_zoom.'&size=1024x300&markers=color:red|label:C|'.$classified_maker_loc_latlang['lat'].','.$classified_maker_loc_latlang['lng'].'"/></div></div>';
		}
		elseif($classified_maker_loc_map_type=='none'){
			echo '';
		}
		else{}
	}
	echo '<div class="logo"><img src="'.classified_maker_loc_plugin_url.'assets/front/images/map.png" /></div>';
	
	
	$class_classified_maker_functions = new class_classified_maker_functions();
	$classified_maker_loc_country_list = $class_classified_maker_functions->country_list();
	

	echo '<h1 itemprop="name" class="name">'.$location_post_data->post_title;
	if(!empty($classified_maker_loc_country_list[$classified_maker_loc_country_code])){
		echo '<span class="country">'.$classified_maker_loc_country_list[$classified_maker_loc_country_code].'</span>';
	}
	echo '</h1>';		

	$location_content = $location_post_data->post_content;
	if( empty($location_content) ) {
		
		$classified_maker_loc_display_wiki_content = get_option('classified_maker_loc_display_wiki_content');

		if(!empty($classified_maker_loc_display_wiki_content) && $classified_maker_loc_display_wiki_content=='yes'){
			
			$content = curl_get_contents('https://en.wikipedia.org/w/api.php?action=query&prop=extracts&format=json&exintro=&titles='.str_replace(' ','_',$location_post_data->post_title));
			$wiki_content_json = json_decode($content,true);
			foreach($wiki_content_json['query'] as $query){
				foreach($query as $normalized){
					$page_content = $normalized['extract'];
				}
			}
			echo '<div class="description"><strong>'.__('Source:',classified_maker_loc_textdomain).' wikipedia.org</strong><br/>'.$page_content.'</div>';	
		}
		else echo '<div class="description"></div>';	

	} else echo '<div class="description">'.wpautop($location_content).'</div>';	
	
	