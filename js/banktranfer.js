

$(document).ready(function(e) {
	var progress ="" ;
	var page = 1;
	
	$("#modal_progress").hide();

	$.fn.datetimepicker.dates['th'] = {
		days: ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์", "อาทิตย์"],
		daysShort: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส", "อา"],
		daysMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส", "อา"],
		months: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
		monthsShort: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
		today: "วันนี้",
		weekStart: 0,
		meridiem: '',
	};
	
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	var d = new Date();
	var dateStr = sprintf('%d-%02d-%02d',yyyy,mm,dd);

	
	$("#start").val(dateStr);
	$("#end").val(dateStr);

	$('#datepicker .input-sm').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true,
		language: 'th',
	});
		
	function loading_show(){
		progress = $(".addbank_loading-progress").progressTimer({		
			timeLimit: 2,
		});
	}
	function loading_modal_show(){
		$("#modal-content").html('<div id="modal_progress" style="padding:20px;"></div>');
		$("#modal").modal('show');
		$("#modal_progress").show();
		progress = $("#modal_progress").progressTimer({		
			timeLimit: 2,
		});
	}
	
	function loading_modal_hide(){
		$("#modal-content").html('');
		$("#modal").modal('hide');
	}
	
	// แสดงตาราง //
	function display_table()
	{
		loading_modal_show();
		$.ajax({
			type: "POST",
			url: "ajax/ajax.banktranferlist.php",
			data: "page="+page+"&start="+$("#start").val()+"&end="+$("#end").val(),
		}).error(function(){
			progress.progressTimer('error', {
				errorText:'ERROR!',
				onFinish:function(){
					alert('There was an error processing your information!');
				}
			});
		}).done(function(msg){
			$('#body_display_bank_tranfer').html(msg);
			progress.progressTimer('complete', {
				onFinish: function () {
					loading_modal_hide();
				}
			});
		});
	}
	$(document).on('click',"#btn_display_bank_tranfer", function(){
		display_table();
	});
	
	$(document).on('click',"#btn_save_bk_transfer", function(){
		loading_show();
		$.ajax({
			type: "POST",
			url: "ajax/ajax.banktranfer.php",
			data: "b_id="+$("#b_name").val()+"&bk_transfer_amount="+$("#bk_transfer_amount").val()+"&bk_transfer_date="+$("#bk_transfer_date").val(),
		}).error(function(){
			progress.progressTimer('error', {
				errorText:'ERROR!',
				onFinish:function(){
					alert('There was an error processing your information!');
				}
			});
		}).done(function(msg){
			progress.progressTimer('complete', {
				onFinish: function () {
					$(".addbank_loading-progress").hide();
					display_table();
				}
			});
		});
	});
	
	
    $(document).on( "click",'#btn_addbanktranfer', function() {
		$("#modal-content").html('');
        $.ajax({
			async : false,
			url: "modal/modal.banktranfer.php",
			dataType: "html",
			data: "m_id="+$(this).attr('value'),
		}).done(function( html ) {
			$("#modal-content").html(html);
			$("#modal_alert_msg").hide();
			
		});
		$("#bk_transfer_date").datetimepicker({
			format: 'yyyy-mm-dd hh:ii',
			autoclose : true,
			todayBtn : true,
			todayHighlight : true,
			startDate : new Date(),
			language: 'th',
		})
		$("#modal").modal('show');
		
	});
	$(document).on( "click",'#body_display_bank_tranfer .pagination li', function() {
		page = $(this).attr('p');
		display_table();
	});
});