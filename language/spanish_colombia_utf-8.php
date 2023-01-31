<?php
/**
 * Spanish language file for the Zero plugin.
 *
 * @author      Lee Garner <lee@leegarner.com>
 * @author      Mark R. Evans <mark AT glfusion DOT org>
 * @author      Mark A. Howard <mark AT usable-web DOT com>
 * @copyright   Copyright (c) 2009-2022 The above authors
 * @package     zero
 * @version     v2.0.0
 * @license     http://opensource.org/licenses/gpl-2.0.php
 *              GNU Public License v2 or later
 * @filesource
 */

// this file may not be retrieved directly by a browser
if (!defined ('GVERSION')) {
    die ('This file can not be used on its own.');
}

// General language strings referenced througout the plugin.
$LANG_ZZ00 = array (
    'plugin'            => 'cero',
    'title'             => 'Función cero',
    'menulabel'         => 'Cero',
    'adminlabel'        => 'Administrador cero',
    'error'             => ' Error',
    'widgets'           => 'Widgets por página: ',
    'gadgets'           => 'Gadgets por página: ',
    'accessdenied'      => 'Lo sentimos, no tienes acceso a la página de administración de Zero Plugin.',
    'publicpage1'       => "Esta es la página de índice pública de Zero Plugin.",
    'publicpage2'       => "Esta sería la 'página de inicio' inicial que se muestra para los usuarios que no son administradores de su complemento.",
    'adminpage'         => "<br /><br />Esta es la página administrativa de Zero Plugin.<br /><br />Esta es la página que contendría lo que los administradores necesitan para administrar este complemento.<br /><br/>",
    'showing_in_profile' => 'Mostrando en el perfil de usuario',
    'yes' => 'Sí',
    'no' => 'No',
);

// configuration UI localization
$LANG_configsections['zero'] = array(
    'label'             => 'Función cero',
    'title'             => 'Configuración de función cero',
);
$LANG_configsubgroups['zero'] = array(
    'sg_main'           => 'Ajustes principales',
);
$LANG_fs['zero'] = array(
    'fs_main'           => 'Configuración general de la función cero',
);
$LANG_confignames['zero'] = array(
    'widgets_per_page'  => 'Widgets por página',
    'gadgets_per_page'  => 'Gadgets por página',
    'show_in_profile'   => '¿Mostrar en el perfil de usuario?',
);
// Config selection options
$LANG_configSelect['zero'] = array(
    0 => array(1 => 'Sí', 0 => 'No'),
);
