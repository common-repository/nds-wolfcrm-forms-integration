<?php
function wolf_admin_menu() {
    global $_wp_last_object_menu;

    $_wp_last_object_menu++;

    do_action( 'wolf_admin_menu' );

    add_menu_page( 'WolfCRM Forms', 'WolfCRM Forms','manage_options', 'wolfcrm-forms','wolf_crm_campos', 'dashicons-share-alt2', $_wp_last_object_menu,'wolf_admin_configuracion',1);
    add_submenu_page ( 'wolfcrm-forms', 'Campos', 'Campos', 'manage_options', 'wolfcrm-forms', 'wolf_crm_campos', 0 );
    add_submenu_page ( 'wolfcrm-forms', 'Formularios tipo', 'Formularios tipo', 'manage_options', 'wolfcrm-forms-formularios-tipo', 'wolf_crm_formularios_tipo', 1 );
    add_submenu_page ( 'wolfcrm-forms', 'Opciones', 'Opciones', 'manage_options', 'wolfcrm-forms-opciones', 'wolf_crm_opciones', 2 );

}
add_action( 'admin_menu', 'wolf_admin_menu', 9, 0 );