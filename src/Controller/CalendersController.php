<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Calenders Controller
 *
 * @property \App\Model\Table\CalendersTable $Calenders
 */
class CalendersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Plans']
        ];
        $calenders = $this->paginate($this->Calenders);

        $this->set(compact('calenders'));
        $this->set('_serialize', ['calenders']);
    }

    /**
     * View method
     *
     * @param string|null $id Calender id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $calender = $this->Calenders->get($id, [
            'contain' => ['Users', 'Plans']
        ]);

        $this->set('calender', $calender);
        $this->set('_serialize', ['calender']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $calender = $this->Calenders->newEntity();
        if ($this->request->is('post')) {
            $calender = $this->Calenders->patchEntity($calender, $this->request->data);
            if ($this->Calenders->save($calender)) {
                $this->Flash->success(__('The calender has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The calender could not be saved. Please, try again.'));
        }
        $users = $this->Calenders->Users->find('list', ['limit' => 200]);
        $plans = $this->Calenders->Plans->find('list', ['limit' => 200]);
        $this->set(compact('calender', 'users', 'plans'));
        $this->set('_serialize', ['calender']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Calender id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $calender = $this->Calenders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $calender = $this->Calenders->patchEntity($calender, $this->request->data);
            if ($this->Calenders->save($calender)) {
                $this->Flash->success(__('The calender has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The calender could not be saved. Please, try again.'));
        }
        $users = $this->Calenders->Users->find('list', ['limit' => 200]);
        $plans = $this->Calenders->Plans->find('list', ['limit' => 200]);
        $this->set(compact('calender', 'users', 'plans'));
        $this->set('_serialize', ['calender']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Calender id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $calender = $this->Calenders->get($id);
        if ($this->Calenders->delete($calender)) {
            $this->Flash->success(__('The calender has been deleted.'));
        } else {
            $this->Flash->error(__('The calender could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
