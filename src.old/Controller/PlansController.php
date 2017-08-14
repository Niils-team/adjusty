<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Plans Controller
 *
 * @property \App\Model\Table\PlansTable $Plans
 */
class PlansController extends AppController
{


    public function initialize()
    {
      parent::initialize();
      $this->loadComponent('Flash');
      $this->loadModel('Users');
    }

    public function beforeFilter(\Cake\Event\Event $event)
    {
    parent::beforeFilter($event);
    $this->Auth->allow(['s','fixed','unfixed','unfixedemail','planFixed']);

    }

    public function test()
    {

      $this->autoRender = false;


      $this->loadModel('Users');
      $user = $this->Users->get($this->Auth->user('id'), [
      'contain' => []
      ]);



      $client = new \Google_Client();

      $params = ['usr_id' => 'xxxx'];
      $client->setState(json_encode($params));
      $client->authRequest();





    }

    public function s($code = NULL)
    {

        $plan = $this->Plans->find()
        ->where(["code = " => $code])
        ->first();

        //プランのFixedフラグチェック
        if ($plan['is_fixed']==1) {
          return $this->redirect(['action' => 'plan_fixed']);
        }

        $this->set(compact('plan'));
        $this->set('_serialize', ['plan']);


        $this->loadModel('Events');
        $events = $this->Events->find()
        ->where(["plan_id = " => $plan['id']])
        ->all();

        $this->set(compact('events'));
        $this->set('_serialize', ['events']);

        $this->loadModel('Users');
        $user = $this->Users->get($plan['user_id'], [
        'contain' => []
        ]);

        if ($this->Auth->user()) {
            // ログイン

        } else {
            // 非ログイン
                $this->viewBuilder()->layout('before');

        }



        if ($this->request->is('post')) {

           $guest_email = $this->request->data('email');
           $plan_id = $this->request->data('plan_id');

           //プランのFixedフラグを立てる
           $plansTable = TableRegistry::get('Plans');
           $plans = $plansTable->get($plan_id);
           $plans->is_fixed = 1;
           $plansTable->save($plans);


           $articlesTable = TableRegistry::get('Events');
           $article = $articlesTable->get($this->request->data('event_id'));
           $article->guest_name = $this->request->data('guest_name');
           $article->guest_email = $guest_email;
           $article->fixed_flag = 1;

           $fixed_event = $this->Events->get($this->request->data('event_id'), [
           'contain' => []
           ]);

           # 終日チェック
           if ($fixed_event['allDay'] == 1) {
             $time = '終日';
           } else {
             $time = date('G:i', strtotime($fixed_event['start'])).'〜'.date('G:i', strtotime($fixed_event['end']));
           }


           if ($articlesTable->save($article)) {


             //メール送信処理　設置者へメール送信
             if ($user['is_mail'] == 0) {
             $email = new Email('default');
             $email->from([MEMBER_MAIL => FROM_NAME])
                   ->to($user['email'])
                   ->subject('【Adjusty】予定が確定しました')
                   ->emailFormat('text')
                   ->template('fixed')
                   ->viewVars([
                    'name' => $user['name'],
                    'url' => EVENT_URL.$plan['code'],
                    'title' => $plan['title'],
                    'memo' => $plan['memo'],
                    'event_memo' => $fixed_event['title'],
                    'date' => date('Y年m月d日', strtotime($fixed_event['start'])),
                    'time' => $time,
                    'guest_name' => $article->guest_name,
                    'guest_email' => $guest_email
                    ])
                   ->send();
             }

             //メール送信処理 アポイント申込者へメール送信
             if (!empty($guest_email)) {
             $email = new Email('default');
             $email->from([MEMBER_MAIL => FROM_NAME])
                   ->to($guest_email)
                   ->subject('【Adjusty】予定が確定しました')
                   ->emailFormat('text')
                   ->template('fixed')
                   ->viewVars([
                    'name' => $this->request->data('guest_name'),
                    'url' => EVENT_URL.$plan['code'],
                    'title' => $plan['title'],
                    'memo' => $plan['memo'],
                    'event_memo' => $fixed_event['title'],
                    'date' => date('Y年m月d日', strtotime($fixed_event['start'])),
                    'time' => $time,
                    'guest_name' => $user['name'],
                    'guest_email' => $user['email']
                    ])
                   ->send();
             }

             //Googleカレンダーに予定を登録する
             if ($user['is_gcal'] == 1) {



             }

            //  echo $plan_id;
              return $this->redirect(['action' => 'fixed']);
           }


        }

    }

    public function fixed()
    {

    }

