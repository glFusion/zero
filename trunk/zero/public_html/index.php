<?php
// +--------------------------------------------------------------------------+
// | Zero Plugin for the glFusion CMS                                         |
// +--------------------------------------------------------------------------+
// | index.php                                                                |
// |                                                                          |
// | Zero plugin main index page                                              |
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

// this file contains the code that non-administrative users may use

require_once '../lib-common.php';

// perhaps the plugin has been uploaded, but not yet installed.  if this is the
// case, then we really should not be using it.  return a 404 error to the user

if (!in_array('zero', $_PLUGINS)) {
    COM_404();
    exit;
}

// load the plugin-specific functions, as well as a basic user check.  anonymous
// users will be sent to the login page.  users in the 'Zero Users' group will
// see a short message.  see the code at the beginning of lib-zero.php

require_once $_CONF['path'].'plugins/zero/include/lib-zero.php';

// start of main code

$display = COM_siteHeader('menu',$LANG_ZZ00['title'])
    . '<strong>' . $LANG_ZZ00['title'].'</strong>'
    . $LANG_ZZ00['publicpage']
    . $LANG_ZZ00['widgets'] . $_ZZ_CONF['widgets_per_page'].'<br />'
    . $LANG_ZZ00['gadgets'] . $_ZZ_CONF['gadgets_per_page'].'<br />'
    . COM_siteFooter();

echo $display;

?>
