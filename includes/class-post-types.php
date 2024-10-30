<?php

/*
* @Author 		pickplugins
* Copyright: 	pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_classified_maker_loc_post_types{
	
	public function __construct(){
		
		add_action( 'init', array( $this, 'classified_maker_loc_posttype_ads' ), 0 );
		
		}
	
	public function classified_maker_loc_posttype_ads(){
		if ( post_type_exists( "location" ) )
		return;

		$singular  = __( 'Location', classified_maker_loc_textdomain );
		$plural    = __( 'Locations', classified_maker_loc_textdomain );
	 
	 
		register_post_type( "location",
			apply_filters( "register_post_type_ads", array(
				'labels' => array(
					'name' 					=> $plural,
					'singular_name' 		=> $singular,
					'menu_name'             => __( $singular, classified_maker_loc_textdomain ),
					'all_items'             => sprintf( __( 'All %s', classified_maker_loc_textdomain ), $plural ),
					'add_new' 				=> __( 'Add '.$singular, classified_maker_loc_textdomain ),
					'add_new_item' 			=> sprintf( __( 'Add %s', classified_maker_loc_textdomain ), $singular ),
					'edit' 					=> __( 'Edit', classified_maker_loc_textdomain ),
					'edit_item' 			=> sprintf( __( 'Edit %s', classified_maker_loc_textdomain ), $singular ),
					'new_item' 				=> sprintf( __( 'New %s', classified_maker_loc_textdomain ), $singular ),
					'view' 					=> sprintf( __( 'View %s', classified_maker_loc_textdomain ), $singular ),
					'view_item' 			=> sprintf( __( 'View %s', classified_maker_loc_textdomain ), $singular ),
					'search_items' 			=> sprintf( __( 'Search %s', classified_maker_loc_textdomain ), $plural ),
					'not_found' 			=> sprintf( __( 'No %s found', classified_maker_loc_textdomain ), $plural ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', classified_maker_loc_textdomain ), $plural ),
					'parent' 				=> sprintf( __( 'Parent %s', classified_maker_loc_textdomain ), $singular )
				),
				'description' => sprintf( __( 'This is where you can create and manage %s.', classified_maker_loc_textdomain ), $plural ),
				'public' 				=> true,
				'show_ui' 				=> true,
				'capability_type' 		=> 'post',
				'map_meta_cap'          => true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false,
				'rewrite' 				=> true,
				'query_var' 			=> true,
				'supports' 				=> array('title','editor','custom-fields','author'),
				'show_in_menu' 			=> 'edit.php?post_type=ads',			
				'show_in_nav_menus' 	=> false,
				'menu_icon' => 'dashicons-megaphone',
			) )
		); 
	 
		}
	
	
	}
	
	new class_classified_maker_loc_post_types();