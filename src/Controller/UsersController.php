<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Exception;

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
    }

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow(['entry', 'activation', 'reminder', 'reset', 'logout', 'login', 'contact', 'emailChange', 'entryHidden','sendGoogle','googleLogin','callback','test']);

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



    public function login()
    {
        $this->viewBuilder()->layout('before');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            $this->Auth->setUser($user);
            $id = $this->Auth->user('id');
            if ($user) {

              //ログイン時刻を取得
              $now_time = date('Y-m-d H:i:s');
              $id = $this->Auth->user('id');
              $articlesTable = TableRegistry::get('Users');
              $article = $articlesTable->get($id);
              $article->login_time = $now_time;
              $articlesTable->save($article);

              if ($this->request->data('autologin') === '1') {
                $this->__setupAutoLogin($user);
            }

                // $this->Flash->success('ログインしました');
                // $this->Flash->success($user['id']);
            return $this->redirect($this->Auth->redirectUrl());
        }
        $this->Flash->error('ユーザー名かパスワードが間違ってます');
    }else {
        if ($autoLoginKey = $this->Cookie->read('AUTO_LOGIN')) {
            $this->loadModel('AutoLogin');
            $query = $this->AutoLogin->findByAutoLoginKey($autoLoginKey);
            if ($query->count() > 0) {
                $userId = $query->first()->user_id;
                $user = $this->Users->get($userId)->toArray();
                if ($user) {
                        // 一度ログインキーを消してから再作成する
                    $this->__destroyAutoLogin($user);
                    $this->__setupAutoLogin($user);
                    $this->Auth->setUser($user);
                        // $this->Flash->success(__('ログインしました'));
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        }
    }
}

public function logout()
{

    $this->viewBuilder()->layout('before');
    $this->loadModel('AutoLogin');
        // $entity = $this->AutoLogin->get($user['id']);
        // $this->AutoLogin->delete($entity);
    $this->Cookie->delete('AUTO_LOGIN');
    $this->Auth->logout();
    //$this->Flash->success('ログアウトしました');
    //return $this->redirect($this->Auth->logout());
}
public function entry()
{
    $this->viewBuilder()->layout('before');
}

public function entryHidden()
{
    $this->viewBuilder()->layout('before');
    $user = $this->Users->newEntity();
    if ($this->request->is('post')) {
        $user = $this->Users->patchEntity($user, $this->request->data);

          //送信先アドレス取得
        $sendto = $this->request->data('email');
          //アクティベーション生成
        $activation_code = md5($sendto.time());
        $user['activation_code'] = $activation_code;

        if ($this->Users->save($user)) {

            //URL取得
            $url = Router::url('/users/activation/', true);

            //welcomメール送信処理
            $email = new Email('default');
            $email->from([MEMBER_MAIL => FROM_NAME])
            ->to($sendto)
            ->subject('【Adjusty】仮登録')
            ->emailFormat('text')
            ->template('welcome')
            ->viewVars(['url' => $url, 'value' => $sendto, 'activation_code' => $activation_code])
            ->send();

                // $this->Flash->success(__('登録アドレスにメールを送信しました'));

              //return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('エラーが発生しました'));
        }
    }
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);
}

