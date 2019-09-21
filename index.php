<?php header('Content-Type: text/html; charset=utf-8');
// подрубаем API
require_once("vendor/autoload.php");
require("hook.php");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// создаем переменную бота

$bot = new \TelegramBot\Api\Client($token);

//https://t.me/socks?server=IP&port=PORT&user=USERNAME&pass=PASSWORD

$admin_id = "";

////////////START/////////////
////////////START///////////////
////////////START///////////////
////////////START///////////////

$bot->command('start', function ($message) use ($bot) {
    
	require("hook.php");
	$id = $message->getChat()->getId();
	$username = $message->getChat()->getUsername();
	$proxy_ip = "xxx.xxx.xxx.xxx";
	$proxy_ip2 = "xxx.xxx.xxx.xxx";
	$proxy_port = "xx";
	$proxy_port2 = "xx";

if($stmt = mysqli_prepare($link, "SELECT * FROM `users` WHERE id = $id")) {
	mysqli_stmt_execute($stmt);
    // Сохранить результат 
    mysqli_stmt_store_result($stmt);  
	
if (mysqli_stmt_num_rows($stmt) == 0){
	$time = time() + 2*3600;
	$date = date("F j, Y, H:i", $time); 
	$time = time();
	
	$link->query("INSERT INTO `users` (`id`, `last_pay`, `vip`, `proxy_user`, `proxy_password`, `reg_date`, `username`, `reg_date_n`) VALUES ('$id', '', '0', '', '', '$date', '$username', '$time')");
	$ans = "Новый пользователь!
<a href=\"https://t.me/".$username."\">@".$username."</a>
Id = $id";
	$bot->sendMessage($admin_id, $ans, "HTML");
	//$mysqli->query("SELECT * FROM `users` WHERE id = $id");
	//$result->close(); 
}

// Закрыть выражение 
mysqli_stmt_close($stmt);
}

	$answer = "Привет! 
Думаю, вы уже наслышаны о блокировке Telegram. Я смогу подключить бесплатный прокси-сервер SOCKS5 для вашего устройства!
Для быстрого подключения прокси, <a href=\"https://t.me/socks?server=".$proxy_ip."&port=".$proxy_port."&user=free&pass=free\">перейдите по этой ссылке</a> и нажмите Включить на КАЖДОМ вашем устройстве.

Этот прокси-сервер позволит не потерять доступ, однако в виду бесплатности и высокой нагрузки на него, иногда подключение может занимать от 3 минут до часа.

Если же вам нужно бесперепобойное и постоянное подключение к прокси-серверу, рекомендуем подключить приватный сервер от <b>39 рублей в месяц</b>, просто введите /proxy и просмотрите информацию
	";
    $bot->sendMessage($message->getChat()->getId(), $answer, 'HTML');

});

//////////////////HELP/////////////////////////
//////////////////HELP///////////////////////////
//////////////////HELP///////////////////////////
//////////////////HELP///////////////////////////

$bot->command('help', function ($message) use ($bot) {
    $answer = "Команды:
/help - помощь
/start - приветственное сообщение
/news - получение новостей
/proxy - информация о подписке на приватный прокси-сервер";

    $bot->sendMessage($message->getChat()->getId(), $answer, "HTML");
});

//////////////////ADMIN///////////////////////////
//////////////////ADMIN///////////////////////////
//////////////////ADMIN///////////////////////////
//////////////////ADMIN///////////////////////////

$bot->command('admin', function ($message) use ($bot) {
	$chatId = $message->getChat()->getId();
	if ($chatId == $admin_id) {
    $answer = "Выберите, что вы хотите сделать";
	
$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
				[
					[
						['callback_data' => 'write', 'text' => 'Написать']
					],
					[
						['callback_data' => 'ban', 'text' => 'Изменить ban']	
					],
					[
						['callback_data' => 'settings', 'text' => 'Настройки']	
					],
					[
						['callback_data' => 'exit_settings', 'text' => 'Выход из настроек']
					],
					
						
				]
			);

$bot->sendMessage($message->getChat()->getId(), $answer, 'HTML', false, null, $keyboard);

}
});

