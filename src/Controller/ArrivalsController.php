<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\I18n\Time;


/**
 * Arrivals Controller
 *
 * @property \App\Model\Table\ArrivalsTable $Arrivals
 */
class ArrivalsController extends AppController
{
	public function isAuthorized($user)
	{
		return ! ( $this->request->action === 'edit' && $user['role_id'] !== parent::EIC && $user['role_id'] !== parent::RLP && $user['role_id'] !== parent::ADMIN );
	}
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

		$id_role = $this->Auth->user("role_id");
		
		if ($id_role === 3) // RLP
			return $this->redirect(['action' => 'index2', $id]);
			
        $this->paginate = [
            'contain' => ['Ways', 'ArrivalTrains', 'TrainSets', 'Lavages'],
			'limit' => 15,
			'order' => ['landy_arrival' => 'desc']
        ];
		
        $arrivals = $this->paginate($this->Arrivals);
		$trainSets = $this->Arrivals->TrainSets->find('all')->toArray();
        $this->set(compact('arrivals', 'trainSets'));
        $this->set('_serialize', ['arrivals']);
    }
	
    public function index2()
    {
        $this->paginate = [
            'contain' => ['Ways', 'ArrivalTrains', 'TrainSets', 'Lavages'],
			'limit' => 15,
			'order' => ['landy_arrival' => 'desc']
        ];
		
        $arrivals = $this->paginate($this->Arrivals);
		$trainSets = $this->Arrivals->TrainSets->find('all')->toArray();		
		$this->set(compact('arrivals', 'trainSets'));
        $this->set('_serialize', ['arrivals']);
    }

    /**
     * View method
     *
     * @param string|null $id Arrival id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $arrival = $this->Arrivals->get($id, [
            'contain' => ['Ways', 'ArrivalTrains', 'TrainSets', 'Lavages', 'Locs' => ['TrainSetReleases']]
        ]);
		$trainSets = $this->Arrivals->TrainSets->find('all')->toArray();
        $this->set(compact('arrival', 'trainSets'));
        $this->set('_serialize', ['arrival']);
    }

	public function viewObs($id = null)
    {
        $arrival = $this->Arrivals->get($id);
		$trainSets = $this->Arrivals->TrainSets->find('all')->toArray();
        $this->set(compact('arrival', 'trainSets'));
        $this->set('_serialize', ['arrival']);
    }
    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $arrival = $this->Arrivals->newEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
            $arrival = $this->Arrivals->patchEntity($arrival, $data);
            if ($this->Arrivals->save($arrival)) {
                $this->Flash->success(__('L\'arrivée a bien été ajoutée.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('L\'arrivée n\'a pas été ajoutée. Veuillez réessayer.'));
        } 
        $ways = $this->Arrivals->Ways->find('list', ['limit' => 200]);
        $arrivalTrains = $this->Arrivals->ArrivalTrains->find('list', ['limit' => 200]);
        $trainSets = $this->Arrivals->TrainSets->find('list', ['limit' => 200]);
        $lavages = $this->Arrivals->Lavages->find('list', ['limit' => 200]);

        $this->set(compact('arrival', 'ways', 'arrivalTrains', 'trainSets', 'lavages'));
        $this->set('_serialize', ['arrival']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Arrival id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		
		$id_role = $this->Auth->user("role_id");
		
		if ($id_role === 3) // RLP
			return $this->redirect(['action' => 'edit2', $id]);
	
		elseif ($id_role === 5) // EIC
			return $this->redirect(['action' => 'edit3', $id]);
		elseif ($id_role === 1){ // Admin
		
			$arrival = $this->Arrivals->get($id, [
				'contain' => []
			]);
			
			if ($this->request->is(['patch', 'post', 'put'])) {
				$arrival = $this->Arrivals->patchEntity($arrival, $this->request->getData());
				if ($this->Arrivals->save($arrival)) {
					$this->Flash->success(__('L\'arrivée à bien été modifiée.'));

					return $this->redirect(['action' => 'index']);
				}
				$this->Flash->error(__('L\'arrivée n\'a pas été modifiée. Veuillez réessayer.'));
			}
			$ways = $this->Arrivals->Ways->find('list', ['limit' => 200]);
			$arrival_trains = $this->Arrivals->ArrivalTrains->find('list', ['limit' => 200]);
			$trainSets = $this->Arrivals->TrainSets->find('list', ['limit' => 200]);
			$lavages = $this->Arrivals->Lavages->find('list', ['limit' => 200]);
			
			$this->set(compact('arrival', 'ways', 'arrival_trains', 'trainSets', 'lavages'));
			$this->set('_serialize', ['arrival']);
		}
		else
			throw new NotFoundException();
    }
	
	public function edit2($id = null)
    {
		// $id_role = $this->Auth->user("role_id");
		
		// if ($id_role !== 3) // !== RLP
			// return $this->redirect(['action' => 'edit', $id]);
			
			
        $arrival = $this->Arrivals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			$ts_announcement = $data['protection_time']['hour']*3600+$data['protection_time']['minute']*60;
			$ts_landy_arrival = Time::parse($arrival->landy_arrival);
			$ts_landy_arrival = strtotime($ts_landy_arrival->i18nFormat('yyyy-MM-dd HH:mm'))%86400;
			
			if ( isset($data['protection_time']) ){
				if($ts_announcement >= $ts_landy_arrival || (empty($data['protection_time']['hour']) && empty($data['protection_time']['minute']))){
					$arrival = $this->Arrivals->patchEntity($arrival, $data);
					if ($this->Arrivals->save($arrival)) {
						$this->Flash->success(__('L\'arrivée a bien été modifiée.'));

						return $this->redirect(['action' => 'index']);
					}
					$this->Flash->error(__('L\'arrivée n\'a pas été modifiée. Veuillez réessayer.'));
				}
			}
            $this->Flash->error(__('L\'heure d\'annonce est antérieure à l\'heure d\'arrivée au Landy. Vérifiez votre saisie.'));
        }
        $ways = $this->Arrivals->Ways->find('list', ['limit' => 200]);
        $arrival_trains = $this->Arrivals->ArrivalTrains->find('list', ['limit' => 200]);
        $trainSets = $this->Arrivals->TrainSets->find('list', ['limit' => 200]);
        $lavages = $this->Arrivals->Lavages->find('list', ['limit' => 200]);
        $this->set(compact('arrival', 'ways', 'arrival_trains', 'trainSets', 'lavages'));
        $this->set('_serialize', ['arrival']);
    }
	
	public function edit3($id = null)
    {
		$id_role = $this->Auth->user("role_id");
		
		if ($id_role !== 5) // !== EIC
			return $this->redirect(['action' => 'edit', $id]);
			
			
        $arrival = $this->Arrivals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			$ts_announcement = $data['announcement_time']['hour']*3600+$data['announcement_time']['minute']*60;
			$ts_landy_arrival = $data['landy_arrival']['hour']*3600+$data['landy_arrival']['minute']*60;
			if ( isset($data['announcement_time']) ){
				if ($ts_announcement >= $ts_landy_arrival || (empty($data['announcement_time']['hour']) && empty($data['announcement_time']['minute']))){
					$arrival = $this->Arrivals->patchEntity($arrival, $data);
					if ($this->Arrivals->save($arrival)) {
						$this->Flash->success(__('L\'arrivée a bien été modifiée.'));

						return $this->redirect(['action' => 'index']);
					}
					$this->Flash->error(__('L\'arrivée n\'a pas été modifiée. Veuillez réessayer.'));
				}
			}
            $this->Flash->error(__('L\'heure d\'annonce est antérieure à l\'heure d\'arrivée au Landy. Vérifiez votre saisie ?'));
        }
        $ways = $this->Arrivals->Ways->find('list', ['limit' => 200]);
        $arrival_trains = $this->Arrivals->ArrivalTrains->find('list', ['limit' => 200]);
        $trainSets = $this->Arrivals->TrainSets->find('list', ['limit' => 200]);
        $lavages = $this->Arrivals->Lavages->find('list', ['limit' => 200]);
        $this->set(compact('arrival', 'ways', 'arrival_trains', 'trainSets', 'lavages'));
        $this->set('_serialize', ['arrival']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Arrival id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $arrival = $this->Arrivals->get($id);
        if ($this->Arrivals->delete($arrival)) {
            $this->Flash->success(__('L\'arrivée à bien été supprimée.'));
        } else {
            $this->Flash->error(__('L\'arrivée n\'a pas été supprimée. Veuillez réessayer.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
