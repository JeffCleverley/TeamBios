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

add_action( 'init', __NAMESPACE__ . '\register_department_heirarchical_taxonomy' );
/**
 * Register the custom taxonomy.
 *
 * @since   0.0.1
 *
 * @return  void
 */
function register_department_heirarchical_taxonomy() {

    $menu_label = __( 'Departments', 'teambios' );

    $labels = array(
		'name'              =>    _x( 'Departments', 'taxonomy general name', 'teambios' ),
		'singular_name'     =>    _x( 'Department', 'taxonomy singular name', 'teambios' ),
		'search_items'      =>    __( 'Search Departments', 'teambios' ),
		'all_items'         =>    __( 'All Departments', 'teambios' ),
		'parent_item'       =>    __( 'Parent Department', 'teambios' ),
		'parent_item_colon' =>    __( 'Parent Department:', 'teambios' ),
		'edit_item'         =>    __( 'Edit Department', 'teambios' ),
		'update_item'       =>    __( 'Update Department', 'teambios' ),
		'add_new_item'      =>    __( 'Add New Department', 'teambios' ),
		'new_item_name'     =>    __( 'New Department Name', 'teambios' ),
		'menu_name'         =>    $menu_label,
        'view_item'         =>    __( 'View Department', 'teambios' ),
	);

    $configuration_args = array(
        'label'         => $menu_label,
        'labels'        => $labels,
        'hierarchical'  => true,
        'public'        => true,
        'show_in_quick_edit'    => true,
        'show_admin_column'     => true,
    );

    register_taxonomy( 'department', array( 'team-bios', ), $configuration_args );
}

add_filter( 'genesis_post_meta', __NAMESPACE__ . '\add_department_taxonomy_to_genesis_footer_post_meta' );
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
function add_department_taxonomy_to_genesis_footer_post_meta( $post_meta ) {

    $post_meta .= sprintf(
            ' [post_terms taxonomy="department" before="%s" after="<br />"]',
            __( 'Department: ', 'teambios' )
    );

    return $post_meta;
}