//////////////////////PROXY///////////////////////////
//////////////////////PROXY/////////////////////////////
//////////////////////PROXY/////////////////////////////
//////////////////////PROXY/////////////////////////////

$bot->command('proxy', function ($message) use ($bot) {
	
require("hook.php");	
$id = $message->getChat()->getId();


	
$querr ="SELECT last_pay, proxy_user, proxy_password, vip FROM users WHERE id = $id";
$resultt = mysqli_query($link, $querr);
if($resultt)
{
    //file_put_contents("oo.txt",time());
    while ($row = mysqli_fetch_row($resultt)) {
       $last_pay = $row[0];
	   $proxy_user = $row[1];
	   $proxy_password = $row[2];
	   $vip = $row[3];
    }

    mysqli_free_result($resultt);
}
$proxy_ip = "80.211.12.190";
	$proxy_ip2 = "89.46.65.56";
	$proxy_port = "1080";
	$proxy_port2 = "556";


	$answer = "
Здесь вы можете купить выделенный прокси аккаунт на выделенных серверах, не зависящих от нагрузки.

<b>Преимущества:</b>
- быстрая поддержка <a href='https://tg.topyar.su/support.php'>по этой ссылке</a>
- подключение в один клик
- наименьшая задержка до серверов Telegram
- выделенный канал: на приватном прокси сервере находится намного меньше человек, чем на публичном.
- оплачивая приватный сервер вы помогаете нам сохранить доступ к Telegram для всех бесплатных пользователей. Спасибо вам!
";

	
if ($vip == 0){
	$answer = $answer."
Статус: 
<b>Вы еще не купили подписку на приватный прокси</b>
Чтобы оплатить подписку, нажмите на кнопку ниже";
}
else {
	$date = date("F j, Y, H:i", $last_pay);
	$answer = $answer."
Статус: 
<b>Подписка доступна до</b> <i>".$date." MSK</i> 
<a href=\"https://t.me/socks?server=".$proxy_ip2."&port=".$proxy_port2."&user=".$proxy_user."&pass=".$proxy_password."\">Нажмите на ссылку, чтобы подключить Ваш личный прокси</a>

Продлить подписку:";
}

//$keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(array(array("", "", "", "")), true); // true for one-time keyboard

$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
		[
			[
				['callback_data' => 'pay39', 'text' => '39₽ (1 мес.)'],
				['callback_data' => 'pay119', 'text' => '119₽ (3 мес.)']
				
			],
			[
				['callback_data' => 'pay229', 'text' => '229₽ (6 мес.)'],
				['callback_data' => 'pay429', 'text' => '429₽ (1 год)']
			]
		]
	);


$bot->sendMessage($message->getChat()->getId(), $answer, 'HTML', false, null, $keyboard);

});
////////////////// NEWS ///////////////////
////////////////// NEWS ///////////////////
////////////////// NEWS ///////////////////
////////////////// NEWS ///////////////////

$bot->command('news', function ($message) use ($bot) {
require("hook.php");

$answer = "В мире Telegram становится все больше и больше информации, на которую хочется пролить свет.

Поэтому мы обращаемся к Вам с таким вопросом:
Хотели ли бы Вы получать свежие новости про блокировку Telegram, о её последствиях, о комментариях владельца мессенджера, Павла Дурова?

Мы будем отправлять Вам сообщения не чаще <b>одного раза в два дня.</b>
Ну так что, согласны? :)";
		

			

		$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
				[
					[
						['callback_data' => 'da', 'text' => 'Хочу получать']
						
					],
					[
						['callback_data' => 'net', 'text' => 'Нет, спасибо']
					]
				]
			);

$bot->sendMessage($message->getChat()->getId(), $answer, 'HTML', false, null, $keyboard);

});
///////////////////////Получение ОТВЕТА////////////////////////////
///////////////////////Получение ОТВЕТА////////////////////////////
///////////////////////Получение ОТВЕТА////////////////////////////
///////////////////////Получение ОТВЕТА////////////////////////////
	
