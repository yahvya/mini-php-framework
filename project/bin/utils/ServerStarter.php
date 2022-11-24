<?php

namespace Sabo;

class ServerStarter extends AbstractCommand
{
	public static function exec_command(int $argc, array $argv, string $project_root_path):void
	{
		exec("php -S 127.0.0.1:8000");
	}
}