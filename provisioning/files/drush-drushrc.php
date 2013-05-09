<?php

/**
 * Useful shell aliases:
 *
 * Drush shell aliases act similar to git aliases.  For best results, define
 * aliases in one of the drushrc file locations between #3 through #6 above.
 * More information on shell aliases can be found via:
 * `drush topic docs-shell-aliases` on the command line.
 *
 * @see https://git.wiki.kernel.org/articles/a/l/i/Aliases.html#Advanced.
 */
$options['shell-aliases']['pull'] = '!git pull'; // We've all done it.
$options['shell-aliases']['pulldb'] = '!git pull && drush updatedb';
$options['shell-aliases']['noncore'] = 'pm-list --no-core';
$options['shell-aliases']['wipe'] = 'cache-clear all';
$options['shell-aliases']['unsuck'] = 'pm-disable -y overlay,dashboard';
$options['shell-aliases']['offline'] = 'variable-set -y --always-set maintenance_mode 1';
$options['shell-aliases']['online'] = 'variable-delete -y --exact maintenance_mode';
$options['shell-aliases']['dis-all'] = '!drush -y dis $(drush pml --status=enabled --type=module --no-core --pipe)';

$options['drush_usage_log'] = TRUE;
$options['drush_usage_send'] = TRUE;

/**
 * For sql-sync
 */
$options['dump-dir'] = '/vagrant';

/**
 * Specify the filename and path where 'sql-dump' should store backups of
 * database dumps.  The default is to dump to STDOUT, however if this option is
 * set in a drushrc.php file, the default behaviour can be achieved by
 * specifying a value of FALSE ("--result-file=0" on the command line).  Two
 * substitution tokens are available: @DATABASE is replaced with the name of the
 * database being dumped, and @DATE is replaced with the current time and date
 * of the dump of the form: YYYYMMDD_HHMMSS.  A value of TRUE ("--result-file=1"
 * on the command line) will cause 'sql-dump' to use the same temporary backup
 * location as 'pm-updatecode'.
 */
$options['result-file'] = TRUE;
$options['result-file'] = '/vagrant/@DATABASE/sql-dump/@DATABASE_@DATE.sql';

/**
 * Specify the logging level for PHP notices.  Defaults to "notice".  Set to
 * "warning" when doing Drush development.  Also make sure that error_reporting
 * is set to E_ALL in your php configuration file.  See `drush status` for the
 * path to your php.ini file.
 */
# $options['php-notices'] = 'warning';

/**
 * Specify options to pass to ssh in backend invoke.  The default is to prohibit
 * password authentication, and is included here, so you may add additional
 * parameters without losing the default configuration.
 */
# $options['ssh-options'] = '-o PasswordAuthentication=no';


// By default, unknown options are disallowed and result in an error.  Change
// them to issue only a warning and let command proceed.
$options['strict'] = FALSE;

/**
 * Drush requires at least rsync version 2.6.4 for some functions to work
 * correctly.  rsync version 2.6.8 or earlier may give the following error
 * message: "--remove-source-files: unknown option".  To fix this, set
 * $options['rsync-version'] = '2.6.8'; (replace with the lowest version of
 * rsync installed on any system you are using with Drush).  Note that this
 * option can also be set in a site alias, which is the prefered solution if
 * newer versions of rsync are available on some of the systems you use.
 * See: http://drupal.org/node/955092
 */
# $options['rsync-version'] = '2.6.9';

/**
 * An explicit list of tables which should be included in sql-dump and sql-sync.
 */
# $options['tables']['common'] = array('user', 'permissions', 'role_permission', 'role');

/**
 * List of tables whose *data* is skipped by the 'sql-dump' and 'sql-sync'
 * commands when the "--structure-tables-key=common" option is provided.
 * You may add specific tables to the existing array or add a new element.
 */
# $options['structure-tables']['common'] = array('cache', 'cache_filter', 'cache_menu', 'cache_page', 'history', 'sessions', 'watchdog');

/**
 * List of tables to be omitted entirely from SQL dumps made by the 'sql-dump'
 * and 'sql-sync' commands when the "--skip-tables-key=common" option is
 * provided on the command line.  This is useful if your database contains
 * non-Drupal tables used by some other application or during a migration for
 * example.  You may add new tables to the existing array or add a new element.
 */
# $options['skip-tables']['common'] = array('migration_data1', 'migration_data2');

/**
 * Command-specific execution options:
 *
 * Most execution options can be shared between multiple Drush commands; these
 * are specified as top-level elements of the $options array in the prior
 * examples above.  On the other hand, other options are command-specific, and,
 * in some cases, a shared option needs a different configuration depending on
 * which command is being executing.
 *
 * To define options that are only applicable to certain commands, make an entry
 * in the $command-specific array as shown below.  The name of the command may
 * be either the command's full name or any of the command's aliases.
 *
 * Options defined here will be overridden by options of the same name on the
 * command line.  Unary flags such as "--verbose" are overridden via special
 * "--no-xxx" options (e.g. "--no-verbose").
 *
 * Limitation: If 'verbose' is set in a command-specific option, it must be
 * cleared by '--no-verbose', not '--no-v', and visa-versa.
 */

// Ensure all rsync commands use verbose output.
# $command_specific['rsync'] = array('verbose' => TRUE);

// CVS credentials for module dowlnoads.
# $command_specific['dl'] = array('cvscredentials' => 'user:pass');

// Additional folders to search for scripts.
// Separate by : (Unix-based systems) or ; (Windows).
# $command_specific['script']['script-path'] = 'sites/all/scripts:profiles/myprofile/scripts';

// Always show release notes when running pm-update or pm-updatecode.
# $command_specific['pm-update'] = array('notes' => TRUE);
# $command_specific['pm-updatecode'] = array('notes' => TRUE);

// Set a predetermined username and password when using site-install.
# $command_specific['site-install'] = array('account-name' => 'alice', 'account-pass' => 'secret');
$command_specific['pm-enable']['yes'] = TRUE;
$command_specific['pm-disable']['yes'] = TRUE;
$command_specific['pm-uninstall']['yes'] = TRUE;

/**
 * List of Drush commands or aliases that should override built-in shell
 * functions and commands; otherwise, built-ins override Drush commands. Default
 * is 'help,dd,sa'.  Warning: bad things can happen if you put the wrong thing
 * here (e.g. eval, grep), so be cautious.  If a Drush command overrides a
 * built-in command (e.g. bash help), then you can use the `builtin` operator
 * to run the built-in version (e.g. `builtin help` to show bash help instead of
 * Drush help.) If a Drush command overrides a shell command (e.g. grep), then
 * you can use the regular shell command by typing in the full path to the
 * command (e.g. /bin/grep).
 */
# $command_specific['core-cli'] = array('override' => 'help,dd,sa');

/**
 * Load a drushrc file from the 'drush' folder at the root of the current
 * git repository.  Example script below by grayside.  Customize as desired.
 * @see: http://grayside.org/node/93.
 */
#exec('git rev-parse --show-toplevel 2> /dev/null', $output);
#if (!empty($output)) {
#  $repo = $output[0];
#  $options['config'] = $repo . '/drush/drushrc.php';
#  $options['include'] = $repo . '/drush/commands';
#  $options['alias-path'] = $repo . '/drush/aliases';
#}


