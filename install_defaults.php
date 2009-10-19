<?php
// +--------------------------------------------------------------------------+
// | Zero Plugin for the glFusion CMS                                         |
// +--------------------------------------------------------------------------+
// | install_defaults.php                                                     |
// |                                                                          |
// | Initial Installation Defaults used when loading the online configuration |
// | records. These settings are only used during the initial installation    |
// | and not referenced any more once the plugin is installed.                |
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
    die('This file can not be used on its own!');
}

// zero plugin default settings

// the initial installation fefaults are used when loading the online
// configuration records. these values are only used during the initial
// installation and are not referenced again once the plugin is installed

global $CONF_ZZ_DEFAULT;
$CONF_ZZ_DEFAULT = array();

$CONF_ZZ_DEFAULT['widgets_per_page'] = 4;
$CONF_ZZ_DEFAULT['gadgets_per_page'] = 8;

// initialize zero plugin configuration

// this function reates the database entries for the configuation entries
// that are specific to this plugin if they don't already exist

function plugin_initconfig_zero()
{
    global $_ZZ_CONF, $CONF_ZZ_DEFAULT;

    // this merges the config values with default override values

    if (is_array($_ZZ_CONF) && (count($_ZZ_CONF) > 1)) {
        $CONF_ZZ_DEFAULT = array_merge($CONF_ZZ_DEFAULT, $_ZZ_CONF);
    }

    // get the configuration instance, and create the zero plugin
    // configuration group if it does not exist.  note that this is where
    // the decision is made to use the default values
    // the full reference to using the configuration class can be found here:
    // http://www.glfusion.org/wiki/doku.php/glfusion:development:configsystem#configuration_class_function_reference

    $c = config::get_instance();
    if (!$c->group_exists('zero')) {

        $c->add('sg_main', NULL, 'subgroup', 0, 0, NULL, 0, true, 'zero');
        $c->add('zero_general', NULL, 'fieldset', 0, 0, NULL, 0, true, 'zero');

        $c->add('widgets_per_page',$CONF_ZZ_DEFAULT['widgets_per_page'], 'text',
                0, 0, NULL, 10, true, 'zero');

        $c->add('gadgets_per_page',$CONF_ZZ_DEFAULT['gadgets_per_page'], 'text',
                0, 0, NULL, 20, true, 'zero');
    }
    return true;
}

?>