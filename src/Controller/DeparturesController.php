<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;


/**
 * Departures Controller
 *
 * @property \App\Model\Table\DeparturesTable $Departures
 */
class DeparturesController extends AppController
{
	public function isAuthorized($user)
	{
		// sens de lecture : répertorier toutes les actions sensibles et les rôles qui peuvent utiliser
		return ! (
		($this->request->action === 'delete'
			&& $user['role_id'] !== parent::GEOPS && $user['role_id'] !== parent::ADMIN)
		|| ($this->request->action === 'add'
			&& $user['role_id'] !== parent::RLP && $user['role_id'] !== parent::GEOPS && $user['role_id'] !== parent::ADMIN));
	}
	
	public function beforeFilter(Event $event)
    {
		parent::beforeFilter($event);
		$this->Auth->allow('indexeic');
    }
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() // index GEOPS
    {
		$id_role = $this->Auth->user("role_id");
		
		if ($id_role === parent::RLP)
			return $this->redirect(['action' => 'indexrlp']);
	
		elseif ($id_role === parent::CPT)
			return $this->redirect(['action' => 'indexcpt']);
			
		elseif ($id_role === parent::GEOPS || $id_role === parent::ADMIN){
			
		$query = $this->Departures->find()->where(['OR' => ['landy_departure >=' => date('Y-m-d H:i:s', time()-3600), 'landy_departure IS' => null]]);
		
        $this->paginate = [
            'contain' => ['DepartureTrains' => ['TheoricDepartures'], 'Brakes', 'Ways', 'TrainSet1s' => ['TrainSetReleases'], 'TrainSet2s' => ['TrainSetReleases'], 'TrainSet3s' => ['TrainSetReleases'], 'Locs' => ['TrainSetReleases'], 'BrakeControls' => ['Presents']],
			'limit' => 15,
			'order' => ['id' => 'desc']
        ];
		
        $departures = $this->paginate($query);
        // $departures = $this->paginate($this->Departures);
		
		// debug($query);
		
		$this->loadAlerts();
		
		
        $this->set(compact('departures'));
        $this->set('_serialize', ['departures']);

		}
		
		else // if ($id_role === parent::EIC) || other
			return $this->redirect(['action' => 'indexeic']);
    }
	
	public function indexrlp()
    {
		$id_role = $this->Auth->user("role_id");
		if ($id_role !== 3)
			return $this->redirect(['action' => 'index']);
		
		$query = $this->Departures->find()->where(['OR' => ['landy_departure >=' => date('Y-m-d H:i:s', time()-3600), 'landy_departure IS' => null]]);
		
        $this->paginate = [
            'contain' => ['DepartureTrains' => ['TheoricDepartures'], 'Brakes', 'Ways', 'TrainSet1s' => ['TrainSetReleases'], 'TrainSet2s' => ['TrainSetReleases'], 'TrainSet3s' => ['TrainSetReleases'], 'Locs' => ['TrainSetReleases'], 'BrakeControls' => ['Presents']],
			'limit' => 15,
			'order' => ['id' => 'desc']
        ];
		
		$this->loadAlerts();
		
		$departures = $this->paginate($query);
        // $departures = $this->paginate($this->Departures);
		$trainSets = $this->Departures->TrainSet1s->find('all')->toArray();
        $this->set(compact('departures', 'trainSets'));
        $this->set('_serialize', ['departures']);
    }
	
