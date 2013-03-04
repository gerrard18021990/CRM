<?php
//Строка запроса
$zapros = $_POST['zapros'];

include_once('config.php');
$conf = new JConfig;
$host = $conf->host;
$login = $conf->user;
$pass = $conf->password;
$base = $conf->db;

mysql_connect($host, $login, $pass);
mysql_select_db($base);
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

//Сохранение нового клиента + его счета в базу данных
if($zapros == 'save_all'){
	$a = 1;
	
	$surmane = $_POST['surmane'];
	$name = $_POST['name'];
	$otch = $_POST['otch'];
	$photo = $_POST['photo'];
	$email = $_POST['email'];
	$passport = $_POST['passport'];
	$output = $_POST['output'];
	$date_pas = $_POST['date_pas'];
	$date = $_POST['date'];
	$address = $_POST['address'];
	$telephone = $_POST['telephone'];
	if($telephone != '') $telephone = '+7'.$telephone;
	$note_k = $_POST['note_k'];
	//Сохранение телефонов
	/*
	$kol_tel = $_POST['k_telephone'];
	for($i=1;$i<=$kol_tel;$i++){
		$t = "t".$i;
		$n = "n".$i;
		$a[1] = $_POST[$t];
		$a[2] = $_POST[$n];
		$s = serialize($a);
		$telephone["$i"] = $s;
	}
	$a = 1;
	$tel = serialize($telephone);
	*/
	$skype = $_POST['skype'];
	$icq = $_POST['icq'];
	$facebook = $_POST['facebook'];
	$od_cl = $_POST['od_cl'];
	$twitter = $_POST['twitter'];
	$mail = $_POST['mail'];
	$vk = $_POST['vk'];
	$city = $_POST['city'];

	$id_reg = $_POST['id_reg'];
	$id_obj = $_POST['id_obj'];
	$id_room = $_POST['id_room'];
	$C = $_POST['C'];
	$sum = $_POST['sum'];
	$note = $_POST['note'];
	$days = $_POST['days'];
	$date_z = $_POST['date_z'];
	$today = $_POST['today'];
	$manager = $_POST['manager'];
	if(is_numeric($sum)){
		$bonus = (int)$sum * 0.02;
		if(!mysql_query("INSERT INTO klient(surname, name, otch, photo, telephone, date, address, city, email, passport, output, date_pas, note, skype, icq, fb, od_cl, tw, mail, vk) VALUES ('$surmane', '$name', '$otch', '$photo', '$telephone', '$date', '$address', '$city', '$email', '$passport', '$output', '$date_pas', '$note_k', '$skype', '$icq', '$facebook', '$od_cl', '$twitter', '$mail', '$vk')")) $a = 0;
		$last_id = mysql_insert_id();
		if(!mysql_query("INSERT INTO reckoning(date, date_z, days, id_reg, id_obj, id_room, sum, 1C, note, turist, manager) VALUES ('$today', '$date_z', '$days', '$id_reg', '$id_obj', '$id_room', '$sum', '$C', '$note', '$last_id', '$manager')")) $a = 0;
		$last_id_s = mysql_insert_id();
		if(!mysql_query("INSERT INTO bonus(date, schet, turist, sum) VALUES ('$today', '$last_id_s', '$last_id', '$bonus')")) $a = 0;	
	}
	else $a = 2;
	
	

	echo $a;
	mysql_close();
	
//Выбор регионов
}elseif($zapros == 'sel_reg'){
	$res = mysql_query("SELECT Count(*) FROM region");
	$a = mysql_fetch_row($res);
	$max_id = $a[0];
	$res = mysql_query("SELECT id,name FROM region WHERE active=0");
	echo "<table>";
	while($a = mysql_fetch_assoc($res)){
		echo "<tr id=str".$a['id'].">";
		echo "<td class='td_left'><img src='images/trash.jpg' class='trash' onclick='reg_to_archive(".$a['id'].")' title='В архив'  /></td>";
		echo "<td class='td_left'><span style='cursor: pointer' onclick='sel_object(".$a['id'].")' >".$a['name']."</span></td>";
		echo "</tr>";
	}
	$max_id++;
	echo "</table><table>";
	echo "<tr id='str".$max_id."'><td><input type='text' id='new_reg".$max_id."' class='input_text' /></td><td><input type='button' onclick='save_new_reg(".$max_id.")' value='Добавить' title='Новый регион' class='button_s' /></td></tr>";
	echo "</table>";
	mysql_close();
//Функция добавления региона в архив.
}elseif($zapros == 'reg_to_archive'){
	$id_reg = $_POST['id_reg'];
	mysql_query("UPDATE region SET active=1 WHERE id='$id_reg'");
	mysql_close();
//Функция выбора объектов
}elseif($zapros == 'sel_obj'){
	$id_reg = $_POST['id_reg'];
	$res = mysql_query("SELECT id,name FROM region WHERE active=0");
	echo "<table><tr><td class='td_left' width='100px'><span><strong>Регион</strong></span></td><td><select title='Выбрать регион' class='slct' id='select_region' onclick='sel_object()' onkeypress='sel_object()' onchange='sel_object()'  onkeyup='sel_object()'  >";
	$s = 0;
	while($a = mysql_fetch_assoc($res)){
		if($a['id'] == $id_reg) $s = 'selected';
		else $s = '';
		echo "<option ".$s." value=".$a['id'].">".$a['name']."</option>";
	}
	echo "</tr></table>";
	//Список объектов отрисовывается, если выбран регион
	if($id_reg>0){
		$res = mysql_query("SELECT Count(*) FROM object");
		$a = mysql_fetch_row($res);
		$max_id = $a[0];
		$res = mysql_query("SELECT id,name FROM object WHERE active=0 AND id_reg='$id_reg'");
		echo "<table>";
		while($a = mysql_fetch_assoc($res)){
			echo "<tr id=str".$a['id'].">";
			echo "<td><img src='images/trash.jpg' class='trash' onclick='obj_to_archive(".$a['id'].")' title='В архив' /></td>";
			echo "<td class='td_left'><span style='cursor: pointer' onclick='sel_room_m(".$id_reg.",".$a['id'].") '>".$a['name']."</span></td>";
			echo "</tr>";
		}
		$max_id++;
		echo "</table><table>";
		echo "<tr id='str".$max_id."'><td><input type='text' id='new_obj".$max_id."' class='input_text' /></td><td><input type='button' onclick='save_new_obj(".$max_id.")' value='Добавить' title='Новый объект' class='button_s' /></td></tr>";
		echo "</table>";
	}
	mysql_close();
//Добавить объект в архив
}elseif($zapros == 'obj_to_archive'){
	$id_obj = $_POST['id_obj'];
	mysql_query("UPDATE object SET active=1 WHERE id='$id_obj'");
	mysql_close();
//Выбор номеров по региону и объекту
}elseif($zapros == 'sel_room'){
	$id_reg = $_POST['id_reg'];
	$id_obj = $_POST['id_obj'];
	$res = mysql_query("SELECT id,name FROM region WHERE active=0");
	echo "<table><tr><td width='100px' class='td_left'><span><strong>Регион</strong></span></td><td><select title='Выбрать регион' class='slct' id='select_region' onclick='sel_room(0)'>";
	while($a = mysql_fetch_assoc($res)){
		if($a['id'] == $id_reg) $s = 'selected';
		else $s = '';
		echo "<option ".$s." value=".$a['id'].">".$a['name']."</option>";
	}
	echo "</td></tr>";
	//Если выбран регион
	if($id_reg>0){
		$res = mysql_query("SELECT id,name FROM object WHERE active=0 AND id_reg='$id_reg'");
		echo "<tr><td width='100px' class='td_left'><span><strong>Объект</strong></span></td><td><select title='Выбрать объект' class='slct' id='select_object' onclick='sel_room(1)'>";
		while($a = mysql_fetch_assoc($res)){
			$i++;
			if($id_obj == $a['id']) $s = "selected";
			else $s = "";
			echo "<option ".$s." value=".$a['id'].">".$a['name']."</option>";
			
		}
		echo "</td></tr></table>";
		//Если выбран объект
		if($id_obj>0){
			$res = mysql_query("SELECT Count(*) FROM room");
			$a = mysql_fetch_row($res);
			$max_id = $a[0];
			$res = mysql_query("SELECT id,name FROM room WHERE active=0 AND id_obj='$id_obj'");
			echo "<table>";
			while($a = mysql_fetch_assoc($res)){
				echo "<tr id=str".$a['id'].">";
				echo "<td><img src='images/trash.jpg' class='trash' onclick='room_to_archive(".$a['id'].")' title='В архив'  /></td>";
				echo "<td class='td_left'><span>".$a['name']."</span></td>";
				echo "</tr>";
			}
			$max_id++;
			echo "</table><table>";
			echo "<tr id='str".$max_id."'><td><input type='text' id='new_room".$max_id."' title='Новый номер' class='input_text' /></td><td><input type='button' onclick='save_new_room(".$max_id.")' title='Сохранить' value='Добавить'  class='button_s' /></td></tr>";
		}
		}
	echo "</table>";
	mysql_close();
//Добавить номер в архив
}elseif($zapros == 'room_to_archive'){
	$id_room = $_POST['id_room'];
	echo "$id_room";
	mysql_query("UPDATE room SET active=1 WHERE id='$id_room'");
	mysql_close();
}
//Сохранить новый номер
elseif($zapros == 'save_new_room'){
	$id_obj = $_POST['id_obj'];
	$name_room = $_POST['name_room'];
	mysql_query("INSERT INTO room(name, id_obj, active) VALUES
		('$name_room', '$id_obj', 0)
	");
	$last_id = mysql_insert_id();
	echo "<td><span>".$name_room."</span></td><td class='td_left'><img src='images/trash.jpg' class='trash' title='В архив' onclick='room_to_archive(".$last_id.")'  /></td>";
	mysql_close();
//Сохранить новый объект
}elseif($zapros == 'save_new_obj'){
	$id_reg = $_POST['id_reg'];
	$name_obj = $_POST['name_obj'];
	mysql_query("INSERT INTO object(name, id_reg, active) VALUES
		('$name_obj', '$id_reg', 0)
	");
	$last_id = mysql_insert_id();
	echo "<td><span>".$name_obj."</span></td><td class='td_left'><img src='images/trash.jpg' class='trash' title='В архив' onclick='obj_to_archive(".$last_id.")'  /></td>";
	mysql_close();
//Сохранить новый регион
}elseif($zapros == 'save_new_reg'){
	$name_reg = $_POST['name_reg'];
	mysql_query("INSERT INTO region(name, active) VALUES
		('$name_reg', 0)
	");
	$last_id = mysql_insert_id();
	echo "<td><span>".$name_reg."</span></td><td class='td_left'><img src='images/trash.jpg' class='trash' title='В архив' onclick='reg_to_archive(".$last_id.")'  /></td>";
	mysql_close();
//Выбор объекты (добавление нового клиента + счет)
}elseif($zapros == 'sel_reg_for_reck'){
	$res = mysql_query("SELECT id,name FROM region WHERE active=0");
	echo "<td><span>Регион</span></td><td class='td_left' colspan='3'><select class='slct' id='sel_reg' onkeypress='sel_obj_for_reck()' onchange='sel_obj_for_reck()'  onkeyup='sel_obj_for_reck()' onclick='sel_obj_for_reck()'>";
	while($a = mysql_fetch_assoc($res)){
		echo "<option value=".$a['id'].">".$a['name']."</option>";
	}
	echo "</select></td>";
	mysql_close();
//Выбор объекта по региону (добавление нового клиента + счет)
}elseif($zapros == 'sel_obj_for_reck'){
	$id_reg = $_POST['id_reg'];
	$res = mysql_query("SELECT id,name FROM object WHERE active=0 AND id_reg='$id_reg'");
	echo "<td><span>Объект</span></td><td class='td_left' colspan='3'><select class='slct' id='sel_obj' onclick='sel_room_for_reck()' onkeypress='sel_room_for_reck()' onchange='sel_room_for_reck()'  onkeyup='sel_obj_room_reck()' >";
	while($a = mysql_fetch_assoc($res)){
		echo "<option value=".$a['id'].">".$a['name']."</option>";
	}
	echo "</select></td>";
	mysql_close();
//Выбор номера по объекту (добавление нового клиента + счет)
}elseif($zapros == 'sel_room_for_reck'){
	$id_obj = $_POST['id_obj'];
	$res = mysql_query("SELECT id,name FROM room WHERE active=0 AND id_obj='$id_obj'");
	echo "<td><span>Номер</span></td><td class='td_left' colspan='3'><select class='slct' id='sel_room'>";
	while($a = mysql_fetch_assoc($res)){
		echo "<option value=".$a['id'].">".$a['name']."</option>";
	}
	echo "</select></td>";
	mysql_close();
//Создание выборки клиентов по запросу поиска
}elseif($zapros == 'find_klient'){
	$poisk = $_POST['poisk'];
	$res = mysql_query("SELECT Count(*) FROM klient WHERE surname LIKE '$poisk%'");	
	$a = mysql_fetch_row($res);
	$l = $a[0];
	if($l > 0){
		$res = mysql_query("SELECT id,surname,name,otch FROM klient WHERE surname LIKE '%$poisk%'");
		$id = 0;
		while($a = mysql_fetch_assoc($res)){
			$id++;
			echo "<div class='no_sel_div' title='Выбрать клиента' name=".$a['id']." id=div".$id.">";
			echo $a['surname']." ".$a['name']." ".$a['otch'];
			echo "</div>";
		}
	}
	mysql_close();
//Просмотр полной информации о клиннте (контакты, счета, бонусы)
}elseif($zapros == 'see_klient'){
	$id_klient = $_POST['id_klient'];
	$res = mysql_query("SELECT photo,surname,name,otch,date,address,city,email,passport,output,date_pas,note,telephone,ICQ,vk,fb, skype,mail,od_cl,tw FROM klient WHERE id='$id_klient'");
	$a = mysql_fetch_assoc($res);
	echo "<form id='klient' name='".$id_klient."'><fieldset style='width: 450px'><legend>Просмотр клиента</legend><table>";
	if($a['photo'] == 'null') $a['photo'] = "images/NoPicture.jpg";
	echo "<tr><td rowspan='4' style='margin: 0px auto' width='120px'><img id='photo' src='".$a['photo']."' />";
	echo "<td class='td_left'><span id='surname'>".$a['surname']."</span></td></tr>";
	echo "<tr><td class='td_left'><span id='name'>".$a['name']."</span></td></tr>";
	echo "<tr><td class='td_left' valign='top'><span id='otch'>".$a['otch']."</span></td></tr>";
	echo "<tr><td class='td_left' valign='top'><span>".$a['date']."</span</td></tr>";
	echo "<tr><td colspan='2'><div style='border-top: 1px solid #c0c0c0; padding-top: 5px'></div></tr>";
	echo "<tr><td class='td_left'><span>".$a['passport']."</span</td>";
	echo "<td class='td_left'><span>".$a['address']."</span</td></tr>";
	$c = mysql_query("SELECT region_id,name FROM city WHERE city_id='".$a['city']."'");
	$z = mysql_fetch_assoc($c);
	$city = $z['name'];
	$region = $z['region_id'];
	$c = mysql_query("SELECT name FROM all_region WHERE region_id='$region'");
	$z = mysql_fetch_assoc($c);
	$region = $z['name'];
	echo "<tr><td class='td_left'><span>".$a['output']."</span</td>";
	echo "<td class='td_left'><span>".$region."</span</td></tr>";
	echo "<tr><td class='td_left'><span>".$a['date_pas']."</span</td>";
	echo "<td class='td_left'><span>".$city."</span</td></tr>";

	echo "<tr><td colspan='2'><div style='border-top: 1px solid #c0c0c0; padding-top: 5px'><table width='100%'>";
	echo "<tr><td class='td_left'><span>".$a['telephone']."</span></td>";
	//Вывод телефонов:
	/*
	$all_tel = unserialize($a['telephone']);
	$len = count($all_tel);
	if($len == 1){
		$t = unserialize($all_tel[1]);	
		echo "<tr><td valign='top' ><span>Телефон: ".$t[2]."</span></td>";
	}
	else{
		echo "<tr><td>";
		for($i=1;$i<=$len;$i++){
			$t = unserialize($all_tel[$i]);
			echo "<span style='text-align: right'>".$t[1].": ".$t[2]."</span><br />";
	}
		echo "</rd>";
	}*/
	//echo "<td rowspan='3'><div id='textarea'>".$a['note']."</div></td></tr>";
	echo "<td rowspan='10' valign='top'><textarea readonly id='textarea'>".$a['note']."</textarea></td></tr>";
	echo "<tr><td class='td_left'><span>".$a['email']."</span></td></tr>";
	$res = mysql_query("SELECT sum FROM bonus WHERE turist='$id_klient'");
	$sum = 0;
	while($b = mysql_fetch_assoc($res)){
		$sum = $sum + (int)$b['sum'];
	}
	echo "<tr><td class='td_left'><span><strong>Бонусы: </strong></span><span id='all_bonus' class='bonus'>".$sum."</span></td></tr>";
	echo "<tr><td class='td_left'><span><strong>ICQ: </strong>".$a['ICQ']."</span></td></tr>";
	echo "<tr><td class='td_left'><span><strong>Facebook: </strong>".$a['fb']."</span></td></tr><tr><td class='td_left'><span><strong>Вконтакте: </strong>".$a['vk']."</span></td></tr><tr> <td class='td_left'><span><strong>Одноклассники: </strong>".$a['od_cl']."</span> </td></tr>";
	echo "<tr><td class='td_left'><span><strong>Twitter:</strong> ".$a['tw']."</span></td></tr><tr><td class='td_left'><span><strong>Skype: </strong>".$a['skype']."</span></td></tr><tr><td class='td_left'><span><strong>Мой мир: </strong>".$a['mail']."</span> </td></tr></table></div></td></tr>";



	
	echo "<tr><td colspan='3'><input type='button' class='button_s' id='but_new_schet' value='Новый счет' onclick='new_reck()' title='Добавить новый счет' /></td></tr>";
	echo "</td></tr></table>";
	echo "</table></fieldset></form>";
	//Вкладки просмотра туриста - бонусы и счета
	echo "<div id='see_schet' onclick='select_schet()' title='Счета клиента' class='see_schet_a'>Счета</div>";
	echo "<div id='see_bonus' onclick='select_bonus()' title='Бонусы клиента' class='see_bonus_noa'>Бонусы</div>";
	//Блок вывода информации о туристе: счета и бонусы
	echo "<div id='info_turist'></div><br />";
	
	echo "<div id='new_schet' style='display: none'>";
	echo "<form><fieldset style='width: 400px'><legend>Форма добавления счета</legend>";
	echo "<table>";
	echo "<tr><td><span>Дата</span></td><td><input type='date' class='input_text' id='n_date_z' /></td><td><span>Кол-во дней</span></td><td class='td_left'><input type='text' onKeyPress =\"if ((event.keyCode < 48) || (event.keyCode > 57))  event.returnValue = ''\" class='input_text_l' maxlength='3' id='n_days' /></td></tr>";
	echo "<tr id='kl_region'>";
	$res = mysql_query("SELECT id,name FROM region WHERE active=0");
	echo "<td><span>Регион</span></td><td class='td_left' colspan='3'><select title='Выбрать регион' class='slct' id='sel_nreg' onclick='sel_obj_for_nreck()' onkeypress='sel_obj_for_nreck()' onchange='sel_obj_for_nreck()'  onkeyup='sel_obj_for_nreck()' >";
	while($a = mysql_fetch_assoc($res)){
		echo "<option value=".$a['id'].">".$a['name']."</option>";
	}
	echo "</select></td></tr>";
	echo "<tr id='kl_object'></tr><tr id='kl_room'></tr>";
	echo "<tr id='add_bonus'><td><span>Сумма</span></td><td class='td_left'><input type='text' onKeyPress =\"if ((event.keyCode < 48) || (event.keyCode > 57))  event.returnValue = ''\" class='input_text' onkeypress='change_sum()' onchange='change_sum()'  id='n_sum' /></td><td><span>Использовать бонусы</span></td><td><input type='checkbox' style='width: 15px;' id='check' onclick='checked_bonus()' /></td></tr>";
	echo "<tr></tr>";
	echo "<tr><td><span>Примечание</span></td><td class='td_left' colspan='3'><input type='text' class='input_text' id='n_note' /></td></tr>";
	echo "<tr><td><span>Номер счета в 1С</span></td><td class='td_left' colspan='3'><input type='text' onKeyPress =\"if ((event.keyCode < 48) || (event.keyCode > 57))  event.returnValue = ''\" class='input_text' id='n_C' /></td></tr>";
	echo "<tr><td><span>Менеджер</span></td><td class='td_left' colspan='3'><input type='text' class='input_text' id='n_manager' /></td></tr>";
	echo "<tr><td colspan='4' align='center'><input type='button' class='button_s' value='Добавить' onclick='save_new_schet()' title='Сохранить счет' /></td></tr>";
	echo "</table></fieldset></form></div>";
	mysql_close();
//
}elseif($zapros == 'see_schet'){
	$id_klient = $_POST['id_klient'];
	$res = mysql_query("SELECT id,date_z,id_obj,sum,manager FROM reckoning WHERE turist='$id_klient'");
	echo "<table width='650px'>";
	echo "<tr><th>Дата</th><th>Менеджер</th><th>Объект</th><th>Сумма</th><th></th></tr>";
	while($a = mysql_fetch_assoc($res)){
		
		$id = $a['id_obj'];
		$san = mysql_query("SELECT name FROM object WHERE id='$id'");
		$s = mysql_fetch_assoc($san);
		echo "<tr id='tr_h".$a['id']."'><td class='td_left'><strong>".$a['date_z']."</strong></td><td class='td_left'> ".$a['manager']."</td><td class='td_left'><strong>".$s['name']."</strong></td><td class='td_left'><strong>".$a['sum']."</strong></td><td style='text-align: center'><span class='see_schet' title='Развернуть' onclick='show_schet_klient(".$a['id'].")'> Развернуть </span></td></tr>";
	}
	echo "</table>";
	mysql_close();

//Просмотр счета клиента (полная информация)
}elseif($zapros == 'show_schet_klient'){
	$id = $_POST['id_schet'];
	$res = mysql_query("SELECT id,date_z,id_obj,sum,days,1C,id_room,note,manager FROM reckoning WHERE id='$id'");
	$a = mysql_fetch_assoc($res);
	$id = $a['id_obj'];
	$s = mysql_query("SELECT name FROM object WHERE id='$id'");
	$s = mysql_fetch_assoc($s);
	echo "<tr id='tr_s1".$a['id']."'><td class='td_left'><strong>".$a['date_z']."</strong></td><td class='td_left'><strong>".$a['manager']."</strong></td><td class='td_left'><strong>".$s['name']."</strong></td><td class='td_left'><strong>".$a['sum']."</strong></td><td style='text-align: center'><span class='see_schet' title='Свернуть' onclick='hide_schet_klient(".$a['id'].")'> Свернуть </span></td></tr>";
	echo "<tr id='tr_s2".$a['id']."'><td colspan='4'><div style='border: 1px solid black'>";
	
	$id = $a['id_room'];
	$s = mysql_query("SELECT name FROM room WHERE id='$id'");
	$s = mysql_fetch_assoc($s);
	echo "<table width='610px'>";
	echo "<tr><td><strong>Кол-во дней:</strong> ".$a['days']."</td><td><strong>Номер:</strong> ".$s['name']."</td><td><strong>Примечание: </strong>".$a['note']."</td><td><strong>1С:</strong> ".$a['1C']."</td></tr>";
	echo "</table></div></td></tr>";
	mysql_close();

//Скрыть счет клиента (полная информация)
}elseif($zapros == 'hide_shect'){
	$id_schet = $_POST['id_schet'];
	$res = mysql_query("SELECT id,date_z,id_obj,sum,manager FROM reckoning WHERE id='$id_schet'");
	$a = mysql_fetch_assoc($res);
	$id = $a['id_obj'];
	$san = mysql_query("SELECT name FROM object WHERE id='$id'");
	$s = mysql_fetch_assoc($san);
	echo "<tr id='tr_h".$a['id']."'><td class='td_left'><strong>".$a['date_z']."</strong></td><td class='td_left'> ".$a['manager']."</td><td class='td_left'><strong>".$s['name']."</strong></td><td class='td_left'><strong>".$a['sum']."</strong></td><td style='text-align: center'><span class='see_schet' title='Развернуть' onclick='show_schet_klient(".$a['id'].")'> Развернуть </span></td></tr>";

	mysql_close();
//Выбор объекта по региону (новый счет)
}elseif($zapros == 'sel_obj_for_nreck'){
	$id_reg = $_POST['id_reg'];
	$res = mysql_query("SELECT id,name FROM object WHERE active=0 AND id_reg='$id_reg'");
	echo "<td><span>Объект</span></td><td class='td_left' colspan='3'><select class='slct' id='sel_nobj' onclick='sel_room_for_nreck()' onkeypress='sel_room_for_nreck()' onchange='sel_room_for_nreck()'  onkeyup='sel_room_for_nreck()' >";
	while($a = mysql_fetch_assoc($res)){
		echo "<option value=".$a['id'].">".$a['name']."</option>";
	}
	echo "</select></td>";
	mysql_close();
//Выбор номера по объекту (новый счет)
}elseif($zapros == 'sel_room_for_nreck'){
	$id_obj = $_POST['id_obj'];
	$res = mysql_query("SELECT id,name FROM room WHERE active=0 AND id_obj='$id_obj'");
	echo "<td><span>Номер</span></td><td class='td_left' colspan='3'><select class='slct' id='sel_nroom'>";
	while($a = mysql_fetch_assoc($res)){
		echo "<option value=".$a['id'].">".$a['name']."</option>";
	}
	echo "</select></td>";
	mysql_close();

//Сохранение отчета
}elseif($zapros == 'save_schet'){
	$id_reg = $_POST['id_reg'];
	$id_obj = $_POST['id_obj'];
	$id_room = $_POST['id_room'];
	$C = $_POST['C'];
	$sum = $_POST['sum'];
	$note = $_POST['note'];
	$days = $_POST['days'];
	$date_z = $_POST['date_z'];
	$today = $_POST['today'];
	$id_klient = $_POST['id_klient'];
	$bonus_r = (int)$_POST['bonus'];
	$manager = $_POST['manager'];
	$a = 1;
	if(is_numeric($sum)){
		$bonus = (int)$sum * 0.02;
		if(!mysql_query("INSERT INTO reckoning(date, date_z, days, id_reg, id_obj, id_room, sum, 1C, note, turist, manager) VALUES ('$today', '$date_z', '$days', '$id_reg', '$id_obj', '$id_room', '$sum', '$C', '$note', '$id_klient', '$manager')")) $a = 0;
		$last_id = mysql_insert_id();
		if(!mysql_query("INSERT INTO bonus(date, schet, turist, sum) VALUES ('$today', '$last_id', '$id_klient', '$bonus')")) $a = 2;
		}
	if($bonus_r < 0){
		mysql_query("INSERT INTO bonus(date, schet, turist, sum) VALUES ('$today', '$last_id', '$id_klient', '$bonus_r')");

	}
	echo $a;
	mysql_close();

//ФУнкция добавления поля бонус и итоговая сумма
}elseif($zapros == 'add_bonus'){
	$id_klient = $_POST['id_klient'];
	$s = $_POST['sum'];
	$res = mysql_query("SELECT sum FROM bonus WHERE turist='$id_klient'");
	$sum = 0;
	while($a = mysql_fetch_assoc($res)){
		$sum = $sum + (int)$a['sum'];
	}
	echo "<tr id='sel_bonus'><td>Бонусы</td><td><input type='text' onchange='change_sum()' class='input_text' onkeypress='change_sum()'  id='bonus' value='".$sum."' /></td><td>Итоговая сумма</td><td><span id='itog_sum'></span></td></tr>";
	mysql_close();

//Функция выполняет поиск всех бонусных операций клиента
}elseif($zapros == 'see_bonus'){
	$id_klient = $_POST['id_klient'];
	$res = mysql_query("SELECT sum,schet FROM bonus WHERE turist='$id_klient'");
	echo "<table width='450px'>";
	echo "<tr><th>Дата</th><th>Объект</th><th>Сумма</th><th>Бонусы</th></tr>";
	while($a = mysql_fetch_assoc($res)){
		$bonus = $a['sum'];
		$schet = $a['schet'];
		$r = mysql_query("SELECT date_z,id_obj,sum FROM reckoning WHERE id='$schet'");
		$r = mysql_fetch_assoc($r);
		$id_obj = $r['id_obj'];
		$date = $r['date_z'];
		$sum = $r['sum'];
		$s = mysql_query("SELECT name FROM object WHERE id='$id_obj'");
		$s = mysql_fetch_assoc($s);
		$obj = $s['name'];
		echo "<tr><td class='td_left' width='100px'>".$date."</td><td class='td_left' width='300px'>".$obj."</td><td class='td_left' width='50px'>".$sum."</td><td class='td_left' width='50px'>".$bonus."</td></tr>";
	}
	echo "</table>";
	mysql_close();
//Поиск клиентов по строке запроса
}elseif($zapros == 'find_all_klient'){
	$poisk = $_POST['poisk'];
	$res = mysql_query("SELECT COUNT(*) FROM klient WHERE surname LIKE '$poisk%'");
	$a = mysql_fetch_row($res);
	$kol = $a[0];
	if($poisk == '') echo "1";
	elseif($kol > 0){
		echo "<table><tr><th>Фамилия</th><th>Имя</th><th>Отчество</th><th></th></tr>";
		$res = mysql_query("SELECT id,surname,name,otch FROM klient WHERE surname LIKE '$poisk%'");
		while($a = mysql_fetch_assoc($res)){
			echo "<tr>";
			echo "<td><span>".$a['surname']."</span></td><td><span>".$a['name']."</span></td><td><span>".$a['otch']."</span> </td><td><span onclick='select_klient(".$a['id'].")' style='cursor: pointer; text-decoration: underline;' >Подробнее</span></td>";
			echo "</tr>";
		}
		echo "</table>";
	}else echo "0";
	mysql_close();
//Суммирование всех бонусов клиента
}elseif($zapros == 'all_bonus'){
	$id_klient = $_POST['id_klient'];
	$res = mysql_query("SELECT sum FROM bonus WHERE turist='$id_klient'");
	$sum = 0;
	while($b = mysql_fetch_assoc($res)){
		$sum = $sum + (int)$b['sum'];
	}
	echo $sum;
	mysql_close();
//Выбор города и региона клиента
}elseif($zapros == 'select_region'){
	$res = mysql_query("SELECT region_id FROM all_region WHERE country_id='3159'");
	$res = mysql_query("SELECT name,region_id FROM all_region WHERE country_id='3159'");
	echo "<select class='slct' id='all_region' onclick='select_city()' onkeypress='select_city()' onchange='select_city()' onkeyup='select_city()'>";
	while($a = mysql_fetch_assoc($res)){
		$id = $a['region_id'];
		if($id == 5246) $s = 'selected';
		else $s = '';
		echo "<option ".$s." value='".$id."'>".$a['name']."</option>";
		$i++;
	}
	echo "</select>";
}elseif($zapros == 'select_city'){
	$id_reg = $_POST['id_reg'];
	$i = 1;
	if($id_reg == 5246) $s['5269'] = 'selected';
	$res = mysql_query("SELECT city_id,name FROM city WHERE region_id='$id_reg'");
	echo "<select class='slct' id='city'>";
	while($a = mysql_fetch_assoc($res)){
		$id = $a['city_id'];	
		echo "<option ".$s[$id]." value='".$id."'>".$a['name']."</option>";
	}
	echo "</select>";	

	mysql_close();
}elseif($zapros == 'filter_do'){
	$surname = $_POST['surname'];
	$manager = $_POST['manager'];
	$date_z = $_POST['date_z'];
	$date = $_POST['date_op'];
	$object = $_POST['object'];
	if($object != ''){
		$res = mysql_query("SELECT id FROM object WHERE name='$object'");
		while($a = mysql_fetch_assoc($res)){
			$id_object = $a['id'];
		}
	}
	$zapros_for_mysql = "SELECT turist,manager,date,date_z,id_obj,sum FROM reckoning";
	if(($date_z != '') || ($date != '') || ($manager != '') || ($id_object != ''))
		$zapros_for_mysql .= " WHERE";
	$and = 0;
	if($date_z != ''){
		$zapros_for_mysql .= " date_z='$date_z' ";
		$and = 1;
	}

	if($date != ''){
		if($and == 1) $zapros_for_mysql .= " AND ";
		$zapros_for_mysql .= " date='$date' ";	
		$and = 1;
	}
	if($manager != ''){
		if($and == 1) $zapros_for_mysql .= " AND ";
		$zapros_for_mysql .= " manager='$manager' ";
		$and = 1;
	}
	if($id_object != ''){
		if($and == 1) $zapros_for_mysql .= " AND ";
		$zapros_for_mysql .= " id_obj='$id_object' ";

	}

	$res = mysql_query($zapros_for_mysql);

	while($a = mysql_fetch_assoc($res)){
	
		$turist = $a['turist'];

		$zapros_for_mysql = "SELECT name,surname,otch FROM klient WHERE id='$turist'";
		if($surname != '')
			$zapros_for_mysql .= " AND surname LIKE '$surname%'";

		$res1 = mysql_query($zapros_for_mysql);

		while($b = mysql_fetch_assoc($res1)){

			$name = $b['name'];
			$sur = $b['surname'];
			$otch = $b['otch'];
			$date_z = $a['date_z'];
			$summa = $a['sum'];
			$manager = $a['manager'];
			$date = $a['date'];
			$id_obj = $a['id_obj'];
			$res2 = mysql_query("SELECT name FROM object WHERE id='$id_obj'");
			while($c = mysql_fetch_assoc($res2)){
				$object = $c['name'];	
			}
			echo "<tr><td width='300px' class='td_left'>".$sur." ".$name." ".$otch."</td><td class='td_left' >".$date_z."</td><td class='td_left'>".$date."</td><td class='td_left' width='180px'>".$object."</td><td>".$summa."</td><td class='td_left'>".$manager."</td></tr>";
		}		
	}

	mysql_close();
}elseif($zapros == 'fil_object'){
	$stroka = $_POST['stroka'];
	$res = mysql_query("SELECT name FROM object WHERE name LIKE '$stroka%'");
	$id = 0;
	while($a = mysql_fetch_assoc($res)){
		$id++;
		echo "<div class='no_sel_div' style='width: 148px' id=div".$id."  onclick='select_fil_object(\"".$a['name']."\")'>".$a['name']."</div>";
	}

	mysql_close();

}elseif($zapros == 'fil_manager'){
	$stroka = $_POST['stroka'];
	$res = mysql_query("SELECT manager FROM reckoning WHERE manager LIKE '$stroka%'");
	$m = 0;
	$man[1] = '';
	while($a = mysql_fetch_assoc($res)){
		$manager = $a['manager'];
		if(($m == 0) && ($man[1] == '')) $man[1] = $manager;
		$t = 0;
		for($i=1;$i<=$m;$i++){
			if($manager == $man[$i])
				$t = 1;
		}
		if($t == 0){
			$m++;
			$man[$m] = $manager;
		}
	}
	if($m > 0)
		for($i=1;$i<=$m;$i++)
			echo "<div class='no_sel_div' style='width: 148px' id=div".$i." onclick='select_fil_manager(\"".$man[$i]."\")'>".$man[$i]."</div>";
	mysql_close();
}



?>