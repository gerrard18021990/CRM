<html>
<head>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/ajaxupload.js"></script>
<script type="text/javascript" src="js/download.js"></script>
<script type="text/javascript" src="modules/module_filter.js"></script>
<script type="text/javascript" src="modules/module_schet.js"></script>
<link rel="stylesheet" href="style.css">
</head>
<body>
<!--  Левое меню  -->
<table>
<tr><td valign="top">
<div id="menu" class="menu">
<div class="link_menu" onclick="add_klient()" title="Новый турист">Турист</div>
<div class="link_menu" onclick="pod_menu()">Объекты</div>
<div class="link_menu_l" style="display: none" id="room_open" onclick="room()" title="Просмотр номеров">Номера</div>
<div class="link_menu_l" style="display: none" id="object_open" onclick="object()" title="Просмотр объектов">Объекты</div>
<div class="link_menu_l" style="display: none" id="region_open" onclick="region()" title="Просмотр регионов">Регионы</div>
<div class="link_menu" onclick="show_schet()" title="Счета и бонусы">Счета</div>
<div class="link_menu" onclick="show_filter()" title="Поиск">Поиск</div>
</div>
</td>
<td valign="top">

<div id="add_klient">

<!--- Невидимый блок загрузки фото клиента --->
<div id="select_photo" class="select_p">
<div class="down">
	<table>
	<tr>
		<td colspan="2" align="center"><input type="button" id="uploadButton" value="Выбрать фото" class="button_s" /></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><img scr="logo.jpg" class="photo_view" id="photo_view" /></td>
	</tr>
	<tr>
		<!--- Добавление фото в карточку клиента  --->
		<td><input type="button" value="Сохранить фото" onclick="download_photo()" class="button_s" /></td>
		<!--- Удаление фото с сервера, отмена --->
		<td><input type="button" value="Отмена" onclick="cancel_down()" class="button_s" /></td>
	</tr>
	</table>
</div>
</div>

<!--- Форма добавления данных о клиенте (основные) --->
<div id="other_find_klient"></div>
<form>
<fieldset style="width: 325px">
<legend>Форма добавления клиента</legend>
<table >
<!-- Блок с фото клиента, поле для ввода имени --->
<tr>
	<td rowspan="4" style="text-align: center"><div class="photo"><img id="photo" onclick="add_photo()" src="images/NoPicture.jpg"  /><p class="add_pic" onclick="add_photo()" title="Добавить картинку">Добавить фото</p></div></td>
	<td valign="top" class="td_left"><input type="text" tabindex="1" onkeypress="other_klient()" onchange="other_klient()"  onkeyup="other_klient()" id="surname" value="Фамилия" maxlength="25"  onfocus="clear_s(1)" class="input_text"  onblur="find_klient_blur()" title="Фамилия" /></td>
</tr>
<tr>
	<td width="368px" valign="top" class="td_left"><input type="text" id="name" tabindex="2" value="Имя" class="input_text" maxlength="20" onblur="cl(2)" title="Имя" onfocus="clear_s(2)" maxlength="20" /></td>
</tr>
<tr>
	<td valign="top" class="td_left"><input type="text" id="otch" value="Отчество" tabindex="3" class="input_text" onblur="cl(3)" onfocus="clear_s(3)" title="Отчество" maxlength="20"  /></td>
</tr>
<tr>
	<td valign="top" class="td_left"><input type="date" id="date" tabindex="4" value="0" breaks class="input_text" title="Дата рождения" /></td>
</tr>
<tr>
	<td colspan="2"><div style="border-top: 1px solid #c0c0c0; padding-top: 5px"></div></td>
</tr>
<tr>
	<td valign="top" class="td_left"><input type="text" id="passport" tabindex="5" onblur="cl(4)" class="input_text" maxlength="12" value="Паспорт" title="Паспорт" onfocus="clear_s(4)" onKeyPress ="passport_space()" onkeyup="passport_space()" /></td>
	<td valign="top" class="td_left"><input type="text" id="address" tabindex="8" class="input_text" onblur="cl(5)" value="Адрес" onfocus="clear_s(5)" title="Адрес" /></td>
</tr>
<tr>
	<td class="td_left"><input type="text" id="output" value="Кем выдан" tabindex="6" class="input_text" title="Кем выдан" onblur="cl(16)" onfocus="clear_s(16)" maxlength="50"/></td>
	<td class="td_left" id="address_region"></td>
</tr>
<tr>
	<td class="td_left"><input class="input_text" tabindex="7" type="date" id="date_pas" /></td>
	<td class="td_left" id="address_city"></td>
