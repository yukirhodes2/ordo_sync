<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

/**
 * TrainSetReleases Controller
 *
 * @property \App\Model\Table\TrainSetReleasesTable $TrainSetReleases
 */
class TrainSetReleasesController extends AppController
{
	public function isAuthorized($user)
	{
		return isset($user) && ($user === parent::GEOPS || $user === parent::RLP);
	}
	
	public function beforeFilter(Event $event)
    {
		parent::beforeFilter($event);
		if ( self::isAuthorized($this->Auth->user("role_id")) === false ){
			$this->Auth->deny();
		}
		else{
			$this->Auth->allow(['add', 'edit', 'delete']);
		}
    }
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Releases1', 'Releases2', 'Status1', 'Status2', 'TrainSets'],
			'order' => ['id' => 'desc'],
        ];
        $trainSetReleases = $this->paginate($this->TrainSetReleases);
		$releases = TableRegistry::get('releases');
		$status = TableRegistry::get('status');
		if($this->request->is('post')){
			if($this->request->getData()){
				$data = $this->request->getData();
				if (isset($data['date'])){
					$trainSetReleases = $this->TrainSetReleases
												->find('all')
												->where([
													'TrainSetReleases.date <' => date('Y-m-d', (strtotime($data['date']['year'].'-'.$data['date']['month'].'-'.$data['date']['day'])+86400)),
													'TrainSetReleases.date >=' => date('Y-m-d', strtotime($data['date']['year'].'-'.$data['date']['month'].'-'.$data['date']['day']))
												])
												->contain(['Releases', 'Status', 'TrainSets']);
				}
			}
			else {
                $this->Flash->error('Il y a eu un problème lors de la recherche. Si cette erreur persiste, contactez un administrateur au plus vite.');
            }
		}
		
		
        $this->set(compact('trainSetReleases', 'releases', 'status'));
        $this->set('_serialize', ['trainSetReleases']);
    }

    /**
     * View method
     *
     * @param string|null $id Train Set Release id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $trainSetRelease = $this->TrainSetReleases->get($id, [
            'contain' => ['Releases1', 'Releases2', 'Status1','Status2', 'TrainSets']
        ]);

        $this->set('trainSetRelease', $trainSetRelease);
        $this->set('_serialize', ['trainSetRelease']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $trainSetRelease = $this->TrainSetReleases->newEntity();
		if (isset($id)){
			$this->set('train_set', $this->TrainSetReleases->TrainSets->get($id));
		}
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			if (isset($id)){
				$data['train_set_id'] = $id;
			}
			
			$data['active'] = true;
			$data['comment'] = "";
            $trainSetRelease = $this->TrainSetReleases->patchEntity($trainSetRelease, $data);
            if ($this->TrainSetReleases->save($trainSetRelease)) {
                $this->Flash->success(__('The train set release has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
			debug($trainSetRelease);
            $this->Flash->error(__('The train set release could not be saved. Please, try again.'));
        }
        $releases = $this->TrainSetReleases->Releases1->find('list', ['limit' => 200]);
        $status = $this->TrainSetReleases->Status1->find('list', ['limit' => 200]);
        $trainSets = $this->TrainSetReleases->TrainSets->find('list', ['limit' => 200]);
        $this->set(compact('trainSetRelease', 'releases', 'status', 'trainSets'));
        $this->set('_serialize', ['trainSetRelease']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Train Set Release id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $trainSetRelease = $this->TrainSetReleases->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			
			if ( $trainSetRelease->status2_id !== 1 && $data['status2_id'] === '1' ){ // ajouter auto heure courante
				$data['heure'] = date('Y-m-d H:i:s');
			}
			elseif ( $data['status2_id'] !== '1' && $trainSetRelease->status2_id === 1 ){ // enlever heure courante
				$data['heure'] = null;
			}
			
            $trainSetRelease = $this->TrainSetReleases->patchEntity($trainSetRelease, $data);
            if ($this->TrainSetReleases->save($trainSetRelease)) {
                $this->Flash->success(__('The train set release has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
			
            $this->Flash->error(__('The train set release could not be saved. Please, try again.'));
        }
        $releases = $this->TrainSetReleases->Releases1->find('list', ['limit' => 200]);
        $status = $this->TrainSetReleases->Status1->find('list', ['limit' => 200]);
        $trainSets = $this->TrainSetReleases->TrainSets->find('list', ['limit' => 200]);
        $this->set(compact('trainSetRelease', 'releases', 'status', 'trainSets'));
        $this->set('_serialize', ['trainSetRelease']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Train Set Release id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $trainSetRelease = $this->TrainSetReleases->get($id);
        if ($this->TrainSetReleases->delete($trainSetRelease)) {
            $this->Flash->success(__('The train set release has been deleted.'));
        } else {
            $this->Flash->error(__('The train set release could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}