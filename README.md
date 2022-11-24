# mini-php-framework
mini php framework

SABO

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
   
 
Views

- views are provided with twig and are locates in views/templates/

- to move this folder you have to redefine $this->view_start_path in your controller or directly in abstract controller

- you can add your own extensions and filters to twig in the AbstractController or in your controller with $this->get_twig_environment()->addExtension(instance_off_your_class);

Routes and Assets in view

- two functions are added by default 
    
    - route() and asset() throws exceptions in debug_mode
    
    - route take the name of the route and if it's a genereic you can pass a twig array to replace generic elements 
        example: route('home_page') or route('view_an_article',{'article_id' : 1})
        
    - css and js files are allowed in public and views folders , asset function take the type (css or js) and the file name , it will search the file in:
        - your_twig_file_directory/css for a css type or your_twig_file_directory/js for a js type
        
        - if not found it will search in public/css for a css type or public/js for a js file 
        
          example: this->render("article/article.twig"); the search will start in views/templates/article/css/ or views/templates/articles/js/

controllers extends route function too with $this->route("route_name",@optionnal["name" => "replace"]);
