<?php
function isOsmose($entity){
	$liberations = [];
			$countSet = 0;
			if ( isset($entity->loc) ){
				++$countSet;
				if (count($entity->loc->train_set_releases) > 0){
					if ( $entity->loc->train_set_releases[count($entity->loc->train_set_releases)-1]->active){
						array_push($liberations, $entity->loc->train_set_releases[count($entity->loc->train_set_releases)-1]->heure);
					}
				}
			} 
			if ( isset($entity->train_set1) ){
				++$countSet;
				if (count($entity->train_set1->train_set_releases) > 0){
					if ( $entity->train_set1->train_set_releases[count($entity->train_set1->train_set_releases)-1]->active){
						array_push($liberations, $entity->train_set1->train_set_releases[count($entity->train_set1->train_set_releases)-1]->heure);
					}
				}
			} 
			if ( isset($entity->train_set2) ){
				++$countSet;
				if (count($entity->train_set2->train_set_releases) > 0){
					if ( $entity->train_set2->train_set_releases[count($entity->train_set2->train_set_releases)-1]->active){
						array_push($liberations, $entity->train_set2->train_set_releases[count($entity->train_set2->train_set_releases)-1]->heure);
					}
				}
			}
			if ( isset($entity->train_set3) ){
				++$countSet;
				if (count($entity->train_set3->train_set_releases) > 0){
					if ( $entity->train_set3->train_set_releases[count($entity->train_set3->train_set_releases)-1]->active){
						array_push($liberations, $entity->train_set3->train_set_releases[count($entity->train_set3->train_set_releases)-1]->heure);
					}
				}
			}
	
	// echo '!empty($liberations) :'.!empty($liberations);
	// echo '<br/>!in_array(null, $liberations) :'.!in_array(null, $liberations);
	// echo '<br/>$countSet !== 0 :'.($countSet !== 0);
	// echo '<br/>count($liberations) === $countSet :'.(count($liberations) === $countSet);
	// echo '<br/>isset($entity->osmose) :'.isset($entity->osmose);
	// var_dump($liberations);
	
	if ((!empty($liberations) && !in_array(null, $liberations) &&  $countSet !== 0 && count($liberations) === $countSet) || isset($entity->osmose)){
		return true;
	}
	return false;
}
?>