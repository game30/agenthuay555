// JavaScript Document
$(document).ready(function(e) {
	
	$("#closemodal").click(function(e) {
        window.location.replace("addmember.php");
    });
	
	$("#submitaddmember").click(function(e) {
		if($( "#addmemberform" ).valid())
		{
			//$("#myModal").modal('show');
			var progress = $(".loading-progress").progressTimer({
					timeLimit: 10,
					onFinish: function () {
					$("#labelprogressbar").html("ดำเนินการเรียบร้อยแล้ว...");
					$("#labelprogressbar").attr("class","bg-success");
					$("#closemodal").removeAttr("disabled");
					$(".loading-progress").html('');
				//location.reload();
				}
			});
			
			var CommentData = "username="+$("#username").val()+"&name="+$("#name").val()+"&tell="+$("#tell").val()+"&password="+$("#password").val()+"&r_id="+$("#r_id").val();
			
			$.ajax({
				type: "POST",
				url: "ajax/ajax.addmember.php",
				data : CommentData,
			}).error(function(){
					
				progress.progressTimer('error', {
					errorText:'ERROR!',
					onFinish:function(){
						alert('There was an error processing your information!');
					}
				});
			}).done(function(html)
			{
				//alert(html);
				$("#myModal").modal('show');
				progress.progressTimer('complete');
			});
		}
		
    });
	
	
    $( "#addmemberform" ).validate({
		rules: {
			name: {
				required: true,
				minlength:2,
			},
			tell: {
				required: true,
				//matches: "[0-9]+",  // <-- no such method called "matches"!
				number: true,
				minlength:10,
				maxlength:10
			},
			password: {
				required: true,
				minlength:6,
			},
			
		},
		messages: {
			name: {
				required: "* กรุณากรอก ชื่อ",
				minlength: jQuery.validator.format("* กรุณาใส่ตัวอักษรอย่างน้อย {0} ตัวอักษร")
			},
			password: {
			  	required: "* กรุณากรอก รหัสผ่าน",
				minlength: jQuery.validator.format("* กรุณาใส่ตัวอักษรอย่างน้อย {0} ตัวอักษร")
			},
			tell: {
			  	required: "* กรุณากรอก เบอร์โทร",
				minlength: jQuery.validator.format("* กรุณาใส่ตัวอักษรอย่างน้อย {0} ตัวอักษร"),
			  	number: jQuery.validator.format("* กรุณาใส่ตัวเลข")
			},
		 }		
	});
	
	$.ajax({
		url: "ajax/getnewuser.php",
		dataType: "html",
	}).done(function( html ) {
		$("#username").val(html)
	});
});
	