<?php
/**
 * Automatic installation functions for the plugin.
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

// This file may not be retrieved directly by a browser.
if (!defined ('GVERSION')) {
    die ('This file can not be used on its own.');
}

// TlFusion currently only supports mySQL at the time of this writing.
// However this global can in the future allow for multiple database engine types.
global $_DB_dbms, $_CONF;

// Load the plugin-specific constants.
require_once __DIR__ . '/zero.php';

// Load the dbms-specific installation script (although we only support MySQL at this time).
require_once __DIR__ . '/sql/' . $_DB_dbms . '_install.php';

// Load our language file, defaults to english.
// Only needed if we use some of these strings during installation.
// This is handy if we want to localize any of the default data that will be pushed into the DB.
$langfile = __DIR__ . '/language/' . $_CONF['language'] . '.php';
if (file_exists ($langfile)) {
    require_once $langfile;
} else {
    require_once __DIR__ . '/language/english_utf-8.php';
}

// load up the autoinstallation array

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
//  1) the version of this structure, in case it changes in the future (currently: 1)
//  2) the plugin name, minimum glFusion version, support URL and displayable name
//  3) the tables that are to be installed that are specific to this plugin
//  4) 'admin' and 'user' groups and features that are associated with this plugin
//  5) group mapping, eg in this example, all logged-in users are permitted to use the
//     plugin via the mapping of 'Zero Users' to the group 'Logged-in Users'
//  6) a php_block which is to be used with this plugin, initially disabled

$INSTALL_plugin['zero'] = array(
    'installer' => array(
        'type' => 'installer',
        'version' => '1',
        'mode' => 'install',
    ),
    'plugin' => array(
        'type' => 'plugin',
        'name' => $_ZZ_CONF['pi_name'],
        'ver' => $_ZZ_CONF['pi_version'],
        'gl_ver' => $_ZZ_CONF['pi_gl_version'],
        'url' => $_ZZ_CONF['pi_url'],
        'display' => $_ZZ_CONF['pi_display_name'],
    ),
    array(
        'type' => 'table',
        'table' => $_TABLES['widgets'],
        'sql' => $_SQL['widgets'],
    ),
    array(
        'type' => 'table',
        'table' => $_TABLES['gadgets'],
        'sql' => $_SQL['gadgets'],
    ),
    array(
        'type' => 'feature',
        'feature' => 'zero.admin',
        'desc' => 'Ability to administer the Zero plugin',
        'variable' => 'admin_feature_id',   // ties the feature back to the admin group
    ),
    array(
        'type' => 'feature',
        'feature' => 'zero.user',
        'desc' => 'Zero User',
        'variable' => 'user_feature_id',
    ),
    array(
        'type' => 'mapping',
        'findgroup' => 'Root',       // Root user gets the feature
        'feature' => 'admin_feature_id',
        'log' => 'Adding admin feature to the Root group',
    ),
    array(
        'type' => 'mapping',
        'findgroup' => 'Logged-In Users',   // all users can receive cards
        'feature' => 'user_feature_id',
        'log' => 'Adding user feature to the logged-in users group',
    ),
    // Below is the legacy method of creating new groups for admins and users.
    // Using existing groups and mapping the features is recommended.
    /*array(
        'type' => 'group',              // creating a group
        'group' => 'Zero Admin',        // name of the group
        'desc' => 'Administrators of the Zero Plugin',  // group description
        'variable' => 'admin_group_id', // var to assign the feature (below)
        'admin' => true,                // this is an admin group
        'addroot' => true,              // add the "root" user to the group
    ),
    array(
        'type' => 'group',
        'group' => 'Zero Users',
        'desc' => 'Users of the Zero Plugin',
        'variable' => 'user_group_id',
        'addroot' => true,
    ),
    array(
        'type' => 'block',                  // create a PHP block
        'name' => 'zero',
        'title' => 'Zero Function',
        'phpblockfn' => 'phpblock_zero',
        'block_type' => 'phpblock',
        'group_id' => 'admin_group_id',
        'onleft' => 1,
        'is_enabled' => 0,
    ),
    array(
        'type' => 'mapping',                // maps the features to the created groups
        'group' => 'admin_group_id',
        'feature' => 'admin_feature_id',
        'log' => 'Adding Zero feature to the Zero admin group',
    ),
    array(
        'type' => 'mapping',
        'group' => 'user_group_id',
        'feature' => 'user_feature_id',
        'log' => 'Adding Zero feature to the Zero user group',
    ),
    array(
        'type' => 'addgroup',               // Add logged-in uses to our group
        'parent_grp' => 'Zero Users',
        'child_grp' => 'Logged-in Users',
    ),*/
);

