<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Rdrfs Controller
 *
 * @property \App\Model\Table\RdrfsTable $Rdrfs
 */
class RdrfsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $rdrfs = $this->paginate($this->Rdrfs);

        $this->set(compact('rdrfs'));
        $this->set('_serialize', ['rdrfs']);
    }

    /**
     * View method
     *
     * @param string|null $id Rdrf id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rdrf = $this->Rdrfs->get($id, [
            'contain' => []
        ]);

        $this->set('rdrf', $rdrf);
        $this->set('_serialize', ['rdrf']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rdrf = $this->Rdrfs->newEntity();
        if ($this->request->is('post')) {
            $rdrf = $this->Rdrfs->patchEntity($rdrf, $this->request->getData());
            if ($this->Rdrfs->save($rdrf)) {
                $this->Flash->success(__('Le RD\RF est ajouté.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le RD\RF n\'a pas été ajouté. Réessayez.'));
        }
        $this->set(compact('rdrf'));
        $this->set('_serialize', ['rdrf']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Rdrf id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rdrf = $this->Rdrfs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rdrf = $this->Rdrfs->patchEntity($rdrf, $this->request->getData());
            if ($this->Rdrfs->save($rdrf)) {
                $this->Flash->success(__('Le RD\RF est modifié.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le RD\RF n\'a pas été modifié. Réessayez.'));
        }
        $this->set(compact('rdrf'));
        $this->set('_serialize', ['rdrf']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Rdrf id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rdrf = $this->Rdrfs->get($id);
        if ($this->Rdrfs->delete($rdrf)) {
            $this->Flash->success(__('Le RD\RF est supprimé'));
        } else {
            $this->Flash->error(__('Le RD\RF n\'a pas été supprimé. Réessayez.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
