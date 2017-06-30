<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Brakes Controller
 *
 * @property \App\Model\Table\BrakesTable $Brakes
 */
class BrakesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $brakes = $this->paginate($this->Brakes);

        $this->set(compact('brakes'));
        $this->set('_serialize', ['brakes']);
    }

    /**
     * View method
     *
     * @param string|null $id Brake id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $brake = $this->Brakes->get($id, [
            'contain' => ['Departures' => ['Trains']]
        ]);

        $this->set('brake', $brake);
        $this->set('_serialize', ['brake']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $brake = $this->Brakes->newEntity();
        if ($this->request->is('post')) {
            $brake = $this->Brakes->patchEntity($brake, $this->request->getData());
            if ($this->Brakes->save($brake)) {
                $this->Flash->success(__('Le freinage est ajouté.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le freinage n\'a pas été ajouté. Réessayez.'));
        }
        $this->set(compact('brake'));
        $this->set('_serialize', ['brake']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Brake id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $brake = $this->Brakes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $brake = $this->Brakes->patchEntity($brake, $this->request->getData());
            if ($this->Brakes->save($brake)) {
                $this->Flash->success(__('Le freinage est modifié.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le freinage n\'a pas été modifié. Réessayez.'));
        }
        $this->set(compact('brake'));
        $this->set('_serialize', ['brake']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Brake id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $brake = $this->Brakes->get($id);
        if ($this->Brakes->delete($brake)) {
            $this->Flash->success(__('Le freinage est supprimé.'));
        } else {
            $this->Flash->error(__('Le freinage n\'a pas été supprimé. Réessayez.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
