<?php
// +--------------------------------------------------------------------------+
// | Zero Plugin for the glFusion CMS                                         |
// +--------------------------------------------------------------------------+
// | english_utf-8.php                                                        |
// |                                                                          |
// | English language file                                                    |
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

// this file may not be retrieved directly by a browser

if (!defined ('GVERSION')) {
    die ('This file can not be used on its own.');
}

// use this file to localize your plugin

$LANG_ZZ00 = array (
    'plugin'            => 'zero',
    'title'             => 'Zero Function',
    'menulabel'         => 'Zero',
    'error'             => ' Error',
);

// configuration UI localization

$LANG_configsections['zero'] = array(
    'label'                 => 'Zero Function',
    'title'                 => 'Zero Function Configuration'
);
$LANG_confignames['zero'] = array(
    'widgets_per_page'     => 'Widgets per page',
    'gadgets_per_page'     => 'Gadgets per page',
);
$LANG_configsubgroups['zero'] = array(
    'sg_main'               => 'Main Settings',
);

$LANG_fs['zero'] = array(
    'zero_general'            => 'Zero Function General Settings',
);

?>