public function activation($ac = null, $ac_from = null)
{
    $this->viewBuilder()->layout('before');
    $user_count = $this->Users->find()
    ->where(['activation_code = ' => $ac])
    ->count();

    if ($user_count == 1) {

      //レコードが存在した場合の処理
      $user = $this->Users->find()
      ->where(['activation_code = ' => $ac])
      ->first();

      $id = $user['id'];
      $user = $this->Users->get($id, [
          'contain' => [],
          ]);

      $this->set(compact('user'));
      $this->set('_serialize', ['user']);

      if ($user['is_active'] == 1) {
        $this->Flash->error(__('登録済み'));

        return $this->redirect(['action' => 'login']);
    }
} else {

      //レコードが存在しない場合の処理
  $this->Flash->error(__('有効なURLではありません'));

  return $this->redirect(['action' => 'login']);
}

if ($this->request->is(['patch', 'post', 'put'])) {
    $user = $this->Users->patchEntity($user, $this->request->data);
    $user['is_active'] = 1;

    if ($this->Users->save($user)) {
        $this->Auth->setUser($user);
        $this->Flash->success(__('本登録完了しました'));


        //送信完了メール
        $email = new Email('default');
        $email->from([MEMBER_MAIL => FROM_NAME])
        ->to($user['email'])
        ->subject('【Adjusty】本登録完了')
        ->emailFormat('text')
        ->template('entry_comp')
        ->viewVars(['name' => $user['name']])
        ->send();

        //誘いがあった場合、メッセージ追加

        // 誘い元のユーザを検索
      $from_user = $this->Users->find()
      ->where(['activation_code' => $ac_from])
      ->first();

      if ($from_user) {
        # 誘いがあった場合、メッセージと友達データ追加

            // 友達データ
            $relationshipsTable = TableRegistry::get('Relationships');
            $relationship = $relationshipsTable->newEntity();
            $relationship->user_id = $from_user->id;
            $relationship->target_id = $user->id;
            $relationshipsTable->save($relationship);


            // メッセージ
            $articlesTable = TableRegistry::get('Messages');
            $article = $articlesTable->newEntity();
            $article->from_id = $from_user->id;
            $article->user_id = $user->id;
            $article->kind_id = 1;
            $article->title = '承認リクエストが届いています。';
            $articlesTable->save($article);
      }

        return $this->redirect($this->Auth->redirectUrl());
    }
}
}

public function reminder()
{
    $this->viewBuilder()->layout('before');

    if ($this->request->is(['patch', 'post', 'put'])) {

        //送信先アドレス取得
        $sendto = $this->request->data('email');

        //登録済みか確認
        $user = $this->Users->find()
        ->where(['email = ' => $sendto])
        ->first();

        //未登録だった場合
        if (!isset($user['email'])) {
            $this->Flash->error(__('登録がありません'));

            return $this->redirect(['action' => 'reminder']);
        }

        //アクティベーション生成
        $activation_code = md5($sendto.time());

        //アクティベーション更新
        $user = $this->Users->patchEntity($user, $this->request->data);
        $user['activation_code'] = $activation_code;

        if ($this->Users->save($user)) {

              //URL取得
          $url = Router::url('/users/reset/', true);

              //reminderメール送信処理
          $email = new Email('default');
          $email->from([FROM_MAIL => FROM_NAME])
          ->to($sendto)
          ->subject('【Ajusty】パスワード再設定')
          ->emailFormat('text')
          ->template('reminder')
          ->viewVars(['name' => $user['name'], 'url' => $url, 'value' => $sendto, 'value2' => $activation_code])
          ->send();

          $this->Flash->success(__('再設定メールを送信しました'));
      }
  }
}

      //パスワードリセット
public function reset($ac = null)
{
  if ($ac == null) {
      $this->Flash->error(__('登録がありません'));
  }

  $user = $this->Users->find()
  ->where(['activation_code = ' => $ac])
  ->first();

        //未登録だった場合
  if (!isset($user['email'])) {
    $this->Flash->error(__('登録がありません'));

    return $this->redirect(['action' => 'reminder']);
}

if ($this->request->is(['patch', 'post', 'put'])) {
  $user = $this->Users->find()
  ->where(['activation_code = ' => $ac])
  ->first();

            //パスワード更新
  $user = $this->Users->patchEntity($user, $this->request->data);

  if ($this->Users->save($user)) {
      $this->Flash->success(__('パスワードを再設定しました'));
  }
}

$this->set(compact('user'));
$this->set('_serialize', ['user']);
}

public function logintop()
{
}

public function mypage()
{
        // ログインデータ取得
    $id = $this->Auth->user('id');
    $user = $this->Users->get($id, [
      'contain' => [],
      ]);
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);
}

public function profile()
{

        // ログインデータ取得
    $id = $this->Auth->user('id');
    $user = $this->Users->get($id, [
      'contain' => [],
      ]);
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);

    if ($this->request->is(['patch', 'post', 'put'])) {

                //パスワード更新
        $user = $this->Users->patchEntity($user, $this->request->data);

        if ($this->Users->save($user)) {
                // $this->Flash->success(__('プロフィールを編集しました'));

            return $this->redirect(['action' => 'mypage']);
        }
    }
}

