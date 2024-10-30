<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

		get_header();

		do_action('classified_maker_action_before_loc_single');

		while ( have_posts() ) : the_post(); 
		?>
        <div itemscope itemtype="http://schema.org/Place" id="location-single-<?php the_ID(); ?>" <?php post_class('location-single entry-content'); ?>>
        <?php
			do_action('classified_maker_action_loc_single_main');
		?>
        </div>
		<?php
		endwhile;
        do_action('classified_maker_action_after_loc_single');

		get_footer();
		