</tr>
<tr>
	<td colspan="4">
	<div style="border-top: 1px solid #c0c0c0; padding-top: 5px">
	<table>
	<tr>
		<td class="td_left;" style="text-align: left; padding: 0px; width: 152px;"><span>+7 </span><input style="width: 130px" type="text" onfocus="clear_s(6)" maxlength="20" onblur="cl(6)" value="Телефон" id="telephone1" class="input_text" onfocus="tel_focus(1)" onblur="tel_blur(1)" title="Телефон" onKeyPress ="if ((event.keyCode < 48) || (event.keyCode > 57))  event.returnValue = '';" /></td>
		<td class="td_left"><input value="Email" style="margin-left: 4px;" maxlength="35" type="text" onfocus="clear_s(8)" onblur="cl(8)" title="Email" id="email" class="input_text" /></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center !important"><span style="border-bottom: 1px dashed black" onclick="show_social()" title="Развернуть/свернуть соц.сети">Социальные сети</span></td>
	</tr>
	<tr>
		<td colspan="2">
		<!--  Поля для ввода контактных данных клиента в соц.сетях  -->
		<div id="tr_social" style="display: none; margin-left: -8px">
		<table>
		<tr>
			<td><input value="ICQ" onfocus="clear_s(9)" onblur="cl(9)" type="text" id="ICQ" title="ICQ" class="input_text" /></td>
			<td><input value="Facebook" type="text" id="facebook" class="input_text" onfocus="clear_s(10)" title="Facebook" onblur="cl(10)" /></td>
		</tr>
		<tr>
			<td><input value="Вконтакте" type="text" id="vk" class="input_text" onfocus="clear_s(11)" onblur="cl(11)" title="Вконтакте" /></td>
			<td><input value="Одноклассники" type="text" id="od_cl" class="input_text" onfocus="clear_s(12)" onblur="cl(12)" title="Одноклассники" /></td>

		</tr>
		<tr>
			<td><input value="Twitter" title="Twitter" type="text" id="twitter" class="input_text" onfocus="clear_s(13)" onblur="cl(13)" /></td>
			<td><input value="Skype" type="text" title="Skype" id="skype" class="input_text" onfocus="clear_s(14)" onblur="cl(14)" /></td>

		</tr>
		<tr>
			<td><input value="Мой мир" type="text" id="mail" title="Мой мир" class="input_text" onfocus="clear_s(15)" onblur="cl(15)" /></td>
			<tr></tr>
		</tr>
	</table>
	</div>
	</td>
	</tr>
	<!--- Кнопка добавления нового пустого поля для записи телефона --->
<!-- 	<tr id="str">
		<td valign="top" style="text-align: center"><span id="add_new" title="Добавить новый телефон" onclick="new_tel()">Добавьте телефон</span></td>
	</tr>
-->
	
	<tr>
		
		<td rowspan="2" valign="top" class="td_left" colspan="2"><textarea style="margin-left: -4px" id="note_k" onfocus="clear_s(7)" title="Примечание" onblur="cl(7)">Примечание</textarea></td>
	</tr>
	</table>
	</div>
</td>
</tr>
</table>
</fieldset>
</form>
</td>
<td valign="top">
<!--  Форма добавления счетов -->
<form  id="reckoning">
<fieldset style="width: 400px">
<legend>Форма добавления счета</legend>
<table>
<tr>
	<td><span>Дата</span></td>
	<td><input type="date" class="input_text" id="date_z" title="Дата заезда" /></td>
	<td><span>Кол-во дней</span></td>
	<td><input type="text" class="input_text_l" maxlength="3" id="days" title="Количество дней" onKeyPress ="if ((event.keyCode < 48) || (event.keyCode > 57))  event.returnValue = '';" /></td>
</tr>
<tr id="klient_region">
	<td colspan="2"></td>
</tr>
<tr id="klient_object">
	<td colspan="2"></td>
</tr>
<tr id="klient_room">
	<td colspan="2"></td>
</tr>
<tr>
	<td><span>Сумма (число)</span></td>
	<td class="td_left" colspan="3"><input type="text" class="input_text" maxlength="10" id="sum" title="Сумма" onKeyPress ="if ((event.keyCode < 48) || (event.keyCode > 57))  event.returnValue = '';" /></td>
</tr>
<tr>
	<td><span>Примечание к счету</span></td>
	<td class="td_left" colspan="3"><input type="text" class="input_text" id="note" title="Примечание к счету" /></td>
