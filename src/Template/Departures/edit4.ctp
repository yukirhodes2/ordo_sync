<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Supprimer'),
                ['action' => 'delete', $departure->id],
                ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $departure->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des départs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des trains'), ['controller' => 'Trains', 'action' => 'index']) ?></li>
	</ul>
</nav>
<div class="departures form large-9 medium-8 columns content">
    <?= $this->Form->create($departure) ?>
    <fieldset>
        <legend><?= __('Editer Départ') ?></legend>
        <?php	
			echo ' Train n°'.$departure->train->numero .' prévu sur voie '.$departure->way->numero.'<br/>';
			
            echo $this->Form->control('annoucement', ['label' => 'Annonce CRML ou refouleur', 'empty' => true]);
			echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('annoucement')"]);
			echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('annoucement')"]);
            echo '<br/>';
			
            echo $this->Form->control('comment_eic', ['label' => 'Observations', 'type' => 'textarea']);
			
            echo $this->Form->control('postep_departure', ['label' => 'Départ Poste P', 'empty' => true]);
			echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('postep_departure')"]);
			echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('postep_departure')"]);
            echo '<br/>';
			
            echo $this->Form->control('passagecarre_departure', ['label' => 'Départ Passage Carré', 'empty' => true]);
			echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('passagecarre_departure')"]);
			echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('passagecarre_departure')"]);
            echo '<br/>';
			
			$liberations = [];
						$countSet = 0;
						if ( isset($departure->train_set1) ){
							++$countSet;
							if (count($departure->train_set1->train_set_releases) > 0){
								if ( $departure->train_set1->train_set_releases[count($departure->train_set1->train_set_releases)-1]->active){
									array_push($liberations, $departure->train_set1->train_set_releases[count($departure->train_set1->train_set_releases)-1]->heure);
								}
							}
						} 
						if ( isset($departure->train_set2) ){
							++$countSet;
							if (count($departure->train_set2->train_set_releases) > 0){
								if ( $departure->train_set2->train_set_releases[count($departure->train_set2->train_set_releases)-1]->active){
									array_push($liberations, $departure->train_set2->train_set_releases[count($departure->train_set2->train_set_releases)-1]->heure);
								}
							}
						}
						if ( isset($departure->train_set3) ){
							++$countSet;
							if (count($departure->train_set3->train_set_releases) > 0){
								if ( $departure->train_set3->train_set_releases[count($departure->train_set3->train_set_releases)-1]->active){
									array_push($liberations, $departure->train_set3->train_set_releases[count($departure->train_set3->train_set_releases)-1]->heure);
								}
							}
						}
				if ((!empty($liberations) && !in_array(null, $liberations) && $countSet !== 0 && count($liberations) === $countSet && $countSet !== 0) || isset($departure->osmose)){
					echo $this->Form->control('landy_departure', ['label' => 'Départ réel Landy', 'empty' => true]);
					// echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('landy_departure')"]);
					echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('landy_departure')"]);
					echo '<br/>';
				}
				else {
					// echo 'Le départ du Landy est en attente de la libération de toutes les rames.';
					echo $this->Form->control('landy_departure', ['label' => 'Départ réel Landy', 'empty' => true]);
					// echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('landy_departure')"]);
					echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('landy_departure')"]);
					echo '<br/>';
				}  
            
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>