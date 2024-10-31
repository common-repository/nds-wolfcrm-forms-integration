<?php // Silence is golden
require_once plugin_dir_path( __FILE__ ) . 'includes/generar-menu-admin.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/generar-pagina-opciones.php';

function wolf_crm_opciones() {
    ob_start();
    include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wolfcrm-forms-integration-module-admin-opciones.php';
}

function wolf_crm_campos() {
    ob_start();
    include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wolfcrm-forms-integration-module-admin-campos.php';
}

function wolf_crm_formularios_tipo() {
    ob_start();
    include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wolfcrm-forms-integration-module-admin-formularios-tipo.php';
}