public function setting()
{

      // ログインデータ取得
  $id = $this->Auth->user('id');
  $user = $this->Users->get($id, [
    'contain' => [],
    ]);
  $this->set(compact('user'));
  $this->set('_serialize', ['user']);

  if ($this->request->is('ajax')) {
    $is_mail = $this->request->data['is_mail'];

    $articlesTable = TableRegistry::get('Users');
    $article = $articlesTable->get($this->Auth->user('id'));
    $article->is_mail = $is_mail;
    $articlesTable->save($article);
}
}

public function draw($img_no = null)
{
    $id = $this->Auth->user('id');
    $image = $this->Users->get($id, [
      'contain' => [],
      ]);
    $type = 'img_type'.$img_no;
    $contents = 'img_data'.$img_no;
        // Viewをレンダリングしない
    $this->autoRender = false;


    if (empty($image->$type)) {
        if ($img_no == 2) {
            $this->response->type('image/png');
            readfile('img/no-backimage.png');
        } elseif($img_no == 1) {
            $this->response->type('image/png');
            readfile('img/dammy.png');
        }
    } else {
        $this->response->type($image->$type);
        $this->response->body(stream_get_contents($image->$contents));
    }
}

public function imgEdit()
{
    $id = $this->Auth->user('id');
    $user = $this->Users->get($id, [
      'contain' => [],
      ]);
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);


        // if ($this->request->is(['patch', 'post', 'put'])) {
        //     $type = 'img_type'.$this->request->data['img_no'];
        //     $contents = 'img_data'.$this->request->data['img_no'];
        //
        // // 画像データの存在チェック
        // if (empty($this->request->data['image']['tmp_name'])) {
        //     $this->Flash->error(__('画像が選択されていません'));
        //
        //     return $this->redirect(['action' => 'img_edit']);
        // }
        //
        //     $img_type = $this->request->data['image']['type'];
        //     $image = file_get_contents($this->request->data['image']['tmp_name']);
        //
        //     if ($img_type == 'image/jpeg') {
        //         # code...
        //         $image_data = $this->request->data['image']['tmp_name'];
        //         $exif_datas = exif_read_data($image_data);
        //
        //   // 一時保存するファイルパス
        //   $tmp_file_path = '/tmp/tmp.jpg';
        //
        //         if (isset($exif_datas['Orientation']) && $exif_datas['Orientation'] == 6) {
        //             $source = imagecreatefromjpeg($this->request->data['image']['tmp_name']);
        //             $rotate = imagerotate($source, 270, 0);
        //
        //     // 一時保存
        //     ImageJPEG($rotate, $tmp_file_path);
        //
        //     // ファイル保存
        //     $image = file_get_contents($tmp_file_path);
        //
        //     // ファイルを削除
        //     unlink($tmp_file_path);
        //         }
        //
        //         if (isset($exif_datas['Orientation']) && $exif_datas['Orientation'] == 3) {
        //             $source = imagecreatefromjpeg($this->request->data['image']['tmp_name']);
        //             $rotate = imagerotate($source, 180, 0);
        //
        //       // 一時保存
        //       ImageJPEG($rotate, $tmp_file_path);
        //
        //       // ファイル保存
        //       $image = file_get_contents($tmp_file_path);
        //
        //       // ファイルを削除
        //       unlink($tmp_file_path);
        //         }
        //     }
        //
        //     $articlesTable = TableRegistry::get('Users');
        //     $article = $articlesTable->get($id);
        //     $article->$type = $img_type;
        //     $article->$contents = $image;
        //
        //     if ($articlesTable->save($article)) {
        //         // $this->Flash->success(__('画像を更新しました'));
        //         $this->Flash->success(__($type));
        //
        //         return $this->redirect(['action' => 'imgEdit']);
        //     } else {
        //         $this->Flash->error(__('エラーが発生しました'));
        //     }
        // }
}

