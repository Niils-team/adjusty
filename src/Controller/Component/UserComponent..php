<?php 

namespace App\Controller\Component;
use Cake\Controller\Component;

class UserComponent extends Component{
    public function initialize(array $config) {
        $this->Test = TableRegistry::get("Users");
    }


public function getUser() {
        // ログインデータ取得

        $user = $this->Users->get($this->Auth->user('id'), [
          'contain' => [],
        ]);
        return "test OK!";
}

}


 ?>