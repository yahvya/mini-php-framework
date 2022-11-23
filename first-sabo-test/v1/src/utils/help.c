#include <stdio.h>
#include "../../headers/commands/command.h"

void print_help(const char** linked_names,const char** linked_descriptions)
{
	printf("\n<< Sabo ;) aide des commandes >>\n");

	for(int i = 0; i < COUNT_OF_COMMANDS; i++)
		printf("\n  >> (%s) %s\n",linked_names[i],linked_descriptions[i]);

	printf("\n\n");
}