public function imgDelete($img_no = null)
{
    $id = $this->Auth->user('id');
    $image = $this->Users->get($id, [
        'contain' => [],
        ]);

    $type = 'img_type'.$img_no;
    $contents = 'img_data'.$img_no;
    $articlesTable = TableRegistry::get('Users');
    $article = $articlesTable->get($id);
    $article->$type = '';
    $article->$contents = '';

    if ($articlesTable->save($article)) {
            // $this->Flash->success(__('画像を削除しました'));

        return $this->redirect(['action' => 'img_edit']);
    } else {
        $this->Flash->error(__('エラーが発生しました'));
    }
}

public function contact()
{
    if ($this->Auth->user()) {
            // ログイン
        $user = $this->Users->get($this->Auth->user('id'), [
          'contain' => [],
          ]);

        $this->set('name', $user['name']);
        $this->set('email', $user['email']);
    } else {
            // 非ログイン
        $this->viewBuilder()->layout('before');

        $this->set('name', '');
        $this->set('email', '');
    }

    if ($this->request->is(['post'])) {

              //メール送信処理
      $email = new Email('default');
              //問い合わせメールをユーザへ送信
      $email->from([SUPPORT_MAIL => FROM_NAME])
      ->to($this->request->data['email'])
      ->subject('【Adjusty】お問い合わせ')
      ->emailFormat('text')
      ->template('contact')
      ->viewVars([
          'name' => $this->request->data['name'],
          'body' => $this->request->data['body'],
          ])
      ->send();

                          //メール送信処理
      $email = new Email('default');
                          //問い合わせメールを運営へ送信
      $email->from([$this->request->data['email'] => $this->request->data['name']])
      ->to(SUPPORT_MAIL)
      ->subject('【Adjusty】お問い合わせ')
      ->emailFormat('text')
      ->template('contact')
      ->viewVars([
          'name' => $this->request->data['name'],
          'body' => $this->request->data['body'],
          ])
      ->send();

            // $this->Flash->success(__('お問い合わせメール送信完了しました'));

      return $this->redirect(['controller' => 'Plans', 'action' => 'top']);
  }
}

public function passwordEdit()
{
    if ($this->request->is(['patch', 'post', 'put'])) {
        $password = $this->request->data('password');
        $password_confirm = $this->request->data('password_confirm');

        if ($password != $password_confirm) {
            $this->Flash->error(__('入力したパスワードが一致しません'));

            return $this->redirect(['controller' => 'Users', 'action' => 'passwordEdit']);
        } else {
            $articlesTable = TableRegistry::get('Users');
            $article = $articlesTable->get($this->Auth->user('id'));
            $article->password = $password;
            $articlesTable->save($article);
                // $this->Flash->success(__('パスワードを変更しました'));

            return $this->redirect(['controller' => 'Users', 'action' => 'setting']);
        }
    }
}

public function emailEdit()
{
    $user = $this->Users->get($this->Auth->user('id'), [
        'contain' => [],
        ]);

    if ($this->request->is(['patch', 'post', 'put'])) {
        $new_email = $this->request->data('email');

          //登録済みか確認
        $new_email_result = $this->Users->find()
        ->where(['email = ' => $new_email])
        ->first();

          //登録だった場合
        if (isset($new_email_result['email'])) {
          $this->Flash->error(__('このアドレスは使用されています'));

          return $this->redirect(['action' => 'setting']);
      } else {

          //アクティベーション生成
          $activation_code = md5($new_email.time());

          //URL取得
          $url = Router::url('/users/email-edit/', true);

          $articlesTable = TableRegistry::get('Users');
          $article = $articlesTable->get($this->Auth->user('id'));
          $article->new_email = $new_email;
          $article->activation_code = $activation_code;
          $articlesTable->save($article);

         //メールアドレス変更手続き
          $email = new Email('default');
          $email->from([FROM_MAIL => FROM_NAME])
          ->to($this->request->data('email'))
          ->subject('【Ajusty】メールアドレス変更手続き')
          ->emailFormat('text')
          ->template('email_edit')
          ->viewVars(['name' => $user['name'], 'activation_code' => $activation_code])
          ->send();

              // $this->Flash->success(__('メールアドレス変更の手続きを送信しました'));

          return $this->redirect(['controller' => 'Users', 'action' => 'setting']);
      }
  }
}

