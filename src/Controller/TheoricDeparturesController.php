<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TheoricDepartures Controller
 *
 * @property \App\Model\Table\TheoricDeparturesTable $TheoricDepartures
 */
class TheoricDeparturesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Trains', 'Alerts']
        ];
        $theoricDepartures = $this->paginate($this->TheoricDepartures);

        $this->set(compact('theoricDepartures'));
        $this->set('_serialize', ['theoricDepartures']);
    }

    /**
     * View method
     *
     * @param string|null $id Theoric Departure id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $theoricDeparture = $this->TheoricDepartures->get($id, [
            'contain' => ['Trains', 'Alerts']
        ]);

        $this->set('theoricDeparture', $theoricDeparture);
        $this->set('_serialize', ['theoricDeparture']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $theoricDeparture = $this->TheoricDepartures->newEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			$data['docking_time'] = minToSec(intval($data['docking_time']));
			$data['descent_duration'] = minToSec(intval($data['descent_duration']));
			$data['rendition_duration'] = minToSec(intval($data['rendition_duration']));
			
            $theoricDeparture = $this->TheoricDepartures->patchEntity($theoricDeparture, $data);
            if ($this->TheoricDepartures->save($theoricDeparture)) {
                $this->Flash->success(__('The theoric departure has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The theoric departure could not be saved. Please, try again.'));
        }
        $trains = $this->TheoricDepartures->Trains->find('list', ['limit' => 200]);
        $alerts = $this->TheoricDepartures->Alerts->find('list', ['limit' => 200]);
        $this->set(compact('theoricDeparture', 'trains', 'alerts'));
        $this->set('_serialize', ['theoricDeparture']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Theoric Departure id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $theoricDeparture = $this->TheoricDepartures->get($id, [
            'contain' => []
        ]);
		
		$theoricDeparture['docking_time'] = floor(intval($theoricDeparture['docking_time'])/60);
		$theoricDeparture['descent_duration'] = floor(intval($theoricDeparture['descent_duration'])/60);
		$theoricDeparture['rendition_duration'] = floor(intval($theoricDeparture['rendition_duration'])/60);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			$data['docking_time'] = minToSec(intval($data['docking_time']));
			$data['descent_duration'] = minToSec(intval($data['descent_duration']));
			$data['rendition_duration'] = minToSec(intval($data['rendition_duration']));
			
            $theoricDeparture = $this->TheoricDepartures->patchEntity($theoricDeparture, $data);
            if ($this->TheoricDepartures->save($theoricDeparture)) {
                $this->Flash->success(__('The theoric departure has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The theoric departure could not be saved. Please, try again.'));
        }
        $trains = $this->TheoricDepartures->Trains->find('list', ['limit' => 200]);
        $alerts = $this->TheoricDepartures->Alerts->find('list', ['limit' => 200]);
        $this->set(compact('theoricDeparture', 'trains', 'alerts'));
        $this->set('_serialize', ['theoricDeparture']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Theoric Departure id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $theoricDeparture = $this->TheoricDepartures->get($id);
        if ($this->TheoricDepartures->delete($theoricDeparture)) {
            $this->Flash->success(__('The theoric departure has been deleted.'));
        } else {
            $this->Flash->error(__('The theoric departure could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
