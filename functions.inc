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

// glFusion Plugin API =========================================================

/**
* Called by the plugin admin to display the current plugin code version
*
* @return   string  version number
*
*/
function plugin_chkVersion_zero()
{
    global $_ZZ_CONF;

    return $_ZZ_CONF['pi_version'];
}

/**
* Returns the URL of the plugin's icon
*
* @return   string      URL of the icon (max 50x50)
*
*/
function plugin_geticon_zero()
{
    global $_CONF;

    $retval = $_CONF['site_url'].'/zero/images/zero.jpg';
    return $retval;
}

/**
* Update the Links plugin
*
* @return   int     Number of message to display (true = generic success msg)
*
* plugin upgrade function - uses zero_upgrade() function in upgrade.php which
* is located in the plugin root.  if no upgrade file is found, then we display
* a message indicating that the upgrade function is not implemented
*
*/
function plugin_upgrade_zero()
{
    global $_CONF, $_TABLES, $_ZZ_CONF, $_DB_table_prefix;

    if ( @file_exists($_CONF['path'].'plugins/zero/upgrade.php') ) {
        require_once $_CONF['path'].'plugins/zero/upgrade.php';
        return zero_upgrade();
    } else {
        COM_errorLog("Zero plugin upgrade function not implemented");
        return 3001;
    }
}

/**
* Returns the items for this plugin that should appear on the main menu
*
* NOTE: this MUST return the url/value pairs in the following format
* $<arrayname>[<label>] = <url>
*
* @return   mixed   menu entry, or boolean false if disabled / hidden
*
*/
function plugin_getmenuitems_zero()
{
    global $_CONF, $LANG_ZZ00;
    $menuitems = array();
    $menuitems["$LANG_ZZ00[menulabel]"] = $_CONF['site_url']."/zero/index.php";
    return $menuitems;
}

/**
* This will put an option for links in the command and control block on
* moderation.php
*
* @return   mixed   array(title, url, icon), or boolean false when not allowed
*
*/
function plugin_cclabel_zero()
{
    global $_CONF, $LANG_ZZ00;

    if (SEC_hasRights ('zero.edit')) {
        return array ($LANG_ZZ00['adminlabel'],
                      $_CONF['site_admin_url'] . '/plugins/zero/index.php',
                      plugin_geticon_zero());
    }

    return false;
}

/**
* returns the administrative option for this plugin
*
* @return   mixed   array(title, url, num. links), or void when not allowed
*
*/
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

/**
 * This is our simple phpblock example which is inserted into the database
 * during the installation process
 *
 */
function phpblock_zero()
{
    $retval = "This block does absolutely nothing.<br />";
    return $retval;
}


?>
