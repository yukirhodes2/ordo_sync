<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DepartureTrains Controller
 *
 * @property \App\Model\Table\DepartureTrainsTable $DepartureTrains
 */
class DepartureTrainsController extends AppController
{

	public function isAuthorized($user)
	{
		return ! ( ($this->request->action === 'edit' || $this->request->action === 'delete' || $this->request->action === 'add') && $user['role_id']=== parent::RLP );
	}
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->paginate = [
            'contain' => ['TheoricDepartures']
        ];
        $departureTrains = $this->paginate($this->DepartureTrains);

        $this->set(compact('departureTrains'));
        $this->set('_serialize', ['departureTrains']);
    }

    /**
     * View method
     *
     * @param string|null $id Departure Train id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $departureTrain = $this->DepartureTrains->get($id, [
            'contain' => ['TheoricDepartures']
        ]);

        $this->set('departureTrain', $departureTrain);
        $this->set('_serialize', ['departureTrain']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $departureTrain = $this->DepartureTrains->newEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			if (empty($data['alerte1'])){
				$data['alerte1'] = 0;
			}
			if (empty($data['alerte2'])){
				$data['alerte2'] = 0;
			}
            $departureTrain = $this->DepartureTrains->patchEntity($departureTrain, $data);
            if ($this->DepartureTrains->save($departureTrain)) {
                $this->Flash->success(__('The departure train has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The departure train could not be saved. Please, try again.'));
        }
        $this->set(compact('departureTrain'));
        $this->set('_serialize', ['departureTrain']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Departure Train id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $departureTrain = $this->DepartureTrains->get($id, [
            'contain' => ['TheoricDepartures']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $departureTrain = $this->DepartureTrains->patchEntity($departureTrain, $this->request->getData());
            if ($this->DepartureTrains->save($departureTrain)) {
                $this->Flash->success(__('The departure train has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The departure train could not be saved. Please, try again.'));
        }
        $this->set(compact('departureTrain'));
        $this->set('_serialize', ['departureTrain']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Departure Train id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $departureTrain = $this->DepartureTrains->get($id);
        if ($this->DepartureTrains->delete($departureTrain)) {
            $this->Flash->success(__('The departure train has been deleted.'));
        } else {
            $this->Flash->error(__('The departure train could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
