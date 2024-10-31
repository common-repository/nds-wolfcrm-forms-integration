<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.nds.es
 * @since      1.0.0
 *
 * @package    Wolfcrm_Forms_Integration_Module
 * @subpackage Wolfcrm_Forms_Integration_Module/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h1>Formularios tipo</h1>
    <p>Aquí le ofrecemos formularios tipo, ya diseñados, para Ninja Forms, para cada una de las entidades a las que puede importar.</p>
    <p>Puede importar estos formularios en su Ninja Forms mediante la opción importar / exportar</p>

    <h1>Descargar formularios tipo</h1>
    <p><a href="<?php echo plugin_dir_url( __FILE__ ).'../form-examples/Contacto_WolfCRM.nff'; ?>" download>Formulario contactos</a></p>
    <p><a href="<?php echo plugin_dir_url( __FILE__ ).'../form-examples/Clientes_WolfCRM.nff'; ?>" download>Formulario cliente</a></p>
    <p><a href="<?php echo plugin_dir_url( __FILE__ ).'../form-examples/Clientes_Potenciales_WolfCRM.nff'; ?>" download>Formulario cliente potencial</a></p>
    <p><a href="<?php echo plugin_dir_url( __FILE__ ).'../form-examples/Clientes_Potenciales_y_Oportunidad_asociada_WolfCRM.nff'; ?>" download>Formulario cliente potencial y oportunidad asociada</a></p>
    <p><a href="<?php echo plugin_dir_url( __FILE__ ).'../form-examples/Oportunidad_WolfCRM.nff'; ?>" download>Formulario oportunidad</a></p>
</div>