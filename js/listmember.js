// JavaScript Document
$(document).ready(function(e) {
	
	var rules = new Object();
	var messages = new Object();
	var contener_msg_error = new Object();
	$('input[name^=credit_]:text').each(function() {
		rules[this.name] = { required: true ,min: 0};
		messages[this.name] = { required: 'ใส่ตัวเลขที่ถูกต้อง', min: jQuery.validator.format("ใส่ค่าต่ำสุดได้เท่ากับ {0}") };
	});
	
	var validator = $("#listregister-form").validate({
		rules: rules,
		messages: messages,
		errorPlacement: function(error, element) {
			error.appendTo("#"+element[0].id+"_error");
		}
	});
	
	$('.savecredit').hide();
	
	$(".refund").click(function(e) {
		$("#modalRefundhtml").html('');
        $.ajax({
			async : false,
			url: "modal/modal.creditrefund.php",
			dataType: "html",
			data: "m_id="+$(this).attr('value'),
		}).done(function( html ) {
			$("#modalRefundhtml").html(html);
		});
		$("#modalRefund").modal('show');
    });
	
	
	
	var progress = $(".loading-progress").progressTimer({		
		timeLimit: 1,
		onFinish: function () {
		$("#labelprogressbar").html("ดำเนินการเรียบร้อยแล้ว...");
		$("#labelprogressbar").attr("class","bg-success");
		$("#closemodal").removeAttr("disabled");
		$(".loading-progress").html('');
		//location.reload();
		}
	});
	 
    $("#listregister-form button").click(function(e) {
        if($(this).attr('id') == 'sumiteditprofile')
		{
			alert('sumiteditprofile')
		}
		else if($(this).attr('id') == 'editprofile')
		{
			$("#modalRefundhtml").html('');
			$.ajax({
				url: "modal/modal.editprofile.php",
				dataType: "html",
				data: "userid="+$(this).attr('value'),
			}).done(function( html ) {
				$("#modalRefundhtml").html(html);
			});
			$("#modalRefund").modal('show');	
		}else if($(this).attr('id') == 'addcredit')
		{
			var credit_id = "#credit_"+$(this).val();
			$('.savecredit').hide();
			$('.addcredit').show();
			$('#listregister-form input[type=text]').each(function() {
				$(this).attr('disabled','disabled');
			});
			
			$(this).hide();
			$('[name="savecredit_'+$(this).val()+'"]').show();
			
			$(credit_id).removeAttr('disabled');
			$(credit_id).focus();
		}
		else if($(this).attr('id') == 'savecredit'){
			
			if($("#listregister-form").valid())
			{
				var data = "m_id="+$(this).val()+"&credit="+$("#credit_"+$(this).val()).val();
				$("#modalConfirmcredit").modal('show');
					
				$("#confirmcredit").off('click').click(function () {
					$.ajax({
						url: "ajax/ajax.addcredit.php",
						dataType: "html",
						data: data,
					}).done(function( html ) {
						$('.credit').attr('disabled','disabled');
						$("#modalConfirmcredit").modal('hide');
						$('.savecredit').hide();
						$('.addcredit').show();
					});
				});
			}
		}else if($(this).attr('id') == 'resetpassword'){
			$.ajax({
				url: "modal/modal.resetpassword.php",
				dataType: "html",
				data: "userid="+$(this).attr('value'),
			}).done(function( html ) {
				$("#modalchangepasswordhtml").html(html);
			});	
			$("#modalchangepassword").modal('show');	
		}
    });
});