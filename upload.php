<?php
$select = $_POST['sel'];

$act = $_POST['act'];
if($act == 'delete'){
	$file = $_POST['file'];
	unlink($file);

}else{
	$papka = "photo/";
	$uploadedFile = $papka.basename($_FILES['file']['name']);
	if(is_uploaded_file($_FILES['file']['tmp_name'])){
		if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFile)){
			echo "Файл загружен";
		}else{
			echo "Во  время загрузки файла произошла ошибка";
		}
	}else{
		echo "Файл не  загружен";
	}

}

?>