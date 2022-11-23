#include "../headers/commands/command.h"
#include "../headers/utils/help.h"
#include <assert.h>
#include <stdio.h>
#include <string.h>

int main(int argc,char* argv[])
{	
	assert(argc >= 2 && "Missed project root path");

	void (*commands_list[COUNT_OF_COMMANDS])COMMAND_ARGS = {
		make_controller,
		make_model
	};

	const char* linked_names[COUNT_OF_COMMANDS] = {
		"make:controller",
		"make:model"
	};

	const char* linked_descriptions[COUNT_OF_COMMANDS] = {
		"Crée un controlleur dans le dossier des controlleurs",
		"Crée un modèle dans le dossier des modèles"
	};

	if(argc >= 3)
	{	
		if(strcmp("--help",argv[2]) != 0)
		{
			for(int i = 0; i < COUNT_OF_COMMANDS; i++)
			{
				if(strcmp(argv[2],linked_names[i]) == 0)
				{
					commands_list[i](argc,argv,argv[1],3);

					printf("\n<< Sabo ;) bon courage pour la suite >>\n");

					return 0;
				}
			}

			printf("\n<< Sabo ;) je n'ai pas trouvé la commande, voici l'aide >>\n");
		}
		
		print_help(linked_names,linked_descriptions);
	}
	else printf("<< Sabo ;) Veuillez saisir un commande --help pour afficher la liste des commandes >>\n");

	return 0;
}