</tr>
<tr>
	<td><span>Номер счета в 1С</span></td>
	<td class="td_left" colspan="3"><input type="text" onKeyPress ="if ((event.keyCode < 48) || (event.keyCode > 57))  event.returnValue = '';" class="input_text" id="C" title="Номер счета в 1С" /></td>
</tr>
<tr>
	<td><span>Менеджер</span></td>
	<td class="td_left" colspan="3"><input type="text" class="input_text" id="manager" title="Менеджер" /></td>
</tr>
<tr>
	<td colspan="4" align="center"><input type="button" class="button_s" value="Добавить" onclick="save_all()" title="Сохранить" /></td>
</tr>
</table>
</fieldset>
</form>
</div>


<div id="filter"></div>

<!-- Блок объекты  -->
<div id="objects" style="display: none"></div>
<div id="schet" style="display: none">
<table><tr id='poisk_for_surname'><td><span>Форма поиска по фамилии</span></td><td><input type='text' onkeypress='find_klient()' onchange='find_klient()' onkeyup='find_klient()' title='Введите запрос' id='poisk' class='input_search' /></td><td><input type='button' class='but_search' onclick='find_all_klient()' title='Поиск' /></td></tr></table><div id='find'></div><div id='klients'></div><div id='see_klient'></div>
</div>


</td>
</tr>
</table>

<script type="text/javascript">

