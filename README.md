# moodle admin cli set_config 
admin client command line that enable setting moodle config

## Features
set moodle config settings via command line
two mods :
  * prompt
  * name value arguments passed in command line

##installation
just copy the content of the plugin directory, i.e a php file, in admin/cli directory

##usage
\$sudo -u www-data /usr/bin/php admin/cli/set_config.php [-options]
  * -h, --help                 print out this help
  * -p, --prompt               prompt commandline mode
  * -n, --name=config_name     config name if no prompt mode as config_param_name if general config parameter or plugin/condig_param_name if plugin param name
  * -v, --value=config_value   config value if no prompt mode
  * -c, --check 	       check if config name exists

## Contributions

Contributions of any form are welcome. Github pull requests are preferred.

Feel free to report any bugs, improvements, or feature requests in our [issue tracker][issues].

## License
* http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
[moodle_admin_cli_set_config]: 
[issues]: 
