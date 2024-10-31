<?php
 // check user capabilities

function wolf_settings_init() {
	 register_setting( 'wolf', 'wolf_options');

     add_settings_section(
        'wolf_section_shortcode',
        'DATOS DEL SERVICIO WEB DE WOLFCRM',
        'wolf_options_shortcode_section_callback',
        'wolf'
     );

     /*add_settings_section(
        'wolf_options_hook',
        'Hook al que queremos llamar',
        'wolf_options_select_field_callback',
        'wolf',
        array('label_for' => 'wolf_options_hook')
     );*/
     
     add_settings_section(
        'wolf_options_origen',
        'Origen',
        'wolf_options_input_text_field_callback',
        'wolf',
        array('label_for' => 'wolf_options_origen')
     );

    add_settings_section(
        'wolf_options_edicion',
        'URL',
        'wolf_options_input_text_field_callback',
        'wolf',
        array('label_for' => 'wolf_options_edicion')
    );

    add_settings_section(
        'wolf_options_secret',
        'Secret',
        'wolf_options_input_text_field_callback',
        'wolf',
        array('label_for' => 'wolf_options_secret')
    );

    add_settings_section(
        'wolf_options_clientId',
        'Client Id',
        'wolf_options_input_text_field_callback',
        'wolf',
        array('label_for' => 'wolf_options_clientId')
    );

    add_settings_section(
        'wolf_options_email',
        'Email para notificar errores',
        'wolf_options_input_text_field_callback',
        'wolf',
        array('label_for' => 'wolf_options_email')
    );
    
}
add_action( 'admin_init', 'wolf_settings_init' );

function wolf_options_shortcode_section_callback( $args ) {
    echo "Configure aquí los datos del servicio web de WolfCRM. Si no los tiene, contacte con el personal de WolfCRM para obtenerlos.";
}

function wolf_options_input_text_field_callback( $args ) {
    
    // get the value of the setting we've registered with register_setting()
    $options = get_option('wolf_options');
    $default = isset($options[$args['id']]) && !empty($options[$args['id']]) ? $options[$args['id']] : '';
    // output the field
    echo  "<input type='text' id='".esc_attr( $args['id'])."' name='wolf_options[".esc_attr( $args['id'] )."]' value='".esc_attr($default)."' style='width:550px;'>";

}

/*function wolf_options_select_field_callback( $args ) {
    
    // get the value of the setting we've registered with register_setting()
    $options = get_option('wolf_options');
    $default = isset($options[$args['label_for']]) && !empty($options[$args['label_for']]) ? $options[$args['label_for']] : '';
    // output the field
    echo "<select id='".esc_attr( $args['label_for'])."' name='wolf_options[".esc_attr( $args['label_for'] )."]' style='width:550px;'>";
        echo "<option value=''></option>";
        if ($default == 'auth') $selected = 'selected'; else $selected = '';
            echo "<option value='auth' $selected>Contacto</option>";
        if ($default == 'prueba') $selected = 'selected'; else $selected = '';
            echo "<option value='prueba' $selected>Prueba</option>";  
    echo "</select>";
}*/

function wolf_admin_configuracion() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // add error/update messages

    // check if the user have submitted the settings
    // wordpress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'wporg_messages', 'wolf_message', __( 'Opciones guardadas correctamente', 'wporg' ), 'updated' );
    }

    // show error/update messages
    settings_errors( 'wolf_messages' );
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "wporg"
            settings_fields( 'wolf' );
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections( 'wolf' );
            // output save settings button
            submit_button( 'Guardar opciones' );
            ?>
        </form>
    </div>
    <?php
}