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
		$theoricDeparture = $this->DepartureTrains->TheoricDepartures->newEntity();
		
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			
	
			if (empty($data['alerte1'])){
				$data['alerte1'] = 0;
			}
			else{
				$data['alerte1'] = minToSec(intval($data['alerte1']));
			}
			if (empty($data['alerte2'])){
				$data['alerte2'] = 0;
			}
			else{
				$data['alerte2'] = minToSec(intval($data['alerte2']));
			}
            $departureTrain = $this->DepartureTrains->patchEntity($departureTrain, $data);
			
			$result = null;
            if ($result = $this->DepartureTrains->save($departureTrain)) {
				$data['train_id'] = $result->id; // on récupère l'id du nouveau arrival_train pour associer les théoriques
				$data['descent_duration'] = minToSec(intval($data['descent_duration']));
				$data['rendition_duration'] = minToSec(intval($data['rendition_duration']));
				$data['docking_time'] = minToSec(intval($data['docking_time']));
				$theoricDeparture = $this->DepartureTrains->TheoricDepartures->patchEntity($theoricDeparture, $data);
				if ($this->DepartureTrains->TheoricDepartures->save($theoricDeparture)){
					$this->Flash->success(__('Ajouté'));
					return $this->redirect(['action' => 'index']);
				}
            }
			debug($departureTrain);
			debug(isset($data['landy_departure']));
            $this->Flash->error(__('Problème lors de l\'ajout.'));
        }
        $this->set(compact('departureTrain', 'theoricDeparture'));
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
                $this->Flash->success(__('Modifié'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Problème lors de la modification.'));
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
            $this->Flash->success(__('Supprimé'));
        } else {
            $this->Flash->error(__('Problème lors de la suppression.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
