<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.nds.es
 * @since             1.0.1
 * @package           Wolfcrm_Forms_Integration_Module
 *
 * @wordpress-plugin
 * Plugin Name:       WolfCRM Forms Integration
 * Plugin URI:        https://www.wolfcrm.es/
 * Description:       Integración entre Ninja Forms y WolfCRM.
 * Permite enviar tus formularios a WolfCRM
 * Version:           1.0.1
 * Author:            Net Design Studio
 * Author URI:        https://www.nds.es
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wolfcrm-forms-integration-module
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'Wolfcrm_Forms_Integration_Module_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wolfcrm-forms-integration-module-activator.php
 */
function activate_Wolfcrm_Forms_Integration_Module() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wolfcrm-forms-integration-module-activator.php';
	Wolfcrm_Forms_Integration_Module_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wolfcrm-forms-integration-module-deactivator.php
 */
function deactivate_Wolfcrm_Forms_Integration_Module() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wolfcrm-forms-integration-module-deactivator.php';
	Wolfcrm_Forms_Integration_Module_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Wolfcrm_Forms_Integration_Module' );
register_deactivation_hook( __FILE__, 'deactivate_Wolfcrm_Forms_Integration_Module' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wolfcrm-forms-integration-module.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Wolfcrm_Forms_Integration_Module() {
	$plugin = new Wolfcrm_Forms_Integration_Module();
	$plugin->run();

}
run_Wolfcrm_Forms_Integration_Module();



/*PLUGIN WOLF*/

if (!function_exists('send_form_to_wolfcrm_contact_action') ) {
    function send_form_to_wolfcrm_contact_action($formdata) {
        global $wpdb;

		$datosEmpresa = get_option('wolf_options');
        //$method = $datosEmpresa['wolf_options_hook'];
        $origen = esc_attr($datosEmpresa['wolf_options_origen']);
		$url = esc_attr($datosEmpresa['wolf_options_edicion']);
		$clientId = esc_attr($datosEmpresa['wolf_options_clientId']);
		$secret = esc_attr($datosEmpresa['wolf_options_secret']);
        $email = esc_attr($datosEmpresa['wolf_options_email']);

        $tok = wp_remote_post($url, array(
          'method' => 'POST',
          'headers' => 'Content-Type => application/json;',
          'body' => [
              'method' => 'auth',
              'clientId' => $clientId,
              'secret' => $secret
              ]
          )
        );
        
        $token = crear_token($url,$clientId,$secret);

        $body = []; 
        $body['token'] =  $token;
        $body['method'] = 'set';
        $body['class'] = 'Contact';
        foreach($formdata['fields'] as $array){
            if ($array['key'] == "") continue;
            if (gettype($array['value']) == 'array') 
				$body[strtoupper($array['key'])] = '|'.implode('|',$array['value']).'|';
			else
            	$body[strtoupper($array['key'])] = $array['value'];
        }
        $body['SOURCE'] = $origen;

        $respuesta = wp_remote_post($url, array(
            'method' => 'POST',
            'body' => $body
            )
        );

        if($respuesta["response"]["code"] != 200 && $email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "Ha ocurrido un error:" . "\n\n";
            $msg .= "DATOS ENVIADOS" . "\n";
            $msg .= var_export($body, true) . "\n\n";
            $msg .= "RESPUESTA" . "\n";
            $msg .= var_export($respuesta, true) . "\n\n";
            wp_mail($email, "[ERROR] WolfCRM Forms Module", $msg);
        }
    }
}
add_action( 'send_form_to_wolfcrm_contact', 'send_form_to_wolfcrm_contact_action' );

if (!function_exists('send_form_to_wolfcrm_customer_action') ) {
    function send_form_to_wolfcrm_customer_action($formdata) {
        global $wpdb;

		$datosEmpresa = get_option('wolf_options');
        //$method = $datosEmpresa['wolf_options_hook'];
        $origen = esc_attr($datosEmpresa['wolf_options_origen']);
		$url = esc_attr($datosEmpresa['wolf_options_edicion']);
		$clientId = esc_attr($datosEmpresa['wolf_options_clientId']);
		$secret = esc_attr($datosEmpresa['wolf_options_secret']);
        $email = esc_attr($datosEmpresa['wolf_options_email']);

        $tok = wp_remote_post($url, array(
          'method' => 'POST',
          'headers' => 'Content-Type => application/json;',
          'body' => [
              'method' => 'auth',
              'clientId' => $clientId,
              'secret' => $secret
              ]
          )
        );
        
        $token = crear_token($url,$clientId,$secret);

        $body = []; 
        $body['token'] =  $token;
        $body['method'] = 'set';
        $body['class'] = 'Customer';
        foreach($formdata['fields'] as $array){
            if ($array['key'] == "") continue;
            if (gettype($array['value']) == 'array') 
				$body[strtoupper($array['key'])] = '|'.implode('|',$array['value']).'|';
			else
            	$body[strtoupper($array['key'])] = $array['value'];
        }
        $body['SOURCE'] = $origen;

        $respuesta = wp_remote_post($url, array(
            'method' => 'POST',
            'body' => $body
            )
        );

        if($respuesta["response"]["code"] != 200 && $email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "Ha ocurrido un error:" . "\n\n";
            $msg .= "DATOS ENVIADOS" . "\n";
            $msg .= var_export($body, true) . "\n\n";
            $msg .= "RESPUESTA" . "\n";
            $msg .= var_export($respuesta, true) . "\n\n";
            wp_mail($email, "[ERROR] WolfCRM Forms Module", $msg);
        }
    }
}
add_action( 'send_form_to_wolfcrm_customer', 'send_form_to_wolfcrm_customer_action' );

if (!function_exists('send_form_to_wolfcrm_prospect_customer_action') ) {
    function send_form_to_wolfcrm_prospect_customer_action($formdata) {
        global $wpdb;

		$datosEmpresa = get_option('wolf_options');
        //$method = $datosEmpresa['wolf_options_hook'];
        $origen = esc_attr($datosEmpresa['wolf_options_origen']);
		$url = esc_attr($datosEmpresa['wolf_options_edicion']);
		$clientId = esc_attr($datosEmpresa['wolf_options_clientId']);
		$secret = esc_attr($datosEmpresa['wolf_options_secret']);
        $email = esc_attr($datosEmpresa['wolf_options_email']);

        $token = crear_token($url,$clientId,$secret);

        $body = []; 
        $body['token'] =  $token;
        $body['method'] = 'set';
        $body['class'] = 'Customer';
        $body['TYPE'] = 'PROSPECT';
        foreach($formdata['fields'] as $array){
            if ($array['key'] == "") continue;
            if (gettype($array['value']) == 'array') 
				$body[strtoupper($array['key'])] = '|'.implode('|',$array['value']).'|';
			else
            	$body[strtoupper($array['key'])] = $array['value'];
        }
        $body['SOURCE'] = $origen;

        $respuesta = wp_remote_post($url, array(
            'method' => 'POST',
            'body' => $body
            )
        );

        if($respuesta["response"]["code"] != 200 && $email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "Ha ocurrido un error:" . "\n\n";
            $msg .= "DATOS ENVIADOS" . "\n";
            $msg .= var_export($body, true) . "\n\n";
            $msg .= "RESPUESTA" . "\n";
            $msg .= var_export($respuesta, true) . "\n\n";
            wp_mail($email, "[ERROR] WolfCRM Forms Module", $msg);
        }
    }
}
add_action( 'send_form_to_wolfcrm_prospect_customer', 'send_form_to_wolfcrm_prospect_customer_action' );

if (!function_exists('send_form_to_wolfcrm_opportunity_action') ) {
    function send_form_to_wolfcrm_opportunity_action($formdata) {
        global $wpdb;

        $datosEmpresa = get_option('wolf_options');
        //$method = $datosEmpresa['wolf_options_hook'];
        $origen = esc_attr($datosEmpresa['wolf_options_origen']);
        $url = esc_attr($datosEmpresa['wolf_options_edicion']);
        $clientId = esc_attr($datosEmpresa['wolf_options_clientId']);
        $secret = esc_attr($datosEmpresa['wolf_options_secret']);
        $email = esc_attr($datosEmpresa['wolf_options_email']);

        $token = crear_token($url,$clientId,$secret);

        $body = [];
        $body['token'] =  $token;
        $body['method'] = 'set';
        $body['class'] = 'Opportunity';
        foreach($formdata['fields'] as $array){
            if ($array['key'] == "") continue;
            if (gettype($array['value']) == 'array') 
				$body[strtoupper($array['key'])] = '|'.implode('|',$array['value']).'|';
			else
            	$body[strtoupper($array['key'])] = $array['value'];
        }
        $body['SOURCE'] = $origen;

        $respuesta = wp_remote_post($url, array(
                'method' => 'POST',
                'body' => $body
            )
        );

        if($respuesta["response"]["code"] != 200 && $email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "Ha ocurrido un error:" . "\n\n";
            $msg .= "DATOS ENVIADOS" . "\n";
            $msg .= var_export($body, true) . "\n\n";
            $msg .= "RESPUESTA" . "\n";
            $msg .= var_export($respuesta, true) . "\n\n";
            wp_mail($email, "[ERROR] WolfCRM Forms Module", $msg);
        }
    }
}
add_action( 'send_form_to_wolfcrm_opportunity', 'send_form_to_wolfcrm_opportunity_action' );

if (!function_exists('send_form_to_wolfcrm_customer_opportunity_action') ) {
    function send_form_to_wolfcrm_customer_opportunity_action($formdata) {
        global $wpdb;

        $datosEmpresa = get_option('wolf_options');
        //$method = $datosEmpresa['wolf_options_hook'];
        $origen = esc_attr($datosEmpresa['wolf_options_origen']);
        $url = esc_attr($datosEmpresa['wolf_options_edicion']);
        $clientId = esc_attr($datosEmpresa['wolf_options_clientId']);
        $secret = esc_attr($datosEmpresa['wolf_options_secret']);
        $email = esc_attr($datosEmpresa['wolf_options_email']);

        $token = crear_token($url,$clientId,$secret);

        $body = [];
        $body['token'] =  $token;
        $body['method'] = 'setCustomerOpportunity';
        $body['class'] = 'Customer';
        $body['TYPE'] = 'PROSPECT';
		
        foreach($formdata['fields'] as $array){
            if ($array['key'] == "") continue;
            if (gettype($array['value']) == 'array') 
				$body[strtoupper($array['key'])] = '|'.implode('|',$array['value']).'|';
			else
            	$body[strtoupper($array['key'])] = $array['value'];
        }
        $body['SOURCE'] = $origen;
        
        $respuesta = wp_remote_post($url, array(
                'method' => 'POST',
                'body' => $body
            )
        );

        if($respuesta["response"]["code"] != 200 && $email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "Ha ocurrido un error:" . "\n\n";
            $msg .= "DATOS ENVIADOS" . "\n";
            $msg .= var_export($body, true) . "\n\n";
            $msg .= "RESPUESTA" . "\n";
            $msg .= var_export($respuesta, true) . "\n\n";
            wp_mail($email, "[ERROR] WolfCRM Forms Module", $msg);
        }
    }
}
add_action( 'send_form_to_wolfcrm_customer_opportunity', 'send_form_to_wolfcrm_customer_opportunity_action' );

function crear_token($url,$clientId,$secret) {
    global $wpdb;
    $datosEmpresa = get_option('wolf_options');
    $email = esc_attr($datosEmpresa['wolf_options_email']);

	$tok = wp_remote_post($url, array(
        'method' => 'POST',
        'headers' => 'Content-Type => application/json;',
        'body' => [
            'method' => 'auth',
            'clientId' => $clientId,
            'secret' => $secret
            ]
        )
    );
    if ( is_wp_error( $tok ) ) {
        $error_message = $tok->get_error_message();
        $data = $error_message;
        wp_mail($email,"[ERROR TOKEN] WolfCRM Forms Wordpress", json_encode($tok));
    }else {
        $r = explode('token":"', $tok['body']);
        if (isset($r[1])){
            $r = explode('","expiresIn', $r[1]);
            $token = $r[0];
            return $token;
        }else
            return 0;
    }    
} 