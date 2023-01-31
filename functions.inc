<?php
/**
 * glFusion required functions for the Zero plugin framework.
 * This is the plugin-specific function list which implements the glFusion
 * plugin API for your plugin. Please be careful about what you put into this
 * file, because when you plugin is enabled, it is loaded by lib-common into
 * memory for use by glFusion. as such, only functions which are needed by
 * glFusion core should exist in this file.
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
    die ('This file can not be used on its own!');
}


// Retrieve the configuration values for this plugin.
// Use glFusion's config API to retrieve the configurable values and constants
// that are specific to this plugin from the glFusion database.
require_once $_CONF['path_system'] . 'classes/config.class.php';
$config = config::get_instance();
$_ZZ_CONF = $config->get_config('zero');

// Retrieve global config vars and table names specific to this plugin.
require_once $_CONF['path'].'plugins/zero/zero.php';

// Include the user-supplied configuration file, if any.
// This is typically useful for quick debugging.
if (is_file(__DIR__ . '/config.php')) {
    include_once __DIR__ . '/config.php';
}

// load our language file, defaults to english if a language file that relates
// to the system-wide or user default is not found
$langfile = __DIR__ . '/language/' . $_CONF['language'] . '.php';
if (file_exists ($langfile)) {
    require_once $langfile;
} else {
    require_once __DIR__ . '/language/english_utf-8.php';
}
unset($langfile);


/**
 * Get the code version of this plugin.
 * This is just the version set in the configuration file.
 *
 * @return  string      Code version
 */
function plugin_chkVersion_zero()
{
    global $_ZZ_CONF;

    return $_ZZ_CONF['pi_version'];
}


/**
 * Get the URL to the plugin's icon.
 * This is shown in command and control and may be used in other templates.
 * Max size should be 50x50 pixels.
 *
 * @return  string      URL to plugin icon.
 */
function plugin_geticon_zero()
{
    global $_CONF;

    $retval = $_CONF['site_url'].'/zero/images/zero.jpg';
    return $retval;
}


/**
 * Perform the upgrade functions for the plugin.
 * Actual functions are in upgrade.php to reduce the size of this file.
 * if no upgrade file is found, then we display a message indicating that the
 * upgrade function is not implemented.
 *
 * @return  bool    True on success, False on error
 */
function plugin_upgrade_zero()
{
    if ( @file_exists(__DIR__ . '/upgrade.php') ) {
        require_once __DIR__ . '/upgrade.php';
        return ZERO_upgrade();
    } else {
        COM_errorLog("Zero Plugin upgrade function not implemented");
        return false;
    }
}


/**
 * Return the information to create the Admin link with icon.
 * This is used for the Command and Control page.
 * The `zero.admin` feature is checked to only show this to actual admins
 * for the plugin.
 *
 * @return  array|null   Array (label, admin_url, icon_url), NULL if unauthorized
 */
function plugin_cclabel_zero()
{
    global $_CONF, $LANG_ZZ00;

    if (SEC_hasRights('zero.admin')) {
        return array(
            $LANG_ZZ00['adminlabel'],
            $_CONF['site_admin_url'] . '/plugins/zero/index.php',
            plugin_geticon_zero()
        );
    } else {
        return NULL;
    }
}


/**
 * Check if this plugin supports comments.
 *
 * @return  boolean     True if comments supported, False if not
 */
function plugin_commentsupport_zero()
{
    return false;
}


/**
 * Get the URL for the admin page for this plugin.
 * Used to add the option to the Admin menu.
 *
 * @return  array|null  Array of info for url, NULL if not allowed.
 */
function plugin_getadminoption_zero()
{
    global $_CONF, $LANG_ZZ00;

    if (SEC_hasRights('zero.edit')) {
        $total_items = 0;  // set this value to the number of items in your db
        return array(
            $LANG_ZZ00['adminlabel'],
            $_CONF['site_admin_url'] . '/plugins/zero/index.php',
            $total_items
        );
    }
}


/**
 * Get an array of information to create the user-facing menu option(s).
 * The format is array(label => url) and multiple options may be returned.
 *
 * @return  array   Array of label=>url options
 */
function plugin_getmenuitems_zero()
{
    global $_CONF, $LANG_ZZ00;
    $menuitems = array(
        $LANG_ZZ00['menulabel'] => $_CONF['site_url'] . '/zero/index.php',
    );
    return $menuitems;
}


