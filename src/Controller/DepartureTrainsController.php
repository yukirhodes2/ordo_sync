<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

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
     * @param string|null $id Train id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $departureTrain = $this->DepartureTrains->get($id, [
            'contain' => ['Arrivals' => ['Lavages'], 'Departures' => ['Brakes', 'Ways'], 'TheoricDepartures']
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
		$theoricArrival = $this->DepartureTrains->TheoricDepartures->newEntity();
		
        if ($this->request->is('post')) {
			
			$data = $this->request->getData();
            $departureTrain = $this->DepartureTrains->patchEntity($departureTrain, $data);
			
			$result = null;
            if ($result = $this->DepartureTrains->save($departureTrain)) {
				$data['train_id'] = $result->id; // on récupère l'id du nouveau arrival_train pour associer les théoriques
				$data['ascent_time'] = minToSec(intval($data['ascent_time']));
				$theoricArrival = $this->DepartureTrains->TheoricDepartures->patchEntity($theoricArrival, $data);
				if ($this->DepartureTrains->TheoricDepartures->save($theoricArrival)){
                $this->Flash->success(__('The arrival_train has been saved.'));
                return $this->redirect(['action' => 'index']);
				}
            }
			
            $this->Flash->error(__('Le train à l\'arrivée ne peut pas être ajouté. Veuillez réessayer.'));
        }
        $this->set(compact('departureTrain', 'theoricDeparture', 'theoricArrival'));
        $this->set('_serialize', ['departureTrain']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Train id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $departureTrain = $this->DepartureTrains->get($id, [
            'contain' => ['TheoricDepartures', 'TheoricDepartures']
        ]);
		$theoricArrival = $this->DepartureTrains->TheoricDepartures->get($arrival_train->theoric_arrivals['0']->id, [
			'contain' => []
		]);
			
		$theoricDeparture = $this->DepartureTrains->TheoricDepartures->get($arrival_train->theoric_departures['0']->id, [
			'contain' => []
		]);
		
			$theoricArrival['ascent_time'] = intval($theoricArrival['ascent_time'])/60;
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$data = $this->request->getData();
			$data['ascent_time'] = minToSec(intval($data['ascent_time']));
            $departureTrain = $this->DepartureTrains->patchEntity($departureTrain, $data);
			$theoricDeparture = $this->DepartureTrains->TheoricDepartures->patchEntity($theoricDeparture, $data);
			$theoricArrival = $this->DepartureTrains->TheoricDepartures->patchEntity($theoricArrival, $data);
			
            if ($this->DepartureTrains->save($departureTrain) && $this->DepartureTrains->TheoricDepartures->save($theoricArrival) && $this->DepartureTrains->TheoricDepartures->save($theoricDeparture)) {
                $this->Flash->success(__('The arrival_train has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The arrival_train could not be saved. Please, try again.'));
        }
        $this->set(compact('departureTrain', 'theoricArrival', 'theoricDeparture'));
        $this->set('_serialize', ['departureTrain']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Train id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $departureTrain = $this->DepartureTrains->get($id);
        if ($this->DepartureTrains->delete($departureTrain)) {
            $this->Flash->success(__('The arrival_train has been deleted.'));
        } else {
            $this->Flash->error(__('The arrival_train could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
