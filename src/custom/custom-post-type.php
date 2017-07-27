<?php
/**
 * Custom Post Type functionality
 *
 * @package     Deftly\TeamBios\Custom
 * @since       0.0.1
 * @author      Jeff Cleverley
 * @link        https://github.com/JeffCleverley/TeamBios
 * @license     GNU General Public License 2.0+
 *
 * Credit 		Tonya Mork - KnowTheCode
 */
namespace Deftly\TeamBios\Custom;

add_action( 'init', __NAMESPACE__ . '\register_custom_post_type' );
/**
 * Register the custom post type.
 *
 * @since 	0.0.1
 *
 * @return 	void
 */
function register_custom_post_type() {

	$custom_post_type_singular = 'Team Bio';
	$custom_post_type_plural = 'Team Bios';
	$custom_post_type_slug = 'team-bios';

	$labels = array(
		'singular_name'      	=> _x( $custom_post_type_singular, 'post type singular name', 'teambios' ),
		'name_admin_bar'     	=> _x( $custom_post_type_singular, 'add new on admin bar', 'teambios' ),
		'add_new'            	=> _x( 'Add New ' . $custom_post_type_singular, 'team-bios', 'teambios' ),
		'add_new_item'       	=> __( 'Add New', 'teambios' ),
		'new_item'           	=> __( 'New ' . $custom_post_type_singular, 'teambios' ),
		'edit_item'          	=> __( 'Edit ' . $custom_post_type_singular, 'teambios' ),
		'view_item'          	=> __( 'View ' . $custom_post_type_singular, 'teambios' ),
		'all_items'          	=> __( 'All ' . $custom_post_type_plural, 'teambios' ),
		'search_items'       	=> __( 'Search ' . $custom_post_type_plural, 'teambios' ),
		'parent_item_colon'  	=> __( 'Parent ' .  $custom_post_type_plural . ':', 'teambios' ),
		'not_found'          	=> __( 'No ' . $custom_post_type_plural . ' found.', 'teambios' ),
		'not_found_in_trash' 	=> __( 'No ' . $custom_post_type_plural . ' found in Trash.', 'teambios' ),
		'featured_image'        => __( 'Profile Image', 'teambios' ),
		'set_featured_image'    => __( 'Set Profile Image', 'teambios' ),
		'remove_featured_image' => __( 'Remove Profile Image', 'teambios' ),
		'use_featured_image'    => __( 'Use Profile Image', 'teambios' ),
	);

	$features = get_all_post_type_features( 'post', array(
		'excerpt',
		'comments',
		'trackbacks',
	) );

	$configuration_args = array(
		'label'        		=> __( $custom_post_type_plural, 'teambios' ),
		'labels'       		=> $labels,
		'public'       		=> true,
		'supports'     		=> $features,
		'menu_icon'    		=> 'dashicons-admin-users',
		'hierarchical' 		=> false,
		'has_archive'  		=> true,
		'menu_position'		=> 5,
		'show_in_nav_menus'	=> false,
	);

	register_post_type( $custom_post_type_slug, $configuration_args );

	unset( $custom_post_type_singular );
	unset( $custom_post_type_plural );
	unset( $custom_post_type_slug );

	$custom_post_type_singular = 'Team Member';
	$custom_post_type_plural = 'Team Members';
	$custom_post_type_slug = 'team-member';

	$labels = array(
		'singular_name'      	=> _x( $custom_post_type_singular, 'post type singular name', 'teambios' ),
		'name_admin_bar'     	=> _x( $custom_post_type_singular, 'add new on admin bar', 'teambios' ),
		'add_new'            	=> _x( 'Add New ' . $custom_post_type_singular, 'team-bios', 'teambios' ),
		'add_new_item'       	=> __( 'Add New', 'teambios' ),
		'new_item'           	=> __( 'New ' . $custom_post_type_singular, 'teambios' ),
		'edit_item'          	=> __( 'Edit ' . $custom_post_type_singular, 'teambios' ),
		'view_item'          	=> __( 'View ' . $custom_post_type_singular, 'teambios' ),
		'all_items'          	=> __( 'All ' . $custom_post_type_plural, 'teambios' ),
		'search_items'       	=> __( 'Search ' . $custom_post_type_plural, 'teambios' ),
		'parent_item_colon'  	=> __( 'Parent ' .  $custom_post_type_plural . ':', 'teambios' ),
		'not_found'          	=> __( 'No ' . $custom_post_type_plural . ' found.', 'teambios' ),
		'not_found_in_trash' 	=> __( 'No ' . $custom_post_type_plural . ' found in Trash.', 'teambios' ),
		'featured_image'        => __( 'Profile Image', 'teambios' ),
		'set_featured_image'    => __( 'Set Profile Image', 'teambios' ),
		'remove_featured_image' => __( 'Remove Profile Image', 'teambios' ),
		'use_featured_image'    => __( 'Use Profile Image', 'teambios' ),
	);

	$features = get_all_post_type_features( 'post', array(
		'excerpt',
		'comments',
		'trackbacks',
	) );

	$configuration_args = array(
		'label'        		=> __( $custom_post_type_plural, 'teambios' ),
		'labels'       		=> $labels,
		'public'       		=> true,
		'supports'     		=> $features,
		'menu_icon'    		=> 'dashicons-businessman',
		'hierarchical' 		=> false,
		'has_archive'  		=> true,
		'menu_position'		=> 5,
		'show_in_nav_menus'	=> false,
	);

	register_post_type( $custom_post_type_slug, $configuration_args );

}
/**
 * Get all the post type features for the given post type.
 *
 * @since 	0.0.1
 *
 * @param 	string 	$post_type 			Given post type
 * @param 	array 	$exclude_features 	Array of features to exclude
 *
 * @return 	array
 */
