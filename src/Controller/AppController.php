<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
	const ADMIN = 1;
	const GEOPS = 2;
	const RLP = 3;
	const CPT = 4;
	const EIC = 5;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
		
		$this->loadComponent('Flash');
        $this->loadComponent('Auth', [
			'authorize' => ['Controller'],
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'display'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
                'home'
            ]
        ]);

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

	public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index', 'view', 'display']);
		$this->Auth->deny('delete');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
	
	// public function afterSave(){
			// $logsTable = TableRegistry::get("Logs");
			// $log = $logsTable->newEntity();
			// $log->user_id = $this->Auth->user("id");
			// $log->content = implode("|", $_POST);
			// $this->LogsController->save($log);
	// }
	
	public function isAuthorized($user)
	{
		return true;
	}
	
	public function number(Table $table){
		if ( isset($_POST['numero']) ){
			$numero = $_POST['numero'];
			$matches = $table->findByNumero($numero);
			$matches->execute();
			$matches = $matches->toArray();
			$this->set(compact('matches'));
		}
	}
	
	public function loadAlerts(){
		$alerts = TableRegistry::get('Alerts');
		$alerts = $alerts->find();
		$alerts->execute();
		$alerts = $alerts->toArray();
		$this->set(compact('alerts'));
	}

}
