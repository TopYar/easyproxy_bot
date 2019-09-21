<?php 
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
	?>
