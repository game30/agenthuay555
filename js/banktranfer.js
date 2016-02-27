// JavaScript Document
$(document).ready(function(e) {
	var progress ="" ;
	


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
		$("#modal-content").html('');
		$("#modal").modal('show');
		
		progress = $(".addbank_loading-progress").progressTimer({		
			timeLimit: 2,
		});
	}
	
	// แสดงตาราง //
	$(document).on('click',"#btn_display_bank_tranfer", function(){
		loading_modal_show();
		$.ajax({
			type: "POST",
			url: "ajax/ajax.banktranferlist.php",
			data: "page=1",
		}).error(function(){
			progress.progressTimer('error', {
				errorText:'ERROR!',
				onFinish:function(){
					alert('There was an error processing your information!');
				}
			});
		}).done(function(msg){
			$('#body_display_bank_tranfer').html(msg);
			/*progress.progressTimer('complete', {
				onFinish: function () {
					$(".addbank_loading-progress").hide();
				}
			});*/
		});
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
		}).on('changeDate', function(ev){
			//var str = ev.currentTarget.value;
			//var res = str.split(" ")[0].replace(/-/g ,'');
			//$("#lot_num").val(res);
			//$("#lot_timestamp").val(ev.timeStamp);
		});
		$("#modal").modal('show');
		
	});
});