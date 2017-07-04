<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
	public function isAuthorized($user)
	{
		return isset($user) && ($user === parent::GEOPS || $user === parent::ADMIN);
	}
	
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
		if ( self::isAuthorized($this->Auth->user("role_id")) === false ){
			$this->Auth->deny();
		}
		else{
			$this->Auth->allow(['add', 'delete']);
		}
		if ( $this->Auth->user("role_id") === parent::ADMIN){
			$this->Auth->allow(['add', 'delete', 'edit']);
		}
		$this->Auth->allow(['logout']);
    }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users,[
			'contain' => ['Roles'],
		]);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$roles = $this->Users->Roles->find('list')->where(['id != '.parent::ADMIN]);
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('L\' utilisateur est ajouté.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('L\' utilisateur n\'a pas été ajouté. Réessayez.'));
        }
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('L\' utilisateur est modifié.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('L\' utilisateur n\'a pas été modifié. Réessayez.'));
        }
		$roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
		if ($user->role_id !== parent::ADMIN) {
			if ($this->Users->delete($user)) {
				$this->Flash->success(__('L\' utilisateur est supprimé.'));
			}
        } else {
            $this->Flash->error(__('L\'utilisateur n\'a pas été supprimé. Réessayez.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
				if (isset($_GET['redirect'])) {
					return $this->redirect($_GET['redirect']);
				}
				return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Identifiant ou mot de passe incorrect.'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

}
