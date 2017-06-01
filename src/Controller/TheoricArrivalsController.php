<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TheoricArrivals Controller
 *
 * @property \App\Model\Table\TheoricArrivalsTable $TheoricArrivals
 */
class TheoricArrivalsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Trains']
        ];
        $theoricArrivals = $this->paginate($this->TheoricArrivals);

        $this->set(compact('theoricArrivals'));
        $this->set('_serialize', ['theoricArrivals']);
    }

    /**
     * View method
     *
     * @param string|null $id Theoric Arrival id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $theoricArrival = $this->TheoricArrivals->get($id, [
            'contain' => ['Trains']
        ]);

        $this->set('theoricArrival', $theoricArrival);
        $this->set('_serialize', ['theoricArrival']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $theoricArrival = $this->TheoricArrivals->newEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			$data['ascent_time'] = minToSec(intval($data['ascent_time']));
			
            $theoricArrival = $this->TheoricArrivals->patchEntity($theoricArrival, $data);
            if ($this->TheoricArrivals->save($theoricArrival)) {
                $this->Flash->success(__('The theoric arrival has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The theoric arrival could not be saved. Please, try again.'));
        }
        $trains = $this->TheoricArrivals->Trains->find('list', ['limit' => 200]);
        $this->set(compact('theoricArrival', 'trains'));
        $this->set('_serialize', ['theoricArrival']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Theoric Arrival id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $theoricArrival = $this->TheoricArrivals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $theoricArrival = $this->TheoricArrivals->patchEntity($theoricArrival, $this->request->getData());
            if ($this->TheoricArrivals->save($theoricArrival)) {
                $this->Flash->success(__('The theoric arrival has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The theoric arrival could not be saved. Please, try again.'));
        }
        $trains = $this->TheoricArrivals->Trains->find('list', ['limit' => 200]);
        $this->set(compact('theoricArrival', 'trains'));
        $this->set('_serialize', ['theoricArrival']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Theoric Arrival id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $theoricArrival = $this->TheoricArrivals->get($id);
        if ($this->TheoricArrivals->delete($theoricArrival)) {
            $this->Flash->success(__('The theoric arrival has been deleted.'));
        } else {
            $this->Flash->error(__('The theoric arrival could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
