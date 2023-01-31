<?php
/**
 * Entry point to the plugin administration.
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
require_once '../../../lib-common.php';
require_once '../../auth.inc.php';

$content = '';      // to accumulate content and display at the end

// Unauthorized users just get a 404 message, better for security
// than admitting the admin page exists.
if (!SEC_hasRights('zero.admin')) {
    COM_accessLog ("User {$_USER['username']} tried to illegally access the zero administration screen.");
    COM_404();
}

// Define the base admin URL in one place
$admin_url = $_CONF['site_admin_url'] . '/plugins/zero/index.php';

// Find out what action was requested.
// $_POST gets priority, followed by $_GET.
$expected = array(
    'edititem', 'saveitem', 'deleteitem',
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
case 'edititem':
    $content .= 'Here is the item edit form.';
    break;

case 'saveitem':
    // Save the item with ID `$actionval` and refresh back to the admin page.
    echo COM_refresh($admin_url);
    break;

case 'deleteitem':
    // Delete the item with ID `$actionval` and refresh back to the admin page.
    echo COM_refresh($admin_url);
    break;

case 'listitems':
default:
    // Showing default admin content.
    $T = new Template($_CONF['path'] . '/plugins/zero/templates/admin');
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

echo COM_siteHeader('menu', $LANG_ZZ00['title']);
echo $content;
echo COM_siteFooter();
