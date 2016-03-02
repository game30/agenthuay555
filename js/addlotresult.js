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
	
	
	display_content("ajax/ajax.draw.addlotresult.php","","",function(status,msg){
		$("#calculate_content").html(msg)
		$( "#form_calculate" ).validate({
		rules: {
			lot6: {
				required: true,
				minlength:6,
				maxlength:6,
			},
			lot3font1: {
				required: true,
				minlength:3,
				maxlength:3,
			},
			lot3font2: {
				required: true,
				minlength:3,
				maxlength:3,
			},
			lot3back1: {
				required: true,
				minlength:3,
				maxlength:3,
			},
			lot3back2: {
				required: true,
				minlength:3,
				maxlength:3,
			},
			lot2: {
				required: true,
				minlength:2,
				maxlength:2,
			},
			
		},
		messages: {
			lot6: {
				required: "* กรุณาเลข",
				minlength: jQuery.validator.format("* กรุณาใส่ตัวเลขอย่างน้อย {0} ตัวอักษร"),
				maxlength: jQuery.validator.format("* กรุณาใส่ตัวเลขไม่เกิน {0} ตัวอักษร"),
			},
			lot3font1: {
			  	required: "* กรุณาเลข",
				minlength: jQuery.validator.format("* กรุณาใส่ตัวเลขอย่างน้อย {0} ตัวอักษร"),
				maxlength: jQuery.validator.format("* กรุณาใส่ตัวเลขไม่เกิน {0} ตัวอักษร"),
			},
			lot3font2: {
			  	required: "* กรุณาเลข",
				minlength: jQuery.validator.format("* กรุณาใส่ตัวเลขอย่างน้อย {0} ตัวอักษร"),
				maxlength: jQuery.validator.format("* กรุณาใส่ตัวเลขไม่เกิน {0} ตัวอักษร"),
			},
			lot3back1: {
			  	required: "* กรุณาเลข",
				minlength: jQuery.validator.format("* กรุณาใส่ตัวเลขอย่างน้อย {0} ตัวอักษร"),
				maxlength: jQuery.validator.format("* กรุณาใส่ตัวเลขไม่เกิน {0} ตัวอักษร"),
			},
			lot3back2: {
			  	required: "* กรุณาเลข",
				minlength: jQuery.validator.format("* กรุณาใส่ตัวเลขอย่างน้อย {0} ตัวอักษร"),
				maxlength: jQuery.validator.format("* กรุณาใส่ตัวเลขไม่เกิน {0} ตัวอักษร"),
			},
			lot2: {
			  	required: "* กรุณาเลข",
				minlength: jQuery.validator.format("* กรุณาใส่ตัวเลขอย่างน้อย {0} ตัวอักษร"),
				maxlength: jQuery.validator.format("* กรุณาใส่ตัวเลขไม่เกิน {0} ตัวอักษร"),
			},
		 }		
	});
	});
	
	$(document).on('click',"#btn_submit_calculate",function(e){
		var data = "lot6="+$("#lot6").val()+"&lot3font1="+$("#lot3font1").val()+"&lot3font2="+$("#lot3font2").val()+"&lot3back1="+$("#lot3back1").val()+"&lot3back2="+$("#lot3back2").val()+"&lot2="+$("#lot2").val();
		
		if($('#form_calculate').valid())
		{
			display_content("ajax/ajax.set.addlotresult.php",data,"",function(status,msg){
				location.reload();
			});
		}
	});
});