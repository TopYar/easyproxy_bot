<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

class myCustomCommand extends UserCommand {
	protected $name = 'mycustomcommand';
	protected $description = 'Для тестирования';
	protected $usage = '/mycustomcommand';
	protected $version = '1.0.0';

	public function execute()
	{	
		// Основной код
		return Request::sendMessage('Hello');
	}
}