<?php
/**
 * Add a custom Elementor Display Condition for EPL Search.
 */

add_action( 'elementor/theme/register_conditions', function( $conditions_manager ) {
 
	class EPL_Search_Condition extends ElementorPro\Modules\ThemeBuilder\Conditions\Condition_Base {
	
		public static function get_type() {
			return 'archive';
		}
		
		public static function get_priority() {
			return 80;
		}
		
		public function get_name() {
			return 'epl_search';
		}
		
		public function get_label() {
			return __( 'EPL Search' );
		}
		
		public function check( $args ) {	
			return epl_is_search();
		}
	}
	
	$conditions_manager->get_condition( 'archive' )->register_sub_condition( new EPL_Search_Condition() );
 
 }, 100 );
 
/**
 * Treat EPL search like an archive for Elementor Display Conditions.
 */
function rec_epl_search_as_archive( $query ) {
	if( epl_is_search() ) {
		$query->is_archive = true;
	}
}
add_action( 'pre_get_posts', 'rec_epl_search_as_archive' );
