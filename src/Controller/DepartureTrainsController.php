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
				
				$data['landy_departure']['hour'] = ($data['paris_nord_departure']['hour']*60 + $data['paris_nord_departure']['minute'] - $data['docking_time'] - $data['descent_duration'])/60;
				$data['landy_departure']['minute'] = ($data['paris_nord_departure']['hour']*60 + $data['paris_nord_departure']['minute'] - $data['docking_time'] - $data['descent_duration'])%60;
				
				$data['descent_duration'] = minToSec(intval($data['descent_duration']));
				$data['rendition_duration'] = minToSec(intval($data['rendition_duration']));
				$data['docking_time'] = minToSec(intval($data['docking_time']));
				
				
				$theoricDeparture = $this->DepartureTrains->TheoricDepartures->patchEntity($theoricDeparture, $data);
				if ($this->DepartureTrains->TheoricDepartures->save($theoricDeparture)){
					$this->Flash->success(__('Le train est ajouté.'));
					return $this->redirect(['action' => 'index']);
				}
            }
			// debug($departureTrain);
			// debug(isset($data['landy_departure']));
            $this->Flash->error(__('Le train n\'a pas été ajouté. Réessayez.'));
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
		
		$theoricDeparture = $this->DepartureTrains->TheoricDepartures->get($departureTrain->theoric_departures['0']->id, [
			'contain' => []
		]);
		
		$theoricDeparture['descent_duration'] = intval($theoricDeparture['descent_duration'])/60;
		$theoricDeparture['docking_time'] = intval($theoricDeparture['docking_time'])/60;
		$theoricDeparture['rendition_duration'] = intval($theoricDeparture['rendition_duration'])/60;
		$departureTrain['alerte1'] = intval($departureTrain['alerte1'])/60;
		$departureTrain['alerte2'] = intval($departureTrain['alerte2'])/60;
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$data = $this->request->getData();
			$data['descent_duration'] = minToSec(intval($data['descent_duration']));
			$data['docking_time'] = minToSec(intval($data['docking_time']));
			$data['rendition_duration'] = minToSec(intval($data['rendition_duration']));
			$data['alerte1'] = minToSec(intval($data['alerte1']));
			$data['alerte2'] = minToSec(intval($data['alerte2']));
			
            $departureTrain = $this->DepartureTrains->patchEntity($departureTrain, $data);
			$theoricDeparture = $this->DepartureTrains->TheoricDepartures->patchEntity($theoricDeparture, $data);
			
            if ($this->DepartureTrains->save($departureTrain) && $this->DepartureTrains->TheoricDepartures->save($theoricDeparture)) {
                $this->Flash->success(__('Le train est modifié.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le train n\'a pas été modifié. Réessayez.'));
        }
        $this->set(compact('departureTrain', 'theoricDeparture'));
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
            $this->Flash->success(__('Le train est supprimé.'));
        } else {
            $this->Flash->error(__('Le train n\'a pas été supprimé. Réessayez.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function trainNumber(){
		parent::number($this->DepartureTrains);
	}
	
	public function landyDeparture(){
		if ( isset($_POST['heure']) ){
			$heure = $_POST['heure'];
			$this->set(compact('heure'));
		}
		if ( isset($_POST['minute']) ){
			$minute = $_POST['minute'];
			$this->set(compact('minute'));
		}
		if ( isset($_POST['docktime']) ){
			$docktime = $_POST['docktime'];
			$this->set(compact('docktime'));
		}
		if ( isset($_POST['dd']) ){
			$dd = $_POST['dd'];
			$this->set(compact('dd'));
		}
	}
}
