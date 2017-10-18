<?php

	$host = "10.8.1.10"; /*Имя сервера*/
	$user = "u1051";  /*Имя пользователя*/
	$pswd = "r4qfDfQBqw86hEJc";  /*Пароль пользователя*/
	$db = "db1051";    /*Имя базы данных*/

	$link = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
			mysql_select_db($db) 			   or die("Не могу подключиться к базе.");
			mysql_query('SET NAMES utf8');

if(isset($_POST['ajax_plant'])){
	$_POST['ajax_plant'] =  mysql_real_escape_string(strip_tags(htmlspecialchars(trim($_POST['ajax_plant']))));

	$res='<option>Sortun adını seçin ...</option>';
	$q = mysql_query("SELECT name FROM dle_rosters_list WHERE plant LIKE '%".$_POST['ajax_plant']."%' ");
	
	while($r = mysql_fetch_object($q) )
		$res.='<option value="'.$r->name.'">'.$r->name.'</option>';

	print $res;

}else{

	$_POST['Plant'] = mysql_real_escape_string(strip_tags(htmlspecialchars($_POST['Plant'])));
	$_POST['Sort'] = mysql_real_escape_string(strip_tags(htmlspecialchars($_POST['Sort'])));

	$query ="SELECT * FROM dle_rosters_list WHERE plant LIKE '%".$_POST['Plant']."%' AND name LIKE '%".$_POST['Sort']."'";
	$res = mysql_query($query) or die("Ошибка в запросе!" . mysql_error($link));
	
	echo '<table border="1" cellpadding="7" cellspacing="0" width="100%">
			<tr>
				<td colspan="9" align="center" width="700" style="font-size: 20px; font-weight: bold; color: #7b3f00; background-color: #f8f8ff; border: 1px solid gray; ">Dövlət reyestri</td>
			</tr>
			<tr>
				<td valign="top" align="center" width="3%" style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">№</td>
				<td valign="top" align="center"  style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">Bitkinin adı</td>
				<td valign="top" align="center"  style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">Sortun kodu</td>
				<td valign="top" align="center" style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">Sotun adı</td>
				<td valign="top" align="center"  style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">Sortun yetişkənliyi</td>
				<td valign="top" align="center" style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">Sortun orginatoru (patent sahibi)</td>
				<td valign="top" align="center" " style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">Dövlət reyestrinə daxil edildiyi il</td>
				<td valign="top" align="center" style="font-weight: bold; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray;">Sortun rayonlaşdı-rıldığı zonalar</td>
			</tr>';
				
			while($row = mysql_fetch_array($res))
			{
				echo '<tr>';
			    echo '<td valign="top" align="center" width="3%" style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['id'].'</td>';
				echo '<td valign="top" align="center"  style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['plant'].'</td>';
				echo '<td valign="top" align="center"  style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['code'].'</td>';
				echo '<td valign="top" align="center"  style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['name'].'</td>';
				echo '<td valign="top" align="center"  style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['grown'].'</td>';
				echo '<td valign="top" align="center"  style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['patent'].'</td>';
			    echo '<td valign="top" align="center"  style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['register'].'</td>';
			    echo '<td valign="top" align="center"  style="font-size: 2.25vw; border: 0; border-bottom: 1px solid gray; border-right: 1px solid gray; ">'.$row['zone'].'</td>';
				echo '</tr>';
			}
			
	echo '</table>';

}
			
	mysql_close($link);