var str = 'zapros=sel_reg_for_reck';
$.ajax({
	url: 'mysql.php',
	type: 'POST',
	data: str,
	success: function sel(a){
		document.getElementById('klient_region').innerHTML = a;
	}
});
select_city();
var i = 1;
var izm = 1;
var kol = 1;
var pos = 0;
var show = 0;
var max_bonus;
// Функция добавления клиента и его данных в базу
function save_all(){
	//Определяется сегоднящняя дата (дата заявки)
	date = new Date();
	var year = date.getUTCFullYear();
	var month = date.getMonth();
	month++;
	var day = date.getDate();
	var today = year + '-' + month + '-' + day;
	
	var t = 1, s, d, ss;
/*
	//tel - строка запроса. kol указывает на то, сколько телефонов было добавлено
	var tel = '&k_telephone=' + kol;
	//В цикле просматриваются все добавленные телефоны, формируется строка запроса
	for(t;t<=kol;t++){
		//s - вид/тип телефона, d - номер телефона
		if(kol != 1)
			s = document.getElementById('tel_text'+t).value;
		else s = 'Телефон';
		d = document.getElementById('telephone'+t).value;
		switch (s){
			case 'Телефон': ss = 'telephone'; break;
			case 'Домашний': ss = 'home'; break;
			case 'Мобильный': ss = 'mobile'; break;
			case 'Рабочий': ss = 'work'; break;
			case 'Основной': ss = 'main'; break;
			case 'Домашний факс': ss = 'fax_home'; break;
			case 'Рабочий факс': ss = 'fax_work'; break;
			case 'Введите текст': ss = 'pers'; break;
			case 'Google Voice': ss = 'goo_v'; break;
			case 'Пейджер': ss = 'pager'; break;
		}
		if(s != ''){
			tel = tel + '&t' + t + '=' + ss + '&n' + t + '=' + d;
		}
	}

*/
	//Чтение других введенных данных
	var telephone = document.getElementById('telephone1').value;
	if(telephone == 'Телефон') telephone = '';
	var name = document.getElementById('name').value;
	var surname = document.getElementById('surname').value;
	var otch = document.getElementById('otch').value;
	var email = document.getElementById('email').value;
	if(email == 'Email') email = '';
	var passport = document.getElementById('passport').value;
	var output = document.getElementById('output').value;
	var date_pas = document.getElementById('date_pas').value;
	var date = document.getElementById('date').value;
	var address = document.getElementById('address').value;
	var photo = document.getElementById('photo_view').getAttribute('src');
	var id_reg = document.getElementById('sel_reg').value;
	var el = document.getElementById('sel_obj');
	if(el) var id_obj = document.getElementById('sel_obj').value;
	el = document.getElementById('sel_room');
	if(el) var id_room = document.getElementById('sel_room').value;
	var sum = document.getElementById('sum').value;
	var C = document.getElementById('C').value;
	var note = document.getElementById('note').value;
	var manager = document.getElementById('manager').value;
	if(document.getElementById('city')){
		var city = document.getElementById('city').value;
		var all_region = document.getElementById('all_region').value;
	}
	var days = document.getElementById('days').value;
	var date_z = document.getElementById('date_z').value;
	//Данные соц сетей
	var note_k = document.getElementById('note_k').value;
	if(note_k == 'Примечание') note_k = '';
	var icq = document.getElementById('ICQ').value;
	if(icq == 'ICQ') icq = '';
	var vk = document.getElementById('vk').value;
	if(vk == 'Вконтакте') vk= '';
	var facebook = document.getElementById('facebook').value;
	if(facebook == 'Facebook') facebook= '';
	var od_cl = document.getElementById('od_cl').value;
	if(od_cl == 'Одноклассники') od_cl= '';
	var twitter = document.getElementById('twitter').value;
	if(twitter == 'Twitter') twitter= '';
	var myWorld = document.getElementById('mail').value;
	if(myWorld == 'Мой мир') myWorld= '';
	var skype = document.getElementById('skype').value;
	if(skype == 'Skype') skype= '';
	var set = '&skype=' + skype + '&icq=' + icq + '&vk=' + vk + '&facebook=' + facebook + '&od_cl=' + od_cl + '&twitter=' + twitter + '&mail=' + myWorld;
	//Проверка введенной почты
	var pos1 = email.indexOf("@");
	var pos2 = email.lastIndexOf(".");
	var m = 0;
	if (((pos1 < 1) || (pos2 < (pos1 + 2)) || ((pos2 + 2 )>= email.length)) && (email != ''))
		m = 1;
	//Обязательное поле - имя клиента
	if((surname == '') || (surname == 'Фамилия')){
		alert('Не введены данные: фамилия');
	}else if ((name == '') || (name == 'Имя')){
		alert('Не введены данные: имя');
	}else if ((otch == '') || (otch == 'Отчество')){
		alert('Не введены данные: отчество');
	}else if(m == 1){
		alert('Не верно введено поле: Email');
	}else if((isNaN(telephone) || (telephone.length < 10)) && (telephone != '')){
		alert('Не верно введено поле: Телефон');
	}else if(isNaN(note)){
		alert('Не верно введено поле: Номер счета в 1С');
	}else if(isNaN(icq)){
		alert('Не верно введено поле: ICQ');
	}else if(isNaN(days)){
		alert('Не верно введено поле: Количество дней');
	}else{
		//Формирование строки запроса
		var str = 'zapros=save_all&surmane=' + surname + '&name=' + name + '&otch=' + otch + '&telephone=' + telephone + '&email=' + email + '&passport=' + passport + '&date=' + date + '&photo=' + photo + '&id_reg=' + id_reg + '&id_obj=' + id_obj + '&id_room=' + id_room + '&C=' + C + '&sum=' + sum + '&note=' + note + '&days=' + days + '&date_z=' + date_z + '&today=' + today + set + '&address=' + address + '&note_k=' + note_k + '&manager=' + manager+ '&city=' + city + '&all_region=' + region + '&output=' + output + '&date_pas=' + date_pas;
		$.ajax({
			url: 'mysql.php',
			type: 'POST',
			data: str,
			success: function add(a){
				//При успешном сохранении данных выводится сообщение, все поля обнуляются
				if(a == 1){
					alert('Данные успешно сохранены');
					location.reload();
				}else if(a == 2)
					alert('В поле СУММА введите число!');
				else alert('Ошибка!');
			}
		});
	
	}	
}


//Функция вызывается при нажатии на кнопку Добавить картинку. Появляется новое окно.
function add_photo(){
	$('#select_photo').removeClass('select_p').addClass('select_photo_active').show();
}

//Функция вызывается при нажатии в окне выбора фото кнопки Отмена
function cancel_down(){
	$('#select_photo').removeClass('select_photo_active').addClass('select_p').show();
	var str = 'act=delete&file=' + document.getElementById('photo_view').getAttribute('src');
	$.ajax({
		url: 'upload.php',
		type: 'POST',
		data: str,
	});	
}

//Функция вызывается при нажатии в окне выбора фото кнопки Сохранить. Фото клиента обновляется
function download_photo(){
	var attr = document.getElementById('photo_view').getAttribute('src');
	document.getElementById('photo').setAttribute('src', attr);
	$('#select_photo').removeClass('select_photo_active').addClass('select_p').show();
}

//Поля для добавления информации о контактах клиента в соц сетях
function show_social(){
	$('#tr_social').toggle('slow');

}

