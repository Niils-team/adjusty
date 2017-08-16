$(document).ready(function() {

    $('#calendar').fullCalendar({
        // ヘッダーのタイトルとボタン
        header: {
            // title, prev, next, prevYear, nextYear, today
            left: 'today prev,next',
            center: 'title',
            right: 'agendaDay,agendaWeek,month,listDay'
        },
        // viewの設定
        views: {
            month: { // name of view
                titleFormat: 'YYYY年MM月'
            },
            week: {
                titleFormat: 'M月DD日'
            },
            agenda: {
              scrollTime: '07:00:00',
              minTime:'00:00:00',
              maxTime:'24:00:00'
            },
            day: {
                titleFormat: 'M月DD日'
            }
        },
        // jQuery UI theme
        theme: false,
        // ボタン文字列
        buttonText: {
            prev: '<', // <<
            next: '>', // >>
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
        // agenda view の縦軸
        slotLabelFormat: 'H:mm',
        // 時間の書式
        timeFormat: 'H:mm',
        // 時間表記の初期値
        firstHour: '6:00',
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
        // eventClick: function(event) {
        //     // window.open(event.url, 'gcalevent', 'width=700,height=600');
        //     // return false;
        // },
        googleCalendarApiKey: '274185438642-dgsb3lcno471pai3o34e45k11pncvn9f.apps.googleusercontent.com',

        eventSources: [
            // Asjusty内で作ったイベントの取得
            'https://adjusty.me/events/eventDataEdit',
            // Googleカレンダーのイベントの取得
            'https://adjusty.me/events/googleData'
        ]


    });

});
