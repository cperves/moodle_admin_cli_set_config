<?php
/**
 * set config vars admin cli
 *
 * @package  
 * @subpackage 
 * @copyright  2015 unistra  {@link http://unistra.fr}
 * @author Celine Perves <cperves@unistra.fr>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


define('CLI_SCRIPT', true);

require(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once($CFG->libdir.'/clilib.php');      // cli only functions


// now get cli options
list($options, $unrecognized) = cli_get_params(
			array(
					'name'             => null,
					'value'              => null,
					'help'              => false,
					'prompt'			=> false,
					'check' 			=> false
			),
			array(
					'h' => 'help',
					'n' => 'name',
					'v'=>'value',
					'p'=>'prompt',
					'c'=>'check'
			)
	);

if ($unrecognized) {
    $unrecognized = implode("\n  ", $unrecognized);
    cli_error(get_string('cliunknowoption', 'admin', $unrecognized));
}
$help =
"set a config var

There are no security checks here because anybody who is able to
execute this file may execute any PHP too.

Options:
-h, --help                 print out this help
-p, --prompt               prompt commandline mode
-n, --name=config_name     config name if no prompt mode as config_param_name if general config parameter or plugin/condig_param_name if plugin param name
-v, --value=config_value   config value if no prompt mode
-c, --check 				check if config name exists

Example:
\$sudo -u www-data /usr/bin/php admin/cli/set_config.php -p
";
if ($options['help']) {
    echo $help;
    die;
}
cli_heading('Config setter');
if($options['prompt']){
	$prompt = "enter a config var name (e.g plugin_name/varname)"; // TODO: localize
	$var_name = trim(cli_input($prompt));
	$var_name = explode('/',$var_name);
	$prompt = "enter its value"; // TODO: localize
	$var_value = trim(cli_input($prompt));
	
}else{
	$var_name=$options['name'];
	$var_name = explode('/',$var_name);
	$var_value=$options['value'];
	if(!isset($var_name) || !isset($var_value) ){
		echo "you must enter either --name et --value parameters\n";
		echo $help;
		exit(1);
	}
}
if($options['check']){
	$config = get_config(count($var_name)>1?$var_name[0]:'core');
	$setting = count($var_name)>1?$var_name[1]:$var_name[0];
	if(!property_exists($config, $setting)){
		echo "setting of name ".implode(',',$varname)." does not exists";
		exit(1);
	}
}
set_config(count($var_name)>1?$var_name[1]:$var_name[0], $var_value,count($var_name)>1?$var_name[0]:null);

echo "Config Set\n";
exit(0); // 0 means success