#if !defined(COMMAND_H)
#define COMMAND_H
	#define COMMAND_ARGS (int argc,char** argv,char* root_path,int args_start_to_index)
	#define COMMAND(command_name) void command_name COMMAND_ARGS
	#define COUNT_OF_COMMANDS 3
	#define PATH_MAX_SIZE 500
	
	// create a controller in the controllers folder
	COMMAND(make_controller);
	// create a model in the models folder
	COMMAND(make_model);
	// exports project routes 
	COMMAND(export_routes);
#endif