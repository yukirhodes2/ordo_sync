<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des trains à l\'arrivée'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="arrivalTrains form large-9 medium-8 columns content">
    <?= $this->Form->create($arrivalTrain) ?>
    <fieldset>
        <legend><?= __('Ajouter un train type arrivée') ?></legend>
        <?php
            echo $this->Form->control('numero', ['class' => 'even']);
			echo '<span id="erreur"> </span>';
			echo '<span id="erreur-numero"> Le numéro doit être pair </span>';
        ?>
		<?= $this->Form->create($theoricArrival) ?>
		<fieldset>
			<legend><?= __('Arrivée théorique') ?></legend>
			<?php
				echo $this->Form->control('paris_nord_arrival', ['label' => 'Arrivée PNO', 'empty' => true]);
					echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('paris_nord_arrival')"]);
					echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('paris_nord_arrival')"]);
					echo '<br/>';
				echo $this->Form->control('landy_arrival', ['label' => 'Arrivée Landy', 'empty' => true]);
					echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('landy_arrival')"]);
					echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('landy_arrival')"]);
					echo '<br/>';
				echo $this->Form->control('ascent_time', ['label' => 'Temps de montée']);
			?>
		</fieldset>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
