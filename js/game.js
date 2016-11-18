jQuery(document).ready(function($) {
	document.getElementById('game').addEventListener('change', change, false);
});

function change(){
	console.log($(this).val());
	$('.appended').remove();
	switch($(this).val()){
		case "puzzle":
			$('#selectGame').after('<div class="form-group appended">'+
										'<label for="puzzle" class="col-sm-3 control-label item-title">拼圖圖片</label>'+
										'<div class="col-sm-9">'+
										    '<input accept="image/jpeg" type="file" id="puzzle" name="puzzle"/>'+
										'</div>'+
									'</div>');
			break;
		case "memory":
			$('#memory').after('<div class="form-group appended">'+
										'<label for="memory" class="col-sm-3 control-label item-title">遊戲圖片</label>'+
										'<div class="col-sm-9">'+
										    '<input accept="image/jpeg" type="file" id="memory" name="memory[]" multiple/>'+
										'</div>'+
									'</div>');
			break;
		case "mining":
			$('#selectGame').after('<div class="form-group appended">'+
										'<label for="mining" class="col-sm-3 control-label item-title">寶物圖片</label>'+
										'<div class="col-sm-9">'+
										    '<input accept="image/jpeg" type="file" id="mining" name="mining"/>'+
										'</div>'+
									'</div>');
			break;
	}
}