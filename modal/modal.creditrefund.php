<script>
	$(document).ready(function(){
		var progress ="" ;
		function loading_show(){
			//$("#container_refund").html("<img src='images/loading.gif'/>");
			progress = $("#container_refund").progressTimer({		
				timeLimit: 2,
			});
		}
		
		function loading_hide(){
			$('#loading_refund').fadeOut('fast');
		}                
		
		function loadData(page,id){
			loading_show();                   
			$.ajax({
				type: "POST",
				url: "ajax/ajax.creditrefund.php",
				data: "page="+page+"&m_id="+id,
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
						$("#container_refund").html(msg);
					}
				});
				$("#container_refund").html(msg);
			});
		}
		
		loadData(1,<?php echo $_REQUEST['m_id'] ?>);  // For first time page load default results
		
		$(document).on( "click",'#container_refund .pagination li', function() {
			var page = $(this).attr('p');
			var id = $(this).attr('valueid');
			loadData(page,id);
		});
	});
</script>
<style type="text/css">

#loading_refund{
	width: 100%;
	position: absolute;
	top: 100px;
	left: 100px;
	margin-top:200px;
}
.total
{
	float:right;font-family:arial;color:#999;
}

</style>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">ประวัติการใช้งาน</h4>
</div>
<div class="modal-body">
    <div id="loading_refund"></div>
    <div id="container_refund">
        <div class="data_refund"></div>
        <div class="pagination_refund"></div>
    </div>
</div>