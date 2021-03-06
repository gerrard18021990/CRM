//Функция пункта меню Фильтры
function show_filter(){
	$('#filter').show();
	document.getElementById('see_klient').innerHTML = '';
	document.getElementById('poisk').value = '';
	document.getElementById('other_find_klient').innerHTML = '';
	document.getElementById('surname').value = '';
	document.getElementById('find').innerHTML = '';
	var table = "<div id='result_obj'></div><div id='result_man'></div><table><tr><td><input class='input_text' id='fil_surname_text' onfocus='hide_help(1)' onblur='show_help(1)' type='text' value='Фамилия' /></td><td><input class='input_text' type='date' id='fil_date_z' title='Дата заезда' /></td><td><input class='input_text' type='date' id='fil_date_op' title='Дата оплаты' /></td><td><input class='input_text' type'text' onfocus='hide_help(2)' id='fil_object_text' onkeypress='select_filter(1)' onchange='select_filter(1)'  onkeyup='select_filter(1)' onblur='hide_fil(1)' value='Объект' /></td><td><input type'text' class='input_text' onfocus='hide_help(3)' onkeypress='select_filter(2)' onchange='select_filter(2)' onblur='hide_fil(2)'  onkeyup='select_filter(2)' id='fil_manager_text' value='Менеджер' /></td></tr><tr><td style='text-align: left !important' colspan='5'><input type='button' class='button_s' value='Применить' onclick='filter_do()' id='button_filter'  /></td></tr><tr><td colspan='5'><div id='filter_res'></div></td></tr></table>";
	document.getElementById('filter').innerHTML = table;
	$('#reckoning').hide();
	$('#add_klient').hide();
	$('#poisk_for_surname').show();
	$('#objects').hide();
	$('#schet').hide();
	$('#find').hide();
}


//Применение фильтра
function filter_do(){
	var surname = document.getElementById('fil_surname_text').value;
	if(surname == 'Фамилия') surname = '';
	var object = document.getElementById('fil_object_text').value;
	if(object == 'Объект') object = '';
	var manager = document.getElementById('fil_manager_text').value;
	if(manager == 'Менеджер') manager = '';
	var date_z = document.getElementById('fil_date_z').value;
	var date_op = document.getElementById('fil_date_op').value;
	var str = 'zapros=filter_do&surname=' + surname + '&object=' + object + '&manager=' + manager + '&date_z=' + date_z + '&date_op=' + date_op;
	$.ajax({
		url: 'mysql.php',
		type: 'POST',
		data: str,
		success: function sel(a){
			if(a == '')
				document.getElementById('filter_res').innerHTML = 'Не найдено';
			else
				document.getElementById('filter_res').innerHTML = "<table><tr><td class='td_left'><strong>ФИО</strong></td><td class='td_left'><strong>Дата заезда</strong></td><td class='td_left'><strong>Дата оплаты</strong></td><td class='td_left'><strong>Объект</strong></td><td class='td_left'><strong>Сумма</strong></td><td class='td_left'><strong>Менеджер</strong></td></tr>" + a + "</table>";

		}
	});
}

//


function select_fil_object(name){
	document.getElementById('fil_object_text').value = name;
	document.getElementById('result_obj').innerHTML = '';
	$('#result_obj').hide();
}

function select_fil_manager(name){
	document.getElementById('fil_manager_text').value = name;
	document.getElementById('result_man').innerHTML = '';
	$('#result_man').hide();
}

function hide_fil(obj){
	if(obj == 1){
		var id = 'result_obj';
		var text = 'Объект';
		var text_obj = 'fil_object_text';
	}
	else if(obj == 2){
		var id = 'result_man';
		var text = 'Менеджер';
		var text_obj = 'fil_manager_text';
	}
	if(document.getElementById(text_obj).value == '')
		document.getElementById(text_obj).value = text;
	$('#'+id).hide();
}

function show_help(i){
	if(i == 1){
		if(document.getElementById('fil_surname_text').value == '')
			document.getElementById('fil_surname_text').value = 'Фамилия';
	}
}

function hide_help(i){
	if(i == 1){
		if(document.getElementById('fil_surname_text').value == 'Фамилия')
			document.getElementById('fil_surname_text').value = '';
	}else if(i == 2){
		if(document.getElementById('fil_object_text').value == 'Объект')
			document.getElementById('fil_object_text').value = '';
	}else if(i == 3){
		if(document.getElementById('fil_manager_text').value == 'Менеджер')
			document.getElementById('fil_manager_text').value = '';
	}
}


pos = 0;
select_id = 0;

function select_filter(name_id){

	if(name_id == 1){
		var id_obj = 'result_obj';
		var id_text = 'fil_object_text';
		var zapros = 'fil_object';
	}else if(name_id == 2){
		var id_obj = 'result_man';
		var id_text = 'fil_manager_text';
		var zapros = 'fil_manager';
	}
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
			var text = document.getElementById('div'+pos).innerHTML;
			$('#'+id_obj).hide();
			document.getElementById(id_obj).innerHTML = '';
			document.getElementById(id_text).value = text;
			pos = 0;
			select_id = 0;
			
		}
	}else if(event.keyCode == 27){
		$('#'+id_obj).hide();
		show = 1;
		document.getElementById(id_obj).innerHTML = '';
		pos = 0;
		select_id = 0;
		

	}else{
		var stroka = document.getElementById(id_text).value;
		var str = 'zapros=' + zapros + '&stroka=' + stroka;
		if(stroka != ''){
			$.ajax({
				url: 'mysql.php',
				type: 'POST',
				data: str,
				success: function sel(a){
					$('#'+id_obj).show();
					document.getElementById(id_obj).innerHTML = a;
					pos = 0;
					select_id = 0;
					if(a == 0){
						$('#'+id_obj).hide();
						document.getElementById(id_obj).innerHTML = '';
					}
		
				}
			});
		}else{
			$('#'+id_obj).hide();
			document.getElementById(id_obj).innerHTML = '';
		}
			
	}
		
}


