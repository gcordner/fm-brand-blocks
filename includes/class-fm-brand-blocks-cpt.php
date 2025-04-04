<?php
/**
 * Register the Brand Block Custom Post Type.
 *
 * @package Former_Model_Brand_Blocks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class FM_Brand_Blocks_CPT
 *
 * @package Former_Model_Brand_Blocks
 */
class FM_Brand_Blocks_CPT {

	/**
	 * Register the custom post type.
	 */
	public static function register_post_type() {
		$labels = array(
			'name'               => _x( 'Brand Blocks', 'Post Type General Name', 'fm-brand-blocks' ),
			'singular_name'      => _x( 'Brand Block', 'Post Type Singular Name', 'fm-brand-blocks' ),
			'menu_name'          => __( 'Brand Blocks', 'fm-brand-blocks' ),
			'name_admin_bar'     => __( 'Brand Block', 'fm-brand-blocks' ),
			'add_new'            => __( 'Add New', 'fm-brand-blocks' ),
			'add_new_item'       => __( 'Add New Brand Block', 'fm-brand-blocks' ),
			'edit_item'          => __( 'Edit Brand Block', 'fm-brand-blocks' ),
			'new_item'           => __( 'New Brand Block', 'fm-brand-blocks' ),
			'view_item'          => __( 'View Brand Block', 'fm-brand-blocks' ),
			'search_items'       => __( 'Search Brand Blocks', 'fm-brand-blocks' ),
			'not_found'          => __( 'No Brand Blocks found', 'fm-brand-blocks' ),
			'not_found_in_trash' => __( 'No Brand Blocks found in Trash', 'fm-brand-blocks' ),
		);

		$args = array(
			'label'                 => __( 'Brand Block', 'fm-brand-blocks' ),
			'labels'                => $labels,
			'public'                => true,
			'publicly_queryable'    => true,
			'exclude_from_search'   => true,
			'show_in_nav_menus'     => false,
			'rewrite'               => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'show_in_rest'          => true,
			'rest_base'             => 'brand-blocks',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'capability_type'       => 'post',
			'has_archive'           => false,
			'hierarchical'          => false,
			'menu_position'         => 21,
			'menu_icon'             => 'dashicons-editor-kitchensink',
			'supports'              => array( 'title', 'editor' ),
		);

		register_post_type( 'brand_block', $args );
	}
}
