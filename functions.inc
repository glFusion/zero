<?php
// +--------------------------------------------------------------------------+
// | Zero Plugin for the glFusion CMS                                         |
// +--------------------------------------------------------------------------+
// | functions.inc                                                            |
// |                                                                          |
// | Implement the glFusion Plugin API                                        |
// +--------------------------------------------------------------------------+
// | $Id::                                                                   $|
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
// +------------------------------------------------------------------------

// this is the plugin-specific function list which implements the glFusion
// plugin API for your plugin.  please be careful about what you put into this
// file, because when you plugin is enabled, it is loaded by lib-common into
// memory for use by glFusion.  as such, only functions which are needed by
// glFusion core should exist in this file

// this file may not be retrieved directly by a browser

if (!defined('GVERSION')) {
    die ('This file can not be used on its own!');
}

// MAIN ========================================================================

// retrieve the configuration values for this plugin

// use glFusion's config API to retrieve the configurable values and constants
// that are specific to this plugin from the glFusion database

require_once $_CONF['path_system'] . 'classes/config.class.php';
$config = config::get_instance();
$_ZZ_CONF = $config->get_config('zero');

// retrieve global config vars and table names specific to this plugin

require_once $_CONF['path'].'plugins/zero/zero.php';

// load our language file, defaults to english if a language file that relates
// to the system-wide or user default is not found

$langfile = $_CONF['path'] . 'plugins/zero/language/' . $_CONF['language'] . '.php';
if (file_exists ($langfile)) {
    require_once $langfile;
} else {
    require_once $_CONF['path'].'plugins/zero/language/english.php';
}
unset($langfile);

// glFusion Plugin API functions ===============================================

// returns the code version of this plugin

function plugin_chkVersion_zero()
{
    global $_ZZ_CONF;

    return $_ZZ_CONF['pi_version'];
}

// returns a URL to an icon that is specific to this plugin (max: 50x50 px)

function plugin_geticon_zero()
{
    global $_CONF;

    $retval = $_CONF['site_url'].'/zero/images/zero.jpg';
    return $retval;
}

// permit the plugin to be upgraded

// zero_upgrade() function in upgrade.php located in the plugin root.
// if no upgrade file is found, then we display a message indicating that the
// upgrade function is not implemented

function plugin_upgrade_zero()
{
    global $_CONF, $_TABLES, $_ZZ_CONF, $_DB_table_prefix;

    if ( @file_exists($_CONF['path'].'plugins/zero/upgrade.php') ) {
        require_once $_CONF['path'].'plugins/zero/upgrade.php';
        return zero_upgrade();
    } else {
        COM_errorLog("Zero Plugin upgrade function not implemented");
        return 3001;
    }
}

// return an icon-based admin link for Command & Control, or false if no rights

function plugin_cclabel_zero()
{
    global $_CONF, $LANG_ZZ00;

    if (SEC_hasRights ('zero.edit')) {
        return array ($LANG_ZZ00['adminlabel'],
                      $_CONF['site_admin_url'] . '/plugins/zero/index.php',
                      plugin_geticon_zero());
    } else {
        return false;
    }
}

// this plugin does not support comments

function plugin_commentsupport_zero() {
    return false;
}

// return a link to the admin page for this plugin, or void if not allowed

function plugin_getadminoption_zero()
{
    global $_CONF, $LANG_ZZ00;

    if (SEC_hasRights('zero.edit')) {
        $total_items = 0;  // set this value to the number of items in your db
        return array ($LANG_ZZ00['adminlabel'],
                      $_CONF['site_admin_url'] . '/plugins/zero/index.php',
                      $total_items);
    }
}

// return an associative array which defines a menu item which provides user
// access to this plugin in the form: $array[<label>] = <url> or false if
// disabled or hidden

function plugin_getmenuitems_zero()
{
    global $_CONF, $LANG_ZZ00;
    $menuitems = array();
    $menuitems["$LANG_ZZ00[menulabel]"] = $_CONF['site_url']."/zero/index.php";
    return $menuitems;
}

// phpblocks for this plugin ===================================================

// define a phpblock to be associated with this plugin

function phpblock_zero()
{
    $retval = "This block does absolutely nothing.<br />";
    return $retval;
}

?>
