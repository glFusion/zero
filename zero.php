<?php
// +--------------------------------------------------------------------------+
// | Zero Function Plugin for glFusion CMS                                    |
// +--------------------------------------------------------------------------+
// | zero.php                                                                 |
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

// this file must be named <plugin_name>.php, where <plugin_name> is the value
// that is defined in the <id> tag of the plugin.xml file that is located in
// the root of the plugin distribution archive.  this file is used by the
// autoinstaller code as well as the plugin/  all plugin-specific global
// constants should be declared here

// this file may not be retrieved directly by a browser

if (!defined ('GVERSION')) {
    die ('This file can not be used on its own.');
}

// ZZ = is a 2-4 character plugin-specific 'tag' that is used to id this plugin
// this tag is used in uppercase as a part of creating variable and/or table
// names in a way that ensures that the names of these variables/tables do not
// conflict with other glFusion core or plugin global constants or tables that
// may be already defined

$_ZZ_CONF['pi_name']            = 'zero';
$_ZZ_CONF['pi_display_name']    = 'Zero Function';
$_ZZ_CONF['pi_version']         = '1.0.0';
$_ZZ_CONF['gl_version']         = '1.1.5';
$_ZZ_CONF['pi_url']             = 'http://www.usable-web.com';

// here is where you define tables that are specific to your plugin.  assigning
// a plugin-specific table prefix helps locate the tables easily when working
// with your database, and also further ensures that you don't accidentally conflict
// with a glFusion 'core' table

$_ZZ_table_prefix = $_DB_table_prefix . 'zz_';

// make your plugin-specific tables known to glFusion so that they are handled
// properly.  to do this, add them to the global $_TABLES array.  the 'widgets'
// and 'gadgets' tables are shown here as examples

$_TABLES['zz_widgets']         = $_ZZ_table_prefix . 'widgets';
$_TABLES['zz_gadgets']         = $_ZZ_table_prefix . 'gadgets';
?>