$bot->on(function($update) use ($bot, $callback_loc, $find_command){
	require("hook.php");
	$callback = $update->getCallbackQuery();
	$message = $callback->getMessage();
	$chatId = $message->getChat()->getId();
	$data = $callback->getData();
	$id = $chatId;
	
	//Поиск строчки
	$querr ="SELECT n, username, news FROM users WHERE id = $chatId";
	$resultt = mysqli_query($link, $querr);
	if($resultt)
	{
		//file_put_contents("oo.txt",time());
		while ($row = mysqli_fetch_row($resultt)) {

		   $n = $row[0];
		   $username = $row[1];
		   $news = $row[2];
		}
		mysqli_free_result($resultt);
	}
	
	//////////////////ОПЛАТА//////////////////
	//////////////////ОПЛАТА//////////////////
	//////////////////ОПЛАТА//////////////////
	//////////////////ОПЛАТА//////////////////
	$MerchantLogin = "easy_proxy_bot";
	
	$InvId = "$chatId";
	$Password1 = "xxxx";
	$Password2 = "xxxx";
	//$SignatureValue = md5("$MerchantLogin:$OutSum::$Password1");
	
	
	if($data == "pay39"){
		$OutSum = "39";
$SignatureValue = md5("$MerchantLogin:$OutSum::$Password1:Shp_id=$chatId");
		$answer ="Заказ сформирован!
Ваша подписка: <b>39 рублей на 1 месяц</b>

<a href=\"https://auth.robokassa.ru/Merchant/Index.aspx?MerchantLogin=".$MerchantLogin."&OutSum=".$OutSum."&Description=Оплата подписки ".$chatId."&Shp_id=".$chatId."&SignatureValue=".$SignatureValue."\">Нажмите сюда, чтобы оплатить</a>";

		
		//$bot->answerCallbackQuery( $callback->getId(), "This is Ansver!",true);
		$bot->sendMessage($chatId, $answer, "HTML");
		$bot->answerCallbackQuery($callback->getId());
	}
	if($data == "pay119"){
		$OutSum = "119";
$SignatureValue = md5("$MerchantLogin:$OutSum::$Password1:Shp_id=$chatId");
		$answer ="Заказ сформирован!
Ваша подписка: <b>119 рублей на 3 месяца</b>

<a href=\"https://auth.robokassa.ru/Merchant/Index.aspx?MerchantLogin=".$MerchantLogin."&OutSum=".$OutSum."&Description=Оплата подписки ".$chatId."&Shp_id=".$chatId."&SignatureValue=".$SignatureValue."\">Нажмите сюда, чтобы оплатить</a>";
		
		$bot->sendMessage($chatId, $answer, "HTML");
		$bot->answerCallbackQuery($callback->getId()); // можно отослать пустое, чтобы просто убрать "часики" на кнопке
	}
	if($data == "pay229"){
		$OutSum = "229";
$SignatureValue = md5("$MerchantLogin:$OutSum::$Password1:Shp_id=$chatId");
		$answer ="Заказ сформирован!
Ваша подписка: <b>229 рублей на 6 месяцев</b>

<a href=\"https://auth.robokassa.ru/Merchant/Index.aspx?MerchantLogin=".$MerchantLogin."&OutSum=".$OutSum."&Description=Оплата подписки ".$chatId."&Shp_id=".$chatId."&SignatureValue=".$SignatureValue."\">Нажмите сюда, чтобы оплатить</a>";

		$bot->sendMessage($chatId, $answer, "HTML");
		$bot->answerCallbackQuery($callback->getId()); // можно отослать пустое, чтобы просто убрать "часики" на кнопке
	}
	if($data == "pay429"){
		$OutSum = "429";
$SignatureValue = md5("$MerchantLogin:$OutSum::$Password1:Shp_id=$chatId");
		$answer ="Заказ сформирован!
Ваша подписка: <b>429 рублей на 1 год</b>

<a href=\"https://auth.robokassa.ru/Merchant/Index.aspx?MerchantLogin=".$MerchantLogin."&OutSum=".$OutSum."&Description=Оплата подписки ".$chatId."&Shp_id=".$chatId."&SignatureValue=".$SignatureValue."\">Нажмите сюда, чтобы оплатить</a>";
		
		$bot->sendMessage($chatId, $answer, "HTML");
		$bot->answerCallbackQuery($callback->getId()); // можно отослать пустое, чтобы просто убрать "часики" на кнопке
	}
	/////////////ПОДПИСКА НА НОВОСТИ//////////////////
	/////////////ПОДПИСКА НА НОВОСТИ//////////////////
	/////////////ПОДПИСКА НА НОВОСТИ//////////////////
	/////////////ПОДПИСКА НА НОВОСТИ//////////////////

	if($data == "da"){
		
		$answer = "Хорошо! Ждите новостей :)";
		//$bot->answerCallbackQuery( $callback->getId(), "This is Ansver!",true);
		
		if ($news != 1) {
		$link->query("UPDATE `users` SET `news` = '1' WHERE `users`.`n` = $n;");
		$bot->sendMessage($chatId, $answer, "HTML");
		
		$bot->sendMessage($admin_id, "@$username подписался на новости!\nId = $id\nn = $n", "HTML");
		}
		
		$bot->answerCallbackQuery($callback->getId());
	}
	if ($data == "net") {
		
		$answer = "Мы Вас поняли. Новости приходить больше не будут :)";
		//$bot->answerCallbackQuery( $callback->getId(), "This is Ansver!",true);
		
		if ($news != -1) {
		$link->query("UPDATE `users` SET `news` = '-1' WHERE `users`.`n` = $n;");
		$bot->sendMessage($chatId, $answer, "HTML");
		
		$bot->sendMessage($admin_id, "@$username отписался от новостей(\nId = $id\nn = $n", "HTML");
		}
		
		$bot->answerCallbackQuery($callback->getId());
	}
	
////////////////////////////////////////////////////////////////////////////////////////////////////
///ADMIN/////ADMIN///////ADMIN//////ADMIN//////ADMIN//////ADMIN/////ADMIN/////ADMIN///////ADMIN/////
///ADMIN/////ADMIN///////ADMIN//////ADMIN//////ADMIN//////ADMIN/////ADMIN/////ADMIN///////ADMIN/////
///ADMIN/////ADMIN///////ADMIN//////ADMIN//////ADMIN//////ADMIN/////ADMIN/////ADMIN///////ADMIN/////
////////////////////////////////////////////////////////////////////////////////////////////////////
	//Получение админских настроек
	$querr ="SELECT settings, news, ban, command FROM admin WHERE n = 1";
	$resultt = mysqli_query($link, $querr);
	if($resultt)
	{
		while ($row = mysqli_fetch_row($resultt)) {

		   $settings_adm = $row[0];
		   $news_adm = $row[1];
		   $ban_adm = $row[2];
		   $command_adm = $row[3];
		}
		mysqli_free_result($resultt);
	}
	//Получили
//////BAN//////

//Команда ban
if ($data == "ban" && $chatId == $admin_id) {
		$link->query("UPDATE `admin` SET `ban` = '1' WHERE `admin`.`n` = 1;");
		
		$answer = "Введите id аккаунта, для которого изменяем ban";
		//$bot->answerCallbackQuery( $callback->getId(), "This is Ansver!",true);
		$bot->sendMessage($chatId, $answer, "HTML");
		$bot->answerCallbackQuery($callback->getId());
	}
//Забанить
if ($data == "ban_yes" && $chatId == $admin_id) {
		
		//Если есть в базе
		if($link->query("UPDATE `users` SET `ban` = '1' WHERE `users`.`id` = $command_adm;")) {
		$answer = "Пользователь Id = $command_adm забанен";
		$bot->sendMessage($chatId, $answer, "HTML");
		$bot->answerCallbackQuery($callback->getId());
		
		} //Если нет в базе
		else {
			$answer = "Пользователя с Id = $command_adm в базе нет. Попробуйте еще или выйдите из настроек";
		$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
			[
				[
					['callback_data' => 'exit_settings', 'text' => 'Выход из настроек']	
				]
			]
		);
		$bot->sendMessage($message->getChat()->getId(), $answer, 'HTML', false, null, $keyboard);
		$bot->answerCallbackQuery($callback->getId());
	}
	
}
//Разбанить
if ($data == "ban_no" && $chatId == $admin_id) {
		
		 
		
		//$bot->answerCallbackQuery( $callback->getId(), "This is Ansver!",true);
		
		//Если есть в базе
		if($link->query("UPDATE `users` SET `ban` = '0' WHERE `users`.`id` = $command_adm;")) {
		$answer = "Пользователь Id = $command_adm разбанен";
		$bot->sendMessage($chatId, $answer, "HTML");
		$bot->answerCallbackQuery($callback->getId());
		
		} //Если нет в базе
		else {
			$answer = "Пользователя с Id = $command_adm в базе нет. Попробуйте еще или выйдите из настроек";
		$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
			[
				[
					['callback_data' => 'exit_settings', 'text' => 'Выход из настроек']	
				]
			]
		);
		$bot->sendMessage($message->getChat()->getId(), $answer, 'HTML', false, null, $keyboard);
		$bot->answerCallbackQuery($callback->getId());
	}
	
}
//WRITE//
if ($data == "write" && $chatId == $admin_id) {
		$link->query("UPDATE `admin` SET `news` = '1' WHERE `admin`.`n` = 1;");
		
		$answer = "Введите n аккаунта, кому написать";
		//$bot->answerCallbackQuery( $callback->getId(), "This is Ansver!",true);
		$bot->sendMessage($chatId, $answer, "HTML");
		$bot->answerCallbackQuery($callback->getId());
	}
