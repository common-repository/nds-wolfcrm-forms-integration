<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.nds.es
 * @since      1.0.0
 *
 * @package    Wolfcrm_Forms_Integration_Module
 * @subpackage Wolfcrm_Forms_Integration_Module/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wolfcrm_Forms_Integration_Module
 * @subpackage Wolfcrm_Forms_Integration_Module/includes
 * @author     Net Design Studio <info@nds.es>
 */
class Wolfcrm_Forms_Integration_Module_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wolfcrm-forms-integration-module',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
