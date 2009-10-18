<?php
// +--------------------------------------------------------------------------+
// | Zero Plugin for glFusion CMS                                             |
// +--------------------------------------------------------------------------+
// | autoinstall.php                                                          |
// |                                                                          |
// | glFusion Auto Installer module                                           |
// +--------------------------------------------------------------------------+
// | place revision tracking tags here                                        |
// +--------------------------------------------------------------------------+
// | Copyright (C) 2009 by the following authors:                             |
// |                                                                          |
// | Mark R. Evans          mark AT glfusion DOT org                          |
// | Mark A. Howard         mark AT usable-web DOT com                        |
// |                                                                          |
// +--------------------------------------------------------------------------+
// |                                                                          |
// | This program is free software; you can redistribute it and/or            |
// | modify it under the terms of the GNU General Public License              |
// | as published by the Free Software Foundation; either version 2           |
// | of the License, or (at your option) any later version.                   |
// |                                                                          |
// | This program is distributed in the hope that it will be useful,          |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of           |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            |
// | GNU General Public License for more details.                             |
// |                                                                          |
// | You should have received a copy of the GNU General Public License        |
// | along with this program; if not, write to the Free Software Foundation,  |
// | Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.          |
// |                                                                          |
// +--------------------------------------------------------------------------+

// this file may not be retrieved directly by a browser

if (!defined ('GVERSION')) {
    die ('This file can not be used on its own.');
}

global $_DB_dbms;

// load the plugin-specific constants, and dbms-specific installation scripts

require_once $_CONF['path'].'plugins/zero/zero.php';
require_once $_CONF['path'].'plugins/zero/sql/'.$_DB_dbms.'_install.php';

// +--------------------------------------------------------------------------+
// | Plugin installation options                                              |
// +--------------------------------------------------------------------------+

// glFusion's lib-install will perform the plugin's installation when the 'Install' option
// is invoked from the Plugin Administration screen.  lib-install looks for an array which defines
// all of the data structures that are associated with this array.  for more information on how
// to define your plugin's installation data structure see:
//
// http://www.glfusion.org/wiki/doku.php/glfusion:development:api:installer:start
//
// in the example below, we are defining:
//
//  1) the version of this structure to lib-install, in case it changes in the future
//  2) the plugin name, minimum glFusion version, support URL and displayable name
//  3) the tables that are to be installed that are specific to this plugin
//  4) 'admin' and 'user' groups and features that are associated with this plugin
//  5) group mapping, eg in this example, all logged-in users are permitted to use the
//     plugin via the mapping of 'Zero Users' to the group 'Logged-in Users'
//  6) a php_block which is to be used with this plugin, initially disabled

$INSTALL_plugin['zero'] = array(
    'installer' => array('type' => 'installer', 'version' => '1', 'mode' => 'install'),
    'plugin' => array('type' => 'plugin', 'name' => $_ZZ_CONF['pi_name'],
            'ver' => $_ZZ_CONF['pi_version'], 'gl_ver' => $_ZZ_CONF['gl_version'],
            'url' => $_ZZ_CONF['pi_url'], 'display' => $_ZZ_CONF['pi_display_name']),

    array('type' => 'table', 'table' => $_TABLES['zz_widgets'], 'sql' => $_SQL['zz_widgets']),
    array('type' => 'table', 'table' => $_TABLES['zz_gadgets'], 'sql' => $_SQL['zz_gadgets']),

    array('type' => 'group', 'group' => 'Zero Admin', 'desc' => 'Administrators of the Zero Plugin',
            'variable' => 'admin_group_id', 'addroot' => true),
    array('type' => 'group', 'group' => 'Zero Users', 'desc' => 'Users of the Zero Plugin',
            'variable' => 'user_group_id', 'addroot' => true),

    array('type' => 'feature', 'feature' => 'zero.admin', 'desc' => 'Ability to administer the Zero plugin',
            'variable' => 'admin_feature_id'),
    array('type' => 'feature', 'feature' => 'zero.user', 'desc' => 'Zero User',
            'variable' => 'user_feature_id'),

    array('type' => 'mapping', 'group' => 'admin_group_id', 'feature' => 'admin_feature_id',
            'log' => 'Adding Zero feature to the Zero admin group'),
    array('type' => 'mapping', 'group' => 'user_group_id', 'feature' => 'user_feature_id',
            'log' => 'Adding Zero feature to the Zero user group'),

    array('type' => 'addgroup','parent_grp' => 'Zero Users', 'child_grp' => 'Logged-in Users'),

    array('type' => 'block','type' => 'block', 'name' => 'zero', 'title' => 'Zero Function',
            'phpblockfn' => 'phpblock_zero', 'block_type' => 'phpblock', 'group_id' => 'admin_group_id',
            'onleft' => 1, 'is_enabled' => 0),
);

// installs the data structures for this plugin

function plugin_install_zero()
{
    global $INSTALL_plugin, $_ZZ_CONF;

    $pi_name            = $_ZZ_CONF['pi_name'];
    $pi_display_name    = $_ZZ_CONF['pi_display_name'];
    $pi_version         = $_ZZ_CONF['pi_version'];

    COM_errorLog("Attempting to install the $pi_display_name plugin", 1);

    $ret = INSTALLER_install($INSTALL_plugin[$pi_name]);
    if ($ret > 0) {
        return false;
    }

    return true;
}

// loads the configuration records for this plugin

function plugin_load_configuration_zero()
{
    global $_CONF;

    require_once $_CONF['path'] . 'plugins/zero/install_defaults.php';

    return plugin_initconfig_zero();
}

// this function permits the plugin to be uninstalled

// it passes an array to the core code function that removes
// tables, groups, features and php blocks from the database
// this code can perform special actions that cannot be oreseen by the core code
// (interactions with other plugins for example)

function plugin_autouninstall_zero ()
{
    $out = array (
        /* give the name of the tables, without $_TABLES[] */
        'tables' => array ( 'zz_widgets',
						    'zz_gadgets'),
        /* give the full name of the group, as in the db */
        'groups' => array('Zero Admin','Zero Users'),
        /* give the full name of the feature, as in the db */
        'features' => array('zero.admin','zero.user'),
        /* give the full name of the block, including 'phpblock_', etc */
        'php_blocks' => array( 'phpblock_zero' ),
        /* give all vars with their name */
        'vars'=> array()
    );
    return $out;
}
?>