<?php
// +--------------------------------------------------------------------------+
// | Zero Plugin for the glFusion CMS                                         |
// +--------------------------------------------------------------------------+
// | install.php                                                              |
// |                                                                          |
// | This file installs and removes the data structures for the plugin        |
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

// this file is used by administrators when they are installing the plugin.
// there are very few changes required to this file to customize for your plugin

require_once '../../../lib-common.php';
require_once $_CONF['path'].'/plugins/zero/autoinstall.php';

USES_lib_install();

$display = '';

if (!SEC_inGroup('Root')) {

    // only users in the Root group are permitted to install plugins

    COM_errorLog("Someone has tried to illegally access the Zero Plugin install/uninstall page.  User id: {$_USER['uid']}, Username: {$_USER['username']}, IP: $REMOTE_ADDR",1);
    $display .= COM_siteHeader ('menu', $LANG_ACCESS['accessdenied'])
             . COM_startBlock ($LANG_ACCESS['accessdenied'])
             . $LANG_ACCESS['plugin_access_denied_msg']
             . COM_endBlock ()
             . COM_siteFooter ();
    echo $display;
    exit;
}

// MAIN ========================================================================

// all incoming commands should be authenticated

$validtoken = SEC_checkToken();

// action to take: 'install' or 'uninstall'

$action = (isset($_GET['action'])) ? COM_applyFilter($_GET['action']) : '';

// setup some url's, and default exit to plugin admin panel

$site_admin_url = $_CONF['site_admin_url'] . '/index.php';
$plugin_admin_url = $_CONF['site_admin_url'] . '/plugins.php?msg=';
$display = COM_refresh($plugin_admin_url);

// perform the desired action

switch ($action) {

    case 'install':
	if ($validtoken) {
	    $display .= (plugin_install_zero()) ? '44' : '72';
	} else {
	    COM_accessLog("CSRF authentication failure during Plugin Installation - UID:{$_USER['uid']} Username:{$_USER['username']}, IP:$REMOTE_ADDR", 1);
            $display = COM_refresh($site_admin_url);
	}
	break;

    case 'uninstall':
	if ($validtoken) {
	    $display .= (plugin_uninstall_zero('installed')) ? '45' : '73';
	} else {
	    COM_accessLog("CSRF authentication failure during Plugin Installation - UID:{$_USER['uid']} Username:{$_USER['username']}, IP:$REMOTE_ADDR", 1);
            $display = COM_refresh($site_admin_url);
	}
	break;

    default:
	COM_errorLog("Plugin installation script was invoked with no action parameter. - UID:{$_USER['uid']} Username:{$_USER['username']}, IP:$REMOTE_ADDR", 1);
        $display = COM_refresh($site_admin_url);
	break;

}

echo $display;

?>
