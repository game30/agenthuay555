// JavaScript Document
$(document).ready(function(e) {
	
	
				
    $("#listregister-form button").click(function(e) {
        if($(this).attr('id') == 'add'){
			window.location = "addmember.php?r_id="+$(this).val();	
		}
		else
		{
			var id = $(this).val();
			 $("#modalConfirm").modal('show');    // wire up the OK button to dismiss the modal when shown
			 $("#confirm").off('click').click(function () {
				$.ajax({
					url: "ajax/removeregister.php",
					dataType: "html",
					data: "id="+id,
				}).done(function( html ) {
					location.reload();
				});
			});
		}
    });
});