public function changeEmail($ac = null)
{
    $this->viewBuilder()->layout('before');
    $this->Auth->logout();

    $user_count = $this->Users->find()
    ->where(['activation_code = ' => $ac])
    ->count();

    if ($user_count == 1) {

        //レコードが存在した場合の処理
        $user_result = $this->Users->find()
        ->where(['activation_code = ' => $ac])
        ->first();

        //$this->Flash->success($id);
        $user = $this->Users->get($user_result['id'], [
            'contain' => [],
            ]);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

        if (!empty($user['new_email'])) {

        //新アドレス登録
          $articlesTable = TableRegistry::get('Users');
          $article = $articlesTable->get($user['id']);
          $article->email = $user['new_email'];
          $article->new_email = '';
          $articlesTable->save($article);

          //レコードが存在しない場合の処理
          $this->Flash->success(__('メールアドレスを変更しました'));

          return $this->redirect(['action' => 'login']);
      } else {

                  //レコードが存在しない場合の処理
          $this->Flash->error(__('有効なURLではありません'));

          return $this->redirect(['action' => 'error']);
      }
  } else {

        //レコードが存在しない場合の処理
    $this->Flash->error(__('有効なURLではありません'));

    return $this->redirect(['action' => 'error']);
}
}

public function delete()
{
}

public function deleteConfirm()
{
    if ($this->request->is(['patch', 'post', 'put'])) {
        $reason1 = $this->request->data('reason1');
        $reason2 = $this->request->data('reason2');
        $reason3 = $this->request->data('reason3');
        $this->set(compact('reason1', 'reason2', 'reason3'));
        $body = $this->request->data('body');
        $this->set(compact('body'));
    }
}

public function deleteThanks()
{
    if ($this->request->is(['patch', 'post', 'put'])) {
        $id = $this->Auth->user('id');
        $user = $this->Users->get($id, [
          'contain' => [],
          ]);

        $reason1 = $this->request->data('reason1');
        $reason2 = $this->request->data('reason2');
        $reason3 = $this->request->data('reason3');
        $body = $this->request->data('body');

        $this->request->allowMethod(['post', 'delete']);

            //退会メール　ユーザ送信処理
        $email = new Email('default');
        $email->from([SUPPORT_MAIL => FROM_NAME])
        ->to($user['email'])
        ->subject('【Ajusty】退会処理が完了しました')
        ->emailFormat('text')
        ->template('delete')
        ->viewVars(['name' => $user['name']])
        ->send();

              //退会　運営送信処理
        $email = new Email('default');
        $email->from([$user['email'] => $user['name']])
        ->to(SUPPORT_MAIL)
        ->subject('【Ajusty】退会')
        ->emailFormat('text')
        ->template('delete_info')
        ->viewVars(['name' => $user['name'], 'email' => $user['email'], 'reason1' => $reason1, 'reason2' => $reason2, 'reason3' => $reason3, 'body' => $body])
        ->send();

        $this->Users->delete($user);
    }
}

public function mailedit()
{
    $this->autoRender = false;
    if ($this->request->is('ajax')) {
        $id = $this->data['id'];
        $is_mail = $this->data['is_mail'];

        $articlesTable = TableRegistry::get('Users');
        $article = $articlesTable->get($id);
        $article->is_mail = $is_mail;
        $articlesTable->save($article);
    }
}

public function gcalEdit()
{
    $id = $this->Auth->user('id');
    $user = $this->Users->get($id);
    $this->set(compact('user'));

    if ($this->request->is(['patch', 'post', 'put'])) {
        $articlesTable = TableRegistry::get('Users');
        $article = $articlesTable->get($id);
        $article->gmail = $this->request->data('gmail');

        if ($articlesTable->save($article)) {
                // $this->Flash->success(__('Googleアカウントを更新しました'));
          //
          // return $this->redirect(['action' => 'setting']);
        }
    }
}