	public function indexeic()
    {
		$id_role = $this->Auth->user("role_id");
		if ($id_role !== 5 && isset($id_role))
			return $this->redirect(['action' => 'index']);
		
		$query = $this->Departures->find()->where(['OR' => ['landy_departure >=' => date('Y-m-d H:i:s', time()-3600), 'landy_departure IS' => null]]);
		
        $this->paginate = [
            'contain' => ['DepartureTrains' => ['TheoricDepartures'], 'Brakes', 'Ways', 'TrainSet1s' => ['TrainSetReleases'], 'TrainSet2s' => ['TrainSetReleases'], 'TrainSet3s' => ['TrainSetReleases'], 'Locs' => ['TrainSetReleases'], 'BrakeControls' => ['Presents']],
			'limit' => 15,
			'order' => ['id' => 'desc']
		];
		
		$departures = $this->paginate($query);
        // $departures = $this->paginate($this->Departures);
		
		$this->loadAlerts();
		
		if($this->request->is('post')){
			if($this->request->getData()){
				$data = $this->request->getData();
				if (isset($data['date'])){
					$departures = $this->Departures
												->find('all')
												->where([
													'Departures.landy_departure <' => date('Y-m-d', (strtotime($data['date']['year'].'-'.$data['date']['month'].'-'.$data['date']['day'])+86400)),
													'Departures.landy_departure >=' => date('Y-m-d', strtotime($data['date']['year'].'-'.$data['date']['month'].'-'.$data['date']['day']))
												])
												->contain(['DepartureTrains' => ['TheoricDepartures'], 'Brakes', 'Ways', 'TrainSet1s' => ['TrainSetReleases'], 'TrainSet2s' => ['TrainSetReleases'], 'TrainSet3s' => ['TrainSetReleases'], 'BrakeControls' => ['Presents']])
												->limit(5);
				}
			}
			else {
                $this->Flash->error('Il y a eu un problème lors de la recherche. Si cette erreur persiste, contactez un administrateur au plus vite.');
            }
		}
		
		$trainSets = $this->Departures->TrainSet1s->find('all')->toArray();
        $this->set(compact('departures', 'trainSets'));
        $this->set('_serialize', ['departures']);
    }
	
	public function indexcpt()
    {
		$id_role = $this->Auth->user("role_id");
		if ($id_role !== 4)
			return $this->redirect(['action' => 'index']);
		
		$query = $this->Departures->find()->where(['OR' => ['landy_departure >=' => date('Y-m-d H:i:s', time()-3600), 'landy_departure IS' => null]]);
		
		$this->loadAlerts();
		
        $this->paginate = [
            'contain' => ['DepartureTrains' => ['TheoricDepartures'], 'Brakes', 'Ways', 'TrainSet1s' => ['TrainSetReleases'], 'TrainSet2s' => ['TrainSetReleases'], 'TrainSet3s' => ['TrainSetReleases'], 'Locs' => ['TrainSetReleases'], 'BrakeControls' => ['Presents']],
			'limit' => 15,
			'order' => ['id' => 'desc']
		];
		
		$departures = $this->paginate($query);
        // $departures = $this->paginate($this->Departures);
		$trainSets = $this->Departures->TrainSet1s->find('all')->toArray();
        $this->set(compact('departures', 'trainSets'));
        $this->set('_serialize', ['departures']);
    }

