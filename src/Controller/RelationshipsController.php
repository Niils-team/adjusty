<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Exception;

/**
 * Relationships Controller
 *
 * @property \App\Model\Table\RelationshipsTable $Relationships
 */
class RelationshipsController extends AppController
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


        // メッセージ取得
        $this->loadModel('Messages');

        $messages = $this->Messages->find()
        ->where(['user_id' => $this->Auth->user('id')])
        ->contain(['Users'])
        ->all();

        $msg_flag = $this->Messages->find()
        ->where(['user_id' =>$this->Auth->user('id'),'is_read' => 0])
        ->count();

        $msg_cnt = $this->Messages->find()
        ->where(['user_id' => $this->Auth->user('id')])
        ->count();

        $this->set(compact('messages','msg_flag','msg_cnt'));

    }


    public function request($id = null, $message_id = null)
    {

      //既読フラグ
      $this->loadModel('Messages');
      $articlesTable = TableRegistry::get('Messages');
      $article = $articlesTable->get($message_id);
      $article->is_read = 1;
      $articlesTable->save($article);

    //リクエスト一覧
    $this->loadModel('Relationships');

    $friend = $this->Relationships->find()
          ->where(['user_id' => $id])
          ->contain(['Users'])
          ->first();

    if (!$friend) {
        return $this->redirect(['controller' => 'Plans','action' => 'calendar']);
    }

    $this->loadModel('Users');
    $from_user = $this->Users->get($id);

    if ($this->Auth->user('id') != $friend['target_id']) {
        return $this->redirect(['controller' => 'Plans','action' => 'calendar']);
    }

    $this->set(compact('friend','from_user'));



    if ($this->request->is(['post'])) {

        if ($this->request->data('block')) {
          $articlesTable = TableRegistry::get('Relationships');
          $article = $articlesTable->get($friend['id']);
          $article->block_flag = 1;
          $articlesTable->save($article);

          return $this->redirect(['controller' => 'Plans','action' => 'calendar']);
        }

        if ($this->request->data('accept')) {

          $articlesTable = TableRegistry::get('Relationships');
          $article = $articlesTable->get($friend['id']);
          $article->accept_flag = 1;
          $articlesTable->save($article);

          //新規追加
          $RelationshipsTable = TableRegistry::get('Relationships');
          $Relationship = $RelationshipsTable->newEntity();
          $Relationship->user_id = $this->Auth->user('id');
          $Relationship->target_id = $friend['id'];
          $Relationship->accept_flag = 1;
          $RelationshipsTable->save($Relationship);

          return $this->redirect(['controller' => 'Plans','action' => 'calendar']);

        }

    }


    }

}
