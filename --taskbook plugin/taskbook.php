<?php
/*
Plugin Name: Task Book
Plugin URI:  https://linkedin.com/ldaliazarzour
Description: Track stress and anxiety levels around tasks.
Version:     0.0.1
Author:      Dalia Zarzour
Text Domain: taskbook
Domain Path: /languages
License:     GPL3
*/

/* Register post type  */

require_once plugin_dir_path(__FILE__). 'includes/posttypes.php';
register_activation_hook(__FILE__, 'taskbook_rewite_flush');


/*Register taskbook role */
require_once plugin_dir_path(__FILE__) .'includes/roles.php';
register_activation_hook(__FILE__, 'taskbook_register_role');
register_deactivation_hook(__FILE__, 'taskbook_remove_role');

/*Register capabilities */
register_activation_hook(__FILE__, 'taskbook_add_capabilities');
register_deactivation_hook(__FILE__, 'taskbook_remove_capabilities');


/**
 *include status
 */
require_once plugin_dir_path(__FILE__).'includes/status.php';

/** 
 * Add in cmb2 for fun new fields
 */
require_once plugin_dir_path(__FILE__).'includes/CMB2-functions.php';


/**
 * Grant  task access  for index pages for certain users.
 */

 add_action('pre_get_posts', 'taskbook_grant_access');

 function taskbook_grant_access( $query ) {
     // Make sure the query contains a post_type query_var,
	// otherwise it's definitely not a request for Task(s):
     if ( isset($query->query_vars['post_type']) ) {    
       // Check if the request is for the Task post type…
        if ( $query->query_vars['post_type'] == 'task' ) {   
            // … and that this is a REST request:
            if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
                if ( current_user_can( 'editor' ) || current_user_can( 'administrator') ) {
					// If so, Editors and Administrators see all private tasks…
                    $query->set( 'post_status','private');
                }elseif(current_user_can('task_logger')){
                    $query->set('post_status','private');
                    $query->set('author',get_current_user_id());
                }



            }
        }

     }

 }