<?php
/**
 * Custom Taxonomy functionality
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

add_action( 'init', __NAMESPACE__ . '\register_territory_non_heirarchical_taxonomy' );
/**
 * Register the custom taxonomy.
 *
 * @since   0.0.1
 *
 * @return  void
 */
function register_territory_non_heirarchical_taxonomy() {

    $labels = array(
		'name'              => _x( 'Territories', 'taxonomy general name', 'teambios' ),
		'singular_name'     => _x( 'Territory', 'taxonomy singular name', 'teambios' ),
		'search_items'      => __( 'Search Territories', 'teambios' ),
		'all_items'         => __( 'All Territories', 'teambios' ),
		'edit_item'         => __( 'Edit Territory', 'teambios' ),
		'update_item'       => __( 'Update Territory', 'teambios' ),
		'add_new_item'      => __( 'Add New Territory', 'teambios' ),
		'new_item_name'     => __( 'New Territory Name', 'teambios' ),
		'menu_name'         => __( 'Territories', 'teambios' ),
        'popular_items'     => __( 'Most Common Territories', 'teambios' ),
        'choose_from_most_used' =>  __( 'Choose from the most common territories', 'teambios' ),
        'add_or_remove_items'   => __( 'Add or remove territories', 'teambios' ),
        'parent_item'           => null,
		'parent_item_colon'     => null,
        'separate_items_with_commas' => __( 'Separate territories with commas', 'teambios' ),
        'not_found'         => __( 'No territories found.', 'teambios' ),
		'menu_name'         => __( 'Territories', 'teambios' ),
        'view_item'         => __( 'View Territory', 'teambios' ),
	);

    $configuration_args = array(
        'label'         =>  __( 'Territory', 'teambios' ),
        'labels'        => $labels,
        'hierarchical'  => false,
        'public'        => true,
        'show_in_quick_edit'    => true,
        'show_admin_column'     => true,
        'show_tagcloud'         => true,
    );

    register_taxonomy( 'territory', array( 'team-bios', ), $configuration_args );
}

add_filter( 'genesis_post_meta', __NAMESPACE__ . '\add_territory_taxonomy_to_genesis_footer_post_meta' );
/**
 * Filter the Genesis Footer Entry Post meta
 * to add the post terms for our custom taxonomy
 *
 * @since   0.0.1
 *
 * @param   string  $post_meta  default "[post_categories] [post_tags]".
 *
 * @return  string              default with custom taxonomies concatenated on in shortcode form.
 */
function add_territory_taxonomy_to_genesis_footer_post_meta( $post_meta ) {

    $post_meta .= sprintf(
            ' [post_terms taxonomy="territory" before="%s" after="<br />"]',
            __( 'Territory: ', 'teambios' )
    );

    return $post_meta;
}
