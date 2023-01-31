<?php
/**
 * Manual installation entry point for the plugin.
 * This file is used by site administrators when they are installing or
 * uninstalling the plugin using glFusion's plugin API. there are very few
 * changes required to this file to customize for your plugin.
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

// Load the glFusion API functions
require_once '../../../lib-common.php';

// Load the plugin-specific installation functions
require_once $_CONF['path'].'/plugins/zero/autoinstall.php';

// We must specify this library, it is not included in glFusion by default.
USES_lib_install();

if (!SEC_inGroup('Root')) {
    // only users in the Root group are permitted to install plugins
    COM_errorLog("Someone has tried to illegally access the Zero Plugin install/uninstall page.  User id: {$_USER['uid']}, Username: {$_USER['username']}, IP: $REMOTE_ADDR",1);
    COM_404();
    exit;
/*} else {
    // authenticate install/uninstall commands
    $validtoken = SEC_checkToken();
    if (!$validtoken) {
	    COM_accessLog("CSRF authentication failure during Zero Plugin Installation" . $errmsg, 1);
        echo COM_refresh($_CONF['site_admin_url']) . '/index.php';
    }*/
}

// action to take: 'install' or 'uninstall'
$action = isset($_GET['action']) ? COM_applyFilter($_GET['action']) : 'install';

// default refresh url
$url = $_CONF['site_admin_url'] . '/plugins.php?msg=';

// default suffix for error msg
$errmsg = " - UID:{$_USER['uid']} Username:{$_USER['username']}, IP:$REMOTE_ADDR";

// perform the requested action
switch ($action) {
case 'install':
	$url .= (plugin_install_zero()) ? '44' : '72';
	break;

case 'uninstall':
	$url .= (plugin_uninstall_zero('installed')) ? '45' : '73';
	break;

default:
	COM_errorLog("The Zero Plugin installation script was invoked with no action parameter." . $errmsg, 1);
	break;
}

echo COM_refresh($url);
