<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Relationships Controller
 *
 * @property \App\Model\Table\RelationshipsTable $Relationships
 */
class RelationshipsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Hosts']
        ];
        $relationships = $this->paginate($this->Relationships);

        $this->set(compact('relationships'));
        $this->set('_serialize', ['relationships']);
    }

    /**
     * View method
     *
     * @param string|null $id Relationship id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $relationship = $this->Relationships->get($id, [
            'contain' => ['Users', 'Hosts']
        ]);

        $this->set('relationship', $relationship);
        $this->set('_serialize', ['relationship']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $relationship = $this->Relationships->newEntity();
        if ($this->request->is('post')) {
            $relationship = $this->Relationships->patchEntity($relationship, $this->request->data);
            if ($this->Relationships->save($relationship)) {
                $this->Flash->success(__('The relationship has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The relationship could not be saved. Please, try again.'));
        }
        $users = $this->Relationships->Users->find('list', ['limit' => 200]);
        $hosts = $this->Relationships->Hosts->find('list', ['limit' => 200]);
        $this->set(compact('relationship', 'users', 'hosts'));
        $this->set('_serialize', ['relationship']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Relationship id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $relationship = $this->Relationships->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $relationship = $this->Relationships->patchEntity($relationship, $this->request->data);
            if ($this->Relationships->save($relationship)) {
                $this->Flash->success(__('The relationship has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The relationship could not be saved. Please, try again.'));
        }
        $users = $this->Relationships->Users->find('list', ['limit' => 200]);
        $hosts = $this->Relationships->Hosts->find('list', ['limit' => 200]);
        $this->set(compact('relationship', 'users', 'hosts'));
        $this->set('_serialize', ['relationship']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Relationship id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $relationship = $this->Relationships->get($id);
        if ($this->Relationships->delete($relationship)) {
            $this->Flash->success(__('The relationship has been deleted.'));
        } else {
            $this->Flash->error(__('The relationship could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
