<?php
/**
 * SQL statements to create and update tables.
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

// This code creates the plugin-specific tables.
// The TYPE=MyISAM is required and will be changed to TYPE=InnoDB if appropriate.
$_SQL = array();
$_SQL['widgets'] = "CREATE TABLE {$_TABLES['widgets']} (
  widget_id mediumint(8) NOT NULL auto_increment,
  widget_desc varchar(64) NOT NULL default '',
  PRIMARY KEY (widget_id)
) TYPE=MyISAM";
$_SQL['gadgets'] = "CREATE TABLE {$_TABLES['gadgets']} (
  gadget_id mediumint(8) NOT NULL auto_increment,
  gadget_desc varchar(64) NOT NULL default '',
  PRIMARY KEY (gadget_id)
) TYPE=MyISAM";

// This is where the upgrade SQL is specified.
// For example, assume that prior to version 1.0.0 only the "widgets"
// table was used, and 1.0.0 now has the "gadgets" table.
// Each version's statements are simply executed in order, so add any
// "alter table", "drop", "create" lines here.
// If data is to be updated via "insert" or "update", first check some value
// such as whether a column exists to be sure the upgrade does not overwrite
// data.
$_ZZ_UPGRADE = array(
    '1.0.0' => array(
        "CREATE TABLE {$_TABLES['gadgets']} (
          gadget_id mediumint(8) NOT NULL auto_increment primary key,
          gadget_desc varchar(64) NOT NULL default '',
        ) TYPE=MyISAM",
    ),
);