//Функция при клике на поле ввода телефона. Фокус
function tel_focus(i){
	$('#tel_text'+i).show();
	$('#select'+i).hide();
	var s = document.getElementById('tel_text'+i).name;
	if(s != 'see'){
		$('#tel_text'+i).attr('name', 'see');
		var sss = document.getElementById('select'+i).value;
		var ss;
		switch (sss){
			case 'home': ss = 'Домашний'; break;
			case 'mobile': ss = 'Мобильный'; break;
			case 'work': ss = 'Рабочий'; break;
			case 'main': ss = 'Основной'; break;
			case 'fax_home': ss = 'Домашний факс'; break;
			case 'fax_work': ss = 'Рабочий факс'; break;
			case 'pers': ss = 'Введите текст'; break;
			case 'goo_v': ss = 'Google Voice'; break;
			case 'pager': ss = 'Пейджер'; break;
		}
		document.getElementById('tel_text'+i).value = ss;
	}

	
}

//Выбор региона и города клиента
function select_city(){
	var id_reg;
	if(!document.getElementById('all_region')){
		id_reg = '5246';
		var str = 'zapros=select_region';
		$.ajax({
			url: 'mysql.php',
			type: 'POST',
			data: str,
			success: function sel(a){
				document.getElementById('address_region').innerHTML = a;
		}
	});
	}
	else id_reg = document.getElementById('all_region').value;
	var str = 'zapros=select_city&id_reg=' + id_reg;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('address_city').innerHTML = a;
		}
	});
}

//Добавление пробела в поле ввода паспорта
function passport_space(){
	if((event.keyCode < 48) || (event.keyCode > 57))  event.returnValue = '';
	else{
		var pass = document.getElementById('passport').value;
		var dlina = pass.length;

		if(dlina == 4){
			pass = pass + " ";
		}
		document.getElementById('passport').value = pass;
	}
}


function clear_s(i){
	if(i == 1){
		if(document.getElementById('surname').value == 'Фамилия')
			document.getElementById('surname').value = '';
	}else if(i == 2){
		if(document.getElementById('name').value == 'Имя')
			document.getElementById('name').value = '';
	}else if(i == 3){
		if(document.getElementById('otch').value == 'Отчество')
			document.getElementById('otch').value = '';
	}else if(i == 4){
		if(document.getElementById('passport').value == 'Паспорт')
			document.getElementById('passport').value = '';
	}else if(i == 5){
		if(document.getElementById('address').value == 'Адрес')
			document.getElementById('address').value = '';
	}else if(i == 6){
		if(document.getElementById('telephone1').value == 'Телефон')
			document.getElementById('telephone1').value = '';
	}else if(i == 7){
		if(document.getElementById('note_k').innerHTML == 'Примечание')
			document.getElementById('note_k').innerHTML = '';
	}else if(i == 8){
		if(document.getElementById('email').value == 'Email')
			document.getElementById('email').value = '';
	}else if(i == 9){
		if(document.getElementById('ICQ').value == 'ICQ')
			document.getElementById('ICQ').value = '';
	}else if(i == 10){
		if(document.getElementById('facebook').value == 'Facebook')
			document.getElementById('facebook').value = '';
	}else if(i == 11){
		if(document.getElementById('vk').value == 'Вконтакте')
			document.getElementById('vk').value = '';
	}else if(i == 12){
		if(document.getElementById('od_cl').value == 'Одноклассники')
			document.getElementById('od_cl').value = '';
	}else if(i == 13){
		if(document.getElementById('twitter').value == 'Twitter')
			document.getElementById('twitter').value = '';
	}else if(i == 14){
		if(document.getElementById('skype').value == 'Skype')
			document.getElementById('skype').value = '';
	}else if(i == 15){
		if(document.getElementById('mail').value == 'Мой мир')
			document.getElementById('mail').value = '';
	}else if(i == 16){
		if(document.getElementById('output').value == 'Кем выдан')
			document.getElementById('output').value = '';
	}
}

