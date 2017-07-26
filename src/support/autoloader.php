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
namespace Deftly\TeamBios\Support;

/**
 * Load all of the plugin's files.
 *
 * @since 	1.0.0
 *
 * @param 	string $src_root_dir 	Root directory for the source files
 *
 * @return 	void
 */
function autoload_files( $src_root_dir ) {

	$filenames = array(
		 'custom/custom-post-type',
		 'custom/custom-taxonomy',
	);

	foreach( $filenames as $filename ) {
		include_once( $src_root_dir . $filename . '.php' );
	}
}
