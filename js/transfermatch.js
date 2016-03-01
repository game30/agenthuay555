
  $(document).ready(function(){
    $(".cs_transfer").on("click", function(){
        if ( $(this).is(":checked")){
            $.post("ajax/ajax.banktransferquery.php",{ bankID:$(this).data("bank"), cs_transfer_id: $(this).data("transferid") },function(data){
                $("#banktransfer").html(data);
            })
        }
        
    });

    $("button:reset").on("click",function(){
      $("#banktransfer").html("");
    });

    $("#submitForm").on("click",function(){
      var validate = true;

      if ( ! $(".cs_transfer").is(":checked") ){
        alert("กรุณาเลือกรายการของลูกค้า");
        validate = false;
        return false;
      }

      if ( ! $(".bank_transfer").is(":checked") ){
        alert("กรุณาเลือกรายการของธนาคาร");
        validate = false;
        return false;
      }

      if ( validate == true ){
        $.post("ajax/ajax.banktransfermatch.php",{ bk_transfer_id: $(".bank_transfer").val(), cs_transfer_id: $(".cs_transfer").val(), bank_amount: $(".bank_transfer").data("bank_amount"), customer_id: $(".cs_transfer").data("uid") }, function(data){
            if ( data.error.code == 1 ){
              window.location.reload();
            } else {
              alert("update failed.");
            }
        })
      }

    })
  

    $('#myModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('content') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
     var slip = button.data('picture')
    var modal = $(this)
    modal.find('.modal-body').html(recipient);
    modal.find('.modal-body').append('<p><img src="'+slip+'" style="max-width:500px;" /></p>');
  });

    $('#myConfirm').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('content') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      
      var modal = $(this)
      modal.find('.modal-body').html(" <p>คุณต้องการลบข้อมูลต่อไปนี้หรือไม่?</p>"+recipient);
    });

    $('#myConfirm').on('shown.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var cs_transfer_id = button.data('id') // Extract info from data-* attributes
      var modal = $(this);

      $("button.confirm").on("click",function(){

          $.post("ajax/ajax.transferdelete.php",{ cs_transfer_id: cs_transfer_id }, function(data){
            if ( data.error.code == 1 ){
              window.location.reload();
            }
          });
      });
    });
});