#include <stdio.h>
#include <string.h>
#include <ctype.h>
#include "../../../headers/commands/command.h"

#define MODEL_NAME_MAX_LENGTH 40

COMMAND(make_model)
{
	if(argc > args_start_to_index)
	{
		char model_name[MODEL_NAME_MAX_LENGTH];
		char path[PATH_MAX_SIZE];

		strcpy(model_name,argv[args_start_to_index]);

		if(strstr(model_name,"Model") == NULL)
		{
			char* model_text_pos = strstr(model_name,"model");

			if(model_text_pos != NULL)
				*(model_text_pos) = 'M';
			else 
				strcat(model_name,"Model");
		}

		*(model_name) = toupper(*(model_name) );

		strcpy(path,root_path);

		int index = strlen(path) - 1;

		if(*(path + index) != '/')
			strcat(path,"/");

		strcat(path,"src/model/model/");
		strcat(path,model_name);
		strcat(path,".php");

		FILE* model_file = fopen(path,"r");

		if(model_file != NULL)
		{
			printf("\n<< Sabo ;) le model existe déjà sur le chemin %s >>\n",path);

			fclose(model_file);

			return;
		}

		model_file = fopen(path,"w+");
		
		if(model_file == NULL)
		{
			printf("\n<< Sabo :/ echec de la création du model %s >>\n",path);

			return;
		}

		fprintf(model_file,"<?php\n\n" 
			"namespace Model\\Model;\n\n"
			"class %s extends AbstractModel\n"
			"{\n\n"
			"}"
			,model_name
		);
		
		fclose(model_file);

		printf("\n<< Sabo ;) le model %s a été crée avec succès dans %s >>\n",model_name,path);
	}
	else printf("\n<< Sabo ;) veuillez saisir le nom du controlleur >>\n");
}