function cl(i){
	
	if(i == 2){
		if(document.getElementById('name').value == '')
			document.getElementById('name').value = 'Имя';
	}else if(i == 3){
		if(document.getElementById('otch').value == '')
			document.getElementById('otch').value = 'Отчество';
	}else if(i == 4){
		if(document.getElementById('passport').value == '')
			document.getElementById('passport').value = 'Паспорт';
	}else if(i == 5){
		if(document.getElementById('address').value == ''){
			document.getElementById('address').value = 'Адрес';
		}
	}else if(i == 6){
		if(document.getElementById('telephone1').value == '')
			document.getElementById('telephone1').value = 'Телефон';
	}else if(i == 7){
		if(document.getElementById('note_k').innerHTML == '')
			document.getElementById('note_k').innerHTML = 'Примечание';
	}else if(i == 8){
		if(document.getElementById('email').value == '')
			document.getElementById('email').value = 'Email';
	}else if(i == 9){
		if(document.getElementById('ICQ').value == '')
			document.getElementById('ICQ').value = 'ICQ';
	}else if(i == 10){
		if(document.getElementById('facebook').value == '')
			document.getElementById('facebook').value = 'Facebook';
	}else if(i == 11){
		if(document.getElementById('vk').value == '')
			document.getElementById('vk').value = 'Вконтакте';
	}else if(i == 12){
		if(document.getElementById('od_cl').value == '')
			document.getElementById('od_cl').value = 'Одноклассники';
	}else if(i == 13){
		if(document.getElementById('twitter').value == '')
			document.getElementById('twitter').value = 'Twitter';
	}else if(i == 14){
		if(document.getElementById('skype').value == '')
			document.getElementById('skype').value = 'Skype';
	}else if(i == 15){
		if(document.getElementById('mail').value == '')
			document.getElementById('mail').value = 'Мой мир';
	}else if(i == 16){
		if(document.getElementById('output').value == '')
			document.getElementById('output').value = 'Кем выдан';
	}

}

//Функция при потере фокуса поля телефона
function tel_blur(i){
	if(document.getElementById('telephone' +i).value == ''){
		$('#add_new').hide();
		
	}else{
		$('#add_new').show();
	}
	
}

//Функция добавления нового телефона. Добавляется новая строка в таблицу
function new_tel(){
	//if(document.getElementById('telephone' + izm).value != ''){
		i++;
		var a = new Array('','','','','','','','','');
		if(i>8) a[9] = "selected";
		else a[i] = "selected";
		$('#str').before("<tr id=tr" + i + "><td><span onclick='select_red(" +i+ ")'><input disabled type='text' class='inp' id='tel_text" +i+ "' name='see' onblur='select_blur(" +i+ ")' /></span><select style='display: none' id='select" +i+ "' class='opt' style='margin-left: -10px'><option value='home'>Домашний</option><option " +a[2]+  " value='mobile'>Мобильный</option><option " +a[3]+ " value='work'>Рабочий</option><option " +a[4]+ " value='main'>Основной</option><option " +a[5]+ " value='fax_work'>Рабочий факс</option><option " +a[6]+ " value='fax_home'>Домашний факс</option><option " +a[7]+ " value='goo_v'>Google Voice</option><option " +a[8]+ " value='pager'>Пейджер</option><option " +a[9]+ " value='pers'>Персонализированный</option></select></td><td><div onclick='show_select(" +i+ ")' class='select_img'  id='select_img" +i+ "'></div></td><td><input type='text' id='telephone" +i+ "' class='input_text' onfocus='tel_focus(" +i+ ")' onblur='tel_blur(" +i+ ")' /></td><td><img src='images/trash.jpg' onclick='sel_delete(" +i+ ")'  /></td></tr>'");
		izm = i;
		kol++;
		var s = document.getElementById('select'+i).value;
		var ss;
		switch (s){
			case 'home': ss = 'Домашний'; break;
			case 'mobile': ss = 'Мобильный'; break;
			case 'work': ss = 'Рабочий'; break;
			case 'main': ss = 'Основной'; break;
			case 'fax_home': ss = 'Домашний факс'; break;
			case 'fax_work': ss = 'Рабочий факс'; break;
			case 'pers': ss = 'Введите текст'; break;
			case 'goo_v': ss = 'Google Voice'; break;
			case 'pager': ss = 'Пейджер'; break;
	
		}
		document.getElementById('tel_text'+i).value = ss;
		
		
}

//Удаляется телефон. Удаляется строка в таблице
function sel_delete(i){
	$('#tr'+i).hide();
	kol--;
}

//Функция по нажатию на кнопку Редактировать (***). Есть возможность отредактировать тип телефона с помощью select
function show_select(i){
	var s = document.getElementById('tel_text'+i).name;
	if((s == 'see') || (s == '')){
		$('#tel_text'+i).hide();
		$('#select'+i).show();
		$('#tel_text'+i).attr('name', 'no_see');
		
		
	}else{
		$('#tel_text'+i).show();
		$('#select'+i).hide();
		$('#tel_text'+i).attr('name', 'see');
		var sss = document.getElementById('select'+i).value;
		var ss;
		switch (sss){
			case 'home': ss = 'Домашний'; break;
			case 'mobile': ss = 'Мобильный'; break;
			case 'work': ss = 'Рабочий'; break;
			case 'main': ss = 'Основной'; break;
			case 'fax_home': ss = 'Домашний факс'; break;
			case 'fax_work': ss = 'Рабочий факс'; break;
			case 'pers': ss = 'Введите текст'; break;
			case 'goo_v': ss = 'Google Voice'; break;
			case 'pager': ss = 'Пейджер'; break;
	
		}
		document.getElementById('tel_text'+i).value = ss;
		
	}
	
}

