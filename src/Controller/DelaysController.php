<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Delays Controller
 *
 * @property \App\Model\Table\DelaysTable $Delays
 */
class DelaysController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $delays = $this->paginate($this->Delays);

        $this->set(compact('delays'));
        $this->set('_serialize', ['delays']);
    }

    /**
     * View method
     *
     * @param string|null $id Delay id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $delay = $this->Delays->get($id, [
            'contain' => []
        ]);

        $this->set('delay', $delay);
        $this->set('_serialize', ['delay']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $delay = $this->Delays->newEntity();
        if ($this->request->is('post')) {
            $delay = $this->Delays->patchEntity($delay, $this->request->getData());
            if ($this->Delays->save($delay)) {
                $this->Flash->success(__('The delay has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The delay could not be saved. Please, try again.'));
        }
        $this->set(compact('delay'));
        $this->set('_serialize', ['delay']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Delay id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $delay = $this->Delays->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $delay = $this->Delays->patchEntity($delay, $this->request->getData());
            if ($this->Delays->save($delay)) {
                $this->Flash->success(__('The delay has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The delay could not be saved. Please, try again.'));
        }
        $this->set(compact('delay'));
        $this->set('_serialize', ['delay']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Delay id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $delay = $this->Delays->get($id);
        if ($this->Delays->delete($delay)) {
            $this->Flash->success(__('The delay has been deleted.'));
        } else {
            $this->Flash->error(__('The delay could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
