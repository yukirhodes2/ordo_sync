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
                ['confirm' => __('Voulez-vous vraiment supprimer ce départ ?')]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des départs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="departures form large-9 medium-8 columns content">
    <?= $this->Form->create($departure) ?>
    <fieldset>
        <legend><?= __('Editer Départ') ?></legend>
        <?php	
			echo ' Train n°'.$departure->departure_train->numero .' prévu sur voie '.$departure->way->numero.'<br/>';
			
			echo $this->Form->control('way_id', ['label' => 'Voie','options' => $ways]);
            //echo $this->Form->control('train_id', ['options' => $trains]);
			
            echo $this->Form->control('adc_arrival', ['label' => 'Arrivée EM, CRML ou ADC', 'empty' => true]);
			echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('adc_arrival')"]);
			echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('adc_arrival')"]);
            echo '<br/>';
			
            echo $this->Form->control('refouleur_arrival', ['label' => 'Arrivée refouleur', 'empty' => true]);
			echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('refouleur_arrival')"]);
			echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('refouleur_arrival')"]);
            echo '<br/>';
			
			echo $this->Form->control('radio_number', ['label' => 'Numéro de radio']);
			
			if ( isset(isOsmose($departure), $departure->restit, $departure->brake_controls['0']->realisation_time) ){
				echo $this->Form->control('information', ['label' => 'Information au CRML', 'empty' => true]);
				echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('information')"]);
				echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('information')"]);
				echo '<br/>';
			}
			else{
				echo "La date d'information au CRML n'est pas accessible tant que les conditions suivantes n'ont pas été remplies : rendu de la voie, osmose, freinage fait.";
			}
			
            echo $this->Form->control('comment_cpt', ['label' => 'Observations', 'type' => 'textarea']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