/**
 * Install the data structures for this plugin.
 *
 * @return  boolean     True on success, False on error
 */
function plugin_install_zero()
{
    global $INSTALL_plugin, $_ZZ_CONF;

    $pi_name            = $_ZZ_CONF['pi_name'];
    $pi_display_name    = $_ZZ_CONF['pi_display_name'];
    $pi_version         = $_ZZ_CONF['pi_version'];
    COM_errorLog("Attempting to install the $pi_name v$pi_version ($pi_display_name) plugin");
    return (INSTALLER_install($INSTALL_plugin[$pi_name]) > 0) ? false : true;

}

// load the configuration data for this plugin

// this function is a called back from INSTALLER_install() in lib-plugin to
// initialize the configuration data structure for the plugin.  it performs a
// further call back to plugin_initconfig_xxxx in install_defaults.php in order
// to establish initial/default config values.  this is only done once, during
// plugin installation, once your plugin is installed it will retrieve it's
// configuration information from the glFusion configuration table(s) using
// the config API, eg. $config->get_config('xxxx')

function plugin_load_configuration_zero()
{
    global $_CONF;

    require_once $_CONF['path'] . 'plugins/zero/install_defaults.php';

    return plugin_initconfig_zero(); // in functions.inc
}


/**
 * Specify what gets removed when the plugin is uninstalled.
 * This must include all of the items installed above (tables, groups, etc.)
 * This code can also perform special actions that cannot be oreseen by the
 * core code (interactions with other plugins for example).
 *
 * @return  array   Array of elements to be removed.
 */
function plugin_autouninstall_zero()
{
    $retval = array (
        // Give the name of the tables, without $_TABLES[].
        'tables' => array ( 'widgets', 'gadgets'),
        // Give the full name of the group, as in the db.
        //'groups' => array('Zero Admin','Zero Users'),
        // Give the full name of the feature, as in the db
        'features' => array('zero.admin','zero.user'),
        // Give the full name of the block function.
        'php_blocks' => array('phpblock_zero'),
        // Give all vars saved in gl_vars, if any.
        'vars'=> array()
    );
    return $retval;
}


/**
 * Define tasks to be performed immediately after installation.
 * If this function exists, it is called from the core plugin installation code
 * immediately after installation is completed.  this function can be used to
 * install default data or perform other tasks that only need to be performed
 * once to prepare the plugin for use.
 *
 * @return boolean      True on success, False on error
 */
function plugin_postinstall_zero()
{
    // Copy the plugin help file into the site docs directory.
    // This is an example, the help file(s) are normally under
    // public_html/plugin/docs/ and copied automatically during installation.
    /*$helpfile = $_CONF['path'] . 'plugins/zero/docs/zero.html';
    $dest = $_CONF['path_html'] . 'docs/zero.html';
    if (file_exists( $helpfile )) {
            COM_errorLog('AutoInstall: Copying Zero Plugin help file', 1);
            if (!copy( $helpfile, $dest )) {
                COM_errorLog('AutoInstall: Error copying Zero Plugin help file', 1);
            }
    }
    else {
        COM_errorLog('AutoInstall: The Zero Plugin help file could not be found in the plugin distribution', 1);
        return false;
    }*/
    return true;
}
