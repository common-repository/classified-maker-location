<?php
/*
Plugin Name: Classified Maker - Location
Plugin URI: http://pickplugins.com
Description: Awesome Classified Maker.
Version: 1.0.1
Author: projectW
Author URI: http://pickplugins.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class ClassifiedMakerLoc{
	
	public function __construct(){
	
	define('classified_maker_loc_plugin_url', plugins_url('/', __FILE__)  );
	define('classified_maker_loc_plugin_dir', plugin_dir_path( __FILE__ ) );
	define('classified_maker_loc_wp_url', 'https://wordpress.org/plugins/classified-maker/' );
	define('classified_maker_loc_wp_reviews', 'http://wordpress.org/support/view/plugin-reviews/classified-maker' );
	define('classified_maker_loc_pro_url','http://www.pickplugins.com/item/classified-maker/' );
	define('classified_maker_loc_demo_url', 'http://www.pickplugins.com/demo/classified-maker/' );
	define('classified_maker_loc_conatct_url', 'http://www.pickplugins.com/contact/' );
	define('classified_maker_loc_qa_url', 'http://www.pickplugins.com/questions/' );
	define('classified_maker_loc_plugin_name', 'Classified Maker - Location' );
	define('classified_maker_loc_plugin_version', '1.0.1' );
	define('classified_maker_loc_customer_type', 'free' );	 
	define('classified_maker_loc_share_url', '' );
	define('classified_maker_loc_tutorial_video_url', '' );
	define('classified_maker_loc_textdomain', 'classified_maker_loc' );
	
	
	// Class
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-post-types.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-post-meta.php');		
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-functions.php');
	//require_once( plugin_dir_path( __FILE__ ) . 'includes/class-shortcodes.php');
	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/shortcodes-ads-count-lcoaiton.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/shortcodes-ads-map.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/shortcodes-new-location.php');	
	
	
	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/notice/notice.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/functions.php');
	require_once( plugin_dir_path( __FILE__ ) . 'templates/single-location-functions.php');
	
	require_once( plugin_dir_path( __FILE__ ) . 'templates/new-location-hook.php');	
	
	add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
	add_action( 'wp_enqueue_scripts', array( $this, 'classified_maker_loc_front_scripts' ) );
	add_action( 'admin_enqueue_scripts', array( $this, 'classified_maker_loc_admin_scripts' ) );
	add_action( 'plugins_loaded', array( $this, 'classified_maker_loc_load_textdomain' ));
	
	//Redirect to welcome page
	add_action( 'activated_plugin', array( $this, 'classified_maker_loc_redirect_welcome' ));	
	add_action( 'admin_head', array( $this, 'classified_maker_loc_remove_welcome_menu' ));	

	
	register_activation_hook( __FILE__, array( $this, 'classified_maker_loc_activation' ) );


	add_filter( 'widget_text', 'do_shortcode', 11);


	}
	
	public function classified_maker_loc_load_textdomain() {
		load_plugin_textdomain( 'classified_maker', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' ); 
	}
	
	public function classified_maker_loc_activation(){
		do_action( 'classified_maker_loc_action_install' );
	}		
		
		
		
	public function classified_maker_loc_redirect_welcome($plugin){
		
		$classified_maker_loc_welcome_done = get_option('classified_maker_loc_welcome_done');
		if($classified_maker_loc_welcome_done != true){
				if($plugin=='classified-maker/classified-maker.php') {
					 wp_redirect(admin_url('edit.php?post_type=ads&page=welcome'));
					 die();
				}
			}
		}		
		
	public function classified_maker_loc_remove_welcome_menu(){
		remove_submenu_page( 'edit.php?post_type=ads', 'welcome' );
	}
		
		
		
	public function classified_maker_loc_front_scripts(){
		
		wp_enqueue_script('jquery');
		//wp_enqueue_script('jquery-ui-sortable');
		
		wp_enqueue_script('classified_maker_loc_front_js', plugins_url( '/assets/front/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script( 'classified_maker_loc_front_js', 'classified_maker_loc_ajax', array( 'classified_maker_loc_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		wp_enqueue_script( 'maps.google.js', 'http://maps.googleapis.com/maps/api/js');
		
		//wp_enqueue_script('classified_maker_loc_front_scripts-form', plugins_url( '/assets/front/js/scripts-form.js' , __FILE__ ) , array( 'jquery' ));		
		
		//wp_enqueue_style('jquery-ui', classified_maker_loc_plugin_url.'assets/front/css/jquery-ui.css');		
		
		

		wp_enqueue_script('classified_maker_loc_autocomplete', plugins_url( '/assets/front/js/jquery.autocomplete.min.js' , __FILE__ ) , array( 'jquery' ));
		
		wp_enqueue_style('classified_maker_loc_style', classified_maker_loc_plugin_url.'assets/front/css/style.css');
		wp_enqueue_style('classified_maker_loc_single', classified_maker_loc_plugin_url.'assets/front/css/location-single.css');
		wp_enqueue_style('classified_maker_loc_location-new', classified_maker_loc_plugin_url.'assets/front/css/location-new.css');					
		wp_enqueue_style('classified_maker_loc_ads-count-lcoaiton', classified_maker_loc_plugin_url.'assets/front/css/ads-count-lcoaiton.css');				
			
			
			
		//wp_enqueue_script('owl.carousel', plugins_url( '/assets/front/js/owl.carousel.js' , __FILE__ ) , array( 'jquery' ));			
		//wp_enqueue_style('owl.carousel', classified_maker_loc_plugin_url.'assets/front/css/owl.carousel.css');			
		//wp_enqueue_style('owl.theme', classified_maker_loc_plugin_url.'assets/front/css/owl.theme.css');				
			
		//wp_enqueue_style('font-awesome', classified_maker_loc_plugin_url.'assets/global/css/font-awesome.css');
		
		
		

		//wp_enqueue_script('plupload-handlers');
		//wp_enqueue_script('classified_maker_loc_file_uploader', plugins_url( '/assets/front/js/ajax-upload.js' , __FILE__ ) , array( 'jquery' ));		
		
		
       // wp_localize_script();
		
		//wp_localize_script( 'classified_maker_loc_front_js', 'classified_maker_loc_ajax', array( 'classified_maker_loc_ajaxurl' => admin_url( 'admin-ajax.php')));
		

/*

		$translation_array = array( 'some_string' => __( 'Some string to translate' ), 'a_value' => '10' );
		wp_localize_script( 'some_handle', 'object_name', $translation_array );
		
		// http://wordpress.stackexchange.com/questions/162415/how-do-i-translate-string-inside-jquery-script-with-wpml
*/


		
		}

	public function classified_maker_loc_admin_scripts(){
		
		//wp_enqueue_script('jquery');
		//wp_enqueue_script('jquery-ui-core');
		//wp_enqueue_script('jquery-ui-sortable');
		
		//wp_enqueue_script('classified_maker_loc_admin_js', plugins_url( '/assets/admin/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		//wp_localize_script( 'classified_maker_loc_admin_js', 'classified_maker_loc_ajax', array( 'classified_maker_loc_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		//wp_enqueue_style('classified_maker_loc_admin_style', classified_maker_loc_plugin_url.'assets/admin/css/style.css');
		
		//wp_enqueue_script('classified_maker_loc_PickAdmin', plugins_url( '/assets/admin/PickAdmin/scripts.js' , __FILE__ ) , array( 'jquery' ));		
		//wp_enqueue_style('classified_maker_loc_PickAdmin', classified_maker_loc_plugin_url.'assets/admin/PickAdmin/style.css');
		//wp_enqueue_style('font-awesome', classified_maker_loc_plugin_url.'assets/global/css/font-awesome.css');
		
		//wp_enqueue_style( 'wp-color-picker' );
	//	wp_enqueue_script( 'classified_maker_loc_color_picker', plugins_url('/assets/admin/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
		
		}
	
	
	
	
	}

new ClassifiedMakerLoc();