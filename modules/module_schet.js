//Функция пунка меню Счета
function show_schet(){

	var html = "<table><tr id='poisk_for_surname'><td><span>Форма поиска по фамилии</span></td><td><input type='text' onkeypress='find_klient()' onchange='find_klient()' onkeyup='find_klient()' title='Введите запрос' id='poisk' class='input_search' /></td><td><input type='button' class='but_search' onclick='find_all_klient()' title='Поиск' /></td></tr></table><div id='find'></div><div id='klients'></div><div id='see_klient'></div>";
	document.getElementById('schet').innerHTML = html;

	$('#filter').hide();
	document.getElementById('filter').innerHTML = '';
	$('#reckoning').hide();
	$('#add_klient').hide();
	$('#poisk_for_surname').show();
	$('#objects').hide();
	$('#schet').show();
	$('#find').hide();
	document.getElementById('other_find_klient').innerHTML = '';
	$('#poisk_for_surname').show();
	document.getElementById('surname').value = '';
	document.getElementById('find').innerHTML = '';
}


//Форма поиска : выбор клиента из выпадающего списка
function find_klient(id){
	var poisk = document.getElementById('poisk').value;
	if(poisk == '') $('#find').hide();
	else $('#find').show();
	var str = 'zapros=find_klient&poisk=' + poisk;
	if(event.keyCode == 40){
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
			if(!id)
				id = document.getElementById('div'+pos).getAttribute('name');
			select_klient(id);
			document.getElementById('klients').innerHTML = '';
		}else{
			if(document.getElementById('poisk') != '')
				find_all_klient();
		}
	}else if(event.keyCode == 27){
		$('#find').hide();
	
	}else{
		if(((poisk.length > 2) && (show == 0)) || (event.keyCode == 46) || (event.keyCode == 8)){
			show = 0;
			$.ajax({
				url: 'mysql.php',
				type: 'POST',
				data: str,
				success: function sel(a){
					document.getElementById('find').innerHTML = a;
					if(a == ''){
						$('#find').hide();
						show = 1;
					}
					pos = 0;
					select_id = 0;
					
				}
			});
		}else 
			$('#find').hide();
	}
}

//Функция поиска клиентов по части фамилии
function find_all_klient(){
	var poisk = document.getElementById('poisk').value;
	var str = 'zapros=find_all_klient&poisk=' + poisk;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			if(a == 1) document.getElementById('klients').innerHTML = 'Форма поиска пуста';
			else if(a == 0) document.getElementById('klients').innerHTML = 'Не удалось найти клиентов';
			else{
				document.getElementById('klients').innerHTML = a;
				document.getElementById('see_klient').innerHTML = '';
				document.getElementById('find').innerHTML = '';
			}
		}
	});	
}

//Функция выбора клиента (из формы поиска)
function select_klient(id){
	$('#find').hide();
	document.getElementById('poisk').value = '';
	
	var str = 'zapros=see_klient&id_klient=' + id;
	
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('see_klient').innerHTML = a;
		}
	});
	
	klietn_schet(id);
}

//Функция просмотра счета клиента
function show_schet_klient(id){
	var str = 'zapros=show_schet_klient&id_schet=' + id;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			$('#tr_h'+id).before(a);
			
			$('#tr_h'+id).remove();
			
		}
	});

}

//Функция скрытия подробного счета клиента
function hide_schet_klient(id){
	var str = 'zapros=hide_shect&id_schet=' + id;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			$('#tr_s2'+id).before(a);
			$('#tr_s1'+id).remove();
			$('#tr_s2'+id).remove();
			
		}
	});
}

//Функция добавления нового счета (скрывает владки бонус и счета)
function new_reck(){

	$('#see_schet').removeClass('see_schet_a').addClass('see_schet_noa');
	$('#see_bonus').removeClass('see_bonus_a').addClass('see_bonus_noa');
	
	var str = 'zapros=add_new_reck';
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('info_turist').innerHTML = a;
		}
	});
	
}

