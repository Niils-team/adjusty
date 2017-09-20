	$(document).ready(function() {

		$( "#date-start" ).datepicker({
			dateFormat: 'yy-mm-dd',
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
				dateFormat: 'yy-mm-dd',
				inline: true
			});



			$('#submit').click(function() {

				var time_start = $("#time-start").val();
				if (!time_start) {
					alert("開始時刻を入力してください");
					return false;
				}

				var date_start = $("#date-start").val();
				if (!date_start) {
					alert("開始日を入力してください");
					return false;
				}
				var date_end = $("#date-end").val();
				if (!date_end) {
					alert("終了日を入力してください");
					return false;
				}

			    var top_title_length = $("#title").val().length;

			    if (top_title_length > 20) {
			        alert('メモは20文字以下で入力して下さい');
			        return false;
			    }

			});



	});
