<?php
// +--------------------------------------------------------------------------+
// | Zero Plugin for the glFusion CMS                                         |
// +--------------------------------------------------------------------------+
// | lib-zero.php                                                             |
// |                                                                          |
// | Zero plugin support functions                                            |
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

// the lib-<pluginname>.php file contains functions that are specific to your
// plugin.  this file isn't specifically required, but by organizing your code
// in a certain way, it allows others to more efficiently view, fix or augment
// your code

// this file may not be retrieved directly by a browser

if (!defined ('GVERSION')) {
    die ('This file can not be used on its own!');
}

// only allow logged-in users or users who have the zero.user permission

if (COM_isAnonUser()) {
    echo COM_refresh($_CONF['site_url'].'/users.php');
    exit;
}

if (!SEC_hasRights('zero.view')) {
    echo COM_refresh($_CONF['site_url']);
    exit;
}

// This is where you can include functions that are specific to your plugin
// you should prefix your function names with a tag or ID that is specific to
// your plugin in order to avoid conflicts with other previously-defined
// functions.  It also helps you to remember where these functions are defined

// in the example here, we have included a function which displays an error
// message in an alert box

function ZERO_alertMessage($alertText = '')
{
    global $_CONF, $_ZZ_CONF, $LANG_ZZ00;

    $display = COM_siteHeader('menu',$LANG_ZZ00['title']);

    $T = new Template($_CONF['path'] . 'plugins/zero/templates/');
    $T->set_file (array ('message'=>'zero_alertmsg.thtml'));
    $T->set_var(array(
        'alert_title' =>  $LANG_ZZ00['title'] . $LANG_ZZ00['error'],
        'alert_text'  =>  $alertText,
    ));
    $T->parse ('output', 'message');
    $display .= $T->finish ($T->get_var('output'));

    $display .= COM_siteFooter();

    echo $display;

    return;
}

// here is a handy function which you can use to find the template files that
// are associated with your plugin.  this function will attempt to find the
// relevant templates in your layout directory, but if you have not elected to
// copy the files there during installation, it will default to the 'templates'
// directory located in the plugin root directory.  note that this function will
// take a single parameter, which allows you to define one or more subdir's to
// contain templates for your administrative interface, or possibly different
// sections of the plugin

// return a path to the template files

function ZERO_templatePath($path = '')
{
    global $_CONF;

    if (empty($path)) {
        $layout_path = $_CONF['path_layout'] . 'zero';
    } else {
        $layout_path = $_CONF['path_layout'] . 'zero' . '/' . $path;
    }

    if (is_dir($layout_path)) {
        $retval = $layout_path;
    } else {
        $retval = $_CONF['path'] . 'plugins/zero/templates';
        if (!empty ($path)) {
            $retval .= '/' . $path;
        }
    }

    return $retval . '/';
}


?>
