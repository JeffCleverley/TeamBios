<?php
/**
 * Custom Post Type functionality
 *
 * @package     Deflty\TeamBios\Custom
 * @since       0.0.1
 * @author      Jeff Cleverley
 * @link        https://github.com/JeffCleverley/TeamBios
 * @license     GNU General Public License 2.0+
 *
 * Credit 		Tonya Mork - KnowTheCode
 */
namespace Deftly\TeamBios\Custom;

add_action( 'init', __NAMESPACE__ . '\register_custom_team_bios_post_type' );
/**
 * Register the custom post type.
 *
 * @since 0.0.1
 *
 * @return void
 */
function register_custom_team_bios_post_type() {

	$labels = array(
		'singular_name'      	=> _x( 'Team Bio', 'post type singular name', 'teambios' ),
		'name_admin_bar'     	=> _x( 'Team Bio', 'add new on admin bar', 'teambios' ),
		'add_new'            	=> _x( 'Add New Team Bio', 'team-bios', 'teambios' ),
		'add_new_item'       	=> __( 'Add New', 'teambios' ),
		'new_item'           	=> __( 'New Team Bio', 'teambios' ),
		'edit_item'          	=> __( 'Edit Team Bio', 'teambios' ),
		'view_item'          	=> __( 'View Team Bio', 'teambios' ),
		'all_items'          	=> __( 'All Team Bios', 'teambios' ),
		'search_items'       	=> __( 'Search Team Bios', 'teambios' ),
		'parent_item_colon'  	=> __( 'Parent Team Bios:', 'teambios' ),
		'not_found'          	=> __( 'No Team Bios found.', 'teambios' ),
		'not_found_in_trash' 	=> __( 'No Team Bios found in Trash.', 'teambios' ),
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

	$args = array(
		'label'        		=> __( 'Team Bios', 'teambios' ),
		'labels'       		=> $labels,
		'public'       		=> true,
		'supports'     		=> $features,
		'menu_icon'    		=> 'dashicons-admin-users',
		'hierarchical' 		=> false,
		'has_archive'  		=> true,
		'menu_position'		=> 5,
		'show_in_nav_menus'	=> false,
	);

	register_post_type( 'team-bios', $args );
}
/**
 * Get all the post type features for the given post type.
 *
 * @since 0.0.1
 *
 * @param string $post_type Given post type
 * @param array $exclude_features Array of features to exclude
 *
 * @return array
 */
function get_all_post_type_features( $post_type = 'post', $excluded_features = array() ) {

	$configured_features = array_keys( get_all_post_type_supports( $post_type ) );

	if ( ! $excluded_features ) {
		return array_keys( $configured_features );
	}

	return array_diff( $configured_features, $excluded_features );
}


add_filter( 'post_updated_messages', __NAMESPACE__ . '\update_team_bios_post_type_messages' );
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
function update_team_bios_post_type_messages( $messages ) {

	$post             = get_post();
	$post_type        = get_post_type( $post );
	$post_type_object = get_post_type_object( $post_type );

	$messages['team-bios'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => __( 'Team Bio updated.', 'teambios' ),
		2  => __( 'Custom field updated.', 'teambios' ),
		3  => __( 'Custom field deleted.', 'teambios' ),
		4  => __( 'Team Bio updated.', 'teambios' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Team Bio restored to revision from %s', 'teambios' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => __( 'Team Bio published.', 'teambios' ),
		7  => __( 'Team Bio saved.', 'teambios' ),
		8  => __( 'Team Bio submitted.', 'teambios' ),
		9  => sprintf(
			__( 'Team Bio scheduled for: <strong>%1$s</strong>.', 'teambios' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i', 'teambios' ), strtotime( $post->post_date ) )
		),
		10 => __( 'Team Bio draft updated.', 'teambios' )
	);

	if ( $post_type_object->publicly_queryable && 'team-bio' === $post_type ) {
		$permalink = get_permalink( $post->ID );

		$view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View Team Bio', 'teambios' ) );
		$messages[ $post_type ][1] .= $view_link;
		$messages[ $post_type ][6] .= $view_link;
		$messages[ $post_type ][9] .= $view_link;

		$preview_permalink = add_query_arg( 'preview', 'true', $permalink );
		$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview Team Bio', 'teambios' ) );
		$messages[ $post_type ][8]  .= $preview_link;
		$messages[ $post_type ][10] .= $preview_link;
	}

	return $messages;
}


add_action('admin_head', __NAMESPACE__ . '\add_help_text_to_team_bios');
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
function add_help_text_to_team_bios() {

  	$screen = get_current_screen();

  	if ( 'team-bios' != $screen->post_type ) {
    	return;
	}

	$help_content = load_help_content();

	$args = array(
    	'id'      => 'team-bios-help', //unique id for the tab
    	'title'   => 'Team Bios Help', //unique visible title for the tab
    	'content' => $help_content,  //actual help text
  	);

	$screen->add_help_tab( $args );
}
/**
 * Function to load html content for $help_content as 'content' in add_help_tab above
 *
 * Loads html from seperate view
 *
 * @since 	0.0.1
 *
 * @return 	string 	$help_content 	HTML and Text from help view 
 */
function load_help_content() {

	include( dirname( __FILE__ ) . '/../views/custom-post-type-help-view.php' );

	return $help_content;
}
