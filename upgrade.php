<?php
/**
 * Upgrade routines for the plugin.
 * Performs specific changes to database schemas and configurations
 * when upgrading from one version to another.
 * This should be idempotent as far as schema changes, and should be able
 * to upgrade from any lower version to the newest.
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
if (!defined('GVERSION')) {
    die ('This file can not be used on its own.');
}

// These functions use the new glFusion logger and DBAL database class.
use glFusion\Database\Database;
use glFusion\Log\Log;


/**
 * Upgrade the plugin.
 * Any steps that do not involve a SQL change, as a rule, can be omitted.
 * The configuration and version will be updated to the current settings
 * at the end.
 *
 * @param   boolean $dvlp   True to ignore errors (development upgrade)
 * @return  boolean     True on success, False on failure
 */
function ZERO_upgrade(bool $dvlp=false) : bool
{
    global $_TABLES, $_CONF, $_ZZ_CONF, $_DB_table_prefix;

    // Get the version of the code that is installed in glFusion.
    $current_ver = $_PLUGIN_INFO[Config::PI_NAME]['pi_version'];
    // Get the version of code present on the filesystem.
    $code_ver = plugin_chkVersion_zero();

    if (!COM_checkVersion($current_ver, '0.5.0')) {
        // Upgrade to 0.5.0.
        // This version has no SQL changes so it does not need to be included
        // here. It doesn't hurt anything to include it though.
        $current_ver = '0.5.0';
        if (!ZERO_do_upgrade_sql($current_ver, $dvlp)) return false;
        if (!ZERO_do_set_version($current_ver)) return false;
    }

    if (!COM_checkVersion($current_ver, '1.0.0')) {
        // Upgrade to 1.0.0.
        // This version has a SQL change so it needs to be included here.
        $current_ver = '1.0.0';
        if (!ZERO_do_upgrade_sql($current_ver, $dvlp)) return false;
        if (!ZERO_do_set_version($current_ver)) return false;
    }

    // Other versions have no SQL changes or other actions to take
    // so they can be omitted. The version will be set to the final
    // version below.
    if ($current_ver != $code_ver) {
        if (!ZERO_do_set_version($code_ver)) return false;
    }

    // Update any configuration item changes.
    // Adds, removes and re-orders the items as needed, but does not alter any
    // existing config values.
    USES_lib_install();
    global $zeroConfigData;
    require_once __DIR__ . '/install_defaults.php';
    _update_config('zero', $zeroConfigData);

    // Clear all caches
    CTL_clearCache();

    // Remove deprecated files
    ZERO_remove_old_files();

    // Made it this far, return OK
    return true;
}


/**
 * Actually perform any sql updates.
 * Gets the sql statements from the $_ZZ_UPGRADE array defined (maybe)
 * in the SQL installation file.
 * If a version is given that has no SQL then simply return true.
 *
 * @param   string  $version    Version being upgraded TO
 * @param   boolean $ignore_error   True to ignore SQL errors
 * @return  boolean     True on success, False on failure
 */
function ZERO_do_upgrade_sql($version, $ignore_error=false)
{
    global $_TABLES, $_ZZ_UPGRADE;

    // If no sql statements passed in, return success.
    if (!isset($_ZZ_UPGRADE[$version]) || !is_array($_ZZ_UPGRADE[$version])) {
        return true;
    }

    $db = Database::getInstance();

    // Execute SQL now to perform the upgrade
    Log::write('system', Log::INFO, "--- Updating Birthdays to version $version");
    foreach($_ZZ_UPGRADE[$version] as $sql) {
        Log::write('system', Log::INFO, "Birthdays Plugin $version update: Executing SQL => $sql");
        try {
            $db->conn->executeStatement($sql);
        } catch (\Exception $e) {
            Log::write('system', Log::ERROR, __FUNCTION__ . ': ' . $e->getMessage());
            if (!$ignore_error){
                return false;
            }
        }
    }
    Log::write('system', Log::INFO, "--- Birthdays plugin SQL update to version $version done");
    return true;
}


/**
 * Update the plugin version number in the database.
 * Called at each version upgrade to keep up to date with
 * successful upgrades.
 *
 * @param   string  $ver    New version to set
 * @return  boolean         True on success, False on failure
 */
function ZERO_do_set_version($ver)
{
    global $_TABLES;

    $db = Database::getInstance();

    // now update the current version number.
    try {
        $db->conn->update(
            $_TABLES['plugins'],
            array(
                'pi_version' => $ver,
                'pi_gl_version' => Config::get('gl_version'),
                'pi_homepage' => Config::get('pi_url'),
            ),
            array('pi_name' => Config::PI_NAME),
            array(Database::STRING, Database::STRING, Database::STRING, Database::STRING)
        );
    } catch (\Exception $e) {
        Log::write('system', Log::ERROR, __FUNCTION__ . ': ' . $e->getMessage());
        return false;
    }
    return true;
}


/**
 * Remove deprecated files.
 * Add files to the array under the relative paths to have them deleted.
 */
function ZERO_remove_old_files()
{
    global $_CONF;

    $paths = array(
        // private/plugins/zero (core files)
        __DIR__ => array(
        ),
        // public_html/zero (user-facing)
        $_CONF['path_html'] . 'zero' => array(
        ),
        // public_html/admin/zero (admin html pages)
        $_CONF['path_html'] . 'admin/plugins/zero' => array(
        ),
    );

    foreach ($paths as $path=>$files) {
        foreach ($files as $file) {
            if (file_exists("$path/$file")) {
                @unlink("$path/$file");
            }
        }
    }
}
