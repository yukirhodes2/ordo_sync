<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ways Controller
 *
 * @property \App\Model\Table\WaysTable $Ways
 */
class WaysController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $ways = $this->paginate($this->Ways);

        $this->set(compact('ways'));
        $this->set('_serialize', ['ways']);
    }

    /**
     * View method
     *
     * @param string|null $id Way id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $way = $this->Ways->get($id, [
            'contain' => ['Arrivals', 'Departures']
        ]);

        $this->set('way', $way);
        $this->set('_serialize', ['way']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $way = $this->Ways->newEntity();
        if ($this->request->is('post')) {
            $way = $this->Ways->patchEntity($way, $this->request->getData());
            if ($this->Ways->save($way)) {
                $this->Flash->success(__('La voie est ajoutée.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La voie n\'a pas été ajoutée. Réessayez.'));
        }
        $this->set(compact('way'));
        $this->set('_serialize', ['way']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Way id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $way = $this->Ways->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $way = $this->Ways->patchEntity($way, $this->request->getData());
            if ($this->Ways->save($way)) {
                $this->Flash->success(__('La voie est modifiée.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La voie n\'a pas été modifiée. Réessayez.'));
        }
        $this->set(compact('way'));
        $this->set('_serialize', ['way']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Way id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $way = $this->Ways->get($id);
        if ($this->Ways->delete($way)) {
            $this->Flash->success(__('La voie est supprimée.'));
        } else {
            $this->Flash->error(__('La voie n\'a pas été supprimée. Réessayez.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
