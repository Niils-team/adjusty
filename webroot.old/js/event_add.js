	$(document).ready(function() {

		$( "#date-start" ).datepicker({
			inline: true
		});


	    $("#date-start").change(function() {
	        inputDataStart = $("#date-start").val();
	        $("#date-end").val(inputDataStart);
	    });

	    $("#time-start").change(function() {
	        inputTimeStart = $("#time-start").val();
	        $("#time-end").val(inputTimeStart);
	    });

			$( "#date-end" ).datepicker({
				inline: true
			});


	});
