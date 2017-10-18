<?php

	$host = "10.8.1.10"; /*Имя сервера*/
	$user = "u1051";  /*Имя пользователя*/
	$pswd = "r4qfDfQBqw86hEJc";  /*Пароль пользователя*/
	$db = "db1051";    /*Имя базы данных*/

	$link = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
			mysql_select_db($db) 			   or die("Не могу подключиться к базе.");
			mysql_query('SET NAMES utf8');

	$_POST['Plants'] = mysql_real_escape_string(strip_tags(htmlspecialchars($_POST['Plants'])));
	$_POST['Sort'] = mysql_real_escape_string(strip_tags(htmlspecialchars($_POST['Sort'])));

	$query ="SELECT * FROM dle_seeds_list WHERE area LIKE '%".$_POST['Area']."%' AND sorts LIKE '%".$_POST['Sort']."'";
	$res = mysql_query($query) or die("Ошибка в запросе!" . mysql_error($link));
	
	echo '<table border="1" cellpadding="7" cellspacing="0">
			<tr>
				<td colspan="9" align="center" width="700" style="font-size: 20px; font-weight: bold; color: #7b3f00; background-color: #f8f8ff; border: 1px solid gray; ">Toxum satış yerləri</td>
			</tr>
			<tr>
				<td valign="top" align="center" width="3%" style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">№</td>
				<td valign="top" align="center" width="13%" style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">Rayon</td>
				<td valign="top" align="center" width="20%" style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">Soyadı, Adı</td>
				<td valign="top" align="center" width="5%" style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">Şəh. №</td>
				<td valign="top" align="center" width="15%" style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">Verilmə tarixi</td>
				<td valign="top" align="center" width="10%" style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">Bitki</td>
				<td valign="top" align="center" width="15%" style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">Sort</td>
				<td valign="top" align="center" width="4%" style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">R-sı</td>
				<td valign="top" align="center" width="15%" style="font-weight: bold; border: 0; border-bottom: 1px solid gray;">Əlaqə nömrəsi</td>
			</tr>';
				
			while($row = mysql_fetch_array($res))
			{
				echo '<tr>';
			    echo '<td valign="top" align="center" width="3%" style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['id'].'</td>';
				echo '<td valign="top" align="center" width="10%" style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['area'].'</td>';
				echo '<td valign="top" align="center" width="20%" style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['chiefname'].'</td>';
				echo '<td valign="top" align="center" width="5%" style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['attnum'].'</td>';
				echo '<td valign="top" align="center" width="18%" style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['attdate'].'</td>';
				echo '<td valign="top" align="center" width="10%" style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['plants'].'</td>';
			    echo '<td valign="top" align="center" width="15%" style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['sorts'].'</td>';
			    echo '<td valign="top" align="center" width="4%" style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['rsi'].'</td>';
			    echo '<td valign="top" align="center" width="15%" style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; ">'.$row['contacts'].'</td>';
				echo '</tr>';
			}
			
	echo '</table>';
			
	mysql_close($link);