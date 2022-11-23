# mini-php-framework
mini php framework

come with a small cli tool named sabo 

php bin/sabo --help to list commands

add customized commands to sabo step

  - create your classes in bin/utils
  - the class have to extends AbstractCommand and implements
    - public static function exec_command(int $argc, array $argv, string $project_root_path):void which will be called to execute your command
    - redefine public static function print_args():void to print your own arguments
  - finally add in bin/sabo file
  - use \Sabo\YourClass;
  - AbstractCommand::add_command("your_command_name",YourClass::class,"your command description");
   
 
