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
        <li><?= $this->Html->link(__('Liste des trains'), ['controller' => 'DepartureTrains', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="departures form large-9 medium-8 columns content">
    <?= $this->Form->create($departure) ?>
    <fieldset>
        <legend><?= __('Editer Départ') ?></legend>
        <?php		
			echo $this->Form->control('way_id', ['label' => 'Voie','options' => $ways]);
            echo $this->Form->control('train_id', ['options' => $trains]);
            echo $this->Form->control('loc_id', ['options' => $trainSets, 'empty' => true, 'label' => 'Loc']);
            echo $this->Form->control('train_set1_id', ['options' => $trainSets, 'empty' => true, 'label' => 'Rame 1']);
            echo $this->Form->control('train_set2_id', ['options' => $trainSets, 'empty' => true, 'label' => 'Rame 2']);
            echo $this->Form->control('train_set3_id', ['options' => $trainSets, 'empty' => true, 'label' => 'Rame 3']);
			$options = ['T' => 'Tire', 'P' => 'Pousse'];
			echo $this->Form->radio('push_pool', $options);
            echo $this->Form->control('comment_geops', ['label' => 'Observations', 'type' => 'textarea']);
            echo $this->Form->control('formed', ['label' => ' Formé']);
			
			echo $this->Form->control('restit', ['label' => 'Rendu de voie', 'empty' => true]);
			
			echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('restit')"]);
			echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('restit')"]);
            echo '<br/><hr>';
			
			if (isset($departure->brake_id)){ // si le freinage a déjà été paramétré, on refuse la modif vers une valeur nulle
				echo $this->Form->control('brake_id', ['label' => 'Freinage','options' => $brakes]);
			} else {
				echo $this->Form->control('brake_id', ['label' => 'Freinage','options' => $brakes, 'empty' => true]);
			}
			
			echo $this->Form->create($brakeControl);
				if (isset($departure->brake_controls['0']->present)){ // si le freinage a déjà été réalisé, on pointe sur la valeur enregistrée
					echo $this->Form->Control('present_id', ['label' => 'Fait par...', 'options' => $presents, 'value' => $departure->brake_controls['0']->present_id]);
				}
				else{
					echo $this->Form->Control('present_id', ['label' => 'A faire par...', 'options' => $presents, 'empty' => true]);
				}
				
			echo $this->Form->control('realisation_time', ['label' => 'Réalisation frein', 'empty' => true]);
			echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('realisation_time')"]);
			echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('realisation_time')"]);
            echo '<br/>';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
<script>emptyTime();</script>