public function gcalSend()
{
    $this->autoRender = false;
    // //--------------------------------------
    // // 認証ページにリダイレクト
    // //--------------------------------------
    // $params = array(
    //     'client_id' => CONSUMER_KEY,
    //     'redirect_uri' => CALLBACK_URL,
    // // 'scope' => "https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/calendar",
    //     'scope' => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/calendar',
    //     // 'scope' =>  'https://www.googleapis.com/auth/calendar',
    //     'response_type' => 'code',
    // );
    //     $url = AUTH_URL.'?'.http_build_query($params);
    // // リダイレクト
    // // header("Location: " . AUTH_URL . '?' . http_build_query($params));
    // $this->response->header('Location', $url);
    // // echo $url;


    $params = array(
        'client_id' => CONSUMER_KEY,
        'redirect_uri' => "https://adjusty.me/plans/callback",
        // 'scope' => "https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/calendar",
        'scope' => "https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/calendar",
        'response_type' => 'code',
        'access_type' => 'offline',
        'approval_prompt' => 'force'
        );
    $url = AUTH_URL . '?' . http_build_query($params);

      // リダイレクト
      // header("Location: " . AUTH_URL . '?' . http_build_query($params));
    $this->response->header('Location', $url);
}

public function callback()
{
    $this->autoRender = false;

    if ($this->request->is(['get'])) {

        $code = $this->request->query('code');

        $params = array(
          'code' => $code,
          'grant_type' => 'authorization_code',
          'redirect_uri' => "https://adjusty.me/users/callback",
          'client_id' => CONSUMER_KEY,
          'client_secret' => CONSUMER_SECRET,
          'access_type' => 'offline',
          'approval_prompt' => 'force'

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

            //アクセストークンの取得
      $access_token= $token['access_token'];
            //リフレッシュトークンの取得
      $refresh_token= $token['refresh_token'];

      $userInfo = json_decode(
        file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?'.
            'access_token=' . $access_token)
        );

            // echo var_dump($userInfo);

      $email = $userInfo->email;

      $user = $this->Auth->identify();
      $user = $this->Users->find()
      ->where(['email = ' => $email])
      ->first();


      if ($user) {
        $user['access_token'] = $access_token;
        $user['refresh_token'] = $refresh_token;
        $this->Auth->setUser($user);

        $now_time = date('Y-m-d H:i:s');
        $id = $this->Auth->user('id');
        $articlesTable = TableRegistry::get('Users');
        $article = $articlesTable->get($id);
        $article->login_time = $now_time;
        $articlesTable->save($article);

        if ($this->request->data('autologin') === '1') {
          $this->__setupAutoLogin($user);
      }
      return $this->redirect($this->Auth->redirectUrl());

  }else{

                //アカウントが無かった場合は作成する

    $articlesTable = TableRegistry::get('Users');
    $article = $articlesTable->newEntity();
    $article->email = $email;
    $article->name = $userInfo->name;
    $article->is_gcal = 1;
    $article->gmail = $email;
    $article->access_token = $access_token;
    $article->refresh_token = $refresh_token;
    $article->is_active = 1;
    $articlesTable->save($article);

    $user = $article;

    $this->Auth->setUser($user);

    $now_time = date('Y-m-d H:i:s');
    $id = $this->Auth->user('id');
    $articlesTable = TableRegistry::get('Users');
    $article = $articlesTable->get($id);
    $article->login_time = $now_time;
    $articlesTable->save($article);

    if ($this->request->data('autologin') === '1') {
      $this->__setupAutoLogin($user);
  }
  return $this->redirect($this->Auth->redirectUrl());


}



              // $this->Flash->success('ログインしました');
              // $this->Flash->success($user['id']);
              // return $this->redirect($this->Auth->redirectUrl());

            // echo var_dump($user);

            // $user = $this->Auth->identify();
            // $user['email'] = $userInfo->email;
            //
            // // $id = $this->Auth->user('id');
            // if ($user) {
            //     $this->Auth->setUser($user);
            //     return $this->redirect($this->Auth->redirectUrl());
            // }

}
}

public function sendGoogle()
{
    $this->autoRender = false;

    $params = array(
      'client_id' => CONSUMER_KEY,
      'redirect_uri' => "https://adjusty.me/users/callback",
          // 'scope' => "https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/calendar",
      'scope' => "https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/calendar",
      'response_type' => 'code',
      );
    $url = AUTH_URL . '?' . http_build_query($params);

        // リダイレクト
        // header("Location: " . AUTH_URL . '?' . http_build_query($params));
    $this->response->header('Location', $url);

}



