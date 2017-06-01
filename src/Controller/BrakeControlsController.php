<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BrakeControls Controller
 *
 * @property \App\Model\Table\BrakeControlsTable $BrakeControls
 */
class BrakeControlsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Departures', 'Presents']
        ];
        $brakeControls = $this->paginate($this->BrakeControls);

        $this->set(compact('brakeControls'));
        $this->set('_serialize', ['brakeControls']);
    }

    /**
     * View method
     *
     * @param string|null $id Brake Control id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $brakeControl = $this->BrakeControls->get($id, [
            'contain' => ['Departures', 'Presents']
        ]);

        $this->set('brakeControl', $brakeControl);
        $this->set('_serialize', ['brakeControl']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $brakeControl = $this->BrakeControls->newEntity();
        if ($this->request->is('post')) {
            $brakeControl = $this->BrakeControls->patchEntity($brakeControl, $this->request->getData());
            if ($this->BrakeControls->save($brakeControl)) {
                $this->Flash->success(__('The brake control has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The brake control could not be saved. Please, try again.'));
        }
        $departures = $this->BrakeControls->Departures->find('list', ['limit' => 200]);
        $presents = $this->BrakeControls->Presents->find('list', ['limit' => 200]);
        $this->set(compact('brakeControl', 'departures', 'presents'));
        $this->set('_serialize', ['brakeControl']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Brake Control id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $brakeControl = $this->BrakeControls->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $brakeControl = $this->BrakeControls->patchEntity($brakeControl, $this->request->getData());
            if ($this->BrakeControls->save($brakeControl)) {
                $this->Flash->success(__('The brake control has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The brake control could not be saved. Please, try again.'));
        }
        $departures = $this->BrakeControls->Departures->find('list', ['limit' => 200]);
        $presents = $this->BrakeControls->Presents->find('list', ['limit' => 200]);
        $this->set(compact('brakeControl', 'departures', 'presents'));
        $this->set('_serialize', ['brakeControl']);
    }
	
	public function request_pers($id = null) {
		
		$query = $brake_controls->find('all')
		->where(['BrakeControls.departure_id =' => $id])
		->contain(['Presents']);
	}

    /**
     * Delete method
     *
     * @param string|null $id Brake Control id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $brakeControl = $this->BrakeControls->get($id);
        if ($this->BrakeControls->delete($brakeControl)) {
            $this->Flash->success(__('The brake control has been deleted.'));
        } else {
            $this->Flash->error(__('The brake control could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
