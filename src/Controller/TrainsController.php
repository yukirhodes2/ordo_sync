<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Trains Controller
 *
 * @property \App\Model\Table\TrainsTable $Trains
 */
class TrainsController extends AppController
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
            'contain' => ['TheoricArrivals', 'TheoricDepartures']
        ];
        $trains = $this->paginate($this->Trains);
		
        $this->set(compact('trains'));
        $this->set('_serialize', ['trains']);
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
        $train = $this->Trains->get($id, [
            'contain' => ['Arrivals' => ['Lavages'], 'Departures' => ['Brakes', 'Ways'], 'TheoricArrivals', 'TheoricDepartures']
        ]);

        $this->set('train', $train);
        $this->set('_serialize', ['train']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $train = $this->Trains->newEntity();
		$theoricDeparture = $this->Trains->TheoricDepartures->newEntity();
		$theoricArrival = $this->Trains->TheoricArrivals->newEntity();
		
        if ($this->request->is('post')) {
			
			$data = $this->request->getData();
			$data['docking_time'] = minToSec(intval($data['docking_time']));
			$data['descent_duration'] = minToSec(intval($data['descent_duration']));
			$data['ascent_time'] = minToSec(intval($data['ascent_time']));
			$data['rendition_duration'] = minToSec(intval($data['rendition_duration']));
			$data['landy_departure'] = Time::now();
			$data['landy_arrival'] = Time::now();
			
            $train = $this->Trains->patchEntity($train, $data);
			
			$result = null;
            if ($result = $this->Trains->save($train)) {
				$data['train_id'] = $result->id; // on récupère l'id du nouveau train pour associer les théoriques
				$theoricDeparture = $this->Trains->TheoricDepartures->patchEntity($theoricDeparture, $data);
				$theoricArrival = $this->Trains->TheoricArrivals->patchEntity($theoricArrival, $data);
				if ($this->Trains->TheoricDepartures->save($theoricDeparture) && $this->Trains->TheoricArrivals->save($theoricArrival)){
                $this->Flash->success(__('The train has been saved.'));
                return $this->redirect(['action' => 'index']);
				}
            }
            $this->Flash->error(__('The train could not be saved. Please, try again.'));
        }
        $this->set(compact('train', 'theoricDeparture', 'theoricArrival'));
        $this->set('_serialize', ['train']);
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
        $train = $this->Trains->get($id, [
            'contain' => ['TheoricArrivals', 'TheoricDepartures']
        ]);
		$theoricArrival = $this->Trains->TheoricArrivals->get($train->theoric_arrivals['0']->id, [
			'contain' => []
		]);
			
		$theoricDeparture = $this->Trains->TheoricDepartures->get($train->theoric_departures['0']->id, [
			'contain' => []
		]);
		
			$theoricDeparture['docking_time'] = intval($theoricDeparture['docking_time'])/60;
			$theoricDeparture['descent_duration'] = intval($theoricDeparture['descent_duration'])/60;
			$theoricArrival['ascent_time'] = intval($theoricArrival['ascent_time'])/60;
			$theoricDeparture['rendition_duration'] = intval($theoricDeparture['rendition_duration'])/60;
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$data = $this->request->getData();
			$data['docking_time'] = minToSec(intval($data['docking_time']));
			$data['descent_duration'] = minToSec(intval($data['descent_duration']));
			$data['ascent_time'] = minToSec(intval($data['ascent_time']));
			$data['rendition_duration'] = minToSec(intval($data['rendition_duration']));
			
            $train = $this->Trains->patchEntity($train, $data);
			$theoricDeparture = $this->Trains->TheoricDepartures->patchEntity($theoricDeparture, $data);
			$theoricArrival = $this->Trains->TheoricArrivals->patchEntity($theoricArrival, $data);
			
            if ($this->Trains->save($train) && $this->Trains->TheoricArrivals->save($theoricArrival) && $this->Trains->TheoricDepartures->save($theoricDeparture)) {
                $this->Flash->success(__('The train has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The train could not be saved. Please, try again.'));
        }
        $this->set(compact('train', 'theoricArrival', 'theoricDeparture'));
        $this->set('_serialize', ['train']);
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
        $train = $this->Trains->get($id);
        if ($this->Trains->delete($train)) {
            $this->Flash->success(__('The train has been deleted.'));
        } else {
            $this->Flash->error(__('The train could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
