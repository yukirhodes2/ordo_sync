<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des trains'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des rames'), ['controller' => 'TrainSets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des arrivées'), ['controller' => 'Arrivals', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des départs'), ['controller' => 'Departures', 'action' => 'index']) ?></li>
	</ul>
</nav>
<div class="trains form large-9 medium-8 columns content">
    <?= $this->Form->create($train) ?>
    <fieldset>
        <legend><?= __('Ajouter un train') ?></legend>
        <?php
            echo $this->Form->control('numero');
        ?>
		<?= $this->Form->create($theoricDeparture) ?>
		<fieldset>
			<legend><?= __('Départ Théorique') ?></legend>
			<?php
				echo $this->Form->control('paris_nord_departure', ['label' => 'Départ Landy']);
				echo $this->Form->input('docking_time', ['label' => 'Mise à quai (en minutes)']);
				echo $this->Form->input('descent_duration', ['label' => 'Temps de descente (en minutes)']);
				echo $this->Form->input('rendition_duration', ['label' => 'Temps de rendu matériel (en minutes)']);
			?>
		</fieldset>
		<?= $this->Form->create($theoricArrival) ?>
		<fieldset>
			<legend><?= __('Arrivée théorique') ?></legend>
			<?php
				echo $this->Form->control('paris_nord_arrival', ['label' => 'Arrivée Landy']);
				echo $this->Form->control('ascent_time', ['label' => 'Temps de montée']);
			?>
		</fieldset>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