    public function list()
    {

      $this->loadModel('Users');
      $user = $this->Users->get($this->Auth->user('id'), [
      'contain' => []
      ]);

      $plan_cnt = $this->Plans->find()
      ->where(["user_id = " => $user['id']])
      ->count();

      $this->set('plan_cnt', $plan_cnt);

      if ($plan_cnt != 0) {

      $plans = $this->Plans->find()
      ->where(["user_id = " => $user['id']])
      ->where(["is_active = 0"])
      ->order(['created' => 'DESC'])
      ->contain(['Events'])
      ->all();

      $this->set('plans', $plans);


      }

    }


    public function detail($plan_id = null)
    {

        // $plan_id = $this->request->data['plan_id'];

        $plan = $this->Plans->get($plan_id, [
        'contain' => []
        ]);


        $this->loadModel('Events');
        $events = $this->Events->find()
        ->where(["plan_id = " => $plan_id])
        ->all();

        $this->set('events', $events);
        $this->set('plan', $plan);

        if ($this->request->is('post')) {

          $articlesTable = TableRegistry::get('Plans');
          $article = $articlesTable->get($plan_id);
          $article->title = $this->request->data('title');
          $article->memo = $this->request->data('memo');
          $articlesTable->save($article);
          return $this->redirect(['controller' => 'Plans', 'action' => 'detail',$plan_id]);

        }

    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $plan = $this->Plans->get($id);
        if ($this->Plans->delete($plan)) {
            // $this->Flash->success(__('プランを削除しました'));
        } else {
            $this->Flash->error(__('エラーが発生しました'));
        }

        return $this->redirect(['action' => 'top']);
    }


    public function deleteEvent($id = null, $plan_id = null)
    {
        $this->loadModel('Events');
        $this->request->allowMethod(['post', 'delete']);
        $event= $this->Events->get($id);
        if ($this->Events->delete($event)) {
            // $this->Flash->success(__('候補日を削除しました'));
        } else {
            $this->Flash->error(__('エラーが発生しました'));
        }

        return $this->redirect(['action' => 'detail', $plan_id]);
    }

    public function edit($plan_id = null, $event_id = null)
    {
      $this->loadModel('Events');
      $event= $this->Events->get($event_id);
      $this->set('event', $event);
      $this->set('plan_id', $plan_id);

      if ($this->request->is('post')) {

        // $this->Events->patchEntity($event, $this->request->data);
        $start_day = $this->request->data('start_day');
        $start_time = $this->request->data('start_time');
        $end_day = $this->request->data('end_day');
        $end_time = $this->request->data('end_time');

        $start_fixed = $start_day.' '.$start_time;
        $end_fixed = $end_day.' '.$end_time;

        $articlesTable = TableRegistry::get('Events');
        $article = $articlesTable->get($event_id);
        $article->start = $start_fixed;
        $article->end = $end_fixed;
        $article->title = $this->request->data('title');

        // 保存成功
        if ($articlesTable->save($article)) {
          // $this->Flash->success(__('更新されました。'));


          // リダイレクト
          return $this->redirect(['action' => 'detail', $plan_id]);
        }
        // 保存失敗
        $this->Flash->error(__('更新できませんでした。'));
      }

    }

    public function add($plan_id = null)
    {
      $this->set('plan_id', $plan_id);

        if ($this->request->is('post')) {

          $start_day = $this->request->data('start_day');
          $start_time = $this->request->data('start_time');
          $end_day = $this->request->data('end_day');
          $end_time = $this->request->data('end_time');

          $start_fixed = $start_day.' '.$start_time;
          $end_fixed = $end_day.' '.$end_time;


          $this->loadModel('Events');
          $eventsTable = TableRegistry::get('Events');
          $event = $eventsTable->newEntity();
          $event->user_id = $this->Auth->user('id');
          $event->plan_id = $plan_id;
          $event->start = $start_fixed;
          $event->end = $end_fixed;
          $event->title = $this->request->data('title');

                // 保存成功
                if ($eventsTable->save($event)) {
                  // $this->Flash->success(__('候補日が追加されました。'));
                  // $this->Flash->success(__($start_fixed));
                  // リダイレクト
                  return $this->redirect(['action' => 'detail', $plan_id]);
                }else{
                // 保存失敗
                $this->Flash->error(__('更新できませんでした。'));
              }

      }


    }

