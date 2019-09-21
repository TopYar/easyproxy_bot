<?php 
//https://tg.topyar.su/success.php?inv_id=63968879&InvId=63968879&out_summ=37.000000&OutSum=37.000000&crc=aa467ad83d309c1a0f3b2b9da16ef6bd&SignatureValue=aa467ad83d309c1a0f3b2b9da16ef6bd&Culture=ru&shp_id=201323005
//https://auth.robokassa.ru/Merchant/Index.aspx?MerchantLogin=easy_proxy_bot&OutSum=37&Description=%D0%9E%D0%BF%D0%BB%D0%B0%D1%82%D0%B0%20%D0%BF%D0%BE%D0%B4%D0%BF%D0%B8%D1%81%D0%BA%D0%B8&shp_id=201323005&SignatureValue=133c095700bff0307058221138e2615d


//https://tg.topyar.su/success.php?inv_id=316924433&InvId=316924433&out_summ=37.000000&OutSum=37.000000&crc=fba6d4f1c386b70711075e7aba5fc230&SignatureValue=fba6d4f1c386b70711075e7aba5fc230&Culture=ru&shp_id=201323005
//https://auth.robokassa.ru/Merchant/Index.aspx?MerchantLogin=easy_proxy_bot&OutSum=37&Description=%D0%9E%D0%BF%D0%BB%D0%B0%D1%82%D0%B0%20%D0%BF%D0%BE%D0%B4%D0%BF%D0%B8%D1%81%D0%BA%D0%B8&shp_id=201323005&SignatureValue=133c095700bff0307058221138e2615d


$InvId = htmlspecialchars($_GET['InvId']);
$OutSum = htmlspecialchars($_GET['OutSum']);
$chatId = htmlspecialchars($_GET['Shp_id']);
$MerchantLogin = 'easy_proxy_bot';
$SignatureValue = htmlspecialchars($_GET['SignatureValue']);


$Password1 = "xxx";
$Password2 = "xxx";

$SignatureValue2 = md5("$OutSum:$InvId:$Password2:Shp_id=$chatId");
$SignatureValue2 = mb_strtoupper($SignatureValue2);
$id = $chatId;

settype($OutSum, "integer");
if($SignatureValue == $SignatureValue2) {
	
	require_once("vendor/autoload.php");
	require("hook.php");
	
	
	$querr ="SELECT last_pay, proxy_user, proxy_password, vip, n, all_sum FROM users WHERE id = $id";
	$resultt = mysqli_query($link, $querr);
	if($resultt)
	{
		//file_put_contents("oo.txt",time());
		while ($row = mysqli_fetch_row($resultt)) {
		   $last_pay = $row[0];
		   $proxy_user = $row[1];
		   $proxy_password = $row[2];
		   $vip = $row[3];
		   $n = $row[4];
		   $all_sum = $row[5];
		}

		mysqli_free_result($resultt);
	}
	

	if ($OutSum == 39) {
		$plus = 2592000;
		$all_sum = $all_sum + 39;
	}
	else if ($OutSum == 119) {
		$plus = 7776000;
		$all_sum = $all_sum + 119;
	}
	else if ($OutSum == 229) {
		$plus = 15552000;
		$all_sum = $all_sum + 229;
	}
	else if ($OutSum == 429) {
		$plus = 31104000;
		$all_sum = $all_sum + 429;
	}
	
	
	$check = 0;
	if ($result = $link->query("SELECT n FROM payments WHERE InvId = $InvId and id = $chatId")) {
	
    /* determine number of rows result set */
    $check = $result->num_rows;
	

    /* close result set */
    $result->close();
}
	
	if($check == 0) { //Если такой оплаты не было
	
	
	if ($vip == 0) {
		
		
		$time = time() + $plus;
///////////////////////////////////////PROXY + MySQL////////////////////////////////////		
///////////////////////////////////////PROXY + MySQL////////////////////////////////////			
///////////////////////////////////////PROXY + MySQL////////////////////////////////////			
		$user = md5("$id");
		$password = md5("Hello:$id");
		
		$link->query("UPDATE `users` SET `last_pay` = '$time', `vip` = '1', `proxy_user` = '$user', `proxy_password` = '$password', `all_sum` = '$all_sum' WHERE `users`.`n` = $n;");
		//$link->query("INSERT INTO `users` (`n`,`id`, `last_pay`, `vip`, `proxy_user`, `proxy_password`, `reg_date`) VALUES ('$id', '', '0', '', '', '$date')");
		
		$time = time() + 2*3600;
		$date = date("F j, Y, H:i", $time); 
		
		$link->query("INSERT INTO `payments` (`sum`, `date`, `id`, `InvId`) VALUES ('$OutSum', '$date', '$id', '$InvId')");

$connection = ssh2_connect('xxx', 22);
//echo "$user <br>";

if (ssh2_auth_password($connection, 'xxx', 'xxx')) {
//echo "Успешная аутентификация!<br>";

if (ssh2_exec($connection, "useradd --shell /usr/sbin/nologin $user")){
	//echo "useradd --shell /usr/sbin/nologin $user <br>";
}
if(ssh2_exec($connection, "/var/tmp/pass.sh $user $password")){
	//echo "Пароль мб установлен<br>";
}
}
else {
//die('Неудачная аутентификация...');
}
///////////////////////////////////////PROXY + MySQL////////////////////////////////////		
///////////////////////////////////////PROXY + MySQL////////////////////////////////////		
///////////////////////////////////////PROXY + MySQL////////////////////////////////////		
	}
	else {
		
		$time = $last_pay + $plus;
		$link->query("UPDATE `users` SET `last_pay` = '$time', `all_sum` = '$all_sum', `vip` = '1' WHERE `users`.`n` = $n;");
		
		$time = time() + 2*3600;
		$date = date("F j, Y, H:i", $time); 
		
		$link->query("INSERT INTO `payments` (`sum`, `date`, `id`, `InvId`) VALUES ('$OutSum', '$date', '$id', '$InvId')");
		
	}
	
	


// создаем переменную бота
$bot = new \TelegramBot\Api\Client($token);
$answer = "<b>Подписка оплачена!</b>

Перейдите /proxy для дополнительной информации";

$bot->sendMessage($id, $answer, 'HTML');
	} //Если такой оплаты не было
}


echo "OK$InvId";

?>