function get_all_post_type_features( $post_type = 'post', $excluded_features = array() ) {

	$configured_features = array_keys( get_all_post_type_supports( $post_type ) );

	if ( ! $excluded_features ) {
		return $configured_features;
	}

	return array_diff( $configured_features, $excluded_features );
}

add_filter( 'post_updated_messages', __NAMESPACE__ . '\update_custom_post_type_messages' );
/**
 * Update team-bio post type messages.
 *
 * See /wp-admin/edit-form-advanced.php
 *
 * @since 	0.0.1
 *
 * @param 	array 	$messages Existing post update messages.
 *
 * @return 	array 	Amended post update messages with new CPT update messages.
 */
function update_custom_post_type_messages( $messages ) {

	$post             = get_post();
	$post_type        = get_post_type( $post );
	$post_type_object = get_post_type_object( $post_type );

	$custom_post_type_singular = 'Team Bio';
	$custom_post_type_slug = 'team-bios';

	$messages[ $custom_post_type_slug ] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => __( $custom_post_type_singular . ' updated.', 'teambios' ),
		2  => __( 'Custom field updated.', 'teambios' ),
		3  => __( 'Custom field deleted.', 'teambios' ),
		4  => __( $custom_post_type_singular . ' updated.', 'teambios' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( $custom_post_type_singular . ' restored to revision from %s', 'teambios' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => __( $custom_post_type_singular . ' published.', 'teambios' ),
		7  => __( $custom_post_type_singular . ' saved.', 'teambios' ),
		8  => __( $custom_post_type_singular . ' submitted.', 'teambios' ),
		9  => sprintf(
			__( $custom_post_type_singular . ' scheduled for: <strong>%1$s</strong>.', 'teambios' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i', 'teambios' ), strtotime( $post->post_date ) )
		),
		10 => __( $custom_post_type_singular . ' draft updated.', 'teambios' )
	);

	if ( $post_type_object->publicly_queryable && 'team-bio' === $post_type ) {

		$permalink = get_permalink( $post->ID );
		$view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View ' . $custom_post_type_singular, 'teambios' ) );
		$messages[ $post_type ][1] .= $view_link;
		$messages[ $post_type ][6] .= $view_link;
		$messages[ $post_type ][9] .= $view_link;

		$preview_permalink = add_query_arg( 'preview', 'true', $permalink );
		$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview ' . $custom_post_type_singular, 'teambios' ) );
		$messages[ $post_type ][8]  .= $preview_link;
		$messages[ $post_type ][10] .= $preview_link;

	}

	unset( $custom_post_type_singular );
	unset( $custom_post_type_slug );

	$custom_post_type_singular = 'Team Member';
	$custom_post_type_slug = 'team-member';

	$messages[ $custom_post_type_slug ] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => __( $custom_post_type_singular . ' updated.', 'teambios' ),
		2  => __( 'Custom field updated.', 'teambios' ),
		3  => __( 'Custom field deleted.', 'teambios' ),
		4  => __( $custom_post_type_singular . ' updated.', 'teambios' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( $custom_post_type_singular . ' restored to revision from %s', 'teambios' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => __( $custom_post_type_singular . ' published.', 'teambios' ),
		7  => __( $custom_post_type_singular . ' saved.', 'teambios' ),
		8  => __( $custom_post_type_singular . ' submitted.', 'teambios' ),
		9  => sprintf(
			__( $custom_post_type_singular . ' scheduled for: <strong>%1$s</strong>.', 'teambios' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i', 'teambios' ), strtotime( $post->post_date ) )
		),
		10 => __( $custom_post_type_singular . ' draft updated.', 'teambios' )
	);

	if ( $post_type_object->publicly_queryable && 'team-bio' === $post_type ) {

		$permalink = get_permalink( $post->ID );
		$view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View ' . $custom_post_type_singular, 'teambios' ) );
		$messages[ $post_type ][1] .= $view_link;
		$messages[ $post_type ][6] .= $view_link;
		$messages[ $post_type ][9] .= $view_link;

		$preview_permalink = add_query_arg( 'preview', 'true', $permalink );
		$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview ' . $custom_post_type_singular, 'teambios' ) );
		$messages[ $post_type ][8]  .= $preview_link;
		$messages[ $post_type ][10] .= $preview_link;

	}

	return $messages;
}


add_action('admin_head', __NAMESPACE__ . '\add_help_text_to_custom_post_type');
/**
 * Add help tab for team bios custom post type
 *
 * Using add_help_tab method from WP_Screen comment_class
 * https://codex.wordpress.org/Class_Reference/WP_Screen/add_help_tab
 *
 * @since 	0.0.1
 *
 * @return 	void
 */
function add_help_text_to_custom_post_type() {

  	$screen = get_current_screen();

  	if ( 'team-bios' != $screen->post_type && 'team-member' != $screen->post_type ) {
    	return;
	}

	if ( 'team-bios' == $screen->post_type ) {

		$help_content = load_help_content();

		$configuration_content = array(
	    	'id'      => 'team-bios-help', //unique id for the tab
	    	'title'   => 'Team Bios Help', //unique visible title for the tab
	    	'content' => $help_content,  //actual help text
	  	);

		$screen->add_help_tab( $configuration_content );
	}

	if ( 'team-member' == $screen->post_type ) {

		$help_content = load_help_content();

		$configuration_content = array(
	    	'id'      => 'team-member-help', //unique id for the tab
	    	'title'   => 'Team Member Help', //unique visible title for the tab
	    	'content' => $help_content,  //actual help text
	  	);

		$screen->add_help_tab( $configuration_content );
	}
}
/**
 * Function to load view into $configuration_content array as 'content' ^
 *
 * Loads html from seperate view
 *
 * @since 	0.0.1
 *
 * @return 	string 	$help_content 	HTML and Text from help view
 */
function load_help_content() {

	$screen = get_current_screen();

	if ( 'team-bios' == $screen->post_type ) {

		include( dirname( __FILE__ ) . '/../views/custom-post-type-team-bio-help-view.php' );

		return $help_content;

	}

	if ( 'team-member' == $screen->post_type ) {

		include( dirname( __FILE__ ) . '/../views/custom-post-type-team-member-help-view.php' );

		return $help_content;
	}


}
