$(document).ready(function() {
var button = $('#uploadButton'), interval;

$.ajax_upload(button, {
	action : 'upload.php',
	name : 'file',
	onSubmit : function(file, ext){
		//$("img#load").attr("src", "load.gif");
		//$("#uploadButton font").text('Загрузка');
		this.disable();
	},
	onComplete : function(file, response) {
		//$("img#load").attr("src", "loadstop.gif");
		//$("#uploadButton font").text('Загрузить');
		$('.photo_view').attr('src', 'photo/'+file);
		
		this.enable();
	}
});
});