//Функция сохранения счета
function save_new_schet(){
	var b;
	date = new Date();
	var year = date.getUTCFullYear();
	var month = date.getMonth();
	month++;
	var bonus;
	var day = date.getDate();
	var today = year + '-' + month + '-' + day;	
	var sum = document.getElementById('n_sum').value;
	var days = document.getElementById('n_days').value;
	var note = document.getElementById('n_note').value;
	var manager = document.getElementById('n_manager').value;
	var date_z = document.getElementById('n_date_z').value;
	if(document.getElementById('sel_nobj'))
		var id_obj = document.getElementById('sel_nobj').value;
	else var id_obj = '';
	var id_reg = document.getElementById('sel_nreg').value;
	if(document.getElementById('sel_nroom'))
		var id_room = document.getElementById('sel_nroom').value;
	var C = document.getElementById('n_C').value;
	var id_klient = document.getElementById('klient').getAttribute('name');
	if(check.checked){
		bonus = parseInt(document.getElementById('bonus').value)*(-1);
		b = bonus * (-1);
	}
	if(date == '' ) alert('Введите дату');
	else if(sum == '') alert('Введите сумму');
	else if(id_obj == '') alert('Выберите объект');
	else if(days == '') alert('Введите количество дней');
	else if(max_bonus < b) alert('Введено неправильное количество бонусов');
	else if(isNaN(sum)) alert('Неправильно введены данные: Сумма');
	else if(isNaN(days)) alert('Неправильно введены данные: Количество дней');
	else if(isNaN(C) && (C != '')) alert('Неправильно введены данные: Номер счета в 1С');
	else{
		var str = 'zapros=save_schet&id_klient=' + id_klient + '&sum=' + sum + '&days=' + days + '&note=' + note + '&date_z=' + date_z + '&id_obj=' + id_obj + '&id_reg=' + id_reg + '&id_room=' + id_room + '&C=' + C + '&today=' + today + '&bonus=' + bonus + '&manager=' + manager;
		$.ajax({
			url: 'mysql.php',
			type: 'POST',
			data: str,
			success: function sel(a){
				if(a == 1){
					if(document.getElementById('sel_nroom'))
						$('#sel_nroom').hide();
					$('#but_new_schet').show();
					document.getElementById('n_C').value = '';
					document.getElementById('n_date_z').value = '';
					document.getElementById('n_sum').value = '';
					document.getElementById('n_days').value = '';
					document.getElementById('n_note').value = '';
					document.getElementById('n_date_z').value = '';
					$('#sel_nobj').hide();
					$('#new_schet').hide();
					alert('Данные сохранены');
					select_schet();
					
				}else if(a == 2)
					alert('В поле СУММА введите число!');
				else alert('Ошибка!');
			}
	});
	str = 'zapros=all_bonus&id_klient=' + id_klient;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function q(k){
			document.getElementById('all_bonus').innerHTML = k;
		}
	});
	}
}

//Функция вызывается при нажатии на чекбокс добавления поля бонус
function checked_bonus(){
	if(check.checked){
		var id_klient = document.getElementById('klient').getAttribute('name');
		var sum = document.getElementById('n_sum').value;
		var str = 'zapros=add_bonus&id_klient=' + id_klient;
		$.ajax({
			url: 'mysql.php',
			type: 'POST',
			data: str,
			success: function sel(a){
				if(document.getElementById('sel_bonus'))
					$('#sel_bonus').remove();
				$('#add_bonus').after(a);
				var b = parseInt(document.getElementById('bonus').value);
				sum = parseInt(sum);
				max_bonus = parseInt(document.getElementById('bonus').value);
				var res = sum - b;
				document.getElementById('itog_sum').innerHTML = res;

			}
		});
	
	}
	if(!check.checked)
		$('#sel_bonus').remove();
}

//Изменение в поле сумма
function change_sum(){
	if(check.checked){
		var bon = parseInt(document.getElementById('bonus').value);
		var sum = parseInt(document.getElementById('n_sum').value);
		var res = sum - bon;
		document.getElementById('itog_sum').innerHTML = res;
	}

}

