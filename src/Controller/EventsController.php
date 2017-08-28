<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class EventsController extends AppController
{

  public function initialize()
  {
    parent::initialize();
    $this->loadComponent('Flash');
    $this->loadModel('Plans');
  }

  public function beforeFilter(\Cake\Event\Event $event)
  {
    parent::beforeFilter($event);
    $this->Auth->allow(['e','eventData','googleData']);

        // メッセージ取得
        $this->loadModel('Messages');

        $messages = $this->Messages->find()
        ->where(['user_id' => $this->Auth->user('id'),'Messages.is_active' => 0])
        ->contain(['Users'])
        ->all();

        $msg_flag = $this->Messages->find()
        ->where(['user_id' =>$this->Auth->user('id'),'is_read' => 0,'Messages.is_active' => 0])
        ->count();

        $msg_cnt = $this->Messages->find()
        ->where(['user_id' => $this->Auth->user('id'),'Messages.is_active' => 0])
        ->count();

        $this->set(compact('messages','msg_flag','msg_cnt'));

  }

  public function create()
  {
    $this->loadModel('Users');
    $user = $this->Users->get($this->Auth->user('id'), [
    'contain' => []
    ]);

    $event = $this->Events->newEntity();
    $this->set('event', $event);
    $this->set('_serialize', ['event']);

    if ($this->request->is('post')) {

       //プラン作成
       $PlansTable = TableRegistry::get('Plans');
       $Plans = $PlansTable->newEntity();
       $Plans->user_id = $this->Auth->user('id');
       $Plans->title = $this->request->data['title'];
       $Plans->memo = $this->request->data['memo'];
       $Plans->code = uniqid(rand(1000, 9999));

      if ($PlansTable->save($Plans)) {

            $cnt = count($this->request->data('start'));

            for ($i = 0; $i < $cnt; $i++){
              // 実行する処理

              $event_title = 'event_title.'.$i;
              $start = 'start.'.$i;
              $end = 'end.'.$i;

              $EventsTable = TableRegistry::get('Events');
              $Events = $EventsTable->newEntity();
              $Events->user_id = $this->Auth->user('id');
              $Events->plan_id = $Plans->id;
              $Events->title = $this->request->data($event_title);
              $Events->start = date("Y-m-d H:i:s",$this->request->data($start));
              // $Events->start = new Time(date("Y-m-d H:i:s",$this->request->data($start)));
              // $Events->end = date("Y-m-d H:i:s",$this->request->data($end));
              $Events->end = date("Y-m-d H:i:s",$this->request->data($end));

                //終日チェック
                $deff = $this->request->data($end) - $this->request->data($start);
                if ($deff == 86400) {
                  $Events->allDay = 1;
                }

              $EventsTable->save($Events);
            }

            //メール送信処理
            if ($user['is_mail'] == 0) {
            $email = new Email('default');
            $email->from([MEMBER_MAIL => FROM_NAME])
                  ->to($this->Auth->user('email'))
                  ->subject('【Adjusty】プラン作成')
                  ->emailFormat('text')
                  ->template('created')
                  ->viewVars(['name' => $this->Auth->user('name'),'url' => EVENT_URL.$Plans->code])
                  ->send();
            }

            // $this->Flash->success(__('イベントを作成しました'));
            return $this->redirect(['action' => 'comp',$Plans->code]);

      } else {
        $this->Flash->error(__('エラーが発生しました'));
      }

    }

  }



  public function comp($code = NULL)
  {
    $plan = $this->Plans->find()
    ->where(["code = " => $code])
    ->first();

    if ($plan['title'] == '') {
      $plan['title'] = 'プラン名未設定';
    }

    $this->set('plan_url', EVENT_URL.$code);
    $this->set('plan', $plan);
  }

  public function edit()
  {



  }

  public function eventData()
  {
    // カレンダー開始日時
    //$start = date('Y-m-d H:i:s', $_GET['start']);
    // カレンダー終了日時の１秒前
    //$end = date('Y-m-d H:i:s', $_GET['end'] - 1);

    // レイアウトを使用しない
     //$this->viewBuilder()->layout('');

     $this->autoRender = false;
      $this->response->charset('UTF-8');
      $this->response->type('json');

      $this->loadModel('Plans');

      $this->paginate = [
          'contain' => ['Users','Plans']
      ];

      $events = $this->paginate($this->Events);
      $events = $this->Events->find()
      ->where(["user_id = " => $this->Auth->user('id')])
      ->all();

    // SQLのレスポンスをもとにデータ作成
    $rows = array();
    foreach($events as $event){
      if ($event['fixed_flag'] == 1) {
        $color = '#3ebc3f';
      } else {
        $color = '#b2b2b2';
      }

        $rows[] = array(
            'id' => $event['id'],
            'title' => $event['Plans.title'].$event['title'].$event['guest_name'],
            'start' => date( 'Y-m-d H:i', strtotime($event['start'])),
            'end' => date( 'Y-m-d H:i', strtotime($event['end'])),
            'allDay' => $event['allday'],
            'color' => $color
        );
    }

    // echo json_encode($rows);
    // $this->response->body(json_encode($rows));

    $this->response->type('json');
    $this->response->body(json_encode($rows));
    // echo $rows;
    // return;
    return $this->response;
    // return;

  }

  public function eventDataEdit()
  {
    // カレンダー開始日時
    //$start = date('Y-m-d H:i:s', $_GET['start']);
    // カレンダー終了日時の１秒前
    //$end = date('Y-m-d H:i:s', $_GET['end'] - 1);

    // レイアウトを使用しない
     //$this->viewBuilder()->layout('');

     $this->autoRender = false;
      $this->response->charset('UTF-8');
      $this->response->type('json');


      $this->loadModel('Plans');

      $this->paginate = [
          'contain' => ['Users','Plans']
      ];

      $events = $this->paginate($this->Events);
      $events = $this->Events->find()
      ->where(["user_id = " => $this->Auth->user('id')])
      ->all();

    // SQLのレスポンスをもとにデータ作成
    $rows = array();
    foreach($events as $event){
      if ($event['fixed_flag'] == 1) {
        $color = '#3ebc3f';
      } else {
        $color = '#b2b2b2';
      }

        $rows[] = array(
            'id' => $event['id'],
            'title' => $event['Plans.title'].$event['title'].$event['guest_name'],
            'start' => date( 'Y-m-d H:i', strtotime($event['start'])),
            'end' => date( 'Y-m-d H:i', strtotime($event['end'])),
            'allDay' => $event['allday'],
            // 'url' => EVENT_EDIT_URL.$event['code'],
            // 'url' => 'http://www.yahoo.co.jp',
            'color' => $color,
            'plan_id' => $event['plan_id'],
            'url' => "https://adjusty.me/plans/detail/".$event['plan_id']
        );
    }

    // echo json_encode($rows);
    $this->response->type('json');
    $this->response->body(json_encode($rows));
    // return;
    return $this->response;

  }

  public function googleData()
  {

    $this->autoRender = false;
     $this->response->charset('UTF-8');
     $this->response->type('json');
     $this->response->header( "Content-Type: application/json; charset=utf-8" ) ;

     $this->loadModel('Users');
     $id = $this->Auth->user('id');
     $user = $this->Users->get($this->Auth->user('id'), [
       'contain' => [],
     ]);

     if ($user['is_gcal']==1) {
       $access_token = $user['access_token'];
       $url = CALENDAR_URL.$user['gmail']."/events?access_token=".$access_token."&orderBy=startTime&singleEvents=true";
       //  カレンダーデータ取得
       $json = file_get_contents($url);
     }


     //  カレンダーデータエンコード
     $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

      // echo "<pre>" . print_r(json_decode($json, true), true) . "</pre>";
    $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $arr = json_decode($json,true);

    $rows = array();
    $cnt = count($arr['items'])-1;

    for ($i = 0; $i <= $cnt; $i++) {

      if (isset($arr['items'][$i]['id'])) {
          $rows[$i]['id']= $arr['items'][$i]['id'];
      }else{
        $rows[$i]['id']= "";
      }

      if (isset($arr['items'][$i]['summary'])) {
          $rows[$i]['title']= $arr['items'][$i]['summary'];
      }else{
        $rows[$i]['title']= "";
      }

      if (isset($arr['items'][$i]['start']['dateTime'])) {
          // $rows[$i]['start']= $arr['items'][$i]['start']['dateTime'];
          $rows[$i]['start']= date( 'Y-m-d H:i', strtotime($arr['items'][$i]['start']['dateTime']));
      }

      if (isset($arr['items'][$i]['start']['date'])) {
          $rows[$i]['start']= date( 'Y-m-d H:i', strtotime($arr['items'][$i]['start']['date']));
      }

      if (isset($arr['items'][$i]['end']['dateTime'])) {
          $rows[$i]['end']= date( 'Y-m-d H:i', strtotime($arr['items'][$i]['end']['dateTime']));
      }

      if (isset($arr['items'][$i]['end']['date'])) {
          $rows[$i]['end']= date( 'Y-m-d H:i', strtotime($arr['items'][$i]['end']['date']));
      }

      // $rows[$i]['color'] = "green";
      $rows[$i]['color'] = "#db4437";

  }

// $this->response->body(json_encode($rows , JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES ));
// return

// echo json_encode($rows);
$this->response->type('json');
$this->response->body(json_encode($rows , JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
// return;
return $this->response;

}





}
