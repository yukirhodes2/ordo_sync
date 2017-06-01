<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Alerts Controller
 *
 * @property \App\Model\Table\AlertsTable $Alerts
 */
class AlertsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $alerts = $this->paginate($this->Alerts);

        $this->set(compact('alerts'));
        $this->set('_serialize', ['alerts']);
    }

    /**
     * View method
     *
     * @param string|null $id Alert id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $alert = $this->Alerts->get($id, [
            'contain' => []
        ]);

        $this->set('alert', $alert);
        $this->set('_serialize', ['alert']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $alert = $this->Alerts->newEntity();
        if ($this->request->is('post')) {
            $alert = $this->Alerts->patchEntity($alert, $this->request->getData());
            if ($this->Alerts->save($alert)) {
                $this->Flash->success(__('The alert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The alert could not be saved. Please, try again.'));
        }
        $this->set(compact('alert'));
        $this->set('_serialize', ['alert']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Alert id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $alert = $this->Alerts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $alert = $this->Alerts->patchEntity($alert, $this->request->getData());
            if ($this->Alerts->save($alert)) {
                $this->Flash->success(__('The alert has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The alert could not be saved. Please, try again.'));
        }
        $this->set(compact('alert'));
        $this->set('_serialize', ['alert']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Alert id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $alert = $this->Alerts->get($id);
        if ($this->Alerts->delete($alert)) {
            $this->Flash->success(__('The alert has been deleted.'));
        } else {
            $this->Flash->error(__('The alert could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
