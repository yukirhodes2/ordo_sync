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
                ['action' => 'delete', $train->id],
                ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $train->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des trains'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste rames'), ['controller' => 'TrainSets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des arrivées'), ['controller' => 'Arrivals', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des départs'), ['controller' => 'Departures', 'action' => 'index']) ?></li>
</ul>
</nav>
<div class="trains form large-9 medium-8 columns content">
    <?= $this->Form->create($train) ?>
    <fieldset>
        <legend><?= __('Editer un train') ?></legend>
        <?php
            echo $this->Form->control('numero');
		?>
	
	<?= $this->Form->create($theoricDeparture) ?>
		<?php
			echo $this->Form->control('paris_nord_departure', ['label' => 'Départ Landy']);
            echo $this->Form->control('docking_time', ['label' => 'Mise à quai (en minutes)']);
            echo $this->Form->control('descent_duration', ['label' => 'Temps de descente (en minutes)']);
			echo $this->Form->control('rendition_duration', ['label' => 'Temps de rendu matériel (en minutes)']);
        ?>
	<?= $this->Form->create($theoricArrival) ?>
		<?php
			echo $this->Form->control('paris_nord_arrival', ['label' => 'Arrivée Landy']);
			echo $this->Form->control('ascent_time', ['label' => 'Temps de montée (en minutes)']);
		?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