public function calSync()
{
    $id = $this->Auth->user('id');
    $user = $this->Users->get($this->Auth->user('id'), [
        'contain' => [],
        ]);
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);

    if ($this->request->is(['patch', 'post', 'put'])) {
        $user = $this->Users->patchEntity($user, $this->request->data);

        if ($this->Users->save($user)) {
            if ($user['is_gcal'] == 1) {
                if (empty($user['gmail'])) {
                  $this->Flash->error(__('連携するGoogleカレンダーのGmailアドレスを入力して下さい'));
                  return $this->redirect(['action' => 'calSync']);
              } else {
                  return $this->redirect(['action' => 'gcalSend']);
              }

              return $this->redirect(['action' => 'gcalSend']);
          } else {
                    // 連携しない場合
            $user['gmail'] = '';
            $this->Users->save($user);
            return $this->redirect(['action' => 'calSync']);
        }
    }
}
}

private function __setupAutoLogin($user)
{
    $this->loadModel('AutoLogin');
    $autoLoginKey = sha1(uniqid() . mt_rand(1, 999999999) . '_auto_login');
    $entity = $this->AutoLogin->newEntity([
        'user_id' => $user['id'],
        'auto_login_key' => $autoLoginKey
        ]);
    $this->AutoLogin->save($entity);

    $this->Cookie->config([
        'expires' => '+7 days',
        'path' => '/'
        ]);
    $this->Cookie->write('AUTO_LOGIN', $autoLoginKey);
}

private function __destroyAutoLogin($user)
{
    $this->loadModel('AutoLogin');
    try {
        $entity = $this->AutoLogin->get($user['id']);
        if ($entity) {
            $this->AutoLogin->delete($entity);
            $this->Cookie->delete('AUTO_LOGIN');
        }
    } catch (RecordNotFoundException $e) {
        $this->Cookie->delete('AUTO_LOGIN');
    }
}

public function coverImgEdet()
{
  $id = $this->Auth->user('id');
  $user = $this->Users->get($id);

  if ($this->request->is("ajax")) {
    $img = $this->request->data['img'];

    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $fileData = base64_decode($img);


    $articlesTable = TableRegistry::get('Users');
    $article = $articlesTable->get($id);
    $article->img_data2 = $fileData;
    $article->img_type2 = 'image/png';
    if ($articlesTable->save($article)) {

    }

}

}


