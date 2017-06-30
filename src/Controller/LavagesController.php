<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Lavages Controller
 *
 * @property \App\Model\Table\LavagesTable $Lavages
 */
class LavagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $lavages = $this->paginate($this->Lavages);

        $this->set(compact('lavages'));
        $this->set('_serialize', ['lavages']);
    }

    /**
     * View method
     *
     * @param string|null $id Lavage id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lavage = $this->Lavages->get($id, [
            'contain' => ['Arrivals' => ['Trains']]
        ]);

        $this->set('lavage', $lavage);
        $this->set('_serialize', ['lavage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lavage = $this->Lavages->newEntity();
        if ($this->request->is('post')) {
            $lavage = $this->Lavages->patchEntity($lavage, $this->request->getData());
            if ($this->Lavages->save($lavage)) {
                $this->Flash->success(__('Le lavage est ajouté.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le lavage n\'a pas été ajouté. Réssayez.'));
        }
        $this->set(compact('lavage'));
        $this->set('_serialize', ['lavage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Lavage id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lavage = $this->Lavages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lavage = $this->Lavages->patchEntity($lavage, $this->request->getData());
            if ($this->Lavages->save($lavage)) {
                $this->Flash->success(__('Le lavage est modifié.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le lavage n\'a pas été modifié. Réssayez.'));
        }
        $this->set(compact('lavage'));
        $this->set('_serialize', ['lavage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Lavage id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lavage = $this->Lavages->get($id);
        if ($this->Lavages->delete($lavage)) {
            $this->Flash->success(__('Le lavage est ssupprimé.'));
        } else {
            $this->Flash->error(__('Le lavage n\'a pas été ssupprimé. Réssayez.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