//Выход из настроек
if ($data == "exit_settings" && $chatId == $admin_id) {
		
		
		$answer = "Вы вышли из admin панели";
		//$bot->answerCallbackQuery( $callback->getId(), "This is Ansver!",true);
		$bot->sendMessage($chatId, $answer, "HTML");
		$bot->answerCallbackQuery($callback->getId()); // можно отослать пустое, чтобы просто убрать "часики" на кнопке
		
		$link->query("UPDATE `admin` SET `ban` = '0', `news` = '0', `settings` = '0', `command` = '', `command2` = '' WHERE `admin`.`n` = 1;");
}

///////////////////////////////////////END ADMIN////////////////////////////////////
///////////////////////////////////////END ADMIN////////////////////////////////////
///////////////////////////////////////END ADMIN////////////////////////////////////
///////////////////////////////////////END ADMIN////////////////////////////////////

}, function($update) {
	$callback = $update->getCallbackQuery();
	if (is_null($callback) || !strlen($callback->getData()))
		return false;
	return true;
});

//ОБРАБОТКА ADMIN ОТВЕТОВ

//Отправка подтверждения

$bot->on(function($Update) use ($bot){
	require("hook.php");
	//$bot->sendMessage($admin_id, 'tut est', 'HTML');
    $callback = $Update->getCallbackQuery();
	$message_upd = $Update->getMessage();
	$chatId_upd = $message_upd->getChat()->getId();
	$text_upd = $message_upd->getText();

    try {

        $bot->sendMessage($admin_id, "$callback", 'HTML');
        //$bot->answerCallbackQuery($callback->getId(), "This is Answer!",true);

    }
    catch (Exception $e) {
        $s = $e->getMessage();
        $bot->sendMessage($admin_id, "$s", 'HTML');
    }
	//Получение админских настроек
	$querr ="SELECT settings, news, ban, command FROM admin WHERE n = 1";
	$resultt = mysqli_query($link, $querr);
	if($resultt)
	{
		//file_put_contents("oo.txt",time());
		while ($row = mysqli_fetch_row($resultt)) {

		   $settings_adm = $row[0];
		   $news_adm = $row[1];
		   $ban_adm = $row[2];
		   $command_adm = $row[3];
		}
		mysqli_free_result($resultt);
	}
	//Получили
	
if ($chatId_upd == $admin_id && $ban_adm == '1') {
		if(is_numeric ($text_upd)){
	$answer = "Что делаем с Id = $text_upd?";
	$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
			[
				[
					['callback_data' => 'ban_yes', 'text' => 'Забанить']	
				],
				[
					['callback_data' => 'ban_no', 'text' => 'Разбанить']	
				],
				[
					['callback_data' => 'exit_settings', 'text' => 'Выход из настроек']	
				]
			]
		);
	 
	$link->query("UPDATE `admin` SET `command` = '$text_upd' WHERE `admin`.`n` = 1;");

	$bot->sendMessage($message_upd->getChat()->getId(), $answer, 'HTML', false, null, $keyboard);
	}
	else {
		
		$answer = "Вы ввели что-то другое. Попробуйте еще или выйдите из настроек";
		$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
			[
				[
					['callback_data' => 'exit_settings', 'text' => 'Выход из настроек']	
				]
			]
		);
		$bot->sendMessage($message_upd->getChat()->getId(), $answer, 'HTML', false, null, $keyboard);
	}
}
//WRITE
//Ищем пользователя

