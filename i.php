<form method="POST" action="i.php">
<table>
<tr>
	<td>HOST</td>
	<td>Login</td>
	<td>Password</td>
	<td>Base</td>
</tr>
<tr>
	<td><input type="text" name="host" value="localhost"></td>
	<td><input type="text" name="login" value="ilya"></td>
	<td><input type="text" name="pass" value="site001_ilya"></td>
	<td><input type="text" name="base" value="123123"></td>
</tr>
<tr>
	<td><input type="submit" value="Установить" name="go"></td>
</tr>
</table>
</form>

<?php
if(isset($_POST['go'])){

$host = 'localhost';
$login = 'ilya';
$base = 'site001_ilya';
$password = '123123';
	$mis = "Соединение успешно!";
	if(!$o = mysql_connect ($host, $login, $password)) $mis = "Ошибка подключения";
	if(!mysql_select_db($base) and $o) $mis = "Ошибка выбора базы";
	echo $mis;
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");


/*
//Таблица klient

	mysql_query("CREATE TABLE klient(
		id int(11) not null auto_increment,
		photo varchar(255),
		surname varchar(255),
		name varchar(255),
		otch varchar(255),
		date date,
		telephone varchar(255),
		email varchar(255),
		address varchar(255),
		region int(11),
		city int(11),
		passport int(11),
		output varchar(100),
		date_pas date,
		note varchar(255),
		ICQ varchar(100),
		fb varchar(100),
		vk varchar(100),
		tw varchar(100),
		mail varchar(100),
		skype varchar(100),
		od_cl varchar(100),
		primary key(id)
		)");

*/
/*
//Таблица reckoning
	mysql_query("CREATE TABLE reckoning(
		id int(11) not null auto_increment,
		date date,
		date_z date,
		days int(5),
		id_reg int(11),
		id_obj int(11),
		id_room int(11),
		sum int(11),
		note varchar(255),
		1C int(11),
		manager varchar(100),
		turist int(11),
		primary key(id)
		)");
*/
/*
//Таблица sanatoriy
	mysql_query("CREATE TABLE object(
		id int(11) not null auto_increment,
		name varchar(100),
		id_reg int(1),
		active int(1),
		primary key(id)
		)");
*/
/*
//Таблица room
	mysql_query("CREATE TABLE room(
		id int(11) not null auto_increment,
		name varchar(100),
		active int(1),
		id_obj int(11),
		primary key(id)
		)");
*/

//Добавление санаториев в таблицу
/*
	mysql_query("INSERT INTO object(name, id_reg, active) VALUES
		('Азнакаевский', 1, 0),
		('Ассы', 2, 0),
		('Бакирово', 1, 0),
		('Балкыш (Татэнерго)', 1, 0),
		('Белый Яр', 6, 0),
		('Варзи-Ятчи', 4, 0),
		('Васильевский', 1, 0),
		('Вита', 7, 0),
		('Волга', 1, 0),
		('Волжанка', 5, 0),
		('Волжские зори', 5, 0),
		('Волжский утес', 3, 0),
		('Дельфин', 1, 0),
		('Демидково', 7, 0),
		('Джалильский', 1, 0),
		('Дубки', 6, 0),
		('Жемчужина', 1, 0),
		('Здоровье', 1, 0),
		('Зеленая роща', 2, 0),
		('Иволга', 1, 0),
		('Ижминводы', 1, 0),
		('Ижминводы', 1, 0),
		('им. Ленина', 6, 0),
		('Итиль', 6, 0),
		('Карагай', 2, 0),
		('Кленовая гора', 8, 0),
		('Ключи', 7, 0),
		('Космос', 1, 0),
		('Красноусольск', 2, 0),
		('Крутушка', 1, 0),
		('Лениногорский', 1 ,0),
		('Лесная сказка', 8, 0),
		('Ливадия', 1, 0),
		('Лилия', 1, 0),
		('Лучезарный', 1, 0),
		('Матрешка Плаза', 3, 0),
		('Надежда (Самара)', 3, 0),
		('Надежда (Чувашия)', 5, 0),
		('Прибрежный', 6, 0),
		('Радуга', 1, 0),
		('Родник', 7, 0),
		('Ромашкино', 1, 0),
		('Русский бор', 3, 0),
		('Санта', 1, 0),
		('Сергиевские минеральные воды', 3, 0),
		('Солнечный берег', 5, 0),
		('Сосновый Бор', 1, 0),
		('Ставрополь', 3, 0),
		('Танып', 2, 0),
		('Ува', 4, 0),
		('Уральская Венеция', 7, 0),
		('Усть-Качка', 7, 0),
		('Чувашия', 5, 0),
		('Шифалы', 1, 0),
		('Юбилейный', 2, 0),
		('Южный', 8, 0),
		('Юматово', 2, 0),
		('Якты-Куль', 2, 0),
		('Ян', 1, 0),
		('Янган-Тау', 2, 0);
	");
*/
/*
//Таблица регионов
	mysql_query("CREATE TABLE region(
		id int(11) not null auto_increment,
		name varchar(100),
		active int(1),
		primary key(id)
		)");


	mysql_query("INSERT INTO region(name, active) VALUES
		('Татарстан', 0),
		('Башкирия', 0),
		('Самарская область', 0),
		('Удмуртия', 0),
		('Чувашия', 0),
		('Ульяновская область', 0),
		('Пермский край', 0),
		('Марий Эл', 0)
	");
*/
/*
//Таблица бонусов
	mysql_query("CREATE TABLE bonus(
		id int(11) not null auto_increment,
		date date,
		turist int(11),
		sum int(11),
		schet int(11),
		primary key(id)
		)");
	
*/







/*
$r = mysql_query("select * from object");
	while($re = mysql_fetch_assoc($r)){
		var_dump($re);
		echo "<br />";
	}

*/






echo "<br />";
	$r = mysql_query("SHOW TABLES");
	while($re = mysql_fetch_row($r)){
		var_dump($re);
		echo "<br />";
	}



}


?>