//Выборка похожих фамилий клиента ()
function other_klient(){
	var poisk = document.getElementById('surname').value;
	if(poisk == '') $('#other_find_klient').hide();
	else if(show == 0) $('#other_find_klient').show();
	var str = 'zapros=find_klient&poisk=' + poisk;
	if(event.keyCode == 40){
		show = 0;
		var old = pos;
		pos++;
		if(document.getElementById('div'+pos)){
			select_id = pos;
			$('#div'+pos).removeClass('no_sel_div').addClass('sel_div');
			if(document.getElementById('div'+old)){
				$('#div'+old).removeClass('sel_div').addClass('no_sel_div');

			}
		}else{
			pos = 0;
			$('#div'+old).removeClass('sel_div').addClass('no_sel_div');
		}
	}else if(event.keyCode == 38){
		var old = pos;
		pos--;
		show = 0;
		if(document.getElementById('div'+pos)){
			select_id = pos;
			$('#div'+pos).removeClass('no_sel_div').addClass('sel_div');
			if(document.getElementById('div'+old)){
				$('#div'+old).removeClass('sel_div').addClass('no_sel_div');
			}
		}else{
			pos = 0;
			$('#div'+old).removeClass('sel_div').addClass('no_sel_div');
		}
	}else if(event.keyCode == 13){
		if(document.getElementById('div'+pos)){
			var id = document.getElementById('div'+pos).getAttribute('name');
			$('#add_klient').hide();
			$('#objects').hide();
			$('#schet').show();
			$('#poisk_for_surname').hide();
			$('#find').hide();
			$('#reckoning').hide();
			document.getElementById('see_klient').innerHTML = '';
			select_klient(id);
			var q = 1;
			document.getElementById('other_find_klient').innerHTML = '';
			
		}
	}else if(event.keyCode == 27){
		$('#other_find_klient').hide();
		show = 1;

	}else{
		if(((poisk.length > 2) && (show == 0)) || ((event.keyCode == 46) || (event.keyCode == 8))){
			show = 0;
			$.ajax({
				url: 'mysql.php',
				type: 'POST',
				data: str,
				success: function sel(a){
					if(!a){ $('#other_find_klient').hide(); show = 1;}
					else document.getElementById('other_find_klient').innerHTML = a;
					pos = 0;
					
					select_id = 0;
				}
			});
		}else
			$('#other_find_klient').hide();
	}
}


function find_klient_blur(){
	$('#other_find_klient').hide();
	show = 1;
	if(document.getElementById('surname').value == '')
		document.getElementById('surname').value = 'Фамилия';
}

//Функция при клике на тип телефона. Есть возможность отредактировать тип с клавиатуры
function select_red(i){
	document.getElementById('tel_text'+i).disabled = false;
	$('#tel_text'+i).focus();

}

//Потеря фокуса типа телефона
function select_blur(i){
	document.getElementById('tel_text'+i).disabled = true;
}


//Функция выбора региона (появляется селект объектов)
function sel_obj_for_reck(){
	document.getElementById('klient_room').innerHTML = '';
	var id_reg = document.getElementById('sel_reg').value;
	str = 'zapros=sel_obj_for_reck&id_reg=' + id_reg;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('klient_object').innerHTML = a;
		}
	});
}

//Функция выбора номера (появляется селект объектов)
function sel_room_for_reck(){
	var id_obj = document.getElementById('sel_obj').value;
	str = 'zapros=sel_room_for_reck&id_obj=' + id_obj;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('klient_room').innerHTML = a;
		}
	});
}

//Функция перехода по пункту меню Клиент
function add_klient(){
	$('#add_klient').show();
	$('#filter').hide();
	$('#objects').hide();
	$('#schet').hide();
	$('#reckoning').show();
	document.getElementById('see_klient').innerHTML = '';
	document.getElementById('poisk').value = '';
	document.getElementById('filter').innerHTML = '';
}

//Функция перехода по пункту меню Объекты
function pod_menu(){
	$('#room_open').toggle();
	$('#object_open').toggle();
	$('#region_open').toggle();
	
}

