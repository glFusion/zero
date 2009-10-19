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

// this file may not be retrieved directly by a browser

if (!defined ('GVERSION')) {
    die ('This file can not be used on its own!');
}

// retrieve the configurable values and constants that are plugin-specific

// configuration values

require_once $_CONF['path_system'] . 'classes/config.class.php';
$zz_config = config::get_instance();
$_ZZ_CONF = $zz_config->get_config('zero');

// constants

require_once $_CONF['path'].'plugins/zero/zero.php';

// load our language file, defaults to english if a language file that relates
// to the system-wide or user default is not found

$langfile = $_CONF['path'] . 'plugins/zero/language/' . $_CONF['language'] . '.php';
if (file_exists ($langfile)) {
    require_once $langfile;
} else {
    require_once $_CONF['path'].'plugins/zero/language/english.php';
}

// this is where you will insert functions that implement the glFusion plugin API

// returns the version of the plugin from the configuration array

function plugin_chkVersion_zero() {
    global $_ZZ_CONF;

    return $_ZZ_CONF['pi_version'];
}

// returns a URL to an icon that is specific to this plugin (max: 50x50 px)

function plugin_geticon_zero() {
    global $_CONF;

    $retval = $_CONF['site_url'].'/zero/images/zero.jpg';
    return $retval;
}

// plugin upgrade function - uses zero_upgrade() function in upgrade.php which
// is located in the plugin root

function plugin_upgrade_zero(){
    global $_CONF, $_TABLES, $_ZZ_CONF, $_DB_table_prefix;

    if ( @file_exists($_CONF['path'].'plugins/zero/upgrade.php') ) {
        require_once $_CONF['path'].'plugins/zero/upgrade.php';
        return zero_upgrade();
    } else {
        COM_errorLog("Zero plugin upgrade function not implemented");
        return 3001;
    }
}

// adds a menu item which allows navigation to this plugin page

function plugin_getmenuitems_zero(){
    global $_CONF, $LANG_ZZ00;
    $menuitems = array();
    $menuitems["$LANG_ZZ00[menulabel]"] = $_CONF['site_url']."/zero/index.php";
    return $menuitems;
}

// this is where you can insert your phpblock functions (if any)
// here is our simple phpblock example

function phpblock_zero() {
    $retval = "This block does absolutely nothing.<br />";
    return $retval;
}


?>