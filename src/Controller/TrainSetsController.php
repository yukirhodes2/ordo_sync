<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TrainSets Controller
 *
 * @property \App\Model\Table\TrainSetsTable $TrainSets
 */
class TrainSetsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $trainSets = $this->paginate($this->TrainSets);

        $this->set(compact('trainSets'));
        $this->set('_serialize', ['trainSets']);
    }

    /**
     * View method
     *
     * @param string|null $id Train Set id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $trainSet = $this->TrainSets->get($id, [
            'contain' => ['TrainSetReleases']
        ]);

        $this->set('trainSet', $trainSet);
        $this->set('_serialize', ['trainSet']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $trainSet = $this->TrainSets->newEntity();
        if ($this->request->is('post')) {
            $trainSet = $this->TrainSets->patchEntity($trainSet, $this->request->getData());
            if ($this->TrainSets->save($trainSet)) {
                $this->Flash->success(__('The train set has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The train set could not be saved. Please, try again.'));
        }
        $this->set(compact('trainSet'));
        $this->set('_serialize', ['trainSet']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Train Set id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $trainSet = $this->TrainSets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $trainSet = $this->TrainSets->patchEntity($trainSet, $this->request->getData());
            if ($this->TrainSets->save($trainSet)) {
                $this->Flash->success(__('The train set has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The train set could not be saved. Please, try again.'));
        }
        $this->set(compact('trainSet'));
        $this->set('_serialize', ['trainSet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Train Set id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $trainSet = $this->TrainSets->get($id);
        if ($this->TrainSets->delete($trainSet)) {
            $this->Flash->success(__('The train set has been deleted.'));
        } else {
            $this->Flash->error(__('The train set could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
