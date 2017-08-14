

$(document).ready(function() {

    $('#calendar').fullCalendar({
        // ヘッダーのタイトルとボタン
        header: {
            // title, prev, next, prevYear, nextYear, today
            right: 'prev,next today month basicWeek',
            left: 'title',
        },
        // jQuery UI theme
        theme: false,
        // ボタン文字列
        buttonText: {
            prev: '<<', // <
            next: '>>', // >
            prevYear: '前年', // <<
            nextYear: '次年', // >>
            today: '今日',
            month: '月',
            week: '週',
            day: '日'
        },

        // 終日スロットを表示
        allDaySlot: true,
        // 終日スロットのタイトル
        allDayText: '終日',
        // スロットの時間の書式
        axisFormat: 'H:mm',
        // 時間の書式
        timeFormat: 'H:mm',
        // 月名称
        monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        // 月略称
        monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        // 曜日名称
        dayNames: ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
        // 曜日略称
        dayNamesShort: ['日', '月', '火', '水', '木', '金', '土'],

        // コンテンツの高さ(px)
        contentHeight: 400,
        // 最初の曜日
        firstDay: 1, // 1:月曜日
        // 土曜、日曜を表示
        weekends: true,

        // クリックしたらポップアップウィンドウ
        dayClick: function(date, jsEvent, view) {
            $("#date-start").val(date.format());
            $("#date-end").val(date.format());
            $("#time-start").val('');
            $("#time-end").val('');
            window.location.href = "#modal";
        },

        googleCalendarApiKey: '274185438642-dgsb3lcno471pai3o34e45k11pncvn9f.apps.googleusercontent.com',

        eventSources: [
            // Asjusty内で作ったイベントの取得
            'https://adjusty.me/events/eventDataEdit',
            // Googleカレンダーのイベントの取得
            'https://adjusty.me/events/googleData'
        ]


    });

});
