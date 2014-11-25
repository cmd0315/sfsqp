 $(document).ready(function(e) {
 	$('select.flexselect').flexselect();

 	$('#country_id').on('change', function(){
 		var country = $(this).val();
 		if(country > 1) {
 			$('#location1-div').hide();
 			$('#location2-div').show();
 		}
 		else {
 			$('#location2-div').hide();
 			$('#location1-div').show();
 		}
 	});

 	countryID = $('#country_id').val();
	if(countryID > 1) {
		$('#location1-div').hide();
		$('#location2-div').show();
	}
	else {
		$('#location2-div').hide();
		$('#location1-div').show();
	}


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

		if(value == null || value == '') {
			value = $(this).attr('name');
		}
		var name = $(this).attr('id');
		$("#modal-form").attr("action", value);
		$("#subject-name").html(name);
		$('#myModal').modal('show');
	});

	/**
	* For creating/editing the list of countries
	*
	*/
	$('#add-country-div').hide();

	$('#add-country-btn').on('click', function(){
		$(this).hide();
		$('#add-country-div').show();
	});

	$('#cancel-add-btn').on('click', function(){
		$('#add-country-div').hide();
		$('#add-country-btn').show();
	});


	/**
	* For creating/editing the list of countries
	*
	*/
	$('#edit-country-div').hide();

	$('#edit-country-btn').on('click', function(){
		$(this).hide();
		$('#edit-country-div').show();
	});

	$('#cancel-edit-btn').on('click', function(){
		$('#edit-country-div').hide();
		$('#edit-country-btn').show();
	});

	
});