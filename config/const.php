<?php
  return [
      define('SAMPLE_NUMBER', 10),
      define('TRIAL_DAYS', 30),
      define('DESCRIPTION', 'adjusty'),
      define('FROM_MAIL', 'info@adjusty.me'),
      define('MEMBER_MAIL', 'info@adjusty.me'),
      define('SUPPORT_MAIL', 'support@adjusty.me'),
      define('EVENT_URL', 'https://adjusty.me/plans/s/'),
      define('URL', 'http://testing.adjusty.me/'),
      define('EVENT_EDIT_URL', 'https:\\adjusty.me\plans\edit'),
      define('ACTIVATION', 'https://adjusty.me/users/activation/'),
      define('CHANGE_EMAIL', 'https://adjusty.me/users/change-email/'),
      define('EVENT_DATA', 'http://testing.adjusty.me/events/eventDataEdit'),
      define('FROM_NAME', 'adjusty'),
      define('SIGNATURE', '＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
※このメールを配信しているメールアドレスは送信専用のため、
　このままご返信いただいても、お返事は致しかねますのでご了承ください。

　発行元：Adjusty
　
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝'),
      // define('PERIOD', '+ 30 day'),


      // アプリケーション設定
      define('CONSUMER_KEY', '688303136771-1f0iglgcp0b9nl3d276ehlg7m36bmi9r.apps.googleusercontent.com'),
      define('CONSUMER_SECRET', 'tsPXk4rMFsL-BpsKrbKjOABB'),
      define('CALLBACK_URL', 'https://adjusty.me/users/callback'),
      define('AUTH_URL', 'https://accounts.google.com/o/oauth2/auth'),

      // URL
      define('TOKEN_URL', 'https://accounts.google.com/o/oauth2/token'),
      define('INFO_URL', 'https://www.googleapis.com/oauth2/v1/userinfo'),

      // define('CALENDAR_URL', 'https://www.googleapis.com/calendar/v3/calendars/kimihiko.hattori@gmail.com/events'),
      define('CALENDAR_URL', 'https://www.googleapis.com/calendar/v3/calendars/'),
  ];

 function search_event($plan_id)
 {
     return $events;
 }

 function week_check($datetime)
 {
   $week = array("日", "月", "火", "水", "木", "金", "土");
   $w = (int)$datetime->format('w');
   return $week[$w];
 }
