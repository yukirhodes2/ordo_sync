<?php
namespace App\Model\Behavior;

use Cake\Datasource\EntityInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

class LoggableBehavior extends Behavior {
	
	public function afterSave(Event $event, Entity $entity){
		// trouver un moyen de récupérer la datetime courante, l'id utilisateur et la requête(ou controller avec id modifié)
		$connection = ConnectionManager::get('default');
		$results = $connection->execute('SELECT * from users')->fetchAll('assoc');
		debug($results);
	}
		
}


?>