public function mainImgEdet()
{
  $id = $this->Auth->user('id');
  $user = $this->Users->get($id);

  if ($this->request->is("ajax")) {
    $img = $this->request->data['img'];

    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $fileData = base64_decode($img);


    $articlesTable = TableRegistry::get('Users');
    $article = $articlesTable->get($id);
    $article->img_data1 = $fileData;
    $article->img_type1 = 'image/png';
    if ($articlesTable->save($article)) {
              //  return $this->redirect(['action' => 'mypage']);
    }

}

}
public function addresslist()
{

     // ログインデータ取得
    $user = $this->Users->get($this->Auth->user('id'), [
      'contain' => [],
      ]);

    //友達一覧
    $this->loadModel('Relationships');
    $friends = $this->Relationships->find()
    ->where(['user_id' =>$user['id'],'accept_flag' => 1])
    ->contain(['Users'])
    ->all();


    $friends_cnt = $this->Relationships->find()
    ->where(['user_id' =>$user['id'],'accept_flag' => 1])
    ->count();

    $this->set(compact('user','friends','friends_cnt'));
    $this->set('_serialize', ['user']);

    if ($this->request->is(['post'])) {

        $email = $this->request->data['email'];
        $body = $this->request->data['body'];

        //Adjustyユーザか判定
        $target_user = $this->Users->find()
        ->where(['email' => $email])
        ->first();

        if($target_user){


        // 友達追加
        $friend_result = $this->Relationships->find()
        ->where(['target_id' => $target_user->id])
        ->first();

        if ($friend_result) {

            $articlesTable = TableRegistry::get('Relationships');
            $article = $articlesTable->get($friend_result['id']);
            $article->user_id = $this->Auth->user('id');
            $article->target_id = $target_user->id;
            $articlesTable->save($article);

        }else{

          // $user = $this->Users->get($this->Auth->user);

            $relationshipsTable = TableRegistry::get('Relationships');
            $relationship = $relationshipsTable->newEntity();
            $relationship->user_id = $this->Auth->user('id');
            $relationship->target_id = $target_user->id;
            $relationshipsTable->save($relationship);
          }

        if ($friend_result['block_flag'] == 0) {

                // メッセージ追加
                $this->loadModel('Messages');

                $msg_result = $this->Messages->find()
                ->where(['from_id' => $this->Auth->user('id'),'kind_id' => 1])
                ->first();

                if ($msg_result) {

                    $articlesTable = TableRegistry::get('Messages');
                    $article = $articlesTable->get($msg_result['id']);
                    $article->from_id = $this->Auth->user('id');
                    $article->user_id = $target_user->id;
                    $article->is_read = 0;
                    $articlesTable->save($article);


                }else{

                    $articlesTable = TableRegistry::get('Messages');
                    $article = $articlesTable->newEntity();
                    $article->from_id = $this->Auth->user('id');
                    $article->user_id = $target_user->id;
                    $article->kind_id = 1;
                    $article->title = '承認リクエストが届いています。';

                    $articlesTable->save($article);

                }


                $from_user = $this->Users->get($target_user->id);

                if ($from_user['is_mail'] == 0) {
                  //メール送信
                  $email = new Email('default');
                  $email->from([SUPPORT_MAIL => FROM_NAME])
                  ->to($from_user['email'])
                  ->subject('【Ajusty】友達申請のお知らせ')
                  ->emailFormat('text')
                  ->template('friend')
                  ->viewVars(['name' => $from_user['name'], 'from_name' => $user['name'], 'body' => $body])
                  ->send();
                }


            }


        }else{

          // 追加する人が会員外の場合

          $sendto = $email;
          //アクティベーション生成
          $activation_code = md5($sendto.time());

          $articlesTable = TableRegistry::get('Users');
          $article = $articlesTable->newEntity();
          $article->email = $email;
          $article->activation_code = $activation_code;
          

          if ($articlesTable->save($article)) {

            //URL取得
            $url = Router::url('/users/activation/', true);

            //welcomメール送信処理
            $email = new Email('default');
            $email->from([MEMBER_MAIL => FROM_NAME])
            ->to($sendto)
            ->subject('【Adjusty】登録のお誘い')
            ->emailFormat('text')
            ->template('welcome_friend')
            ->viewVars([
              'url' => $url,
              'value' => $sendto,
              'activation_code' => $activation_code,
              'activation_code_from' => $user['activation_code'],
              'body' => $body,
              'from_name' => $user['name']
              ])
            ->send();

                // $this->Flash->success(__('登録アドレスにメールを送信しました'));

              // return $this->redirect(['action' => 'index']);
          } else {
            $this->Flash->error(__('エラーが発生しました'));
          }



        }

        $this->Flash->success(__('友達申請を行いました'));
        return $this->redirect(['controller' => 'Plans','action' => 'calendar']);


       }


    }


       public function drawOther($target_id = null)
       {

        $image = $this->Users->get($target_id, [
          'contain' => [],
          ]);
        $type = 'img_type1';
        $contents = 'img_data1';
        // Viewをレンダリングしない
        $this->autoRender = false;


        if (empty($image->$type)) {
                $this->response->type('image/png');
                readfile('img/dammy.png');
        } else {
            $this->response->type($image->$type);
            $this->response->body(stream_get_contents($image->$contents));
        }
       }

       public function drawOtherBack($target_id = null)
       {

        $image = $this->Users->get($target_id, [
          'contain' => [],
          ]);
        $type = 'img_type2';
        $contents = 'img_data2';
        // Viewをレンダリングしない
        $this->autoRender = false;


        if (empty($image->$type)) {
            $this->response->type('image/png');
            readfile('img/no-backimage.png');
        } else {
            $this->response->type($image->$type);
            $this->response->body(stream_get_contents($image->$contents));
        }
       }


}
