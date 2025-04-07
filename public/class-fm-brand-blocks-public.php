<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://former-model.com
 * @since      1.0.0
 *
 * @package    Fm_Brand_Blocks
 * @subpackage Fm_Brand_Blocks/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Fm_Brand_Blocks
 * @subpackage Fm_Brand_Blocks/public
 * @author     Geoff Cordner <geoffcordner@former-model.com>
 */
class Fm_Brand_Blocks_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Fm_Brand_Blocks_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Fm_Brand_Blocks_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/fm-brand-blocks-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Fm_Brand_Blocks_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Fm_Brand_Blocks_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/fm-brand-blocks-public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Maybe output the brand block content on the brand archive page.
	 *
	 * @return void
	 */
	public function maybe_output_brand_block() {
		$current_term = get_queried_object();

		if (
			! is_tax( 'product_brand' ) ||
			! $current_term instanceof WP_Term
		) {
			return;
		}

		$associated_block_id = get_term_meta( $current_term->term_id, 'associated_brand_block_id', true );
		$brand_block_post    = $associated_block_id ? get_post( $associated_block_id ) : null;

		if ( $brand_block_post && 'publish' === $brand_block_post->post_status ) {
			echo '<div class="archive-description entry-content">';
			echo wp_kses_post( apply_filters( 'the_content', $brand_block_post->post_content ) );
			echo '</div>';
			return;
		}

		// Fallback to term description if no Brand Block is available.
		if ( ! empty( $current_term->description ) ) {
			echo '<div class="archive-description entry-content">';
			echo wp_kses_post( apply_filters( 'the_content', wp_kses_post( $current_term->description ) ) );
			echo '</div>';
		}
	}


	/**
	 * Override WooCommerce's default archive description with our Brand Block.
	 *
	 * @return void
	 */
	public function override_archive_description() {
		remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
		add_action( 'woocommerce_archive_description', array( $this, 'maybe_output_brand_block' ), 10 );
	}
}
