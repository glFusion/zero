<?php
// +--------------------------------------------------------------------------+
// | Zero Plugin for the glFusion CMS                                         |
// +--------------------------------------------------------------------------+
// | upgrade.php                                                              |
// |                                                                          |
// | Upgrade routines                                                         |
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

if (!defined('GVERSION')) {
    die ('This file can not be used on its own.');
}

// this function is called back from functions.inc whenever the 'Upgrade' option is
// selected in the Plugin Administration screen for this plugin.  from here
// any incremental modifications to the installation can be made, including:
//
//  1) adding/modifying/deleting SQL
//  2) adding/replacing/deleting files
//  3) adding/removing/modifying config database vars/values
//
// after the upgrade process, the template cache is cleared in case CSS or
// templates changed.  note that when you first release your plugin, this
// function will not contain anything.  in the example below, we introduced
// the 'widgets' table in version 0.0.5, and the 'gadgets' able in 0.0.6

function zero_upgrade()
{
    global $_TABLES, $_CONF, $_ZZ_CONF, $_DB_table_prefix;

    $currentVersion = DB_getItem($_TABLES['plugins'],'pi_version',"pi_name='zero'");

    switch ($currentVersion) {

        case '0.0.5' :
            $_SQL['widgets'] = "CREATE TABLE IF NOT EXISTS {$_TABLES['widgets']} (
                widget_id mediumint(8) NOT NULL auto_increment,
                widget_desc varchar(64) NOT NULL default '',
                PRIMARY KEY (widget_id)
                ) TYPE=MyISAM;";
            DB_query($_SQL['widgets'],1);

        case '0.0.6' :
            $_SQL['gadgets'] = "CREATE TABLE IF NOT EXISTS {$_TABLES['gadgets']} (
                gadget_id mediumint(8) NOT NULL auto_increment,
                gadget_desc varchar(64) NOT NULL default '',
                PRIMARY KEY (gadget_id)
                ) TYPE=MyISAM;";
            DB_query($_SQL['gadgets'],1);

        case '1.0.0' :
        default:
            DB_query("UPDATE {$_TABLES['plugins']} SET pi_version='{$_ZZ_CONF['pi_version']}',pi_gl_version='{$_ZZ_CONF['pi_gl_version']}' WHERE pi_name='zero' LIMIT 1");
            break;
    }

    // clear the template cache because this plugin may create changes
    CTL_clearCache();

    // if upgrade succeeded, the plugin version in the plugins table will match
    // the version of the currently installed plugin
    return DB_getItem($_TABLES['plugins'],'pi_version',"pi_name='zero'") == $_ZZ_CONF['pi_version'];
}
?>
