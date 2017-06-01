<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Presents Controller
 *
 * @property \App\Model\Table\PresentsTable $Presents
 */
class PresentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $presents = $this->paginate($this->Presents);

        $this->set(compact('presents'));
        $this->set('_serialize', ['presents']);
    }

    /**
     * View method
     *
     * @param string|null $id Present id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $present = $this->Presents->get($id, [
            'contain' => ['BrakeControls']
        ]);

        $this->set('present', $present);
        $this->set('_serialize', ['present']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $present = $this->Presents->newEntity();
        if ($this->request->is('post')) {
            $present = $this->Presents->patchEntity($present, $this->request->getData());
            if ($this->Presents->save($present)) {
                $this->Flash->success(__('The present has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The present could not be saved. Please, try again.'));
        }
        $this->set(compact('present'));
        $this->set('_serialize', ['present']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Present id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $present = $this->Presents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $present = $this->Presents->patchEntity($present, $this->request->getData());
            if ($this->Presents->save($present)) {
                $this->Flash->success(__('The present has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The present could not be saved. Please, try again.'));
        }
        $this->set(compact('present'));
        $this->set('_serialize', ['present']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Present id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $present = $this->Presents->get($id);
        if ($this->Presents->delete($present)) {
            $this->Flash->success(__('The present has been deleted.'));
        } else {
            $this->Flash->error(__('The present could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
