<?php
/**
 * Guest-facing entry point for the plugin.
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

require_once '../lib-common.php';

// Perhaps the plugin has been uploaded, but not yet installed.
// If this is the case, then we really should not be using it.
// Simply return a 404.
if (!in_array('zero', $_PLUGINS)) {
    COM_404();
    exit;
}

$content = '';      // variable to accumulate content for display

// Find out what action was requested.
// $_POST gets priority, followed by $_GET.
$expected = array(
    'widgets', 'gadgets',
);
$action = '';
foreach($expected as $provided) {
    if (isset($_POST[$provided])) {
        $action = $provided;
        $actionval = $_POST[$provided];
        break;
    } elseif (isset($_GET[$provided])) {
        $action = $provided;
        $actionval = $_GET[$provided];
        break;
    }
}

switch ($action) {
case 'widgets':
    $content .= 'Showing widget stuff';
    break;
case 'gadgets':
    $contetn .= 'Showing gadget stuff';
    break;
default:
    // Showing default index page
    $T = new Template($_CONF['path'] . '/plugins/zero/templates');
    $T->set_file('view', 'index.thtml');
    $T->set_var(array(
        'widgets_per_page' => $_ZZ_CONF['widgets_per_page'],
        'gadgets_per_page' => $_ZZ_CONF['gadgets_per_page'],
        'show_in_profile' => $_ZZ_CONF['show_in_profile'],
    ) );
    $T->parse('output', 'view');
    $content .= $T->finish($T->get_var('output'));
    break;
}

echo COM_siteHeader('menu',$LANG_ZZ00['title']);
echo $content;
echo COM_siteFooter();
