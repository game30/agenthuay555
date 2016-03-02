function display_content(file,data,container_progress,callback){
	$.ajax({
		type: "POST",
		url: file,
		data: data,
	}).error(function(){
		callback('error','Error! ('+ file +') file not found.');
	}).done(function(msg){
		callback('done' ,msg);
	});
}



$(document).ready(function(e) {// JavaScript Document
	
	
	display_content("ajax/ajax.draw.callot.php","","",function(status,msg){
		$("#callot_content").html(msg);
		$('#datepicker').datepicker({
			format: 'dd-mm-yyyy',
			autoclose: true,
			language: 'th',
		});
	});
	
	//btn_display_callot
	
	
	
	$(document).on('click',"#btn_display_callot",function(e){
		var data = "lot_number="+$('#datepicker').val();
		//alert(data)
		display_content("ajax/ajax.draw.callotresult.php",data,"",function(status,msg){
			$("#content_callot_result").html(msg);
		});
	
	});
});