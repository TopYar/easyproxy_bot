<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once("vendor/autoload.php");
require("hook.php");




// ?bot

$bot = new \TelegramBot\Api\Client($token);
$proxy_ip = "xxx";
$proxy_port = "x";
$admin_id = "x";

$time = time();
$querr ="SELECT id, proxy_user, username, last_pay, vip, n FROM users WHERE $time >= `users`.`last_pay` - 259200";
$resultt = mysqli_query($link, $querr);
if($resultt)
{

    while ($row = mysqli_fetch_row($resultt)) {
       $id = $row[0];
	   $proxy_user = $row[1];
	   $username = $row[2];
	   $last_pay = $row[3];
	   $vip = $row[4];
	   $n = $row[5];
	   
		if (($time >= (int)$last_pay - 259200) && ($time < $last_pay) && $vip == 1) {
			$link->query("UPDATE `users` SET `vip` = '2' WHERE `users`.`n` = $n;");
			$answer = "У @$username 3 дня до конца подписки.
Id = $id
n = $n";
			
			$bot->sendMessage($admin_id, $answer, "HTML");
			$date = date("F j, Y, H:i", $last_pay);
			$answer = "У Вас <b>заканчивается</b> подписка на приватный прокси-сервер.
			
Статус: 
<b>Подписка доступна до</b> <i>".$date." MSK</i>

Позаботьтесь о продлении заранее! Напишите - /proxy";


			$bot->sendMessage($id, $answer, "HTML");
		}
		else if ( $time >= $last_pay && $vip == 2 ) {
			$link->query("UPDATE `users` SET `vip` = '0' WHERE `users`.`n` = $n;");
			$answer = "У @$username закончилась подписка.
Id = $id
n = $n";
			
			$bot->sendMessage($admin_id, $answer, "HTML");
			$answer = "У Вас <b>закончилась</b> подписка на приватный прокси-сервер.

Всегда доступная ссылка на инструкцию по подключению бесплатного прокси <a href=\"https://tg.topyar.su\">tg.topyar.su</a>
			
Хотите продлить подписку на выделенный прокси? Напишите - /proxy";
			$bot->sendMessage($id, $answer, "HTML");
				
				$connection = ssh2_connect('xxx', 22);
				if (ssh2_auth_password($connection, 'xxx', 'xxx')) {
				echo "Успешная аутентификация!<br>";

				if (ssh2_exec($connection, "deluser -f $proxy_user")){
					//echo "deluser $proxy_user<br>";
					$answer = "$proxy_user";
			
				$bot->sendMessage($admin_id, $answer, "HTML");
				}
				}
				else {
				//die('Неудачная аутентификация...');
				}
		}
		
    }

    mysqli_free_result($resultt);
}


/////////////////ЧЕРЕЗ ДЕНЬ ПОСЛЕ РЕГИСТРАЦИИ//////////////////////
///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
$querr ="SELECT id, proxy_user, username, last_pay, vip, n, reg_date_n FROM users WHERE reg_date_n > 0";
$resultt = mysqli_query($link, $querr);
if($resultt && false)
{
	


    while ($row = mysqli_fetch_row($resultt)) {
       $id = $row[0];
	   $proxy_user = $row[1];
	   $username = $row[2];
	   $last_pay = $row[3];
	   $vip = $row[4];
	   $n = $row[5];
	   $reg_date_n = $row[6];
	   
		if (($time > ($reg_date_n + 86400)) && $vip == 0) {
			//echo "$id <br>";
			$answer = "Недавно в Telegram появилась возможность добавлять и сохранять несколько прокси, с дальнейшим выбором желаемого подключения.
Найти это окно можно, нажав на щит в правом верхнем углу, находясь на \"главной\" приложения (перед этим обновите приложение Telegram).

Ниже мы прислали скриншот, для сравнения наших приватного и публичного прокси с другим популярным публичным прокси для Telegram. Делайте выводы сами 😁

Если хотите получить более <b>быстрый доступ, выделенный приватный прокси</b> и поддержать наш бесплатный прокси для всех пользователей, оплатите подписку всего <b>от 39 рублей в месяц 🔥</b> 
Для более подробной информации введите /proxy";
try {
    $bot->sendMessage($id, $answer, "HTML");
		$pic = "https://tg.topyar.su/images/proxy3.jpg";
		$bot->sendPhoto($id, $pic);
		$link->query("UPDATE `users` SET `reg_date_n` = '0' WHERE `users`.`n` = $n;");
		
		$answer = "@$username получил скриншот.
Id = $id
n = $n";
			
			$bot->sendMessage($admin_id, $answer, "HTML");
} catch (Exception $e) {
	//echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
    $answer = "Выброшено исключение при отправке скриншота: 
id = <b>$id</b>

".$e->getMessage(). "\n\n";
	$bot->sendMessage($admin_id, $answer, "HTML");
	$link->query("UPDATE `users` SET `reg_date_n` = '-1' WHERE `users`.`n` = $n;");
}
		
		}
		
    }

    mysqli_free_result($resultt);
}

?>
