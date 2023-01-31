<?php
/**
 * Configuration items for the Zero plugin framework.
 * Specifies plugin-specific global variables, typically version info
 * and table names.
 * Must be named `<plugin_name>.php`.
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
if (!defined('GVERSION')) {
    die ('This file can not be used on its own.');
}

// ZZ = is a 2-4 character plugin-specific 'tag' that is used to id this plugin.
// This tag is used in uppercase as a part of creating variable and/or table
// names in a way that ensures that the names of these variables/tables do not
// conflict with other glFusion core or plugin global constants or tables that
// may be already defined.

// static constants for this plugin

$_ZZ_CONF['pi_name']            = 'zero';
$_ZZ_CONF['pi_display_name']    = 'Zero Function';
$_ZZ_CONF['pi_version']         = '2.0.0';      // plugin code version
$_ZZ_CONF['pi_gl_version']      = '2.0.0';      // required minimum glFusion version
$_ZZ_CONF['pi_url']             = 'http://www.usable-web.com';

// Here is where you define tables that are specific to your plugin.
// Assigning a plugin-specific table prefix helps locate the tables easily when working
// with your database, and also further ensures that you don't accidentally conflict
// with a glFusion 'core' table.
$_ZZ_table_prefix = strtolower($_DB_table_prefix . 'zero_');

// Make your plugin-specific tables known to glFusion so that they are handled
// properly.  to do this, add them to the global $_TABLES array.  the 'widgets'
// and 'gadgets' tables are shown here as examples
$_TABLES['widgets']         = $_ZZ_table_prefix . 'widgets';
$_TABLES['gadgets']         = $_ZZ_table_prefix . 'gadgets';
