<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Status Controller
 *
 * @property \App\Model\Table\StatusTable $Status
 */
class StatusController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $status = $this->paginate($this->Status);

        $this->set(compact('status'));
        $this->set('_serialize', ['status']);
    }

    /**
     * View method
     *
     * @param string|null $id Status id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $status = $this->Status->get($id, [
            'contain' => []
        ]);

        $this->set('status', $status);
        $this->set('_serialize', ['status']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $status = $this->Status->newEntity();
        if ($this->request->is('post')) {
            $status = $this->Status->patchEntity($status, $this->request->getData());
            if ($this->Status->save($status)) {
                $this->Flash->success(__('Le statut est modifié.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le statut n\'a pas été ajouté. Réessayez.'));
        }
        $this->set(compact('status'));
        $this->set('_serialize', ['status']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Status id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $status = $this->Status->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $status = $this->Status->patchEntity($status, $this->request->getData());
            if ($this->Status->save($status)) {
                $this->Flash->success(__('Le statut est modifié.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le statut n\'a pas été modifié. Réessayez.'));
        }
        $this->set(compact('status'));
        $this->set('_serialize', ['status']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Status id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $status = $this->Status->get($id);
        if ($this->Status->delete($status)) {
            $this->Flash->success(__('Le statut est supprimé.'));
        } else {
            $this->Flash->error(__('Le statut n\'a pas été supprimé. Réessayez.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
