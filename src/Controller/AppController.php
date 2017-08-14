<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Mailer\Email;

/**
 * Application Controller.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $paginate = [
  'limit' => 10,
  ];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');

        $this->Session = $this->request->session();

         //認証
         $this->loadComponent('Auth', [
                     'authenticate' => [
                       'Form' => [
                         'fields' => [
                           'username' => 'email',
                           'password' => 'password',
                         ],
                       ],
                     ],

                     'loginAction' => [
                         'controller' => 'Users',
                         'action' => 'login',
                     ],

                     'loginRedirect' => [
                         'controller' => 'Plans',
                         'action' => 'top',
                     ],

                     'logoutRedirect' => [
                       'controller' => 'Users',
                       'action' => 'logout',
                     ],
                     'authError' => __('ログインが必要です'),
               ]);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     *
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

        // 認証コンポーネントをViewで利用可能にしておく
        $this->set('auth', $this->Auth);
    }
}
