	$(document).ready(function() {


	    $('#modal').animatedModal({
	        modalTarget: 'animatedModal',
	        animatedIn: 'slideInUp', //表示する時のアニメーション
	        animatedOut: 'slideOutDown', //閉じる時のアニメーション
	        animationDuration: '0.3s', //アニメーションにかける秒数
	        color: '#fff', //背景色
	    });


	    var cnt = 0;



			// $("#date-start").datepicker();
			$( "#date-start" ).datepicker({
				dateFormat: 'yy-mm-dd',
				inline: true
			});


	    $("#time-start").change(function() {
	        inputTimeStart = $("#time-start").val();
	        $("#time-end").val(inputTimeStart);
	    });




			// $("#date-end").datepicker();
			$( "#date-end" ).datepicker({
				dateFormat: 'yy-mm-dd',
				inline: true
			});


	    // Submit前処理
	    $('#submit').click(function() {

	        var top_title = $("#event_title").val();
	        var top_title_length = $("#event_title").val().length;
	        var top_memo_length = $("#event_memo").val().length;

	        if (!top_title) {
	            alert('タイトルが入力されていません')
	            return false;
	        }

					if (top_title_length > 20) {
							alert('予定名は20文字以下で入力して下さい')
							return false;
					}

					if (top_memo_length > 100) {
						alert('メモは100文字以下で入力して下さい')
						return false;
					}



	    });

	    // イベント追加をクリック
	    $('#add').click(function() {



	        var event_title = $("#title").val();
	        var event_title_length = $("#title").val().length;
	        if (!event_title) {
	            var event_title = '';
	        }

					if (event_title_length > 20) {
							alert('メモは20文字以下で入力して下さい')
							return false;
					}


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

	        var start_day = $("#date-start").val();
	        var start_time = $("#time-start").val();
	        var start_fixed = start_day + ' ' + start_time;
	        var start = Date.parse(start_fixed.replace(/-/g, '/')) / 1000

	        // var end = $("#date-end").val();


	        var end_day = $("#date-end").val();
	        var end_time = $("#time-end").val();
	        var end_fixed = end_day + ' ' + end_time;
	        var end = Date.parse(end_fixed.replace(/-/g, '/')) / 1000

	        // console.log('title:' + title);
	        // console.log('start:' + start);
	        // console.log('end:' + end);


	        // $("<input>", {
	        // type: 'hidden',
	        // name: 'event_title['+cnt+']',
	        // value: event_title
	        // }).appendTo('#list_data');
	        //
	        // $("<input>", {
	        // type: 'hidden',
	        // name: 'start['+cnt+']',
	        // // value: $("#date-start").val()
	        // value: start
	        // }).appendTo('#list_data');
	        //
	        // $("<input>", {
	        // type: 'hidden',
	        // name: 'end['+cnt+']',
	        // value: $("#date-end").val()
	        // }).appendTo('#list_data');

	        // var datestart = $("#date-start").val();
	        var datestart = start_fixed;
	        // var dateend = $("#date-end").val();
	        var dateend = end_fixed;

	        var year = datestart.substring(0, 4);
	        var month = datestart.substring(5, 7);
	        var day = datestart.substring(8, 10);
	        var hour = datestart.substring(11, 13);
	        var minute = datestart.substring(14, 16);

	        var hourend = dateend.substring(11, 13);
	        var minuteend = dateend.substring(14, 16);

					// 曜日の取得
					var WeekChars = [ "日", "月", "火", "水", "木", "金", "土" ];
					var userDate = new Date( year, month-1, day );
					var Week = WeekChars[userDate.getDay()];


	        list_html = '<div id="add_event' + cnt + '">' +
	            '<div class="row planlists-item"><div class="col s4"><ul class="center-align">' +
	            // '<li><span class="small-letter">' + year + '</span></li>'
	            '<li><span class="num-big plan-month">' +
	            month + '/' + day +
	            '</span></li><li><span class="small-letter">' + ' (' + Week + ')' + '</span></li></ul></div><div class="col s8">' +
	            $("#title").val() +
	            '<p class="num-mid">' +
	            hour + ':' + minute +
	            '~' +
	            hourend + ':' + minuteend +
	            '</p><a class="btn events-delete-btn" onClick="del(' + cnt + ')" ><i class="material-icons tiny">clear</i></a></div></div></div>' +
							//<a class="btn events-copy-btn" onClick="changeDay(' + cnt + ')" ><span class="hide-on-med-and-down">日付を変更して複製</span><span class="hide-on-large-only"><i class="material-icons tiny">content_copy</i>コピー</span></a>
	            '</div>';

	        $('#list').append(list_html);

	        list_data = '<div id="add_eventdata' + cnt + '">' +
	            '<input name="event_title[]" value="' + event_title + '" type="hidden">' +
	            '<input name="start[]" value="' + start + '" type="hidden">' +
	            '<input name="end[]" value="' + end + '" type="hidden">' +
	            '</div>';
	        $('#data').append(list_data);

	        // 初期化
	        $("#title").val("");
	        $("#date-start").val("");
	        $("#date-end").val("");

	        // var substring = $("#event_title").val();
	        // alert(substring);
	        // $("#date-end").val(substring);

					$('#calendar').fullCalendar('addEventSource', [{
					id:cnt,
					title: event_title,
					start: start_fixed,
					end: end_fixed,
					color: 'red',
					}]);

	        // カウントアップ
	        cnt++;


	    });


	});

	function del(btnNo) {

	    ret = confirm("この候補日を削除しますか？");
	    if (ret == true) {
	        var delevent = '#add_event' + btnNo;
	        var deldata = '#add_eventdata' + btnNo;
	        $(delevent).remove();
	        $(deldata).remove();
	    }

			$('#calendar').fullCalendar("removeEvents", btnNo);
	}

	function changeDay(btnNo) {
		// $("#date-start").val(date.format());
		// $("#date-end").val(date.format());
		// $("#time-start").val('');
		// $("#time-end").val('');
		location.href = "#modal";

	}
