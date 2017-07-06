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
                ['action' => 'delete', $departureTrain->id],
                ['confirm' => __('Voulez-vous vraiment supprimer cette donnée ?')]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des trains type départ'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="departureTrains form large-9 medium-8 columns content">
    <?= $this->Form->create($departureTrain) ?>
    <fieldset>
        <legend><?= __('Editer train type départ') ?></legend>
        <?php
			echo __('Les temps et alertes sont exprimés en <span class="sncf-color-plum">minutes</span>').'<br/>'; 
            echo $this->Form->control('numero');
			echo $this->Form->control('alerte1');
            echo $this->Form->control('alerte2');
		        ?>
			<?= $this->Form->create($theoricDeparture) ?>
		<fieldset>
			<legend><?= __('Départ théorique') ?></legend>
			<?php
				echo $this->Form->control('paris_nord_departure', ['label' => 'Départ PNO', 'empty' => true]);
					echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('paris_nord_departure')"]);
					echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('paris_nord_departure')"]);
				echo '<label class="landy_calc">Départ Landy</label> <span id="landy_calc">'.$this->time->format($theoricDeparture->landy_departure, "HH:mm").'</span>';
				echo '<br/>'.__('Les temps sont exprimés en <span class="sncf-color-plum">minutes</span>').'<br/>'; 
				echo $this->Form->control('docking_time', ['label' => 'Temps de mise à quai']);
				echo $this->Form->control('descent_duration', ['label' => 'Temps de descente']);
				echo $this->Form->control('rendition_duration', ['label' => 'Temps de rendu matériel']);
			?>
		</fieldset>

    </fieldset>
    <?= $this->Form->button(__('Valider')) ?>
    <?= $this->Form->end() ?>
</div>
<?= $this->Html->script('calc'); ?>