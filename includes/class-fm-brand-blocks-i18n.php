<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://former-model.com
 * @since      1.0.0
 *
 * @package    Fm_Brand_Blocks
 * @subpackage Fm_Brand_Blocks/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Fm_Brand_Blocks
 * @subpackage Fm_Brand_Blocks/includes
 * @author     Geoff Cordner <geoffcordner@former-model.com>
 */
class Fm_Brand_Blocks_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'fm-brand-blocks',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
