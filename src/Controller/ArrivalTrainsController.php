<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * ArrivalTrains Controller
 *
 * @property \App\Model\Table\ArrivalTrainsTable $ArrivalTrains
 */
class ArrivalTrainsController extends AppController
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
            'contain' => ['TheoricArrivals']
        ];
        $arrivalTrains = $this->paginate($this->ArrivalTrains);
		
        $this->set(compact('arrivalTrains'));
        $this->set('_serialize', ['arrivalTrains']);
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
        $arrivalTrain = $this->ArrivalTrains->get($id, [
            'contain' => ['Arrivals' => ['Lavages'], 'Departures' => ['Brakes', 'Ways'], 'TheoricArrivals']
        ]);

        $this->set('arrivalTrain', $arrivalTrain);
        $this->set('_serialize', ['arrivalTrain']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $arrivalTrain = $this->ArrivalTrains->newEntity();
		$theoricArrival = $this->ArrivalTrains->TheoricArrivals->newEntity();
		
        if ($this->request->is('post')) {
			
			$data = $this->request->getData();
            $arrivalTrain = $this->ArrivalTrains->patchEntity($arrivalTrain, $data);
			
			$result = null;
            if ($result = $this->ArrivalTrains->save($arrivalTrain)) {
				$data['train_id'] = $result->id; // on récupère l'id du nouveau arrival_train pour associer les théoriques
				$data['ascent_time'] = minToSec(intval($data['ascent_time']));
				$theoricArrival = $this->ArrivalTrains->TheoricArrivals->patchEntity($theoricArrival, $data);
				if ($this->ArrivalTrains->TheoricArrivals->save($theoricArrival)){
                $this->Flash->success(__('The arrival_train has been saved.'));
                return $this->redirect(['action' => 'index']);
				}
            }
			
            $this->Flash->error(__('Le train à l\'arrivée ne peut pas être ajouté. Veuillez réessayer.'));
        }
        $this->set(compact('arrivalTrain', 'theoricDeparture', 'theoricArrival'));
        $this->set('_serialize', ['arrivalTrain']);
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
        $arrivalTrain = $this->ArrivalTrains->get($id, [
            'contain' => ['TheoricArrivals', 'TheoricDepartures']
        ]);
		$theoricArrival = $this->ArrivalTrains->TheoricArrivals->get($arrival_train->theoric_arrivals['0']->id, [
			'contain' => []
		]);
			
		$theoricDeparture = $this->ArrivalTrains->TheoricDepartures->get($arrival_train->theoric_departures['0']->id, [
			'contain' => []
		]);
		
			$theoricArrival['ascent_time'] = intval($theoricArrival['ascent_time'])/60;
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$data = $this->request->getData();
			$data['ascent_time'] = minToSec(intval($data['ascent_time']));
            $arrivalTrain = $this->ArrivalTrains->patchEntity($arrivalTrain, $data);
			$theoricDeparture = $this->ArrivalTrains->TheoricDepartures->patchEntity($theoricDeparture, $data);
			$theoricArrival = $this->ArrivalTrains->TheoricArrivals->patchEntity($theoricArrival, $data);
			
            if ($this->ArrivalTrains->save($arrivalTrain) && $this->ArrivalTrains->TheoricArrivals->save($theoricArrival) && $this->ArrivalTrains->TheoricDepartures->save($theoricDeparture)) {
                $this->Flash->success(__('The arrival_train has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The arrival_train could not be saved. Please, try again.'));
        }
        $this->set(compact('arrivalTrain', 'theoricArrival', 'theoricDeparture'));
        $this->set('_serialize', ['arrivalTrain']);
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
        $arrivalTrain = $this->ArrivalTrains->get($id);
        if ($this->ArrivalTrains->delete($arrivalTrain)) {
            $this->Flash->success(__('The arrival_train has been deleted.'));
        } else {
            $this->Flash->error(__('The arrival_train could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
