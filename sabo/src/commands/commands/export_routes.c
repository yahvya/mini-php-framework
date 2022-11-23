#include <string.h>
#include <stdio.h>
#include <stdlib.h>
#include "../../../headers/commands/command.h"

COMMAND(export_routes)
{
	char file_path[] = __FILE__;

	char* start_index = strstr(file_path,"export_routes.c");

	memset(start_index,0,strlen(start_index) );

	char command_line[PATH_MAX_SIZE * 2];

	sprintf(command_line,"php %s../scripts/export_routes.php %s ",file_path,root_path);

	if(argc > args_start_to_index)
	{
		if(strcmp("-h",argv[args_start_to_index]) == 0)
		{
			printf("\n<< Sabo ;) Vous pouvez saisir le chemin de destination complet ou le fichier sera exporté dans le projet avec le nom export_routes.json >>\n");

			return;
		}
		else strcat(command_line,argv[args_start_to_index]);
	}

	system(command_line);
}