//Функция при выборе вкладки счета
function select_schet(){
	$('#new_schet').hide();
	$('#see_bonus').removeClass('see_bonus_a').addClass('see_bonus_noa');
	$('#see_schet').removeClass('see_schet_noa').addClass('see_schet_a');
	var id = document.getElementById('klient').getAttribute('name');
	klietn_schet(id);
}

//Функция при выборе вкладки бонусы
function select_bonus(){
	$('#new_schet').hide();
	$('#see_schet').removeClass('see_schet_a').addClass('see_schet_noa');
	$('#see_bonus').removeClass('see_bonus_noa').addClass('see_bonus_a');
	var id = document.getElementById('klient').getAttribute('name');
	klietn_bonus(id);
}

//Функция для запроса информации о счетах клиента
function klietn_schet(id){
	var str = 'zapros=see_schet&id_klient=' + id;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('info_turist').innerHTML = a;
		}
	});
}

//Функция для запроса информации о бонусах клиента
function klietn_bonus(id){
	var str = 'zapros=see_bonus&id_klient=' + id;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('info_turist').innerHTML = a;
		}
	});
}

//Функция выбора объекта (появляется селект объектов)
function sel_obj_for_nreck(){
	document.getElementById('kl_room').innerHTML = '';
	var id_reg = document.getElementById('sel_nreg').value;
	str = 'zapros=sel_obj_for_nreck&id_reg=' + id_reg;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('kl_object').innerHTML = a;
		}
	});

}

//Функция выбора номера (появляется селект объектов)
function sel_room_for_nreck(){
	var id_obj = document.getElementById('sel_nobj').value;
	str = 'zapros=sel_room_for_nreck&id_obj=' + id_obj;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('kl_room').innerHTML = a;
		}
	});
}

function edit_schet(id){
	var str = 'zapros=edit_schet&id=' + id;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			document.getElementById('info_turist').innerHTML = a;


		}

	});

}

function update_schet(id){
	var sum = document.getElementById('n_sum').value;
	var date_z = document.getElementById('r_date_z').value;
	var days = document.getElementById('r_days').value;
	var manager = document.getElementById('r_manager').value;
	var note = document.getElementById('r_note').value;
	var region = document.getElementById('sel_nreg').value;
	var object = document.getElementById('sel_nobj').value;
	if(document.getElementById('sel_nroom'))
		var room = document.getElementById('sel_nroom').value;
	var C = document.getElementById('r_C').value;
	var log, bonus;
	if(check.checked){
		log = 1;
		bonus = document.getElementById('bonus').value;
		bonus = bonus * (-1);
	}
	else log = 0;
	var str = 'zapros=update_schet&id=' + id + '&sum=' + sum + '&date_z=' + date_z + '&days=' + days + '&manager=' + manager + '&note=' + note + '&region=' + region + '&object=' + object + '&room=' + room + '&C=' + C + '&log=' + log + '&bonus=' + bonus;


	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			if(a == 1){
				alert('Данные успешно изменены');
				select_schet();
				if(log == 1){
					var id_klient = document.getElementById('klient').getAttribute('name');
					str = 'zapros=all_bonus&id_klient=' + id_klient;
					$.ajax({
						url: 'mysql.php',
						type: 'POST',
						data: str,
						success: function q(k){
							document.getElementById('all_bonus').innerHTML = k;
				
						}
					});
				}
				
			}else if(a == 0){
				alert('Ошибка');
			}else alert(a);
		}

	});

}

function checked_sum(){
	var stroka = "<tr id='bonus_tr'><td>Бонусы</td><td><input type='text' id='bonus' onchange='change_sum()' value='0' onKeyPress ='if ((event.keyCode < 48) || (event.keyCode > 57))  event.returnValue = \"\"' class='input_text' /></td><td>Итог:</td><td><span id='itog_sum'></span></td></tr>";
	if(check.checked){
		n_sum.disabled = false;
		$('#add_bonus').after(stroka);
		document.getElementById('itog_sum').innerHTML = document.getElementById('n_sum').value;
		
	}else{
		n_sum.disabled = true;
		$('#bonus_tr').remove();
	}
}