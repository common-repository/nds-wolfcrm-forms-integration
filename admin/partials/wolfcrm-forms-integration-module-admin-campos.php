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
    <h1><a href="<?php echo plugin_dir_url( __FILE__ ).'../form-examples/WP_WolfCRM_Forms_Manual.pdf'; ?>" download>MANUAL</a></h1>

    <h1>WP HOOKS para Ninja Forms</h1>
    <p>Etiqueta HOOK para contactos:  <b>send_form_to_wolfcrm_contact</b></p>
    <p>Etiqueta HOOK para clientes:  <b>send_form_to_wolfcrm_customer</b></p>
    <p>Etiqueta HOOK para clientes potenciales:  <b>send_form_to_wolfcrm_prospect_customer</b></p>
    <p>Etiqueta HOOK para oportunidades:  <b>send_form_to_wolfcrm_opportunity</b></p>
    <p>Etiqueta HOOK para clientes y oportunidades: <b>send_form_to_wolfcrm_customer_opportunity</b></p>

    <h1>Relación de campos para contactos</h1>
    <ul>
        <li>name – <span style="color:red;">Obligatorio</span>. Nombre</li>
        <li>surname – Apellidos</li>
        <li>title – Cargo</li>
        <li>vat – CIF/DNI</li>
        <li>address – Dirección</li>
        <li>postal_code – Código Postal</li>
        <li>city – Población</li>
        <li>country – Provincia ¡! relacionado con County por el campo CODE.</li>
        <li>country – País ¡! relacionado con Country por el campo CODE.</li>
        <li>phone – Teléfono</li>
        <li>mobile_phone – Teléfono móvil</li>
        <li>email – Email</li>
    </ul>

    <h1>Relación de campos para clientes y clientes potenciales</h1>
    <ul>
        <li>name – <span style="color:red;">Obligatorio</span>. Nombre comercial</li>
        <li>alias – Nombre comercial</li>
        <li>vat – <span style="color:red;">Obligatorio</span>. CIF/DNI</li>
        <li>address – Dirección </li>
        <li>postal_code – Código Postal</li>
        <li>city – Población </li>
        <li>country – Provincia ¡! relacionado con County por el campo CODE.</li>
        <li>country – País ¡! relacionado con Country por el campo CODE.</li>
        <li>phone – Teléfono</li>
        <li>mobile_phone – Teléfono móvil</li>
        <li>fax – Fax</li>
        <li>email – Email</li>
        <li>web – Pagina web</li>
        <li>description – Observaciones</li>
        <li></li>
    </ul>

    <h1>Relación de campos para clientes y oportunidades</h1>
    <ul>
        <li>name – <span style="color:red;">Obligatorio</span>. Nombre comercial</li>
        <li>alias – Nombre comercial</li>
        <li>vat – <span style="color:red;">Obligatorio</span>. CIF/DNI</li>
        <li>address – Dirección </li>
        <li>postal_code – Código Postal</li>
        <li>city – Población </li>
        <li>country – Provincia ¡! relacionado con County por el campo CODE.</li>
        <li>country – País ¡! relacionado con Country por el campo CODE.</li>
        <li>phone – Teléfono</li>
        <li>mobile_phone – Teléfono móvil</li>
        <li>fax – Fax</li>
        <li>email – Email</li>
        <li>web – Pagina web</li>
        <li>description – Observaciones</li>
        <li>opportunity_name – <span style="color:red;">Obligatorio</span>. Se propone gestionarlo mediante un campo desplegable con varias opciones, en el ejemplo se denomina Motivo de la consulta.</li>
        <li>opportunity_description – <span style="color:red;">Obligatorio</span>. Observaciones de la oportunidad, texto libre.</li>
    </ul>

    <h1>Relación de campos para oportunidades (Uso avanzado)</h1>
    <ul>
        <li>date – <span style="color:red;">Obligatorio</span>. Fecha YYYY-MM-DD</li>
        <li>name – <span style="color:red;">Obligatorio</span>. Concepto</li>
        <li>type – <span style="color:red;">Obligatorio</span>. Tipo se relaciona con Selector (TYPE ='OPPORTUNITY_TYPE') por el campo ID </li>
        <li>status – <span style="color:red;">Obligatorio</span>. Estado, se relaciona con Selector (TYPE ='OPPORTUNITY_STATUS') por el campo ID</li>
        <li>source - Origen,  se relaciona con Selector (TYPE ='OPPORTUNITY_SOURCE') por el campo ID</li>
        <li>amount – Importe (con '.' como separador de decimales y sin separador de miles) , si no se indica se entenderá 0</li>
        <li>customer_id - <span style="color:red;">Obligatorio</span>. Cliente, se relaciona con Customer por el campo CODE</li>
        <li>manager_user_id - <span style="color:red;">Obligatorio</span>. Responsable, se relaciona con User por el campo CODE</li>
        <li>temperature - Temperatura, (valores enteros de 0 a 100)</li>
        <li>description - Observaciones</li>
    </ul>

    <p>Para los listados de países y provincias se recomienda utilizar los disponible en los formularios tipo para prevenir errores de funcionamiento.
Se recomienda no crear clientes reales, salvo que se tenga claro el proceso.</p>

</div>