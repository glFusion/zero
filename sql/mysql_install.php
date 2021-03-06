<?php
// +--------------------------------------------------------------------------+
// | Zero Plugin for the glFusion CMS                                         |
// +--------------------------------------------------------------------------+
// | mysql_install.php                                                        |
// |                                                                          |
// | Contains all the SQL necessary to install the Zero plugin                |
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
// +--------------------------------------------------------------------------+

// this file may not be retrieved directly by a browser

if (!defined ('GVERSION')) {
    die ('This file can not be used on its own.');
}

// this code creates the plugin-specific tables.  these are just examples

$_SQL['widgets'] = "CREATE TABLE {$_TABLES['widgets']} (
  widget_id mediumint(8) NOT NULL auto_increment,
  widget_desc varchar(64) NOT NULL default '',
  PRIMARY KEY (widget_id)
) TYPE=MyISAM;";

$_SQL['gadgets'] = "CREATE TABLE {$_TABLES['gadgets']} (
  gadget_id mediumint(8) NOT NULL auto_increment,
  gadget_desc varchar(64) NOT NULL default '',
  PRIMARY KEY (gadget_id)
) TYPE=MyISAM;";

?>
