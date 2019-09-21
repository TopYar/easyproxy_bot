<?php require_once("vendor/autoload.php");
require("hook.php");
/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/

// ?bot

$bot = new \TelegramBot\Api\Client($token);
$proxy_ip = "x";
	$proxy_ip2 = "x";
	$proxy_port = "x";
	$proxy_port2 = "x";

$querr ="SELECT id, proxy_user, proxy_password FROM users WHERE n = 93";
//$querr ="SELECT id, proxy_user, proxy_password, last_pay FROM users WHERE vip = 1";
$resultt = mysqli_query($link, $querr);
if($resultt)
{


    while ($row = mysqli_fetch_row($resultt)) {
       $id = $row[0];
	   $proxy_user = $row[1];
	   $proxy_password = $row[2];
		$last_pay = $row[3];
		
		$date = date("F j, Y, H:i", $last_pay);
		echo "$id<br>";
		
		
		$answer = "Sample Text";
		try {
    $bot->sendMessage($id, $answer, "HTML");
		//$pic = "https://tg.topyar.su/images/proxy3.jpg";
		//$bot->sendPhoto($id, $pic);
} catch (Exception $e) {
    $answer = "Выброшено исключение при отправке скриншота: 
id = <b>$id</b>

".$e->getMessage(). "\n\n";

	echo $answer;
	$bot->sendMessage('xxx', $answer, "HTML");
	$link->query("UPDATE `users` SET `reg_date_n` = '-1' WHERE `users`.`n` = $n;");
}
		
    }

    mysqli_free_result($resultt);
}

$time = time();
$date = date("F j, Y, H:i", $time);
echo "<br> $time <br> $date <br><br>";

?>