if ($news_adm == '1') {
	if ($command_adm == "" && $chatId_upd = $admin_id) $text_n = $text_upd;
	else $text_n = $command_adm;
	$querr = "SELECT id, username FROM users WHERE n = $text_n;";
	$resultt = mysqli_query($link, $querr);
	if($resultt)
	{
		while ($row = mysqli_fetch_row($resultt)) {
		   $id = $row[0];
		   $username = $row[1];
		   }
		mysqli_free_result($resultt);
		
	}
	
	if ($chatId_upd == $admin_id  && $command_adm == "") {
		$link->query("UPDATE `admin` SET `command` = '$text_upd' WHERE `admin`.`n` = 1;");
		$answer = "Общаемся с @$username | id = $id

$command_adm";
		$bot->sendMessage($admin_id, $answer, "HTML");
	}
	else if ($chatId_upd == $admin_id && $command_adm != "") {
		$answer = $text_upd;
		$bot->sendMessage($id, $answer, "HTML");
	}
	else if ($chatId_upd == $id) {
		
		$answer = "Сообщение @$username | id = $id

$text_upd";
		$bot->sendMessage($admin_id, $answer, "HTML");
	}
}
 
}, function($message_upd) use ($bot) {
	
	$callback = $message_upd->getCallbackQuery();
  if (is_null($callback) || !strlen($callback->getData()))
    return true;
  return false;
});



// запускаем обработку
try {
	$bot->run();

}
catch (Exception $e) {
    echo "Исключение: ", $e->getMessage(), "\n";
}
?>

<html>
	<head>
		<title>Бесплатный прокси-сервер Telegram</title>
		<link rel="stylesheet" type="text/css" href="/style/main2.css" />
	</head>
	<body>
		<div class="head" onclick="location.href='/index.php';">
			<div class="textup">
				<p>Приватный proxy для Telegram</p>
				</div>
		</div>
		<div class="main">
			<div class="textup">
				<h2>Инструкция</h2>
				1. Если у вас уже не работает Telegram, <a href="tg://socks?server=80.211.12.190&port=1080&user=free&pass=free">нажмите здесь</a><br>
				2. Обязательно напишите нашему боту в Telegram - <a href='tg://resolve?domain=easyproxy_bot'>@easyproxy_bot</a>, чтобы всегда иметь бесплатный прокси.
				<br> <br> <br>
				<a href="tg://resolve?domain=Top_Yar">Техническая поддержкa<a>
			 </div>
		</div>
	</body>
</html>