/**
 * PHP block function.
 * These create the blocks for the left and right sides.
 * They must be named with the `phpblock_` prefix and should include the
 * plugin name.
 *
 * @return  string      HTML for block contents.
 */
function phpblock_zero()
{
    $retval = "This block does absolutely nothing.<br />";
    return $retval;
}


// The following functions are optional and may be removed if not needed.

/**
 * Get selection options for a configuration item.
 * This may be used if you need a config item that is a selection of groups,
 * users or other elements that cannot be specified in the language file
 * (see `$LANG_configSelect['zero']` in the language file).
 * The function name is `plugin_configmanager_select_<item_name>_<plugin_name>`
 * and is only called if there is a config var named <item_name>.
 *
 * @return  array           Array of options as display_name=>ID
 */
function plugin_configmanager_select_custom_item_zero()
{
    return array(
        'All Users' => -1,
        'user 1' => 1,
        'user 2' => 2,
    );
}


/**
 * Export user data when requested by the privacy plugin.
 * The return is XML bracketed by `<plugin_name>` tags.
 * This function is not required if the plugin doesn't store any
 * user-specific data.
 *
 * @param   integer $uid        User ID
 * @param   string  $email      User Email Address (not used)
 * @param   string  $username   User Name (not used)
 * @param   string  $ip         Requester's IP address (not used)
 * @return  string              XML-formatted data
 */
function plugin_privacy_export_zero($uid, $email='', $username='', $ip='')
{
    $retval .= "<zero>\n";
    $retval .= '<data1>Some Data Here</data1>' . "\n";
    $retval .= '<data2>Some Data Here</data2>' . "\n";
    $retval .= "</zero>\n";
    if (function_exists('tidy_repair_string')) {
        $retval = tidy_repair_string($retval, array('input-xml' => 1));
    }
    return $retval;
}


/**
 * Perform scheduled functions with the built-in cron utility.
 * Optional, only required if there are periodic functions to run such as
 * notifications and cleanup.
 *
 * @return  void
 */
function plugin_runScheduledTask_zero()
{
}


/**
 * Gets item information for one or more items.
 *
 * @param   string  $id         Item identifier, typically DB record ID
 * @param   string  $what       Comma-separated list of fields to return
 * @param   integer $uid        User ID
 * @param   array   $options    Other options, not typically users.
 * @return  array|null          Array of item information, null on error
 */
function plugin_getiteminfo_zero($id, $what, $uid=0, $options=array())
{
    global $_TABLES, $_CONF;

    // Split out the properties and create working arrays
    $properties = explode(',', $what);
    $props = array();
    $retval = array();

    // The `search_index` property is included if this request is for the
    // search engine indexing following an item being saved.
    // If this plugin does not have content to index, return an empty array.
    if (in_array('search_index', $properties)) {
        return array();
    }

    // Get the items to return. An asterisk as the item ID indicates that all
    // items should be returned.
    $items = array();   // Just for the demo function
    if ($id == '*') {
        //$items = function_to_get_all()
    } else {
        // One item, put it in an array.
        //$items = array(function_to_get_one();
    }

    foreach ($items as $item) {
        $username = COM_getDisplayName($item['uid']);
        foreach ($properties as $p) {
            switch ($p) {
            case 'group_id':
                $props[$p] = $_ZZ_CONF['grp_access'];
                break;
            case 'id':
            case 'author':
            case 'owner_id':
                $props[$p] = $item['uid'];
                break;
            case 'description':
            case 'content':
                $props[$p] = $item['content'];
                break;
            }
        }

        // Put the item info into an array and format it for return.
        $mapped = array();
        foreach ($props as $key => $value) {
            if ($id == '*') {
                if ($value != '') {
                    $mapped[$key] = $value;
                }
            } else {
                $mapped[$key] = $value;
            }
        }

        if ($id == '*') {
            $retval[] = $mapped;
        } else {
            $retval = $mapped;
            break;
        }
    }

    if (($id != '*') && (count($retval) == 1)) {
        // Get the single item out of the mapped array
        $tRet = array_values($retval);
        $retval = $tRet[0];
    }
    if ($retval === '' || (is_array($retval) && count($retval) == 0)) {
        return NULL;
    } else {
        return $retval;
    }
}