    public function unfixedemail()
    {

      $this->autoRender = false;

      if ($this->request->is('post')) {

        $guest_name = $this->request->data('guest_name');
        $guest_email = $this->request->data('email');
        $plan_id = $this->request->data('plan_id');
        $user_id= $this->request->data('user_id');
        $code = $this->request->data('code');

        $this->loadModel('Users');
        $user = $this->Users->get($user_id, [
        'contain' => []
        ]);

        $plan = $this->Plans->get($plan_id, [
        'contain' => []
        ]);

        if ($user['is_mail'] == 0) {
        $email = new Email('default');
        $email->from([MEMBER_MAIL => FROM_NAME])
              ->to($user['email'])
              ->subject('【Adjusty】予定が確定しませんでした')
              ->emailFormat('text')
              ->template('unfixed')
              ->viewVars([
               'name' => $user['name'],
               'url' => EVENT_URL.$plan['code'],
               'title' => $plan['title'],
               'memo' => $plan['memo'],
               'guest_name' => $guest_name,
               'guest_email' => $guest_email
               ])
              ->send();
        }

        //メール送信処理 アポイント申込者へメール送信
        if (!empty($guest_email)) {
        $email = new Email('default');
        $email->from([MEMBER_MAIL => FROM_NAME])
              ->to($guest_email)
              ->subject('【Adjusty】予定が確定しませんでした')
              ->emailFormat('text')
              ->template('unfixed')
              ->viewVars([
               'name' => $guest_name,
               'url' => EVENT_URL.$plan['code'],
               'title' => $plan['title'],
               'memo' => $plan['memo'],
               'guest_name' => $user['name'],
               'guest_email' => $user['email']
               ])
              ->send();
        }

        // リダイレクト
        return $this->redirect(['action' => 'unfixed']);

      }

    }

    public function unfixed()
    {

      if ($this->Auth->user()) {
          // ログイン

      } else {
          // 非ログイン
              $this->viewBuilder()->layout('before');

      }

    }


    public function calendar()
    {
      $this->loadModel('Users');
      $user = $this->Users->get($this->Auth->user('id'), [
      'contain' => []
      ]);

      $plan_cnt = $this->Plans->find()
      ->where(["user_id = " => $user['id']])
      ->count();

      $this->set('user', $user);
      $this->set('plan_cnt', $plan_cnt);

      if ($plan_cnt != 0) {

      $plans = $this->Plans->find()
      ->where(["user_id = " => $user['id']])
      ->where(["is_active = 0"])
      ->order(['created' => 'DESC'])
      ->contain(['Events'])
      ->all();

      $this->set('plans', $plans);


      }

    }


    public function top()
    {
        $this->autoRender = false;

        $this->loadModel('Users');
        $user = $this->Users->get($this->Auth->user('id'), [
          'contain' => [],
        ]);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

        return $this->redirect(['action' => 'calendar']);

        // if ($user['is_gcal']==1) {
        //   $params = array(
        //     'client_id' => CONSUMER_KEY,
        //     'redirect_uri' => "https://adjusty.me/plans/callback",
        //   // 'scope' => "https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/calendar",
        //     'scope' => "https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/calendar",
        //     // 'scope' =>  'https://www.googleapis.com/auth/calendar',
        //     'response_type' => 'code',
        //   );
        //   $url = AUTH_URL . '?' . http_build_query($params);
        //   // リダイレクト
        //   // header("Location: " . AUTH_URL . '?' . http_build_query($params));
        //   $this->response->header('Location', $url);
        // } else {
        //   return $this->redirect(['action' => 'calendar']);
        // }

    }

    public function callback()
    {

      $this->autoRender = false;


      $id = $this->Auth->user('id');
      $user = $this->Users->get($this->Auth->user('id'), [
        'contain' => [],
      ]);
      $this->set(compact('user'));
      $this->set('_serialize', ['user']);

      if ($this->request->is(['get'])) {

        $code = $this->request->query('code');

        $params = array(
        	'code' => $code,
        	'grant_type' => 'authorization_code',
        	'redirect_uri' => "https://adjusty.me/plans/callback",
        	'client_id' => CONSUMER_KEY,
        	'client_secret' => CONSUMER_SECRET,
        );

        $data = http_build_query($params, "", "&");

        $header = array(
        "Content-Type: application/x-www-form-urlencoded",
        "Content-Length: ".strlen($data)
        );

        // POST送信
        $options = array('http' => array(
        	'method' => 'POST',
          'header' => implode("\r\n", $header),
        	'content' => $data
        ));
        $res = file_get_contents(TOKEN_URL, false, stream_context_create($options));

        // レスポンス取得
        $token = json_decode($res, true);
        if(isset($token['error'])){
        	echo 'エラー発生';
        	exit;
        }
        $access_token= $token['access_token'];


             $articlesTable = TableRegistry::get('Users');
             $article = $articlesTable->get($id);
             $article->gcal = $code;
             $article->access_token = $access_token;
             $article->is_gcal = 1;

        if ( $articlesTable->save($article)) {
            // $this->Flash->success(__('Googleカレンダーと同期しました'));
// echo var_dump($token);
              return $this->redirect(['action' => 'calendar']);

      }

    }
  }

  public function planFixed()
  {
  }




}
