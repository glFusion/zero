<?php
/**
 * Set up the configuration items to be managed by the global configuration.
 * These values are only used during the initial installation and are not
 * referenced again once the plugin is installed.
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
    die('This file can not be used on its own!');
}

include_once __DIR__ . '/zero.php';
use glFusion\Log\Log;

/** @var global config data */
global $zeroConfigData, $_ZZ_CONF;
$zeroConfigData = array(
    array(
        'name' => 'sg_main',        // Main config group
        'default_value' => NULL,
        'type' => 'subgroup',
        'subgroup' => 0,
        'fieldset' => 0,
        'selection_array' => NULL,
        'sort' => 0,
        'set' => true,
        'group' => $_ZZ_CONF['pi_name'],
    ),
    array(
        'name' => 'fs_main',        // Main field set
        'default_value' => NULL,
        'type' => 'fieldset',
        'subgroup' => 0,
        'fieldset' => 0,
        'selection_array' => NULL,
        'sort' => 0,
        'set' => true,
        'group' => $_ZZ_CONF['pi_name'],
    ),
    array(
        'name' => 'widgets_per_page',   // config item name
        'default_value' => 4,           // default value
        'type' => 'text',               // text, select, etc.
        'subgroup' => 0,                // in the main subgrup
        'fieldset' => 0,                // in the main fieldset
        'selection_array' => 0,         // language array, n/a for text vals
        'sort' => 10,                   // order of appearance
        'set' => true,                  // true to set the value
        'group' => $_ZZ_CONF['pi_name'],    // plugin name to group conf vals
    ),
    array(
        'name' => 'gadgets_per_page',
        'default_value' => 8,           // default value
        'type' => 'text',
        'subgroup' => 0,
        'fieldset' => 0,
        'selection_array' => 0,
        'sort' => 20,
        'set' => true,
        'group' => $_ZZ_CONF['pi_name'],
    ),
    array(
        'name' => 'show_in_profile',    // maybe something is shown in profiles
        'default_value' => 0,           // default value = "No"
        'type' => 'select',             // this is a selection var
        'subgroup' => 0,
        'fieldset' => 0,
        'selection_array' => 0,         // this is the $LANG_configSelect key
        'sort' => 30,
        'set' => true,
        'group' => $_ZZ_CONF['pi_name'],
    ),
);


/**
 * Initialize the plugin configuration.
 * Creates the config items from the array given above.
 *
 * @param   integer $group_id   Not used
 * @return  boolean     True: success; False: an error occurred
 */
function plugin_initconfig_zero($group_id = 0)
{
    global $zeroConfigData;

    $c = config::get_instance();
    if (!$c->group_exists('zero')) {
        USES_lib_install();
        foreach ($zeroConfigData AS $cfgItem) {
            _addConfigItem($cfgItem);
        }
    } else {
        COM_errorLog(__FUNCTION__ . ': Zero config group already exists.');
        return false;
    }
    return true;
}
