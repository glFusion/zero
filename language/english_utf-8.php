<?php
/**
 * English language file for the Zero plugin.
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

// General language strings referenced througout the plugin.
$LANG_ZZ00 = array (
    'plugin'            => 'zero',
    'title'             => 'Zero Function',
    'menulabel'         => 'Zero',
    'adminlabel'        => 'Zero Admin',
    'error'             => ' Error',
    'widgets_per_page'  => 'Widgets per Page',
    'gadgets_per_page'  => 'Gadgets per Page',
    'accessdenied'      => 'Sorry, you do not have access to the Zero Plugin Administration page.',
    'publicpage1'       => 'This is the Zero Plugin public index page.',
    'publicpage2'       => "This would be the initial 'home page' that is displayed for non-admin users of your plugin.",
    'adminpage1'        => "This is the Zero Plugin administrative page.",
    'adminpage2'        => "This is the page that would contain what is needed for administrators to manage this plugin.",
    'showing_in_profile' => 'Showing in user profile',
    'yes' => 'Yes',
    'no' => 'No',
);

// configuration UI localization
$LANG_configsections['zero'] = array(
    'label'             => 'Zero Function',
    'title'             => 'Zero Function Configuration'
);
$LANG_configsubgroups['zero'] = array(
    'sg_main'           => 'Main Settings',
);
$LANG_fs['zero'] = array(
    'fs_main'           => 'Zero Function General Settings',
);
$LANG_confignames['zero'] = array(
    'widgets_per_page'  => 'Widgets per page',
    'gadgets_per_page'  => 'Gadgets per page',
    'show_in_profile'   => 'Show in user profile?',
);
// Config selection options
$LANG_configSelect['zero'] = array(
    0 => array(1 => 'Yes', 0 => 'No'),
);
