 $(document).ready(function(e) {
 	$('select.flexselect').flexselect();

 	$('#country_id').on('change', function(){
 		var country = $(this).val();
 		if(country > 0) {
 			$('#location1-div').hide();
 			$('#location2-div').show();
 		}
 		else {
 			$('#location2-div').hide();
 			$('#location1-div').show();
 		}
 	});

 	/**
	* For removing table items
	*
	**/
	$('#cancel-btn1').hide(); // default for cancel button in the button group
	$('#remove-btn').on('click', function() {
		$('.btn-delete').show();
		$('.cancel-btn').show();
		$(this).hide();
    });

    $('.cancel-btn').on('click', function() {
		$('.btn-delete').hide();
		$('#cancel-btn1').hide();
		$('#remove-btn').show();
    });

	$('.btn-delete').on('click', function(){
		var value = $(this).val();
		var member_name = $(this).attr('id');
		$("#modal-form").attr("action", value);
		$("#subject-name").html(member_name);
		$('#myModal').modal('show');
	});
});