<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use google\apiclient;

/**
 * Plans Controller
 *
 * @property \App\Model\Table\PlansTable $Plans
 */
class MessagesController extends AppController
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


  public function list()
  {
    
  }




}
