#include <stdio.h>
#include <string.h>
#include <ctype.h>
#include "../../../headers/commands/command.h"

#define CONTROLLER_NAME_MAX_LENGTH 40

COMMAND(make_controller)
{
	if(argc > args_start_to_index)
	{
		char controller_name[CONTROLLER_NAME_MAX_LENGTH];
		char path[PATH_MAX_SIZE];

		strcpy(controller_name,argv[args_start_to_index]);

		if(strstr(controller_name,"Controller") == NULL)
		{
			char* controller_text_pos = strstr(controller_name,"controller");

			if(controller_text_pos != NULL)
				*(controller_text_pos) = 'C';
			else 
				strcat(controller_name,"Controller");
		}

		*(controller_name) = toupper(*(controller_name) );

		strcpy(path,root_path);

		int index = strlen(path) - 1;

		if(*(path + index) != '/')
			strcat(path,"/");

		strcat(path,"src/controller/controller/");
		strcat(path,controller_name);
		strcat(path,".php");

		FILE* controller_file = fopen(path,"r");

		if(controller_file != NULL)
		{
			printf("\n<< Sabo ;) le controller existe déjà sur le chemin %s >>\n",path);

			fclose(controller_file);

			return;
		}

		controller_file = fopen(path,"w+");
		
		if(controller_file == NULL)
		{
			printf("\n<< Sabo :/ echec de la création du controller %s >>\n",path);

			return;
		}

		fprintf(controller_file,"<?php\n\n" 
			"namespace Controller\\Controller;\n\n"
			"class %s extends AbstractController\n"
			"{\n\n"
			"}"
			,controller_name
		);
		
		fclose(controller_file);

		printf("\n<< Sabo ;) le controller %s a été crée avec succès dans %s >>\n",controller_name,path);
	}
	else printf("\n<< Sabo ;) veuillez saisir le nom du controlleur >>\n");
}