    /**
     * View method
     *
     * @param string|null $id Departure id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $departure = $this->Departures->get($id, [
            'contain' => ['Ways', 'DepartureTrains', 'Brakes', 'TrainSet1s' => ['TrainSetReleases'], 'Locs' => ['TrainSetReleases'], 'TrainSet2s' => ['TrainSetReleases'], 'TrainSet3s' => ['TrainSetReleases'], 'BrakeControls' => ['Presents']]
        ]);
		
		$osmose = max($this->getTrainReleases($departure))->heure;
        $this->set(compact('departure', 'osmose'));
        $this->set('_serialize', ['departure']);
    }

	public function viewObs($id = null)
    {
        $departure = $this->Departures->get($id);
		$trainSets = $this->Departures->TrainSet1s->find('all')->toArray();
        $this->set(compact('departure', 'trainSets'));
        $this->set('_serialize', ['departure']);
    }
	
    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $departure = $this->Departures->newEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			$data['formed'] = 0;
            $departure = $this->Departures->patchEntity($departure, $data);
            if ($this->Departures->save($departure)) {
                $this->Flash->success(__('Le départ est ajouté.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le départ n\'a pas été ajouté. Réessayez.'));
			debug($departure);
        }
        $trains = $this->Departures->DepartureTrains->find('list', ['limit' => 200]);
		$ways = $this->Departures->Ways->find('list', ['limit' => 200]);
		$trainSets = $this->Departures->TrainSet1s->find('list', ['limit' => 200]);

        $this->set(compact('departure', 'trains', 'ways', 'trainSets'));
        $this->set('_serialize', ['departure']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Departure id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$id_role = $this->Auth->user("role_id");
		
		if ($id_role === parent::GEOPS)
			return $this->redirect(['action' => 'edit1', $id]);
	
		elseif ($id_role === parent::RLP)
			return $this->redirect(['action' => 'edit2', $id]);
			
		elseif ($id_role === parent::CPT)
			return $this->redirect(['action' => 'edit3', $id]);
			
		elseif ($id_role === parent::EIC)
			return $this->redirect(['action' => 'edit4', $id]);
		
		
	   
	    $departure = null;
		$brakeControl = null;
		$departure = $this->Departures->get($id, [
				'contain' => ['BrakeControls' => ['Presents'], 'TrainSet1s' => ['TrainSetReleases'], 'TrainSet2s' => ['TrainSetReleases'], 'TrainSet3s' => ['TrainSetReleases'], 'Locs' => ['TrainSetReleases']]
			]);
			
		if (!empty($departure->brake_controls)){
			$brakeControl = $this->Departures->BrakeControls->get($departure->brake_controls['0']->id);
		}
		else{
			$brakeControl = $this->Departures->BrakeControls->newEntity();
		}
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
            $departure = $this->Departures->patchEntity($departure, $data);
            if ($this->Departures->save($departure)) {
				if (isset($departure['landy_departure'])){
					$this->desactivateReleases($departure, $id);
				}
				if (!empty($data['present_id']) || ( !empty($data['realisation_time']['year'])
													&& !empty($data['realisation_time']['month']) 
													&& !empty($data['realisation_time']['day'])
													&& !empty($data['realisation_time']['hour'])
													&& !empty($data['realisation_time']['minute']) ) ){ // si le contrôle de freinage a été renseigné
					$data['departure_id'] = $id;
					$brakeControl = $this->Departures->BrakeControls->patchEntity($brakeControl, $data);
					
					if ($this->Departures->BrakeControls->save($brakeControl)) {
						$this->Flash->success(__("Le départ est modifié.")); // attention l'attribut s'appelle paris nord mais c'est bien l'heure de départ du landy
						return $this->redirect(['action' => 'index']);
					}
				}
				else{
					$this->Flash->success(__("Le départ n\'a pas été modifié. Réessayez."));
					return $this->redirect(['action' => 'index']);
				}
			}
            $this->Flash->error(__('Le départ n\'a pas été modifié. Réessayez.'));
        }
        $trains = $this->Departures->DepartureTrains->find('list', ['limit' => 200]);
        $trainSets = $this->Departures->TrainSet1s->find('list', ['limit' => 200]);
        $brakes = $this->Departures->Brakes->find('list', ['limit' => 200]);
		$presents = $this->Departures->BrakeControls->Presents->find('list');
		$ways = $this->Departures->Ways->find('list', ['limit' => 200]);
        $this->set(compact('departure', 'trains', 'brakes', 'ways', 'presents', 'brakeControl', 'trainSets'));
        $this->set('_serialize', ['departure']);
		
    }
	
	public function edit1($id = null)
    { 
		$id_role = $this->Auth->user("role_id");
		if ($id_role !== parent::GEOPS)
			return $this->redirect(['action' => 'edit', $id]);
		
		$departure = null;
		$brakeControl = null;
		$departure = $this->Departures->get($id, [
				'contain' => ['BrakeControls' => ['Presents'], 'TrainSet1s' => ['TrainSetReleases'], 'TrainSet2s' => ['TrainSetReleases'], 'TrainSet3s' => ['TrainSetReleases'], 'Locs' => ['TrainSetReleases']]
			]);
			
		if (!empty($departure->brake_controls)){
			$brakeControl = $this->Departures->BrakeControls->get($departure->brake_controls['0']->id);
		}
		else{
			$brakeControl = $this->Departures->BrakeControls->newEntity();
		}
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			if (isset($data['present_id'])){
				if ($data['present_id'] == 4){ // CRML seul
					$data['brake_id'] = 3;
				}
			}
            $departure = $this->Departures->patchEntity($departure, $data);
            if ($this->Departures->save($departure)) {
				// if (isset($departure['landy_departure'])){
					// $this->desactivateReleases($departure, $id);
				// }
				if (!empty($data['present_id']) || ( !empty($data['realisation_time']['year'])
													&& !empty($data['realisation_time']['month']) 
													&& !empty($data['realisation_time']['day'])
													&& !empty($data['realisation_time']['hour'])
													&& !empty($data['realisation_time']['minute']) ) ){ // si le contrôle de freinage a été renseigné
					$data['departure_id'] = $id;
					$brakeControl = $this->Departures->BrakeControls->patchEntity($brakeControl, $data);
					
					if ($this->Departures->BrakeControls->save($brakeControl)) {
						$this->Flash->success(__("Le départ est modifié."));
						return $this->redirect(['action' => 'index']);
					}
				}
				else{
					$this->Flash->success(__("Le départ est modifié."));
					return $this->redirect(['action' => 'index']);
				}
			}
            $this->Flash->error(__('Le départ n\'a pas été modifié. Réessayez.'));
        }
        $trains = $this->Departures->DepartureTrains->find('list', ['limit' => 200]);
        $trainSets = $this->Departures->TrainSet1s->find('list', ['limit' => 200]);
        $brakes = $this->Departures->Brakes->find('list', ['limit' => 200]);
		$presents = $this->Departures->BrakeControls->Presents->find('list');
		$ways = $this->Departures->Ways->find('list', ['limit' => 200]);
        $this->set(compact('departure', 'trains', 'brakes', 'ways', 'presents', 'brakeControl', 'trainSets'));
        $this->set('_serialize', ['departure']);
    }
	
	public function edit2($id = null)
    {
		$id_role = $this->Auth->user("role_id");
		if ($id_role !== parent::RLP)
			return $this->redirect(['action' => 'edit', $id]);
		
        $departure = $this->Departures->get($id, [
            'contain' => ['Ways', 'DepartureTrains']
        ]);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
		
            $departure = $this->Departures->patchEntity($departure, $this->request->getData());
            if ($this->Departures->save($departure)) {
                $this->Flash->success(__('Le départ est modifié.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le départ n\'a pas été modifié. Réessayez.'));
        }
        $trains = $this->Departures->DepartureTrains->find('list', ['limit' => 200]);
        $brakes = $this->Departures->Brakes->find('list', ['limit' => 200]);
		$ways = $this->Departures->Ways->find('list', ['limit' => 200]);
        $this->set(compact('departure', 'trains', 'brakes', 'ways'));
        $this->set('_serialize', ['departure']);
    }

	public function edit3($id = null)
    {
		$id_role = $this->Auth->user("role_id");
		if ($id_role !== parent::CPT)
			return $this->redirect(['action' => 'edit', $id]);
		
		
         $departure = $this->Departures->get($id, [
            'contain' => ['BrakeControls', 'DepartureTrains', 'Ways']
        ]);
			
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			
            $departure = $this->Departures->patchEntity($departure, $this->request->getData());
            if ($this->Departures->save($departure)) {
                $this->Flash->success(__('Le départ est modifié.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le départ n\'a pas été modifié. Réessayez.'));
        }
        $trains = $this->Departures->DepartureTrains->find('list', ['limit' => 200]);
        $brakes = $this->Departures->Brakes->find('list', ['limit' => 200]);
		$ways = $this->Departures->Ways->find('list', ['limit' => 200]);
        $this->set(compact('departure', 'trains', 'brakes', 'ways'));
        $this->set('_serialize', ['departure']);
    }	
	
	public function edit4($id = null)
    {
		$id_role = $this->Auth->user("role_id");
		if ($id_role !== parent::EIC)
			return $this->redirect(['action' => 'edit', $id]);
		
         $departure = $this->Departures->get($id, [
            'contain' => ['Ways', 'DepartureTrains', 'TrainSet1s' => ['TrainSetReleases'], 'TrainSet2s' => ['TrainSetReleases'], 'TrainSet3s' => ['TrainSetReleases'], 'Locs' => ['TrainSetReleases']
		]]);
	
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
	
            $departure = $this->Departures->patchEntity($departure, $this->request->getData());
            if ($this->Departures->save($departure)) {
				if (isset($departure['landy_departure'])){
					$this->desactivateReleases($departure, $id);
				}
                $this->Flash->success(__('Le départ est modifié.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le départ n\'a pas été modifié. Réessayez.'));
        }
        $trains = $this->Departures->DepartureTrains->find('list', ['limit' => 200]);
        $brakes = $this->Departures->Brakes->find('list', ['limit' => 200]);
		$ways = $this->Departures->Ways->find('list', ['limit' => 200]);
        $this->set(compact('departure', 'trains', 'brakes', 'ways'));
        $this->set('_serialize', ['departure']);
    }	

    /**
     * Delete method
     *
     * @param string|null $id Departure id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $departure = $this->Departures->get($id);
        if ($this->Departures->delete($departure)) {
            $this->Flash->success(__('Le départ est supprimé.'));
        } else {
            $this->Flash->error(__('Le départ n\'a pas été supprimé. Réessayez.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function records(){
		$id_role = $this->Auth->user("role_id");
		
		if ($id_role === parent::RLP)
			return $this->redirect(['action' => 'indexrlp']);
	
		elseif ($id_role === parent::CPT)
			return $this->redirect(['action' => 'indexcpt']);
			
		elseif ($id_role === parent::GEOPS){
			
        $this->paginate = [
            'contain' => ['DepartureTrains' => ['TheoricDepartures'], 'Brakes', 'Ways', 'TrainSet1s' => ['TrainSetReleases'], 'TrainSet2s' => ['TrainSetReleases'], 'TrainSet3s' => ['TrainSetReleases'], 'Locs' => ['TrainSetReleases'], 'BrakeControls' => ['Presents']],
			'limit' => 15,
			'order' => ['id' => 'desc']
        ];
		
        $departures = $this->paginate($this->Departures);
		
		$this->loadAlerts();
		
		if($this->request->is('post')){
			if($this->request->getData()){
				$data = $this->request->getData();
				if (isset($data['date'])){
					$departures = $this->Departures
												->find('all')
												->where([
													'Departures.landy_departure <' => date('Y-m-d', (strtotime($data['date']['year'].'-'.$data['date']['month'].'-'.$data['date']['day'])+86400)),
													'Departures.landy_departure >=' => date('Y-m-d', strtotime($data['date']['year'].'-'.$data['date']['month'].'-'.$data['date']['day']))
												])
												->contain(['DepartureTrains' => ['TheoricDepartures'], 'Brakes', 'Ways', 'TrainSet1s' => ['TrainSetReleases'], 'TrainSet2s' => ['TrainSetReleases'], 'TrainSet3s' => ['TrainSetReleases'], 'BrakeControls' => ['Presents']])
												->limit(5);
				}
			}
			else {
                $this->Flash->error('Il y a eu un problème lors de la recherche. Si cette erreur persiste, contactez un administrateur au plus vite.');
            }
		}
		
		
        $this->set(compact('departures', 'trainSets'));
        $this->set('_serialize', ['departures']);

		}
		
		else // if ($id_role === parent::EIC) || other
			return $this->redirect(['action' => 'indexeic']);
	}
	
	public function desactivateReleases($departure, $id){
		
		$trainSetReleases = $this->getTrainReleases($departure);
		foreach($trainSetReleases as $tsr){
			$tsr = $this->Departures->TrainSet1s->TrainSetReleases->patchEntity($tsr, ['active' => false]);
            if (!$this->Departures->TrainSet1s->TrainSetReleases->save($tsr)) {
				$this->Flash->error(__('Il y a eu un problème lors de la mise à jour des libérations de rame. Veuillez contacter un administrateur au plus vite si le problème persiste.'));
				break;
            }
		}
		
		$foo = $this->Departures->get($id, [
            'contain' => []
        ]);
		
		$max = max($trainSetReleases);
            $foo = $this->Departures->patchEntity($foo, ['osmose' => $max->heure]);
            if (!$this->Departures->save($foo)) {
                $this->Flash->error(__('Il y a eu une erreur pendant la modification du départ. Contactez un administrateur si le problème persiste.'));
            }
	}
	
	public function getTrainReleases($departure){
		$trainSetReleases = array();
		if( isset($departure->loc) ){
			$trainSetReleases[0] = $this->Departures->Locs->TrainSetReleases->get($departure->loc->train_set_releases[count($departure->loc->train_set_releases)-1]->id, [
				'contain' => []
			]);
		}
		
		if( isset($departure->train_set1) ){
			$trainSetReleases[1] = $this->Departures->TrainSet1s->TrainSetReleases->get($departure->train_set1->train_set_releases[count($departure->train_set1->train_set_releases)-1]->id, [
				'contain' => []
			]);
		}
		
		if( isset($departure->train_set2) ){
			$trainSetReleases[2] = $this->Departures->TrainSet2s->TrainSetReleases->get($departure->train_set2->train_set_releases[count($departure->train_set1->train_set_releases)-1]->id, [
				'contain' => []
			]);
		}
		
		if( isset($departure->train_set3) ){
			$trainSetReleases[3] = $this->Departures->TrainSet3s->TrainSetReleases->get($departure->train_set3->train_set_releases[count($departure->train_set1->train_set_releases)-1]->id, [
				'contain' => []
			]);
		}
		
		return $trainSetReleases;
	}
}