//Функция вызывается при нажатии на меню слева (пункт Регионы)
function region(){
	$('#filter').hide();
	var str = 'zapros=sel_reg';
	$('#add_klient').hide();
	$('#objects').show();
	$('#reckoning').hide();
	$('#schet').hide();
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('objects').innerHTML = a;
		}


	});
}

//Функция вызывается при нажатии на меню слева (пункт Объекты)
function object(){
	$('#filter').hide();
 	var str = 'zapros=sel_obj';
	$('#add_klient').hide();
	$('#objects').show();
	$('#reckoning').hide();
	$('#schet').hide();
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('objects').innerHTML = a;
		}


	});
}

//Функция вызывается при нажатии на меню слева (пункт Номера)
function room(){
	$('#filter').hide();
	var str = 'zapros=sel_room';
	$('#add_klient').hide();
	$('#schet').hide();
	$('#objects').show();
	$('#reckoning').hide();
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('objects').innerHTML = a;
		}


	});
}


function sel_room(p){
	var id_reg = document.getElementById('select_region').value;
	var element = document.getElementById('select_object');
	var id_obj = '';
	if((element) && (p == 1))
		id_obj = document.getElementById('select_object').value;	
	var str = 'zapros=sel_room&id_reg=' + id_reg + '&id_obj=' + id_obj;
	$('#add_klient').hide();
	$('#schet').hide();
	$('#objects').show();
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('objects').innerHTML = a;
		}


	});

}


function sel_room_m(reg, obj){
	var str = 'zapros=sel_room&id_reg=' + reg + '&id_obj=' + obj;
	$('#add_klient').hide();
	$('#schet').hide();
	$('#objects').show();
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('objects').innerHTML = a;
		}


	});

}


function sel_object(id_reg){
	if(!id_reg && document.getElementById('select_region'))
		id_reg = document.getElementById('select_region').value;
	var str = 'zapros=sel_obj&id_reg=' + id_reg;
	$('#add_klient').hide();
	$('#objects').show();
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('objects').innerHTML = a;
		}


	});

}


//Функция добавления региона в архив
function reg_to_archive(i){
	var str = 'zapros=reg_to_archive&id_reg=' + i;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str
	});

	$('#str'+i).remove();
}

//Функция добавления объекта в архив
function obj_to_archive(i){
	var str = 'zapros=obj_to_archive&id_obj=' + i;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str
	});
	$('#str'+i).remove();
}

//Функция добавления номера в архив
function room_to_archive(i){
	var str = 'zapros=room_to_archive&id_room=' + i;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str
	});
	$('#str'+i).remove();
}

//Функция сохранения новых номеров (добавление в базу)
function save_new_room(i){
	var id_obj = document.getElementById('select_object').value;
	var name = document.getElementById('new_room'+i).value;
	var y = i + 1;
	var str = 'zapros=save_new_room&id_obj=' + id_obj + '&name_room=' + name;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('str'+i).innerHTML = a;
		}
	});
	$('#str'+i).after("<tr id='str" +y+ "'><td><input type='text' id='new_room" +y+ "' class='input_text' /></td><td><input type='button' onclick='save_new_room(" +y+ ")' value='Добавить' class='button_s' /></td></tr>");
	
}

//Функция сохранения нового объекта (добавление в базу)
function save_new_obj(i){
	var id_reg = document.getElementById('select_region').value;
	var name = document.getElementById('new_obj'+i).value;
	var y = i + 1;
	var str = 'zapros=save_new_obj&id_reg=' + id_reg + '&name_obj=' + name;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('str'+i).innerHTML = a;
		}
	});
	
	$('#str'+i).after("<tr id='str" +y+ "'><td><input type='text' id='new_obj" +y+ "' class='input_text' /></td><td><input type='button' onclick='save_new_obj(" +y+ ")' value='Добавить' class='button_s' /></td></tr>");
	
}

//Функция сохранения нового региона (добавление в базу)
function save_new_reg(i){
	var name = document.getElementById('new_reg'+i).value;
	var str = 'zapros=save_new_reg&name_reg=' + name;
	var y = i + 1;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('str'+i).innerHTML = a;
		}
	});
	
	
	$('#str'+i).after("<tr id='str" +y+ "'><td><input type='text' id='new_reg" +y+ "' class='input_text' /></td><td><input type='button' onclick='save_new_reg(" +y+ ")' value='Добавить' class='button_s' /></td></tr>");
	
}



</script>
</body>
</html>