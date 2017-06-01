<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Departure Trains'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="departureTrains form large-9 medium-8 columns content">
    <?= $this->Form->create($departureTrain) ?>
    <fieldset>
        <legend><?= __('Ajouter un train type départ') ?></legend>
        <?php
            echo $this->Form->control('numero', ['label' => __('Numéro'), 'class' => 'odd']);
			echo '<span id="erreur-numero"> Le numéro doit être impair </span>';
            echo $this->Form->control('alerte1', ['label' => 'Alerte avant départ Landy (en minutes, facultatif)']);
            echo $this->Form->control('alerte2', ['label' => 'Alerte avant rendu matériel (en minutes, facultatif)']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Valider')) ?>
    <?= $this->Form->end() ?>
</div>
