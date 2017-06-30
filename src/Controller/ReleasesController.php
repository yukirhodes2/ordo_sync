<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Releases Controller
 *
 * @property \App\Model\Table\ReleasesTable $Releases
 */
class ReleasesController extends AppController
{

	public function beforeFilter(Event $event)
    {
		parent::beforeFilter($event);
		$this->Auth->deny();
    }
	
	public function isAuthorized($user)
	{
		return $user['role_id'] !== parent::ADMIN;
	}
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $releases = $this->paginate($this->Releases);

        $this->set(compact('releases'));
        $this->set('_serialize', ['releases']);
    }

    /**
     * View method
     *
     * @param string|null $id Release id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $release = $this->Releases->get($id, [
            'contain' => []
        ]);

        $this->set('release', $release);
        $this->set('_serialize', ['release']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $release = $this->Releases->newEntity();
        if ($this->request->is('post')) {
            $release = $this->Releases->patchEntity($release, $this->request->getData());
            if ($this->Releases->save($release)) {
                $this->Flash->success(__('La libération est ajoutée.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La libération n\'a pas été ajoutée. Réessayez.'));
        }
        $this->set(compact('release'));
        $this->set('_serialize', ['release']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Release id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $release = $this->Releases->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $release = $this->Releases->patchEntity($release, $this->request->getData());
            if ($this->Releases->save($release)) {
                $this->Flash->success(__('La libération est modifiée.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La libération n\'a pas été modifiée. Réessayez.'));
        }
        $this->set(compact('release'));
        $this->set('_serialize', ['release']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Release id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $release = $this->Releases->get($id);
        if ($this->Releases->delete($release)) {
            $this->Flash->success(__('La libération est supprimée.'));
        } else {
            $this->Flash->error(__('La libération n\'a pas été supprimée. Réessayez.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
